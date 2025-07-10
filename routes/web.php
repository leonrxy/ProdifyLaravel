<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');
Route::get('/login', [AuthController::class, 'showLoginForm'])->middleware('guest')->name('login');
Route::post('/login/ajax', [AuthController::class, 'loginAjax']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/products', ProductController::class);
    Route::resource('/users', UserController::class);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Forgot Password
Route::get('password/forgot', [AuthController::class, 'showForgotPasswordForm'])
    ->name('password.forgot');