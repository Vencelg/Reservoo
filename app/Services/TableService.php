<?php

namespace App\Services;

use App\Http\Requests\StoreReservationRequest;
use App\Models\Reservation;
use App\Models\Table;
use App\Services\Interfaces\RestaurantServiceInterface;
use App\Services\Interfaces\TableServiceInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class TableService implements TableServiceInterface
{
    /**
     * @param RestaurantServiceInterface $restaurantService
     */
    public function __construct(
        protected RestaurantServiceInterface$restaurantService,
    )
    {
    }

    /**
     * @param int $restaurantId
     * @param string $date
     * @return Collection
     */
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

    /**
     * @param Table $table
     * @param string $date
     * @return array
     */
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

    public function isTableAvailable(int $tableId, string $reservedFrom, string $reservedTo): bool
    {
        $reservation = Reservation::where('table_id', $tableId)
            ->where(function ($query) use ($reservedFrom, $reservedTo) {
                $query->where(function ($query) use ($reservedFrom, $reservedTo) {
                    $query->where('reserved_from', '<', $reservedTo)
                        ->where('reserved_to', '>', $reservedFrom);
                });
            })
            ->exists();

        return !$reservation;
    }
}
