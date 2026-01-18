<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'booking_code',
        'user_id',
        'service_package_id',
        'engine_capacity_id',
        'booking_type',
        'booking_date',
        'booking_time',
        'customer_address',
        'customer_latitude',
        'customer_longitude',
        'distance_km',
        'service_price',
        'engine_surcharge',
        'home_service_fee',
        'discount_amount',
        'total_price',
        'status',
        'notes',
        'cancellation_reason',
        'is_loyalty_reward',
        'ai_prediction_wait_time',
        'payment_uploaded_at',
        'payment_verified_at',
        'confirmed_at',
        'started_at',
        'completed_at',
        'cancelled_at',
    ];

    protected $casts = [
        'booking_date' => 'date',
        'booking_time' => 'datetime:H:i',
        'customer_latitude' => 'decimal:8',
        'customer_longitude' => 'decimal:8',
        'distance_km' => 'decimal:2',
        'service_price' => 'decimal:2',
        'engine_surcharge' => 'decimal:2',
        'home_service_fee' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'total_price' => 'decimal:2',
        'is_loyalty_reward' => 'boolean',
        'payment_uploaded_at' => 'datetime',
        'payment_verified_at' => 'datetime',
        'confirmed_at' => 'datetime',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function servicePackage(): BelongsTo
    {
        return $this->belongsTo(ServicePackage::class);
    }

    public function engineCapacity(): BelongsTo
    {
        return $this->belongsTo(EngineCapacity::class);
    }

    public function paymentProof(): HasOne
    {
        return $this->hasOne(PaymentProof::class);
    }

    public function review(): HasOne
    {
        return $this->hasOne(Review::class);
    }

    public function staffAssignments(): HasMany
    {
        return $this->hasMany(StaffAssignment::class);
    }

    public function staffAssignment(): HasOne
    {
        return $this->hasOne(StaffAssignment::class)->latestOfMany();
    }

    public function promoCodeUsage(): HasOne
    {
        return $this->hasOne(PromoCodeUsage::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->whereNotIn('status', ['cancelled', 'rejected']);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeAwaitingPayment($query)
    {
        return $query->where('status', 'awaiting_payment');
    }

    public function scopePaymentUploaded($query)
    {
        return $query->where('status', 'payment_uploaded');
    }

    public function scopeVerified($query)
    {
        return $query->where('status', 'payment_verified');
    }

    public function scopeConfirmed($query)
    {
        return $this->where('status', 'confirmed');
    }

    public function scopeInProgress($query)
    {
        return $query->where('status', 'in_progress');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeHomeService($query)
    {
        return $query->where('booking_type', 'home_service');
    }

    public function scopeRegular($query)
    {
        return $query->where('booking_type', 'regular');
    }

    public function scopeToday($query)
    {
        return $query->whereDate('booking_date', today());
    }

    public function scopeUpcoming($query)
    {
        return $query->where('booking_date', '>=', today())
                     ->whereNotIn('status', ['completed', 'cancelled', 'rejected']);
    }

    // Helper Methods
    public function canCancel(): bool
    {
        if (in_array($this->status, ['completed', 'cancelled', 'rejected'])) {
            return false;
        }

        $cancellationHours = setting('cancellation_hours', 24);
        $bookingDateTime = $this->booking_date->setTimeFromTimeString($this->booking_time);
        
        return now()->diffInHours($bookingDateTime, false) >= $cancellationHours;
    }

    public function canReview(): bool
    {
        return $this->status === 'completed' && !$this->review()->exists();
    }

    public function isHomeService(): bool
    {
        return $this->booking_type === 'home_service';
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isAwaitingPayment(): bool
    {
        return $this->status === 'awaiting_payment';
    }

    public function isPaymentUploaded(): bool
    {
        return $this->status === 'payment_uploaded';
    }

    public function isVerified(): bool
    {
        return $this->status === 'payment_verified';
    }

    public function isConfirmed(): bool
    {
        return $this->status === 'confirmed';
    }

    public function isInProgress(): bool
    {
        return $this->status === 'in_progress';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pending' => 'Menunggu',
            'awaiting_payment' => 'Menunggu Pembayaran',
            'payment_uploaded' => 'Bukti Diupload',
            'payment_verified' => 'Pembayaran Terverifikasi',
            'confirmed' => 'Dikonfirmasi',
            'in_progress' => 'Sedang Dikerjakan',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
            'rejected' => 'Ditolak',
            default => 'Unknown',
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'pending' => 'gray',
            'awaiting_payment' => 'yellow',
            'payment_uploaded' => 'blue',
            'payment_verified' => 'indigo',
            'confirmed' => 'purple',
            'in_progress' => 'sky',
            'completed' => 'green',
            'cancelled' => 'red',
            'rejected' => 'red',
            default => 'gray',
        };
    }

    // Generate unique booking code
    public static function generateBookingCode(): string
    {
        $prefix = 'MIG';
        $year = now()->year;
        $lastBooking = static::whereYear('created_at', $year)
                             ->orderBy('id', 'desc')
                             ->first();
        
        $number = $lastBooking ? (int) substr($lastBooking->booking_code, -4) + 1 : 1;
        
        return sprintf('%s-%s-%04d', $prefix, $year, $number);
    }

    // Boot method
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($booking) {
            if (!$booking->booking_code) {
                $booking->booking_code = static::generateBookingCode();
            }
        });
    }
}

