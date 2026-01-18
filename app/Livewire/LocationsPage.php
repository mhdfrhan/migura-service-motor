<?php

namespace App\Livewire;

use App\Models\Location;
use Livewire\Component;

class LocationsPage extends Component
{
    public $locations;

    public $selectedLocation = null;

    public $locationsForMap = [];

    public function mount()
    {
        // Load all active locations
        $this->locations = Location::active()
            ->orderBy('is_main_branch', 'desc')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        // Prepare data for map
        $this->locationsForMap = $this->locations->map(function ($loc) {
            return [
                'id' => $loc->id,
                'name' => $loc->name,
                'lat' => $loc->latitude,
                'lng' => $loc->longitude,
                'is_main' => $loc->is_main_branch,
                'radius' => $loc->max_service_radius_km,
                'address' => $loc->address,
                'phone' => $loc->phone,
            ];
        })->toArray();
    }

    public function selectLocation($locationId)
    {
        $this->selectedLocation = $this->locations->firstWhere('id', $locationId);
        $this->dispatch('locationSelected', $locationId);
    }

    public function render()
    {
        return view('livewire.locations-page')
            ->layout('layouts.main');
    }
}
