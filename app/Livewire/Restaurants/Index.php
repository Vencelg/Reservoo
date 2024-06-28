<?php

namespace App\Livewire\Restaurants;

use App\Models\Restaurant;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Index extends Component
{
    public Collection $restaurants;
    public Collection $tags;

    public function mount(): void
    {
        $this->restaurants = Restaurant::with('tags')->get();
        $this->tags = Tag::all();

        dd([$this->restaurants, $this->tags]);
    }

    public function render()
    {
        return view('livewire.restaurants.index');
    }
}
