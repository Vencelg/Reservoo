<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected string $emailForRegistration;

    public function setUp(): void
    {
        parent::setUp();

        $this->emailForRegistration = 'unique@email.com';
        $this->user = User::factory()->create([
            'password' => 'password',
        ]);
    }

    public function test_user_can_see_register_page_as_guest(): void
    {
        $response = $this->get(route('register'));

        $response->assertStatus(200);
        $response->assertSee('Register');
        $this->assertGuest();
    }

    public function test_user_redirected_from_register_page_when_authenticated(): void
    {
        Auth::login($this->user);


        $response = $this->get(route('register'));
        $response->assertRedirect(route('home'));
    }

    public function test_user_can_register_with_valid_credentials()
    {
        $response = $this->post(route('register'), [
            'firstname' => 'john',
            'lastname' => 'doe',
            'email' => $this->emailForRegistration,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertRedirect(route('home'));
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'email' => $this->emailForRegistration,
        ]);
    }

    public function test_user_cannot_register_with_invalid_credentials()
    {
        $response = $this->post(route('register'), [
            'firstname' => 'john',
            'lastname' => 'doe',
            'email' => 'invalid-email.com',
            'password' => 'pass',
            'password_confirmation' => 'password',
        ]);

        $response->assertSessionHasErrors();
        $this->assertGuest();
    }
}
