<?php

namespace App\Services;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Review;
use App\Services\Interfaces\ReviewServiceInterface;
use Illuminate\Database\Eloquent\Collection;

class ReviewService implements ReviewServiceInterface
{
    public function list(int $id): Collection
    {
        return Review::with('user')->get();
    }

    public function store(StoreReviewRequest $request): Review
    {
        $review = new Review([
            'user_id' => auth()->id(),
            'restaurant_id' => $request->input('restaurant_id'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'rating' => $request->input('rating'),
        ]);
        $review->save();

        return $review;
    }

    public function destroy(int $id): void
    {
        $review = Review::findOrFail($id);

        $review->delete();
    }
}
