<?php

namespace App\Services\Definitions;

use App\Models\Restaurant;

interface RestaurantServiceInterface
{
    public function detail(int $id): ?Restaurant;
}
