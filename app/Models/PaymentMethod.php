<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
	use HasFactory;

	protected $fillable = [
		'type',
		'name',
		'code',
		'account_number',
		'account_name',
		'icon_color',
		'is_active',
		'sort_order',
	];

	protected $casts = [
		'is_active' => 'boolean',
	];

	// Scopes
	public function scopeActive($query)
	{
		return $query->where('is_active', true);
	}

	public function scopeBankTransfers($query)
	{
		return $query->where('type', 'bank_transfer');
	}

	public function scopeEWallets($query)
	{
		return $query->where('type', 'e_wallet');
	}

	public function scopeOrdered($query)
	{
		return $query->orderBy('sort_order');
	}

	// Helper methods
	public function getTypeLabel(): string
	{
		return match ($this->type) {
			'bank_transfer' => 'Bank Transfer',
			'e_wallet' => 'E-Wallet',
			default => ucfirst($this->type),
		};
	}
}
