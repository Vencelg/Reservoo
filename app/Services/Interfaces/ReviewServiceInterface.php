<?php

namespace App\Services\Interfaces;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Review;
use Illuminate\Database\Eloquent\Collection;

interface ReviewServiceInterface
{
    public function list(int $id): Collection;
    public function store(StoreReviewRequest $request): Review;
    public function destroy(int $id): void;
}
