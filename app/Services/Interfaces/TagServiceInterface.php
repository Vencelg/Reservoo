<?php

namespace App\Services\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface TagServiceInterface
{
    public function list(bool $shuffle = false): Collection;
}
