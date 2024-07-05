<?php

namespace App\Providers;

use App\Services\AuthenticationService;
use App\Services\Interfaces\AuthenticationServiceInterface;
use App\Services\Interfaces\ReservationServiceInterface;
use App\Services\Interfaces\RestaurantServiceInterface;
use App\Services\Interfaces\TableServiceInterface;
use App\Services\Interfaces\TagServiceInterface;
use App\Services\ReservationService;
use App\Services\RestaurantService;
use App\Services\TableService;
use App\Services\TagService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(AuthenticationServiceInterface::class, AuthenticationService::class);
        $this->app->singleton(RestaurantServiceInterface::class, RestaurantService::class);
        $this->app->singleton(TagServiceInterface::class, TagService::class);
        $this->app->singleton(TableServiceInterface::class, TableService::class);
        $this->app->singleton(ReservationServiceInterface::class, ReservationService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
