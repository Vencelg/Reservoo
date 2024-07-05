<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Services\Interfaces\RestaurantServiceInterface;
use App\Services\Interfaces\ReviewServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReviewController extends Controller
{
    public function __construct(
        protected ReviewServiceInterface $reviewService,
        protected RestaurantServiceInterface $restaurantService,
    )
    {
    }

    public function list(int $id): View
    {
        $reviews =  $this->reviewService->list($id);
        $restaurant = $this->restaurantService->detail($id);

        return view('main.reviews.list')->with([
            'reviews' => $reviews,
            'restaurant' => $restaurant,
        ]);
    }

    public function store(StoreReviewRequest $request): RedirectResponse
    {
        $this->reviewService->store($request);

        return redirect()->route('reviews.list', ['id' => $request->input('restaurant_id')])->with([
            'success' => 'Review made successfully'
        ]);
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->reviewService->destroy($id);

        return redirect()->back()->with([
            'success' => 'Review deleted successfully'
        ]);
    }
}
