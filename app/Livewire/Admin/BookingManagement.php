<?php

namespace App\Livewire\Admin;

use App\Models\Booking;
use App\Models\StaffAssignment;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class BookingManagement extends Component
{
    use WithPagination;

    public $selectedBooking = null;

    public $filterStatus = 'all';

    public $search = '';

    public $selectedStaffId = null;

    protected $listeners = ['refreshBookings' => '$refresh'];

    public function viewBooking($bookingId)
    {
        $this->selectedBooking = Booking::with([
            'user',
            'servicePackage',
            'engineCapacity',
            'paymentProof',
            'staffAssignment.staff',
            'review',
        ])->findOrFail($bookingId);
        $this->selectedStaffId = $this->selectedBooking->staffAssignment->staff_id ?? null;
        $this->dispatch('open-modal', 'booking-detail-modal');
    }

    public function closeModal()
    {
        $this->selectedBooking = null;
        $this->selectedStaffId = null;
        $this->dispatch('close-modal', 'booking-detail-modal');
    }

    public function updateStatus($status)
    {
        if (! $this->selectedBooking) {
            return;
        }

        $oldStatus = $this->selectedBooking->status;
        $this->selectedBooking->update(['status' => $status]);

        // Jika status berubah menjadi completed, berikan loyalty point
        if ($status === 'completed' && $oldStatus !== 'completed') {
            // Increment total bookings
            $this->selectedBooking->user->increment('total_bookings');

            // Add loyalty point (hanya jika bukan free wash)
            if (! $this->selectedBooking->is_loyalty_reward) {
                addLoyaltyPoint($this->selectedBooking->user_id, $this->selectedBooking->id);
            }

            // Send notification
            sendNotification(
                $this->selectedBooking->user_id,
                'booking_completed',
                'Booking Selesai',
                'Terima kasih! Booking Anda (' . $this->selectedBooking->booking_code . ') telah selesai dikerjakan. Silakan berikan review untuk staff kami.'
            );
        }

        // Send status update notification
        $statusMessages = [
            'confirmed' => 'Booking Anda telah dikonfirmasi dan akan segera diproses.',
            'in_progress' => 'Staff sedang mengerjakan booking Anda.',
            'completed' => 'Booking Anda telah selesai dikerjakan. Terima kasih!',
            'cancelled' => 'Booking Anda telah dibatalkan.',
        ];

        if (isset($statusMessages[$status])) {
            sendNotification(
                $this->selectedBooking->user_id,
                'booking_status_updated',
                'Status Booking Diperbarui',
                $statusMessages[$status]
            );
        }

        // Log activity
        logActivity(
            'booking_status_updated',
            'Booking',
            $this->selectedBooking->id,
            ['status' => $oldStatus],
            ['status' => $status]
        );

        session()->flash('success', 'Status booking berhasil diperbarui!');
        $this->selectedBooking = null;
        $this->selectedStaffId = null;
        $this->dispatch('close-modal', 'booking-detail-modal');
        $this->dispatch('refreshBookings');
    }

    public function assignStaff()
    {
        // Validasi
        if (! $this->selectedBooking) {
            $this->dispatch('notify', type: 'error', message: 'Booking tidak ditemukan!');

            return;
        }

        if (! $this->selectedStaffId) {
            $this->dispatch('notify', type: 'error', message: 'Silakan pilih staff terlebih dahulu!');

            return;
        }

        // Validasi staff exists dan aktif
        $staff = User::where('id', $this->selectedStaffId)
            ->where('role', 'staff')
            ->where('is_active', true)
            ->first();

        if (! $staff) {
            $this->dispatch('notify', type: 'error', message: 'Staff tidak ditemukan atau tidak aktif!');

            return;
        }

        try {
            // Create or update staff assignment menggunakan model langsung
            StaffAssignment::updateOrCreate(
                ['booking_id' => $this->selectedBooking->id],
                [
                    'staff_id' => $this->selectedStaffId,
                    'assigned_at' => now(),
                ]
            );

            // Refresh selectedBooking untuk mendapatkan data terbaru
            $this->selectedBooking->refresh();
            $this->selectedBooking->load('staffAssignment.staff');

            // Send notification to staff
            sendNotification(
                $this->selectedStaffId,
                'staff_assigned',
                'Booking Baru Ditugaskan',
                'Anda telah ditugaskan untuk menangani booking ' . $this->selectedBooking->booking_code
            );

            // Send notification to customer
            sendNotification(
                $this->selectedBooking->user_id,
                'staff_assigned',
                'Staff Ditugaskan',
                'Staff telah ditugaskan untuk menangani booking Anda.'
            );

            // Log activity
            logActivity(
                'staff_assigned',
                'Booking',
                $this->selectedBooking->id,
                [],
                ['staff_id' => $this->selectedStaffId, 'staff_name' => $staff->name]
            );

            // Reset selectedStaffId untuk form
            $this->selectedStaffId = null;

            // Dispatch success notification
            $this->dispatch('notify', type: 'success', message: 'Staff berhasil ditugaskan!');

            // Refresh bookings list
            $this->dispatch('refreshBookings');
        } catch (\Exception $e) {
            $this->dispatch('notify', type: 'error', message: 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterStatus()
    {
        $this->resetPage();
    }

    public function render()
    {
        $bookings = Booking::with(['user', 'servicePackage', 'engineCapacity', 'paymentProof', 'staffAssignment.staff'])
            ->when($this->filterStatus !== 'all', function ($query) {
                $query->where('status', $this->filterStatus);
            })
            ->when($this->search, function ($query) {
                $query->where('booking_code', 'like', '%' . $this->search . '%')
                    ->orWhereHas('user', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%')
                            ->orWhere('email', 'like', '%' . $this->search . '%');
                    });
            })
            ->orderBy('booking_date', 'desc')
            ->paginate(15);

        $stats = [
            'pending' => Booking::where('status', 'pending')->count(),
            'confirmed' => Booking::where('status', 'confirmed')->count(),
            'in_progress' => Booking::where('status', 'in_progress')->count(),
            'completed' => Booking::where('status', 'completed')->count(),
        ];

        $staff = User::where('role', 'staff')->where('is_active', true)->get();

        return view('livewire.admin.booking-management', [
            'bookings' => $bookings,
            'stats' => $stats,
            'staff' => $staff,
        ]);
    }
}
