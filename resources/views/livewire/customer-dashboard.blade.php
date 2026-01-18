<div class="min-h-screen bg-gradient-to-b from-gray-50 to-white py-8">
    <x-container>
        <!-- Welcome Section -->
        <div class="mb-8">
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                Selamat datang kembali, <span class="text-sky-600">{{ auth()->user()->name }}!</span>
            </h1>
            <a wire:navigate href="{{ route('booking.index') }}" class="inline-block">
                <button
                    class="flex items-center gap-2 px-6 py-3 bg-sky-500 hover:bg-sky-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Pesan Cucian Baru
                </button>
            </a>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Main Content (Left Side - 2 columns) -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Pemesanan Mendatang -->
                @if ($upcomingBooking)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-6">
                            <h2 class="text-2xl font-bold text-gray-900 mb-4">Pemesanan Mendatang</h2>
                        </div>

                        <!-- Image -->
                        <div class="relative h-48 bg-gradient-to-br from-gray-800 to-gray-900">
                            <img src="{{ asset('assets/img/hero-bike.jpg') }}" alt="Motor"
                                class="w-full h-full object-cover opacity-80">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        </div>

                        <!-- Content -->
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">
                                {{ $upcomingBooking->servicePackage->name }}</h3>
                            <div class="flex items-center gap-2 text-gray-600 mb-4">
                                <svg class="w-5 h-5 text-sky-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="font-medium">{{ $upcomingBooking->booking_date->format('d M Y') }} •
                                    {{ $upcomingBooking->booking_time }}</span>
                            </div>

                            <!-- Status Progress -->
                            <div class="mb-6">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-semibold text-gray-700">Status: <span
                                            class="text-sky-600">
                                            @switch($upcomingBooking->status)
                                                @case('awaiting_payment')
                                                    Menunggu Pembayaran
                                                @break

                                                @case('payment_uploaded')
                                                    Menunggu Verifikasi
                                                @break

                                                @case('payment_verified')
                                                    Pembayaran Terverifikasi
                                                @break

                                                @case('confirmed')
                                                    Dikonfirmasi
                                                @break

                                                @case('in_progress')
                                                    Sedang Dikerjakan
                                                @break

                                                @default
                                                    {{ ucfirst(str_replace('_', ' ', $upcomingBooking->status)) }}
                                            @endswitch
                                        </span></span>
                                </div>

                                <!-- Progress Bar -->
                                <div class="relative">
                                    <div class="flex justify-between mb-3">
                                        <div class="text-center flex-1">
                                            <div
                                                class="w-10 h-10 mx-auto mb-1 rounded-full bg-sky-500 flex items-center justify-center">
                                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <p class="text-xs font-medium text-gray-600">Dipesan</p>
                                        </div>
                                        <div class="flex-1 flex items-center">
                                            <div
                                                class="h-1 w-full {{ in_array($upcomingBooking->status, ['payment_verified', 'confirmed', 'in_progress']) ? 'bg-sky-500' : 'bg-gray-300' }}">
                                            </div>
                                        </div>
                                        <div class="text-center flex-1">
                                            <div
                                                class="w-10 h-10 mx-auto mb-1 rounded-full {{ in_array($upcomingBooking->status, ['payment_verified', 'confirmed', 'in_progress']) ? 'bg-sky-500' : 'bg-gray-300' }} flex items-center justify-center">
                                                @if (in_array($upcomingBooking->status, ['payment_verified', 'confirmed', 'in_progress']))
                                                    <svg class="w-5 h-5 text-white" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                @else
                                                    <div class="w-3 h-3 bg-white rounded-full"></div>
                                                @endif
                                            </div>
                                            <p class="text-xs font-medium text-gray-600">Dikonfirmasi</p>
                                        </div>
                                        <div class="flex-1 flex items-center">
                                            <div
                                                class="h-1 w-full {{ $upcomingBooking->status === 'in_progress' ? 'bg-sky-500' : 'bg-gray-300' }}">
                                            </div>
                                        </div>
                                        <div class="text-center flex-1">
                                            <div
                                                class="w-10 h-10 mx-auto mb-1 rounded-full {{ $upcomingBooking->status === 'in_progress' ? 'bg-green-500' : 'bg-gray-300' }} flex items-center justify-center">
                                                @if ($upcomingBooking->status === 'in_progress')
                                                    <svg class="w-5 h-5 text-white" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                @else
                                                    <div class="w-3 h-3 bg-white rounded-full"></div>
                                                @endif
                                            </div>
                                            <p class="text-xs font-medium text-gray-600">Dikerjakan</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex gap-3">
                                <button wire:click="rescheduleBooking"
                                    class="flex-1 px-4 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition-colors duration-200">
                                    Reschedule
                                </button>
                                @if (in_array($upcomingBooking->status, ['awaiting_payment', 'pending']))
                                    <button wire:click="cancelBooking({{ $upcomingBooking->id }})"
                                        class="flex-1 px-4 py-3 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-xl transition-colors duration-200">
                                        Cancel
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Riwayat Pemesanan -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Riwayat Pemesanan</h2>

                    <!-- Table for Desktop -->
                    <div class="hidden md:block overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-gray-200">
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600 uppercase">
                                        Tanggal</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600 uppercase">
                                        Layanan</th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600 uppercase">Staff
                                    </th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600 uppercase">Biaya
                                    </th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600 uppercase">Status
                                    </th>
                                    <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600 uppercase">Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse ($recentBookings as $booking)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="py-4 px-4 text-sm text-gray-900">
                                            {{ $booking->booking_date->format('d M Y') }}</td>
                                        <td class="py-4 px-4 text-sm font-medium text-gray-900">
                                            {{ $booking->servicePackage->name }}
                                        </td>
                                        <td class="py-4 px-4 text-sm text-gray-700">
                                            {{ $booking->staffAssignment?->staff->name ?? '-' }}</td>
                                        <td class="py-4 px-4 text-sm font-semibold text-gray-900">
                                            Rp{{ number_format($booking->total_price, 0, ',', '.') }}</td>
                                        <td class="py-4 px-4">
                                            @if ($booking->status === 'completed')
                                                <span
                                                    class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Selesai</span>
                                            @elseif($booking->status === 'cancelled')
                                                <span
                                                    class="px-3 py-1 bg-red-100 text-red-800 text-xs font-semibold rounded-full">Dibatalkan</span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-4">
                                            @if ($booking->status === 'completed' && !$booking->review)
                                                <a href="{{ route('booking.show', ['id' => $booking->id, 'review' => 'true']) }}"
                                                    wire:navigate
                                                    class="text-sm font-semibold text-sky-600 hover:text-sky-700 transition-colors">
                                                    Beri Ulasan
                                                </a>
                                            @elseif($booking->review)
                                                <span class="text-sm text-gray-500">Sudah Diulas</span>
                                            @else
                                                <span class="text-sm text-gray-400">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="py-8 text-center text-gray-500">
                                            Belum ada riwayat pesanan
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Cards for Mobile -->
                    <div class="md:hidden space-y-4">
                        @forelse ($recentBookings as $booking)
                            <div class="border border-gray-200 rounded-xl p-4">
                                <div class="flex justify-between items-start mb-3">
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $booking->servicePackage->name }}
                                        </p>
                                        <p class="text-sm text-gray-500">{{ $booking->booking_date->format('d M Y') }}
                                        </p>
                                    </div>
                                    @if ($booking->status === 'completed')
                                        <span
                                            class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">Selesai</span>
                                    @elseif($booking->status === 'cancelled')
                                        <span
                                            class="px-3 py-1 bg-red-100 text-red-800 text-xs font-semibold rounded-full">Dibatalkan</span>
                                    @endif
                                </div>
                                <div class="space-y-2 text-sm">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Staff:</span>
                                        <span
                                            class="font-medium">{{ $booking->staffAssignment?->staff->name ?? '-' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Biaya:</span>
                                        <span
                                            class="font-semibold">Rp{{ number_format($booking->total_price, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                                @if ($booking->status === 'completed' && !$booking->review)
                                    <a href="{{ route('booking.show', ['id' => $booking->id, 'review' => 'true']) }}"
                                        wire:navigate
                                        class="mt-3 w-full py-2 text-sm font-semibold text-sky-600 hover:bg-sky-50 rounded-lg transition-colors block text-center">
                                        Beri Ulasan
                                    </a>
                                @endif
                            </div>
                        @empty
                            <div class="text-center py-8 text-gray-500">
                                Belum ada riwayat pesanan
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Sidebar (Right Side - 1 column) -->
            <div class="space-y-8">
                <!-- Kemajuan Loyalitas -->
                <div class="bg-gradient-to-br from-sky-50 to-blue-50 rounded-2xl shadow-sm border border-sky-200 p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Kemajuan Loyalitas</h2>
                    <div class="text-center mb-6">
                        <p class="text-2xl font-bold text-sky-600 mb-2">{{ $loyaltyProgress['target'] }} Cucian = 1
                            Gratis!</p>
                        <p class="text-lg font-semibold text-gray-700">{{ $loyaltyProgress['current'] }} /
                            {{ $loyaltyProgress['target'] }}
                            Cucian</p>
                    </div>

                    <!-- Water Drops Progress -->
                    <div class="grid grid-cols-5 gap-3 mb-6">
                        @for ($i = 1; $i <= $loyaltyProgress['target']; $i++)
                            <div class="flex justify-center">
                                @if ($i <= $loyaltyProgress['current'])
                                    <!-- Filled Drop (Blue) -->
                                    <svg class="w-10 h-10 text-sky-500" viewBox="0 0 36 44" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M18.4125 32.5C18.7125 32.475 18.9688 32.3562 19.1813 32.1437C19.3938 31.9312 19.5 31.675 19.5 31.375C19.5 31.025 19.3875 30.7437 19.1625 30.5312C18.9375 30.3187 18.65 30.225 18.3 30.25C17.275 30.325 16.1875 30.0437 15.0375 29.4062C13.8875 28.7687 13.1625 27.6125 12.8625 25.9375C12.8125 25.6625 12.6813 25.4375 12.4688 25.2625C12.2563 25.0875 12.0125 25 11.7375 25C11.3875 25 11.1 25.1312 10.875 25.3937C10.65 25.6562 10.575 25.9625 10.65 26.3125C11.075 28.5875 12.075 30.2125 13.65 31.1875C15.225 32.1625 16.8125 32.6 18.4125 32.5ZM18 37C14.575 37 11.7188 35.825 9.43125 33.475C7.14375 31.125 6 28.2 6 24.7C6 22.2 6.99375 19.4812 8.98125 16.5437C10.9688 13.6062 13.975 10.425 18 7C22.025 10.425 25.0312 13.6062 27.0188 16.5437C29.0063 19.4812 30 22.2 30 24.7C30 28.2 28.8563 31.125 26.5688 33.475C24.2812 35.825 21.425 37 18 37ZM18 34C20.6 34 22.75 33.1187 24.45 31.3562C26.15 29.5937 27 27.375 27 24.7C27 22.875 26.2438 20.8125 24.7313 18.5125C23.2188 16.2125 20.975 13.7 18 10.975C15.025 13.7 12.7812 16.2125 11.2688 18.5125C9.75625 20.8125 9 22.875 9 24.7C9 27.375 9.85 29.5937 11.55 31.3562C13.25 33.1187 15.4 34 18 34Z"
                                            fill="currentColor" />
                                    </svg>
                                @else
                                    <!-- Empty Drop (Gray) -->
                                    <svg class="w-10 h-10 text-gray-400" viewBox="0 0 36 44" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M18.4125 32.5C18.7125 32.475 18.9688 32.3562 19.1813 32.1437C19.3938 31.9312 19.5 31.675 19.5 31.375C19.5 31.025 19.3875 30.7437 19.1625 30.5312C18.9375 30.3187 18.65 30.225 18.3 30.25C17.275 30.325 16.1875 30.0437 15.0375 29.4062C13.8875 28.7687 13.1625 27.6125 12.8625 25.9375C12.8125 25.6625 12.6813 25.4375 12.4688 25.2625C12.2563 25.0875 12.0125 25 11.7375 25C11.3875 25 11.1 25.1312 10.875 25.3937C10.65 25.6562 10.575 25.9625 10.65 26.3125C11.075 28.5875 12.075 30.2125 13.65 31.1875C15.225 32.1625 16.8125 32.6 18.4125 32.5ZM18 37C14.575 37 11.7188 35.825 9.43125 33.475C7.14375 31.125 6 28.2 6 24.7C6 22.2 6.99375 19.4812 8.98125 16.5437C10.9688 13.6062 13.975 10.425 18 7C22.025 10.425 25.0312 13.6062 27.0188 16.5437C29.0063 19.4812 30 22.2 30 24.7C30 28.2 28.8563 31.125 26.5688 33.475C24.2812 35.825 21.425 37 18 37ZM18 34C20.6 34 22.75 33.1187 24.45 31.3562C26.15 29.5937 27 27.375 27 24.7C27 22.875 26.2438 20.8125 24.7313 18.5125C23.2188 16.2125 20.975 13.7 18 10.975C15.025 13.7 12.7812 16.2125 11.2688 18.5125C9.75625 20.8125 9 22.875 9 24.7C9 27.375 9.85 29.5937 11.55 31.3562C13.25 33.1187 15.4 34 18 34Z"
                                            fill="currentColor" />
                                    </svg>
                                @endif
                            </div>
                        @endfor
                    </div>

                    <div class="bg-white rounded-xl p-4 text-center">
                        <p class="text-sm text-gray-700">
                            Tinggal <span class="font-bold text-sky-600">{{ $loyaltyProgress['remaining'] }}</span>
                            lagi
                            untuk mendapatkan pencucian gratis!
                        </p>
                    </div>

                    @if ($availablePoints > 0)
                        <div
                            class="mt-4 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-xl p-4 text-white text-center">
                            <p class="font-bold">🎉 Anda punya {{ $availablePoints }} poin gratis!</p>
                            <p class="text-sm text-white/90">Gunakan saat booking</p>
                        </div>
                    @endif
                </div>

                <!-- AI Recommendation Widget -->
                <livewire:smart-recommendation />

                <!-- Tautan Cepat -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Tautan Cepat</h2>
                    <div class="space-y-3">
                        <a wire:navigate href="{{ route('profile.edit') }}"
                            class="flex items-center gap-4 p-4 hover:bg-gray-50 rounded-xl transition-colors group">
                            <div
                                class="w-12 h-12 bg-sky-100 rounded-xl flex items-center justify-center group-hover:bg-sky-200 transition-colors">
                                <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <span class="font-medium text-gray-900">Pengaturan</span>
                        </a>

                        <a wire:navigate href="{{ route('payment-methods') }}"
                            class="flex items-center gap-4 p-4 hover:bg-gray-50 rounded-xl transition-colors group">
                            <div
                                class="w-12 h-12 bg-sky-100 rounded-xl flex items-center justify-center group-hover:bg-sky-200 transition-colors">
                                <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                            </div>
                            <span class="font-medium text-gray-900">Metode Pembayaran</span>
                        </a>

                        <a wire:navigate href="{{ route('help-support') }}"
                            class="flex items-center gap-4 p-4 hover:bg-gray-50 rounded-xl transition-colors group">
                            <div
                                class="w-12 h-12 bg-sky-100 rounded-xl flex items-center justify-center group-hover:bg-sky-200 transition-colors">
                                <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span class="font-medium text-gray-900">Bantuan & Dukungan</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </x-container>
</div>
