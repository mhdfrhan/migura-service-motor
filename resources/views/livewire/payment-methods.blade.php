<div class="min-h-screen bg-gradient-to-b from-gray-50 to-white py-8">
    <x-container>
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center gap-4 mb-4">
                <a wire:navigate href="{{ route('dashboard') }}"
                    class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-gray-100 transition-colors">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Metode Pembayaran</h1>
                    <p class="text-gray-600 mt-1">Informasi rekening dan e-wallet untuk pembayaran</p>
                </div>
            </div>
        </div>

        <div class="space-y-8">
            <!-- Bank Transfer Section -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-900">Bank Transfer</h2>
                </div>

                @if ($bankTransfers->count() > 0)
                    <div class="space-y-4">
                        @foreach ($bankTransfers as $bank)
                            <div class="bg-gray-50 rounded-xl p-5 hover:bg-gray-100 transition-colors">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 rounded-xl flex items-center justify-center"
                                            style="background-color: {{ $bank->icon_color }}">
                                            <span class="text-white font-bold text-sm">{{ $bank->code }}</span>
                                        </div>
                                        <div>
                                            <p class="font-bold text-gray-900">{{ $bank->name }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="space-y-2 pt-3 border-t border-gray-200">
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600">No. Rekening</span>
                                        <span
                                            class="font-bold text-gray-900 font-mono">{{ $bank->account_number }}</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600">Atas Nama</span>
                                        <span class="font-bold text-gray-900">{{ $bank->account_name }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 text-gray-500">
                        <p>Belum ada metode bank transfer tersedia.</p>
                    </div>
                @endif
            </div>

            <!-- E-Wallet Section -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-900">E-Wallet</h2>
                </div>

                @if ($eWallets->count() > 0)
                    <div class="space-y-4">
                        @foreach ($eWallets as $wallet)
                            <div class="bg-gray-50 rounded-xl p-5 hover:bg-gray-100 transition-colors">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 rounded-xl flex items-center justify-center"
                                            style="background-color: {{ $wallet->icon_color }}">
                                            <span class="text-white font-bold text-xs">{{ $wallet->code }}</span>
                                        </div>
                                        <div>
                                            <p class="font-bold text-gray-900">{{ $wallet->name }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="space-y-2 pt-3 border-t border-gray-200">
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600">No. Telepon</span>
                                        <span class="font-bold text-gray-900">{{ $wallet->account_number }}</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-600">Atas Nama</span>
                                        <span class="font-bold text-gray-900">{{ $wallet->account_name }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 text-gray-500">
                        <p>Belum ada metode e-wallet tersedia.</p>
                    </div>
                @endif
            </div>

            <!-- Info Banner -->
            <div class="bg-blue-50 border border-blue-200 rounded-2xl p-6">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-blue-900 mb-2">Cara Melakukan Pembayaran</h3>
                        <ol class="text-sm text-blue-800 space-y-1 list-decimal list-inside">
                            <li>Pilih metode pembayaran saat checkout</li>
                            <li>Transfer tepat sejumlah total pembayaran</li>
                            <li>Upload bukti transfer pada halaman konfirmasi</li>
                            <li>Tunggu verifikasi dari admin (1x24 jam)</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </x-container>
</div>
