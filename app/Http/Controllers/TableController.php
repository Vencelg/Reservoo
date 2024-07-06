<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\RestaurantServiceInterface;
use App\Services\Interfaces\TableServiceInterface;
use Carbon\Carbon;
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
     * @return View
     */
    public function list(int $id): View
    {
        $date = request()->query('date')
            ? Carbon::createFromFormat('m-d-Y', request()->query('date'))->format('Y-m-d')
            : Carbon::now()->format('Y-m-d');
        $restaurant = $this->restaurantService->detail($id);
        $tables = $this->tableService->list($id, $date);

        return view('main.tables.list', [
            'restaurant' => $restaurant,
            'tables' => $tables,
        ]);
    }
}
