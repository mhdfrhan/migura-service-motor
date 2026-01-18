<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperatingHours extends Model
{
    use HasFactory;

    protected $fillable = [
        'day_of_week',
        'open_time',
        'close_time',
        'is_closed',
    ];

    protected $casts = [
        'open_time' => 'datetime:H:i',
        'close_time' => 'datetime:H:i',
        'is_closed' => 'boolean',
    ];

    public function scopeOpen($query)
    {
        return $query->where('is_closed', false);
    }

    public function scopeForDay($query, string $day)
    {
        return $query->where('day_of_week', strtolower($day));
    }

    public function isOpen(): bool
    {
        return !$this->is_closed;
    }

    public function getHoursRangeAttribute(): string
    {
        if ($this->is_closed) {
            return 'Tutup';
        }

        return $this->open_time->format('H:i') . ' - ' . $this->close_time->format('H:i');
    }
}

