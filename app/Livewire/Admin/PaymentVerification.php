<?php

namespace App\Livewire\Admin;

use App\Models\PaymentProof;
use Livewire\Component;
use Livewire\WithPagination;

class PaymentVerification extends Component
{
    use WithPagination;

    public $selectedProof = null;

    public $showModal = false;

    public $rejectionReason = '';

    public $filterStatus = 'pending';

    public $search = '';

    protected $listeners = ['refreshPayments' => '$refresh'];

    public function mount()
    {
        //
    }

    public function viewProof($proofId)
    {
        $this->selectedProof = PaymentProof::with(['booking.user', 'booking.servicePackage', 'booking.engineCapacity'])
            ->findOrFail($proofId);
        $this->showModal = true;
        $this->rejectionReason = '';
        $this->dispatch('open-modal', 'payment-detail-modal');
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedProof = null;
        $this->rejectionReason = '';
        $this->dispatch('close-modal', 'payment-detail-modal');
    }

    public function approvePayment()
    {
        if (! $this->selectedProof) {
            return;
        }

        $this->selectedProof->update([
            'verification_status' => 'verified',
            'verified_by' => auth()->id(),
            'verified_at' => now(),
        ]);

        $this->selectedProof->booking->update([
            'status' => 'confirmed',
        ]);

        // Send notification
        sendNotification(
            $this->selectedProof->booking->user_id,
            'Pembayaran Diverifikasi',
            'Pembayaran Anda untuk booking ' . $this->selectedProof->booking->booking_code . ' telah diverifikasi. Booking Anda akan segera diproses.',
            'success'
        );

        // Log activity
        logActivity(
            'payment_verified',
            'Booking',
            $this->selectedProof->booking->id,
            [],
            []
        );

        session()->flash('success', 'Pembayaran berhasil diverifikasi!');
        $this->closeModal();
        $this->dispatch('refreshPayments');
    }

    public function rejectPayment()
    {
        $this->validate([
            'rejectionReason' => 'required|min:10',
        ], [
            'rejectionReason.required' => 'Alasan penolakan harus diisi.',
            'rejectionReason.min' => 'Alasan penolakan minimal 10 karakter.',
        ]);

        if (! $this->selectedProof) {
            return;
        }

        $this->selectedProof->update([
            'verification_status' => 'rejected',
            'rejection_reason' => $this->rejectionReason,
            'verified_by' => auth()->id(),
            'verified_at' => now(),
        ]);

        $this->selectedProof->booking->update([
            'status' => 'payment_rejected',
        ]);

        // Send notification
        sendNotification(
            $this->selectedProof->booking->user_id,
            'Pembayaran Ditolak',
            'Pembayaran Anda untuk booking ' . $this->selectedProof->booking->booking_code . ' ditolak. Alasan: ' . $this->rejectionReason . '. Silakan upload ulang bukti pembayaran yang benar.',
            'error'
        );

        // Log activity
        logActivity(
            'payment_rejected',
            'Booking',
            $this->selectedProof->booking->id,
            [],
            []
        );

        session()->flash('success', 'Pembayaran berhasil ditolak!');
        $this->closeModal();
        $this->dispatch('refreshPayments');
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
        $paymentProofs = PaymentProof::with(['booking.user', 'booking.servicePackage', 'booking.engineCapacity', 'verifier'])
            ->when($this->filterStatus !== 'all', function ($query) {
                $query->where('verification_status', $this->filterStatus);
            })
            ->when($this->search, function ($query) {
                $query->whereHas('booking', function ($q) {
                    $q->where('booking_code', 'like', '%' . $this->search . '%')
                        ->orWhereHas('user', function ($u) {
                            $u->where('name', 'like', '%' . $this->search . '%')
                                ->orWhere('email', 'like', '%' . $this->search . '%');
                        });
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $stats = [
            'pending' => PaymentProof::where('verification_status', 'pending')->count(),
            'verified' => PaymentProof::where('verification_status', 'verified')->count(),
            'rejected' => PaymentProof::where('verification_status', 'rejected')->count(),
        ];

        return view('livewire.admin.payment-verification', [
            'paymentProofs' => $paymentProofs,
            'stats' => $stats,
        ]);
    }
}
