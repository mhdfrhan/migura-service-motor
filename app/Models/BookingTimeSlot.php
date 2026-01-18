<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingTimeSlot extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'time_slot',
        'capacity',
        'booked_count',
        'is_available',
    ];

    protected $casts = [
        'date' => 'date',
        'time_slot' => 'datetime:H:i',
        'is_available' => 'boolean',
    ];

    public function scopeAvailable($query)
    {
        return $query->where('is_available', true)
                     ->whereRaw('booked_count < capacity');
    }

    public function scopeForDate($query, \Carbon\Carbon $date)
    {
        return $query->whereDate('date', $date);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('date', '>=', today());
    }

    public function hasCapacity(): bool
    {
        return $this->is_available && $this->booked_count < $this->capacity;
    }

    public function incrementBooked(): void
    {
        $this->increment('booked_count');

        if ($this->booked_count >= $this->capacity) {
            $this->update(['is_available' => false]);
        }
    }

    public function decrementBooked(): void
    {
        $this->decrement('booked_count');

        if ($this->booked_count < $this->capacity) {
            $this->update(['is_available' => true]);
        }
    }
}

