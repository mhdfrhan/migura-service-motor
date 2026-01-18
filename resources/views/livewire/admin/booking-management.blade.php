<div class="space-y-6">
    <!-- Success Message -->
    @if (session()->has('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-xl flex items-center gap-3">
            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Pending</p>
                    <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $stats['pending'] }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Confirmed</p>
                    <p class="text-3xl font-bold text-blue-600 mt-2">{{ $stats['confirmed'] }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">In Progress</p>
                    <p class="text-3xl font-bold text-purple-600 mt-2">{{ $stats['in_progress'] }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Completed</p>
                    <p class="text-3xl font-bold text-green-600 mt-2">{{ $stats['completed'] }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters & Search -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex flex-col sm:flex-row gap-4">
            <div class="flex-1">
                <input type="text" wire:model.live.debounce.300ms="search"
                    placeholder="Cari booking code, nama customer, atau email..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500">
            </div>
            <div class="sm:w-48">
                <select wire:model.live="filterStatus"
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500">
                    <option value="all">Semua Status</option>
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="in_progress">In Progress</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Bookings Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Kode</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Customer</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Layanan</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Tanggal</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Total</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($bookings as $booking)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <p class="text-sm font-semibold text-gray-900">{{ $booking->booking_code }}</p>
                                    @if ($booking->is_free)
                                        <span
                                            class="px-2 py-0.5 text-xs font-bold bg-gradient-to-r from-yellow-400 to-orange-500 text-white rounded-full">
                                            FREE
                                        </span>
                                    @endif
                                </div>
                                <p class="text-xs text-gray-500">{{ $booking->booking_type }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $booking->user->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $booking->user->email }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div>
                                    <p class="text-sm text-gray-900">{{ $booking->servicePackage->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $booking->engineCapacity->name }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <p class="text-sm text-gray-900">{{ $booking->booking_date->format('d M Y') }}</p>
                                <p class="text-xs text-gray-500">{{ $booking->time_slot }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <p class="text-sm font-semibold text-gray-900">
                                    {{ formatRupiah($booking->total_price) }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ getStatusBadgeClass($booking->status) }}">
                                    {{ ucfirst(str_replace('_', ' ', $booking->status)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <button wire:click="viewBooking({{ $booking->id }})"
                                    class="text-sky-600 hover:text-sky-900 font-semibold">
                                    Kelola
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-500">
                                    <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <p class="text-lg font-semibold">Tidak ada booking</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($bookings->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $bookings->links() }}
            </div>
        @endif
    </div>

    <!-- Modal -->
    @if ($selectedBooking)
        <x-modal name="booking-detail-modal" maxWidth="4xl" focusable>
            <!-- Header -->
            <div
                class="sticky top-0 bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between rounded-t-2xl">
                <h3 class="text-xl font-bold text-gray-900">Detail Booking</h3>
                <button @click="$dispatch('close-modal', 'booking-detail-modal')"
                    class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Content -->
            <div class="p-6 space-y-6">
                <!-- Booking Info -->
                <div class="bg-gray-50 rounded-xl p-6">
                    <h4 class="font-semibold text-gray-900 mb-4">Informasi Booking</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">Kode Booking</p>
                            <p class="font-semibold text-gray-900">{{ $selectedBooking->booking_code }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Tipe Booking</p>
                            <p class="font-semibold text-gray-900">{{ ucfirst($selectedBooking->booking_type) }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Customer</p>
                            <p class="font-semibold text-gray-900">{{ $selectedBooking->user->name }}</p>
                            <p class="text-xs text-gray-500">{{ $selectedBooking->user->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Layanan</p>
                            <p class="font-semibold text-gray-900">{{ $selectedBooking->servicePackage->name }}</p>
                            <p class="text-xs text-gray-500">{{ $selectedBooking->engineCapacity->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Tanggal & Waktu</p>
                            <p class="font-semibold text-gray-900">
                                {{ $selectedBooking->booking_date->format('d M Y, H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Total Pembayaran</p>
                            <div class="flex items-center gap-2">
                                <p class="text-2xl font-bold text-sky-600">
                                    {{ formatRupiah($selectedBooking->total_price) }}</p>
                                @if ($selectedBooking->is_free)
                                    <span
                                        class="px-2 py-1 text-xs font-bold bg-gradient-to-r from-yellow-400 to-orange-500 text-white rounded-full">
                                        GRATIS (Loyalty)
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if ($selectedBooking->booking_type === 'home_service' && $selectedBooking->customer_address)
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <p class="text-sm font-semibold text-gray-700 mb-2">Alamat Antar-Jemput:</p>
                            <p class="text-sm text-gray-900">{{ $selectedBooking->customer_address }}</p>
                        </div>
                    @endif
                </div>

                <!-- Status Update -->
                <div class="bg-sky-50 rounded-xl p-6">
                    <h4 class="font-semibold text-gray-900 mb-4">Update Status</h4>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        <button wire:click="updateStatus('confirmed')"
                            class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition-colors text-sm"
                            @if ($selectedBooking->status === 'confirmed') disabled @endif>
                            Konfirmasi
                        </button>
                        <button wire:click="updateStatus('in_progress')"
                            class="px-4 py-2 bg-purple-600 text-white font-semibold rounded-xl hover:bg-purple-700 transition-colors text-sm"
                            @if ($selectedBooking->status === 'in_progress') disabled @endif>
                            Dalam Proses
                        </button>
                        <button wire:click="updateStatus('completed')"
                            class="px-4 py-2 bg-green-600 text-white font-semibold rounded-xl hover:bg-green-700 transition-colors text-sm"
                            @if ($selectedBooking->status === 'completed') disabled @endif>
                            Selesai
                        </button>
                        <button wire:click="updateStatus('cancelled')"
                            class="px-4 py-2 bg-red-600 text-white font-semibold rounded-xl hover:bg-red-700 transition-colors text-sm"
                            @if ($selectedBooking->status === 'cancelled') disabled @endif>
                            Batalkan
                        </button>
                    </div>
                </div>

                <!-- Assign Staff -->
                <div class="bg-green-50 rounded-xl p-6">
                    <h4 class="font-semibold text-gray-900 mb-4">Tugaskan Staff</h4>
                    @if ($selectedBooking->staffAssignment)
                        <div class="mb-4 p-4 bg-white rounded-lg border border-green-200">
                            <p class="text-sm text-gray-600">Staff Ditugaskan:</p>
                            <p class="font-semibold text-gray-900">
                                {{ $selectedBooking->staffAssignment->staff->name }}</p>
                            <p class="text-xs text-gray-500">Ditugaskan:
                                {{ $selectedBooking->staffAssignment->assigned_at->diffForHumans() }}</p>
                        </div>
                    @endif
                    <div class="flex gap-3">
                        <select wire:model.live="selectedStaffId"
                            class="flex-1 px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500">
                            <option value="">Pilih Staff</option>
                            @foreach ($staff as $staffMember)
                                <option value="{{ $staffMember->id }}">{{ $staffMember->name }}</option>
                            @endforeach
                        </select>
                        <button type="button" wire:click="assignStaff" wire:loading.attr="disabled"
                            wire:target="assignStaff"
                            class="px-6 py-2 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-green-500/30 transition-all disabled:opacity-50 disabled:cursor-not-allowed"
                            @if (!$selectedStaffId) disabled @endif>
                            <span wire:loading.remove wire:target="assignStaff">Tugaskan</span>
                            <span wire:loading wire:target="assignStaff" class="flex items-center gap-2">
                                <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                Memproses...
                            </span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div
                class="sticky bottom-0 bg-gray-50 border-t border-gray-200 px-6 py-4 flex items-center justify-end rounded-b-2xl">
                <button @click="$dispatch('close-modal', 'booking-detail-modal')"
                    class="px-6 py-2 bg-gray-600 text-white font-semibold rounded-xl hover:bg-gray-700 transition-colors">
                    Tutup
                </button>
            </div>
        </x-modal>
    @endif

    <!-- Notification Alert -->
    <x-alert />
</div>
