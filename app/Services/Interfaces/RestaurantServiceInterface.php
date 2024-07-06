<?php

namespace App\Services\Interfaces;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Collection;

interface RestaurantServiceInterface
{
    /**
     * @param bool $shuffle
     * @return Collection
     */
    public function list(bool $shuffle = false): Collection;

    /**
     * @param int $id
     * @return Restaurant|null
     */
    public function detail(int $id): ?Restaurant;

    /**
     * @param Restaurant $restaurant
     * @return array
     */
    public function getAvailableSeats(Restaurant $restaurant): array;

    /**
     * @param Restaurant $restaurant
     * @return array
     */
    public function getTimeslots(Restaurant $restaurant): array;

}
