<x-main-layout>
    <x-slot name="title">Beri Ulasan</x-slot>

    @php
        $order = [
            'id' => 'ORD-2026-002',
            'package' => 'Regular Wash',
            'date' => '10 Januari 2026',
        ];
    @endphp

    <div class="min-h-screen bg-white pb-20" x-data="{ rating: 0 }">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Header -->
            <div class="flex items-center gap-4 mb-8">
                <a wire:navigate href="{{ route('booking.show', $order['id']) }}"
                    class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Beri Ulasan</h1>
            </div>

            <!-- Order Info -->
            <div class="mb-8 pb-6 border-b border-gray-200">
                <p class="text-sm text-gray-500 mb-1">{{ $order['id'] }}</p>
                <h2 class="text-lg font-semibold text-gray-900 mb-1">{{ $order['package'] }}</h2>
                <p class="text-sm text-gray-600">{{ $order['date'] }}</p>
            </div>

            <!-- Rating Section -->
            <div class="mb-8">
                <label class="block text-sm font-semibold text-gray-900 mb-4">Berikan Rating</label>
                <div class="flex items-center gap-3">
                    <template x-for="star in 5" :key="star">
                        <button @click="rating = star" type="button"
                            class="focus:outline-none transition-transform hover:scale-110">
                            <svg :class="star <= rating ? 'text-yellow-400 fill-yellow-400' : 'text-gray-300'"
                                class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                        </button>
                    </template>
                </div>
                <p class="text-sm text-gray-500 mt-2" x-show="rating > 0" x-cloak>
                    <span x-text="rating === 5 ? 'Sangat Puas' : rating === 4 ? 'Puas' : rating === 3 ? 'Cukup' : rating === 2 ? 'Kurang' : 'Sangat Kurang'"></span>
                </p>
            </div>

            <!-- Review Form -->
            <div class="space-y-6">
                <!-- Service Quality -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-3">Kualitas Layanan</label>
                    <textarea rows="4"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-sky-500"
                        placeholder="Ceritakan pengalaman Anda dengan layanan kami..."></textarea>
                </div>

                <!-- Photos (Optional) -->
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-3">Foto (Opsional)</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-gray-400 transition-colors cursor-pointer">
                        <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <p class="text-sm text-gray-600 mb-1">Upload foto hasil cucian</p>
                        <p class="text-xs text-gray-500">PNG, JPG hingga 5MB</p>
                    </div>
                </div>

                <!-- Tips -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-xs text-gray-500 mb-2">💡 Tips menulis ulasan yang baik:</p>
                    <ul class="text-xs text-gray-600 space-y-1 list-disc list-inside">
                        <li>Jelaskan apa yang Anda sukai dari layanan kami</li>
                        <li>Berikan detail spesifik tentang pengalaman Anda</li>
                        <li>Sertakan foto hasil cucian untuk membantu orang lain</li>
                    </ul>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-8 space-y-3">
                <button
                    class="w-full px-6 py-3 bg-sky-500 text-white font-semibold rounded-lg hover:bg-sky-600 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                    :disabled="rating === 0">
                    Kirim Ulasan
                </button>
                <a wire:navigate href="{{ route('my-orders') }}"
                    class="block w-full px-6 py-3 text-center text-gray-700 font-medium hover:text-gray-900 transition-colors">
                    Lewati
                </a>
            </div>
        </div>
    </div>
</x-main-layout>

