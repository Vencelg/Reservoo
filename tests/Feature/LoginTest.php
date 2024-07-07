<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'password' => 'password',
        ]);
    }

    public function test_user_can_see_login_page_as_guest(): void
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
        $response->assertSee('Login');
        $this->assertGuest();
    }

    public function test_user_redirected_from_login_page_when_authenticated(): void
    {
        Auth::login($this->user);


        $response = $this->get(route('login'));
        $response->assertRedirect(route('home'));
    }

    public function test_user_can_login_with_valid_credentials()
    {
        $response = $this->post(route('login'), [
            'email' => $this->user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('home'));
        $this->assertAuthenticatedAs($this->user);
    }

    public function test_user_cannot_login_with_invalid_credentials()
    {
        $response = $this->post(route('login'), [
            'email' => 'invalid-email.com',
            'password' => 'pass',
        ]);

        $response->assertSessionHasErrors();
        $this->assertGuest();
    }
}
