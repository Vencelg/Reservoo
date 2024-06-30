<?php

namespace App\Services;

use App\Models\Restaurant;
use App\Services\Interfaces\RestaurantServiceInterface;
use Illuminate\Database\Eloquent\Collection;

class RestaurantService implements RestaurantServiceInterface
{

    public function list(bool $shuffle = false): Collection
    {
        $restaurants = Restaurant::with('tags')->get();
        if ($shuffle) {
            $restaurants = $restaurants->shuffle();
        }

        return $restaurants;
    }

    public function detail(int $id): ?Restaurant
    {
        return Restaurant::find($id);
    }
}
