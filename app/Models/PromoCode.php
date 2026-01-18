<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PromoCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'description',
        'discount_type',
        'discount_value',
        'min_transaction',
        'max_discount',
        'usage_limit',
        'usage_count',
        'valid_from',
        'valid_until',
        'is_active',
    ];

    protected $casts = [
        'discount_value' => 'decimal:2',
        'min_transaction' => 'decimal:2',
        'max_discount' => 'decimal:2',
        'valid_from' => 'date',
        'valid_until' => 'date',
        'is_active' => 'boolean',
    ];

    public function usages(): HasMany
    {
        return $this->hasMany(PromoCodeUsage::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
                     ->where('valid_from', '<=', today())
                     ->where('valid_until', '>=', today());
    }

    public function scopeAvailable($query)
    {
        return $query->active()
                     ->where(function ($q) {
                         $q->whereNull('usage_limit')
                           ->orWhereRaw('usage_count < usage_limit');
                     });
    }

    public function isValid(): bool
    {
        if (!$this->is_active) {
            return false;
        }

        if (today()->lt($this->valid_from) || today()->gt($this->valid_until)) {
            return false;
        }

        if ($this->usage_limit && $this->usage_count >= $this->usage_limit) {
            return false;
        }

        return true;
    }

    public function calculateDiscount(float $amount): float
    {
        if ($amount < $this->min_transaction) {
            return 0;
        }

        $discount = match ($this->discount_type) {
            'percentage' => ($amount * $this->discount_value) / 100,
            'fixed' => $this->discount_value,
            default => 0,
        };

        if ($this->max_discount && $discount > $this->max_discount) {
            $discount = $this->max_discount;
        }

        return round($discount, 2);
    }

    public function incrementUsage(): void
    {
        $this->increment('usage_count');
    }
}

