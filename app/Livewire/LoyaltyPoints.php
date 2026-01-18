<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\LoyaltyTransaction;
use Illuminate\Support\Facades\Auth;

class LoyaltyPoints extends Component
{
    use WithPagination;

    public $loyaltyProgress = [];
    public $stats = [];

    public function mount()
    {
        $this->loyaltyProgress = getLoyaltyProgress(Auth::id());
        
        $this->stats = [
            'current_points' => Auth::user()->loyalty_points,
            'total_completed' => $this->loyaltyProgress['total_completed'],
            'free_washes_earned' => $this->loyaltyProgress['free_washes_earned'],
            'current_cycle' => $this->loyaltyProgress['current'],
            'target' => $this->loyaltyProgress['target'],
            'remaining' => $this->loyaltyProgress['remaining'],
        ];
    }

    public function render()
    {
        $transactions = LoyaltyTransaction::where('user_id', Auth::id())
            ->with('booking')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.loyalty-points', [
            'transactions' => $transactions,
        ]);
    }
}
