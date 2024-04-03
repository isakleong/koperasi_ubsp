<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AccountCategoryController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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
})->middleware('auth.user')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    $user = $request->user();
    // Update the joinDate column
    $user->update(['status' => 1]);
    return redirect('/');
})->middleware(['auth.user', 'signed'])->name('verification.verify');

// Route::get('/email/verify/resend', [AuthController::class, 'resendVerificationEmail'])->name('verification.resend');
Route::post('/email/verification-notification', function (Request $request) {
    $userId = $request->input('user_id');
    if ($userId && $user = User::find($userId)) {
        $user->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    } else {
        // return redirect('/login')->with('error', 'Please log in to resend verification email.');
        return back()->with('message', 'Verification link error!');
    }

    // $request->user()->sendEmailVerificationNotification();
    // return back()->with('message', 'Verification link sent!');
})->middleware(['auth.admin', 'throttle:6,1'])->name('verification.send');
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

Route::get('/test', function () {
    return view('admin.report.anggota-report');
})->name('tes-aja');

//USER
Route::middleware(['auth.user', 'verified'])->group(function() {
    //UNVERIFIED
    Route::get('/user/activation', [MainController::class, 'userActivation'])->name('user.activation');

    //GET REQUEST
    Route::get('/', [MainController::class, 'index']);
    Route::get('/simpanan/pengajuan', [MainController::class, 'showFormData'])->name('add.simpanan');
    Route::get('/simpanan/rekap', [MainController::class, 'showFormData'])->name('recap.simpanan');

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

    Route::resource('/company', CompanyController::class);
    Route::resource('/config', ConfigController::class);

    //ANGGOTA
    Route::get('/menu/user', [AdminController::class, 'showUserMenu'])->name('user');
    Route::resource('/user', UserController::class);
    Route::post('user/{id}/acc', [UserController::class, 'accData'])->name('acc.user');
    Route::post('user/{id}/reject', [UserController::class, 'rejectData'])->name('reject.user');

    //AKUN DAN KATEGORI
    Route::resource('/account_category', AccountCategoryController::class);
    Route::resource('/account', AccountController::class);

    //TRANSAKSI
    Route::get('/menu/transaction', [AdminController::class, 'showFormData'])->name('transaction');
    Route::get('/transaction/ubsp', [AdminController::class, 'showFormData'])->name('ubsp.transaction');
    Route::get('/transaction/member', [AdminController::class, 'showFormData'])->name('member.transaction');


    //SIMPANAN
    Route::get('/menu/simpanan', [AdminController::class, 'showSimpananMenu'])->name('simpanan');
    Route::get('/simpanan/setoran', [AdminController::class, 'showFormData'])->name('add.simpanan.deposit');
    Route::get('/simpanan/review', [AdminController::class, 'showFormData'])->name('review.simpanan');
    Route::get('/simpanan/review/recap', [AdminController::class, 'showFormData'])->name('recap.simpanan');
    Route::get('/simpanan/review/approval', [AdminController::class, 'showFormData'])->name('approval.simpanan');

    // Route::get('/simpanan/setoran/review', [AdminController::class, 'showFormData'])->name('review.simpanan.deposit');
    Route::get('/simpanan/setoran/review/{transaction:docId}', [AdminController::class, 'showFormData'])->name('detail.review.simpanan.deposit');
    Route::get('/simpanan/penarikan', [AdminController::class, 'showFormData'])->name('add.simpanan.withdrawal');
    Route::post('/simpanan/setoran', [AdminController::class, 'storeSimpananDeposit'])->name('store.simpanan.deposit');
    Route::post('/simpanan/penarikan', [AdminController::class, 'storeSimpananWithdrawal'])->name('store.simpanan.withdrawal');
    
    //KREDIT
    Route::get('/menu/kredit', [AdminController::class, 'showKreditMenu'])->name('kredit');

    //ANGSURAN
    Route::get('/menu/angsuran', [AdminController::class, 'showAngsuranMenu']);

    //EXPORT DATA
    Route::post('/user/export', [ReportController::class, 'exportData'])->name('export.user');

    //LAPORAN
    Route::resource('/journal', JournalController::class);

    //checker
    Route::get('/simpanan/check', [AdminController::class, 'checkSimpananWajib'])->name('checkSimpanan');
    Route::get('/xxx', [AccountController::class, 'getAccountsByCategory']);
});
//END OF ADMIN