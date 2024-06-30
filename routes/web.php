<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\RestaurantController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->prefix('authentication')->group(function () {
    Route::get('/login', [AuthenticationController::class, 'login'])->name('login');
    Route::post('/login', [AuthenticationController::class, 'handleLogin']);
    Route::get('/register', [AuthenticationController::class, 'register'])->name('register');
    Route::post('/register', [AuthenticationController::class, 'handleRegister']);
});

Route::middleware('auth')->prefix('authentication')->group(function () {
    Route::get('/logout', [AuthenticationController::class, 'handleLogout'])->name('logout');
});

Route::middleware('auth')->prefix('restaurants')->group(function () {
    Route::get('/', [RestaurantController::class, 'list'])->name('home');
    Route::get('/{id}', [RestaurantController::class, 'detail'])->name('restaurant.detail');
});
