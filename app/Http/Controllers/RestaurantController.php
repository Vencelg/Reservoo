<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Services\Interfaces\RestaurantServiceInterface;
use App\Services\Interfaces\TagServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RestaurantController extends Controller
{
    /**
     * @param RestaurantServiceInterface $restaurantService
     * @param TagServiceInterface $tagService
     */
    public function __construct(
        protected RestaurantServiceInterface $restaurantService,
        protected TagServiceInterface $tagService,
    )
    {
    }

    /**
     * @return View
     */
    public function list():View
    {
        $restaurants = $this->restaurantService->list(shuffle: true);
        $tags = $this->tagService->list();

        return view('main.restaurants.homepage', [
            'restaurants' => $restaurants,
            'tags' => $tags,
        ]);
    }

    /**
     * @param int $id
     * @return View|RedirectResponse
     */
    public function detail(int $id): View|RedirectResponse
    {
        $restaurant = $this->restaurantService->detail($id);

        return view('main.restaurants.detail', [
            'restaurant' => $restaurant,
        ]);
    }
}
