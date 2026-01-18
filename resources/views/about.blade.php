<x-main-layout>
    <x-slot name="title">Tentang Kami</x-slot>

    <div class="min-h-screen bg-white">
        <!-- Hero Section -->
        <section class="relative bg-gradient-to-br from-sky-500 to-blue-600 py-20 overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full -translate-y-1/2 translate-x-1/2">
                </div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-white rounded-full translate-y-1/2 -translate-x-1/2">
                </div>
            </div>

            <x-container>
                <div class="relative z-10 text-center text-white">
                    <div
                        class="inline-flex items-center gap-2 px-4 py-2 bg-white/20 backdrop-blur rounded-full text-sm font-medium mb-6">
                        <span class="w-2 h-2 bg-white rounded-full"></span>
                        Migura Wash Service
                    </div>
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-6">Tentang Kami</h1>
                    <p class="text-xl text-sky-50 max-w-3xl mx-auto leading-relaxed">
                        Layanan cuci motor modern dengan teknologi AI dan pengalaman pelanggan terbaik di kelasnya
                    </p>
                </div>
            </x-container>
        </section>

        <!-- Story Section -->
        <section class="py-20">
            <x-container>
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <div class="inline-block px-4 py-2 bg-sky-100 text-sky-700 rounded-full text-sm font-bold mb-6">
                            Cerita Kami
                        </div>
                        <h2 class="text-4xl font-bold text-gray-900 mb-6">
                            Transformasi Digital Layanan Cuci Motor
                        </h2>
                        <div class="space-y-4 text-lg text-gray-700 leading-relaxed">
                            <p>
                                <strong class="text-gray-900">Migura</strong> dimulai dari visi sederhana: membuat
                                perawatan sepeda motor menjadi lebih mudah, cepat, dan nyaman untuk semua orang.
                            </p>
                            <p>
                                Kami menggabungkan <strong class="text-sky-600">teknologi AI</strong> untuk prediksi
                                antrean, sistem booking online yang intuitif, dan layanan <strong class="text-sky-600">antar-jemput motor</strong> yang memudahkan Anda
                                untuk memberikan pengalaman terbaik.
                            </p>
                            <p>
                                Dengan tim profesional dan peralatan modern, kami berkomitmen memberikan hasil cuci
                                berkualitas tinggi dengan harga yang terjangkau.
                            </p>
                        </div>
                    </div>

                    <div class="relative">
                        <div
                            class="aspect-square rounded-[3rem] overflow-hidden bg-gradient-to-br from-sky-100 to-blue-100">
                            <img src="{{ asset('assets/img/hero-bike.jpg') }}" alt="Migura Service"
                                class="w-full h-full object-cover">
                        </div>
                        <!-- Stats Card -->
                        <div
                            class="absolute -bottom-6 -left-6 bg-white rounded-2xl shadow-xl p-6 border-2 border-gray-100">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-2xl font-bold text-gray-900">1000+</div>
                                    <div class="text-sm text-gray-600">Pelanggan Puas</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </x-container>
        </section>

        <!-- Values Section -->
        <section class="py-20 bg-gray-50">
            <x-container>
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">Nilai-Nilai Kami</h2>
                    <p class="text-lg text-gray-600">Prinsip yang memandu setiap layanan kami</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Value 1 -->
                    <div
                        class="bg-white rounded-3xl border-2 border-gray-200 p-8 text-center hover:border-sky-300 transition-colors">
                        <div class="w-16 h-16 bg-sky-500 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Kualitas Premium</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Menggunakan produk berkualitas tinggi dan teknik terbaik untuk hasil maksimal
                        </p>
                    </div>

                    <!-- Value 2 -->
                    <div
                        class="bg-white rounded-3xl border-2 border-gray-200 p-8 text-center hover:border-sky-300 transition-colors">
                        <div class="w-16 h-16 bg-green-500 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Efisien & Cepat</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Teknologi AI untuk prediksi waktu tunggu dan proses yang lebih efisien
                        </p>
                    </div>

                    <!-- Value 3 -->
                    <div
                        class="bg-white rounded-3xl border-2 border-gray-200 p-8 text-center hover:border-sky-300 transition-colors">
                        <div class="w-16 h-16 bg-purple-500 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Kepuasan Pelanggan</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Layanan ramah dan responsif untuk memastikan pengalaman terbaik Anda
                        </p>
                    </div>
                </div>
            </x-container>
        </section>

        <!-- Services Overview -->
        <section class="py-20">
            <x-container>
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">Layanan Unggulan</h2>
                    <p class="text-lg text-gray-600">Berbagai pilihan layanan untuk kebutuhan Anda</p>
                </div>

                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Service 1 -->
                    <div class="bg-gray-50 rounded-3xl border-2 border-gray-200 p-8">
                        <div class="flex items-start gap-6">
                            <div
                                class="w-14 h-14 bg-sky-500 rounded-2xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900 mb-3">Datang ke Toko</h3>
                                <p class="text-gray-700 mb-4 leading-relaxed">
                                    Kunjungi outlet kami dengan sistem booking online. Dapatkan prediksi waktu tunggu
                                    akurat dari AI kami.
                                </p>
                                <ul class="space-y-2">
                                    <li class="flex items-center gap-2 text-gray-700">
                                        <div class="w-1.5 h-1.5 bg-sky-500 rounded-full"></div>
                                        Tanpa antri lama
                                    </li>
                                    <li class="flex items-center gap-2 text-gray-700">
                                        <div class="w-1.5 h-1.5 bg-sky-500 rounded-full"></div>
                                        Fasilitas lengkap & nyaman
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Service 2 -->
                    <div class="bg-gray-50 rounded-3xl border-2 border-gray-200 p-8">
                        <div class="flex items-start gap-6">
                            <div
                                class="w-14 h-14 bg-blue-500 rounded-2xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-900 mb-3">Antar-Jemput Motor</h3>
                                <p class="text-gray-700 mb-4 leading-relaxed">
                                    Motor Anda dijemput dari rumah atau kantor, dicuci bersih di tempat kami, lalu diantar kembali ke lokasi Anda.
                                </p>
                                <ul class="space-y-2">
                                    <li class="flex items-center gap-2 text-gray-700">
                                        <div class="w-1.5 h-1.5 bg-blue-500 rounded-full"></div>
                                        Hemat waktu & praktis
                                    </li>
                                    <li class="flex items-center gap-2 text-gray-700">
                                        <div class="w-1.5 h-1.5 bg-blue-500 rounded-full"></div>
                                        Kualitas premium terjamin
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </x-container>
        </section>

        <!-- Team/Contact Section -->
        <section class="py-20 bg-gradient-to-br from-sky-50 to-blue-50">
            <x-container>
                <div class="max-w-4xl mx-auto text-center">
                    <div class="text-5xl mb-6">🤝</div>
                    <h2 class="text-4xl font-bold text-gray-900 mb-6">
                        Bergabunglah dengan Ribuan Pelanggan Puas
                    </h2>
                    <p class="text-xl text-gray-700 mb-10 leading-relaxed">
                        Rasakan sendiri pengalaman cuci motor modern dengan Migura. Booking sekarang dan dapatkan
                        poin loyalitas untuk reward spesial!
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a wire:navigate href="{{ route('booking.index') }}"
                            class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white font-bold rounded-2xl transition-all">
                            Mulai Booking Sekarang
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                        <a wire:navigate href="{{ route('chatbot') }}"
                            class="inline-flex items-center gap-2 px-8 py-4 bg-white hover:bg-gray-50 text-gray-900 font-bold rounded-2xl border-2 border-gray-200 transition-all">
                            Tanya AI Assistant
                        </a>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-8 mt-16 pt-16 border-t-2 border-gray-200">
                        <div>
                            <div class="text-4xl font-bold text-gray-900 mb-2">1000+</div>
                            <div class="text-gray-600">Pelanggan</div>
                        </div>
                        <div>
                            <div class="text-4xl font-bold text-gray-900 mb-2">5000+</div>
                            <div class="text-gray-600">Motor Dicuci</div>
                        </div>
                        <div>
                            <div class="text-4xl font-bold text-gray-900 mb-2">4.9★</div>
                            <div class="text-gray-600">Rating</div>
                        </div>
                    </div>
                </div>
            </x-container>
        </section>
    </div>
</x-main-layout>
