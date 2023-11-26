<?php

namespace App\Http\Controllers;

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
use Illuminate\Support\Facades\Password;

class AuthController extends Controller {
    public function register() {
        return view('auth.register');
    }

    public function registerProcess(Request $request) {
        // return redirect('/login')->withSuccess('Post Created Successfully!');

        $request->validate([
            // 'fname' => 'required',
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
            // $input['password'] = Hash::make($input['password']);

            if($imageKTP = $request->file('ktp')) {
                $destinationPath = 'image/upload/';
                $fileName = pathinfo($imageKTP->getClientOriginalName(), PATHINFO_FILENAME);
                $generatedID = $fileName.hexdec(uniqid())."-".time(). ".";
                $imageName = $generatedID.$imageKTP->getClientOriginalExtension();            

                $input['ktp'] = $destinationPath.$imageName;
            }

            if($imageKK = $request->file('kk')) {
                $destinationPath = 'image/upload/';
                $fileName = pathinfo($imageKK->getClientOriginalName(), PATHINFO_FILENAME);
                $generatedID = $fileName.hexdec(uniqid())."-".time(). ".";
                $imageName = $generatedID.$imageKK->getClientOriginalExtension();

                $input['kk'] = $destinationPath.$imageName;
            }

            $buktiSimpanan = "";
            if($imageSimpanan = $request->file('simpanan')) {
                $destinationPath = 'image/upload/';
                $fileName = pathinfo($imageSimpanan->getClientOriginalName(), PATHINFO_FILENAME);
                $generatedID = $fileName.hexdec(uniqid())."-".time(). ".";
                $imageName = $generatedID.$imageSimpanan->getClientOriginalExtension();

                $buktiSimpanan = $destinationPath.$imageName;
            }
            $input["status"] = 1;
            $user = User::create($input);


            Image::make($imageKTP)->resize(1024, 768, function ($constraint) {
                $constraint->aspectRatio();
            })->save($input['ktp']);

            Image::make($imageKK)->resize(1024, 768, function ($constraint) {
                $constraint->aspectRatio();
            })->save($input['kk']);

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
            $userAccount = UserAccount::create($arrUserAccount);
            
            //insert into transaction
            $arrTransaction = [];
            $arrTransaction["accountId"] = $arrUserAccount["accountId"];
            $arrTransaction["kind"] = "pokok";
            $arrTransaction["total"] = $nominal;
            $arrTransaction["method"] = 1;
            $arrTransaction["transactionDate"] = date('Y-m-d H:i:s');
            $arrTransaction["image"] = $buktiSimpanan;
            $arrTransaction["notes"] = "registrasi simpanan pokok";
            $arrTransaction["status"] = 1;
            $transaction = Transaction::create($arrTransaction);

            event(new Registered($user));

            Auth::login($user);

            return redirect('/email/verify');

        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function login() {
        return view('auth.login');
    }

    public function authenticate(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        // check salt
        $user = User::where('email', $request->email)->first();
        if($user) {
            $id = substr($user->memberId, -1);
            $salt = substr($user->memberId, 18, 1);
            
            $carbonDate = Carbon::parse($user->registDate);
            $hour = $carbonDate->format('H');
            $minute = $carbonDate->format('i');
            $second = $carbonDate->format('s');
            $char1 = ($minute + $hour + ($salt * 7)) % 16;
            $char2 = ($minute + $second + ($salt * 7)) % 16;
            $char3 = ($minute + ord($id[0]) + ($salt * 7)) % 16;
            $res = strtoupper(dechex($char1)) . strtoupper(dechex($char2)) . $salt . strtoupper(dechex($char3));
            $request['password'] = $res.$request['password'];

            $credentials = $request->only('email','password');

            if(Auth::attempt($credentials)){
                $request->session()->regenerate();
                // return redirect('auth.login');
                return redirect('/');
            }
        } else {
            return redirect()->back()->withErrors([
                'loginError' => 'Email atau password salah, silahkan coba lagi'
            ]);
        }
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

    public function logout() {
        Auth::logout();
        return redirect('/login');
    }

}
