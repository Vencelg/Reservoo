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
            'bio' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Duis viverra diam non justo. Etiam neque. Donec quis nibh at felis congue commodo. Maecenas ipsum velit, consectetuer eu lobortis ut, dictum at dui. Aliquam ante. Aenean vel massa quis mauris vehicula lacinia. Mauris tincidunt sem sed arcu. Duis condimentum augue id magna semper rutrum. Proin in tellus sit amet nibh dignissim sagittis. Fusce tellus odio, dapibus id fermentum quis, suscipit id erat. Sed vel lectus. Donec odio tempus molestie, porttitor ut, iaculis quis, sem. Proin pede metus, vulputate nec, fermentum fringilla, vehicula vitae, justo.',
            'latitude' => '49.22645',
            'longitude' => '17.67065',
            'street' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'postcode' => $this->faker->postcode(),
            'email' => $this->faker->safeEmail(),
            'phone_number' => $this->faker->phoneNumber(),
            'max_reservation_time' => $this->faker->numberBetween(2,4),
            'opening_time' => $this->faker->numberBetween(7, 9).":00",
            'closing_time' => $this->faker->numberBetween(20, 24).":00",
            'rating' => $this->faker->randomFloat(2, 1, 5),
            'reviews' => $this->faker->numberBetween(10, 99),
            'banner_url' => $this->faker->randomElement($banner_url)
        ];
    }
}
