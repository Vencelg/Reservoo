<?php

namespace App\Services;

use App\Models\Restaurant;
use App\Services\Definitions\RestaurantServiceInterface;

class RestaurantService implements RestaurantServiceInterface
{

    public function detail(int $id): ?Restaurant
    {
        return Restaurant::find($id);
    }
}
