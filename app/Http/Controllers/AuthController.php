<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {
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
