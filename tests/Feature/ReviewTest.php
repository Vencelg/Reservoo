<?php

namespace Tests\Feature;

use App\Models\Restaurant;
use App\Models\Review;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ReviewTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected Restaurant $restaurant;
    protected Review $review;

    public function setUp(): void
    {
        parent::setUp();
        $this->restaurant = Restaurant::factory()->create();
        $this->user = User::factory()->create([
            'password' => 'password',
        ]);
        $this->review = Review::factory()->create([
            'restaurant_id' => $this->restaurant->id,
            'user_id' => $this->user->id,
        ]);
        Auth::login($this->user);
    }

    public function test_user_can_see_review_page_when_authenticated(): void
    {
        $response = $this->get(route('reviews.list', ['id' => $this->restaurant->id]));

        $response->assertStatus(200);
        $response->assertViewIs('main.reviews.list');
        $response->assertSee($this->restaurant->name);
        $response->assertSee($this->review->title);
    }

    public function test_user_redirected_from_review_page_as_guest(): void
    {
        Auth::logout();
        $this->assertGuest();
        $response = $this->get(route('reviews.list', ['id' => $this->restaurant->id]));

        $response->assertRedirect(route('login'));
    }

    public function test_home_page_has_any_reviews(): void
    {
        $response = $this->get(route('reviews.list', ['id' => $this->restaurant->id]));

        $response->assertStatus(200);
        $response->assertViewIs('main.reviews.list');
        $response->assertDontSee("This restaurant has no reviews yet");
    }

    public function test_review_page_has_no_reviews(): void
    {
        $this->review->delete();
        $response = $this->get(route('reviews.list', ['id' => $this->restaurant->id]));

        $response->assertStatus(200);
        $response->assertSee("This restaurant has no reviews yet");
    }

    public function test_user_can_create_review_with_valid_data()
    {
        $response = $this->post(route('reviews.store'), [
            'title' => 'example title',
            'description' => 'example description',
            'restaurant_id' => $this->restaurant->id,
            'user_id' => $this->user->id,
            'rating' => 5,
        ]);

        $response->assertRedirect(route('reviews.list', ['id' => $this->restaurant->id]));
        $this->assertDatabaseHas('reviews', [
            'title' => 'example title',
        ]);
    }

    public function test_user_cannot_create_review_with_invalid_data()
    {
        $response = $this->post(route('reviews.store'), [
            'title' => 'example title',
            'description' => ['example', 'description'],
            'restaurant_id' => 888,
            'user_id' => 465,
            'rating' => 10,
        ]);

        $response->assertSessionHasErrors();
    }

    public function test_user_can_delete_owned_reviews(): void
    {
        $previousUrl = route('reviews.list', ['id' => $this->restaurant->id]);
        $this->withSession(['_previous.url' => $previousUrl]);
        $reviewForDeletion = Review::factory()->create([
            'restaurant_id' => $this->restaurant->id,
            'user_id' => $this->user->id,
            'title' => 'delete example title',
        ]);

        $response = $this->delete(route('reviews.destroy',['id' => $reviewForDeletion->id]));
        $response->assertRedirect($previousUrl);
        $this->assertDatabaseMissing('reviews', [
            'restaurant_id' => $this->restaurant->id,
            'user_id' => $this->user->id,
            'title' => 'delete example title',
        ]);
    }

    public function test_user_cannot_delete_other_users_reviews(): void
    {
        $previousUrl = route('reviews.list', ['id' => $this->restaurant->id]);
        $this->withSession(['_previous.url' => $previousUrl]);
        $otherUser = User::factory()->create();
        $reviewForDeletion = Review::factory()->create([
            'restaurant_id' => $this->restaurant->id,
            'user_id' => $otherUser->id,
            'title' => 'delete example title',
        ]);

        $response = $this->delete(route('reviews.destroy',['id' => $reviewForDeletion->id]));
        $response->assertRedirect($previousUrl);
        $this->assertDatabaseHas('reviews', [
            'restaurant_id' => $this->restaurant->id,
            'user_id' => $otherUser->id,
            'title' => 'delete example title',
        ]);
    }

    public function test_user_cannot_delete_nonexistent_reviews(): void
    {
        $previousUrl = route('reviews.list', ['id' => $this->restaurant->id]);
        $this->withSession(['_previous.url' => $previousUrl]);
        $nonExistentReviewId = 888;

        $response = $this->delete(route('reviews.destroy',['id' => $nonExistentReviewId]));
        $response->assertRedirect($previousUrl);
    }
}
