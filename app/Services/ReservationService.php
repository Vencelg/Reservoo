<?php

namespace App\Services;

use App\Http\Requests\StoreReservationRequest;
use App\Models\Reservation;
use App\Services\Interfaces\ReservationServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class ReservationService implements ReservationServiceInterface
{

    /**
     * @return Collection
     */
    public function authUserList(): Collection
    {
        return Reservation::with('table.restaurant')->where('user_id', Auth::id())->get();
    }

    /**
     * @param StoreReservationRequest $request
     * @return Reservation
     */
    public function store(StoreReservationRequest $request): Reservation
    {
        $reservation = new Reservation([
            'user_id' => Auth::id(),
            'table_id' => $request->input('table_id'),
            'reserved_from' => $request->input('reserved_from'),
            'reserved_to' => $request->input('reserved_to'),
        ]);
        $reservation->save();

        return $reservation;
    }

    /**
     * @param int $id
     * @return void
     */
    public function destroy(int $id): void
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
    }
}
