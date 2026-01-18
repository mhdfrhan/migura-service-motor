<x-main-layout>
    <x-slot name="title">Promosi & Loyalitas</x-slot>

    <div class="min-h-screen bg-gradient-to-b from-sky-50 via-white to-white">
        <!-- Hero Section -->
        <section class="relative overflow-hidden py-16 md:py-24">
            <!-- Decorative Elements -->
            <div class="absolute inset-0 pointer-events-none">
                <div
                    class="absolute top-20 left-10 w-72 h-72 bg-sky-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20">
                </div>
                <div
                    class="absolute bottom-20 right-10 w-96 h-96 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20">
                </div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
                <div class="text-center mb-12">
                    <div
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-sky-500 to-blue-500 text-white rounded-full text-sm font-semibold mb-6 shadow-lg">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        Program Loyalitas Eksklusif
                    </div>

                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight">
                        <span class="bg-gradient-to-r from-sky-600 to-blue-600 bg-clip-text text-transparent">
                            Cuci 10x
                        </span>
                        <span class="text-gray-900">Gratis 1x</span>
                    </h1>
                    <p class="text-lg md:text-xl text-gray-600 mb-10 max-w-2xl mx-auto leading-relaxed">
                        Setiap 10 kali cuci motor, dapatkan <span class="font-semibold text-sky-600">1x cuci
                            gratis</span>.
                        Hemat lebih banyak dengan program loyalitas kami.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a wire:navigate href="{{ route('booking.index') }}"
                            class="group inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-sky-500 to-blue-500 text-white font-semibold rounded-xl hover:shadow-xl hover:scale-105 transition-all duration-200">
                            <span>Mulai Booking</span>
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Floating Icons -->
                <div class="flex justify-center gap-8 mt-16">
                    <div
                        class="w-16 h-16 bg-white rounded-2xl shadow-lg flex items-center justify-center transform rotate-6">
                        <span class="text-2xl">💧</span>
                    </div>
                    <div
                        class="w-16 h-16 bg-white rounded-2xl shadow-lg flex items-center justify-center transform -rotate-6">
                        <span class="text-2xl">🏍️</span>
                    </div>
                    <div
                        class="w-16 h-16 bg-white rounded-2xl shadow-lg flex items-center justify-center transform rotate-6">
                        <span class="text-2xl">✨</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Loyalty Progress Demo -->
        <section class="py-16 bg-white relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-4xl mx-auto">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                            Progres <span class="text-sky-500">Loyalitas</span> Anda
                        </h2>
                        <p class="text-gray-600">Setiap cuci motor dihitung sebagai 1 poin</p>
                    </div>

                    <div
                        class="bg-gradient-to-br from-sky-500 to-blue-600 rounded-3xl shadow-2xl p-8 md:p-12 relative overflow-hidden">
                        <!-- Decorative Pattern -->
                        <div class="absolute inset-0 opacity-10">
                            <div
                                class="absolute top-0 right-0 w-64 h-64 bg-white rounded-full -translate-y-1/2 translate-x-1/2">
                            </div>
                            <div
                                class="absolute bottom-0 left-0 w-48 h-48 bg-white rounded-full translate-y-1/2 -translate-x-1/2">
                            </div>
                        </div>

                        <div class="relative z-10">
                            <!-- Progress Bar -->
                            <div class="mb-8">
                                <div class="flex justify-between mb-4">
                                    <span class="text-sm font-semibold text-white">7 / 10 Cuci</span>
                                    <span class="text-sm font-semibold text-sky-100">🎉 3 lagi untuk reward!</span>
                                </div>
                                <div class="w-full bg-white/20 backdrop-blur-sm rounded-full h-4 overflow-hidden">
                                    <div class="bg-white h-4 rounded-full transition-all duration-500 shadow-lg"
                                        style="width: 70%">
                                    </div>
                                </div>
                            </div>

                            <!-- Water Drops Visual -->
                            <div class="flex justify-center items-center gap-4 flex-wrap mb-8">
                                @for ($i = 1; $i <= 10; $i++)
                                    <div class="relative group">
                                        <div
                                            class="w-12 h-12 rounded-full {{ $i <= 7 ? 'bg-white shadow-xl' : 'bg-white/20 backdrop-blur-sm' }} flex items-center justify-center transition-all duration-300 group-hover:scale-125 group-hover:rotate-12">
                                            @if ($i <= 7)
                                                <svg class="w-10 h-10 text-sky-500" viewBox="0 0 36 44" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M18.4125 32.5C18.7125 32.475 18.9688 32.3562 19.1813 32.1437C19.3938 31.9312 19.5 31.675 19.5 31.375C19.5 31.025 19.3875 30.7437 19.1625 30.5312C18.9375 30.3187 18.65 30.225 18.3 30.25C17.275 30.325 16.1875 30.0437 15.0375 29.4062C13.8875 28.7687 13.1625 27.6125 12.8625 25.9375C12.8125 25.6625 12.6813 25.4375 12.4688 25.2625C12.2563 25.0875 12.0125 25 11.7375 25C11.3875 25 11.1 25.1312 10.875 25.3937C10.65 25.6562 10.575 25.9625 10.65 26.3125C11.075 28.5875 12.075 30.2125 13.65 31.1875C15.225 32.1625 16.8125 32.6 18.4125 32.5ZM18 37C14.575 37 11.7188 35.825 9.43125 33.475C7.14375 31.125 6 28.2 6 24.7C6 22.2 6.99375 19.4812 8.98125 16.5437C10.9688 13.6062 13.975 10.425 18 7C22.025 10.425 25.0312 13.6062 27.0188 16.5437C29.0063 19.4812 30 22.2 30 24.7C30 28.2 28.8563 31.125 26.5688 33.475C24.2812 35.825 21.425 37 18 37ZM18 34C20.6 34 22.75 33.1187 24.45 31.3562C26.15 29.5937 27 27.375 27 24.7C27 22.875 26.2438 20.8125 24.7313 18.5125C23.2188 16.2125 20.975 13.7 18 10.975C15.025 13.7 12.7812 16.2125 11.2688 18.5125C9.75625 20.8125 9 22.875 9 24.7C9 27.375 9.85 29.5937 11.55 31.3562C13.25 33.1187 15.4 34 18 34Z"
                                                        fill="currentColor" />
                                                </svg>
                                            @else
                                                <span class="text-xs font-bold text-white/60">{{ $i }}</span>
                                            @endif
                                        </div>
                                        @if ($i === 10)
                                            <div class="absolute -top-8 left-1/2 -translate-x-1/2 whitespace-nowrap">
                                                <span class="text-2xl animate-bounce inline-block">🎁</span>
                                            </div>
                                        @endif
                                    </div>
                                @endfor
                            </div>

                            <!-- Reward Badge -->
                            <div
                                class="text-center p-6 bg-white/10 backdrop-blur-md rounded-2xl border border-white/20">
                                <div
                                    class="inline-flex items-center justify-center w-16 h-16 bg-white rounded-full mb-4 shadow-xl">
                                    <svg class="w-8 h-8 text-sky-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-white mb-2">Reward di Cuci ke-10</h3>
                                <p class="text-sky-100 text-lg font-semibold">1x Cuci Motor GRATIS 🎉</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- How It Works -->
        <section id="cara-kerja" class="py-16 bg-gradient-to-b from-gray-50 to-white relative overflow-hidden">
            <!-- Decorative Dots -->
            <div class="absolute top-10 left-10 w-20 h-20 opacity-30">
                <div class="grid grid-cols-3 gap-2">
                    @for ($i = 0; $i < 9; $i++)
                        <div class="w-2 h-2 bg-sky-300 rounded-full"></div>
                    @endfor
                </div>
            </div>
            <div class="absolute bottom-10 right-10 w-20 h-20 opacity-30">
                <div class="grid grid-cols-3 gap-2">
                    @for ($i = 0; $i < 9; $i++)
                        <div class="w-2 h-2 bg-blue-300 rounded-full"></div>
                    @endfor
                </div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                        Cara Kerja Program <span class="text-sky-500">Loyalitas</span>
                    </h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">Sistem loyalitas yang sederhana dan menguntungkan</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8 relative">
                    <!-- Connection Lines (Desktop) -->
                    <div
                        class="hidden md:block absolute top-20 left-1/4 right-1/4 h-1 bg-gradient-to-r from-sky-300 via-sky-400 to-sky-300">
                    </div>

                    <!-- Step 1 -->
                    <div class="group text-center">
                        <div class="relative inline-block mb-6">
                            <div
                                class="w-24 h-24 mx-auto bg-gradient-to-br from-sky-400 to-sky-600 rounded-3xl flex items-center justify-center shadow-xl transform group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <div
                                class="absolute -top-2 -right-2 w-8 h-8 bg-white rounded-full shadow-lg flex items-center justify-center text-sky-600 font-bold text-sm">
                                1
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Booking & Cuci</h3>
                        <p class="text-gray-600">Booking dan cuci motor melalui aplikasi dengan mudah</p>
                    </div>

                    <!-- Step 2 -->
                    <div class="group text-center">
                        <div class="relative inline-block mb-6">
                            <div
                                class="w-24 h-24 mx-auto bg-gradient-to-br from-sky-400 to-blue-600 rounded-3xl flex items-center justify-center shadow-xl transform group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div
                                class="absolute -top-2 -right-2 w-8 h-8 bg-white rounded-full shadow-lg flex items-center justify-center text-blue-600 font-bold text-sm">
                                2
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Kumpulkan Poin</h3>
                        <p class="text-gray-600">Setiap cuci otomatis mendapat 1 poin loyalitas</p>
                    </div>

                    <!-- Step 3 -->
                    <div class="group text-center">
                        <div class="relative inline-block mb-6">
                            <div
                                class="w-24 h-24 mx-auto bg-gradient-to-br from-blue-500 to-blue-700 rounded-3xl flex items-center justify-center shadow-xl transform group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                                <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </div>
                            <div
                                class="absolute -top-2 -right-2 w-8 h-8 bg-white rounded-full shadow-lg flex items-center justify-center text-blue-700 font-bold text-sm">
                                3
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Dapatkan Reward</h3>
                        <p class="text-gray-600">Tukar 10 poin dengan 1x cuci GRATIS</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Benefits Comparison -->
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                        Benefit Program <span class="text-sky-500">Loyalitas</span>
                    </h2>
                    <p class="text-gray-600">Pilihan reward yang bisa Anda dapatkan</p>
                </div>

                <div class="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                    <!-- Regular Service -->
                    <div
                        class="group relative bg-gradient-to-br from-sky-50 to-blue-50 rounded-3xl shadow-lg hover:shadow-2xl p-8 transition-all duration-300 border-2 border-sky-200 hover:border-sky-400">
                        <div class="absolute top-4 right-4">
                            <div class="w-8 h-8 bg-sky-500 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 mb-6">
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-sky-400 to-sky-600 rounded-2xl flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900">Datang ke Toko</h3>
                        </div>

                        <div class="space-y-4">
                            <div class="flex items-start gap-3">
                                <div
                                    class="w-6 h-6 bg-sky-500 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <p class="text-gray-700 font-medium">Cuci ke-10 = <span
                                        class="text-sky-600 font-bold">100% GRATIS</span></p>
                            </div>
                            <div class="flex items-start gap-3">
                                <div
                                    class="w-6 h-6 bg-sky-500 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <p class="text-gray-700 font-medium">Semua jenis paket tersedia</p>
                            </div>
                            <div class="flex items-start gap-3">
                                <div
                                    class="w-6 h-6 bg-sky-500 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <p class="text-gray-700 font-medium">Tidak ada biaya tambahan</p>
                            </div>
                        </div>
                    </div>

                    <!-- Antar-Jemput Motor -->
                    <div
                        class="group relative bg-gradient-to-br from-blue-50 to-sky-50 rounded-3xl shadow-lg hover:shadow-2xl p-8 transition-all duration-300 border-2 border-blue-200 hover:border-blue-400">
                        <div class="absolute top-4 right-4">
                            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 mb-6">
                            <div
                                class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900">Antar-Jemput Motor</h3>
                        </div>

                        <div class="space-y-4">
                            <div class="flex items-start gap-3">
                                <div
                                    class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <p class="text-gray-700 font-medium">Cuci <span
                                        class="text-blue-600 font-bold">GRATIS</span>, bayar biaya antar-jemput saja</p>
                            </div>
                            <div class="flex items-start gap-3">
                                <div
                                    class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <p class="text-gray-700 font-medium">Motor dijemput & diantar kembali</p>
                            </div>
                            <div class="flex items-start gap-3">
                                <div
                                    class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <p class="text-gray-700 font-medium">Hemat waktu & praktis</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-16 bg-gradient-to-b from-white to-sky-50 relative overflow-hidden">
            <!-- Decorative Background -->
            <div class="absolute inset-0 pointer-events-none">
                <div
                    class="absolute top-10 left-1/4 w-96 h-96 bg-sky-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20">
                </div>
                <div
                    class="absolute bottom-10 right-1/4 w-96 h-96 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20">
                </div>
            </div>

            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative">
                <div class="text-5xl mb-6">🎉</div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Siap Mulai Mengumpulkan <span class="text-sky-500">Poin?</span>
                </h2>
                <p class="text-lg text-gray-600 mb-10 max-w-2xl mx-auto">
                    Daftar sekarang dan mulai nikmati benefit program loyalitas kami
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a wire:navigate href="{{ route('booking.index') }}"
                        class="group inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-sky-500 to-blue-500 text-white font-semibold rounded-xl hover:shadow-xl hover:scale-105 transition-all duration-200">
                        <span>Booking Sekarang</span>
                        <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                    @guest
                        <a wire:navigate href="{{ route('register') }}"
                            class="inline-flex items-center justify-center px-8 py-4 bg-white border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:border-sky-500 hover:text-sky-600 hover:shadow-lg transition-all duration-200">
                            Daftar Member
                        </a>
                    @endguest
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-3 gap-6 mt-16 max-w-2xl mx-auto">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-sky-500 mb-1">10+</div>
                        <div class="text-sm text-gray-600">Paket Layanan</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-sky-500 mb-1">1000+</div>
                        <div class="text-sm text-gray-600">Member Aktif</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-sky-500 mb-1">4.9★</div>
                        <div class="text-sm text-gray-600">Rating Layanan</div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-main-layout>
