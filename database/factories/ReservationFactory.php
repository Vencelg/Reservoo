<?php

namespace Database\Factories;

use App\Models\Table;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date = Carbon::today()->addDays(rand(0, 30));
        $hour = rand(8, 20);
        $minute = rand(0, 1) * 30;
        $reservedFrom = Carbon::create($date->year, $date->month, $date->day, $hour, $minute, 0);
        $reservedTo = (clone $reservedFrom)->addHours(rand(1, 3));

        return [
            'table_id' => Table::factory(),
            'user_id' => User::factory(),
            'reserved_from' => $reservedFrom->format('Y-m-d H:i:s'),
            'reserved_to' => $reservedTo->format('Y-m-d H:i:s'),
        ];
    }
}
