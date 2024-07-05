<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\TableController;
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

Route::middleware('auth')->prefix('reservations')->group(function () {
    Route::get('/', [ReservationController::class, 'authUserList'])->name('reservations.authUserList');
    Route::post('/', [ReservationController::class, 'store'])->name('reservations.store');
    Route::delete('/{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
});

Route::middleware('auth')->prefix('restaurants')->group(function () {
    Route::get('/', [RestaurantController::class, 'list'])->name('home');
    Route::get('/{id}', [RestaurantController::class, 'detail'])->name('restaurant.detail');
    Route::get('/{id}/tables', [TableController::class, 'list'])->name('tables.list');
});
