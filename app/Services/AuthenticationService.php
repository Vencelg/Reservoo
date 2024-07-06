<?php

namespace App\Services;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use App\Services\Interfaces\AuthenticationServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationService implements AuthenticationServiceInterface
{

    /**
     * @param LoginUserRequest $request
     * @return RedirectResponse
     */
    public function handleLogin(LoginUserRequest $request): RedirectResponse
    {
        $user = User::where('email', $request->input('email'))->first();
        if (!($user instanceof User) || !Hash::check($request->input('password'), $user->password)) {
            return back()->with([
                'errors' => 'Invalid Credentials',
            ])->withInput([
                'email' => $request->input('email')
            ]);
        }

        Auth::login($user, $request->has('remember_me'));

        return redirect()->route('home');
    }

    /**
     * @param RegisterUserRequest $request
     * @return RedirectResponse
     */
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

    /**
     * @return RedirectResponse
     */
    public function handleLogout(): RedirectResponse
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
