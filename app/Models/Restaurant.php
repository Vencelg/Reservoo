<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Restaurant extends Model
{
    use HasFactory;

    protected array $timeslots;
    protected array $availableSeats;

    protected $fillable = [
        'name',
        'bio',
        'latitude',
        'longitude',
        'street',
        'city',
        'postcode',
        'max_reservation_time',
        'opening_time',
        'closing_time',
        'rating',
        'reviews',
        'banner_url',
    ];

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'restaurant_tag');
    }

    public function tables(): HasMany
    {
        return $this->hasMany(Table::class, 'restaurant_id');
    }

    public function getTimeslots(): array
    {
        return $this->timeslots;
    }

    public function setTimeslots(array $timeslots): self
    {
        $this->timeslots = $timeslots;
        return $this;
    }

    public function getAvailableSeats(): array
    {
        return $this->availableSeats;
    }

    public function setAvailableSeats(array $availableSeats): self
    {
        $this->availableSeats = $availableSeats;
        return $this;
    }
}
