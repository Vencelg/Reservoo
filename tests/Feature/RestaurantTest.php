<?php

namespace Tests\Feature;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class RestaurantTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create([
            'password' => 'password',
        ]);
        Auth::login($this->user);
    }

    public function test_user_can_see_home_page_when_authenticated(): void
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);
    }

    public function test_user_redirected_from_home_page_as_guest(): void
    {
        Auth::logout();
        $this->assertGuest();
        $response = $this->get(route('home'));

        $response->assertRedirect(route('login'));
    }

    public function test_home_page_has_no_restaurants(): void
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertSee("Sorry, we couldnt find what you were looking for...");
    }

    public function test_home_page_has_any_restaurants(): void
    {
        Restaurant::factory()->create();
        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertDontSee("Sorry, we couldnt find what you were looking for...");
    }
}
