<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Services\Interfaces\AuthenticationServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthenticationController extends Controller
{
    /**
     * @param AuthenticationServiceInterface $authenticationService
     */
    public function __construct(
        protected AuthenticationServiceInterface $authenticationService
    )
    {
    }

    /**
     * @return View
     */
    public function login(): View
    {
        return view('authentication.login');
    }

    /**
     * @param LoginUserRequest $request
     * @return RedirectResponse
     */
    public function handleLogin(LoginUserRequest $request): RedirectResponse
    {
        return $this->authenticationService->handleLogin($request);
    }

    /**
     * @return View
     */
    public function register(): View
    {
        return view('authentication.register');
    }

    /**
     * @param RegisterUserRequest $request
     * @return RedirectResponse
     */
    public function handleRegister(RegisterUserRequest $request): RedirectResponse
    {
        return $this->authenticationService->handleRegister($request);
    }

    /**
     * @return RedirectResponse
     */
    public function handleLogout(): RedirectResponse
    {
        return $this->authenticationService->handleLogout();
    }
}
