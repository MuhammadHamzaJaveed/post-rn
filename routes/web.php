<?php

use App\Http\Livewire\Register;
use App\Http\Controllers\ForgetPassword;
use App\Http\Controllers\BopController;
use App\Http\Livewire\UhsForms\Dashboard;
use App\Http\Livewire\UhsForms\ApplicationStatus;
use App\Http\Livewire\UhsForms\UhsMainForm;
use App\Http\Livewire\UhsForms\Otp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\MeritListFromCollege;
use App\Models\SelectionList;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();

        if ($user->submitted_at && $user->otps != null && $user->otps->is_verified == 0) {
        // use for after dashboard
        /*if ($user->submitted_at != null) {*/
            return redirect('/form-dashboard');
        }
        return redirect('form');
    } else {
        return view('auth.login');
    }
});

Route::get('/admin/login', function () {
    return redirect(route('login'));
})->name('filament.auth.login');

Route::get('/register', Register::class)->name('register-new-user');

// Apply the 'auth', 'admin', and 'auth_session' middleware to the /form route.
/*Route::middleware(['auth','admin','verified', config('jetstream.auth_session'), 'backToForm'])*/
Route::middleware(['auth','super_admin','verified', config('jetstream.auth_session'), 'backToForm'])
    ->get('/form', UhsMainForm::class)
    ->name('uhs-form');
Route::middleware(['auth','super_admin', 'verified',config('jetstream.auth_session'), 'checkSubmittedAt'])
    ->group(function () {
        Route::get('/form-dashboard', Dashboard::class)->name('uhs-form-dashboard');
        Route::get('/application-status', ApplicationStatus::class)->name('uhs-form-application-status');
        Route::get('/otp', Otp::class)->name('uhs-form-otp');
        Route::get('/challan/download/{type_id}', [BopController::class,'createChallan'])->name('download.challan');
    });

Route::middleware('auth')->group(function (){
    Route::get('/download-college-affidavit/{id}',[BopController::class,'downloadCollegeAffidavit'])->name('college.affidavit.download');
});



Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

/*
|--------------------------------------------------------------------------
| Forget Password Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', [ForgetPassword::class, 'forget_password'])->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', [ForgetPassword::class, 'rest_password'])->middleware('guest')->name('password.update');
