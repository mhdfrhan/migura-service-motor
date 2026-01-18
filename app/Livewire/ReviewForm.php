<?php

namespace App\Livewire;

use App\Models\Booking;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ReviewForm extends Component
{
    use WithFileUploads;

    public $bookingId;
    public $booking;
    public $rating = 5;
    public $comment = '';
    public $photos = [];
    public $existingReview;

    public function mount(int $bookingId)
    {
        $this->bookingId = $bookingId;

        // Load booking
        $this->booking = Booking::with(['servicePackage', 'staffAssignments.staff'])
            ->where('id', $bookingId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Check if booking is completed
        if ($this->booking->status !== 'completed') {
            session()->flash('error', 'Anda hanya dapat memberikan review untuk booking yang telah selesai.');
            return redirect()->route('my-orders');
        }

        // Check if review already exists
        $this->existingReview = Review::where('booking_id', $bookingId)
            ->where('user_id', Auth::id())
            ->first();

        if ($this->existingReview) {
            $this->rating = $this->existingReview->rating;
            $this->comment = $this->existingReview->comment;
        }
    }

    public function updatedPhotos()
    {
        $this->validate([
            'photos.*' => 'image|max:2048', // 2MB Max per image
        ]);
    }

    public function removePhoto(int $index)
    {
        unset($this->photos[$index]);
        $this->photos = array_values($this->photos);
    }

    public function submitReview()
    {
        $this->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10|max:500',
            'photos.*' => 'nullable|image|max:2048',
        ], [
            'rating.required' => 'Rating wajib diisi',
            'rating.min' => 'Rating minimal 1 bintang',
            'rating.max' => 'Rating maksimal 5 bintang',
            'comment.required' => 'Komentar wajib diisi',
            'comment.min' => 'Komentar minimal 10 karakter',
            'comment.max' => 'Komentar maksimal 500 karakter',
            'photos.*.image' => 'File harus berupa gambar',
            'photos.*.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        // Upload photos if any
        $photosPaths = [];
        if (!empty($this->photos)) {
            foreach ($this->photos as $photo) {
                $path = $photo->store('reviews', 'public');
                $photosPaths[] = $path;
            }
        }

        // Get staff ID from staff assignments
        $staffId = $this->booking->staffAssignments->first()?->staff_id;

        if ($this->existingReview) {
            // Update existing review
            $this->existingReview->update([
                'rating' => $this->rating,
                'comment' => $this->comment,
                'photos' => !empty($photosPaths) ? $photosPaths : $this->existingReview->photos,
            ]);

            $message = 'Review berhasil diperbarui!';
        } else {
            // Create new review
            Review::create([
                'booking_id' => $this->bookingId,
                'user_id' => Auth::id(),
                'staff_id' => $staffId,
                'rating' => $this->rating,
                'comment' => $this->comment,
                'photos' => $photosPaths,
                'is_published' => true,
            ]);

            $message = 'Terima kasih atas review Anda!';

            // Send notification to staff
            if ($staffId) {
                sendNotification(
                    $staffId,
                    'review_submitted',
                    'Review Baru! ⭐',
                    Auth::user()->name . ' memberikan rating ' . $this->rating . ' bintang untuk layanan Anda.'
                );
            }

            // Log activity
            logActivity(
                'review_submitted',
                'Review',
                $this->bookingId,
                [],
                ['rating' => $this->rating, 'booking_code' => $this->booking->booking_code]
            );
        }

        session()->flash('success', $message);
        return redirect()->route('my-orders');
    }

    public function render()
    {
        return view('livewire.review-form')->layout('layouts.main');
    }
}
