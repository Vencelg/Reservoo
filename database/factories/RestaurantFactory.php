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
        $banner_url = [
            'http://localhost/images/restaurants/rest1.jpg',
            'http://localhost/images/restaurants/rest2.jpg',
            'http://localhost/images/restaurants/rest3.jpg',
            'http://localhost/images/restaurants/rest4.jpg',
            'http://localhost/images/restaurants/rest5.jpeg',
            'http://localhost/images/restaurants/rest6.jpg',
        ];

        return [
            'name' => $this->faker->company,
            'bio' => $this->faker->paragraph,
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'street' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'postcode' => $this->faker->postcode(),
            'max_reservation_time' => $this->faker->numberBetween(2,4),
            'opening_time' => $this->faker->numberBetween(7, 9).":00",
            'closing_time' => $this->faker->numberBetween(20, 24).":00",
            'rating' => $this->faker->randomFloat(2, 1, 5),
            'reviews' => $this->faker->numberBetween(10, 99),
            'banner_url' => $this->faker->randomElement($banner_url)
        ];
    }
}
