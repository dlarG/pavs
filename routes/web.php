<?php

use App\Http\Controllers\Auth\VerificationController;
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

Route::middleware(['auth', 'verified', 'is.doctor'])->group(function () {
    Route::get('/doctor/dashboard', function () {
        return view('doctor.dashboard');
    })->name('doctor.dashboard');
});