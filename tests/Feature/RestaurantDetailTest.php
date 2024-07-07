<?php

namespace Tests\Feature;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class RestaurantDetailTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected Restaurant $restaurant;

    public function setUp(): void
    {
        parent::setUp();
        $this->restaurant = Restaurant::factory()->create();
        $this->user = User::factory()->create([
            'password' => 'password',
        ]);
        Auth::login($this->user);
    }

    public function test_user_can_see_detail_page_when_authenticated(): void
    {
        $response = $this->get(route('restaurants.detail', ['id' => $this->restaurant->id]));

        $response->assertStatus(200);
        $response->assertViewIs('main.restaurants.detail');
        $response->assertSee($this->restaurant->name);
    }

    public function test_user_redirected_from_detail_page_as_guest(): void
    {
        Auth::logout();
        $this->assertGuest();
        $response = $this->get(route('restaurants.detail', ['id' => $this->restaurant->id]));

        $response->assertRedirect(route('login'));
    }

    public function test_user_is_redirected_from_non_existent_restaurant_detail(): void
    {
        $previousUrl = route('restaurants.detail', ['id' => $this->restaurant->id]);
        $this->withSession(['_previous.url' => $previousUrl]);

        $nonExistentId = 876;
        $response = $this->get(route('restaurants.detail', ['id' => $nonExistentId]));

        $response->assertRedirect($previousUrl);
    }
}
