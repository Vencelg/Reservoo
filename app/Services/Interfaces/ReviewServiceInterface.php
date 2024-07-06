<?php

namespace App\Services\Interfaces;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Review;
use Illuminate\Database\Eloquent\Collection;

interface ReviewServiceInterface
{
    /**
     * @param int $id
     * @return Collection
     */
    public function list(int $id): Collection;

    /**
     * @param StoreReviewRequest $request
     * @return Review
     */
    public function store(StoreReviewRequest $request): Review;

    /**
     * @param int $id
     * @return void
     */
    public function destroy(int $id): void;
}
