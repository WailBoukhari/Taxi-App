<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\City;

class CitySearch extends Component
{
    public $departureQuery = '';
    public $destinationQuery = '';

    public function render()
    {
        $departureCities =
            City::where('name', 'like', '%' . $this->departureQuery . '%')->get();
        $destinationCities =
            City::where('name', 'like', '%' . $this->destinationQuery . '%')->get();
        return view('livewire.city-search', compact('departureCities', 'destinationCities'));
    }
}
