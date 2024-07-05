<?php

namespace App\Services;

use App\Models\Table;
use App\Services\Interfaces\RestaurantServiceInterface;
use App\Services\Interfaces\TableServiceInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class TableService implements TableServiceInterface
{
    public function __construct(
        protected RestaurantServiceInterface$restaurantService,
    )
    {
    }

    public function list(int $restaurantId, string $date): Collection
    {
        return Table::with(['restaurant'])
            ->where('restaurant_id', $restaurantId)
            ->orderBy('seats')->get()
            ->map(function ($table) use ($date) {
                $table->setAvailableTimes($this->generateAvailableTimes($table, $date));
                return $table;
        });
    }

    public function generateAvailableTimes(Table $table, string $date): array
    {
        $restaurant = $table->restaurant;
        $reservations =  $table->reservations()->whereDate('reserved_from', '=',$date)->get();
        $timeslots = $this->restaurantService->getTimeslots($restaurant);

        foreach ($reservations as $reservation) {
            $reservedFrom = Carbon::createFromFormat('Y-m-d H:i:s', $reservation->reserved_from);
            $reservedTo = Carbon::createFromFormat('Y-m-d H:i:s', $reservation->reserved_to);

            $timeslots = array_filter($timeslots, function($timeslot) use ($reservedFrom, $reservedTo, $date) {
                $currentSlot = Carbon::createFromFormat('Y-m-d H:i:s', $date.' '.$timeslot.':00');
                return !($currentSlot->between($reservedFrom, $reservedTo) || $currentSlot->equalTo($reservedFrom));
            });
        }
        return array_values($timeslots);
    }
}
