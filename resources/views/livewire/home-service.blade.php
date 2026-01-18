<div class="min-h-screen bg-white py-12 pb-24">
    <x-container>
        <!-- Header -->
        <div class="mb-12">
            <a wire:navigate href="{{ route('dashboard') }}"
                class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-900 mb-6 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span class="font-medium">Kembali</span>
            </a>
            <div class="flex items-center gap-4 mb-8">
                <div
                    class="w-14 h-14 bg-gradient-to-br from-sky-500 to-blue-600 rounded-2xl flex items-center justify-center">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-4xl sm:text-5xl font-bold text-gray-900">Home Service</h1>
                    <p class="text-lg text-gray-600 mt-1">Teknisi datang ke lokasi Anda</p>
                </div>
            </div>

            <!-- Modern Step Progress -->
            <div class="bg-gray-50 rounded-3xl p-6 border-2 border-gray-200">
                <div class="flex items-center justify-between relative">
                    <!-- Step 1 -->
                    <div class="flex-1 flex flex-col items-center relative z-10">
                        <div
                            class="w-14 h-14 rounded-2xl flex items-center justify-center mb-3 transition-all {{ $currentStep >= 1 ? 'bg-gradient-to-br from-sky-500 to-blue-600' : 'bg-gray-300' }}">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <p class="text-sm font-bold {{ $currentStep >= 1 ? 'text-sky-600' : 'text-gray-500' }}">Lokasi
                        </p>
                    </div>

                    <!-- Line 1 -->
                    <div class="flex-1 h-1 bg-gray-300 relative -top-4">
                        <div class="h-full bg-gradient-to-r from-sky-500 to-blue-600 transition-all"
                            style="width: {{ $currentStep >= 2 ? '100%' : '0%' }}"></div>
                    </div>

                    <!-- Step 2 -->
                    <div class="flex-1 flex flex-col items-center relative z-10">
                        <div
                            class="w-14 h-14 rounded-2xl flex items-center justify-center mb-3 transition-all {{ $currentStep >= 2 ? 'bg-gradient-to-br from-sky-500 to-blue-600' : 'bg-gray-300' }}">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <p class="text-sm font-bold {{ $currentStep >= 2 ? 'text-sky-600' : 'text-gray-500' }}">Paket
                        </p>
                    </div>

                    <!-- Line 2 -->
                    <div class="flex-1 h-1 bg-gray-300 relative -top-4">
                        <div class="h-full bg-gradient-to-r from-sky-500 to-blue-600 transition-all"
                            style="width: {{ $currentStep >= 3 ? '100%' : '0%' }}"></div>
                    </div>

                    <!-- Step 3 -->
                    <div class="flex-1 flex flex-col items-center relative z-10">
                        <div
                            class="w-14 h-14 rounded-2xl flex items-center justify-center mb-3 transition-all {{ $currentStep >= 3 ? 'bg-gradient-to-br from-sky-500 to-blue-600' : 'bg-gray-300' }}">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <p class="text-sm font-bold {{ $currentStep >= 3 ? 'text-sky-600' : 'text-gray-500' }}">Jadwal
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid lg:grid-cols-12 gap-8">
            <!-- Main Form - 8 cols -->
            <div class="lg:col-span-8 space-y-6">
                <!-- Step 1: Lokasi -->
                @if ($currentStep === 1)
                    <div class="bg-gray-50 rounded-3xl border-2 border-gray-200 p-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div
                                class="w-10 h-10 bg-sky-500 rounded-xl flex items-center justify-center text-white font-bold text-lg">
                                1
                            </div>
                            <h2 class="text-2xl font-bold text-gray-900">Tentukan Lokasi</h2>
                        </div>

                        <!-- Address Input -->
                        <div class="bg-white rounded-2xl p-6 border border-gray-200 mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Alamat Lengkap</label>
                            <input type="text" id="address-input" wire:model="address"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-sky-500 focus:ring-0 transition-all font-medium"
                                placeholder="Mulai ketik alamat Anda...">
                            <p class="text-xs text-gray-500 mt-2">Ketik alamat atau geser marker di peta</p>
                        </div>

                        <!-- GPS Button -->
                        <button type="button" onclick="getCurrentLocation()"
                            class="w-full flex items-center justify-center gap-2 px-6 py-4 bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white font-bold rounded-2xl transition-all mb-6">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Gunakan Lokasi GPS Saya
                        </button>

                        <!-- Location Info -->
                        @if ($nearestLocation)
                            <div
                                class="bg-gradient-to-r from-sky-50 to-blue-50 rounded-2xl p-5 mb-6 border border-sky-200">
                                <div class="flex items-start gap-3">
                                    <div
                                        class="w-10 h-10 bg-sky-500 rounded-xl flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-base font-bold text-gray-900 mb-1">{{ $nearestLocation->name }}
                                        </h4>
                                        <p class="text-xs text-gray-600 mb-2">{{ $nearestLocation->address }}</p>
                                        <div class="flex flex-wrap gap-2 text-xs">
                                            @if ($nearestLocation->is_main_branch)
                                                <span
                                                    class="inline-flex items-center gap-1 px-2 py-1 bg-orange-100 text-orange-700 rounded-full font-medium">
                                                    ⭐ Cabang Utama
                                                </span>
                                            @endif
                                            <span
                                                class="inline-flex items-center gap-1 px-2 py-1 bg-white text-gray-700 rounded-full font-medium">
                                                📞 {{ $nearestLocation->phone }}
                                            </span>
                                            <span
                                                class="inline-flex items-center gap-1 px-2 py-1 bg-white text-gray-700 rounded-full font-medium">
                                                🕐 {{ substr($nearestLocation->open_time, 0, 5) }} -
                                                {{ substr($nearestLocation->close_time, 0, 5) }}
                                            </span>
                                            <span
                                                class="inline-flex items-center gap-1 px-2 py-1 bg-white text-gray-700 rounded-full font-medium">
                                                📍 Radius {{ $nearestLocation->max_service_radius_km }} km
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Leaflet Map -->
                        <div class="relative">
                            <div wire:ignore id="map"
                                class="w-full h-96 bg-gray-100 rounded-3xl overflow-hidden border-2 border-gray-200"
                                style="min-height: 384px;"></div>

                            <!-- Loading Overlay -->
                            <div id="map-loading"
                                class="absolute inset-0 bg-gray-100 rounded-3xl flex items-center justify-center z-50">
                                <div class="text-center">
                                    <!-- Spinner -->
                                    <div class="relative w-16 h-16 mx-auto mb-4">
                                        <div
                                            class="absolute top-0 left-0 w-full h-full border-4 border-gray-300 rounded-full">
                                        </div>
                                        <div
                                            class="absolute top-0 left-0 w-full h-full border-4 border-sky-500 rounded-full border-t-transparent animate-spin">
                                        </div>
                                    </div>
                                    <!-- Text -->
                                    <p class="text-gray-700 font-bold text-lg mb-2">Memuat Peta...</p>
                                    <p class="text-gray-500 text-sm">Mohon tunggu sebentar</p>
                                </div>
                            </div>
                        </div>

                        @if ($distance)
                            <div
                                class="mt-6 bg-gradient-to-r from-green-50 to-emerald-50 border-2 border-green-200 rounded-2xl p-6">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center flex-shrink-0">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-2">
                                            <p class="font-bold text-green-900 text-lg">Lokasi Terverifikasi</p>
                                            @if ($nearestLocation && $nearestLocation->is_main_branch)
                                                <span
                                                    class="inline-flex items-center px-2 py-1 bg-orange-100 text-orange-700 text-xs rounded-full font-medium">
                                                    ⭐ Cabang Utama
                                                </span>
                                            @endif
                                        </div>
                                        <p class="text-sm text-green-700 font-semibold mb-1">
                                            📍 Cabang Terdekat: {{ $nearestLocation ? $nearestLocation->name : '-' }}
                                        </p>
                                        <p class="text-sm text-green-700">
                                            📏 Jarak: <span class="font-bold">{{ $distance }} km</span>
                                        </p>
                                        <p class="text-sm text-green-700">
                                            💰 Biaya kunjungan: <span
                                                class="font-bold">Rp{{ number_format($serviceFee, 0, ',', '.') }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif

                <!-- Step 2: Paket Layanan -->
                @if ($currentStep === 2)
                    <div class="bg-gray-50 rounded-3xl border-2 border-gray-200 p-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div
                                class="w-10 h-10 bg-sky-500 rounded-xl flex items-center justify-center text-white font-bold text-lg">
                                2
                            </div>
                            <h2 class="text-2xl font-bold text-gray-900">Pilih Paket</h2>
                        </div>

                        <div class="space-y-4">
                            @foreach ($servicePackages as $package)
                                <div wire:click="selectPackage({{ $package->id }})"
                                    class="cursor-pointer bg-white rounded-3xl p-6 border-2 transition-all {{ $servicePackageId === $package->id ? 'border-sky-500' : 'border-gray-200 hover:border-gray-300' }}">
                                    <div class="flex items-center gap-6">
                                        @if ($servicePackageId === $package->id)
                                            <div
                                                class="w-16 h-16 bg-green-500 rounded-2xl flex items-center justify-center flex-shrink-0">
                                                <svg class="w-8 h-8 text-white" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        @else
                                            <div
                                                class="w-16 h-16 bg-sky-100 rounded-2xl flex items-center justify-center flex-shrink-0">
                                                <svg class="w-8 h-8 text-sky-600" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                                </svg>
                                            </div>
                                        @endif

                                        <div class="flex-1">
                                            <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $package->name }}
                                            </h3>
                                            <p class="text-sm text-gray-600">{{ $package->description }}</p>
                                        </div>

                                        <div class="text-right">
                                            <p class="text-3xl font-bold text-gray-900">
                                                {{ number_format($package->base_price / 1000, 0) }}K
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Step 3: Jadwal -->
                @if ($currentStep === 3)
                    <div class="bg-gray-50 rounded-3xl border-2 border-gray-200 p-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div
                                class="w-10 h-10 bg-sky-500 rounded-xl flex items-center justify-center text-white font-bold text-lg">
                                3
                            </div>
                            <h2 class="text-2xl font-bold text-gray-900">Pilih Jadwal</h2>
                        </div>

                        <!-- Date Picker -->
                        <div class="bg-white rounded-2xl p-6 border border-gray-200 mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Tanggal Layanan</label>
                            <input type="date" wire:model.live="selectedDate" min="{{ date('Y-m-d') }}"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-sky-500 focus:ring-0 transition-all font-medium">
                        </div>

                        <!-- Time Picker -->
                        <div class="bg-white rounded-2xl p-6 border border-gray-200 mb-6">
                            <label class="block text-sm font-semibold text-gray-700 mb-4">Waktu Kunjungan</label>
                            @if (count($availableTimeSlots) > 0)
                                <div class="grid grid-cols-4 sm:grid-cols-5 gap-3">
                                    @foreach ($availableTimeSlots as $slot)
                                        @php
                                            // Additional check: if booking for today, hide past time slots
                                            $isPast = false;
                                            if ($selectedDate === date('Y-m-d')) {
                                                $slotDateTime = \Carbon\Carbon::parse(
                                                    $selectedDate . ' ' . $slot['time'],
                                                );
                                                $isPast = $slotDateTime->lte(now());
                                            }
                                        @endphp
                                        @if (!$isPast)
                                            <button wire:click="selectTime('{{ $slot['time'] }}')" type="button"
                                                @disabled(!$slot['available'])
                                                class="px-4 py-3 rounded-xl font-semibold transition-all text-sm {{ $selectedTime === $slot['time'] ? 'bg-gradient-to-br from-sky-500 to-blue-600 text-white' : ($slot['available'] ? 'bg-gray-100 text-gray-700 hover:bg-gray-200' : 'bg-gray-50 text-gray-400 cursor-not-allowed') }}">
                                                {{ $slot['time'] }}
                                                @if (!$slot['available'])
                                                    <span class="block text-xs mt-1">Penuh</span>
                                                @endif
                                            </button>
                                        @endif
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8 text-gray-500">
                                    <svg class="w-12 h-12 mx-auto mb-2 text-gray-400" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="font-medium">Tidak ada slot waktu tersedia</p>
                                    <p class="text-sm">Silakan pilih tanggal lain</p>
                                </div>
                            @endif
                        </div>

                        <!-- Duration Info -->
                        <div class="bg-gradient-to-r from-sky-50 to-blue-50 border-2 border-sky-200 rounded-2xl p-6">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-12 h-12 bg-sky-500 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-700">Estimasi Durasi</p>
                                    <p class="text-xl font-bold text-sky-600">15 menit</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar Summary - 4 cols -->
            <div class="lg:col-span-4">
                <div class="bg-gradient-to-br from-sky-500 to-blue-600 rounded-3xl p-8 text-white sticky top-24">
                    <h2 class="text-2xl font-bold mb-6">Ringkasan</h2>

                    <div class="space-y-4 mb-8">
                        @if ($currentStep >= 1 && $distance)
                            <div class="bg-white/10 backdrop-blur rounded-2xl p-4">
                                <div class="text-sm text-sky-100 mb-1">Jarak</div>
                                <div class="text-lg font-bold">{{ $distance }} km dari toko</div>
                            </div>
                        @endif

                        @if ($currentStep >= 2 && $servicePackageId)
                            @php
                                $selectedPackage = $servicePackages->firstWhere('id', $servicePackageId);
                            @endphp
                            @if ($selectedPackage)
                                <div class="bg-white/10 backdrop-blur rounded-2xl p-4">
                                    <div class="text-sm text-sky-100 mb-1">Paket</div>
                                    <div class="text-lg font-bold">{{ $selectedPackage->name }}</div>
                                </div>
                            @endif
                        @endif

                        @if ($currentStep >= 3 && $selectedDate && $selectedTime)
                            <div class="bg-white/10 backdrop-blur rounded-2xl p-4">
                                <div class="text-sm text-sky-100 mb-1">Jadwal</div>
                                <div class="text-lg font-bold">
                                    {{ date('d M Y', strtotime($selectedDate)) }}<br>
                                    {{ $selectedTime }} WIB
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Price Breakdown -->
                    <div class="border-t border-white/20 pt-6 mb-8">
                        @if ($servicePackageId)
                            @php
                                $selectedPkg = $servicePackages->firstWhere('id', $servicePackageId);
                                $selectedEng = $engineCapacities->firstWhere('id', $engineCapacityId);
                            @endphp
                            @if ($selectedPkg)
                                <div class="flex justify-between items-center mb-3 text-sky-100">
                                    <span>Harga Paket</span>
                                    <span
                                        class="font-semibold">Rp{{ number_format($selectedPkg->base_price, 0, ',', '.') }}</span>
                                </div>
                                @if ($selectedEng && $selectedEng->price_multiplier > 1.0)
                                    <div class="flex justify-between items-center mb-3 text-sky-100">
                                        <span>Biaya Kapasitas Mesin</span>
                                        <span
                                            class="font-semibold">Rp{{ number_format($selectedPkg->base_price * ($selectedEng->price_multiplier - 1), 0, ',', '.') }}</span>
                                    </div>
                                @endif
                            @endif
                        @endif
                        @if ($serviceFee > 0)
                            <div class="flex justify-between items-center mb-3 text-sky-100">
                                <span>Biaya Kunjungan</span>
                                <span class="font-semibold">Rp{{ number_format($serviceFee, 0, ',', '.') }}</span>
                            </div>
                        @endif
                        @if ($promoDiscount > 0)
                            <div class="flex justify-between items-center mb-2 text-green-300">
                                <span>Diskon Promo</span>
                                <span class="font-semibold">-Rp{{ number_format($promoDiscount, 0, ',', '.') }}</span>
                            </div>
                        @endif
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sky-100">Total</span>
                        </div>
                        <div class="text-4xl font-bold">
                            @if ($promoDiscount > 0)
                                <div class="text-2xl line-through text-sky-200 opacity-50">
                                    Rp{{ number_format($this->getSubTotalPrice(), 0, ',', '.') }}</div>
                                <div class="text-4xl mt-2">Rp{{ number_format($this->getTotalPrice(), 0, ',', '.') }}
                                </div>
                            @else
                                Rp{{ number_format($this->getTotalPrice(), 0, ',', '.') }}
                            @endif
                        </div>
                    </div>

                    <!-- Promo Code -->
                    <div class="bg-white/10 backdrop-blur rounded-2xl p-4 mb-6 border border-white/20">
                        <div class="flex items-center gap-2 mb-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            <span class="font-bold text-white">Kode Promo</span>
                        </div>
                        @if ($appliedPromoCode)
                            <div class="bg-white/20 backdrop-blur rounded-xl p-3">
                                <div class="flex items-center justify-between gap-2">
                                    <div class="flex-1 min-w-0">
                                        <p class="font-semibold text-white">{{ $appliedPromoCode->code }}</p>
                                        <p class="text-xs text-white/80 truncate">{{ $appliedPromoCode->description }}
                                        </p>
                                    </div>
                                    <button wire:click="removePromoCode" type="button"
                                        class="flex-shrink-0 text-white hover:text-red-200 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="mt-2 text-sm text-white">
                                    Diskon: <span
                                        class="font-bold">Rp{{ number_format($promoDiscount, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        @else
                            <div class="space-y-2">
                                <input type="text" wire:model="promoCode" wire:keydown.enter="applyPromoCode"
                                    placeholder="Masukkan kode promo"
                                    class="w-full px-4 py-2 rounded-xl border-0 focus:ring-2 focus:ring-white/50 text-gray-900 placeholder-gray-500 uppercase">
                                <button wire:click="applyPromoCode" type="button"
                                    class="w-full px-4 py-2 bg-white text-sky-600 font-semibold rounded-xl hover:bg-gray-100 transition-colors">
                                    Terapkan
                                </button>
                            </div>
                        @endif
                    </div>

                    <!-- Action Buttons -->
                    <div class="space-y-3">
                        <button wire:click="nextStep" type="button" wire:loading.attr="disabled"
                            @disabled($isProcessing)
                            class="w-full font-bold py-4 rounded-2xl transition-all disabled:opacity-50 disabled:cursor-not-allowed {{ $isProcessing ? 'bg-gray-300 text-gray-600' : 'bg-white hover:bg-gray-50 text-sky-600' }}">
                            <span wire:loading.remove wire:target="nextStep">
                                @if ($currentStep === 3)
                                    Konfirmasi Booking
                                @else
                                    Lanjutkan
                                @endif
                            </span>
                            <span wire:loading wire:target="nextStep" class="flex items-center justify-center gap-2">
                                <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                {{ $currentStep === 3 ? 'Memproses...' : 'Memproses...' }}
                            </span>
                        </button>

                        @if ($currentStep > 1)
                            <button wire:click="previousStep" type="button"
                                class="w-full bg-white/10 hover:bg-white/20 backdrop-blur text-white font-bold py-4 rounded-2xl transition-all">
                                Kembali
                            </button>
                        @endif
                    </div>

                    <!-- Info -->
                    <div class="mt-6 bg-white/10 backdrop-blur rounded-2xl p-4">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-sky-100 flex-shrink-0 mt-0.5" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd" />
                            </svg>
                            <p class="text-sm text-sky-50 leading-relaxed">
                                Teknisi akan datang ke lokasi Anda dengan peralatan lengkap. +1 poin loyalitas!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-container>

    @push('styles')
        <!-- Leaflet CSS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
            integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

        <!-- Leaflet JS -->
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    @endpush

    @push('scripts')
        <script>
            // Use window object to prevent redeclaration issues with Livewire navigation
            window.mapInitialized = window.mapInitialized || false;
            window.homeServiceMap = window.homeServiceMap || null;
            window.homeServiceMarker = window.homeServiceMarker || null;
            window.homeServiceStoreMarker = window.homeServiceStoreMarker || null;
            window.homeServiceCircle = window.homeServiceCircle || null;
            window.autocompleteTimeout = window.autocompleteTimeout || null;
            window.autocompleteResults = window.autocompleteResults || [];

            // Use window object to prevent redeclaration issues with Livewire navigation
            window.allLocations = @json($locationsForMap);

            window.storeLocation = {
                lat: {{ $nearestLocation ? $nearestLocation->latitude : 0.478652 }},
                lng: {{ $nearestLocation ? $nearestLocation->longitude : 101.402108 }}
            };

            function initMap() {
                // Cleanup existing map instance
                if (window.homeServiceMap) {
                    try {
                        window.homeServiceMap.remove();
                    } catch (e) {
                        console.log('Error removing old map:', e);
                    }
                    window.homeServiceMap = null;
                    window.homeServiceMarker = null;
                    window.homeServiceStoreMarker = null;
                    window.homeServiceCircle = null;
                }

                const mapContainer = document.getElementById('map');
                if (!mapContainer) {
                    console.error('Map container not found');
                    return;
                }

                // Clear the container's innerHTML to prevent Leaflet errors
                mapContainer.innerHTML = '';

                const defaultCenter = [window.storeLocation.lat, window.storeLocation.lng];

                try {
                    window.homeServiceMap = L.map('map', {
                        center: defaultCenter,
                        zoom: 15,
                        zoomControl: true,
                    });
                } catch (error) {
                    console.error('Error initializing map:', error);
                    return;
                }

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap',
                    maxZoom: 19,
                }).addTo(window.homeServiceMap);

                const redIcon = L.icon({
                    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
                    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
                    iconSize: [25, 41],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34],
                    shadowSize: [41, 41]
                });

                const blueIcon = L.icon({
                    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png',
                    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
                    iconSize: [25, 41],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34],
                    shadowSize: [41, 41]
                });

                const greenIcon = L.icon({
                    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
                    shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',
                    iconSize: [25, 41],
                    iconAnchor: [12, 41],
                    popupAnchor: [1, -34],
                    shadowSize: [41, 41]
                });

                window.homeServiceMarker = L.marker(defaultCenter, {
                    draggable: true,
                    icon: redIcon
                }).addTo(window.homeServiceMap);

                window.homeServiceMarker.bindPopup('Lokasi Anda').openPopup();

                // Add markers for all locations
                window.storeMarkers = [];
                window.storeCircles = [];

                // Get nearest location ID from PHP
                const nearestLocationId = {{ $nearestLocation ? $nearestLocation->id : 'null' }};

                window.allLocations.forEach((location, index) => {
                    // Determine if this is the nearest location
                    const isNearest = location.id === nearestLocationId;

                    // Create marker with appropriate icon
                    const marker = L.marker([location.lat, location.lng], {
                        icon: isNearest ? greenIcon : blueIcon
                    }).addTo(window.homeServiceMap);

                    const popupContent = `
                        <div class="text-center">
                            <strong class="${isNearest ? 'text-green-600' : ''}">${location.name}</strong>
                            ${location.is_main ? '<br/><span class="text-orange-600 text-xs">⭐ Cabang Utama</span>' : ''}
                            <br/><span class="text-xs text-gray-600">Radius: ${location.radius} km</span>
                        </div>
                    `;
                    marker.bindPopup(popupContent);

                    // Create service area circle
                    const circle = L.circle([location.lat, location.lng], {
                        color: isNearest ? '#10b981' : (location.is_main ? '#f97316' : '#0ea5e9'),
                        fillColor: isNearest ? '#10b981' : (location.is_main ? '#f97316' : '#0ea5e9'),
                        fillOpacity: isNearest ? 0.2 : (location.is_main ? 0.15 : 0.1),
                        radius: location.radius * 1000,
                        weight: isNearest ? 2 : (location.is_main ? 2 : 1)
                    }).addTo(window.homeServiceMap);

                    window.storeMarkers.push(marker);
                    window.storeCircles.push(circle);

                    // Open popup for nearest location
                    if (isNearest) {
                        marker.openPopup();
                    }
                });

                window.homeServiceMarker.on('dragend', function(e) {
                    const position = window.homeServiceMarker.getLatLng();
                    @this.call('setLocation', position.lat, position.lng);
                    updateAddress(position.lat, position.lng);
                });

                window.homeServiceMap.on('click', function(e) {
                    window.homeServiceMarker.setLatLng(e.latlng);
                    @this.call('setLocation', e.latlng.lat, e.latlng.lng);
                    updateAddress(e.latlng.lat, e.latlng.lng);
                });

                // Hide loading indicator when map is ready
                window.homeServiceMap.whenReady(function() {
                    const loadingEl = document.getElementById('map-loading');
                    if (loadingEl) {
                        loadingEl.style.transition = 'opacity 0.3s ease';
                        loadingEl.style.opacity = '0';
                        setTimeout(() => {
                            loadingEl.style.display = 'none';
                        }, 300);
                    }
                    console.log('Map is ready!');
                });

                window.mapInitialized = true;
            }

            function getCurrentLocation() {
                if (navigator.geolocation) {
                    // Show loading state
                    const btn = event.target.closest('button');
                    const originalText = btn.innerHTML;
                    btn.disabled = true;
                    btn.innerHTML = `
                        <svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        <span>Mengambil Lokasi...</span>
                    `;

                    navigator.geolocation.getCurrentPosition(
                        function(position) {
                            const lat = position.coords.latitude;
                            const lng = position.coords.longitude;
                            const accuracy = position.coords.accuracy;

                            console.log('Location accuracy:', accuracy + ' meters');

                            if (window.homeServiceMap && window.homeServiceMarker) {
                                window.homeServiceMap.setView([lat, lng], 17); // Zoom lebih dekat
                                window.homeServiceMarker.setLatLng([lat, lng]);
                                @this.call('setLocation', lat, lng);
                                updateAddress(lat, lng);
                            }

                            // Restore button
                            btn.disabled = false;
                            btn.innerHTML = originalText;
                        },
                        function(error) {
                            console.error('Geolocation error:', error);
                            let errorMsg = 'Tidak dapat mendapatkan lokasi Anda. ';

                            switch (error.code) {
                                case error.PERMISSION_DENIED:
                                    errorMsg += 'Izin lokasi ditolak. Mohon aktifkan izin lokasi di browser Anda.';
                                    break;
                                case error.POSITION_UNAVAILABLE:
                                    errorMsg += 'Informasi lokasi tidak tersedia.';
                                    break;
                                case error.TIMEOUT:
                                    errorMsg += 'Permintaan lokasi timeout. Coba lagi.';
                                    break;
                                default:
                                    errorMsg += error.message;
                            }

                            alert(errorMsg);

                            // Restore button
                            btn.disabled = false;
                            btn.innerHTML = originalText;
                        }, {
                            enableHighAccuracy: true, // Akurasi tinggi
                            timeout: 10000, // 10 detik timeout
                            maximumAge: 0 // Tidak menggunakan cache lokasi
                        }
                    );
                } else {
                    alert(
                        'Geolocation tidak didukung oleh browser Anda. Mohon gunakan browser modern seperti Chrome, Firefox, atau Safari.'
                    );
                }
            }

            function updateAddress(lat, lng) {
                fetch(
                        `https://api.bigdatacloud.net/data/reverse-geocode-client?latitude=${lat}&longitude=${lng}&localityLanguage=id`
                    )
                    .then(response => response.json())
                    .then(data => {
                        const address = data.locality || data.city || data.principalSubdivision || 'Alamat tidak ditemukan';
                        document.getElementById('address-input').value = address;
                        @this.set('address', address);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }

            const addressInput = document.getElementById('address-input');
            if (addressInput) {
                // Remove old event listeners by cloning the element
                const newAddressInput = addressInput.cloneNode(true);
                addressInput.parentNode.replaceChild(newAddressInput, addressInput);

                newAddressInput.addEventListener('input', function(e) {
                    clearTimeout(window.autocompleteTimeout);
                    const query = e.target.value;

                    if (query.length < 3) return;

                    window.autocompleteTimeout = setTimeout(() => {
                        fetch(`https://photon.komoot.io/api/?q=${encodeURIComponent(query)}&limit=5`)
                            .then(response => response.json())
                            .then(data => {
                                if (data.features && data.features.length > 0) {
                                    const firstResult = data.features[0];
                                    const coords = firstResult.geometry.coordinates;
                                    if (window.homeServiceMap && window.homeServiceMarker) {
                                        window.homeServiceMap.setView([coords[1], coords[0]], 15);
                                        window.homeServiceMarker.setLatLng([coords[1], coords[0]]);
                                        @this.call('setLocation', coords[1], coords[0]);
                                    }
                                }
                            })
                            .catch(error => console.error('Error:', error));
                    }, 500);
                });
            }

            function safeInitMap() {
                // Prevent multiple initializations
                if (window.mapInitialized) {
                    console.log('Map already initialized, skipping...');
                    return;
                }

                let attempts = 0;
                const maxAttempts = 20; // Increase max attempts
                const waitTime = 100; // Reduce wait time to 100ms for faster initialization

                function tryInit() {
                    attempts++;

                    // Check if Leaflet is loaded
                    if (typeof L === 'undefined') {
                        if (attempts < maxAttempts) {
                            console.log('Leaflet not loaded yet, attempt ' + attempts + '...');
                            setTimeout(tryInit, waitTime);
                        } else {
                            console.error('Failed to load Leaflet after ' + maxAttempts + ' attempts');
                            const loadingEl = document.getElementById('map-loading');
                            if (loadingEl) {
                                loadingEl.innerHTML = `
                                    <div class="text-center">
                                        <svg class="w-16 h-16 mx-auto mb-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <p class="text-red-700 font-bold text-lg mb-2">Gagal Memuat Peta</p>
                                        <p class="text-red-600 text-sm mb-4">Koneksi internet mungkin bermasalah</p>
                                        <button onclick="window.location.reload()" class="px-6 py-2 bg-red-500 text-white rounded-xl hover:bg-red-600 font-semibold">
                                            Muat Ulang Halaman
                                        </button>
                                    </div>
                                `;
                            }
                        }
                        return;
                    }

                    // Check if map container exists
                    const mapContainer = document.getElementById('map');
                    if (!mapContainer) {
                        if (attempts < maxAttempts) {
                            console.log('Map container not ready, attempt ' + attempts + '...');
                            setTimeout(tryInit, waitTime);
                        } else {
                            console.error('Map container not found after ' + maxAttempts + ' attempts');
                        }
                        return;
                    }

                    console.log('Initializing map...');
                    initMap();
                }

                tryInit();
            }

            // Cleanup on page leave
            document.addEventListener('livewire:navigating', function() {
                if (window.homeServiceMap) {
                    try {
                        window.homeServiceMap.remove();
                    } catch (e) {
                        console.log('Error during cleanup:', e);
                    }
                    window.homeServiceMap = null;
                    window.homeServiceMarker = null;
                    window.homeServiceStoreMarker = null;
                    window.homeServiceCircle = null;
                    window.mapInitialized = false;
                }
            });

            // Initialize map immediately
            // Use a small timeout to ensure DOM is ready but don't wait too long
            setTimeout(function() {
                safeInitMap();
            }, 50);
        </script>
    @endpush
</div>
