<?php

namespace App\Services\Interfaces;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;

interface RestaurantServiceInterface
{
    /**
     * @param bool $shuffle
     * @return Collection
     */
    public function list(bool $shuffle = false): Collection;

    /**
     * @param int $id
     * @return Restaurant|RedirectResponse
     */
    public function detail(int $id): Restaurant|RedirectResponse;

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
