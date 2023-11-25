<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
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

    $user = $request->user();

    // Update the joinDate column
    // $user->update(['joinDate' => now()]); // Set 'joinDate' to the current timestamp
 
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');
//END OF USER AUTHENTICATION (LOGIN AND REGISTER)

//RESET PASSWORD
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
 
    $status = Password::sendResetLink(
        $request->only('email')
    );
 
    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', [AuthController::class, 'resetPassword'])->middleware('guest')->name('password.update');

//END OF RESET PASSWORD

// Route::get('/test', [MainController::class, 'test']);

Route::middleware(['auth', 'verified'])->group(function() {
    //GET REQUEST
    Route::get('/', [MainController::class, 'index']);
    Route::get('/simpanan/pengajuan', [MainController::class, 'addSimpanan'])->name('add-simpanan');
    Route::get('/simpanan/rekap', [MainController::class, 'recapSimpanan'])->name('recap-simpanan');

    Route::get('/tabungan/pengajuan', [MainController::class, 'addTabungan'])->name('add-tabungan');
    Route::get('/tabungan/rekap', [MainController::class, 'recapTabungan'])->name('recap-tabungan');

    Route::get('/kredit/pengajuan', [MainController::class, 'addKredit'])->name('add-kredit');
    Route::get('/angsuran/pengajuan', [MainController::class, 'addAngsuran'])->name('add-angsuran');
    Route::get('/kredit/rekap', [MainController::class, 'recapKredit'])->name('recap-kredit');
    Route::get('/angsuran/rekap', [MainController::class, 'recapAngsuran'])->name('recap-angsuran');

    Route::get('/pengaturan/profile', [MainController::class, 'showEditProfile'])->name('edit-profile');
    Route::get('/pengaturan/password', [MainController::class, 'showEditPassword'])->name('edit-password');

    //POST REQUEST
    Route::put('/pengaturan/profile/{id}', [MainController::class, 'editProfile'])->name('profile-update');
    Route::post('/pengaturan/password', [MainController::class, 'editPassword'])->name('password-update');
});