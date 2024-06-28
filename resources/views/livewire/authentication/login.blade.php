@extends('layout.app')
<div class="h-screen flex justify-center items-center">
    <x-form wire:submit="{{route('login')}}" method="post" no-separator class="w-1/4 bg-gray-100 rounded-xl p-5">
            <div class="w-fit m-auto">
                <div class="flex items-center gap-2">
                    <x-icon name="o-square-3-stack-3d" class="w-10 h-10 -mb-1 text-purple-500" />
                    <span class="font-bold text-4xl me-3 bg-gradient-to-r from-purple-500 to-pink-300 bg-clip-text text-transparent ">
                                Reservoo
                            </span>
                </div>
            </div>

            <div class="display-when-collapsed hidden mx-5 mt-4 lg:mb-6 h-[28px]">
                <x-icon name="s-square-3-stack-3d" class="w-6 -mb-1 text-purple-500" />
            </div>
        <x-input type="email" label="Email" placeholder="Your email..." wire:model="email" />
        <x-input type="password" label="Password" placeholder="Your password..." wire:model="password" />

        <div class="w-full flex justify-between items-center">
            <a href="{{route('register')}}" class="hover:text-primary" wire:navigate>Dont have an account yet?</a>
            <x-checkbox label="Remember me" wire:model="remember_me" />
        </div>

        <x-slot:actions>
            <x-button label="Login" class="btn-primary w-full" type="submit" spinner=""/>
        </x-slot:actions>
    </x-form>
</div>
