<?php

namespace App\Services\Interfaces;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Http\RedirectResponse;

interface AuthenticationServiceInterface
{
    /**
     * @param LoginUserRequest $request
     * @return RedirectResponse
     */
    public function handleLogin(LoginUserRequest $request): RedirectResponse;

    /**
     * @param RegisterUserRequest $request
     * @return RedirectResponse
     */
    public function handleRegister(RegisterUserRequest $request): RedirectResponse;

    /**
     * @return RedirectResponse
     */
    public function handleLogout(): RedirectResponse;
}
