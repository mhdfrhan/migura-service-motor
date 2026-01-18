<?php

namespace App\Livewire;

use App\Models\Booking;
use App\Models\PaymentMethod;
use App\Models\PaymentProof;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class PaymentConfirmation extends Component
{
    use WithFileUploads;

    public ?int $bookingId = null;
    public ?Booking $booking = null;
    public string $paymentMethod = 'bank'; // 'bank' or 'wallet' for UI, mapped to 'bank_transfer' or 'e_wallet' in DB
    public ?string $selectedBank = null;
    public $paymentProof;
    public bool $paymentProofUploaded = false;
    public string $service = '';
    public string $datetime = '';
    public float $basePrice = 0;
    public float $serviceFee = 0;
    public float $engineSurcharge = 0;
    public float $homeServiceFee = 0;
    public float $totalPrice = 0;

    // Dynamic payment methods
    public $bankTransfers = [];
    public $eWallets = [];

    public function mount(): void
    {
        // Get booking ID from session (not from URL for security)
        $this->bookingId = session('pending_payment_booking_id');

        // If no session, try to get from booking status (for users who already have pending payment)
        if (!$this->bookingId) {
            // Check if user has any booking with awaiting_payment status
            $pendingBooking = Booking::where('user_id', Auth::id())
                ->where('status', 'awaiting_payment')
                ->whereDoesntHave('paymentProof')
                ->latest()
                ->first();

            if ($pendingBooking) {
                // Set session for this booking
                session(['pending_payment_booking_id' => $pendingBooking->id]);
                $this->bookingId = $pendingBooking->id;
            } else {
                session()->flash('error', 'Booking tidak ditemukan');
                $this->redirect(route('booking.index'), navigate: true);
                return;
            }
        }

        // Load booking with relationships
        $this->booking = Booking::with(['servicePackage', 'engineCapacity', 'user', 'paymentProof'])
            ->where('id', $this->bookingId)
            ->where('user_id', Auth::id())
            ->first();

        if (!$this->booking) {
            session()->flash('error', 'Booking tidak ditemukan atau Anda tidak memiliki akses');
            session()->forget('pending_payment_booking_id');
            $this->redirect(route('dashboard'), navigate: true);
            return;
        }

        // Check if booking status is valid for payment
        if (!in_array($this->booking->status, ['awaiting_payment', 'payment_uploaded'])) {
            session()->flash('info', 'Booking ini sudah tidak memerlukan pembayaran');
            session()->forget('pending_payment_booking_id');
            $this->redirect(route('dashboard'), navigate: true);
            return;
        }

        // Set service and schedule info
        $this->service = $this->booking->servicePackage->name . ' - ' . $this->booking->engineCapacity->name;
        $this->datetime = date('d M Y', strtotime($this->booking->booking_date)) . ' • ' . $this->booking->booking_time . ' WIB';

        // Set price info
        $this->basePrice = $this->booking->service_price;
        $this->serviceFee = $this->booking->engine_surcharge; // This is the additional fee shown in summary
        $this->engineSurcharge = $this->booking->engine_surcharge;
        $this->homeServiceFee = $this->booking->home_service_fee;
        $this->totalPrice = $this->booking->total_price;

        // Load payment methods from database
        $this->bankTransfers = PaymentMethod::where('type', 'bank_transfer')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $this->eWallets = PaymentMethod::where('type', 'e_wallet')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        // Check if payment proof already exists
        if ($this->booking->paymentProof) {
            session()->flash('info', 'Bukti pembayaran sudah diupload sebelumnya. Menunggu verifikasi admin.');
            // Don't clear session yet, let user see the status
        }

        // Don't clear session here - only clear after payment is successfully confirmed
    }

    public function selectPaymentMethod(string $method): void
    {
        $this->paymentMethod = $method;
        $this->selectedBank = null;
    }

    public function selectBank(string $bank): void
    {
        $this->selectedBank = $bank;
    }

    public function updatedPaymentProof(): void
    {
        $this->validate([
            'paymentProof' => 'required|image|max:2048', // 2MB
        ], [
            'paymentProof.required' => 'Silakan pilih file bukti pembayaran',
            'paymentProof.image' => 'File harus berupa gambar',
            'paymentProof.max' => 'Ukuran file maksimal 2MB',
        ]);

        $this->paymentProofUploaded = true;
    }

    public function removePaymentProof(): void
    {
        $this->paymentProof = null;
        $this->paymentProofUploaded = false;
    }

    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    public function confirmPayment(): void
    {
        // Validasi
        if (!$this->paymentMethod) {
            $this->dispatch('notify', type: 'error', message: 'Pilih metode pembayaran terlebih dahulu');
            return;
        }

        if (!$this->paymentProof) {
            $this->dispatch('notify', type: 'error', message: 'Upload bukti pembayaran terlebih dahulu');
            return;
        }

        $this->validate([
            'paymentProof' => 'required|image|max:2048',
        ]);

        try {
            // Upload proof
            $path = $this->paymentProof->store('payment-proofs', 'public');

            // Map payment method to database value
            $dbPaymentMethod = match ($this->paymentMethod) {
                'bank' => 'bank_transfer',
                'wallet' => 'e_wallet',
                default => $this->paymentMethod,
            };

            // Save payment proof to database
            PaymentProof::create([
                'booking_id' => $this->booking->id,
                'payment_method' => $dbPaymentMethod,
                'bank_name' => $this->selectedBank,
                'amount' => $this->booking->total_price,
                'proof_image_path' => $path,
                'verification_status' => 'pending',
            ]);

            // Update booking status
            $this->booking->update([
                'status' => 'payment_uploaded',
                'payment_uploaded_at' => now(),
            ]);

            // Send notification
            sendNotification(
                Auth::id(),
                'payment_uploaded',
                'Bukti Pembayaran Berhasil Diupload',
                "Bukti pembayaran untuk booking {$this->booking->booking_code} telah diterima. Kami akan memverifikasi dalam 1x24 jam.",
                ['booking_id' => $this->booking->id]
            );

            // Log activity
            logActivity(
                'uploaded_payment_proof',
                PaymentProof::class,
                $this->booking->id,
                [],
                ['booking_code' => $this->booking->booking_code]
            );

            session()->flash('success', 'Bukti pembayaran berhasil diupload! Kami akan memverifikasi dalam 1x24 jam.');

            // Clear session only after payment is successfully confirmed
            session()->forget('pending_payment_booking_id');

            $this->redirect(route('booking.show', ['id' => $this->booking->id]), navigate: true);
        } catch (\Exception $e) {
            $this->dispatch('notify', type: 'error', message: 'Terjadi kesalahan saat mengupload bukti pembayaran');
            logger()->error('Payment proof upload failed: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.payment-confirmation');
    }
}
