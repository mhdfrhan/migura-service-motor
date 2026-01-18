<div class="min-h-screen bg-white py-12 pb-24">
    <x-container>
        <!-- Header -->
        <div class="mb-12">
            <a wire:navigate href="{{ route('booking.index') }}"
                class="inline-flex items-center gap-2 text-gray-600 hover:text-gray-900 mb-6 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span class="font-medium">Kembali</span>
            </a>
            <div class="flex items-center gap-4 mb-4">
                <div
                    class="w-14 h-14 bg-gradient-to-br from-sky-500 to-blue-600 rounded-2xl flex items-center justify-center">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-4xl sm:text-5xl font-bold text-gray-900">Pembayaran</h1>
                    <p class="text-lg text-gray-600 mt-1">Selesaikan pembayaran Anda untuk melanjutkan.</p>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid lg:grid-cols-12 gap-8">
            <!-- Main Content (Left Side - 8 columns) -->
            <div class="lg:col-span-8 space-y-8">
                <!-- Pilih Metode Pembayaran -->
                <div class="bg-gray-50 rounded-3xl border-2 border-gray-200 p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div
                            class="w-10 h-10 bg-sky-500 rounded-xl flex items-center justify-center text-white font-bold text-lg">
                            1
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900">Pilih Metode Pembayaran</h2>
                    </div>

                    <!-- Info Banner -->
                    <div class="bg-blue-50 border border-blue-200 rounded-2xl p-4 mb-6">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <p class="text-sm font-semibold text-blue-900 mb-1">Pembayaran Manual</p>
                                <p class="text-sm text-blue-700">Transfer ke rekening yang tersedia, lalu unggah bukti
                                    pembayaran Anda untuk konfirmasi.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Methods -->
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Bank Transfer -->
                        <button wire:click="selectPaymentMethod('bank')" type="button"
                            class="flex flex-col items-center justify-center p-8 rounded-2xl border-2 transition-all duration-200 {{ $paymentMethod === 'bank' ? 'border-sky-500 bg-white shadow-lg ring-4 ring-sky-100' : 'bg-white border-gray-200 hover:border-sky-300' }}">
                            <svg class="w-14 h-14 mb-3 {{ $paymentMethod === 'bank' ? 'text-sky-600' : 'text-gray-400' }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                            </svg>
                            <span
                                class="font-bold text-base {{ $paymentMethod === 'bank' ? 'text-sky-600' : 'text-gray-700' }}">Bank
                                Transfer</span>
                            <span class="text-xs text-gray-500 mt-1">BCA, BNI, Mandiri</span>
                        </button>

                        <!-- E-Wallet -->
                        <button wire:click="selectPaymentMethod('wallet')" type="button"
                            class="flex flex-col items-center justify-center p-8 rounded-2xl border-2 transition-all duration-200 {{ $paymentMethod === 'wallet' ? 'border-sky-500 bg-white shadow-lg ring-4 ring-sky-100' : 'bg-white border-gray-200 hover:border-sky-300' }}">
                            <svg class="w-14 h-14 mb-3 {{ $paymentMethod === 'wallet' ? 'text-sky-600' : 'text-gray-400' }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                            <span
                                class="font-bold text-base {{ $paymentMethod === 'wallet' ? 'text-sky-600' : 'text-gray-700' }}">E-Wallet</span>
                            <span class="text-xs text-gray-500 mt-1">GoPay, OVO, DANA</span>
                        </button>
                    </div>
                </div>

                <!-- Payment Details -->
                @if ($paymentMethod)
                    <div class="bg-gray-50 rounded-3xl border-2 border-gray-200 p-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div
                                class="w-10 h-10 bg-sky-500 rounded-xl flex items-center justify-center text-white font-bold text-lg">
                                2
                            </div>
                            <h2 class="text-2xl font-bold text-gray-900">Detail Pembayaran</h2>
                        </div>

                        @if ($paymentMethod === 'bank')
                            <!-- Bank Transfer Options -->
                            <div class="space-y-4">
                                <!-- BCA -->
                                <div
                                    class="bg-white rounded-2xl border-2 border-gray-200 p-6 hover:border-blue-300 transition-colors">
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                                                <span class="text-white font-bold text-sm">BCA</span>
                                            </div>
                                            <div>
                                                <p class="font-bold text-gray-900">Bank BCA</p>
                                                <p class="text-sm text-gray-500">Bank Central Asia</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="space-y-2 pt-4 border-t border-gray-200">
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm text-gray-600">No. Rekening</span>
                                            <span class="font-bold text-gray-900">1234567890</span>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm text-gray-600">Atas Nama</span>
                                            <span class="font-bold text-gray-900">Migura Wash Service</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- BNI -->
                                <div
                                    class="bg-white rounded-2xl border-2 border-gray-200 p-6 hover:border-orange-300 transition-colors">
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-12 h-12 bg-orange-600 rounded-xl flex items-center justify-center">
                                                <span class="text-white font-bold text-sm">BNI</span>
                                            </div>
                                            <div>
                                                <p class="font-bold text-gray-900">Bank BNI</p>
                                                <p class="text-sm text-gray-500">Bank Negara Indonesia</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="space-y-2 pt-4 border-t border-gray-200">
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm text-gray-600">No. Rekening</span>
                                            <span class="font-bold text-gray-900">0987654321</span>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm text-gray-600">Atas Nama</span>
                                            <span class="font-bold text-gray-900">Migura Wash Service</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Mandiri -->
                                <div
                                    class="bg-white rounded-2xl border-2 border-gray-200 p-6 hover:border-yellow-300 transition-colors">
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-12 h-12 bg-yellow-500 rounded-xl flex items-center justify-center">
                                                <span class="text-white font-bold text-xs">Mandiri</span>
                                            </div>
                                            <div>
                                                <p class="font-bold text-gray-900">Bank Mandiri</p>
                                                <p class="text-sm text-gray-500">Bank Mandiri</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="space-y-2 pt-4 border-t border-gray-200">
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm text-gray-600">No. Rekening</span>
                                            <span class="font-bold text-gray-900">1122334455</span>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm text-gray-600">Atas Nama</span>
                                            <span class="font-bold text-gray-900">Migura Wash Service</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Important Note -->
                                <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4">
                                    <div class="flex items-start gap-3">
                                        <svg class="w-5 h-5 text-amber-600 flex-shrink-0 mt-0.5" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                        <div>
                                            <p class="text-sm font-semibold text-amber-900 mb-1">Penting!</p>
                                            <p class="text-sm text-amber-700">Transfer <strong>tepat sejumlah
                                                    Rp{{ number_format($this->getTotalPrice(), 0, ',', '.') }}</strong>
                                                untuk
                                                memudahkan verifikasi.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($paymentMethod === 'wallet')
                            <!-- E-Wallet Options -->
                            <div class="space-y-4">
                                <!-- GoPay -->
                                <div
                                    class="bg-white rounded-2xl border-2 border-gray-200 p-6 hover:border-green-300 transition-colors">
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-12 h-12 bg-green-600 rounded-xl flex items-center justify-center">
                                                <span class="text-white font-bold text-xs">GoPay</span>
                                            </div>
                                            <div>
                                                <p class="font-bold text-gray-900">GoPay</p>
                                                <p class="text-sm text-gray-500">Via aplikasi Gojek</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="space-y-2 pt-4 border-t border-gray-200">
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm text-gray-600">No. Telepon</span>
                                            <span class="font-bold text-gray-900">0812-3456-7890</span>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm text-gray-600">Atas Nama</span>
                                            <span class="font-bold text-gray-900">Migura Wash Service</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- OVO -->
                                <div
                                    class="bg-white rounded-2xl border-2 border-gray-200 p-6 hover:border-purple-300 transition-colors">
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-12 h-12 bg-purple-600 rounded-xl flex items-center justify-center">
                                                <span class="text-white font-bold text-sm">OVO</span>
                                            </div>
                                            <div>
                                                <p class="font-bold text-gray-900">OVO</p>
                                                <p class="text-sm text-gray-500">Via aplikasi OVO</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="space-y-2 pt-4 border-t border-gray-200">
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm text-gray-600">No. Telepon</span>
                                            <span class="font-bold text-gray-900">0812-3456-7890</span>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm text-gray-600">Atas Nama</span>
                                            <span class="font-bold text-gray-900">Migura Wash Service</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- DANA -->
                                <div
                                    class="bg-white rounded-2xl border-2 border-gray-200 p-6 hover:border-blue-300 transition-colors">
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center">
                                                <span class="text-white font-bold text-xs">DANA</span>
                                            </div>
                                            <div>
                                                <p class="font-bold text-gray-900">DANA</p>
                                                <p class="text-sm text-gray-500">Via aplikasi DANA</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="space-y-2 pt-4 border-t border-gray-200">
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm text-gray-600">No. Telepon</span>
                                            <span class="font-bold text-gray-900">0812-3456-7890</span>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm text-gray-600">Atas Nama</span>
                                            <span class="font-bold text-gray-900">Migura Wash Service</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Important Note -->
                                <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4">
                                    <div class="flex items-start gap-3">
                                        <svg class="w-5 h-5 text-amber-600 flex-shrink-0 mt-0.5" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                        <div>
                                            <p class="text-sm font-semibold text-amber-900 mb-1">Penting!</p>
                                            <p class="text-sm text-amber-700">Transfer <strong>tepat sejumlah
                                                    Rp{{ number_format($this->getTotalPrice(), 0, ',', '.') }}</strong>
                                                untuk
                                                memudahkan verifikasi.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif

                <!-- Upload Bukti Pembayaran -->
                @if ($paymentMethod)
                    <div class="bg-gray-50 rounded-3xl border-2 border-gray-200 p-8">
                        <div class="flex items-center gap-3 mb-6">
                            <div
                                class="w-10 h-10 bg-sky-500 rounded-xl flex items-center justify-center text-white font-bold text-lg">
                                3
                            </div>
                            <h2 class="text-2xl font-bold text-gray-900">Unggah Bukti Pembayaran</h2>
                        </div>

                        <div
                            class="bg-white border-2 border-dashed border-gray-300 rounded-2xl p-12 text-center hover:border-sky-400 hover:bg-sky-50/30 transition-all cursor-pointer group">
                            <input type="file" wire:model="paymentProof" class="hidden" id="payment-proof"
                                accept=".png,.jpg,.jpeg,.pdf">
                            <label for="payment-proof" class="cursor-pointer">
                                <div
                                    class="w-20 h-20 mx-auto mb-4 bg-gray-100 rounded-2xl flex items-center justify-center group-hover:bg-sky-100 transition-colors">
                                    <svg class="w-10 h-10 text-gray-400 group-hover:text-sky-500 transition-colors"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                </div>
                                <p class="text-gray-900 font-bold text-lg mb-2">Klik untuk unggah atau seret file ke
                                    sini
                                </p>
                                <p class="text-sm text-gray-500">PNG, JPG atau PDF (Maksimal 5MB)</p>
                                <p class="text-xs text-gray-400 mt-2">Pastikan bukti transfer terlihat jelas</p>
                            </label>
                        </div>

                        @if ($paymentProof)
                            <div class="mt-6 p-5 bg-green-50 border border-green-200 rounded-2xl">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 bg-green-500 rounded-xl flex items-center justify-center flex-shrink-0">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-bold text-green-900">File berhasil diunggah!</p>
                                        <p class="text-sm text-green-700">{{ $paymentProof->getClientOriginalName() }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Sidebar (Right Side - 4 columns) -->
            <div class="lg:col-span-4 space-y-5 sticky top-24 h-fit">
                <!-- Order Summary -->
                <div class="bg-gradient-to-br from-sky-500 to-blue-600 rounded-3xl p-8 text-white">
                    <h2 class="text-2xl font-bold mb-6">Ringkasan Pesanan</h2>

                    <div class="space-y-4 mb-6">
                        <div class="flex items-center gap-3 pb-3 border-b border-white/20">
                            <svg class="w-5 h-5 text-white flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                            </svg>
                            <div class="flex-1">
                                <p class="text-xs text-white/80">ID Booking</p>
                                <p class="font-bold">{{ $bookingId }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 pb-3 border-b border-white/20">
                            <svg class="w-5 h-5 text-white flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            <div class="flex-1">
                                <p class="text-xs text-white/80">Layanan</p>
                                <p class="font-bold">{{ $service }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 pb-3 border-b border-white/20">
                            <svg class="w-5 h-5 text-white flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <div class="flex-1">
                                <p class="text-xs text-white/80">Jadwal</p>
                                <p class="font-bold">{{ $datetime }}</p>
                            </div>
                        </div>

                        <div class="flex justify-between items-center pb-3 border-b border-white/20">
                            <span class="text-white/90">Harga Dasar</span>
                            <span class="font-bold">Rp{{ number_format($basePrice, 0, ',', '.') }}</span>
                        </div>

                        <div class="flex justify-between items-center">
                            <span class="text-white/90">Biaya Layanan</span>
                            <span class="font-bold">Rp{{ number_format($serviceFee, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-white/30">
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-bold">Total</span>
                            <span
                                class="text-4xl font-bold">Rp{{ number_format($this->getTotalPrice(), 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Action Button -->
                <button wire:click="confirmPayment" type="button" @if (!$paymentMethod || !$paymentProof) disabled @endif
                    class="w-full px-6 py-4 font-bold rounded-2xl shadow-lg transition-all
                    {{ !$paymentMethod || !$paymentProof ? 'bg-gray-300 text-gray-500 cursor-not-allowed' : 'bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white hover:shadow-xl' }}">
                    <span class="flex items-center justify-center gap-2">
                        @if (!$paymentMethod || !$paymentProof)
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            Lengkapi Pembayaran
                        @else
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Konfirmasi Pembayaran
                        @endif
                    </span>
                </button>

                @if (!$paymentMethod || !$paymentProof)
                    <p class="text-center text-sm text-gray-500">
                        @if (!$paymentMethod)
                            Pilih metode pembayaran terlebih dahulu
                        @elseif (!$paymentProof)
                            Unggah bukti pembayaran untuk melanjutkan
                        @endif
                    </p>
                @endif

                <!-- Security Info -->
                <div
                    class="bg-gradient-to-br from-green-500 to-emerald-600 backdrop-blur-md rounded-2xl border border-white/20 p-4 text-center text-white">
                    <div class="flex items-center justify-center gap-2 mb-2">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <span class="font-bold">Pembayaran Aman</span>
                    </div>
                    <p class="text-xs text-white">Transaksi Anda dilindungi dengan enkripsi SSL</p>
                </div>
            </div>
        </div>
    </x-container>
</div>
