<?php

namespace App\Livewire;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CustomerDashboard extends Component
{
    public ?Booking $upcomingBooking = null;
    public $recentBookings;
    public array $loyaltyProgress = [];
    public int $availablePoints = 0;

    public function mount(): void
    {
        $user = Auth::user();

        // Load upcoming booking (latest active booking)
        $this->upcomingBooking = Booking::with(['servicePackage', 'engineCapacity', 'staffAssignment.staff'])
            ->where('user_id', $user->id)
            ->whereIn('status', ['awaiting_payment', 'payment_uploaded', 'payment_verified', 'confirmed', 'in_progress'])
            ->latest()
            ->first();

        // Load recent bookings (last 3 completed or cancelled)
        $this->recentBookings = Booking::with(['servicePackage', 'engineCapacity', 'staffAssignment.staff', 'review'])
            ->where('user_id', $user->id)
            ->whereIn('status', ['completed', 'cancelled'])
            ->latest()
            ->take(3)
            ->get();

        // Load loyalty info using getLoyaltyProgress() for consistency with loyalty-points page
        $this->loyaltyProgress = getLoyaltyProgress($user->id);
        $this->availablePoints = $user->loyalty_points ?? 0;
    }

    public function cancelBooking(int $bookingId): void
    {
        $booking = Booking::with('paymentProof')
            ->where('id', $bookingId)
            ->where('user_id', Auth::id())
            ->first();

        if (!$booking) {
            $this->dispatch('notify', type: 'error', message: 'Booking tidak ditemukan');
            return;
        }

        // Check if payment proof already exists
        if ($booking->paymentProof) {
            $this->dispatch('notify', type: 'error', message: 'Booking tidak dapat dibatalkan karena bukti pembayaran sudah diupload');
            return;
        }

        // Only allow cancellation for certain statuses
        if (!in_array($booking->status, ['pending', 'awaiting_payment'])) {
            $this->dispatch('notify', type: 'error', message: 'Booking tidak dapat dibatalkan pada status ini');
            return;
        }

        $booking->update([
            'status' => 'cancelled',
            'cancelled_at' => now(),
            'cancellation_reason' => 'Dibatalkan oleh pelanggan',
        ]);

        // Send notification
        sendNotification(
            Auth::id(),
            'booking_cancelled',
            'Booking Dibatalkan',
            "Booking {$booking->booking_code} telah dibatalkan.",
            ['booking_id' => $booking->id]
        );

        // Log activity
        logActivity('cancelled_booking', Booking::class, $booking->id, [], ['booking_code' => $booking->booking_code]);

        $this->dispatch('notify', type: 'success', message: 'Booking berhasil dibatalkan');
        $this->mount(); // Reload data
    }

    public function rescheduleBooking(): void
    {
        $this->redirect(route('booking.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.customer-dashboard');
    }
}
