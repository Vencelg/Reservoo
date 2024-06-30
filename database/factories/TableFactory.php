<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Table>
 */
class TableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $seats = $this->faker->randomElement([2, 2, 2, 2, 2, 2, 4, 4, 4, 4, 4, 6, 8]); // More likely to have 2 or 4 seats

        return [
            'restaurant_id' => Restaurant::factory(),
            'code' => 'T'.$this->faker->randomNumber(2).$this->faker->randomLetter(),
            'seats' => $seats,
        ];
    }
}
