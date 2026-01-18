<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SmartRecommendation extends Component
{
    public $recommendation;
    public $showDetails = false;

    public function mount()
    {
        if (Auth::check()) {
            $this->recommendation = get_smart_recommendation(Auth::user());
        }
    }

    public function toggleDetails()
    {
        $this->showDetails = !$this->showDetails;
    }

    public function bookNow()
    {
        if ($this->recommendation && $this->recommendation['package']) {
            return $this->redirectRoute('booking.index', [
                'package' => $this->recommendation['package']->id
            ], navigate: true);
        }
    }

    public function render()
    {
        return view('livewire.smart-recommendation');
    }
}
