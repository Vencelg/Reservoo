<?php

namespace App\Services;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use App\Services\Definitions\AuthenticationServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthenticationService implements Definitions\AuthenticationServiceInterface
{

    public function handleLogin(LoginUserRequest $request): View|RedirectResponse
    {
        $user = User::where('email', $request->input('email'))->first();
        if (!($user instanceof User) || !Hash::check($request->input('password'), $user->password)) {
            return back()->with([
                'error' => 'Invalid Credentials'
            ]);
        }

        Auth::login($user);

        return view('livewire.restaurants.index');
    }

    public function handleRegister(RegisterUserRequest $request): void
    {
        $user = new User([
            'name' => $request->input('firstname') . ' ' . $request->input('lastname'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
        $user->save();

        Auth::login($user);
    }
}
