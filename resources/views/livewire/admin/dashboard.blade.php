<div class="space-y-6">
    {{-- Statistics Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        {{-- Total Bookings --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Booking</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ number_format($totalBookings) }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- Pending Payments --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Menunggu Verifikasi</p>
                    <p class="text-3xl font-bold text-yellow-600 mt-2">{{ number_format($pendingPayments) }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- Active Bookings --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Sedang Dikerjakan</p>
                    <p class="text-3xl font-bold text-sky-600 mt-2">{{ number_format($activeBookings) }}</p>
                </div>
                <div class="w-12 h-12 bg-sky-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- Today Revenue --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Pendapatan Hari Ini</p>
                    <p class="text-3xl font-bold text-green-600 mt-2">{{ formatRupiah($todayRevenue, false) }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Charts Row --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Weekly Bookings Chart --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Booking 7 Hari Terakhir</h3>
            <div class="space-y-3">
                @foreach ($weeklyBookings as $day)
                    <div class="flex items-center gap-3">
                        <span class="text-sm font-medium text-gray-600 w-12">{{ $day['date'] }}</span>
                        <div class="flex-1 bg-gray-100 rounded-full h-8 relative overflow-hidden">
                            <div class="bg-gradient-to-r from-sky-500 to-blue-600 h-full rounded-full transition-all"
                                style="width: {{ $day['count'] > 0 ? min(($day['count'] / max(array_column($weeklyBookings, 'count'))) * 100, 100) : 0 }}%">
                            </div>
                            <span class="absolute inset-0 flex items-center justify-center text-sm font-semibold text-gray-700">
                                {{ $day['count'] }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Service Package Stats --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Paket Layanan Terpopuler</h3>
            <div class="space-y-3">
                @foreach ($servicePackageStats as $stat)
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-700">{{ $stat['name'] }}</span>
                        <span class="text-lg font-bold text-sky-600">{{ $stat['total'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Recent Data Tables --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Recent Bookings --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-900">Booking Terbaru</h3>
                <a href="{{ route('admin.bookings.index') }}" class="text-sm font-semibold text-sky-600 hover:text-sky-700">
                    Lihat Semua →
                </a>
            </div>
            <div class="space-y-3">
                @forelse ($recentBookings as $booking)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex-1">
                            <p class="font-semibold text-gray-900">{{ $booking->booking_code }}</p>
                            <p class="text-sm text-gray-600">{{ $booking->user->name }} - {{ $booking->servicePackage->name }}</p>
                        </div>
                        <span class="px-3 py-1 text-xs font-semibold rounded-full {{ getStatusBadgeClass($booking->status) }}">
                            {{ ucfirst($booking->status) }}
                        </span>
                    </div>
                @empty
                    <p class="text-center text-gray-500 py-4">Belum ada booking</p>
                @endforelse
            </div>
        </div>

        {{-- Pending Verifications --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-900">Menunggu Verifikasi</h3>
                <a href="{{ route('admin.payments.index') }}" class="text-sm font-semibold text-sky-600 hover:text-sky-700">
                    Lihat Semua →
                </a>
            </div>
            <div class="space-y-3">
                @forelse ($pendingVerifications as $payment)
                    <div class="flex items-center justify-between p-3 bg-yellow-50 rounded-lg border border-yellow-200">
                        <div class="flex-1">
                            <p class="font-semibold text-gray-900">{{ $payment->booking->booking_code }}</p>
                            <p class="text-sm text-gray-600">{{ $payment->booking->user->name }} - Rp{{ number_format($payment->amount, 0, ',', '.') }}</p>
                        </div>
                        <a href="{{ route('admin.payments.index') }}" class="text-sm font-semibold text-yellow-600 hover:text-yellow-700">
                            Verifikasi
                        </a>
                    </div>
                @empty
                    <p class="text-center text-gray-500 py-4">Tidak ada pembayaran menunggu verifikasi</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
