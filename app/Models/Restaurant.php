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
    protected float $rating;

    protected $fillable = [
        'name',
        'bio',
        'latitude',
        'longitude',
        'street',
        'city',
        'postcode',
        'email',
        'phone_number',
        'max_reservation_time',
        'opening_time',
        'closing_time',
        'banner_url',
    ];

    protected $withCount = [
        'reviews'
    ];

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'restaurant_tag');
    }

    public function tables(): HasMany
    {
        return $this->hasMany(Table::class, 'restaurant_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'restaurant_id');
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

    public function getRating(): float
    {
        return $this->rating;
    }

    public function setRating(float $rating): self
    {
        $this->rating = $rating;
        return $this;
    }
}
