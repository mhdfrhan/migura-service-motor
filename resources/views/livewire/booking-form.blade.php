<div class="grid lg:grid-cols-12 gap-8">
    <!-- Main Form - 8 cols -->
    <div class="lg:col-span-8 space-y-6">
        <!-- AI Recommendation Banner -->
        @if ($showRecommendation && $aiRecommendation && $aiRecommendation['package'])
            <div class="bg-gradient-to-br from-purple-500 via-pink-500 to-orange-500 rounded-3xl p-1">
                <div class="bg-white rounded-3xl p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center text-white text-2xl">
                                ✨
                            </div>
                            <div>
                                <div class="flex items-center gap-2">
                                    <h3 class="text-xl font-bold text-gray-900">Rekomendasi Khusus Untuk Anda</h3>
                                    <span
                                        class="px-3 py-1 bg-gradient-to-r from-purple-500 to-pink-500 text-white text-xs font-semibold rounded-full">
                                        {{ $aiRecommendation['badge'] }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600 mt-1">Berdasarkan analisis AI dari riwayat booking Anda
                                </p>
                            </div>
                        </div>
                        <button wire:click="dismissRecommendation" type="button"
                            class="text-gray-400 hover:text-gray-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl p-4 mb-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-lg font-bold text-gray-900">{{ $aiRecommendation['package']->name }}
                                </h4>
                                <p class="text-sm text-gray-600 mt-1">{{ $aiRecommendation['package']->description }}
                                </p>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold text-purple-600">
                                    {{ format_currency($aiRecommendation['package']->base_price) }}
                                </div>
                                <div class="text-xs text-gray-500 mt-1">
                                    {{ $aiRecommendation['confidence'] }}% cocok
                                </div>
                            </div>
                        </div>

                        @if ($aiRecommendation['package']->features && is_array($aiRecommendation['package']->features))
                            <div class="flex flex-wrap gap-2 mt-4">
                                @foreach ($aiRecommendation['package']->features as $feature)
                                    <span
                                        class="px-3 py-1 bg-white rounded-full text-xs font-medium text-gray-700 flex items-center gap-1">
                                        <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        {{ $feature }}
                                    </span>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="bg-blue-50 rounded-xl p-4 mb-4">
                        <h5 class="text-sm font-semibold text-gray-900 mb-2">💡 Mengapa kami merekomendasikan ini?</h5>
                        <ul class="space-y-2">
                            @foreach ($aiRecommendation['reasons'] as $reason)
                                <li class="text-sm text-gray-700 flex items-start gap-2">
                                    <span class="text-blue-500 mt-0.5">•</span>
                                    <span>{{ $reason }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    @if ($servicePackageId === $aiRecommendation['package']->id)
                        <div class="flex items-center gap-2 text-green-600 font-semibold">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Paket ini sudah dipilih untuk Anda!</span>
                        </div>
                    @else
                        <button wire:click="selectPackage({{ $aiRecommendation['package']->id }})" type="button"
                            class="w-full py-3 bg-gradient-to-r from-purple-500 to-pink-500 text-white font-semibold rounded-xl hover:from-purple-600 hover:to-pink-600 transition-all shadow-lg">
                            Gunakan Rekomendasi Ini
                        </button>
                    @endif
                </div>
            </div>
        @endif

        <!-- 1. Pilih Ukuran Mesin -->
        <div class="bg-gray-50 rounded-3xl border-2 border-gray-200 p-8">
            <div class="flex items-center gap-3 mb-6">
                <div
                    class="w-10 h-10 bg-sky-500 rounded-xl flex items-center justify-center text-white font-bold text-lg">
                    1
                </div>
                <h2 class="text-2xl font-bold text-gray-900">Ukuran Mesin</h2>
            </div>
            <div class="grid grid-cols-3 gap-4">
                @foreach ($engineCapacities as $engine)
                    <button wire:click="selectEngine({{ $engine->id }})" type="button"
                        class="px-6 py-4 rounded-2xl font-semibold transition-all {{ $engineCapacityId === $engine->id ? 'bg-gradient-to-br from-sky-500 to-blue-600 text-white' : 'bg-white border-2 border-gray-200 text-gray-700 hover:border-sky-300' }}">
                        <div
                            class="text-sm mb-1 {{ $engineCapacityId === $engine->id ? 'text-sky-100' : 'text-gray-500' }}">
                            {{ $engine->name }}</div>
                        <div class="text-lg">
                            {{ $engine->min_cc }}{{ $engine->max_cc ? '-' . $engine->max_cc : '+' }}cc
                        </div>
                        @if ($engine->price_multiplier > 1.0)
                            <div
                                class="text-xs mt-1 {{ $engineCapacityId === $engine->id ? 'text-sky-100' : 'text-gray-500' }}">
                                +{{ ($engine->price_multiplier - 1) * 100 }}%</div>
                        @endif
                    </button>
                @endforeach
            </div>
        </div>

        <!-- 2. Pilih Paket Pencucian -->
        <div class="bg-gray-50 rounded-3xl border-2 border-gray-200 p-8">
            <div class="flex items-center gap-3 mb-6">
                <div
                    class="w-10 h-10 bg-sky-500 rounded-xl flex items-center justify-center text-white font-bold text-lg">
                    2
                </div>
                <h2 class="text-2xl font-bold text-gray-900">Paket Pencucian</h2>
            </div>
            <div class="grid md:grid-cols-3 gap-4">
                @foreach ($servicePackages as $package)
                    <div wire:click="selectPackage({{ $package->id }})"
                        class="cursor-pointer relative rounded-3xl p-6 border-2 transition-all {{ $package->is_popular ? ($servicePackageId === $package->id ? 'bg-gradient-to-br from-sky-500 to-blue-600 text-white border-sky-600' : 'bg-white border-gray-200 hover:border-gray-300') : ($servicePackageId === $package->id ? 'border-sky-500' : 'border-gray-200 hover:border-gray-300') }} bg-white">
                        @if ($package->is_popular)
                            <div class="absolute -top-3 right-3">
                                <span
                                    class="px-3 py-1 bg-yellow-400 text-yellow-900 text-xs font-bold rounded-full">POPULER</span>
                            </div>
                        @endif
                        @if ($servicePackageId === $package->id)
                            <div
                                class="w-8 h-8 {{ $package->is_popular ? 'bg-white/20 backdrop-blur' : 'bg-green-500' }} rounded-full flex items-center justify-center mb-4">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        @endif
                        <div class="mb-4">
                            <h3
                                class="text-xl font-bold mb-2 {{ $package->is_popular && $servicePackageId === $package->id ? 'text-white' : 'text-gray-900' }}">
                                {{ $package->name }}</h3>
                            <div class="flex items-end gap-1">
                                <span
                                    class="text-3xl font-bold {{ $package->is_popular && $servicePackageId === $package->id ? 'text-white' : 'text-gray-900' }}">
                                    {{ number_format($package->base_price / 1000, 0) }}K
                                </span>
                            </div>
                        </div>
                        <ul class="space-y-2">
                            @php
                                $features = is_array($package->features)
                                    ? $package->features
                                    : json_decode($package->features ?? '[]', true);
                            @endphp
                            @foreach ($features as $feature)
                                <li
                                    class="flex items-center gap-2 text-sm {{ $package->is_popular && $servicePackageId === $package->id ? 'text-sky-50' : 'text-gray-700' }}">
                                    <div
                                        class="w-1.5 h-1.5 rounded-full {{ $package->is_popular && $servicePackageId === $package->id ? 'bg-white' : 'bg-sky-500' }}">
                                    </div>
                                    {{ $feature }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- 3. Pilih Tanggal & Waktu -->
        <div class="bg-gray-50 rounded-3xl border-2 border-gray-200 p-8">
            <div class="flex items-center gap-3 mb-6">
                <div
                    class="w-10 h-10 bg-sky-500 rounded-xl flex items-center justify-center text-white font-bold text-lg">
                    3
                </div>
                <h2 class="text-2xl font-bold text-gray-900">Tanggal & Waktu</h2>
            </div>

            <!-- Month Selector -->
            <div class="mb-6 bg-white rounded-2xl p-4 border border-gray-200">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Pilih Bulan</label>
                <select wire:change="changeMonth($event.target.value)"
                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-sky-500 focus:ring-0 transition-all font-medium">
                    @foreach ($this->getAvailableMonths() as $month)
                        <option value="{{ $month['value'] }}"
                            {{ sprintf('%04d-%02d', $currentYear, $currentMonth) === $month['value'] ? 'selected' : '' }}>
                            {{ $month['label'] }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Calendar -->
            <div class="bg-white rounded-2xl p-6 border border-gray-200 mb-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-900">
                        {{ date('F Y', mktime(0, 0, 0, $currentMonth, 1, $currentYear)) }}
                    </h3>
                    <div class="flex gap-2">
                        <button wire:click="previousMonth" type="button"
                            class="w-10 h-10 flex items-center justify-center hover:bg-gray-100 rounded-xl transition-colors disabled:opacity-30 disabled:cursor-not-allowed"
                            @if (sprintf('%04d-%02d', $currentYear, $currentMonth) <= date('Y-m')) disabled @endif>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button wire:click="nextMonth" type="button"
                            class="w-10 h-10 flex items-center justify-center hover:bg-gray-100 rounded-xl transition-colors disabled:opacity-30 disabled:cursor-not-allowed"
                            @if (sprintf('%04d-%02d', $currentYear, $currentMonth) >= date('Y-m', strtotime('+3 months'))) disabled @endif>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Calendar Grid -->
                <div class="grid grid-cols-7 gap-2">
                    <!-- Day Headers -->
                    @foreach (['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'] as $day)
                        <div class="text-center text-xs font-bold text-gray-500 py-3">{{ $day }}</div>
                    @endforeach

                    <!-- Calendar Days -->
                    @php
                        $firstDay = date('w', mktime(0, 0, 0, $currentMonth, 1, $currentYear));
                        $daysInMonth = date('t', mktime(0, 0, 0, $currentMonth, 1, $currentYear));
                        $today = date('Y-m-d');
                    @endphp

                    <!-- Empty cells before first day -->
                    @for ($i = 0; $i < $firstDay; $i++)
                        <div class="aspect-square"></div>
                    @endfor

                    <!-- Days of month -->
                    @for ($day = 1; $day <= $daysInMonth; $day++)
                        @php
                            $date = sprintf('%04d-%02d-%02d', $currentYear, $currentMonth, $day);
                            $isPast = $date < $today;
                            $maxDate = date('Y-m-d', strtotime('+3 months'));
                            $isTooFar = $date > $maxDate;
                            $isDisabled = $isPast || $isTooFar;
                        @endphp
                        <button wire:click="selectDate('{{ $date }}')" type="button"
                            @disabled($isDisabled)
                            class="aspect-square flex items-center justify-center rounded-xl text-sm font-semibold transition-all
                                {{ $selectedDate === $date ? 'bg-gradient-to-br from-sky-500 to-blue-600 text-white' : ($isDisabled ? 'text-gray-300 cursor-not-allowed' : 'text-gray-700 hover:bg-gray-100') }}">
                            {{ $day }}
                        </button>
                    @endfor
                </div>
            </div>

            <!-- Time Slots -->
            <div class="bg-white rounded-2xl p-6 border border-gray-200 mb-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Pilih Waktu</h3>
                @if (count($availableTimeSlots) > 0)
                    <div class="grid grid-cols-4 sm:grid-cols-5 md:grid-cols-6 gap-3 max-h-96 overflow-y-auto">
                        @foreach ($availableTimeSlots as $slot)
                            @php
                                // Additional check: if booking for today, hide past time slots
                                $isPast = false;
                                if ($selectedDate === date('Y-m-d')) {
                                    $slotDateTime = \Carbon\Carbon::parse($selectedDate . ' ' . $slot['time']);
                                    $isPast = $slotDateTime->lte(now());
                                }
                            @endphp
                            @if (!$isPast)
                                <button wire:click="selectTime('{{ $slot['time'] }}')" type="button"
                                    @disabled(!$slot['available'])
                                    class="px-3 py-2.5 rounded-xl font-semibold transition-all text-sm {{ $selectedTime === $slot['time'] ? 'bg-gradient-to-br from-sky-500 to-blue-600 text-white' : ($slot['available'] ? 'bg-gray-100 text-gray-700 hover:bg-gray-200' : 'bg-gray-50 text-gray-400 cursor-not-allowed') }}">
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
                        <svg class="w-12 h-12 mx-auto mb-2 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="font-medium">Tidak ada slot waktu tersedia</p>
                        <p class="text-sm">Silakan pilih tanggal lain</p>
                    </div>
                @endif
            </div>

            <!-- AI Prediction -->
            <div
                class="bg-gradient-to-r from-sky-50 to-blue-50 border-2 border-sky-200 rounded-2xl p-4 flex items-center gap-4">
                <div class="w-12 h-12 bg-sky-500 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-700">Prediksi Antrean AI</p>
                    <p class="text-xl font-bold text-sky-600">~15 menit</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Summary Sidebar - 4 cols -->
    <div class="lg:col-span-4">
        <div class="bg-gradient-to-br from-sky-500 to-blue-600 rounded-3xl p-8 text-white sticky top-24">
            <h2 class="text-2xl font-bold mb-6">Ringkasan Pesanan</h2>

            <div class="space-y-4 mb-8">
                @if ($engineCapacityId)
                    @php
                        $selectedEngine = $engineCapacities->firstWhere('id', $engineCapacityId);
                    @endphp
                    @if ($selectedEngine)
                        <div class="bg-white/10 backdrop-blur rounded-2xl p-4">
                            <div class="text-sm text-sky-100 mb-1">Ukuran Mesin</div>
                            <div class="text-lg font-bold">{{ $selectedEngine->name }}</div>
                        </div>
                    @endif
                @endif

                @if ($servicePackageId)
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

                @if ($selectedDate && $selectedTime)
                    <div class="bg-white/10 backdrop-blur rounded-2xl p-4">
                        <div class="text-sm text-sky-100 mb-1">Jadwal</div>
                        <div class="text-lg font-bold">
                            {{ date('d M Y', strtotime($selectedDate)) }}<br>
                            {{ $selectedTime }} WIB
                        </div>
                    </div>
                @endif
            </div>

            <div class="border-t border-white/20 pt-6 mb-6">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sky-100">Total Harga</span>
                </div>
                <div class="text-4xl font-bold">
                    @if ($useLoyaltyPoint)
                        <span
                            class="line-through text-sky-200 opacity-50 text-2xl">Rp{{ number_format($this->getPrice(), 0, ',', '.') }}</span>
                        <div class="text-5xl font-black mt-2">GRATIS!</div>
                    @else
                        @if ($promoDiscount > 0)
                            <div class="text-2xl line-through text-sky-200 opacity-50">
                                Rp{{ number_format($this->getPrice(), 0, ',', '.') }}</div>
                            <div class="text-4xl mt-2">Rp{{ number_format($this->getTotalPrice(), 0, ',', '.') }}
                            </div>
                        @else
                            Rp{{ number_format($this->getPrice(), 0, ',', '.') }}
                        @endif
                    @endif
                </div>
                @if ($promoDiscount > 0 && !$useLoyaltyPoint)
                    <div class="text-sm text-green-300 mt-2">
                        Hemat Rp{{ number_format($promoDiscount, 0, ',', '.') }} dengan promo!
                    </div>
                @endif
            </div>

            <!-- Promo Code -->
            <div class="bg-white/10 backdrop-blur rounded-2xl p-4 mb-6 border border-white/20">
                <div class="flex items-center gap-2 mb-3">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                <p class="text-xs text-white/80 truncate">{{ $appliedPromoCode->description }}</p>
                            </div>
                            <button wire:click="removePromoCode" type="button"
                                class="flex-shrink-0 text-white hover:text-red-200 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <div class="mt-2 text-sm text-white">
                            Diskon: <span class="font-bold">Rp{{ number_format($promoDiscount, 0, ',', '.') }}</span>
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

            <!-- Loyalty Point Option -->
            @auth
                @if (auth()->user()->loyalty_points > 0)
                    <div class="bg-gradient-to-r from-yellow-400 to-orange-500 rounded-2xl p-4 mb-6">
                        <label class="flex items-start gap-3 cursor-pointer">
                            <input type="checkbox" wire:model.live="useLoyaltyPoint"
                                class="mt-1 w-5 h-5 text-orange-600 border-white/30 rounded focus:ring-2 focus:ring-white/50 cursor-pointer">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    <span class="font-bold text-white">Gunakan Poin Loyalty</span>
                                </div>
                                <p class="text-sm text-white/90">
                                    Anda punya <strong>{{ auth()->user()->loyalty_points }}</strong> poin gratis! Gunakan 1
                                    poin untuk cuci gratis.
                                </p>
                            </div>
                        </label>
                    </div>
                @endif
            @endauth

            <!-- Alternative Recommendations -->
            @if ($aiRecommendation && $servicePackageId)
                @php
                    $currentPackage = $servicePackages->firstWhere('id', $servicePackageId);
                    $alternativePackages = $servicePackages
                        ->where('id', '!=', $servicePackageId)
                        ->where('is_active', true)
                        ->take(2);
                @endphp
                @if ($alternativePackages->isNotEmpty())
                    <div class="mb-6">
                        <h3 class="text-sm font-semibold text-sky-100 mb-3 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            Paket Lainnya
                        </h3>
                        <div class="space-y-2">
                            @foreach ($alternativePackages as $altPackage)
                                <button wire:click="selectPackage({{ $altPackage->id }})" type="button"
                                    class="w-full bg-white/10 hover:bg-white/20 backdrop-blur rounded-xl p-3 text-left transition-all group">
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="font-semibold text-sm">{{ $altPackage->name }}</span>
                                        @if ($altPackage->is_popular)
                                            <span
                                                class="text-xs bg-yellow-400 text-yellow-900 px-2 py-0.5 rounded-full font-semibold">
                                                ⭐ Populer
                                            </span>
                                        @endif
                                    </div>
                                    <div class="text-xs text-sky-100 mb-2 line-clamp-2">{{ $altPackage->description }}
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span
                                            class="text-lg font-bold">{{ format_currency($altPackage->base_price) }}</span>
                                        <span class="text-xs text-sky-200 group-hover:text-white transition-colors">
                                            Klik untuk pilih →
                                        </span>
                                    </div>
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endif

            <button wire:click="proceed" type="button" wire:loading.attr="disabled" @disabled($isProcessing)
                class="w-full font-bold py-4 rounded-2xl transition-all shadow-lg hover:shadow-xl disabled:opacity-50 disabled:cursor-not-allowed {{ $isProcessing ? 'bg-gray-300 text-gray-600' : 'bg-white hover:bg-gray-50 text-sky-600' }}">
                <span wire:loading.remove wire:target="proceed">
                    @if ($useLoyaltyPoint)
                        Konfirmasi Cuci Gratis 🎉
                    @else
                        Lanjutkan Pembayaran
                    @endif
                </span>
                <span wire:loading wire:target="proceed" class="flex items-center justify-center gap-2">
                    <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    Memproses...
                </span>
            </button>

            <!-- Info -->
            <div class="mt-6 bg-white/10 backdrop-blur rounded-2xl p-4">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-sky-100 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd" />
                    </svg>
                    <p class="text-sm text-sky-50 leading-relaxed">
                        Setiap pemesanan mendapatkan +1 poin loyalitas. Kumpulkan 10 poin untuk cuci gratis!
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
