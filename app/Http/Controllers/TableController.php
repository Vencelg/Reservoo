<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Services\Interfaces\RestaurantServiceInterface;
use App\Services\Interfaces\TableServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TableController extends Controller
{
    /**
     * @param RestaurantServiceInterface $restaurantService
     * @param TableServiceInterface $tableService
     */
    public function __construct(
        protected RestaurantServiceInterface $restaurantService,
        protected TableServiceInterface $tableService,
    )
    {
    }

    /**
     * @param int $id
     * @return View|RedirectResponse
     */
    public function list(int $id): View|RedirectResponse
    {
        $date = request()->query('date')
            ? Carbon::createFromFormat('m-d-Y', request()->query('date'))->format('Y-m-d')
            : Carbon::now()->format('Y-m-d');
        $tables = $this->tableService->list($id, $date);
        $restaurant = $this->restaurantService->detail($id);
        if (!($restaurant instanceof Restaurant)) {
            return redirect()->back();
        }

        return view('main.tables.list', [
            'restaurant' => $restaurant,
            'tables' => $tables,
        ]);
    }
}
