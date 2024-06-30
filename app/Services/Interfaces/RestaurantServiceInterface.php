<?php

namespace App\Services\Interfaces;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Collection;

interface RestaurantServiceInterface
{
    public function list(bool $shuffle = false): Collection;
    public function detail(int $id): ?Restaurant;
}
