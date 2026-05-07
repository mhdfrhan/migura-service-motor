<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Laporan</h1>
            <p class="mt-1 text-sm text-gray-600">Statistik dan analisis data booking</p>
        </div>

        <!-- Actions -->
        <div class="flex items-center gap-3">
            {{-- <button wire:click="export"
                class="px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-green-500/30 transition-all flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span>Export Excel</span>
            </button> --}}

            <!-- Date Range Filter -->
            <div class="flex items-center gap-3">
                <select wire:model.live="dateRange"
                    class="px-4 py-2 border border-gray-300 rounded-xl focus:border-sky-500 focus:ring-2 focus:ring-sky-500 focus:ring-opacity-20 transition-all duration-200">
                    <option value="today">Hari Ini</option>
                    <option value="week">Minggu Ini</option>
                    <option value="month">Bulan Ini</option>
                    <option value="year">Tahun Ini</option>
                    <option value="custom">Custom</option>
                </select>
                @if ($dateRange === 'custom')
                    <div class="flex items-center gap-2">
                        <input type="date" wire:model.live="startDate"
                            class="px-4 py-2 border border-gray-300 rounded-xl">
                        <span class="text-gray-500">s/d</span>
                        <input type="date" wire:model.live="endDate"
                            class="px-4 py-2 border border-gray-300 rounded-xl">
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Bookings -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Booking</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ number_format($totalBookings) }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Completed Bookings -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Selesai</p>
                    <p class="text-3xl font-bold text-green-600 mt-2">{{ number_format($completedBookings) }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Cancelled Bookings -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Dibatalkan</p>
                    <p class="text-3xl font-bold text-red-600 mt-2">{{ number_format($cancelledBookings) }}</p>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pending Bookings -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Menunggu</p>
                    <p class="text-3xl font-bold text-yellow-600 mt-2">{{ number_format($pendingBookings) }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Revenue Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Total Revenue -->
        <div class="bg-gradient-to-br from-sky-500 to-blue-600 rounded-xl shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-sky-100">Total Pendapatan</p>
                    <p class="text-3xl font-bold mt-2">{{ formatRupiah($totalRevenue) }}</p>
                </div>
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Verified Payments -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Pembayaran Terverifikasi</p>
                    <p class="text-3xl font-bold text-green-600 mt-2">{{ formatRupiah($verifiedPayments) }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pending Payments -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Pembayaran Menunggu</p>
                    <p class="text-3xl font-bold text-yellow-600 mt-2">{{ formatRupiah($pendingPayments) }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Customer Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Customer Baru</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ number_format($newCustomers) }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Customer Aktif</p>
                    <p class="text-3xl font-bold text-green-600 mt-2">{{ number_format($activeCustomers) }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Daily Revenue Chart -->
        @if (count($dailyRevenue) > 0)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Trend Pendapatan Harian</h3>
                <div class="relative h-64" wire:ignore>
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
        @endif

        <!-- Daily Bookings Trend Chart -->
        @if (count($dailyBookings) > 0)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Trend Booking Harian</h3>
                <div class="relative h-64" wire:ignore>
                    <canvas id="bookingsTrendChart"></canvas>
                </div>
            </div>
        @endif
    </div>

    <!-- Monthly Revenue Chart (if year range) -->
    @if (count($monthlyRevenue) > 0)
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Pendapatan Bulanan</h3>
            <div class="relative h-64" wire:ignore>
                <canvas id="monthlyRevenueChart"></canvas>
            </div>
        </div>
    @endif

    <!-- Charts Row 2 -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Booking by Status Chart -->
        @if (count($bookingsByStatus) > 0)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Booking Berdasarkan Status</h3>
                <div class="relative h-64" wire:ignore>
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        @endif

        <!-- Booking by Service Chart -->
        @if (count($bookingsByService) > 0)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Booking Berdasarkan Paket Layanan</h3>
                <div class="relative h-64" wire:ignore>
                    <canvas id="serviceChart"></canvas>
                </div>
            </div>
        @endif
    </div>

    <!-- Bookings Table Section -->
    <div class="mt-8 bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-4 sm:px-6 py-4 border-b border-gray-200 bg-linear-to-r from-sky-50 to-blue-50">
            <h2 class="text-xl font-bold text-gray-900">Data Booking</h2>
            <p class="text-sm text-gray-600 mt-1">Detail semua booking dalam periode yang dipilih</p>
        </div>

        <div class="overflow-x-auto">
            <div class="inline-block min-w-full align-middle">
                <table class="w-full min-w-[1200px]">
                    <thead>
                        <tr class="bg-sky-50 border-b border-gray-200">
                            <th
                                class="px-4 sm:px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <span>Kode Booking</span>
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </th>
                            <th
                                class="px-4 sm:px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <span>Customer</span>
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </th>
                            <th
                                class="px-4 sm:px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <span>Email</span>
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </th>
                            <th
                                class="px-4 sm:px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <span>Paket Layanan</span>
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </th>
                            <th
                                class="px-4 sm:px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <span>Kapasitas Mesin</span>
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </th>
                            <th
                                class="px-4 sm:px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <span>Tanggal Booking</span>
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </th>
                            <th
                                class="px-4 sm:px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <span>Total Harga</span>
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </th>
                            <th
                                class="px-4 sm:px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <span>Status</span>
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </th>
                            <th
                                class="px-4 sm:px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                <div class="flex items-center gap-2">
                                    <span>Dibuat</span>
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($bookings as $booking)
                            <tr class="hover:bg-sky-50 transition-colors duration-150">
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-medium text-gray-900">{{ $booking->booking_code }}</span>
                                </td>
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-900">{{ $booking->user->name }}</span>
                                </td>
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-600">{{ $booking->user->email }}</span>
                                </td>
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-900">{{ $booking->servicePackage->name }}</span>
                                </td>
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-600">{{ $booking->engineCapacity->name }}</span>
                                </td>
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="text-sm text-gray-900">{{ $booking->booking_date->format('d M Y, H:i') }}</span>
                                </td>
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="text-sm font-semibold text-gray-900">{{ formatRupiah($booking->total_price) }}</span>
                                </td>
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                    @php
                                        $statusColors = [
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'awaiting_payment' => 'bg-orange-100 text-orange-800',
                                            'payment_uploaded' => 'bg-blue-100 text-blue-800',
                                            'confirmed' => 'bg-indigo-100 text-indigo-800',
                                            'in_progress' => 'bg-purple-100 text-purple-800',
                                            'completed' => 'bg-green-100 text-green-800',
                                            'cancelled' => 'bg-red-100 text-red-800',
                                        ];
                                        $statusColor = $statusColors[$booking->status] ?? 'bg-gray-100 text-gray-800';
                                        $statusLabel = ucfirst(str_replace('_', ' ', $booking->status));
                                    @endphp
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $statusColor }}">
                                        {{ $statusLabel }}
                                    </span>
                                </td>
                                <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="text-sm text-gray-600">{{ $booking->created_at->format('d M Y, H:i') }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-4 sm:px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-16 h-16 text-gray-400 mb-4" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <p class="text-gray-500 text-sm font-medium">Tidak ada data booking</p>
                                        <p class="text-gray-400 text-sm mt-1">Coba ubah periode tanggal untuk melihat
                                            data
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if ($bookings->hasPages())
            <div class="px-4 sm:px-6 py-4 border-t border-gray-200 bg-gray-50">
                {{ $bookings->links() }}
            </div>
        @endif
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.5.0/dist/chart.umd.min.js"></script>
    <script>
        let revenueChartInstance = null;
        let bookingsTrendChartInstance = null;
        let monthlyRevenueChartInstance = null;
        let statusChartInstance = null;
        let serviceChartInstance = null;

        function destroyCharts() {
            if (revenueChartInstance) {
                revenueChartInstance.destroy();
                revenueChartInstance = null;
            }
            if (bookingsTrendChartInstance) {
                bookingsTrendChartInstance.destroy();
                bookingsTrendChartInstance = null;
            }
            if (monthlyRevenueChartInstance) {
                monthlyRevenueChartInstance.destroy();
                monthlyRevenueChartInstance = null;
            }
            if (statusChartInstance) {
                statusChartInstance.destroy();
                statusChartInstance = null;
            }
            if (serviceChartInstance) {
                serviceChartInstance.destroy();
                serviceChartInstance = null;
            }
        }

        function initCharts() {
            // Chart colors matching theme
            const colors = {
                primary: {
                    bg: 'rgba(14, 165, 233, 0.1)',
                    border: 'rgb(14, 165, 233)',
                    hover: 'rgba(14, 165, 233, 0.2)'
                },
                secondary: {
                    bg: 'rgba(37, 99, 235, 0.1)',
                    border: 'rgb(37, 99, 235)',
                    hover: 'rgba(37, 99, 235, 0.2)'
                },
                success: {
                    bg: 'rgba(22, 163, 74, 0.1)',
                    border: 'rgb(22, 163, 74)',
                    hover: 'rgba(22, 163, 74, 0.2)'
                },
                warning: {
                    bg: 'rgba(234, 179, 8, 0.1)',
                    border: 'rgb(234, 179, 8)',
                    hover: 'rgba(234, 179, 8, 0.2)'
                },
                danger: {
                    bg: 'rgba(220, 38, 38, 0.1)',
                    border: 'rgb(220, 38, 38)',
                    hover: 'rgba(220, 38, 38, 0.2)'
                }
            };

            const chartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                    duration: 1500,
                    easing: 'easeInOutQuart'
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 15,
                            font: {
                                size: 12,
                                weight: '500'
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12,
                        titleFont: {
                            size: 14,
                            weight: '600'
                        },
                        bodyFont: {
                            size: 13
                        },
                        cornerRadius: 8,
                        displayColors: true,
                        intersect: false,
                        mode: 'index'
                    }
                }
            };

            // Daily Revenue Chart
            @if (count($dailyRevenue) > 0)
                const revenueCtx = document.getElementById('revenueChart');
                if (revenueCtx) {
                    const revenueData = @json($dailyRevenue);
                    const revenueLabels = Object.keys(revenueData).map(date => {
                        const d = new Date(date);
                        return d.toLocaleDateString('id-ID', {
                            day: 'numeric',
                            month: 'short'
                        });
                    });
                    const revenueValues = Object.values(revenueData);

                    if (revenueChartInstance) {
                        revenueChartInstance.destroy();
                    }
                    revenueChartInstance = new Chart(revenueCtx, {
                        type: 'line',
                        data: {
                            labels: revenueLabels,
                            datasets: [{
                                label: 'Pendapatan (Rp)',
                                data: revenueValues,
                                borderColor: colors.primary.border,
                                backgroundColor: colors.primary.bg,
                                borderWidth: 3,
                                fill: true,
                                tension: 0.4,
                                pointRadius: 5,
                                pointHoverRadius: 7,
                                pointBackgroundColor: colors.primary.border,
                                pointBorderColor: '#fff',
                                pointBorderWidth: 2
                            }]
                        },
                        options: {
                            ...chartOptions,
                            interaction: {
                                intersect: false,
                                mode: 'index'
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        callback: function(value) {
                                            return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                                        },
                                        font: {
                                            size: 11
                                        }
                                    },
                                    grid: {
                                        color: 'rgba(0, 0, 0, 0.05)'
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false
                                    },
                                    ticks: {
                                        font: {
                                            size: 11
                                        }
                                    }
                                }
                            }
                        }
                    });
                }
            @endif

            // Daily Bookings Trend Chart
            @if (count($dailyBookings) > 0)
                const bookingsTrendCtx = document.getElementById('bookingsTrendChart');
                if (bookingsTrendCtx) {
                    const bookingsData = @json($dailyBookings);
                    const bookingsLabels = Object.keys(bookingsData).map(date => {
                        const d = new Date(date);
                        return d.toLocaleDateString('id-ID', {
                            day: 'numeric',
                            month: 'short'
                        });
                    });
                    const bookingsValues = Object.values(bookingsData);

                    if (bookingsTrendChartInstance) {
                        bookingsTrendChartInstance.destroy();
                    }
                    bookingsTrendChartInstance = new Chart(bookingsTrendCtx, {
                        type: 'bar',
                        data: {
                            labels: bookingsLabels,
                            datasets: [{
                                label: 'Jumlah Booking',
                                data: bookingsValues,
                                backgroundColor: colors.secondary.bg,
                                borderColor: colors.secondary.border,
                                borderWidth: 2,
                                borderRadius: 6,
                                borderSkipped: false
                            }]
                        },
                        options: {
                            ...chartOptions,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        stepSize: 1,
                                        font: {
                                            size: 11
                                        }
                                    },
                                    grid: {
                                        color: 'rgba(0, 0, 0, 0.05)'
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false
                                    },
                                    ticks: {
                                        font: {
                                            size: 11
                                        }
                                    }
                                }
                            }
                        }
                    });
                }
            @endif

            // Monthly Revenue Chart
            @if (count($monthlyRevenue) > 0)
                const monthlyRevenueCtx = document.getElementById('monthlyRevenueChart');
                if (monthlyRevenueCtx) {
                    const monthlyData = @json($monthlyRevenue);
                    const monthlyLabels = Object.keys(monthlyData);
                    const monthlyValues = Object.values(monthlyData);

                    if (monthlyRevenueChartInstance) {
                        monthlyRevenueChartInstance.destroy();
                    }
                    monthlyRevenueChartInstance = new Chart(monthlyRevenueCtx, {
                        type: 'bar',
                        data: {
                            labels: monthlyLabels,
                            datasets: [{
                                label: 'Pendapatan Bulanan (Rp)',
                                data: monthlyValues,
                                backgroundColor: colors.success.bg,
                                borderColor: colors.success.border,
                                borderWidth: 2,
                                borderRadius: 6,
                                borderSkipped: false
                            }]
                        },
                        options: {
                            ...chartOptions,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        callback: function(value) {
                                            return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                                        },
                                        font: {
                                            size: 11
                                        }
                                    },
                                    grid: {
                                        color: 'rgba(0, 0, 0, 0.05)'
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false
                                    },
                                    ticks: {
                                        font: {
                                            size: 11
                                        }
                                    }
                                }
                            }
                        }
                    });
                }
            @endif

            // Booking by Status Chart
            @if (count($bookingsByStatus) > 0)
                const statusCtx = document.getElementById('statusChart');
                if (statusCtx) {
                    const statusData = @json($bookingsByStatus);
                    const statusLabels = Object.keys(statusData).map(status => {
                        return status.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
                    });
                    const statusValues = Object.values(statusData);

                    const statusColors = [
                        colors.success.border,
                        colors.warning.border,
                        colors.danger.border,
                        colors.primary.border,
                        colors.secondary.border
                    ];
                    const statusBgColors = [
                        colors.success.bg,
                        colors.warning.bg,
                        colors.danger.bg,
                        colors.primary.bg,
                        colors.secondary.bg
                    ];

                    if (statusChartInstance) {
                        statusChartInstance.destroy();
                    }
                    statusChartInstance = new Chart(statusCtx, {
                        type: 'doughnut',
                        data: {
                            labels: statusLabels,
                            datasets: [{
                                data: statusValues,
                                backgroundColor: statusColors.slice(0, statusValues.length),
                                borderColor: '#fff',
                                borderWidth: 3,
                                hoverOffset: 8
                            }]
                        },
                        options: {
                            ...chartOptions,
                            plugins: {
                                ...chartOptions.plugins,
                                legend: {
                                    ...chartOptions.plugins.legend,
                                    position: 'bottom'
                                }
                            }
                        }
                    });
                }
            @endif

            // Booking by Service Chart
            @if (count($bookingsByService) > 0)
                const serviceCtx = document.getElementById('serviceChart');
                if (serviceCtx) {
                    const serviceData = @json($bookingsByService);
                    const serviceLabels = Object.keys(serviceData);
                    const serviceValues = Object.values(serviceData);

                    const serviceColors = [
                        colors.primary.border,
                        colors.secondary.border,
                        colors.success.border,
                        colors.warning.border,
                        colors.danger.border
                    ];
                    const serviceBgColors = [
                        colors.primary.bg,
                        colors.secondary.bg,
                        colors.success.bg,
                        colors.warning.bg,
                        colors.danger.bg
                    ];

                    if (serviceChartInstance) {
                        serviceChartInstance.destroy();
                    }
                    serviceChartInstance = new Chart(serviceCtx, {
                        type: 'bar',
                        data: {
                            labels: serviceLabels,
                            datasets: [{
                                label: 'Jumlah Booking',
                                data: serviceValues,
                                backgroundColor: serviceColors.slice(0, serviceValues.length).map(c => c
                                    .replace('rgb', 'rgba').replace(')', ', 0.7)')),
                                borderColor: serviceColors.slice(0, serviceValues.length),
                                borderWidth: 2,
                                borderRadius: 8,
                                borderSkipped: false
                            }]
                        },
                        options: {
                            ...chartOptions,
                            indexAxis: 'y',
                            scales: {
                                x: {
                                    beginAtZero: true,
                                    ticks: {
                                        stepSize: 1,
                                        font: {
                                            size: 11
                                        }
                                    },
                                    grid: {
                                        color: 'rgba(0, 0, 0, 0.05)'
                                    }
                                },
                                y: {
                                    grid: {
                                        display: false
                                    },
                                    ticks: {
                                        font: {
                                            size: 11
                                        }
                                    }
                                }
                            }
                        }
                    });
                }
            @endif
        }

        // Initialize charts on page load
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initCharts);
        } else {
            initCharts();
        }

        // Re-initialize charts when Livewire updates
        document.addEventListener('livewire:init', () => {
            Livewire.hook('morph.updated', () => {
                setTimeout(() => {
                    destroyCharts();
                    initCharts();
                }, 200);
            });
        });

        // Also listen for Livewire updates
        window.addEventListener('livewire:update', () => {
            setTimeout(() => {
                destroyCharts();
                initCharts();
            }, 200);
        });
    </script>
@endpush
