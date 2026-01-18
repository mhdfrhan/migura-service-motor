<?php

namespace App\Livewire\Admin;

use App\Exports\ReportsExport;
use App\Models\Booking;
use App\Models\PaymentProof;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Reports extends Component
{
    public $dateRange = 'month';

    public $startDate;

    public $endDate;

    public function mount()
    {
        $this->startDate = now()->startOfMonth()->format('Y-m-d');
        $this->endDate = now()->endOfMonth()->format('Y-m-d');
    }

    public function updatedDateRange()
    {
        match ($this->dateRange) {
            'today' => [
                $this->startDate = now()->format('Y-m-d'),
                $this->endDate = now()->format('Y-m-d'),
            ],
            'week' => [
                $this->startDate = now()->startOfWeek()->format('Y-m-d'),
                $this->endDate = now()->endOfWeek()->format('Y-m-d'),
            ],
            'month' => [
                $this->startDate = now()->startOfMonth()->format('Y-m-d'),
                $this->endDate = now()->endOfMonth()->format('Y-m-d'),
            ],
            'year' => [
                $this->startDate = now()->startOfYear()->format('Y-m-d'),
                $this->endDate = now()->endOfYear()->format('Y-m-d'),
            ],
            default => [],
        };
    }

    public function render()
    {
        $start = Carbon::parse($this->startDate)->startOfDay();
        $end = Carbon::parse($this->endDate)->endOfDay();

        // Booking Statistics
        $totalBookings = Booking::whereBetween('created_at', [$start, $end])->count();
        $completedBookings = Booking::whereBetween('created_at', [$start, $end])
            ->where('status', 'completed')->count();
        $cancelledBookings = Booking::whereBetween('created_at', [$start, $end])
            ->where('status', 'cancelled')->count();
        $pendingBookings = Booking::whereBetween('created_at', [$start, $end])
            ->whereIn('status', ['pending', 'awaiting_payment', 'payment_uploaded'])->count();

        // Revenue Statistics
        $totalRevenue = Booking::whereBetween('created_at', [$start, $end])
            ->where('status', 'completed')
            ->sum('total_price');
        $verifiedPayments = PaymentProof::whereBetween('created_at', [$start, $end])
            ->where('verification_status', 'verified')
            ->sum('amount');
        $pendingPayments = PaymentProof::whereBetween('created_at', [$start, $end])
            ->where('verification_status', 'pending')
            ->sum('amount');

        // User Statistics
        $newCustomers = User::whereBetween('created_at', [$start, $end])
            ->where('role', 'customer')->count();
        $activeCustomers = User::where('role', 'customer')
            ->where('is_active', true)
            ->whereHas('bookings', function ($q) use ($start, $end) {
                $q->whereBetween('created_at', [$start, $end]);
            })->count();

        // Booking by Status
        $bookingsByStatus = Booking::whereBetween('created_at', [$start, $end])
            ->selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // Booking by Service Package
        $bookingsByService = Booking::whereBetween('created_at', [$start, $end])
            ->with('servicePackage')
            ->get()
            ->groupBy('servicePackage.name')
            ->map(fn($group) => $group->count())
            ->toArray();

        // Daily Revenue (last 30 days)
        $dailyRevenue = Booking::whereBetween('created_at', [
            now()->subDays(30)->startOfDay(),
            now()->endOfDay(),
        ])
            ->where('status', 'completed')
            ->selectRaw('DATE(created_at) as date, SUM(total_price) as revenue')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->mapWithKeys(fn($item) => [$item->date => (float) $item->revenue])
            ->toArray();

        return view('livewire.admin.reports', [
            'totalBookings' => $totalBookings,
            'completedBookings' => $completedBookings,
            'cancelledBookings' => $cancelledBookings,
            'pendingBookings' => $pendingBookings,
            'totalRevenue' => $totalRevenue,
            'verifiedPayments' => $verifiedPayments,
            'pendingPayments' => $pendingPayments,
            'newCustomers' => $newCustomers,
            'activeCustomers' => $activeCustomers,
            'bookingsByStatus' => $bookingsByStatus,
            'bookingsByService' => $bookingsByService,
            'dailyRevenue' => $dailyRevenue,
        ]);
    }

    public function export()
    {
        $filename = 'reports-'.$this->startDate.'-to-'.$this->endDate.'-'.now()->format('His').'.xlsx';

        return Excel::download(new ReportsExport($this->startDate, $this->endDate), $filename);
    }
}
