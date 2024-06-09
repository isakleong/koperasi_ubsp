<?php

namespace App\Http\Controllers;

use App\Exports\ExportUser;
use App\Models\Config;
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
// use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // Retrieve form data
        $keyword = $request->input('keyword', '');
        $status = $request->input('status', 'active');

        // Perform data filtering based on the provided parameters
        $users = $this->fetchDataFromDatabase($keyword, $status);

        // get all user
        $data = User::all();
        $cntActive = 0;
        $cntTerminate = 0;
        $cntNotverify = 0;
        $cntNotacc = 0;
        foreach ($data as $item) {
            if ($item->status == 0) {
                $cntNotverify++;
            } elseif ($item->status == 1) {
                $cntNotacc++;
            } elseif ($item->status == 2) {
                $cntActive++;
            } elseif ($item->status == 3) {
                $cntTerminate++;
            }
        }

        return view('admin.anggota-edit', compact('users','cntActive','cntTerminate','cntNotverify','cntNotacc'));
    }

    // public function exportData(Request $request) {
    //     dd($request->input('action'));
    //     switch ($request->input('action')) {
    //         case 'pdf':
    //             dd($request->input('status-export'));

    //             $dataReport = User::orderBy('id', 'desc')->get();

    //             $pdf = PDF::loadView('admin.report.anggota-report', compact('dataReport'));
    //             $pdf->setOption('enable-local-file-access', true);

	//             return $pdf->download('Laporan Anggota UBSP.pdf');
    //             break;
    //         case 'excel':
    //             return Excel::download(new ExportUser, "Laporan Anggota UBSP.xlsx");
    //             break;
    //     }   
    // }

    public function accData(Request $request, $id) {
        $now = date('Y-m-d H:i:s');
        $user = User::findOrFail($id);

        try {
            DB::beginTransaction();

            $user->joinDate = $now;
            $user->status = 2;
            $user->save();

            foreach ($user->userAccount as $userAccount) {
                if ($userAccount->kind === 'pokok') {
                    $userAccount->openDate = $now;
                    $userAccount->save();

                    $userAccount->transaction()->update(['status' => 2, 'approvedOn' => $now]);
                }
            }

            DB::commit();

            return redirect('/admin/user')->withSuccess('Data status user berhasil diupdate!');
        } catch (\Exception  $e) {
            DB::rollback();
            $errorMsg = $e->getMessage();
            return view('layout.admin.error', compact(['errorMsg']));
        }
    }

    public function rejectData(Request $request, $id) {
        $now = date('Y-m-d H:i:s');
        $user = User::findOrFail($id);

        try {
            DB::beginTransaction();

            $user->exitDate = $now;
            $user->status = 3;
            $user->save();

            foreach ($user->userAccount as $userAccount) {
                if ($userAccount->kind === 'pokok') {
                    $userAccount->closedDate = $now;
                    $userAccount->save();

                    $userAccount->transaction()->update(['status' => 3, 'approvedOn' => $now]);
                }
            }

            DB::commit();

            return redirect('/admin/user')->withSuccess('Data status user berhasil diupdate!');
        } catch (\Exception  $e) {
            DB::rollback();
            $errorMsg = $e->getMessage();
            return view('layout.admin.error', compact(['errorMsg']));
        }
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
        $configName = ['SIMPANAN POKOK', 'DEFAULT PASSWORD'];
        $configuration = Config::whereIn('name', $configName)->get();

        return view('admin.anggota-add', compact('configuration'));
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
                'nik' => $request->input('nik'),
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
                'nik' => 'required|numeric|digits:16',
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
                'nik.required' => 'NIK belum diisi',
                'nik.numeric' => 'NIK tidak valid',
                'nik.digits' => 'NIK harus 16 digit',
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
            $prefix = 'M-'.date('ym').'-';
            $memberId = IdGenerator::generate(['table' => 'users', 'field' => 'memberId', 'length' => 10, 'prefix' => $prefix]);
            $input['memberId'] = $memberId;

            //secure password with hash
            $input['password'] = Hash::make($input['password']);

            //image handler
            if($imageKTP = $request->file('ktp')) {
                $destinationPath = 'image/upload/'.$memberId.'/'.'profile/';
                File::makeDirectory($destinationPath, 0777, true, true);

                $imageName = "ktp-".time().Str::random(5).".".$imageKTP->getClientOriginalExtension();
                $input['ktp'] = $destinationPath.$imageName;
            }

            if($imageKK = $request->file('kk')) {
                $destinationPath = 'image/upload/'.$memberId.'/'.'profile/';
                File::makeDirectory($destinationPath, 0777, true, true);
                
                $imageName = "kk-".time().Str::random(5).".".$imageKK->getClientOriginalExtension();
                $input['kk'] = $destinationPath.$imageName;
            }

            $buktiSimpanan = "";
            if($imageSimpanan = $request->file('simpanan')) {
                $destinationPath = 'image/upload/'.$memberId.'/'.'simpanan/pokok/';
                File::makeDirectory($destinationPath, 0777, true, true);

                $imageName = "simpanan-".time()."-".Str::random(5).".".$imageSimpanan->getClientOriginalExtension();
                $buktiSimpanan = $destinationPath.$imageName;
            }

            $input["status"] = 0;

            //insert user
            DB::beginTransaction();
            $user = User::create($input);

            if(isset($imageKTP)) {
                Image::make($imageKTP)->resize(800, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($input['ktp']);
            }

            if(isset($imageKK)) {
                Image::make($imageKK)->resize(800, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($input['kk']);
            }

            if(isset($imageSimpanan)){
                Image::make($imageSimpanan)->resize(800, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($buktiSimpanan);
            }

            //insert user account
            $arrUserAccount = [];
            $arrUserAccount["memberId"] = $user->memberId;

            // $prefix = 'MAC-'.$memberId.'-';
            // $arrUserAccount["accountId"] = IdGenerator::generate(['table' => 'user_account', 'field' => 'accountId', 'length' => 17, 'prefix' => $prefix]);

            $prefix = 'MAC-'.$memberId.'-';
            $latestAccount = DB::table('user_account')
            ->where('accountId', 'LIKE', $prefix . '%')
            ->orderBy('accountId', 'desc')
            ->first();

            // Determine the next sequence number
            if ($latestAccount) {
                // Extract the sequence number from the latest account ID
                $latestSequence = (int) substr($latestAccount->accountId, strlen($prefix));
                $nextSequence = str_pad($latestSequence + 1, 2, '0', STR_PAD_LEFT);
            } else {
                $nextSequence = '01';
            }

            // Define the length of the ID including prefix and sequence
            $totalLength = strlen($prefix) + strlen($nextSequence);

            // Generate the new account ID
            $arrUserAccount["accountId"] = IdGenerator::generate([
                'table' => 'user_account',
                'field' => 'accountId',
                'length' => $totalLength,
                'prefix' => $prefix,
                'reset_on_prefix_change' => true,
                'max_value' => $nextSequence
            ]);

            $arrUserAccount["kind"] = "pokok";
            $arrUserAccount["balance"] = $nominal;

            $userAccount = $user->userAccount()->create($arrUserAccount);
            $userAccount->save();

            //insert transaction
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

            // Auth::login($user);

            DB::commit();

            return redirect('/admin/menu/user')->withSuccess('Data anggota berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollback();

            File::deleteDirectory('image/upload/'.$memberId);   

            $errorMsg = $e->getMessage();
            return view('layout.admin.error', compact(['errorMsg']));
        }
    }

    public function show(User $user) {
    }

    public function edit(User $user)
    {   
        $userAccount = array();
        $transaction = array();

        $userAccount = $user->userAccount()
            ->where('kind', 'pokok')
            ->where('memberId', $user->memberId)
            ->first();
        if($userAccount != null) {
            $userAccount->balance = 'Rp ' . number_format($userAccount->balance, 0, ',', ',');
            
            $transaction = collect();
            foreach ($user->userAccount as $account) {
                $transaction = $transaction->merge($account->transaction()
                ->where('kind', 'pokok')
                ->where('accountId', $account->accountId)
                ->first());
            }
            $transaction['transactionDate'] = Carbon::parse($transaction['transactionDate'])->format('d-m-Y');
        }

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

                $imageName = "ktp-".time().Str::random(5).".".$imageKTP->getClientOriginalExtension();
                $input['ktp'] = $destinationPath.$imageName;
            }

            $kkDelete = "";
            if($imageKK = $request->file('kk')) {
                $kkDelete = public_path()."/".$user->kk;

                $destinationPath = 'image/upload/'.$user->memberId.'/'.'profile/';
                File::makeDirectory($destinationPath, 0777, true, true);
                
                $imageName = "kk-".time().Str::random(5).".".$imageKK->getClientOriginalExtension();
                $input['kk'] = $destinationPath.$imageName;
            }

            $buktiSimpanan = "";
            $simpananDelete = "";
            if($imageSimpanan = $request->file('simpanan')) {
                $simpananDelete = public_path()."/".$transaction['image'];

                $destinationPath = 'image/upload/'.$user->memberId.'/'.'simpanan/pokok/';
                File::makeDirectory($destinationPath, 0777, true, true);

                $imageName = "simpanan-".time().Str::random(5).".".$imageSimpanan->getClientOriginalExtension();
                $buktiSimpanan = $destinationPath.$imageName;
            }
            
            if(isset($input['method'])) {
                if($input['method'] == 'cash') {
                    $simpananDelete = public_path()."/".$transaction['image'];
                }
            }
            //end of image handler

            DB::beginTransaction();

            $user->update($input);

            if(isset($input['method'])) {
                // Get the user with their user accounts
                $user = User::find($userId);

                if(strtolower($input['method']) == "cash") {
                    $input['method'] = 2;
                } else {
                    $input['method'] = 1;
                }

                foreach ($user->userAccount as $userAccount) {
                    if ($userAccount->kind === 'pokok') {
                        $userAccount->transaction()->update([
                            'method' => $input['method'],
                            'image' => $buktiSimpanan
                        ]);
                    }
                }
            }

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
