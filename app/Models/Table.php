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

    /**
     * @var array
     */
    protected array $availableTimes;

    /**
     * @var string[]
     */
    protected $fillable = [
        'restaurant_id',
        'code',
        'seats',
    ];

    /**
     * @return BelongsTo
     */
    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    /**
     * @return HasMany
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class, 'table_id');
    }

    /**
     * @return array
     */
    public function getAvailableTimes(): array
    {
        return $this->availableTimes;
    }

    /**
     * @param array $availableTimes
     * @return $this
     */
    public function setAvailableTimes(array $availableTimes): self
    {
        $this->availableTimes = $availableTimes;
        return $this;
    }
}
