<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Restaurant extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected array $timeslots;
    /**
     * @var array
     */
    protected array $availableSeats;
    /**
     * @var float
     */
    protected float $rating;

    /**
     * @var string[]
     */
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

    /**
     * @var string[]
     */
    protected $withCount = [
        'reviews'
    ];

    /**
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'restaurant_tag');
    }

    /**
     * @return HasMany
     */
    public function tables(): HasMany
    {
        return $this->hasMany(Table::class, 'restaurant_id');
    }

    /**
     * @return HasMany
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'restaurant_id');
    }

    /**
     * @return array
     */
    public function getTimeslots(): array
    {
        return $this->timeslots;
    }

    /**
     * @param array $timeslots
     * @return $this
     */
    public function setTimeslots(array $timeslots): self
    {
        $this->timeslots = $timeslots;
        return $this;
    }

    /**
     * @return array
     */
    public function getAvailableSeats(): array
    {
        return $this->availableSeats;
    }

    /**
     * @param array $availableSeats
     * @return $this
     */
    public function setAvailableSeats(array $availableSeats): self
    {
        $this->availableSeats = $availableSeats;
        return $this;
    }

    /**
     * @return float
     */
    public function getRating(): float
    {
        return $this->rating;
    }

    /**
     * @param float $rating
     * @return $this
     */
    public function setRating(float $rating): self
    {
        $this->rating = $rating;
        return $this;
    }
}
