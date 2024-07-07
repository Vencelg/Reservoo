<?php

namespace Tests\Feature;

use App\Models\Restaurant;
use App\Models\Table;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class TableTest extends TestCase
{
    protected User $user;
    protected Restaurant $restaurant;
    protected Table $table;

    public function setUp(): void
    {
        parent::setUp();
        $this->restaurant = Restaurant::factory()->create();
        $this->table = Table::factory()->create(['restaurant_id' => $this->restaurant->id]);
        $this->user = User::factory()->create([
            'password' => 'password',
        ]);
        Auth::login($this->user);
    }

    public function test_user_can_see_table_page_when_authenticated(): void
    {
        $response = $this->get(route('tables.list', ['id' => $this->restaurant->id]));

        $response->assertStatus(200);
        $response->assertViewIs('main.tables.list');
        $response->assertSee($this->restaurant->name);
        $response->assertSee($this->table->code);
    }

    public function test_user_redirected_from_table_page_as_guest(): void
    {
        Auth::logout();
        $this->assertGuest();
        $response = $this->get(route('tables.list', ['id' => $this->restaurant->id]));

        $response->assertRedirect(route('login'));
    }
}
