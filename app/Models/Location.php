<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'address',
        'latitude',
        'longitude',
        'phone',
        'email',
        'open_time',
        'close_time',
        'operating_days',
        'max_service_radius_km',
        'daily_capacity',
        'slot_capacity',
        'is_active',
        'is_main_branch',
        'sort_order',
        'description',
        'facilities',
        'photos',
    ];

    protected function casts(): array
    {
        return [
            'latitude' => 'float',
            'longitude' => 'float',
            'max_service_radius_km' => 'float',
            'daily_capacity' => 'integer',
            'slot_capacity' => 'integer',
            'is_active' => 'boolean',
            'is_main_branch' => 'boolean',
            'sort_order' => 'integer',
            'operating_days' => 'array',
            'facilities' => 'array',
            'photos' => 'array',
        ];
    }

    /**
     * Calculate distance from a given point to this location
     * Using Haversine formula
     */
    public function distanceFrom(float $latitude, float $longitude): float
    {
        $earthRadius = 6371; // km

        $latFrom = deg2rad($latitude);
        $lonFrom = deg2rad($longitude);
        $latTo = deg2rad($this->latitude);
        $lonTo = deg2rad($this->longitude);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $a = sin($latDelta / 2) * sin($latDelta / 2) +
            cos($latFrom) * cos($latTo) *
            sin($lonDelta / 2) * sin($lonDelta / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }

    /**
     * Check if a given point is within service area
     */
    public function isWithinServiceArea(float $latitude, float $longitude): bool
    {
        $distance = $this->distanceFrom($latitude, $longitude);

        return $distance <= $this->max_service_radius_km;
    }

    /**
     * Calculate service fee based on distance
     */
    public function calculateServiceFee(float $distance): float
    {
        // Base fee
        $baseFee = 10000;

        // Additional fee per km
        $feePerKm = 2000;

        return $baseFee + ($distance * $feePerKm);
    }

    /**
     * Get the nearest active location from a given point
     */
    public static function getNearestLocation(float $latitude, float $longitude): ?self
    {
        $locations = self::where('is_active', true)->get();

        if ($locations->isEmpty()) {
            return null;
        }

        $nearest = null;
        $minDistance = PHP_FLOAT_MAX;

        foreach ($locations as $location) {
            $distance = $location->distanceFrom($latitude, $longitude);

            if ($distance < $minDistance) {
                $minDistance = $distance;
                $nearest = $location;
            }
        }

        return $nearest;
    }

    /**
     * Get all locations that can service a given point
     */
    public static function getAvailableLocationsFor(float $latitude, float $longitude)
    {
        $locations = self::where('is_active', true)->get();

        return $locations->filter(function ($location) use ($latitude, $longitude) {
            return $location->isWithinServiceArea($latitude, $longitude);
        })->sortBy(function ($location) use ($latitude, $longitude) {
            return $location->distanceFrom($latitude, $longitude);
        });
    }

    /**
     * Scope for active locations
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for main branch
     */
    public function scopeMainBranch($query)
    {
        return $query->where('is_main_branch', true);
    }
}
