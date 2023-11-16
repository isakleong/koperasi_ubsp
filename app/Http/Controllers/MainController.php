<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index() {
        $user = Auth::user();

        return view('main.index', compact(['user']));
    }

    public function addSaving() {
        $user = Auth::user();

        return view('main.saving-add', compact(['user']));
    }

    public function addCredit() {
        $user = Auth::user();

        return view('main.credit-add', compact(['user']));
    }

    public function addAngsuran() {
        $user = Auth::user();

        return view('main.credit-angsuran-add', compact(['user']));
    }

    public function recapSaving() {
        $user = Auth::user();

        return view('main.saving-recap', compact(['user']));
    }

    public function recapCredit() {
        $user = Auth::user();

        return view('main.credit-recap', compact(['user']));
    }

    public function recapAngsuran() {
        $user = Auth::user();

        return view('main.credit-angsuran-recap', compact(['user']));
    }

    public function editProfile(Request $request) {
        $user = Auth::user();

        return view('main.profile-edit', compact(['user']));
    }

    public function editPassword(Request $request) {
        $user = Auth::user();

        return view('main.password-edit', compact(['user']));
    }
}
