<?php

namespace App\Services\Interfaces;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Http\RedirectResponse;

interface AuthenticationServiceInterface
{
    public function handleLogin(LoginUserRequest $request): RedirectResponse;
    public function handleRegister(RegisterUserRequest $request): RedirectResponse;
    public function handleLogout(): RedirectResponse;
}
