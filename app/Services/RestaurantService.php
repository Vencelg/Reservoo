<?php

namespace App\Services;

use App\Models\Restaurant;
use App\Services\Interfaces\RestaurantServiceInterface;
use Carbon\Carbon;
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
        $restaurant = Restaurant::find($id);
        $restaurant->setTimeslots($this->getTimeslots($restaurant));
        $restaurant->setAvailableSeats($this->getAvailableSeats($restaurant));

        return $restaurant;
    }

    public function getAvailableSeats(Restaurant $restaurant): array
    {
        return $restaurant->tables()->distinct()->orderBy('seats')->pluck('seats')->toArray();
    }

    public function getTimeslots(Restaurant $restaurant): array
    {
        $openingTime = Carbon::createFromFormat('H:i', $restaurant->opening_time);
        $closingTime = Carbon::createFromFormat('H:i', $restaurant->closing_time);

        $timeslots = [];
        $current = $openingTime->copy();
        while ($current->lessThanOrEqualTo($closingTime)) {
            $timeslots[] = $current->format('H:i');
            $current->addMinutes(30);
        }

        return $timeslots;
    }
}
