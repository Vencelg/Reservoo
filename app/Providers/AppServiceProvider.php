<?php

namespace App\Providers;

use App\Services\AuthenticationService;
use App\Services\Definitions\AuthenticationServiceInterface;
use App\Services\Definitions\RestaurantServiceInterface;
use App\Services\RestaurantService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(RestaurantServiceInterface::class, RestaurantService::class);
        $this->app->singleton(AuthenticationServiceInterface::class, AuthenticationService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
