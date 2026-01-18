<?php

namespace App\Livewire;

use App\Models\Booking;
use App\Models\BookingTimeSlot;
use App\Models\EngineCapacity;
use App\Models\PromoCode;
use App\Models\PromoCodeUsage;
use App\Models\ServicePackage;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BookingForm extends Component
{
    public ?int $engineCapacityId = null;

    public ?int $servicePackageId = null;

    public ?string $selectedDate = null;

    public ?string $selectedTime = null;

    public int $currentMonth;

    public int $currentYear;

    public bool $useLoyaltyPoint = false;

    public bool $isProcessing = false;

    public ?string $promoCode = null;

    public ?PromoCode $appliedPromoCode = null;

    public float $promoDiscount = 0;

    public function updatedUseLoyaltyPoint($value): void
    {
        if ($value) {
            // Reset promo code when using loyalty point
            $this->removePromoCode();
        }
    }

    // Data Collections
    public $engineCapacities;

    public $servicePackages;

    public $availableTimeSlots = [];

    public $aiRecommendation = null;

    public $showRecommendation = true;

    public function mount(): void
    {
        $this->currentMonth = (int) date('n');
        $this->currentYear = (int) date('Y');
        $this->selectedDate = date('Y-m-d');

        // Load active engine capacities
        $this->engineCapacities = EngineCapacity::where('is_active', true)
            ->orderBy('min_cc')
            ->get();

        // Load active service packages
        $this->servicePackages = ServicePackage::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        // Get AI recommendation for authenticated users
        if (Auth::check()) {
            $this->aiRecommendation = get_smart_recommendation(Auth::user());
        }

        // Set default selections
        if ($this->engineCapacities->isNotEmpty()) {
            $this->engineCapacityId = $this->engineCapacities->first()->id;
        }

        // Check if package is passed from URL (AI recommendation)
        $packageId = request()->query('package');
        if ($packageId && $this->servicePackages->contains('id', $packageId)) {
            $this->servicePackageId = (int) $packageId;
        } elseif ($this->servicePackages->isNotEmpty()) {
            // Use AI recommendation if available, otherwise use popular
            if ($this->aiRecommendation && $this->aiRecommendation['package']) {
                $this->servicePackageId = $this->aiRecommendation['package']->id;
            } else {
                $popularPackage = $this->servicePackages->where('is_popular', true)->first();
                $this->servicePackageId = $popularPackage ? $popularPackage->id : $this->servicePackages->first()->id;
            }
        }

        // Load available time slots for today
        $this->loadAvailableTimeSlots($this->selectedDate);
    }

    public function selectEngine(int $engineCapacityId): void
    {
        $this->engineCapacityId = $engineCapacityId;
    }

    public function selectPackage(int $servicePackageId): void
    {
        $this->servicePackageId = $servicePackageId;
    }

    public function dismissRecommendation(): void
    {
        $this->showRecommendation = false;
    }

    public function selectDate(string $date): void
    {
        // Validasi: hanya bisa pilih tanggal hari ini atau ke depan
        $today = date('Y-m-d');
        $maxDate = date('Y-m-d', strtotime('+3 months'));

        if ($date >= $today && $date <= $maxDate) {
            $this->selectedDate = $date;
            $this->selectedTime = null; // Reset time when date changes
            $this->loadAvailableTimeSlots($date);
        }
    }

    public function selectTime(string $time): void
    {
        $this->selectedTime = $time;
    }

    public function changeMonth(string $monthYear): void
    {
        // Format: "2025-01"
        [$year, $month] = explode('-', $monthYear);
        $this->currentYear = (int) $year;
        $this->currentMonth = (int) $month;
    }

    public function previousMonth(): void
    {
        $currentYearMonth = date('Y-m');
        $selectedYearMonth = sprintf('%04d-%02d', $this->currentYear, $this->currentMonth);

        if ($selectedYearMonth <= $currentYearMonth) {
            return;
        }

        if ($this->currentMonth == 1) {
            $this->currentMonth = 12;
            $this->currentYear--;
        } else {
            $this->currentMonth--;
        }
    }

    public function nextMonth(): void
    {
        $maxDate = date('Y-m', strtotime('+3 months'));
        $selectedYearMonth = sprintf('%04d-%02d', $this->currentYear, $this->currentMonth);

        if ($selectedYearMonth >= $maxDate) {
            return;
        }

        if ($this->currentMonth == 12) {
            $this->currentMonth = 1;
            $this->currentYear++;
        } else {
            $this->currentMonth++;
        }
    }

    public function getAvailableMonths(): array
    {
        $months = [];
        $currentDate = new \DateTime;

        for ($i = 0; $i < 4; $i++) {
            $date = clone $currentDate;
            $date->modify("+{$i} months");
            $months[] = [
                'value' => $date->format('Y-m'),
                'label' => $date->format('F Y'),
            ];
        }

        return $months;
    }

    public function applyPromoCode(): void
    {
        $this->appliedPromoCode = null;
        $this->promoDiscount = 0;

        if (! $this->promoCode) {
            return;
        }

        $promo = PromoCode::where('code', strtoupper($this->promoCode))
            ->available()
            ->first();

        if (! $promo) {
            $this->dispatch('notify', type: 'error', message: 'Kode promo tidak valid atau sudah tidak berlaku!');
            $this->promoCode = null;

            return;
        }

        // Calculate total price first
        $totalPrice = $this->getPrice();

        // Check minimum transaction
        if ($totalPrice < $promo->min_transaction) {
            $this->dispatch('notify', type: 'error', message: 'Minimal transaksi untuk promo ini adalah Rp'.number_format($promo->min_transaction, 0, ',', '.').'!');
            $this->promoCode = null;

            return;
        }

        // Calculate discount
        $this->appliedPromoCode = $promo;
        $this->promoDiscount = $promo->calculateDiscount($totalPrice);

        if ($this->promoDiscount > 0) {
            $this->dispatch('notify', type: 'success', message: 'Promo code berhasil diterapkan! Diskon: Rp'.number_format($this->promoDiscount, 0, ',', '.'));
        }
    }

    public function removePromoCode(): void
    {
        $this->promoCode = null;
        $this->appliedPromoCode = null;
        $this->promoDiscount = 0;
    }

    public function getPrice(): float
    {
        if (! $this->servicePackageId || ! $this->engineCapacityId) {
            return 0;
        }

        $package = ServicePackage::find($this->servicePackageId);
        $engine = EngineCapacity::find($this->engineCapacityId);

        if (! $package || ! $engine) {
            return 0;
        }

        $basePrice = $package->base_price;
        $multiplier = $engine->price_multiplier;

        return $basePrice * $multiplier;
    }

    public function getTotalPrice(): float
    {
        $price = $this->getPrice();
        $discount = $this->promoDiscount;

        return max(0, $price - $discount);
    }

    public function proceed(): void
    {
        // Prevent double submission
        if ($this->isProcessing) {
            return;
        }

        if (! $this->selectedTime) {
            $this->dispatch('notify', type: 'error', message: 'Silakan pilih waktu terlebih dahulu');

            return;
        }

        // Validate that selected time is not in the past (if booking for today)
        if ($this->selectedDate === date('Y-m-d')) {
            $selectedDateTime = \Carbon\Carbon::parse($this->selectedDate.' '.$this->selectedTime);
            if ($selectedDateTime->isPast()) {
                $this->dispatch('notify', type: 'error', message: 'Waktu yang dipilih sudah lewat. Silakan pilih waktu yang akan datang.');

                return;
            }
        }

        if (! Auth::check()) {
            session()->flash('error', 'Silakan login terlebih dahulu untuk melanjutkan booking');
            $this->redirect(route('login'), navigate: true);

            return;
        }

        // Check if trying to use loyalty but no points available
        if ($this->useLoyaltyPoint && ! canRedeemLoyalty(Auth::id())) {
            $this->dispatch('notify', type: 'error', message: 'Anda tidak memiliki poin loyalty yang tersedia');

            return;
        }

        // Set processing flag to prevent double submission
        $this->isProcessing = true;

        try {
            $package = ServicePackage::findOrFail($this->servicePackageId);
            $engine = EngineCapacity::findOrFail($this->engineCapacityId);

            $basePrice = $package->base_price;
            $engineSurcharge = $basePrice * ($engine->price_multiplier - 1.0);
            $totalPrice = $basePrice + $engineSurcharge;

            // Calculate promo discount if applied (only if not using loyalty point)
            $promoDiscount = 0;
            if ($this->appliedPromoCode && ! $this->useLoyaltyPoint) {
                $promoDiscount = $this->appliedPromoCode->calculateDiscount($totalPrice);
            }

            // If using loyalty point, make it free
            $isFree = $this->useLoyaltyPoint;
            $finalPrice = $isFree ? 0 : ($totalPrice - $promoDiscount);

            // Create booking
            $booking = Booking::create([
                'booking_code' => generateBookingCode(),
                'user_id' => Auth::id(),
                'service_package_id' => $this->servicePackageId,
                'engine_capacity_id' => $this->engineCapacityId,
                'booking_type' => 'regular',
                'booking_date' => $this->selectedDate,
                'booking_time' => $this->selectedTime,
                'service_price' => $basePrice,
                'engine_surcharge' => $engineSurcharge,
                'home_service_fee' => 0,
                'discount_amount' => $isFree ? $totalPrice : $promoDiscount,
                'total_price' => $finalPrice,
                'status' => $isFree ? 'confirmed' : 'awaiting_payment',
                'is_loyalty_reward' => $isFree,
            ]);

            // Save promo code usage if applied
            if ($this->appliedPromoCode && ! $isFree) {
                PromoCodeUsage::create([
                    'promo_code_id' => $this->appliedPromoCode->id,
                    'user_id' => Auth::id(),
                    'booking_id' => $booking->id,
                    'discount_amount' => $promoDiscount,
                ]);

                // Increment usage count
                $this->appliedPromoCode->incrementUsage();
            }

            // Update time slot availability
            BookingTimeSlot::where('date', $this->selectedDate)
                ->where('time_slot', $this->selectedTime)
                ->increment('booked_count');

            // If using loyalty point, redeem it
            if ($isFree) {
                redeemLoyaltyPoint(Auth::id(), $booking->id);
            }

            // Send notification
            $notificationMessage = $isFree
                ? "Selamat! Anda menggunakan poin loyalty untuk cuci gratis. Booking {$booking->booking_code} telah dikonfirmasi."
                : "Booking {$booking->booking_code} berhasil dibuat. Silakan lanjutkan ke pembayaran.";

            sendNotification(
                Auth::id(),
                'booking_created',
                'Booking Berhasil Dibuat',
                $notificationMessage
            );

            // Log activity
            logActivity('created_booking', 'Booking', $booking->id, [], $booking->toArray());

            session()->flash('success', $isFree ? 'Selamat! Cuci gratis Anda telah dikonfirmasi!' : 'Booking berhasil dibuat! Silakan lanjutkan ke pembayaran.');

            if ($isFree) {
                $this->redirect(route('dashboard'), navigate: true);
            } else {
                // Store booking ID in session instead of URL parameter for security
                session(['pending_payment_booking_id' => $booking->id]);
                $this->redirect(route('payment.confirm'), navigate: true);
            }
        } catch (\Exception $e) {
            $this->isProcessing = false; // Reset processing flag on error
            $this->dispatch('notify', type: 'error', message: 'Terjadi kesalahan saat membuat booking. Silakan coba lagi.');
            logger()->error('Booking creation failed: '.$e->getMessage());
        }
    }

    protected function loadAvailableTimeSlots(string $date): void
    {
        $this->availableTimeSlots = getAvailableTimeSlots($date);
    }

    public function render()
    {
        return view('livewire.booking-form');
    }
}
