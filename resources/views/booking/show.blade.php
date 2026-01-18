<x-main-layout>
    <x-slot name="title">Detail Pesanan</x-slot>

    @php
        $statusLabelMap = [
            'pending' => 'Menunggu Konfirmasi',
            'awaiting_payment' => 'Menunggu Pembayaran',
            'payment_uploaded' => 'Menunggu Verifikasi Pembayaran',
            'payment_verified' => 'Pembayaran Terverifikasi',
            'confirmed' => 'Dikonfirmasi',
            'in_progress' => 'Sedang Dikerjakan',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
            'rejected' => 'Ditolak',
        ];

        $statusLabel = $statusLabelMap[$booking->status] ?? ucfirst(str_replace('_', ' ', $booking->status));

        $statusDotClass = match ($booking->status) {
            'completed' => 'bg-green-500',
            'in_progress' => 'bg-sky-500',
            'awaiting_payment', 'payment_uploaded', 'payment_verified' => 'bg-yellow-400',
            'cancelled', 'rejected' => 'bg-red-500',
            default => 'bg-blue-500',
        };

        $isHomeService = $booking->booking_type === 'home_service';
    @endphp

    <div class="min-h-screen bg-white pb-20">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Header -->
            <div class="flex items-center gap-4 mb-8">
                <a wire:navigate href="{{ route('my-orders') }}"
                    class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Detail Pesanan</h1>
            </div>

            <!-- Order Card -->
            <div class="border border-gray-200 rounded-xl overflow-hidden mb-6">
                <div class="p-6">
                    <!-- ID & Status -->
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">ID Pesanan</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $booking->booking_code }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-500 mb-1">Status</p>
                            <div class="flex items-center gap-2 justify-end">
                                <div class="w-2 h-2 rounded-full {{ $statusDotClass }}"></div>
                                <span class="text-sm font-medium text-gray-900">{{ $statusLabel }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Package Info -->
                    <div class="mb-6 pb-6 border-b border-gray-200">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $booking->servicePackage->name ?? '-' }}
                        </h3>
                        <p class="text-sm text-gray-600">
                            {{ $isHomeService ? 'Home Service' : 'Datang ke Toko' }}
                        </p>
                    </div>

                    <!-- Schedule -->
                    <div class="mb-6">
                        <h4 class="text-sm font-semibold text-gray-900 mb-3">Jadwal</h4>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Tanggal</span>
                                <span class="text-sm font-medium text-gray-900">
                                    {{ $booking->booking_date?->format('d M Y') ?? '-' }}
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Waktu</span>
                                <span class="text-sm font-medium text-gray-900">
                                    {{ $booking->booking_time?->format('H:i') ?? '-' }} WIB
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Contact & Address -->
                    @if ($isHomeService)
                        <div class="mb-6">
                            <h4 class="text-sm font-semibold text-gray-900 mb-3">Informasi Kontak</h4>
                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">No. Telepon</span>
                                    <span
                                        class="text-sm font-medium text-gray-900">{{ $booking->user->phone ?? '-' }}</span>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 mb-1">Alamat</p>
                                    <p class="text-sm font-medium text-gray-900">
                                        {{ $booking->customer_address ?? '-' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Notes -->
                    @if ($booking->notes)
                        <div class="mb-6">
                            <h4 class="text-sm font-semibold text-gray-900 mb-3">Catatan</h4>
                            <p class="text-sm text-gray-600">{{ $booking->notes }}</p>
                        </div>
                    @endif

                    <!-- Payment Details -->
                    <div class="mb-6">
                        <h4 class="text-sm font-semibold text-gray-900 mb-3">Rincian Pembayaran</h4>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Harga Paket</span>
                                <span class="text-sm text-gray-900">
                                    Rp{{ number_format($booking->service_price, 0, ',', '.') }}
                                </span>
                            </div>
                            @if ($booking->home_service_fee > 0)
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Biaya Kunjungan</span>
                                    <span class="text-sm text-gray-900">
                                        Rp{{ number_format($booking->home_service_fee, 0, ',', '.') }}
                                    </span>
                                </div>
                            @endif
                            @if ($booking->discount_amount > 0)
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Diskon</span>
                                    <span class="text-sm text-green-600">
                                        - Rp{{ number_format($booking->discount_amount, 0, ',', '.') }}
                                    </span>
                                </div>
                            @endif
                            <div class="pt-3 border-t border-gray-200 flex justify-between">
                                <span class="text-base font-semibold text-gray-900">Total</span>
                                <span class="text-base font-bold text-gray-900">
                                    Rp{{ number_format($booking->total_price, 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="flex justify-between pt-2">
                                <span class="text-sm text-gray-600">Metode Pembayaran</span>
                                <span class="text-sm font-medium text-gray-900">
                                    @if ($booking->paymentProof)
                                        {{ ucfirst(str_replace('_', ' ', $booking->paymentProof->payment_method)) }}
                                    @else
                                        -
                                    @endif
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Status Pembayaran</span>
                                <span
                                    class="text-sm font-medium {{ in_array($booking->status, ['payment_verified', 'confirmed', 'in_progress', 'completed']) ? 'text-green-600' : 'text-yellow-600' }}">
                                    @if (in_array($booking->status, ['payment_verified', 'confirmed', 'in_progress', 'completed']))
                                        Lunas / Terverifikasi
                                    @elseif ($booking->status === 'awaiting_payment' || $booking->status === 'payment_uploaded')
                                        Menunggu Pembayaran / Verifikasi
                                    @else
                                        -
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="space-y-3">
                @if (in_array($booking->status, ['confirmed', 'in_progress']))
                    <button
                        class="w-full px-6 py-3 bg-sky-500 text-white font-semibold rounded-lg hover:bg-sky-600 transition-colors">
                        Hubungi Teknisi
                    </button>
                @elseif ($booking->status === 'completed')
                    <a wire:navigate href="{{ route('booking.review', $booking->id) }}"
                        class="block w-full px-6 py-3 bg-sky-500 text-white font-semibold text-center rounded-lg hover:bg-sky-600 transition-colors">
                        Beri Ulasan
                    </a>
                    <a wire:navigate href="{{ route('booking.index') }}"
                        class="block w-full px-6 py-3 bg-white border border-gray-300 text-gray-700 font-semibold text-center rounded-lg hover:bg-gray-50 transition-colors">
                        Pesan Lagi
                    </a>
                @endif

                <button
                    class="w-full px-6 py-3 bg-white border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition-colors">
                    Butuh Bantuan?
                </button>
            </div>
        </div>
    </div>
</x-main-layout>
