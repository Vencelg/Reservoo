<?php

namespace App\Services;

use App\Http\Requests\StoreReservationRequest;
use App\Models\Reservation;
use App\Services\Interfaces\ReservationServiceInterface;
use App\Services\Interfaces\TableServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ReservationService implements ReservationServiceInterface
{
    public function __construct(
        protected TableServiceInterface $tableService,
    )
    {
    }

    /**
     * @return Collection
     */
    public function authUserList(): Collection
    {
        return Reservation::with('table.restaurant')->where('user_id', Auth::id())->get();
    }

    /**
     * @param StoreReservationRequest $request
     * @return Reservation|RedirectResponse
     */
    public function store(StoreReservationRequest $request): Reservation|RedirectResponse
    {
        $tableId = $request->input('table_id');
        $reservedFrom = $request->input('reserved_from');
        $reservedTo = $request->input('reserved_to');

        if (!$this->tableService->isTableAvailable($tableId, $reservedFrom, $reservedTo)) {
            return redirect()->back();
        }

        $reservation = new Reservation([
            'user_id' => Auth::id(),
            'table_id' => $tableId,
            'reserved_from' => $reservedFrom,
            'reserved_to' => $reservedTo,
        ]);
        $reservation->save();

        return $reservation;
    }

    /**
     * @param int $id
     * @return bool|RedirectResponse
     */
    public function destroy(int $id): bool|RedirectResponse
    {
        $reservation = Reservation::find($id);
        if (!($reservation instanceof Reservation)) {
            return redirect()->back();
        }

        if ($reservation->user_id !== Auth::id()) {
            return redirect()->back();
        }

        return $reservation->delete();
    }
}
