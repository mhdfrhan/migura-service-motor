<div class="relative" x-data="{ open: @entangle('showDropdown').live }">
    <!-- Notification Bell Button -->
    <button 
        @click="open = !open"
        class="relative p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-xl transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-sky-500"
        aria-label="Notifications"
    >
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>
        
        <!-- Unread Badge -->
        @if($unreadCount > 0)
            <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-500 rounded-full min-w-[20px]">
                {{ $unreadCount > 9 ? '9+' : $unreadCount }}
            </span>
        @endif
    </button>

    <!-- Dropdown -->
    <div 
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        @click.away="open = false"
        class="absolute right-0 mt-2 w-96 bg-white rounded-2xl shadow-2xl border border-gray-200 z-50 overflow-hidden"
        style="display: none;"
    >
        <!-- Header -->
        <div class="bg-gradient-to-r from-sky-600 to-blue-600 px-6 py-4">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-bold text-white">Notifikasi</h3>
                @if($unreadCount > 0)
                    <button 
                        wire:click="markAllAsRead"
                        class="text-sm text-white/90 hover:text-white font-semibold transition-colors"
                    >
                        Tandai Semua Dibaca
                    </button>
                @endif
            </div>
            @if($unreadCount > 0)
                <p class="text-sm text-white/80 mt-1">{{ $unreadCount }} notifikasi belum dibaca</p>
            @endif
        </div>

        <!-- Notifications List -->
        <div class="max-h-96 overflow-y-auto">
            @forelse($notifications as $notification)
                <div 
                    class="px-6 py-4 border-b border-gray-100 hover:bg-gray-50 transition-colors {{ !$notification['read_at'] ? 'bg-sky-50/50' : '' }}"
                >
                    <div class="flex gap-3">
                        <!-- Icon -->
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 rounded-xl {{ $this->getNotificationColor($notification['type']) }} flex items-center justify-center">
                                {!! $this->getNotificationIcon($notification['type']) !!}
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-900 mb-1">
                                {{ $notification['title'] }}
                            </p>
                            <p class="text-sm text-gray-600 mb-2 line-clamp-2">
                                {{ $notification['message'] }}
                            </p>
                            <p class="text-xs text-gray-500">
                                {{ \Carbon\Carbon::parse($notification['created_at'])->diffForHumans() }}
                            </p>
                        </div>

                        <!-- Actions -->
                        <div class="flex-shrink-0 flex items-start gap-1">
                            @if(!$notification['read_at'])
                                <button 
                                    wire:click="markAsRead({{ $notification['id'] }})"
                                    class="p-1.5 text-sky-600 hover:bg-sky-100 rounded-lg transition-colors"
                                    title="Tandai dibaca"
                                >
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            @endif
                            <button 
                                wire:click="deleteNotification({{ $notification['id'] }})"
                                class="p-1.5 text-red-600 hover:bg-red-100 rounded-lg transition-colors"
                                title="Hapus"
                            >
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="px-6 py-12 text-center">
                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <p class="text-gray-500 font-medium">Belum ada notifikasi</p>
                    <p class="text-sm text-gray-400 mt-1">Notifikasi Anda akan muncul di sini</p>
                </div>
            @endforelse
        </div>

        <!-- Footer -->
        @if(count($notifications) > 0)
            <div class="bg-gray-50 px-6 py-3 flex items-center justify-between border-t border-gray-200">
                <button 
                    wire:click="deleteAllRead"
                    class="text-sm text-gray-600 hover:text-gray-900 font-medium transition-colors"
                >
                    Hapus Semua yang Dibaca
                </button>
                <a 
                    href="{{ route('notifications') }}"
                    class="text-sm text-sky-600 hover:text-sky-700 font-semibold transition-colors"
                >
                    Lihat Semua
                </a>
            </div>
        @endif
    </div>
</div>
