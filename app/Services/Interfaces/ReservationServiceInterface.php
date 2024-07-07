<?php

namespace App\Services\Interfaces;

use App\Http\Requests\StoreReservationRequest;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;

interface ReservationServiceInterface
{
    /**
     * @return Collection
     */
    public function authUserList(): Collection;

    /**
     * @param StoreReservationRequest $request
     * @return Reservation|RedirectResponse
     */
    public function store(StoreReservationRequest $request): Reservation|RedirectResponse;

    /**
     * @param int $id
     * @return bool|RedirectResponse
     */
    public function destroy(int $id): bool|RedirectResponse;
}
