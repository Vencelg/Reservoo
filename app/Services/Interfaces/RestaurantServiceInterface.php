<?php

namespace App\Services\Interfaces;

use App\Models\Restaurant;

interface RestaurantServiceInterface
{
    public function detail(int $id): ?Restaurant;
}
