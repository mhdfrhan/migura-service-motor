<x-main-layout>
    <x-slot name="title">Pesan Cuci Motor</x-slot>

    <div class="min-h-screen bg-white py-12 pb-24">
        <x-container>
            <!-- Header -->
            <div class="mb-12">
                <a wire:navigate href="{{ route('home') }}"
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
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-4xl sm:text-5xl font-bold text-gray-900">Booking Motor</h1>
                        <p class="text-lg text-gray-600 mt-1">Pilih layanan dan jadwal yang Anda inginkan</p>
                    </div>
                </div>
            </div>

            @if (session('error'))
                <div class="mb-8 bg-red-50 border-2 border-red-200 text-red-800 px-6 py-4 rounded-3xl">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Livewire Component -->
            <livewire:booking-form />
        </x-container>
    </div>
</x-main-layout>
