<?php

use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Client\AppointmentController as ClientAppointmentController;
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

     Route::get('/appointments', [ClientAppointmentController::class, 'index'])->name('client.appointments.index');
    Route::get('/appointments/create', [ClientAppointmentController::class, 'create'])->name('client.appointments.create');
    Route::post('/appointments', [ClientAppointmentController::class, 'store'])->name('client.appointments.store');
    Route::get('/appointments/{id}', [ClientAppointmentController::class, 'show'])->name('client.appointments.show');
    Route::get('/appointments/{id}/edit', [ClientAppointmentController::class, 'edit'])->name('client.appointments.edit');
    Route::put('/appointments/{id}', [ClientAppointmentController::class, 'update'])->name('client.appointments.update');
    Route::delete('/appointments/{id}', [ClientAppointmentController::class, 'destroy'])->name('client.appointments.destroy');
    Route::get('/appointments/available-times', [ClientAppointmentController::class, 'getAvailableTimes'])->name('client.appointments.available-times');
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

    Route::get('/appointments/json', [App\Http\Controllers\Doctor\AppointmentController::class, 'allJson']);
    Route::get('/appointments/day/{date}', [App\Http\Controllers\Doctor\AppointmentController::class, 'appointmentsByDate']);
    // Route::match(['get', 'post'], '/reports', [ReportController::class, 'index'])->name('reports.index');
    // Route::get('/reports/export', [ReportController::class, 'exportPDF'])->name('reports.export');
});