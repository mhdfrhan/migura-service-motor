<div class="space-y-8">
    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-gradient-to-br from-sky-400 to-blue-500 rounded-3xl p-8 md:p-12">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-white/5 rounded-full -ml-48 -mb-48"></div>

        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-4">
                <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
                <h1 class="text-3xl md:text-4xl font-black text-white">Poin Loyalitas Anda</h1>
            </div>
            <p class="text-white/90 text-lg mb-6">Kumpulkan poin dan dapatkan cuci gratis!</p>

            <div class="bg-white/20 backdrop-blur-xl rounded-2xl p-6">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-white/80 font-medium">Poin Tersedia</span>
                    <span class="text-5xl font-black text-white">{{ $stats['current_points'] }}</span>
                </div>
                <p class="text-sm text-white/70">Gunakan 1 poin untuk 1x cuci gratis</p>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Total Cuci Selesai</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['total_completed'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg class="w-7 h-7 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Gratis Didapat</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['free_washes_earned'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 bg-purple-100 rounded-xl flex items-center justify-center">
                    <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Sisa untuk Gratis</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['remaining'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Progress Card -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-200 p-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Progress Loyalty Anda</h2>

        <div class="relative">
            <!-- Progress Bar -->
            <div class="h-8 bg-gray-100 rounded-full overflow-hidden mb-4">
                <div class="h-full bg-gradient-to-r from-sky-500 to-blue-600 rounded-full transition-all duration-500 flex items-center justify-end px-4"
                    style="width: {{ $loyaltyProgress['percentage'] }}%">
                    @if ($loyaltyProgress['percentage'] > 15)
                        <span
                            class="text-sm font-bold text-white">{{ number_format($loyaltyProgress['percentage'], 0) }}%</span>
                    @endif
                </div>
            </div>

            <!-- Progress Text -->
            <div class="flex items-center justify-between text-sm">
                <span class="font-semibold text-gray-700">
                    <span class="text-2xl text-sky-600">{{ $loyaltyProgress['current'] }}</span> /
                    {{ $loyaltyProgress['target'] }} cuci
                </span>
                <span class="text-gray-600">
                    {{ $stats['remaining'] }} cuci lagi untuk gratis! 🎉
                </span>
            </div>
        </div>

        <!-- Steps Visualization -->
        <div class="mt-8 grid grid-cols-5 md:grid-cols-10 gap-3">
            @for ($i = 1; $i <= $loyaltyProgress['target']; $i++)
                <div class="relative">
                    <div
                        class="w-full aspect-square rounded-xl {{ $i <= $loyaltyProgress['current'] ? 'bg-gradient-to-br from-sky-500 to-blue-600' : 'bg-gray-100' }} flex items-center justify-center transition-all duration-300">
                        @if ($i <= $loyaltyProgress['current'])
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        @else
                            <span class="text-sm font-bold text-gray-400">{{ $i }}</span>
                        @endif
                    </div>
                    @if ($i == $loyaltyProgress['target'])
                        <div class="absolute -top-3 -right-3">
                            <span
                                class="inline-flex items-center justify-center w-8 h-8 bg-yellow-400 rounded-full text-xl">🎁</span>
                        </div>
                    @endif
                </div>
            @endfor
        </div>

        <!-- CTA -->
        @if ($stats['current_points'] > 0)
            <div class="mt-8 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-2xl p-6 text-white">
                <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                    <div>
                        <h3 class="text-xl font-bold mb-1">Anda Punya {{ $stats['current_points'] }} Poin Gratis!</h3>
                        <p class="text-white/90">Gunakan sekarang saat booking untuk cuci gratis</p>
                    </div>
                    <a href="{{ route('booking.index') }}"
                        class="px-8 py-3 bg-white text-orange-600 font-bold rounded-xl hover:bg-gray-50 transition-colors whitespace-nowrap">
                        Booking Sekarang
                    </a>
                </div>
            </div>
        @endif
    </div>

    <!-- Transaction History -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-200 p-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Riwayat Transaksi Poin</h2>

        <div class="space-y-4">
            @forelse($transactions as $transaction)
                <div
                    class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-12 h-12 rounded-xl {{ $transaction->type === 'earned' ? 'bg-green-100' : ($transaction->type === 'redeemed' ? 'bg-red-100' : 'bg-blue-100') }} flex items-center justify-center">
                            @if ($transaction->type === 'earned')
                                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"
                                        clip-rule="evenodd" />
                                </svg>
                            @elseif($transaction->type === 'redeemed')
                                <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z"
                                        clip-rule="evenodd" />
                                </svg>
                            @else
                                <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            @endif
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">{{ $transaction->description }}</p>
                            <div class="flex items-center gap-2 text-sm text-gray-600 mt-1">
                                <span>{{ $transaction->created_at->format('d M Y, H:i') }}</span>
                                @if ($transaction->booking)
                                    <span>•</span>
                                    <span class="font-mono text-xs">{{ $transaction->booking->booking_code }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        @if ($transaction->type === 'progress')
                            <p class="text-sm font-semibold text-blue-600">Progress</p>
                        @else
                            <p
                                class="text-2xl font-bold {{ $transaction->type === 'earned' ? 'text-green-600' : 'text-red-600' }}">
                                {{ $transaction->points > 0 ? '+' : '' }}{{ $transaction->points }}
                            </p>
                        @endif
                        <p class="text-sm text-gray-500">Saldo: {{ $transaction->balance_after }}</p>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <p class="text-gray-500 font-medium">Belum ada transaksi poin</p>
                    <p class="text-sm text-gray-400 mt-1">Lakukan booking untuk mulai mengumpulkan poin!</p>
                </div>
            @endforelse
        </div>

        @if ($transactions->hasPages())
            <div class="mt-6 pt-6 border-t border-gray-200">
                {{ $transactions->links() }}
            </div>
        @endif
    </div>

    <!-- How It Works -->
    <div class="bg-gradient-to-br from-sky-50 to-blue-50 rounded-3xl p-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Cara Kerja Loyalty Program</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl p-6">
                <div
                    class="w-12 h-12 bg-sky-500 text-white rounded-xl flex items-center justify-center font-bold text-xl mb-4">
                    1</div>
                <h3 class="font-bold text-gray-900 mb-2">Lakukan Booking & Bayar</h3>
                <p class="text-sm text-gray-600">Setiap kali Anda menyelesaikan booking berbayar, progress loyalty Anda
                    bertambah +1</p>
            </div>
            <div class="bg-white rounded-2xl p-6">
                <div
                    class="w-12 h-12 bg-sky-500 text-white rounded-xl flex items-center justify-center font-bold text-xl mb-4">
                    2</div>
                <h3 class="font-bold text-gray-900 mb-2">Kumpulkan 10x Cuci</h3>
                <p class="text-sm text-gray-600">Setelah 10x cuci berbayar selesai, Anda otomatis mendapat 1 poin
                    gratis!</p>
            </div>
            <div class="bg-white rounded-2xl p-6">
                <div
                    class="w-12 h-12 bg-sky-500 text-white rounded-xl flex items-center justify-center font-bold text-xl mb-4">
                    3</div>
                <h3 class="font-bold text-gray-900 mb-2">Gunakan Poin Gratis</h3>
                <p class="text-sm text-gray-600">Centang "Gunakan Poin Loyalty" saat booking untuk cuci gratis tanpa
                    bayar!</p>
            </div>
        </div>
    </div>
</div>
