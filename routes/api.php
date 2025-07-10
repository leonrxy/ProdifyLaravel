<?php

use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiDashboardController;
use App\Http\Controllers\Api\ApiUserController;
use App\Http\Controllers\Api\ApiProductController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [ApiAuthController::class, 'login']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [ApiAuthController::class, 'logout']);
    });
});

Route::group(['middleware' => 'role:superadmin,admin,user'], function () {
    // Routes untuk Dashboard
    Route::get('dashboard', [ApiDashboardController::class, 'index']);
    // Routes untuk User Management
    Route::get('users', [ApiUserController::class, 'index'])->middleware('role:superadmin,admin');
    Route::get('users/{id}', [ApiUserController::class, 'show'])->middleware('role:superadmin,admin,user');
    Route::post('users', [ApiUserController::class, 'store'])->middleware('role:superadmin,admin');
    Route::put('users/{id}', [ApiUserController::class, 'update'])->middleware('role:superadmin,admin');
    Route::delete('users/{id}', [ApiUserController::class, 'destroy'])->middleware('role:superadmin,admin');

    // Routes untuk Product Management
    Route::get('products', [ApiProductController::class, 'index'])->middleware('role:superadmin,admin,user');
    Route::get('products/{id}', [ApiProductController::class, 'show'])->middleware('role:superadmin,admin,user');
    Route::post('products', [ApiProductController::class, 'store'])->middleware('role:superadmin,admin');
    Route::put('products/{id}', [ApiProductController::class, 'update'])->middleware('role:superadmin,admin');
    Route::delete('products/{id}', [ApiProductController::class, 'destroy'])->middleware('role:superadmin,admin');
});
