@if ($recommendation && $recommendation['package'])
    <div class="bg-gradient-to-br from-purple-500 via-pink-500 to-red-500 rounded-3xl p-6 text-white shadow-2xl relative overflow-hidden"
        x-data="{ show: false }" x-init="setTimeout(() => show = true, 300)">

        <!-- Animated Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div
                class="absolute top-0 right-0 w-64 h-64 bg-white rounded-full blur-3xl transform translate-x-1/2 -translate-y-1/2">
            </div>
            <div
                class="absolute bottom-0 left-0 w-48 h-48 bg-white rounded-full blur-3xl transform -translate-x-1/2 translate-y-1/2">
            </div>
        </div>

        <!-- Content -->
        <div class="relative z-10">
            <!-- Header -->
            <div class="flex items-start justify-between mb-4">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <div class="w-10 h-10 bg-white/20 backdrop-blur-xl rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold">AI Rekomendasi Untuk Anda</h3>
                    </div>
                    <p class="text-sm opacity-90">Dipilih khusus berdasarkan riwayat Anda</p>
                </div>

                <!-- Confidence Badge -->
                <div class="bg-white/20 backdrop-blur-xl px-4 py-2 rounded-xl">
                    <p class="text-xs opacity-75 mb-0.5">Akurasi</p>
                    <p class="text-2xl font-bold">{{ $recommendation['confidence'] }}%</p>
                </div>
            </div>

            <!-- Package Info -->
            <div class="bg-white/10 backdrop-blur-xl rounded-2xl p-5 mb-4 border border-white/20">
                <div class="flex items-start justify-between mb-3">
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <h4 class="text-2xl font-bold">{{ $recommendation['package']->name }}</h4>
                            <span class="px-3 py-1 bg-yellow-400 text-yellow-900 text-xs font-bold rounded-full">
                                {{ $recommendation['badge'] }}
                            </span>
                        </div>
                        <p class="text-sm opacity-90 mb-3">{{ $recommendation['package']->description }}</p>
                    </div>
                </div>

                <!-- Price -->
                <div class="flex items-baseline gap-2 mb-4">
                    <span
                        class="text-3xl font-bold">{{ format_currency($recommendation['package']->base_price) }}</span>
                    <span class="text-sm opacity-75">mulai dari</span>
                </div>

                <!-- Reasons (Collapsible) -->
                <div class="space-y-2 mb-4">
                    @foreach (array_slice($recommendation['reasons'], 0, $showDetails ? count($recommendation['reasons']) : 2) as $reason)
                        <div class="flex items-start gap-2" x-show="show"
                            x-transition:enter="transition ease-out duration-300 delay-{{ $loop->index * 100 }}"
                            x-transition:enter-start="opacity-0 transform translate-x-4"
                            x-transition:enter-end="opacity-100 transform translate-x-0">
                            <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <p class="text-sm">{{ $reason }}</p>
                        </div>
                    @endforeach

                    @if (count($recommendation['reasons']) > 2)
                        <button wire:click="toggleDetails"
                            class="text-sm font-semibold hover:underline flex items-center gap-1">
                            {{ $showDetails ? 'Sembunyikan' : 'Lihat Semua Alasan' }}
                            <svg class="w-4 h-4 transition-transform {{ $showDetails ? 'rotate-180' : '' }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    @endif
                </div>

                <!-- Action Button -->
                <a wire:navigate href="{{ route('booking.index', ['package' => $recommendation['package']->id]) }}"
                    class="w-full py-4 bg-white text-purple-600 rounded-xl font-bold text-lg hover:bg-gray-100 transition-all transform hover:scale-[1.02] active:scale-[0.98] shadow-xl flex items-center justify-center gap-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    <span>Pesan Sekarang</span>
                </a>
            </div>

            <!-- AI Badge -->
            <div class="flex items-center justify-center gap-2 text-sm opacity-75">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M11 3a1 1 0 10-2 0v1a1 1 0 102 0V3zM15.657 5.757a1 1 0 00-1.414-1.414l-.707.707a1 1 0 001.414 1.414l.707-.707zM18 10a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zM5.05 6.464A1 1 0 106.464 5.05l-.707-.707a1 1 0 00-1.414 1.414l.707.707zM5 10a1 1 0 01-1 1H3a1 1 0 110-2h1a1 1 0 011 1zM8 16v-1h4v1a2 2 0 11-4 0zM12 14c.015-.34.208-.646.477-.859a4 4 0 10-4.954 0c.27.213.462.519.476.859h4.002z" />
                </svg>
                <span>Powered by AI • Dipilih khusus untuk Anda</span>
            </div>
        </div>
    </div>
@endif
