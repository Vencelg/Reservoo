<?php

namespace Database\Seeders;

use App\Models\Restaurant;
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
        User::factory()->create([
            'name' => 'John Doe',
            'email' => 'jdoe@email.com',
        ]);

        Tag::factory()->count(10)->create();

        Restaurant::factory()->count(10)->create()->each(function ($restaurant) {

            $tags = Tag::inRandomOrder()->limit(rand(1, 3))->pluck('id');
            $restaurant->tags()->attach($tags);

            Table::factory()->count(rand(5, 10))->create([
                'restaurant_id' => $restaurant->id,
            ]);
        });
    }
}
