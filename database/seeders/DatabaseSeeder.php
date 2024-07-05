<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use App\Models\Review;
use App\Models\Table;
use App\Models\Tag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'jdoe@email.com',
        ]);

        Tag::factory()->count(10)->create();

        Restaurant::factory()->count(20)->create()->each(function ($restaurant) use ($user) {

            $tags = Tag::inRandomOrder()->limit(rand(1, 3))->pluck('id');
            $restaurant->tags()->attach($tags);

            Table::factory()->count(rand(5, 10))->create([
                'restaurant_id' => $restaurant->id,
            ]);

            Review::factory()->count(rand(5, 10))->create([
                'restaurant_id' => $restaurant->id,
                'user_id' => $user->id,
            ]);
        });
    }
}
