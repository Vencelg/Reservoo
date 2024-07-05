<?php

namespace App\Services\Interfaces;

use App\Models\Table;
use Illuminate\Database\Eloquent\Collection;

interface TableServiceInterface
{
    public function list(int $restaurantId, string $date): Collection;
    public function generateAvailableTimes(Table $table, string $date): array;

}
