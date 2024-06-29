<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurant>
 */
class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'bio' => $this->faker->paragraph,
            'coordinates' => $this->faker->latitude() . ',' . $this->faker->longitude(),
            'max_reservation_time' => $this->faker->numberBetween(2,4),
            'opening_time' => $this->faker->numberBetween(7, 9), // in hours
            'closing_time' => $this->faker->numberBetween(20, 24), // in hours
        ];
    }
}
