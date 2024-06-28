<?php

namespace App\Services\Definitions;

use Illuminate\Database\Eloquent\Collection;

interface RestaurantServiceInterface
{
    public function index(): Collection;
}
