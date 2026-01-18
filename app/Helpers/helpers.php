<?php

use App\Models\ActivityLog;
use App\Models\Booking;
use App\Models\BookingTimeSlot;
use App\Models\LoyaltyTransaction;
use App\Models\Notification;
use App\Models\OperatingHours;
use App\Models\ServicePackage;
use App\Models\SystemSetting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

if (! function_exists('setting')) {
    /**
     * Get system setting value dengan cache
     */
    function setting(string $key, mixed $default = null): mixed
    {
        return Cache::remember("setting.{$key}", 3600, function () use ($key, $default) {
            $setting = SystemSetting::where('key', $key)->first();

            if (! $setting) {
                return $default;
            }

            return match ($setting->type) {
                'integer' => (int) $setting->value,
                'boolean' => filter_var($setting->value, FILTER_VALIDATE_BOOLEAN),
                'json' => json_decode($setting->value, true),
                'array' => json_decode($setting->value, true),
                default => $setting->value,
            };
        });
    }
}

if (! function_exists('set_setting')) {
    /**
     * Set system setting value dan clear cache
     */
    function set_setting(string $key, mixed $value, string $type = 'string'): void
    {
        $setting = SystemSetting::firstOrNew(['key' => $key]);

        $setting->value = match ($type) {
            'boolean' => $value ? 'true' : 'false',
            'json', 'array' => json_encode($value),
            default => (string) $value,
        };

        $setting->type = $type;
        $setting->save();

        Cache::forget("setting.{$key}");
    }
}

if (! function_exists('format_currency')) {
    /**
     * Format currency ke format IDR
     */
    function format_currency(float|int $amount, bool $withPrefix = true): string
    {
        $formatted = number_format($amount, 0, ',', '.');

        return $withPrefix ? "Rp{$formatted}" : $formatted;
    }
}

if (! function_exists('formatRupiah')) {
    /**
     * Alias untuk format_currency()
     */
    function formatRupiah(float|int $amount, bool $withPrefix = true): string
    {
        return format_currency($amount, $withPrefix);
    }
}

if (! function_exists('getStatusBadgeClass')) {
    /**
     * Alias untuk get_status_badge_class()
     */
    function getStatusBadgeClass(string $status): string
    {
        return get_status_badge_class($status);
    }
}

if (! function_exists('calculate_distance')) {
    /**
     * Calculate distance between two coordinates using Haversine formula
     *
     * @return float Distance in kilometers
     */
    function calculate_distance(float $lat1, float $lon1, float $lat2, float $lon2): float
    {
        $earthRadius = 6371; // km

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return round($earthRadius * $c, 2);
    }
}

if (! function_exists('calculate_home_service_fee')) {
    /**
     * Calculate home service fee based on distance
     */
    function calculate_home_service_fee(float $distanceKm): float
    {
        $baseFee = setting('home_service_base_fee', 10000);
        $perKmFee = setting('home_service_per_km_fee', 2000);

        return $baseFee + ($distanceKm * $perKmFee);
    }
}

if (! function_exists('is_within_service_area')) {
    /**
     * Check if location is within service area
     */
    function is_within_service_area(float $distanceKm): bool
    {
        $maxDistance = setting('home_service_max_distance', 10);

        return $distanceKm <= $maxDistance;
    }
}

if (! function_exists('predict_wait_time')) {
    /**
     * Predict wait time based on bookings ahead
     *
     * @return int Minutes
     */
    function predict_wait_time(int $bookingsAhead, int $averageDuration = 30): int
    {
        $baseWaitTime = setting('ai_base_wait_time', 30);
        $waitTimePerBooking = setting('ai_wait_time_per_booking', 5);

        return $baseWaitTime + ($bookingsAhead * $waitTimePerBooking);
    }
}

if (! function_exists('generate_booking_code')) {
    /**
     * Generate unique booking code
     */
    function generate_booking_code(): string
    {
        $prefix = 'MIG';
        $year = now()->year;
        $randomPart = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 6));

        return "{$prefix}-{$year}-{$randomPart}";
    }
}

if (! function_exists('get_status_badge_class')) {
    /**
     * Get badge class for booking status
     */
    function get_status_badge_class(string $status): string
    {
        return match ($status) {
            'pending' => 'bg-gray-100 text-gray-800',
            'awaiting_payment' => 'bg-yellow-100 text-yellow-800',
            'payment_uploaded' => 'bg-blue-100 text-blue-800',
            'payment_verified' => 'bg-indigo-100 text-indigo-800',
            'confirmed' => 'bg-purple-100 text-purple-800',
            'in_progress' => 'bg-sky-100 text-sky-800',
            'completed' => 'bg-green-100 text-green-800',
            'cancelled' => 'bg-red-100 text-red-800',
            'rejected' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }
}

if (! function_exists('send_notification')) {
    /**
     * Send notification to user
     */
    function send_notification(int $userId, string $type, string $title, string $message, array $data = []): void
    {
        Notification::create([
            'user_id' => $userId,
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'data' => $data,
        ]);

        // Note: Real-time notification updates are handled by component polling
        // or can be implemented using Laravel Broadcasting for WebSocket support
    }
}

if (! function_exists('log_activity')) {
    /**
     * Log user activity
     */
    function log_activity(
        string $action,
        ?string $modelType = null,
        ?int $modelId = null,
        array $oldValues = [],
        array $newValues = []
    ): void {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'model_type' => $modelType,
            'model_id' => $modelId,
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }
}

if (! function_exists('get_day_name')) {
    /**
     * Get Indonesian day name
     */
    function get_day_name(string $englishDay): string
    {
        return match (strtolower($englishDay)) {
            'monday' => 'Senin',
            'tuesday' => 'Selasa',
            'wednesday' => 'Rabu',
            'thursday' => 'Kamis',
            'friday' => 'Jumat',
            'saturday' => 'Sabtu',
            'sunday' => 'Minggu',
            default => $englishDay,
        };
    }
}

if (! function_exists('get_time_slots')) {
    /**
     * Get available time slots for booking
     */
    function get_time_slots(Carbon $date): array
    {
        $dayOfWeek = strtolower($date->englishDayOfWeek);
        $operatingHours = OperatingHours::where('day_of_week', $dayOfWeek)->first();

        if (! $operatingHours || $operatingHours->is_closed) {
            return [];
        }

        $slots = [];
        $start = Carbon::parse($operatingHours->open_time);
        $end = Carbon::parse($operatingHours->close_time);

        while ($start->lt($end)) {
            $slots[] = $start->format('H:i');
            $start->addMinutes(15); // Changed from addHour() to addMinutes(15)
        }

        return $slots;
    }
}

if (! function_exists('recommend_service_package')) {
    /**
     * AI-based (rule-based) recommendation untuk service package
     */
    function recommend_service_package(User $user): ?ServicePackage
    {
        $bookingHistory = $user->bookings()
            ->with('servicePackage')
            ->where('status', 'completed')
            ->latest()
            ->take(5)
            ->get();

        if ($bookingHistory->isEmpty()) {
            // New customer: recommend popular package
            return ServicePackage::where('is_popular', true)->first();
        }

        // Find most frequently booked package
        $packageCounts = $bookingHistory->groupBy('service_package_id')->map->count();
        $mostBookedPackageId = $packageCounts->sortDesc()->keys()->first();

        // Rule: If user always books basic, recommend upgrade after 5 bookings
        $mostBookedPackage = ServicePackage::find($mostBookedPackageId);
        if ($mostBookedPackage && $user->total_bookings >= 5) {
            $nextPackage = ServicePackage::where('base_price', '>', $mostBookedPackage->base_price)
                ->orderBy('base_price')
                ->first();

            return $nextPackage ?? $mostBookedPackage;
        }

        return $mostBookedPackage;
    }
}

if (! function_exists('get_smart_recommendation')) {
    /**
     * Advanced AI recommendation dengan multiple factors dan reasoning
     */
    function get_smart_recommendation(User $user, ?int $engineCapacityId = null): array
    {
        $reasons = [];
        $score = [];

        // Factor 1: Booking History (40% weight)
        $bookingHistory = $user->bookings()
            ->with('servicePackage')
            ->where('status', 'completed')
            ->latest()
            ->take(10)
            ->get();

        if ($bookingHistory->isEmpty()) {
            // New customer
            $popularPackage = ServicePackage::where('is_popular', true)->first();
            $reasons[] = 'Anda pelanggan baru, kami rekomendasikan paket populer kami';

            return [
                'package' => $popularPackage,
                'confidence' => 70,
                'reasons' => $reasons,
                'badge' => '🌟 Populer',
                'discount' => null,
            ];
        }

        // Find most booked package
        $packageCounts = $bookingHistory->groupBy('service_package_id')->map->count();
        $mostBookedPackageId = $packageCounts->sortDesc()->keys()->first();
        $mostBookedPackage = ServicePackage::find($mostBookedPackageId);

        // Factor 2: Loyalty Points (20% weight)
        if ($user->loyalty_points > 0) {
            $reasons[] = 'Anda punya ' . $user->loyalty_points . ' poin loyalty! Gunakan untuk cuci gratis';
            $score[$mostBookedPackageId] = ($score[$mostBookedPackageId] ?? 0) + 20;
        }

        // Factor 3: Upgrade Potential (30% weight)
        if ($user->total_bookings >= 5 && $mostBookedPackage) {
            $avgSpending = $bookingHistory->avg('total_price');
            $nextPackage = ServicePackage::where('base_price', '>', $mostBookedPackage->base_price)
                ->where('base_price', '<=', $avgSpending * 1.3)
                ->orderBy('base_price')
                ->first();

            if ($nextPackage) {
                $reasons[] = 'Setelah ' . $user->total_bookings . ' kali cuci, saatnya upgrade ke ' . $nextPackage->name;
                $score[$nextPackage->id] = ($score[$nextPackage->id] ?? 0) + 30;
                $recommendedPackage = $nextPackage;
                $badge = '⬆️ Upgrade';
            } else {
                $recommendedPackage = $mostBookedPackage;
                $badge = '❤️ Favorit Anda';
            }
        } else {
            $recommendedPackage = $mostBookedPackage;
            $reasons[] = 'Paket favorit Anda: ' . $mostBookedPackage->name;
            $badge = '❤️ Favorit';
        }

        // Factor 4: Seasonal/Promo (10% weight)
        $currentMonth = now()->month;
        if (in_array($currentMonth, [11, 12, 1, 2])) { // Musim hujan
            $detailingPackage = ServicePackage::where('name', 'like', '%Premium%')
                ->orWhere('name', 'like', '%Detailing%')
                ->first();
            if ($detailingPackage) {
                $reasons[] = 'Musim hujan tiba! Motor perlu perawatan ekstra';
                $recommendedPackage = $detailingPackage;
                $badge = '☔ Musim Hujan';
            }
        }

        // Calculate confidence score (0-100)
        $confidence = min(100, 60 + ($user->total_bookings * 5) + ($user->loyalty_points * 2));

        return [
            'package' => $recommendedPackage,
            'confidence' => $confidence,
            'reasons' => $reasons,
            'badge' => $badge ?? '✨ Recommended',
            'discount' => null, // Could add promo logic here
        ];
    }
}

// Alias functions untuk konsistensi penamaan
if (! function_exists('getSystemSetting')) {
    /**
     * Alias untuk setting()
     */
    function getSystemSetting(string $key, mixed $default = null): mixed
    {
        return setting($key, $default);
    }
}

if (! function_exists('generateBookingCode')) {
    /**
     * Alias untuk generate_booking_code()
     */
    function generateBookingCode(): string
    {
        return generate_booking_code();
    }
}

if (! function_exists('sendNotification')) {
    /**
     * Alias untuk send_notification()
     */
    function sendNotification(int $userId, string $type, string $title, string $message, array $data = []): void
    {
        send_notification($userId, $type, $title, $message, $data);
    }
}

if (! function_exists('logActivity')) {
    /**
     * Alias untuk log_activity()
     */
    function logActivity(
        string $action,
        ?string $modelType = null,
        ?int $modelId = null,
        array $oldValues = [],
        array $newValues = []
    ): void {
        log_activity($action, $modelType, $modelId, $oldValues, $newValues);
    }
}

if (! function_exists('getServiceFee')) {
    /**
     * Alias untuk calculate_home_service_fee()
     */
    function getServiceFee(float $distanceKm): float
    {
        return calculate_home_service_fee($distanceKm);
    }
}

if (! function_exists('getAvailableTimeSlots')) {
    /**
     * Get available time slots dengan check booking availability
     */
    function getAvailableTimeSlots(string $date): array
    {
        $carbonDate = Carbon::parse($date);
        $dayOfWeek = strtolower($carbonDate->englishDayOfWeek);

        $operatingHours = OperatingHours::where('day_of_week', $dayOfWeek)->first();

        if (! $operatingHours || $operatingHours->is_closed) {
            return [];
        }

        $slots = [];
        $start = Carbon::parse($operatingHours->open_time);
        $end = Carbon::parse($operatingHours->close_time);
        $maxCapacity = (int) setting('booking_slot_capacity', 5);

        // Check if selected date is today
        $isToday = $carbonDate->isToday();
        $now = now();

        while ($start->lt($end)) {
            $timeSlot = $start->format('H:i');

            // If today, skip time slots that have already passed
            if ($isToday) {
                // Create a Carbon instance for the selected date and time slot
                $slotDateTime = Carbon::parse($date . ' ' . $timeSlot);

                // Skip if the time slot is in the past (including current minute)
                if ($slotDateTime->lte($now)) {
                    $start->addMinutes(15);

                    continue;
                }
            }

            // Get or create time slot record
            $slot = BookingTimeSlot::firstOrCreate(
                [
                    'date' => $date,
                    'time_slot' => $timeSlot,
                ],
                [
                    'capacity' => $maxCapacity,
                    'booked_count' => 0,
                    'is_available' => true,
                ]
            );

            $slots[] = [
                'time' => $timeSlot,
                'available' => $slot->booked_count < $slot->capacity && $slot->is_available,
                'remaining' => max(0, $slot->capacity - $slot->booked_count),
            ];

            $start->addMinutes(15); // Changed from addHour() to addMinutes(15)
        }

        return $slots;
    }
}

if (! function_exists('isStoreOpen')) {
    /**
     * Check if store is open on given day
     */
    function isStoreOpen(string $dayName): bool
    {
        $operatingHours = OperatingHours::where('day_of_week', strtolower($dayName))->first();

        if (! $operatingHours) {
            return false;
        }

        return ! $operatingHours->is_closed;
    }
}

if (! function_exists('addLoyaltyPoint')) {
    /**
     * Add loyalty point when booking is completed
     */
    function addLoyaltyPoint(int $userId, int $bookingId): void
    {
        $user = User::find($userId);
        if (! $user) {
            return;
        }

        $loyaltyTarget = (int) setting('loyalty_target', 10);
        $completedBookings = Booking::where('user_id', $userId)
            ->where('status', 'completed')
            ->where('is_loyalty_reward', false)
            ->count();

        // Selalu buat transaksi untuk tracking progress
        $remaining = $loyaltyTarget - ($completedBookings % $loyaltyTarget);
        $currentCycle = floor($completedBookings / $loyaltyTarget) + 1;

        // Cek apakah sudah mencapai target loyalty
        if ($completedBookings > 0 && $completedBookings % $loyaltyTarget === 0) {
            // Berikan 1 poin loyalty (1 free wash)
            $user->increment('loyalty_points', 1);

            // Catat transaksi loyalty (poin diberikan)
            LoyaltyTransaction::create([
                'user_id' => $userId,
                'booking_id' => $bookingId,
                'type' => 'earned',
                'points' => 1,
                'balance_after' => $user->fresh()->loyalty_points,
                'description' => 'Gratis 1x cuci setelah ' . $loyaltyTarget . ' kali cuci',
            ]);

            // Kirim notifikasi
            sendNotification(
                $userId,
                'loyalty_earned',
                'Selamat! Anda Mendapat Cuci Gratis! 🎉',
                'Anda telah menyelesaikan ' . $loyaltyTarget . ' kali cuci dan mendapatkan 1x cuci gratis. Gunakan sekarang!'
            );

            // Log activity
            logActivity(
                'loyalty_earned',
                'LoyaltyTransaction',
                $userId,
                [],
                ['points' => 1, 'reason' => 'Completed ' . $loyaltyTarget . ' washes']
            );
        } else {
            // Catat transaksi progress (belum dapat poin, tapi progress tercatat)
            LoyaltyTransaction::create([
                'user_id' => $userId,
                'booking_id' => $bookingId,
                'type' => 'progress',
                'points' => 0,
                'balance_after' => $user->loyalty_points,
                'description' => "Progress loyalty: {$completedBookings}/{$loyaltyTarget} cuci (sisa {$remaining} cuci untuk gratis)",
            ]);
        }
    }
}

if (! function_exists('redeemLoyaltyPoint')) {
    /**
     * Redeem loyalty point for free wash
     */
    function redeemLoyaltyPoint(int $userId, int $bookingId): bool
    {
        $user = User::find($userId);
        if (! $user || $user->loyalty_points < 1) {
            return false;
        }

        // Kurangi loyalty point
        $user->decrement('loyalty_points', 1);

        // Catat transaksi loyalty
        LoyaltyTransaction::create([
            'user_id' => $userId,
            'booking_id' => $bookingId,
            'type' => 'redeemed',
            'points' => -1,
            'balance_after' => $user->fresh()->loyalty_points,
            'description' => 'Menggunakan poin loyalty untuk cuci gratis',
        ]);

        // Update booking menjadi gratis
        $booking = Booking::find($bookingId);
        if ($booking) {
            $booking->update([
                'is_loyalty_reward' => true,
                'total_price' => 0,
            ]);
        }

        // Kirim notifikasi
        sendNotification(
            $userId,
            'loyalty_redeemed',
            'Poin Loyalty Digunakan',
            'Anda telah menggunakan 1 poin loyalty untuk cuci gratis. Sisa poin: ' . $user->fresh()->loyalty_points
        );

        // Log activity
        logActivity(
            'loyalty_redeemed',
            'LoyaltyTransaction',
            $userId,
            [],
            ['points_used' => 1, 'booking_id' => $bookingId]
        );

        return true;
    }
}

if (! function_exists('canRedeemLoyalty')) {
    /**
     * Check if user can redeem loyalty point
     */
    function canRedeemLoyalty(int $userId): bool
    {
        $user = User::find($userId);

        return $user && $user->loyalty_points > 0;
    }
}

if (! function_exists('getLoyaltyProgress')) {
    /**
     * Get loyalty progress details for a user
     */
    function getLoyaltyProgress(int $userId): array
    {
        $user = User::find($userId);
        if (! $user) {
            return [
                'current' => 0,
                'target' => 10,
                'remaining' => 10,
                'percentage' => 0,
                'total_completed' => 0,
                'free_washes_earned' => 0,
            ];
        }

        $target = (int) getSystemSetting('loyalty_free_wash_points', 10);
        $totalCompleted = Booking::where('user_id', $userId)
            ->where('status', 'completed')
            ->count();

        // Calculate current cycle progress (0-9, resets at 10)
        $current = $totalCompleted % $target;
        $remaining = $target - $current;
        $percentage = ($current / $target) * 100;
        $freeWashesEarned = floor($totalCompleted / $target);

        return [
            'current' => $current,
            'target' => $target,
            'remaining' => $remaining,
            'percentage' => round($percentage, 1),
            'total_completed' => $totalCompleted,
            'free_washes_earned' => $freeWashesEarned,
        ];
    }
}
