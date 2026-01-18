<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role',
        'address',
        'latitude',
        'longitude',
        'loyalty_points',
        'total_bookings',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'latitude' => 'decimal:8',
            'longitude' => 'decimal:8',
            'is_active' => 'boolean',
        ];
    }

    // Relationships
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function loyaltyTransactions(): HasMany
    {
        return $this->hasMany(LoyaltyTransaction::class);
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }

    public function staffAssignments(): HasMany
    {
        return $this->hasMany(StaffAssignment::class, 'staff_id');
    }

    public function verifiedPayments(): HasMany
    {
        return $this->hasMany(PaymentProof::class, 'verified_by');
    }

    // Scopes
    public function scopeCustomers($query)
    {
        return $query->where('role', 'customer');
    }

    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }

    public function scopeStaff($query)
    {
        return $query->where('role', 'staff');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Role Checkers
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isStaff(): bool
    {
        return $this->role === 'staff';
    }

    public function isCustomer(): bool
    {
        return $this->role === 'customer';
    }

    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    // Loyalty Methods
    public function addLoyaltyPoints(int $points, string $description, ?int $bookingId = null): LoyaltyTransaction
    {
        $this->increment('loyalty_points', $points);

        return $this->loyaltyTransactions()->create([
            'booking_id' => $bookingId,
            'type' => 'earned',
            'points' => $points,
            'balance_after' => $this->fresh()->loyalty_points,
            'description' => $description,
        ]);
    }

    public function deductLoyaltyPoints(int $points, string $description, ?int $bookingId = null): LoyaltyTransaction
    {
        $this->decrement('loyalty_points', $points);

        return $this->loyaltyTransactions()->create([
            'booking_id' => $bookingId,
            'type' => 'redeemed',
            'points' => -$points,
            'balance_after' => $this->fresh()->loyalty_points,
            'description' => $description,
        ]);
    }

    public function canRedeemLoyalty(): bool
    {
        $requiredPoints = setting('loyalty_free_wash_points', 10);
        return $this->loyalty_points >= $requiredPoints;
    }

    public function getUnreadNotificationsCountAttribute(): int
    {
        return $this->notifications()->unread()->count();
    }
}
