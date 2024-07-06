<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Services\Interfaces\ReservationServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ReservationController extends Controller
{
    /**
     * @param ReservationServiceInterface $reservationService
     */
    public function __construct(
        protected ReservationServiceInterface $reservationService,
    )
    {
    }

    /**
     * @return View
     */
    public function authUserList(): View
    {
        $reservations = $this->reservationService->authUserList();

        return view('main.reservations.list')->with([
            'reservations' => $reservations,
        ]);
    }

    /**
     * @param StoreReservationRequest $request
     * @return RedirectResponse
     */
    public function store(StoreReservationRequest $request): RedirectResponse
    {
        $this->reservationService->store($request);

        return redirect()->route('reservations.authUserList')->with([
            'success' => 'Reservation made successfully'
        ]);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->reservationService->destroy($id);

        return redirect()->route('reservations.authUserList')->with([
            'success' => 'Reservation deleted successfully'
        ]);
    }
}
