<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

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

            $input['password'] = Hash::make($input['password']);
            $input['memberId'] = 'MUBSP' . date('Ymd') . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);

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

            $user = User::create($input);
            Image::make($imageKTP)->resize(1024, 768, function ($constraint) {
                $constraint->aspectRatio();
            })->save($input['ktp']);

            Image::make($imageKK)->resize(1024, 768, function ($constraint) {
                $constraint->aspectRatio();
            })->save($input['kk']);

            event(new Registered($user));

            Auth::login($user);

            return redirect('/email/verify');

        } catch (\Exception $e) {
            // dd('masuk catch');
            //throw $th;
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
