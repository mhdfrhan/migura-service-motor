<?php

namespace App\Livewire;

use App\Models\Booking;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class MyOrders extends Component
{
    use WithPagination;

    public $filterStatus = 'all';

    public function setFilter(string $status)
    {
        $this->filterStatus = $status;
        $this->resetPage();
    }

    public function cancelBooking(int $bookingId)
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
            'Booking ' . $booking->booking_code . ' telah dibatalkan.'
        );

        $this->dispatch('notify', type: 'success', message: 'Booking berhasil dibatalkan');
    }

    public function hasReview(int $bookingId): bool
    {
        return Review::where('booking_id', $bookingId)
            ->where('user_id', Auth::id())
            ->exists();
    }

    public function goToPayment(int $bookingId): void
    {
        $booking = Booking::where('id', $bookingId)
            ->where('user_id', Auth::id())
            ->where('status', 'awaiting_payment')
            ->whereDoesntHave('paymentProof')
            ->first();

        if (!$booking) {
            $this->dispatch('notify', type: 'error', message: 'Booking tidak ditemukan atau sudah memiliki bukti pembayaran');
            return;
        }

        // Set session for payment confirmation
        session(['pending_payment_booking_id' => $booking->id]);
        $this->redirect(route('payment.confirm'), navigate: true);
    }

    public function render()
    {
        $query = Booking::with(['servicePackage', 'engineCapacity', 'paymentProof', 'review'])
            ->where('user_id', Auth::id());

        if ($this->filterStatus !== 'all') {
            if ($this->filterStatus === 'ongoing') {
                $query->whereIn('status', ['payment_verified', 'confirmed', 'in_progress']);
            } else {
                $query->where('status', $this->filterStatus);
            }
        }

        $bookings = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('livewire.my-orders', [
            'bookings' => $bookings,
        ])->layout('layouts.main');
    }
}
