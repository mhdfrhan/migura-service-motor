<?php

namespace App\Livewire\Staff;

use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class MyReviews extends Component
{
    use WithPagination;

    public $filterRating = 'all';

    public function setFilter(string $rating)
    {
        $this->filterRating = $rating;
        $this->resetPage();
    }

    public function render()
    {
        $staffId = Auth::id();

        // Get statistics
        $stats = Review::where('staff_id', $staffId)
            ->select(
                DB::raw('COUNT(*) as total_reviews'),
                DB::raw('AVG(rating) as average_rating'),
                DB::raw('SUM(CASE WHEN rating = 5 THEN 1 ELSE 0 END) as five_stars'),
                DB::raw('SUM(CASE WHEN rating = 4 THEN 1 ELSE 0 END) as four_stars'),
                DB::raw('SUM(CASE WHEN rating = 3 THEN 1 ELSE 0 END) as three_stars'),
                DB::raw('SUM(CASE WHEN rating = 2 THEN 1 ELSE 0 END) as two_stars'),
                DB::raw('SUM(CASE WHEN rating = 1 THEN 1 ELSE 0 END) as one_star')
            )
            ->first();

        // Get reviews with filter
        $query = Review::with(['user', 'booking.servicePackage'])
            ->where('staff_id', $staffId);

        if ($this->filterRating !== 'all') {
            $query->where('rating', $this->filterRating);
        }

        $reviews = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('livewire.staff.my-reviews', [
            'stats' => $stats,
            'reviews' => $reviews,
        ])->layout('components.staff-layout');
    }
}
