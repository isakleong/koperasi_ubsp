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

class UserController extends Controller
{
    public function index()
    {
        return view('admin.anggota');
    }

    public function create()
    {
        return view('admin.anggota-add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ktp' => 'required',
            'kk' => 'required',
        ]);

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

    public function show(Request $request, User $user)
    {
        $status = $request->has('status') ? $request->input('status') : "aktif";

        if($status == "aktif") {
            $users = DB::table('users')
            ->where('status', 2)
            ->orderBy('id', 'desc')
            ->cursorPaginate(10);
        } elseif ($status == "non-aktif") {
            $users = DB::table('users')
            ->where('status', 3)
            ->orderBy('id', 'desc')
            ->cursorPaginate(10);
        } elseif ($status == "not-verified") {
            $users = DB::table('users')
            ->where('status', 0)
            ->orderBy('id')
            ->cursorPaginate(10);
        } elseif ($status == "not-acc") {
            $users = DB::table('users')
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->cursorPaginate(10);
        }

        if ($request->ajax()) {
            return view('admin.partials.filtered-data-anggota', compact('users'))->render();
        }

        return view('admin.anggota-edit', compact('users', 'request'));
    }

    public function edit($memberId)
    {
        $user = User::where('memberId', $memberId)->firstOrFail();

        return view('admin.anggota-edit-detail', compact('user'));
    }

    public function update(Request $request, $memberId)
    {
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'birthplace' => 'required',
            'birthdate' => 'required',
            'address' => 'required',
            'workAddress' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'mothername' => 'required',
            'method' => 'required',
        ]);

        try {
            $input = $request->all();

            $user = User::where('memberId', $memberId)->firstOrFail();

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
            //end of image handler

            DB::beginTransaction();

            // $user->update($input);
            $affectedRows = DB::table('users')
                ->where('memberId', $memberId)
                ->update([
                    'fname' => $input['fname'],
                    'lname' => $input['lname'],
                    'birthplace' => $input['birthplace'],
                    'birthdate' => $input['birthdate'],
                    'address' => $input['address'],
                    'workAddress' => $input['workAddress'],
                    'email' => $input['email'],
                    'phone' => $input['phone'],
                    'mothername' => $input['mothername'],
                    'method' => $input['method'],
            ]);

            DB::commit();

            return redirect('/admin/anggota/edit');
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
