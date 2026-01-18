<?php

namespace App\Livewire;

use App\Models\Booking;
use App\Models\BookingTimeSlot;
use App\Models\EngineCapacity;
use App\Models\Location;
use App\Models\PromoCode;
use App\Models\PromoCodeUsage;
use App\Models\ServicePackage;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class HomeService extends Component
{
    public int $currentStep = 1;

    // Location
    public string $address = '';

    public ?float $latitude = null;

    public ?float $longitude = null;

    public ?float $distance = null;

    public float $serviceFee = 0;

    // Nearest store location
    public ?Location $nearestLocation = null;

    public $availableLocations;

    // Package & Engine
    public ?int $servicePackageId = null;

    public ?int $engineCapacityId = null;

    public $servicePackages;

    public $engineCapacities;

    // Schedule
    public ?string $selectedDate = null;

    public ?string $selectedTime = null;

    public array $availableTimeSlots = [];

    public bool $isProcessing = false;

    public ?string $promoCode = null;

    public ?PromoCode $appliedPromoCode = null;

    public float $promoDiscount = 0;

    public function mount(): void
    {
        $this->selectedDate = date('Y-m-d');

        // Load all active locations
        $this->availableLocations = Location::active()->orderBy('is_main_branch', 'desc')->orderBy('sort_order')->get();

        // Get main branch as default
        $this->nearestLocation = Location::active()->mainBranch()->first()
            ?? Location::active()->first();

        // Load active packages
        $this->servicePackages = ServicePackage::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        // Load active engine capacities
        $this->engineCapacities = EngineCapacity::where('is_active', true)
            ->orderBy('min_cc')
            ->get();

        // Set defaults
        if ($this->servicePackages->isNotEmpty()) {
            $popularPackage = $this->servicePackages->where('is_popular', true)->first();
            $this->servicePackageId = $popularPackage ? $popularPackage->id : $this->servicePackages->first()->id;
        }

        if ($this->engineCapacities->isNotEmpty()) {
            $this->engineCapacityId = $this->engineCapacities->first()->id;
        }

        // Load available time slots
        $this->loadAvailableTimeSlots($this->selectedDate);
    }

    public function setLocation($lat, $lng): void
    {
        $this->latitude = $lat;
        $this->longitude = $lng;

        // Find nearest location
        $this->nearestLocation = Location::getNearestLocation($lat, $lng);

        if (! $this->nearestLocation) {
            $this->dispatch('notify', type: 'error', message: 'Tidak ada lokasi Migura Wash yang tersedia saat ini');
            $this->latitude = null;
            $this->longitude = null;
            $this->distance = null;

            return;
        }

        // Calculate distance
        $this->calculateDistance();

        // Validate if location is within service area
        if (! $this->nearestLocation->isWithinServiceArea($lat, $lng)) {
            $maxDistance = $this->nearestLocation->max_service_radius_km;
            $this->dispatch('notify', type: 'error', message: "Maaf, lokasi Anda terlalu jauh dari cabang {$this->nearestLocation->name} (maksimal {$maxDistance} km)");
            $this->latitude = null;
            $this->longitude = null;
            $this->distance = null;
            $this->nearestLocation = Location::active()->mainBranch()->first() ?? Location::active()->first();

            return;
        }

        $this->dispatch('notify', type: 'success', message: "Lokasi berhasil ditetapkan! Anda akan dilayani oleh cabang {$this->nearestLocation->name}");
    }

    public function calculateDistance(): void
    {
        if (! $this->latitude || ! $this->longitude || ! $this->nearestLocation) {
            return;
        }

        // Calculate distance to nearest location
        $rawDistance = $this->nearestLocation->distanceFrom($this->latitude, $this->longitude);
        $this->distance = round($rawDistance, 2);

        // Calculate service fee using location's method
        $this->serviceFee = $this->nearestLocation->calculateServiceFee($this->distance);
    }

    public function selectEngine(int $engineCapacityId): void
    {
        $this->engineCapacityId = $engineCapacityId;
    }

    public function selectPackage(int $servicePackageId): void
    {
        $this->servicePackageId = $servicePackageId;
    }

    public function selectTime(string $time): void
    {
        $this->selectedTime = $time;
    }

    public function updatedSelectedDate(string $date): void
    {
        if ($date) {
            $this->loadAvailableTimeSlots($date);
            $this->selectedTime = null; // Reset selected time when date changes
        }
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
        $totalPrice = $this->getSubTotalPrice();

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

    public function getSubTotalPrice(): float
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
        $engineSurcharge = $basePrice * ($engine->price_multiplier - 1.0);

        return $basePrice + $engineSurcharge + $this->serviceFee;
    }

    public function getTotalPrice(): float
    {
        $subTotal = $this->getSubTotalPrice();

        // Apply promo discount if exists
        if ($this->appliedPromoCode) {
            $subTotal -= $this->promoDiscount;
        }

        return max(0, $subTotal);
    }

    public function nextStep(): void
    {
        if ($this->currentStep === 1) {
            // Validate location
            if (! $this->latitude || ! $this->longitude) {
                $this->dispatch('notify', type: 'error', message: 'Silakan pilih lokasi terlebih dahulu');

                return;
            }
            if (! $this->address) {
                $this->dispatch('notify', type: 'error', message: 'Silakan masukkan alamat lengkap');

                return;
            }
        }

        if ($this->currentStep === 2) {
            // Validate package & engine (already selected by default)
        }

        if ($this->currentStep === 3) {
            // Validate schedule
            if (! $this->selectedTime) {
                $this->dispatch('notify', type: 'error', message: 'Silakan pilih waktu antar-jemput');

                return;
            }

            // Confirm booking
            $this->confirmBooking();

            return;
        }

        $this->currentStep++;
    }

    public function previousStep(): void
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    public function confirmBooking(): void
    {
        // Prevent double submission
        if ($this->isProcessing) {
            return;
        }

        if (! Auth::check()) {
            session()->flash('error', 'Silakan login terlebih dahulu');
            $this->redirect(route('login'), navigate: true);

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

        // Set processing flag to prevent double submission
        $this->isProcessing = true;

        try {
            $package = ServicePackage::findOrFail($this->servicePackageId);
            $engine = EngineCapacity::findOrFail($this->engineCapacityId);

            $basePrice = $package->base_price;
            $engineSurcharge = $basePrice * ($engine->price_multiplier - 1.0);
            $subTotal = $basePrice + $engineSurcharge + $this->serviceFee;

            // Calculate promo discount if applied
            $promoDiscount = 0;
            if ($this->appliedPromoCode) {
                $promoDiscount = $this->appliedPromoCode->calculateDiscount($subTotal);
            }

            $totalPrice = $subTotal - $promoDiscount;

            // Create booking
            $booking = Booking::create([
                'booking_code' => generateBookingCode(),
                'user_id' => Auth::id(),
                'service_package_id' => $this->servicePackageId,
                'engine_capacity_id' => $this->engineCapacityId,
                'booking_type' => 'home_service',
                'booking_date' => $this->selectedDate,
                'booking_time' => $this->selectedTime,
                'customer_address' => $this->address,
                'customer_latitude' => $this->latitude,
                'customer_longitude' => $this->longitude,
                'distance_km' => $this->distance,
                'service_price' => $basePrice,
                'engine_surcharge' => $engineSurcharge,
                'home_service_fee' => $this->serviceFee,
                'discount_amount' => $promoDiscount,
                'total_price' => $totalPrice,
                'status' => 'awaiting_payment',
            ]);

            // Save promo code usage if applied
            if ($this->appliedPromoCode) {
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

            // Send notification
            sendNotification(
                Auth::id(),
                'booking_created',
                'Booking Antar-Jemput Berhasil Dibuat',
                "Booking {$booking->booking_code} berhasil dibuat. Silakan lanjutkan ke pembayaran.",
                ['booking_id' => $booking->id]
            );

            // Log activity
            logActivity('created_home_service_booking', Booking::class, $booking->id, [], $booking->toArray());

            session()->flash('success', 'Booking antar-jemput berhasil dibuat! Silakan lanjutkan ke pembayaran.');

            // Store booking ID in session instead of URL parameter for security
            session(['pending_payment_booking_id' => $booking->id]);
            $this->redirect(route('payment.confirm'), navigate: true);
        } catch (\Exception $e) {
            $this->isProcessing = false; // Reset processing flag on error
            $this->dispatch('notify', type: 'error', message: 'Terjadi kesalahan saat membuat booking');
            logger()->error('Home service booking failed: '.$e->getMessage());
        }
    }

    protected function loadAvailableTimeSlots(string $date): void
    {
        $this->availableTimeSlots = getAvailableTimeSlots($date);
    }

    public function render()
    {
        // Prepare locations data for JavaScript
        $locationsForMap = $this->availableLocations->map(function ($loc) {
            return [
                'id' => $loc->id,
                'name' => $loc->name,
                'lat' => $loc->latitude,
                'lng' => $loc->longitude,
                'is_main' => $loc->is_main_branch,
                'radius' => $loc->max_service_radius_km,
            ];
        })->values()->all();

        return view('livewire.home-service', [
            'locationsForMap' => $locationsForMap,
        ]);
    }
}
