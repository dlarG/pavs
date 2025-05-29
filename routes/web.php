<?php

use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Doctor\AppointmentController;
use App\Http\Controllers\Doctor\ReportController;
use App\Http\Controllers\Doctor\StaffController;
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



Route::get('/', [\App\Http\Controllers\Auth\AuthController::class, 'showLoginForm'])
    ->name('auth.login');
Route::get('/register', [\App\Http\Controllers\Auth\AuthController::class, 'showRegisterForm'])
    ->name('auth.register');
Route::get('/services', [\App\Http\Controllers\Auth\AuthController::class, 'showServices'])
    ->name('services');

Route::post('/register', [\App\Http\Controllers\Auth\AuthController::class, 'register'])
    ->name('auth.register.submit');
Route::post('/login', [\App\Http\Controllers\Auth\AuthController::class, 'login'])
    ->name('auth.login.submit');

Route::post('/logout', [\App\Http\Controllers\Auth\AuthController::class, 'logout'])
    ->name('auth.logout');

Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::post('/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');




Route::middleware(['auth', 'verified', 'is.client'])->group(function () {
    Route::get('/client/dashboard', function () {
        return view('client.dashboard');
    })->name('client.dashboard');
});

Route::middleware(['auth', 'verified', 'is.staff'])->group(function () {
    Route::get('/staff/dashboard', function () {
        return view('staff.dashboard');
    })->name('staff.dashboard');
});





Route::middleware(['auth', 'verified', 'is.doctor'])->prefix('doctor')->name('doctor.')->group(function () {
    Route::view('/dashboard', 'doctor.dashboard')->name('dashboard');

    Route::resource('appointments', AppointmentController::class);
    Route::patch('appointments/{id}/status', [AppointmentController::class, 'updateStatus'])->name('appointments.updateStatus');


    Route::resource('staff', StaffController::class);

     Route::get('/profile', [\App\Http\Controllers\Doctor\ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [\App\Http\Controllers\Doctor\ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [\App\Http\Controllers\Doctor\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/delete', [\App\Http\Controllers\Doctor\ProfileController::class, 'destroy'])->name('profile.destroy');


    // Route::match(['get', 'post'], '/reports', [ReportController::class, 'index'])->name('reports.index');
    // Route::get('/reports/export', [ReportController::class, 'exportPDF'])->name('reports.export');
});