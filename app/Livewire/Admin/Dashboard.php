<?php

namespace App\Livewire\Admin;

use App\Models\Booking;
use App\Models\PaymentProof;
use App\Models\Review;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboard extends Component
{
    // Statistics
    public int $totalBookings = 0;
    public int $pendingPayments = 0;
    public int $activeBookings = 0;
    public int $completedToday = 0;
    public float $todayRevenue = 0;
    public float $monthRevenue = 0;
    public float $averageRating = 0;
    public int $totalCustomers = 0;

    // Recent Data
    public $recentBookings;
    public $pendingVerifications;
    public $recentReviews;

    // Chart Data
    public array $weeklyBookings = [];
    public array $monthlyRevenue = [];
    public array $servicePackageStats = [];
    public array $bookingStatusStats = [];

    public function mount(): void
    {
        $this->loadStatistics();
        $this->loadRecentData();
        $this->loadChartData();
    }

    protected function loadStatistics(): void
    {
        $today = Carbon::today();
        $startOfMonth = Carbon::now()->startOfMonth();

        // Total Bookings
        $this->totalBookings = Booking::count();

        // Pending Payments (awaiting verification)
        $this->pendingPayments = PaymentProof::where('verification_status', 'pending')->count();

        // Active Bookings (in progress)
        $this->activeBookings = Booking::whereIn('status', ['confirmed', 'in_progress'])->count();

        // Completed Today
        $this->completedToday = Booking::where('status', 'completed')
            ->whereDate('completed_at', $today)
            ->count();

        // Today's Revenue
        $this->todayRevenue = Booking::where('status', 'completed')
            ->whereDate('completed_at', $today)
            ->sum('total_price');

        // Month Revenue
        $this->monthRevenue = Booking::where('status', 'completed')
            ->where('completed_at', '>=', $startOfMonth)
            ->sum('total_price');

        // Average Rating
        $this->averageRating = Review::avg('rating') ?? 0;

        // Total Customers
        $this->totalCustomers = User::where('role', 'customer')->count();
    }

    protected function loadRecentData(): void
    {
        // Recent Bookings (last 5)
        $this->recentBookings = Booking::with(['user', 'servicePackage', 'engineCapacity'])
            ->latest()
            ->take(5)
            ->get();

        // Pending Payment Verifications
        $this->pendingVerifications = PaymentProof::with(['booking.user', 'booking.servicePackage'])
            ->where('verification_status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        // Recent Reviews
        $this->recentReviews = Review::with(['user', 'booking.servicePackage', 'staff'])
            ->latest()
            ->take(5)
            ->get();
    }

    protected function loadChartData(): void
    {
        // Weekly Bookings (last 7 days)
        $this->weeklyBookings = $this->getWeeklyBookings();

        // Monthly Revenue (last 6 months)
        $this->monthlyRevenue = $this->getMonthlyRevenue();

        // Service Package Stats
        $this->servicePackageStats = Booking::select('service_package_id', DB::raw('count(*) as total'))
            ->with('servicePackage:id,name')
            ->groupBy('service_package_id')
            ->get()
            ->map(fn($item) => [
                'name' => $item->servicePackage->name ?? 'Unknown',
                'total' => $item->total,
            ])
            ->toArray();

        // Booking Status Stats
        $this->bookingStatusStats = Booking::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get()
            ->map(fn($item) => [
                'status' => $item->status,
                'total' => $item->total,
                'label' => $this->getStatusLabel($item->status),
            ])
            ->toArray();
    }

    protected function getWeeklyBookings(): array
    {
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $count = Booking::whereDate('created_at', $date)->count();
            
            $data[] = [
                'date' => $date->format('D'),
                'count' => $count,
            ];
        }
        return $data;
    }

    protected function getMonthlyRevenue(): array
    {
        $data = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $revenue = Booking::where('status', 'completed')
                ->whereYear('completed_at', $month->year)
                ->whereMonth('completed_at', $month->month)
                ->sum('total_price');
            
            $data[] = [
                'month' => $month->format('M'),
                'revenue' => $revenue,
            ];
        }
        return $data;
    }

    protected function getStatusLabel(string $status): string
    {
        return match ($status) {
            'pending' => 'Pending',
            'awaiting_payment' => 'Menunggu Pembayaran',
            'payment_uploaded' => 'Bukti Diupload',
            'payment_verified' => 'Pembayaran Terverifikasi',
            'confirmed' => 'Dikonfirmasi',
            'in_progress' => 'Sedang Dikerjakan',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
            'rejected' => 'Ditolak',
            default => $status,
        };
    }

    public function render()
    {
        return view('livewire.admin.dashboard')
            ->layout('layouts.admin');
    }
}
