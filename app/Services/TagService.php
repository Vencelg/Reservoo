<?php

namespace App\Services;

use App\Models\Tag;
use App\Services\Interfaces\TagServiceInterface;
use Illuminate\Database\Eloquent\Collection;

class TagService implements TagServiceInterface
{

    /**
     * @param bool $shuffle
     * @return Collection
     */
    public function list(bool $shuffle = false): Collection
    {
        $tags = Tag::all();
        if ($shuffle) {
            $tags = $tags->shuffle();
        }

        return $tags;
    }
}
