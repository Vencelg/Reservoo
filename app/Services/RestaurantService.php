<?php

namespace App\Services;

use App\Models\Restaurant;
use App\Services\Definitions\RestaurantServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;

class RestaurantService implements Definitions\RestaurantServiceInterface
{

    public function index(): Collection
    {
        $restaurants = Restaurant::all();

        return $restaurants;
    }
}
