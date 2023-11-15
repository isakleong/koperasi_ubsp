<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {
    public function register() {
        return view('auth.register');
    }

    public function registerProcess(Request $request) {
        return redirect('/login')->withSuccess('Post Created Successfully!');
        
        // $user = User::create([
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        //     'mothername' => $request->mothername,
        //     'memberId' => 'M001',
        //     'fname' => $request->fname,
        //     'lname' => $request->lname,
        //     'birthplace' => $request->birthplace,
        //     'birthdate' => $request->birthdate,
        //     'address' => $request->address,
        //     'workAddress' => $request->workAddress,
        //     'phone' => $request->phone
        //     // 'ktp' => $request->ktp,
        //     // 'kk' => $request->kk
        // ]);

        // event(new Registered($user));

        // Auth::login($user);

        // return redirect('/email/verify');
    }

    public function login() {
        return view('auth.login');
    }

    public function authenticate(Request $request) {
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('name','password');

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            // return redirect('auth.login');
            return redirect('/');
        }

        return redirect()->back()->withErrors([
            'loginError' => 'Wrong username or password'
        ]);
    }

    public function logout() {
        Auth::logout();
        return redirect('/login');
    }

}
