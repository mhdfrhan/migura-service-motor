<?php

namespace App\Livewire;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NotificationDropdown extends Component
{
    public $unreadCount = 0;
    public $notifications = [];
    public $showDropdown = false;

    protected $listeners = [
        'notificationSent' => 'refreshNotifications',
    ];

    public function mount(): void
    {
        $this->loadNotifications();
    }

    public function loadNotifications(): void
    {
        if (!Auth::check()) {
            return;
        }

        $this->notifications = Notification::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get()
            ->toArray();

        $this->unreadCount = Notification::where('user_id', Auth::id())
            ->whereNull('read_at')
            ->count();
    }

    public function refreshNotifications(): void
    {
        $this->loadNotifications();
        $this->dispatch('notificationUpdated');
    }

    public function toggleDropdown(): void
    {
        $this->showDropdown = !$this->showDropdown;
    }

    public function markAsRead(int $notificationId): void
    {
        $notification = Notification::where('id', $notificationId)
            ->where('user_id', Auth::id())
            ->first();

        if ($notification && !$notification->read_at) {
            $notification->update(['read_at' => now()]);
            $this->loadNotifications();
        }
    }

    public function markAllAsRead(): void
    {
        Notification::where('user_id', Auth::id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        $this->loadNotifications();
        $this->dispatch('notify', type: 'success', message: 'Semua notifikasi telah ditandai sebagai dibaca');
    }

    public function deleteNotification(int $notificationId): void
    {
        $notification = Notification::where('id', $notificationId)
            ->where('user_id', Auth::id())
            ->first();

        if ($notification) {
            $notification->delete();
            $this->loadNotifications();
            $this->dispatch('notify', type: 'success', message: 'Notifikasi berhasil dihapus');
        }
    }

    public function deleteAllRead(): void
    {
        Notification::where('user_id', Auth::id())
            ->whereNotNull('read_at')
            ->delete();

        $this->loadNotifications();
        $this->dispatch('notify', type: 'success', message: 'Semua notifikasi yang sudah dibaca telah dihapus');
    }

    public function getNotificationIcon(string $type): string
    {
        return match ($type) {
            'booking_created' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" /></svg>',
            'booking_confirmed' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>',
            'booking_cancelled' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>',
            'payment_verified' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" /><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" /></svg>',
            'payment_rejected' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>',
            'loyalty_earned' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>',
            'staff_assigned' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" /></svg>',
            'review_submitted' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z" /><path d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z" /></svg>',
            default => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" /></svg>',
        };
    }

    public function getNotificationColor(string $type): string
    {
        return match ($type) {
            'booking_created' => 'bg-blue-100 text-blue-600',
            'booking_confirmed' => 'bg-green-100 text-green-600',
            'booking_cancelled' => 'bg-red-100 text-red-600',
            'payment_verified' => 'bg-emerald-100 text-emerald-600',
            'payment_rejected' => 'bg-orange-100 text-orange-600',
            'loyalty_earned' => 'bg-yellow-100 text-yellow-600',
            'staff_assigned' => 'bg-purple-100 text-purple-600',
            'review_submitted' => 'bg-pink-100 text-pink-600',
            default => 'bg-gray-100 text-gray-600',
        };
    }

    public function render()
    {
        return view('livewire.notification-dropdown');
    }
}
