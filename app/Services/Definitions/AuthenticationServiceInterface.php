<?php

namespace App\Services\Definitions;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

interface AuthenticationServiceInterface
{
    public function handleLogin(LoginUserRequest $request): View|RedirectResponse;
    public function handleRegister(RegisterUserRequest $request): void;
}
