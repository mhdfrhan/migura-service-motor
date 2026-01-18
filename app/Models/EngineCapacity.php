<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EngineCapacity extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'min_cc',
        'max_cc',
        'price_multiplier',
        'is_active',
    ];

    protected $casts = [
        'price_multiplier' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getDisplayNameAttribute(): string
    {
        if ($this->max_cc) {
            return "{$this->name} ({$this->min_cc}cc - {$this->max_cc}cc)";
        }
        return "{$this->name} ({$this->min_cc}cc+)";
    }
}

