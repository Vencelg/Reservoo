<?php

namespace App\Services;

use App\Models\Restaurant;
use App\Services\Interfaces\RestaurantServiceInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class RestaurantService implements RestaurantServiceInterface
{

    /**
     * @param bool $shuffle
     * @return Collection
     */
    public function list(bool $shuffle = false): Collection
    {
        $restaurants = Restaurant::with('tags')->get()->map(function (Restaurant $restaurant) {
            $restaurant->setRating($this->getRating($restaurant));

            return $restaurant;
        });
        if ($shuffle) {
            $restaurants = $restaurants->shuffle();
        }

        return $restaurants;
    }

    /**
     * @param int $id
     * @return Restaurant|null
     */
    public function detail(int $id): ?Restaurant
    {
        $restaurant = Restaurant::find($id);
        $restaurant->setTimeslots($this->getTimeslots($restaurant));
        $restaurant->setAvailableSeats($this->getAvailableSeats($restaurant));
        $restaurant->setRating($this->getRating($restaurant));

        return $restaurant;
    }

    /**
     * @param Restaurant $restaurant
     * @return array
     */
    public function getAvailableSeats(Restaurant $restaurant): array
    {
        return $restaurant->tables()->distinct()->orderBy('seats')->pluck('seats')->toArray();
    }

    /**
     * @param Restaurant $restaurant
     * @return array
     */
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

    /**
     * @param Restaurant $restaurant
     * @return float
     */
    public function getRating(Restaurant $restaurant): float
    {
        $reviews = $restaurant->reviews;
        $ratings = [];

        foreach ($reviews as $review) {
            $ratings[] = $review->rating;
        }

        return count($ratings) !== 0 ? round(array_sum($ratings) / count($ratings), 2) : 0;
    }
}
