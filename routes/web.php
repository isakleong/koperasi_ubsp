<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
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

Route::get('/tes/aja', function () {
    return view('auth.mail-verification');
})->name('tes-aja');

//USER AUTHENTICATION (LOGIN AND REGISTER)
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerProcess'])->name('register');
Route::get('/email/verify', function(){
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');
//END OF USER AUTHENTICATION (LOGIN AND REGISTER)


Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('forgot-password');

Route::middleware(['auth', 'verified'])->group(function() {
    //GET REQUEST
    Route::get('/', [MainController::class, 'index']);
    Route::get('/simpanan/pengajuan', [MainController::class, 'addSimpanan'])->name('simpanan-add');
    Route::get('/simpanan/mutasi', [MainController::class, 'mutationSimpanan'])->name('simpanan-mutation');
    Route::get('/simpanan/rekap', [MainController::class, 'recapSimpanan'])->name('simpanan-recap');

    Route::get('/tabungan/pengajuan', [MainController::class, 'addTabungan'])->name('tabungan-add');
    Route::get('/tabungan/mutasi', [MainController::class, 'mutationTabungan'])->name('tabungan-mutation');
    Route::get('/tabungan/rekap', [MainController::class, 'recapTabungan'])->name('tabungan-recap');

    Route::get('/kredit/pengajuan', [MainController::class, 'addKredit'])->name('credit-add');
    Route::get('/angsuran/pengajuan', [MainController::class, 'addAngsuran'])->name('credit-angsuran-add');
    Route::get('/kredit/rekap', [MainController::class, 'recapCredit'])->name('credit-recap');
    Route::get('/angsuran/rekap', [MainController::class, 'recapAngsuran'])->name('credit-angsuran-recap');

    Route::get('/pengaturan/profile', [MainController::class, 'showEditProfile'])->name('profile-setting');
    Route::get('/pengaturan/password', [MainController::class, 'showEditPassword'])->name('password-setting');

    //POST REQUEST
    Route::put('/pengaturan/profile/{id}', [MainController::class, 'editProfile'])->name('profile-setting-update');
    Route::post('/pengaturan/password', [MainController::class, 'editPassword'])->name('password-setting-update');
});