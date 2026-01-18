<?php

namespace App\Livewire;

use App\Models\PaymentMethod;
use Livewire\Component;

class PaymentMethods extends Component
{
	public $bankTransfers = [];
	public $eWallets = [];

	public function mount(): void
	{
		$this->bankTransfers = PaymentMethod::where('type', 'bank_transfer')
			->where('is_active', true)
			->orderBy('sort_order')
			->get();

		$this->eWallets = PaymentMethod::where('type', 'e_wallet')
			->where('is_active', true)
			->orderBy('sort_order')
			->get();
	}

	public function render()
	{
		return view('livewire.payment-methods');
	}
}
