<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\AccountCategoryController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;

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
    $user->update(['status' => 1]);
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

// Route::get('/email/verify/resend', [AuthController::class, 'resendVerificationEmail'])->name('verification.resend');
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
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

//USER
Route::middleware(['auth.user', 'verified'])->group(function() {
    //UNVERIFIED
    Route::get('/user/activation', [MainController::class, 'userActivation'])->name('user.activation');

    //GET REQUEST
    Route::get('/', [MainController::class, 'index']);
    Route::get('/simpanan/pengajuan', [MainController::class, 'showFormData'])->name('add.simpanan');
    Route::get('/simpanan/rekap', [MainController::class, 'showFormData'])->name('recap.simpanan');

    Route::get('/tabungan/pengajuan', [MainController::class, 'showFormData'])->name('add.tabungan');
    Route::get('/tabungan/rekap', [MainController::class, 'showFormData'])->name('recap.tabungan');

    Route::get('/kredit/pengajuan', [MainController::class, 'showFormData'])->name('add.kredit');
    Route::get('/angsuran/pengajuan', [MainController::class, 'showFormData'])->name('add.angsuran');
    Route::get('/kredit/rekap', [MainController::class, 'showFormData'])->name('recap.kredit');
    Route::get('/angsuran/rekap', [MainController::class, 'showFormData'])->name('recap.angsuran');

    Route::get('/pengaturan/profile', [MainController::class, 'showFormData'])->name('edit.profile');
    Route::get('/pengaturan/password', [MainController::class, 'showFormData'])->name('edit.password');
    //END OF GET REQUEST

    //POST REQUEST
    Route::post('/user/activation', [MainController::class, 'storeUserActivation'])->name('store.user.activation');

    Route::post('/simpanan/pengajuan', [MainController::class, 'storeSimpanan'])->name('store.simpanan');
    Route::post('/simpanan/rekap', [MainController::class, 'filterRecapSimpanan'])->name('filter.recap.simpanan');

    Route::post('/tabungan/pengajuan', [MainController::class, 'storeTabungan'])->name('store.tabungan');
    Route::post('/tabungan/rekap', [MainController::class, 'filterRecapTabungan'])->name('filter.recap.tabungan');

    Route::post('/simulasi/kredit', [MainController::class, 'simulasiKredit'])->name('simulasi.kredit');
    Route::post('/kredit/pengajuan', [MainController::class, 'storeKredit'])->name('store.kredit');
    Route::post('/kredit/rekap', [MainController::class, 'filterRecapKredit'])->name('filter.recap.kredit');
    Route::post('/angsuran/rekap', [MainController::class, 'storeAngsuran'])->name('store.angsuran');

    Route::put('/pengaturan/profile', [MainController::class, 'editProfile'])->name('profile-update');
    Route::post('/pengaturan/password', [MainController::class, 'editPassword'])->name('password-update');
});
//END OF USER

//ADMIN

Route::get('/admin/login', [AuthController::class, 'loginAdmin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'authenticateAdmin']);
Route::get('/admin/logout', [AuthController::class, 'logoutAdmin']);

Route::middleware(['auth.admin'])->prefix('admin')->name('admin.')->group(function() {
    //GET REQUEST
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    // Route::get('/anggota', [AdminController::class, 'anggota'])->name('anggota');
    // Route::get('/anggota/add', [AdminController::class, 'addAnggota'])->name('add.anggota');
    // Route::get('/anggota/edit', [AdminController::class, 'editAnggota'])->name('edit.anggota');
    // // Route::post('/anggota/edit', [AdminController::class, 'filterEditAnggota'])->name('filter.edit.anggota');
    // Route::get('/anggota/edit/{users:memberId}', [AdminController::class, 'getAnggotaDetail'])->name('show.edit.detail');

    // //POST REQUEST
    // Route::post('/anggota/add', [AdminController::class, 'storeAnggota'])->name('store.anggota');
    // Route::post('/anggota/edit', [AdminController::class, 'updateAnggota'])->name('update.anggota');

    Route::resource('/company', CompanyController::class);
    Route::resource('/config', ConfigController::class);

    Route::get('/menu/user', [AdminController::class, 'showUserMenu']);
    Route::resource('/user', UserController::class);
    Route::post('user/{id}/acc', [UserController::class, 'accData'])->name('acc.user');
    Route::post('user/{id}/reject', [UserController::class, 'rejectData'])->name('reject.user');

    // Route::post('/email/verification-notification', function (Request $request) {
    //     $request->user()->sendEmailVerificationNotification();
     
    //     return back()->with('message', 'Verification link sent!');
    // })->middleware(['auth', 'throttle:6,1'])->name('verification.send');

    Route::resource('/account_category', AccountCategoryController::class);
    Route::resource('/account', AccountController::class);

    //SIMPANAN
    Route::get('/menu/simpanan', [AdminController::class, 'showSimpananMenu']);
    Route::get('/simpanan/setoran', [AdminController::class, 'showFormData'])->name('add.simpanan.deposit');
    Route::get('/simpanan/setoran/review', [AdminController::class, 'showFormData'])->name('review.simpanan.deposit');
    Route::get('/simpanan/setoran/review/{transaction:docId}', [AdminController::class, 'showFormData'])->name('detail.review.simpanan.deposit');
    Route::get('/simpanan/penarikan', [AdminController::class, 'showFormData'])->name('add.simpanan.withdrawal');
    Route::post('/simpanan/setoran', [AdminController::class, 'storeSimpananDeposit'])->name('store.simpanan.deposit');
    Route::post('/simpanan/penarikan', [AdminController::class, 'storeSimpananWithdrawal'])->name('store.simpanan.withdrawal');

    //TABUNGAN
    Route::get('/menu/tabungan', [AdminController::class, 'showTabunganMenu']);
    

    //KREDIT
    Route::get('/menu/kredit', [AdminController::class, 'showKreditMenu']);

    //ANGSURAN
    Route::get('/menu/angsuran', [AdminController::class, 'showAngsuranMenu']);

    
    //checker
    Route::get('/simpanan/check', [AdminController::class, 'checkSimpananWajib'])->name('checkSimpanan');
    // Route::get('/coba', [AdminController::class, 'getReviewSimpananDeposit']);
    Route::get('/xxx', [AccountController::class, 'getAccountsByCategory']);
});
//END OF ADMIN