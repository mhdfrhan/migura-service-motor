<?php

namespace App\Livewire\Admin;

use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class StaffPerformance extends Component
{
    public $selectedStaffId = null;

    public function selectStaff($staffId)
    {
        $this->selectedStaffId = $staffId;
    }

    public function clearSelection()
    {
        $this->selectedStaffId = null;
    }

    public function render()
    {
        // Get all staff with their review statistics
        $staffPerformance = User::where('role', 'staff')
            ->where('is_active', true)
            ->withCount('reviews')
            ->with(['reviews' => function ($query) {
                $query->select('staff_id', DB::raw('AVG(rating) as avg_rating'))
                    ->groupBy('staff_id');
            }])
            ->get()
            ->map(function ($staff) {
                $reviews = Review::where('staff_id', $staff->id)
                    ->select(
                        DB::raw('AVG(rating) as average_rating'),
                        DB::raw('COUNT(*) as total_reviews'),
                        DB::raw('SUM(CASE WHEN rating = 5 THEN 1 ELSE 0 END) as five_stars'),
                        DB::raw('SUM(CASE WHEN rating >= 4 THEN 1 ELSE 0 END) as positive_reviews')
                    )
                    ->first();

                return [
                    'id' => $staff->id,
                    'name' => $staff->name,
                    'email' => $staff->email,
                    'total_reviews' => $reviews->total_reviews ?? 0,
                    'average_rating' => round($reviews->average_rating ?? 0, 1),
                    'five_stars' => $reviews->five_stars ?? 0,
                    'positive_reviews' => $reviews->positive_reviews ?? 0,
                    'satisfaction_rate' => $reviews->total_reviews > 0
                        ? round(($reviews->positive_reviews / $reviews->total_reviews) * 100, 0)
                        : 0,
                ];
            })
            ->sortByDesc('average_rating')
            ->values();

        // Get selected staff details if any
        $selectedStaffDetails = null;
        if ($this->selectedStaffId) {
            $staff = User::find($this->selectedStaffId);
            $recentReviews = Review::with(['user', 'booking.servicePackage'])
                ->where('staff_id', $this->selectedStaffId)
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();

            $selectedStaffDetails = [
                'staff' => $staff,
                'recent_reviews' => $recentReviews,
            ];
        }

        // Overall statistics
        $overallStats = [
            'total_staff' => $staffPerformance->count(),
            'total_reviews' => $staffPerformance->sum('total_reviews'),
            'average_rating' => round($staffPerformance->avg('average_rating'), 1),
            'top_rated_staff' => $staffPerformance->first(),
        ];

        return view('livewire.admin.staff-performance', [
            'staffPerformance' => $staffPerformance,
            'overallStats' => $overallStats,
            'selectedStaffDetails' => $selectedStaffDetails,
        ]);
    }
}
