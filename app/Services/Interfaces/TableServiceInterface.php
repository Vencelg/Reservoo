<?php

namespace App\Services\Interfaces;

use App\Models\Table;
use Illuminate\Database\Eloquent\Collection;

interface TableServiceInterface
{
    /**
     * @param int $restaurantId
     * @param string $date
     * @return Collection
     */
    public function list(int $restaurantId, string $date): Collection;

    /**
     * @param Table $table
     * @param string $date
     * @return array
     */
    public function generateAvailableTimes(Table $table, string $date): array;

}
