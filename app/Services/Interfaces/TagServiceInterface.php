<?php

namespace App\Services\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface TagServiceInterface
{
    /**
     * @param bool $shuffle
     * @return Collection
     */
    public function list(bool $shuffle = false): Collection;
}
