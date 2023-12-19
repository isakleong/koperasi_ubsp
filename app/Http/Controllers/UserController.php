<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {

        // Retrieve form data
        $keyword = $request->input('keyword', '');
        $status = $request->input('status', 'active');

        // Perform data filtering based on the provided parameters
        $users = $this->fetchDataFromDatabase($keyword, $status);

        // Render the view with the filtered data
        return view('admin.anggota-edit', compact('users'));

        // $users = User::when($request->keyword!=null, function ($q) use ($request) {
        //     return $q->where('fname', 'LIKE', '%'.$request->keyword.'%')
        //     ->orWhere('lname', 'LIKE', '%'.$request->keyword.'%')
        //     ->orWhere('address', 'LIKE', '%'.$request->keyword.'%')
        //     ->orWhere('workAddress', 'LIKE', '%'.$request->keyword.'%');
        // }, function ($q) use ($keyword) {
        //     return $q->where('fname', 'LIKE', '%'.$keyword.'%')
        //     ->orWhere('lname', 'LIKE', '%'.$keyword.'%')
        //     ->orWhere('address', 'LIKE', '%'.$keyword.'%')
        //     ->orWhere('workAddress', 'LIKE', '%'.$keyword.'%');
        // }) ->when($request->status!=null, function ($q) use($request){
        //     return $q->where('status', $request->status);
        // }, function ($q) use ($status) {
        //     return $q->where('status', $status);
        // })->paginate(10);

        // //filter by keyword
        // $users->when($request->keyword, function ($query) use ($request) {
        //     return $query->where('fname', 'LIKE', '%'.$request->keyword.'%')
        //     ->orWhere('lname', 'LIKE', '%'.$request->keyword.'%')
        //     ->orWhere('address', 'LIKE', '%'.$request->keyword.'%')
        //     ->orWhere('workAddress', 'LIKE', '%'.$request->keyword.'%');
        // });

        // //filter by status
        // $users->when($request->status, function ($query) use ($request) {
        //     return $query->whereStatus($request->status);
        // });

        // return view('admin.anggota-edit', compact('users', 'request'));
    }

    private function fetchDataFromDatabase($keyword, $status)
    {
        if($status == 'active') {
            $status = 2;
        } elseif($status == 'non-active') {
            $status = 3;
        } elseif($status == 'not-verified') {
            $status = 0;
        } elseif($status == 'not-acc') {
            $status = 1;
        }
        
        // Query the database using Eloquent (Laravel's ORM)
        $query = User::where('status', $status)
            ->where(function ($q) use ($keyword) {
                $q->where('fname', 'LIKE', "%$keyword%")
                    ->orWhere('lname', 'LIKE', "%$keyword%");
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        // return $query;
        return $query->appends(['keyword' => $keyword, 'status' => $status]);
    }

    public function create()
    {
        return view('admin.anggota-add');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            [
                'fname' => $request->input('fname'),
                'lname' => $request->input('lname'),
                'birthdate' => $request->input('birthdate'),
                'birthplace' => $request->input('birthplace'),
                'address' => $request->input('address'),
                'workAddress' => $request->input('workAddress'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'mothername' => $request->input('mothername'),
                'method' => $request->input('method'),
                'simpanan' => $request->file('simpanan'),
                'ktp' => $request->file('ktp'),
                'kk' => $request->file('kk'),
            ],
            [
                'fname' => 'required',
                'lname' => 'required',
                'birthdate' => 'required|date|before:' . now()->subYears(17)->format('Y-m-d'),
                'birthplace' => 'required',
                'address' => 'required',
                'workAddress' => 'required',
                'email' => 'required|email|unique:users,email',
                'phone' => 'required|min:10|regex:/^([0-9\s\-\+\(\)]*)$/',
                'mothername' => 'required',
                'method' => 'required|in:cash,transfer',
                'simpanan' => 'required_if:method,transfer',
                'ktp' => 'required|image',
                'kk' => 'required|image',
            ],
            [
                'fname.required' => 'Nama depan belum diisi',
                'lname.required' => 'Nama belakang belum diisi',
                'birthdate.required' => 'Tanggal lahir belum diisi',
                'birthdate.date' => 'Tanggal lahir tidak valid',
                'birthplace.required' => 'Tempat lahir belum diisi',
                'address.required' => 'Alamat tinggal belum diisi',
                'workAddress.required' => 'Alamat kerja belum diisi',
                'email.required' => 'Email belum diisi',
                'email.unique' => 'Email sudah ada',
                'email.email' => 'Email tidak valid',
                'phone.required' => 'No Hp belum diisi',
                'phone.min' => 'No Hp tidak valid',
                'phone.regex' => 'No Hp tidak valid',
                'mothername.required' => 'Nama ibu kandung belum diisi',
                'method.required' => 'Jenis pembayaran belum diisi',
                'method.in' => 'Jenis pembayaran tidak valid',
                'simpanan.required_if' => 'Bukti pembayaran belum diisi',
                'ktp.required' => 'Foto KTP belum diisi',
                'ktp.image' => 'Foto KTP tidak valid',
                'kk.required' => 'Foto KK belum diisi',
                'kk.image' => 'Foto KK tidak valid',
            ],
            );
            
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        try {
            $input = $request->all();

            $input['registDate'] = date('Y-m-d H:i:s');

            $nominal = $input['nominal'];
            $nominal = str_replace('Rp', '', $nominal);
            $nominal = str_replace(' ', '', $nominal);
            $nominal = str_replace(',', '', $nominal);

            //generate member id
            $uuid4 = Uuid::uuid4()->getHex();
            $salt_1 = Str::random(7);
            $salt_2 = random_int(0, 9);
            $salt_3 = Str::substr($uuid4, 0, 7);
            $saltData = $salt_1.$salt_2.$salt_3;
            $input['memberId'] = strtoupper('MUBSP'.date('ymd').$saltData);
            //end of generate member id

            //secure password with salt
            $memberId = $input['memberId'];
            $id = substr($memberId, -1);
            $salt = substr($memberId, 18, 1);
            $now = date('ymd');

            $carbonDate = Carbon::parse($input['registDate']);
            $hour = $carbonDate->format('H');
            $minute = $carbonDate->format('i');
            $second = $carbonDate->format('s');

            $char1 = ($minute + $hour + ($salt * 7)) % 16;
            $char2 = ($minute + $second + ($salt * 7)) % 16;
            $char3 = ($minute + ord($id[0]) + ($salt * 7)) % 16;
            $res = strtoupper(dechex($char1)) . strtoupper(dechex($char2)) . $salt . strtoupper(dechex($char3));
            $input['password'] = Hash::make($res.$input['password']);
            //end of secure password with salt

            //image handler
            if($imageKTP = $request->file('ktp')) {
                $destinationPath = 'image/upload/'.$memberId.'/'.'profile/';
                File::makeDirectory($destinationPath, 0777, true, true);

                $imageName = "ktp_".$memberId.time().Str::random(5);
                $input['ktp'] = $destinationPath.$imageName;
            }

            if($imageKK = $request->file('kk')) {
                $destinationPath = 'image/upload/'.$memberId.'/'.'profile/';
                File::makeDirectory($destinationPath, 0777, true, true);
                
                $imageName = "kk_".$memberId.time().Str::random(5);
                $input['kk'] = $destinationPath.$imageName;
            }

            $buktiSimpanan = "";
            if($imageSimpanan = $request->file('simpanan')) {
                $destinationPath = 'image/upload/'.$memberId.'/'.'simpanan/pokok/';
                File::makeDirectory($destinationPath, 0777, true, true);

                $imageName = $memberId."_".time().Str::random(5);
                $buktiSimpanan = $destinationPath.$imageName;
            }
            //end of image handler

            $input["status"] = 2;

            $user = null;
            DB::transaction(function($user) use($input, $imageKTP, $imageKK, $imageSimpanan, $buktiSimpanan, $nominal) {
                $user = User::create($input);
                $user->save();

                Image::make($imageKTP)->resize(800, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($input['ktp']);
    
                Image::make($imageKK)->resize(800, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($input['kk']);
    
                Image::make($imageSimpanan)->resize(800, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($buktiSimpanan);


                //insert into user_account
                $arrUserAccount = [];
                $arrUserAccount["memberId"] = $user->memberId;

                //generate acount id
                $salt_1 = random_int(0, 9);
                $salt_2 = Str::random(7);
                $salt_3 = Str::random(16);
                $arrUserAccount["accountId"] = strtoupper("UAC-".$salt_1.$salt_2."-".$salt_3);

                $arrUserAccount["kind"] = "pokok";
                $arrUserAccount["balance"] = $nominal;

                $userAccount = $user->userAccount()->create($arrUserAccount);
                $userAccount->save();

                // $userAccount = UserAccount::create($arrUserAccount);
                // $userAccount->save();

                //insert into transaction
                $arrTransaction = [];
                $arrTransaction["accountId"] = $userAccount->accountId;
                $arrTransaction["kind"] = "pokok";
                $arrTransaction["total"] = $nominal;
                $arrTransaction["method"] = 1;
                $arrTransaction["transactionDate"] = date('Y-m-d H:i:s');
                $arrTransaction["image"] = $buktiSimpanan;
                $arrTransaction["notes"] = "registrasi simpanan pokok";
                $arrTransaction["status"] = 0;
                $userAccount->transaction()->create($arrTransaction);

                event(new Registered($user));

                Auth::login($user);
            });

            DB::commit();

            return redirect('/email/verify');
        } catch (\Exception $e) {
            DB::rollback();
            $errorMsg = $e->getMessage();
            return view('layout.admin.error', compact(['errorMsg']));
        }
    }

    public function show(User $user)
    {
        dd('sd');
        // dd("edit");
        // $status = $request->has('status') ? $request->input('status') : "aktif";

        // if($status == "aktif") {
        //     $users = DB::table('users')
        //     ->where('status', 2)
        //     ->orderBy('id', 'desc')
        //     ->cursorPaginate(10);
        // } elseif ($status == "non-aktif") {
        //     $users = DB::table('users')
        //     ->where('status', 3)
        //     ->orderBy('id', 'desc')
        //     ->cursorPaginate(10);
        // } elseif ($status == "not-verified") {
        //     $users = DB::table('users')
        //     ->where('status', 0)
        //     ->orderBy('id')
        //     ->cursorPaginate(10);
        // } elseif ($status == "not-acc") {
        //     $users = DB::table('users')
        //     ->where('status', 1)
        //     ->orderBy('id', 'desc')
        //     ->cursorPaginate(10);
        // }

        // if ($request->ajax()) {
        //     return view('admin.partials.filtered-data-anggota', compact('users'))->render();
        // }

        // return view('admin.anggota-edit', compact('users', 'request'));
    }

    public function edit(User $user)
    {
        // Retrieve transactions with a specific user_account type
        
        $userAccount = $user->userAccount()
            ->where('kind', 'pokok')
            ->where('memberId', $user->memberId)
            ->first();
        $userAccount->balance = 'Rp ' . number_format($userAccount->balance, 0, ',', ',');

        $transaction = collect();
        foreach ($user->userAccount as $account) {
            $transaction = $transaction->merge($account->transaction()
            ->where('kind', 'pokok')
            ->where('accountId', $account->accountId)
            ->first());
        }
        $transaction['transactionDate'] = Carbon::parse($transaction['transactionDate'])->format('d-m-Y');

        return view('admin.anggota-edit-detail', compact('user', 'userAccount', 'transaction'));
    }

    public function update(Request $request, User $user)
    {
        $userId = $user->id;
        $currentMethod = $request->currentMethod;

        // Retrieve transactions with a specific user_account type
        $userAccount = $user->userAccount()
            ->where('kind', 'pokok')
            ->where('memberId', $user->memberId)
            ->first();

        $transaction = collect();
        foreach ($user->userAccount as $account) {
            $transaction = $transaction->merge($account->transaction()
            ->where('kind', 'pokok')
            ->where('accountId', $account->accountId)
            ->first());
        }

        $validator = Validator::make(
            [
                'fname' => $request->input('fname'),
                'lname' => $request->input('lname'),
                'birthdate' => $request->input('birthdate'),
                'birthplace' => $request->input('birthplace'),
                'address' => $request->input('address'),
                'workAddress' => $request->input('workAddress'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'mothername' => $request->input('mothername'),
                'method' => $request->input('method'),
                'simpanan' => $request->file('simpanan'),
                'ktp' => $request->file('ktp'),
                'kk' => $request->file('kk'),
            ],
            [
                'fname' => 'required',
                'lname' => 'required',
                'birthdate' => 'required|date|before:' . now()->subYears(17)->format('Y-m-d'),
                'birthplace' => 'required',
                'address' => 'required',
                'workAddress' => 'required',
                'email' => [
                    'required',
                    'email',
                    Rule::unique('users', 'email')->ignore($userId),
                ],
                'phone' => 'required|min:10|regex:/^([0-9\s\-\+\(\)]*)$/',
                'mothername' => 'required',
                // 'method' => 'required|in:cash,transfer',
                'method' => [
                    'nullable',
                    Rule::in(['cash', 'transfer']),
                ],
                'simpanan' => 'required_if:method,transfer',
                'ktp' => 'nullable|image',
                'kk' => 'nullable|image',
            ],
            [
                'fname.required' => 'Nama depan belum diisi',
                'lname.required' => 'Nama belakang belum diisi',
                'birthdate.required' => 'Tanggal lahir belum diisi',
                'birthdate.date' => 'Tanggal lahir tidak valid',
                'birthdate.before' => 'Anggota UBSP harus berusia minimal 17 tahun',
                'birthplace.required' => 'Tempat lahir belum diisi',
                'address.required' => 'Alamat tinggal belum diisi',
                'workAddress.required' => 'Alamat kerja belum diisi',
                'email.required' => 'Email belum diisi',
                'email.unique' => 'Email sudah ada',
                'email.email' => 'Email tidak valid',
                'phone.required' => 'No Hp belum diisi',
                'phone.min' => 'No Hp tidak valid',
                'phone.regex' => 'No Hp tidak valid',
                'mothername.required' => 'Nama ibu kandung belum diisi',
                'method.in' => 'Jenis pembayaran tidak valid',
                'simpanan.required_if' => 'Bukti pembayaran belum diisi',
                'ktp.image' => 'Foto KTP tidak valid',
                'kk.image' => 'Foto KK tidak valid',
            ],
            );
            
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        try {
            $input = $request->all();

            //image handler
            $ktpDelete = "";
            if($imageKTP = $request->file('ktp')) {
                $ktpDelete = public_path()."/".$user->ktp;

                $destinationPath = 'image/upload/'.$user->memberId.'/'.'profile/';
                File::makeDirectory($destinationPath, 0777, true, true);

                $imageName = "ktp_".$user->memberId.time().Str::random(5).$imageKTP->getClientOriginalExtension();
                $input['ktp'] = $destinationPath.$imageName;
            }

            $kkDelete = "";
            if($imageKK = $request->file('kk')) {
                $kkDelete = public_path()."/".$user->kk;

                $destinationPath = 'image/upload/'.$user->memberId.'/'.'profile/';
                File::makeDirectory($destinationPath, 0777, true, true);
                
                $imageName = "kk_".$user->memberId.time().Str::random(5).$imageKK->getClientOriginalExtension();
                $input['kk'] = $destinationPath.$imageName;
            }

            $buktiSimpanan = "";
            $simpananDelete = "";
            if($imageSimpanan = $request->file('simpanan')) {
                $simpananDelete = public_path()."/".$user->kk;

                $destinationPath = 'image/upload/'.$user->memberId.'/'.'simpanan/pokok/';
                File::makeDirectory($destinationPath, 0777, true, true);

                $imageName = $user->memberId."_".time().Str::random(5).$imageSimpanan->getClientOriginalExtension();
                $buktiSimpanan = $destinationPath.$imageName;
            }
            if($input['method'] == 'cash') {
                $simpananDelete = public_path()."/".$user->kk;
            }
            //end of image handler

            DB::beginTransaction();

            // dd($input);
            $user->update($input);

            //update image
            if (isset($input['ktp'])) {
                Image::make($imageKTP)->resize(1200, 630, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($input['ktp']);
            }

            if (isset($input['kk'])) {
                Image::make($imageKK)->resize(1200, 630, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($input['kk']);
            }

            if (isset($input['simpanan'])) {
                Image::make($imageSimpanan)->resize(1200, 630, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($buktiSimpanan);
            }

            //image delete
            if($ktpDelete != "") {
                File::delete($ktpDelete);
            }
            if($kkDelete != "") {
                File::delete($kkDelete);
            }
            if($simpananDelete != "") {
                File::delete($simpananDelete);
            }

            DB::commit();

            return redirect('/admin/user')->withSuccess('Data anggota berhasil diupdate!');
        } catch (\Exception $e) {
            dd("hhhe");
            DB::rollback();
            $errorMsg = $e->getMessage();
            return view('layout.admin.error', compact(['errorMsg']));
        }
        
    }

    public function destroy(User $user)
    {
        //
    }
}
