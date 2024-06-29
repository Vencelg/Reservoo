<?php

namespace App\Services;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationService implements Interfaces\AuthenticationServiceInterface
{

    public function handleLogin(LoginUserRequest $request): RedirectResponse
    {
        $user = User::where('email', $request->input('email'))->first();
        if (!($user instanceof User) || !Hash::check($request->input('password'), $user->password)) {
            return back()->with([
                'errors' => 'Invalid Credentials'
            ]);
        }

        Auth::login($user, $request->has('remember_me'));

        return redirect()->route('home');
    }

    public function handleRegister(RegisterUserRequest $request): RedirectResponse
    {
        $user = new User([
            'name' => $request->input('firstname') . ' ' . $request->input('lastname'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
        $user->save();

        Auth::login($user);

        return redirect()->route('home');
    }

    public function handleLogout(): RedirectResponse
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
