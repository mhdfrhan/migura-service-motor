<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center gap-4">
            <a wire:navigate href="{{ route('dashboard') }}"
                class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Notifikasi</h1>
                @if($unreadCount > 0)
                    <p class="text-sm text-gray-600 mt-1">{{ $unreadCount }} notifikasi belum dibaca</p>
                @endif
            </div>
        </div>

        <!-- Actions Dropdown -->
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open" @click.away="open = false"
                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                </svg>
                <span class="hidden sm:inline">Aksi</span>
            </button>

            <!-- Dropdown Menu -->
            <div x-show="open" x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95"
                class="absolute right-0 mt-2 w-56 origin-top-right bg-white border border-gray-200 rounded-xl shadow-lg z-50"
                style="display: none;">
                <div class="py-2">
                    <button wire:click="markAllAsRead" @click="open = false"
                        class="w-full text-left px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors flex items-center gap-3">
                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        Tandai Semua Dibaca
                    </button>
                    <button wire:click="deleteAllRead" @click="open = false"
                        class="w-full text-left px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors flex items-center gap-3">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Hapus yang Sudah Dibaca
                    </button>
                    <div class="border-t border-gray-200 my-2"></div>
                    <button wire:click="deleteAll" @click="open = false"
                        wire:confirm="Apakah Anda yakin ingin menghapus semua notifikasi?"
                        class="w-full text-left px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors flex items-center gap-3 font-medium">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Hapus Semua
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="flex items-center gap-2 mb-6 overflow-x-auto pb-2">
        <button 
            wire:click="setFilter('all')" 
            class="px-4 py-2 rounded-xl font-medium text-sm transition-colors whitespace-nowrap {{ $filter === 'all' ? 'bg-sky-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }}"
        >
            Semua
        </button>
        <button 
            wire:click="setFilter('unread')" 
            class="px-4 py-2 rounded-xl font-medium text-sm transition-colors whitespace-nowrap {{ $filter === 'unread' ? 'bg-sky-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }}"
        >
            Belum Dibaca
            @if($unreadCount > 0)
                <span class="ml-2 px-2 py-0.5 bg-red-500 text-white text-xs rounded-full">{{ $unreadCount }}</span>
            @endif
        </button>
        <button 
            wire:click="setFilter('read')" 
            class="px-4 py-2 rounded-xl font-medium text-sm transition-colors whitespace-nowrap {{ $filter === 'read' ? 'bg-sky-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }}"
        >
            Sudah Dibaca
        </button>
    </div>

    <!-- Notifications List -->
    <div class="space-y-3">
        @forelse($notifications as $notification)
            <div class="bg-white rounded-xl shadow-sm border {{ $notification->read_at ? 'border-gray-100' : 'border-sky-200 bg-sky-50/30' }} p-4 hover:shadow-md transition-shadow">
                <div class="flex items-start gap-4">
                    <!-- Icon -->
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 {{ $this->getNotificationColor($notification->type) }} rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                {!! $this->getNotificationIcon($notification->type) !!}
                            </svg>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between gap-2 mb-1">
                            <h3 class="text-sm font-bold text-gray-900">{{ $notification->title }}</h3>
                            <div class="flex items-center gap-2 flex-shrink-0">
                                <span class="text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</span>
                                @if(!$notification->read_at)
                                    <div class="w-2 h-2 bg-sky-500 rounded-full"></div>
                                @endif
                            </div>
                        </div>
                        <p class="text-sm text-gray-600 mb-3">{{ $notification->message }}</p>
                        
                        <!-- Actions -->
                        <div class="flex items-center gap-2">
                            @if(!$notification->read_at)
                                <button 
                                    wire:click="markAsRead({{ $notification->id }})"
                                    class="text-xs text-sky-600 hover:text-sky-700 font-semibold transition-colors"
                                >
                                    Tandai Dibaca
                                </button>
                            @endif
                            <button 
                                wire:click="deleteNotification({{ $notification->id }})"
                                class="text-xs text-red-600 hover:text-red-700 font-semibold transition-colors"
                            >
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-12 text-center">
                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
                <p class="text-gray-500 font-medium">
                    @if($filter === 'unread')
                        Tidak ada notifikasi belum dibaca
                    @elseif($filter === 'read')
                        Tidak ada notifikasi yang sudah dibaca
                    @else
                        Belum ada notifikasi
                    @endif
                </p>
                <p class="text-sm text-gray-400 mt-1">Notifikasi Anda akan muncul di sini</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($notifications->hasPages())
        <div class="mt-6">
            {{ $notifications->links() }}
        </div>
    @endif
</div>
