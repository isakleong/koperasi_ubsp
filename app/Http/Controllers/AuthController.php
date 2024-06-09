<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserAccount;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller {
    public function register() {
        $configName = ['SIMPANAN POKOK', 'SIMPANAN WAJIB'];
        $configuration = Config::whereIn('name', $configName)->get();
        return view('auth.register', compact('configuration'));
    }

    public function resendVerificationEmail(Request $request) {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return redirect($this->redirectPath())->with('verified', true);
        }

        $user->sendEmailVerificationNotification();

        return back()->with('resent', true);
    }

    public function registerProcess(Request $request) {

        $request->validate([
            'ktp' => 'required',
            'kk' => 'required',
        ]);

        try {
            $input = $request->all();

            $input['registDate'] = date('Y-m-d H:i:s');

            $nominal = $input['nominal'];
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
            //end of image handler

            $input["status"] = 0;

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

                if($buktiSimpanan != "") {
                    Image::make($imageSimpanan)->resize(800, 600, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($buktiSimpanan);
                }

                if($buktiSimpanan != "") {
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
                }

                event(new Registered($user));

                Auth::login($user);
            });

            DB::commit();

            return redirect('/email/verify');
        } catch (\Exception $e) {
            DB::rollback();

            $pathDelete = public_path().'/'.'image/upload/'.$memberId;
            if (File::exists($pathDelete)) File::deleteDirectory($pathDelete);

            $errorMsg = $e->getMessage();
            return view('layout.error', compact(['errorMsg']));
        }
    }

    public function login() {
        return view('auth.login');
    }

    public function loginAdmin() {
        return view('auth.admin.login');
    }

    public function authenticate(Request $request) {
        $validator = Validator::make(
            [
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ],
            [
                'email' => 'required|email',
                'password' => 'required'
            ],
            [
                'email.required' => 'Email belum diisi',
                'email.email' => 'Format email tidak valid',
                'password.required' => 'Password belum diisi',
            ],
        );
            
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        
        try {
            // check salt
            $user = User::where('email', $request->email)->first();

            if($user) {
                $id = substr($user->memberId, -1);
                $salt = substr($user->memberId, 18, 1);
                
                $request['password'] = $request['password'];

                $credentials = $request->only('email','password');

                if(Auth::guard('web')->attempt($credentials)){
                    $request->session()->regenerate();
                    // return redirect('auth.login');
                    return redirect('/');
                } else {
                    return redirect()->back()->withErrors([
                        'loginError' => 'Email atau password salah, silahkan coba lagi'
                    ]);    
                }
            } else {
                return redirect()->back()->withErrors([
                    'loginError' => 'Email atau password salah, silahkan coba lagi'
                ]);
            }
            
        } catch (\Exception $e) {
            $errorMsg = $e->getMessage();
            return view('layout.error', compact(['errorMsg']));
        }
    }

    public function authenticateAdmin(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('username','password');

        if(Auth::guard('admin')->attempt($credentials)){
            $request->session()->regenerate();
            return redirect('/admin');
        }

        return redirect()->back()->withErrors([
            'loginError' => 'Email atau password salah, silahkan coba lagi'
        ]);
    }

    public function resetPassword(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
     
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                //secure new password with salt
                $memberId = $user->memberId;
                $id = substr($memberId, -1);
                $salt = substr($memberId, 18, 1);
                $carbonDate = Carbon::parse($user->registDate);
                $hour = $carbonDate->format('H');
                $minute = $carbonDate->format('i');
                $second = $carbonDate->format('s');

                $char1 = ($minute + $hour + ($salt * 7)) % 16;
                $char2 = ($minute + $second + ($salt * 7)) % 16;
                $char3 = ($minute + ord($id[0]) + ($salt * 7)) % 16;
                $res = strtoupper(dechex($char1)) . strtoupper(dechex($char2)) . $salt . strtoupper(dechex($char3));

                $user->forceFill([
                    'password' => Hash::make($res.$password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );
     
        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function logoutAdmin() {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }

    public function logout() {
        Auth::guard('web')->logout();
        return redirect('/login');
    }

}
