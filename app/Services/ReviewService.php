<?php

namespace App\Services;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Review;
use App\Services\Interfaces\ReviewServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ReviewService implements ReviewServiceInterface
{
    /**
     * @param int $id
     * @return Collection
     */
    public function list(int $id): Collection
    {
        return Review::with('user')->where('restaurant_id', $id)->get();
    }

    /**
     * @param StoreReviewRequest $request
     * @return Review
     */
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

    /**
     * @param int $id
     * @return bool|RedirectResponse
     */
    public function destroy(int $id): bool|RedirectResponse
    {
        $review = Review::find($id);
        if (!($review instanceof Review)) {
            return redirect()->back();
        }

        if ($review->user_id !== Auth::id()) {
            return redirect()->back();
        }

        return $review->delete();
    }
}
