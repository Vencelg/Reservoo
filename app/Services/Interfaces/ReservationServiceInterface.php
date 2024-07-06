<?php

namespace App\Services\Interfaces;

use App\Http\Requests\StoreReservationRequest;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Collection;

interface ReservationServiceInterface
{
    /**
     * @return Collection
     */
    public function authUserList(): Collection;

    /**
     * @param StoreReservationRequest $request
     * @return Reservation
     */
    public function store(StoreReservationRequest $request): Reservation;

    /**
     * @param int $id
     * @return void
     */
    public function destroy(int $id): void;
}
