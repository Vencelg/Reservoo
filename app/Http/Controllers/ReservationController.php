<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Services\Interfaces\ReservationServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ReservationController extends Controller
{
    public function __construct(
        protected ReservationServiceInterface $reservationService,
    )
    {
    }

    public function authUserList(): View
    {
        $reservations = $this->reservationService->authUserList();

        return view('main.reservations.list')->with([
            'reservations' => $reservations,
        ]);
    }

    public function store(StoreReservationRequest $request): RedirectResponse
    {
        $this->reservationService->store($request);

        return redirect()->route('reservations.authUserList')->with([
            'success' => 'Reservation made successfully'
        ]);
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->reservationService->destroy($id);

        return redirect()->route('reservations.authUserList')->with([
            'success' => 'Reservation deleted successfully'
        ]);
    }
}
