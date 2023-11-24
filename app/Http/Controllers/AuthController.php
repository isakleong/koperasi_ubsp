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

            $nominal = $input['nominal'];
            $nominal = str_replace(',', '', $nominal);

            $input['password'] = Hash::make($input['password']);
            
            $uuid4 = Uuid::uuid4()->getHex();
            $input['memberId'] = 'MUBSP' . date('Ymd') . $uuid4;

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
                $fileName = pathinfo($imageKK->getClientOriginalName(), PATHINFO_FILENAME);
                $generatedID = $fileName.hexdec(uniqid())."-".time(). ".";
                $imageName = $generatedID.$imageSimpanan->getClientOriginalExtension();

                $buktiSimpanan = $destinationPath.$imageName;
            }

            $input['registDate'] = date('Y-m-d H:i:s');

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
            $arrUserAccount["kind"] = "pokok";
            $arrUserAccount["balance"] = $nominal;
            $userAccount = UserAccount::create($arrUserAccount);
            
            //insert into transaction
            $arrTransaction = [];
            $arrTransaction["accountId"] = $userAccount->accountId;
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

    public function generateMemberId($user)
    {
        $indexNo = sprintf("%04d", $user->id);
        $joinDate = date('ymd', strtotime($user->created_at));

        // Gabungkan semua elemen untuk membentuk memberId
        $memberId = "MUBSP" . $joinDate . $indexNo;

        return $memberId;
    }

    public function login() {
        return view('auth.login');
    }

    public function authenticate(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email','password');

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            // return redirect('auth.login');
            return redirect('/');
        }

        return redirect()->back()->withErrors([
            'loginError' => 'Email atau password salah, silahkan coba lagi'
        ]);
    }

    public function logout() {
        Auth::logout();
        return redirect('/login');
    }

}
