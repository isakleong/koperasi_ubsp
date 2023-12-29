<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\UserAccount;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;

class AdminController extends Controller
{
    public function index() {
        return view('admin.index');
    }

    public function showUserMenu() {
        return view('admin.anggota');
    }

    public function showSimpananMenu() {
        return view('admin.simpanan');
    }

    public function showTabunganMenu() {
        return view('admin.tabungan');
    }

    public function showKreditMenu() {
        return view('admin.kredit');
    }

    public function showAngsuranMenu() {
        return view('admin.angsuran');
    }

    public function showFormData() {
        $parameter = Route::currentRouteName();

        if ($parameter == "admin.add.simpanan.deposit") {
            return view('admin.simpanan-deposit-create');
        } elseif ($parameter == "add.simpanan.withdrawal") {
            return view('admin.kredit');
        }
    }

}
