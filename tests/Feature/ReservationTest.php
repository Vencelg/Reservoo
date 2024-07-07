<?php

namespace Tests\Feature;

use App\Models\Reservation;
use App\Models\Restaurant;
use App\Models\Table;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ReservationTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected Restaurant $restaurant;
    protected Table $table;
    protected Reservation $reservation;

    public function setUp(): void
    {
        parent::setUp();
        $this->restaurant = Restaurant::factory()->create();
        $this->table = Table::factory()->create(['restaurant_id' => $this->restaurant->id]);
        $this->user = User::factory()->create([
            'password' => 'password',
        ]);
        $this->reservation = Reservation::factory()->create([
            'table_id' => $this->table->id,
            'user_id' => $this->user->id
        ]);
        Auth::login($this->user);
    }

    public function test_user_can_see_user_reservations_page_when_authenticated(): void
    {
        $response = $this->get(route('reservations.authUserList'));

        $response->assertStatus(200);
        $response->assertViewIs('main.reservations.list');
        $response->assertSee("Your reservations");
    }

    public function test_user_redirected_from_table_page_as_guest(): void
    {
        Auth::logout();
        $this->assertGuest();
        $response = $this->get(route('reservations.authUserList', ['id' => $this->restaurant->id]));

        $response->assertRedirect(route('login'));
    }

    public function test_user_can_create_reservation_with_valid_data(): void
    {
        $reservedFrom = Carbon::now()
            ->addHour()
            ->setMinutes(0)
            ->setSeconds(0);

        $response = $this->post(route('reservations.store'), [
            'table_id' => $this->table->id,
            'reserved_from' => $reservedFrom->format('Y-m-d H:i:s'),
            'reserved_to' => (clone $reservedFrom)->addHours(2.5)->format('Y-m-d H:i:s'),
        ]);

        $response->assertRedirect(route('reservations.authUserList'));
        $this->assertDatabaseHas('reservations', [
            'table_id' => $this->table->id,
            'reserved_from' => $reservedFrom->format('Y-m-d H:i:s'),
            'reserved_to' => (clone $reservedFrom)->addHours(2.5)->format('Y-m-d H:i:s'),
        ]);
    }

    public function test_user_cannot_create_reservation_with_invalid_data(): void
    {
        $reservedFrom = Carbon::now()
            ->addHour()
            ->setMinutes(0)
            ->setSeconds(0);

        $nonExistentTable = 888;

        $response = $this->post(route('reservations.store'), [
            'table_id' => $nonExistentTable,
            'reserved_from' => $reservedFrom->format('Y-m-d H:i:s'),
            'reserved_to' => (clone $reservedFrom)->subHours(2.5)->format('Y-m-d H:i:s'),
        ]);


        $response->assertSessionHasErrors();
    }

    public function test_user_cannot_create_reservation_during_another_reservation_time(): void
    {
        $previousUrl = route('reservations.authUserList');
        $this->withSession(['_previous.url' => $previousUrl]);
        $date = now()->addDay()->startOfDay();

        Reservation::factory()->create([
            'table_id' => $this->table->id,
            'reserved_from' => (clone $date)->addHours(16)->format('Y-m-d H:i:s'),
            'reserved_to' => (clone $date)->addHours(20)->format('Y-m-d H:i:s'),
        ]);

        $reservationAttempts = [
            ['reserved_from' => (clone $date)->addHours(16)->format('Y-m-d H:i:s'), 'reserved_to' => (clone $date)->addHours(18)->format('Y-m-d H:i:s')],
            ['reserved_from' => (clone $date)->addHours(15)->format('Y-m-d H:i:s'), 'reserved_to' => (clone $date)->addHours(18)->format('Y-m-d H:i:s')],
            ['reserved_from' => (clone $date)->addHours(18)->format('Y-m-d H:i:s'), 'reserved_to' => (clone $date)->addHours(22)->format('Y-m-d H:i:s')],
            ['reserved_from' => (clone $date)->addHours(20)->format('Y-m-d H:i:s'), 'reserved_to' => (clone $date)->addHours(22)->format('Y-m-d H:i:s')],
        ];

        foreach ($reservationAttempts as $attempt) {
            $response = $this->post(route('reservations.store'), [
                'table_id' => $this->table->id,
                'reserved_from' => $attempt['reserved_from'],
                'reserved_to' => $attempt['reserved_to'],
            ]);

            $response->assertRedirect($previousUrl);
        }
    }

    public function test_user_can_delete_own_reservation(): void
    {
        $previousUrl = route('reservations.authUserList');
        $this->withSession(['_previous.url' => $previousUrl]);
        $reservationForDeletion = Reservation::factory()->create([
            'table_id' => $this->table->id,
            'user_id' => $this->user->id,
            'reserved_from' => '2024-07-07 12:00:00',
            'reserved_to' => '2024-07-07 14:00:00',
        ]);

        $response = $this->delete(route('reservations.destroy',['id' => $reservationForDeletion->id]));
        $response->assertRedirect($previousUrl);
        $this->assertDatabaseMissing('reservations', [
            'table_id' => $this->table->id,
            'user_id' => $this->user->id,
            'reserved_from' => $reservationForDeletion->reserved_from,
            'reserved_to' => $reservationForDeletion->reserved_to,
        ]);
    }

    public function test_user_cannot_delete_other_users_reservation(): void
    {
        $previousUrl = route('reservations.authUserList');
        $this->withSession(['_previous.url' => $previousUrl]);
        $otherUser = User::factory()->create();
        $reservationForDeletion = Reservation::factory()->create([
            'table_id' => $this->table->id,
            'user_id' => $otherUser->id,
            'reserved_from' => '2024-07-07 12:00:00',
            'reserved_to' => '2024-07-07 14:00:00',
        ]);

        $response = $this->delete(route('reservations.destroy',['id' => $reservationForDeletion->id]));
        $response->assertRedirect($previousUrl);
        $this->assertDatabaseHas('reservations', [
            'table_id' => $this->table->id,
            'user_id' => $otherUser->id,
            'reserved_from' => '2024-07-07 12:00:00',
            'reserved_to' => '2024-07-07 14:00:00',
        ]);
    }
}
