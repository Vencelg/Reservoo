<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Table extends Model
{
    use HasFactory;

    protected array $availableTimes;

    protected $fillable = [
        'restaurant_id',
        'code',
        'seats',
    ];

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class, 'table_id');
    }

    public function getAvailableTimes(): array
    {
        return $this->availableTimes;
    }

    public function setAvailableTimes(array $availableTimes): self
    {
        $this->availableTimes = $availableTimes;
        return $this;
    }
}
