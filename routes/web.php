<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('forgot-password');

Route::get('/', function () {
    return view('main.index');
}); 

Route::get('/saving/add', function () {
    return view('main.saving-add');
})->name('saving-add');

Route::get('/saving/recap', function () {
    return view('main.saving-recap');
})->name('saving-recap');

Route::get('/credit/add', function () {
    return view('main.credit-add');
})->name('credit-add');

Route::get('/credit-angsuran/add', function () {
    return view('main.credit-angsuran-add');
})->name('credit-angsuran-add');

Route::get('/credit/recap', function () {
    return view('main.credit-recap');
})->name('credit-recap');

Route::get('/credit-angsuran/recap', function () {
    return view('main.credit-angsuran-recap');
})->name('credit-angsuran-recap');

Route::get('/setting', function () {
    return view('main.setting');
})->name('setting');

// Route::middleware(['auth'])->group(function() {
//     Route::get('/', function () {
//         return view('main.index');
//     }); 
// });