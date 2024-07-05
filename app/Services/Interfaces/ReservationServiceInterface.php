<?php

namespace App\Services\Interfaces;

use App\Http\Requests\StoreReservationRequest;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Collection;

interface ReservationServiceInterface
{
    public function authUserList(): Collection;
    public function store(StoreReservationRequest $request): Reservation;
    public function destroy(int $id): void;
}
