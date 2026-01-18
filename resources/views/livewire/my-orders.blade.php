<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12">
    <x-container>
        <div class="max-w-5xl mx-auto">
            <!-- Header -->
            <div class="flex items-center gap-4 mb-8">
                <a wire:navigate href="{{ route('dashboard') }}"
                    class="inline-flex items-center text-gray-600 hover:text-sky-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
                <h1 class="text-3xl font-bold text-gray-900">Pesanan Saya</h1>
            </div>

            <!-- Filter Tabs -->
            <div class="flex gap-2 mb-8 overflow-x-auto pb-2">
                <button wire:click="setFilter('all')"
                    class="px-5 py-2.5 rounded-xl font-bold text-sm transition-all whitespace-nowrap {{ $filterStatus === 'all' ? 'bg-gradient-to-r from-sky-500 to-blue-600 text-white shadow-lg shadow-sky-500/30' : 'bg-white text-gray-700 hover:bg-gray-50 border border-gray-200' }}">
                    Semua
                </button>
                <button wire:click="setFilter('ongoing')"
                    class="px-5 py-2.5 rounded-xl font-bold text-sm transition-all whitespace-nowrap {{ $filterStatus === 'ongoing' ? 'bg-gradient-to-r from-sky-500 to-blue-600 text-white shadow-lg shadow-sky-500/30' : 'bg-white text-gray-700 hover:bg-gray-50 border border-gray-200' }}">
                    Berlangsung
                </button>
                <button wire:click="setFilter('completed')"
                    class="px-5 py-2.5 rounded-xl font-bold text-sm transition-all whitespace-nowrap {{ $filterStatus === 'completed' ? 'bg-gradient-to-r from-sky-500 to-blue-600 text-white shadow-lg shadow-sky-500/30' : 'bg-white text-gray-700 hover:bg-gray-50 border border-gray-200' }}">
                    Selesai
                </button>
                <button wire:click="setFilter('cancelled')"
                    class="px-5 py-2.5 rounded-xl font-bold text-sm transition-all whitespace-nowrap {{ $filterStatus === 'cancelled' ? 'bg-gradient-to-r from-sky-500 to-blue-600 text-white shadow-lg shadow-sky-500/30' : 'bg-white text-gray-700 hover:bg-gray-50 border border-gray-200' }}">
                    Dibatalkan
                </button>
            </div>

            <!-- Bookings List -->
            <div class="space-y-4">
                @forelse($bookings as $booking)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <h3 class="font-bold text-gray-900 text-lg">{{ $booking->servicePackage->name }}</h3>
                                    @if($booking->is_home_service)
                                        <span class="px-2 py-1 bg-purple-100 text-purple-700 text-xs font-bold rounded-lg">
                                            Antar-Jemput
                                        </span>
                                    @endif
                                    @if($booking->is_free)
                                        <span class="px-2 py-1 bg-yellow-100 text-yellow-700 text-xs font-bold rounded-lg">
                                            🎁 GRATIS
                                        </span>
                                    @endif
                                </div>
                                <p class="text-sm text-gray-600 mb-1">
                                    Kode: <span class="font-mono font-bold text-gray-900">{{ $booking->booking_code }}</span>
                                </p>
                                <p class="text-sm text-gray-600">
                                    📅 {{ \Carbon\Carbon::parse($booking->booking_date)->isoFormat('D MMMM Y') }} • 
                                    🕐 {{ $booking->booking_time }}
                                </p>
                            </div>
                            <div>
                                <span class="px-4 py-2 rounded-xl text-sm font-bold {{ get_status_badge_class($booking->status) }}">
                                    {{ match($booking->status) {
                                        'pending' => 'Menunggu',
                                        'awaiting_payment' => 'Menunggu Pembayaran',
                                        'payment_uploaded' => 'Bukti Diupload',
                                        'payment_verified' => 'Pembayaran Dikonfirmasi',
                                        'confirmed' => 'Terkonfirmasi',
                                        'in_progress' => 'Sedang Dikerjakan',
                                        'completed' => 'Selesai',
                                        'cancelled' => 'Dibatalkan',
                                        'rejected' => 'Ditolak',
                                        default => $booking->status
                                    } }}
                                </span>
                            </div>
                        </div>

                        @if($booking->is_home_service && $booking->customer_address)
                            <div class="flex items-start gap-2 mb-4 p-3 bg-gray-50 rounded-xl">
                                <svg class="w-5 h-5 text-gray-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-gray-900">Alamat Penjemputan</p>
                                    <p class="text-sm text-gray-600">{{ $booking->customer_address }}</p>
                                </div>
                            </div>
                        @endif

                        <div class="border-t border-gray-200 pt-4 flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Total Pembayaran</p>
                                <p class="text-2xl font-bold text-gray-900">{{ format_currency($booking->total_price) }}</p>
                            </div>

                            <div class="flex items-center gap-2">
                                @if($booking->status === 'completed')
                                    @if($this->hasReview($booking->id))
                                        <a wire:navigate href="{{ route('booking.review', $booking->id) }}"
                                            class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-colors font-bold text-sm flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                            Edit Review
                                        </a>
                                    @else
                                        <a wire:navigate href="{{ route('booking.review', $booking->id) }}"
                                            class="px-5 py-2.5 bg-gradient-to-r from-yellow-500 to-orange-600 text-white rounded-xl hover:from-yellow-600 hover:to-orange-700 transition-all font-bold text-sm flex items-center gap-2 shadow-lg shadow-yellow-500/30">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                            Tulis Review
                                        </a>
                                    @endif
                                @endif

                                {{-- Tombol Bayar Sekarang - hanya muncul jika status awaiting_payment dan belum ada payment proof --}}
                                @if($booking->status === 'awaiting_payment' && !$booking->paymentProof)
                                    <button wire:click="goToPayment({{ $booking->id }})"
                                        class="px-5 py-2.5 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-xl hover:from-green-600 hover:to-emerald-700 transition-all font-bold text-sm flex items-center gap-2 shadow-lg shadow-green-500/30">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                        Bayar Sekarang
                                    </button>
                                @endif

                                {{-- Tombol Batalkan - hanya muncul jika belum ada payment proof --}}
                                @if(in_array($booking->status, ['pending', 'awaiting_payment']) && !$booking->paymentProof)
                                    <button wire:click="cancelBooking({{ $booking->id }})"
                                        wire:confirm="Apakah Anda yakin ingin membatalkan booking ini?"
                                        class="px-5 py-2.5 bg-red-50 text-red-600 rounded-xl hover:bg-red-100 transition-colors font-bold text-sm">
                                        Batalkan
                                    </button>
                                @endif

                                {{-- Tombol Detail - selalu muncul --}}
                                <a wire:navigate href="{{ route('booking.show', $booking->id) }}"
                                    class="px-5 py-2.5 bg-sky-50 text-sky-600 rounded-xl hover:bg-sky-100 transition-colors font-bold text-sm">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-12 text-center">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Pesanan</h3>
                        <p class="text-gray-600 mb-6">Anda belum memiliki pesanan pada kategori ini.</p>
                        <a wire:navigate href="{{ route('booking.index') }}"
                            class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white rounded-xl transition-all font-bold shadow-lg shadow-sky-500/30">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Buat Pesanan Baru
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($bookings->hasPages())
                <div class="mt-8">
                    {{ $bookings->links() }}
                </div>
            @endif
        </div>
    </x-container>
</div>
