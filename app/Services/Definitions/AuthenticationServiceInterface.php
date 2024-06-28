<?php

namespace App\Services\Definitions;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

interface AuthenticationServiceInterface
{
    public function handleLogin(LoginUserRequest $request): RedirectResponse|View;
    public function handleRegister(RegisterUserRequest $request): RedirectResponse|View;
}
