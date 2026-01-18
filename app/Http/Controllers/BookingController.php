<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        return view('booking.index');
    }

    public function confirm()
    {
        return view('booking.confirm');
    }

    public function myOrders()
    {
        return view('my-orders');
    }

    public function show(Request $request, string $id)
    {
        $booking = Booking::with([
            'servicePackage',
            'engineCapacity',
            'user',
            'paymentProof',
            'staffAssignment.staff',
        ])
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Jika URL lama masih mengirim ?review=true, arahkan ke halaman review Livewire baru
        if ($request->boolean('review')) {
            return redirect()->route('booking.review', ['bookingId' => $booking->id]);
        }

        return view('booking.show', [
            'booking' => $booking,
        ]);
    }

    public function homeService()
    {
        return view('home-service.index');
    }
}
