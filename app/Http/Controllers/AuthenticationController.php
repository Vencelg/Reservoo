<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Services\Definitions\AuthenticationServiceInterface;
use Illuminate\View\View;

class AuthenticationController extends Controller
{
    public function __construct(
        protected AuthenticationServiceInterface $authenticationService
    )
    {
    }

    public function login(): View
    {
        return view('authentication.login');
    }

    public function handleLogin(LoginUserRequest $request): View
    {
        return $this->authenticationService->handleLogin($request);
    }

    public function register(): View
    {
        return view('authentication.register');
    }

    public function handleRegister(RegisterUserRequest $request): View
    {
        $this->authenticationService->handleRegister($request);

        return view('livewire.restaurants.index', [
            'message' => 'Successfully Registered'
        ]);
    }
}
