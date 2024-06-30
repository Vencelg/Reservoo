<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Services\Interfaces\RestaurantServiceInterface;
use App\Services\Interfaces\TagServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RestaurantController extends Controller
{
    public function __construct(
        protected RestaurantServiceInterface $restaurantService,
        protected TagServiceInterface $tagService,
    )
    {
    }

    public function list():View
    {
        $restaurants = $this->restaurantService->list(shuffle: true);
        $tags = $this->tagService->list();

        return view('main.restaurant.homepage', [
            'restaurants' => $restaurants,
            'tags' => $tags,
        ]);
    }

    public function detail(int $id): View|RedirectResponse
    {
        $restaurant = $this->restaurantService->detail($id);
        if (!($restaurant instanceof Restaurant)) {
            return redirect()->back();
        }

        return view('main.restaurant.detail', [
            'restaurant' => $restaurant,
        ]);
    }
    //TODO: Add method for restaurant list with filters
    //TODO: Add method for restaurant detail, with tables
}
