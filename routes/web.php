<?php

use App\Http\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::prefix('authentication')->middleware('guest')->group(function () {
    Volt::route('login', 'authentication.login')->name('login');
    Volt::route('register', 'authentication.register')->name('register');
    Route::post('login', [AuthenticationController::class, 'handleLogin']);
    Route::post('register', [AuthenticationController::class, 'handleRegister']);
});

Route::middleware('auth')->group(function () {
    Volt::route('/', 'restaurants.index');
});
