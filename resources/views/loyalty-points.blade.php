<x-main-layout>
    <x-slot name="title">Poin Loyalitas</x-slot>
    <x-container>
        <livewire:loyalty-points />
    </x-container>
{{-- 
    @php
        $currentPoints = 7;
        $pointsToReward = 10;
        $progressPercentage = ($currentPoints / $pointsToReward) * 100;
        
        $pointsHistory = [
            [
                'type' => 'earned',
                'amount' => 1,
                'description' => 'Cuci motor - Regular Wash',
                'date' => '2026-01-10',
                'order_id' => 'ORD-2026-005',
            ],
            [
                'type' => 'earned',
                'amount' => 1,
                'description' => 'Cuci motor - Premium Wash & Wax',
                'date' => '2026-01-08',
                'order_id' => 'ORD-2026-004',
            ],
            [
                'type' => 'earned',
                'amount' => 1,
                'description' => 'Cuci motor - Regular Wash',
                'date' => '2026-01-05',
                'order_id' => 'ORD-2026-003',
            ],
            [
                'type' => 'redeemed',
                'amount' => -10,
                'description' => 'Tukar poin - 1x Cuci Gratis',
                'date' => '2026-01-03',
                'reward' => 'Free Regular Wash',
            ],
            [
                'type' => 'earned',
                'amount' => 1,
                'description' => 'Cuci motor - Regular Wash',
                'date' => '2026-01-02',
                'order_id' => 'ORD-2026-002',
            ],
        ];
    @endphp

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
                <div class="flex items-center gap-4">
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-sky-500 to-blue-600 rounded-2xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-4xl sm:text-5xl font-bold text-gray-900">Poin Loyalitas</h1>
                        <p class="text-lg text-gray-600 mt-1">Kumpulkan poin untuk reward spesial</p>
                    </div>
                </div>
            </div>

            <!-- Main Grid -->
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Main Content - 2 cols -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Progress Card -->
                    <div class="bg-gradient-to-br from-sky-500 to-blue-600 rounded-3xl p-8 text-white">
                        <div class="mb-6">
                            <p class="text-sky-100 mb-2">Total Poin Anda</p>
                            <div class="flex items-end gap-3">
                                <h2 class="text-6xl font-bold">{{ $currentPoints }}</h2>
                                <span class="text-2xl text-sky-100 mb-2">/ {{ $pointsToReward }}</span>
                            </div>
                        </div>

                        <!-- Progress Bar -->
                        <div class="mb-6">
                            <div class="flex justify-between text-sm text-sky-100 mb-2">
                                <span>Progress</span>
                                <span class="font-bold">{{ $pointsToReward - $currentPoints }} lagi!</span>
                            </div>
                            <div class="w-full bg-white/20 backdrop-blur-sm rounded-full h-3 overflow-hidden">
                                <div class="bg-white h-3 rounded-full transition-all duration-500"
                                    style="width: {{ $progressPercentage }}%">
                                </div>
                            </div>
                        </div>

                        <!-- Water Drops -->
                        <div class="grid grid-cols-5 gap-3 mb-6">
                            @for ($i = 1; $i <= 10; $i++)
                                <div class="flex justify-center">
                                    <div
                                        class="w-12 h-12 rounded-xl {{ $i <= $currentPoints ? 'bg-white shadow-xl' : 'bg-white/10 backdrop-blur-sm' }} flex items-center justify-center transition-all hover:scale-110">
                                        @if ($i <= $currentPoints)
                                            <svg class="w-7 h-7 text-sky-500" viewBox="0 0 36 44" fill="none">
                                                <path
                                                    d="M18.4125 32.5C18.7125 32.475 18.9688 32.3562 19.1813 32.1437C19.3938 31.9312 19.5 31.675 19.5 31.375C19.5 31.025 19.3875 30.7437 19.1625 30.5312C18.9375 30.3187 18.65 30.225 18.3 30.25C17.275 30.325 16.1875 30.0437 15.0375 29.4062C13.8875 28.7687 13.1625 27.6125 12.8625 25.9375C12.8125 25.6625 12.6813 25.4375 12.4688 25.2625C12.2563 25.0875 12.0125 25 11.7375 25C11.3875 25 11.1 25.1312 10.875 25.3937C10.65 25.6562 10.575 25.9625 10.65 26.3125C11.075 28.5875 12.075 30.2125 13.65 31.1875C15.225 32.1625 16.8125 32.6 18.4125 32.5ZM18 37C14.575 37 11.7188 35.825 9.43125 33.475C7.14375 31.125 6 28.2 6 24.7C6 22.2 6.99375 19.4812 8.98125 16.5437C10.9688 13.6062 13.975 10.425 18 7C22.025 10.425 25.0312 13.6062 27.0188 16.5437C29.0063 19.4812 30 22.2 30 24.7C30 28.2 28.8563 31.125 26.5688 33.475C24.2812 35.825 21.425 37 18 37ZM18 34C20.6 34 22.75 33.1187 24.45 31.3562C26.15 29.5937 27 27.375 27 24.7C27 22.875 26.2438 20.8125 24.7313 18.5125C23.2188 16.2125 20.975 13.7 18 10.975C15.025 13.7 12.7812 16.2125 11.2688 18.5125C9.75625 20.8125 9 22.875 9 24.7C9 27.375 9.85 29.5937 11.55 31.3562C13.25 33.1187 15.4 34 18 34Z"
                                                    fill="currentColor" />
                                            </svg>
                                        @else
                                            <span class="text-xs font-bold text-white/50">{{ $i }}</span>
                                        @endif
                                    </div>
                                </div>
                            @endfor
                        </div>

                        <!-- Reward Info -->
                        <div class="bg-white/10 backdrop-blur-md rounded-2xl border border-white/20 p-6 text-center">
                            <div class="text-4xl mb-3">🎁</div>
                            <p class="text-xl font-bold mb-1">Reward Cuci Ke-10</p>
                            <p class="text-sky-100">1x Cuci Motor GRATIS</p>
                        </div>
                    </div>

                    <!-- Transaction History -->
                    <div class="bg-gray-50 rounded-3xl border-2 border-gray-200 p-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Riwayat Transaksi</h2>

                        @if (count($pointsHistory) > 0)
                            <div class="space-y-3">
                                @foreach ($pointsHistory as $transaction)
                                    <div
                                        class="bg-white rounded-2xl border border-gray-200 p-6 hover:border-gray-300 transition-colors">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-4 flex-1">
                                                @if ($transaction['type'] === 'earned')
                                                    <div
                                                        class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                                        <svg class="w-6 h-6 text-green-600" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M12 4v16m8-8H4" />
                                                        </svg>
                                                    </div>
                                                @else
                                                    <div
                                                        class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                                        <svg class="w-6 h-6 text-yellow-600" fill="currentColor"
                                                            viewBox="0 0 20 20">
                                                            <path
                                                                d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                                                            <path fill-rule="evenodd"
                                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </div>
                                                @endif

                                                <div class="flex-1 min-w-0">
                                                    <p class="font-bold text-gray-900 truncate">
                                                        {{ $transaction['description'] }}</p>
                                                    <p class="text-sm text-gray-500">
                                                        @if (isset($transaction['order_id']))
                                                            {{ $transaction['order_id'] }} •
                                                        @endif
                                                        {{ \Carbon\Carbon::parse($transaction['date'])->format('d M Y') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="text-right ml-4">
                                                <span
                                                    class="text-xl font-bold {{ $transaction['type'] === 'earned' ? 'text-green-600' : 'text-yellow-600' }}">
                                                    {{ $transaction['amount'] > 0 ? '+' : '' }}{{ $transaction['amount'] }}
                                                </span>
                                                <p class="text-xs text-gray-500">poin</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-12">
                                <div class="text-6xl mb-4">💎</div>
                                <p class="text-gray-600 mb-6">Belum ada transaksi poin</p>
                                <a wire:navigate href="{{ route('booking.index') }}"
                                    class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white font-bold rounded-2xl transition-all">
                                    Mulai Kumpulkan Poin
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Sidebar - 1 col -->
                <div class="space-y-8">
                    <!-- Cara Dapat Poin -->
                    <div class="bg-gray-50 rounded-3xl border-2 border-gray-200 p-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Cara Dapat Poin</h3>
                        <div class="space-y-4">
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900 mb-1">Setiap Cuci Motor</p>
                                    <p class="text-sm text-gray-600">+1 poin per transaksi</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div
                                    class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900 mb-1">Home Service</p>
                                    <p class="text-sm text-gray-600">Tetap dapat +1 poin</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div
                                    class="w-12 h-12 bg-purple-500 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900 mb-1">Semua Paket</p>
                                    <p class="text-sm text-gray-600">Regular, Premium, Coating</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tukar Poin -->
                    <div class="bg-gradient-to-br from-yellow-50 to-orange-50 rounded-3xl border-2 border-yellow-200 p-8">
                        <div class="text-4xl mb-4 text-center">🎁</div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4 text-center">Tukar Poin</h3>
                        <div class="text-center mb-6">
                            <p class="text-3xl font-bold text-gray-900 mb-1">10 Poin</p>
                            <p class="text-gray-600">= 1x Cuci Motor Gratis</p>
                        </div>

                        <button
                            class="w-full px-6 py-4 font-bold rounded-2xl transition-all {{ $currentPoints >= $pointsToReward ? 'bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white' : 'bg-gray-200 text-gray-500 cursor-not-allowed' }}"
                            {{ $currentPoints < $pointsToReward ? 'disabled' : '' }}>
                            @if ($currentPoints >= $pointsToReward)
                                Klaim Sekarang! 🎉
                            @else
                                Butuh {{ $pointsToReward - $currentPoints }} Poin Lagi
                            @endif
                        </button>

                        <p class="text-xs text-gray-600 mt-4 text-center">*Untuk Home Service, hanya biaya kunjungan
                            yang dikenakan</p>
                    </div>

                    <!-- Info Banner -->
                    <div class="bg-gradient-to-r from-sky-50 to-blue-50 rounded-2xl border-2 border-sky-200 p-6">
                        <div class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-sky-600 flex-shrink-0 mt-0.5" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                    clip-rule="evenodd" />
                            </svg>
                            <div class="text-sm text-gray-700 leading-relaxed">
                                <p class="font-bold mb-2">Ketentuan Program:</p>
                                <ul class="space-y-1 text-xs">
                                    <li>• Poin tidak ada masa kadaluarsa</li>
                                    <li>• Poin otomatis masuk setelah pembayaran</li>
                                    <li>• Reward tidak dapat diuangkan</li>
                                    <li>• Max 1 reward per transaksi</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </x-container>
    </div> --}}
</x-main-layout>
