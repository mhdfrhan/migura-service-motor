<x-main-layout>
    <x-slot name="title">Beranda</x-slot>

    <!-- Hero Section - Modern Asymmetric Layout -->
    <section class="relative bg-white overflow-hidden">
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-50 rounded-full filter blur-3xl opacity-50"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-12 gap-8 lg:gap-12 py-12 lg:py-20 items-center">
                <!-- Content - 7 cols -->
                <div class="lg:col-span-7 space-y-8">
                    <div
                        class="inline-flex items-center gap-2 px-4 py-2 bg-sky-500 text-white rounded-full text-sm font-medium">
                        <span class="w-2 h-2 bg-white rounded-full"></span>
                        Online Booking System
                    </div>

                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold text-gray-900 leading-[1.1]">
                        Cuci Motor<br>
                        <span class="text-sky-500">Antar-Jemput</span><br>
                        Tanpa Ribet
                    </h1>

                    <p class="text-xl text-gray-600 leading-relaxed max-w-xl">
                        Motor Anda dijemput, dicuci bersih di tempat kami, lalu diantar kembali. Mudah, cepat, dan tanpa antri!
                    </p>

                    <div class="flex flex-wrap gap-4">
                        <a wire:navigate href="{{ route('booking.index') }}"
                            class="inline-flex items-center gap-2 px-8 py-4 bg-sky-500 hover:bg-sky-600 text-white font-semibold rounded-2xl">
                            Mulai Booking
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                        <a wire:navigate href="{{ route('promo.loyalty') }}"
                            class="inline-flex items-center gap-2 px-8 py-4 bg-white hover:bg-gray-50 text-gray-900 font-semibold rounded-2xl border-2 border-gray-200">
                            Lihat Promo
                        </a>
                    </div>

                    <!-- Quick Stats -->
                    <div class="flex flex-wrap gap-8 pt-4">
                        <div>
                            <div class="text-3xl font-bold text-gray-900">4.9★</div>
                            <div class="text-sm text-gray-600">Rating</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-gray-900">1000+</div>
                            <div class="text-sm text-gray-600">Pelanggan</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-gray-900">24/7</div>
                            <div class="text-sm text-gray-600">Support</div>
                        </div>
                    </div>
                </div>

                <!-- Image - 5 cols -->
                <div class="lg:col-span-5">
                    <div class="relative">
                        <div
                            class="aspect-square rounded-[3rem] overflow-hidden bg-gradient-to-br from-sky-100 to-blue-100">
                            <img src="{{ asset('assets/img/hero-bike.jpg') }}" alt="Cuci Motor"
                                class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Bento Grid -->
    <section class="bg-gradient-to-b from-gray-50 to-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-4">
                    Kenapa <span class="text-sky-500">Migura</span>?
                </h2>
                <p class="text-lg text-gray-600">Teknologi modern untuk pengalaman terbaik</p>
            </div>

            <!-- Bento Grid -->
            <div class="grid md:grid-cols-3 gap-6">
                <!-- Large Card - Spans 2 cols -->
                <div class="md:col-span-2 bg-gradient-to-br from-sky-500 to-blue-600 rounded-3xl p-8 text-white">
                    <div class="max-w-md">
                        <div
                            class="w-14 h-14 bg-white/20 backdrop-blur rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z" />
                                <path
                                    d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold mb-3">AI Chatbot 24/7</h3>
                        <p class="text-sky-50 leading-relaxed">Dapatkan jawaban instan untuk semua pertanyaan Anda,
                            kapan saja tanpa batas waktu.</p>
                    </div>
                </div>

                <!-- Regular Card -->
                <div class="bg-white rounded-3xl p-8 border border-gray-200 hover:border-sky-200">
                    <div class="w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Online Booking</h3>
                    <p class="text-gray-600">Pesan kapan saja, di mana saja melalui web</p>
                </div>

                <!-- Regular Card -->
                <div class="bg-white rounded-3xl p-8 border border-gray-200 hover:border-sky-200">
                    <div class="w-14 h-14 bg-purple-100 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Prediksi Antrian</h3>
                    <p class="text-gray-600">AI memprediksi waktu tunggu Anda</p>
                </div>

                <!-- Large Card - Spans 2 cols -->
                <div class="bg-white rounded-3xl p-8 border border-gray-200 hover:border-sky-200">
                    <div class="flex items-start gap-6">
                        <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3">Antar-Jemput Motor</h3>
                            <p class="text-gray-600 mb-4">Motor Anda dijemput dari rumah atau kantor, dicuci bersih di tempat kami, lalu diantar kembali ke lokasi Anda</p>
                            <a wire:navigate href="{{ route('home-service') }}"
                                class="inline-flex items-center gap-2 text-sky-600 font-semibold hover:gap-3 transition-all">
                                Cek Layanan
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Regular Card -->
                <div class="bg-white rounded-3xl p-8 border border-gray-200 hover:border-sky-200">
                    <div class="w-14 h-14 bg-yellow-100 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Digital Payment</h3>
                    <p class="text-gray-600">QRIS, Transfer, E-Wallet</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services / Pricing -->
    <section class="bg-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-4">Paket Layanan</h2>
                <p class="text-lg text-gray-600">Pilih paket sesuai kebutuhan motor Anda</p>
            </div>

            <div class="grid md:grid-cols-3 gap-6 max-w-6xl mx-auto">
                @forelse($packages as $index => $package)
                    @php
                        // Alternate design for visual interest
                        $isPopular = $package->is_popular;
                        $cardClass = $isPopular 
                            ? 'relative bg-gradient-to-br from-sky-500 to-blue-600 text-white' 
                            : 'bg-gray-50 border-2 border-gray-200 hover:border-sky-500 transition-colors';
                    @endphp
                    
                    <div class="rounded-3xl p-8 {{ $cardClass }}">
                        @if($isPopular)
                            <div class="absolute top-6 right-6">
                                <span class="px-3 py-1 bg-white/20 backdrop-blur text-white text-sm font-semibold rounded-full">
                                    Popular
                                </span>
                            </div>
                        @endif
                        
                        <div class="mb-6">
                            <h3 class="text-2xl font-bold {{ $isPopular ? 'text-white' : 'text-gray-900' }} mb-2">
                                {{ $package->name }}
                            </h3>
                            <div class="flex items-end gap-2">
                                <span class="text-4xl font-bold {{ $isPopular ? 'text-white' : 'text-gray-900' }}">
                                    {{ number_format($package->base_price / 1000, 0) }}K
                                </span>
                                <span class="{{ $isPopular ? 'text-sky-100' : 'text-gray-600' }} mb-1">/ cuci</span>
                            </div>
                        </div>
                        
                        @if($package->features && count($package->features) > 0)
                            <ul class="space-y-3 mb-8">
                                @foreach(array_slice($package->features, 0, 3) as $feature)
                                    <li class="flex items-start gap-3">
                                        <svg class="w-6 h-6 {{ $isPopular ? 'text-white' : 'text-green-500' }} flex-shrink-0" 
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="{{ $isPopular ? 'text-sky-50' : 'text-gray-700' }}">{{ $feature }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="{{ $isPopular ? 'text-sky-50' : 'text-gray-600' }} mb-8">{{ $package->description }}</p>
                        @endif
                        
                        <a wire:navigate href="{{ route('booking.index') }}"
                            class="block w-full px-6 py-3 {{ $isPopular ? 'bg-white hover:bg-gray-50 text-sky-600' : 'bg-gray-900 hover:bg-gray-800 text-white' }} font-semibold text-center rounded-xl transition-colors">
                            Pilih Paket
                        </a>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12">
                        <p class="text-gray-500">Paket layanan sedang diperbarui.</p>
                    </div>
                @endforelse
            </div>

            <!-- Loyalty CTA -->
            <div class="mt-12">
                <div class="bg-gradient-to-r from-sky-50 to-blue-50 rounded-3xl p-8 border border-sky-200 text-center">
                    <div class="text-4xl mb-4">🎁</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Cuci 10x Gratis 1x</h3>
                    <p class="text-gray-600 mb-6">Dapatkan 1 poin setiap cuci, tukar 10 poin dengan 1x cuci gratis
                    </p>
                    <a wire:navigate href="{{ route('promo.loyalty') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-sky-500 hover:bg-sky-600 text-white font-semibold rounded-xl">
                        Pelajari Lebih Lanjut
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="bg-gray-50 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-4">Kata Mereka</h2>
                <p class="text-lg text-gray-600">Testimoni dari pelanggan setia kami</p>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                <!-- Testimonial 1 -->
                <div class="bg-white rounded-3xl p-8 border border-gray-200">
                    <div class="flex items-center gap-1 mb-4">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <p class="text-gray-700 mb-6 leading-relaxed">"Prediksi antrean AI-nya akurat banget! Motor saya
                        langsung bersih tanpa ngantri lama."</p>
                    <div class="flex items-center gap-3">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-sky-400 to-blue-500 rounded-full flex items-center justify-center text-white font-bold">
                            W
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900">Wahyu Abrar</div>
                            <div class="text-sm text-gray-500">Pelanggan Setia</div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-white rounded-3xl p-8 border border-gray-200">
                    <div class="flex items-center gap-1 mb-4">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <p class="text-gray-700 mb-6 leading-relaxed">"Booking online dan bayar pakai QRIS super praktis.
                        Hasilnya juga memuaskan!"</p>
                    <div class="flex items-center gap-3">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-green-400 to-emerald-500 rounded-full flex items-center justify-center text-white font-bold">
                            H
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900">Hafiz Arifin</div>
                            <div class="text-sm text-gray-500">Member Premium</div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-white rounded-3xl p-8 border border-gray-200">
                    <div class="flex items-center gap-1 mb-4">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <p class="text-gray-700 mb-6 leading-relaxed">"Home service-nya luar biasa! Teknisi datang ke rumah
                        dan motor langsung kinclong."</p>
                    <div class="flex items-center gap-3">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-purple-400 to-pink-500 rounded-full flex items-center justify-center text-white font-bold">
                            G
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900">M. Gilang</div>
                            <div class="text-sm text-gray-500">Home Service User</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-white py-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="text-5xl mb-6">🚀</div>
            <h2 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-6">
                Siap untuk Motor<br>yang Lebih Bersih?
            </h2>
            <p class="text-xl text-gray-600 mb-10 max-w-2xl mx-auto">
                Booking sekarang dan rasakan pengalaman cuci motor modern dengan teknologi AI
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a wire:navigate href="{{ route('booking.index') }}"
                    class="inline-flex items-center gap-2 px-8 py-4 bg-sky-500 hover:bg-sky-600 text-white font-semibold rounded-2xl text-lg">
                    Mulai Booking Sekarang
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
                <a wire:navigate href="{{ route('chatbot') }}"
                    class="inline-flex items-center gap-2 px-8 py-4 bg-white hover:bg-gray-50 text-gray-900 font-semibold rounded-2xl border-2 border-gray-200 text-lg">
                    Tanya AI Assistant
                </a>
            </div>
        </div>
    </section>
</x-main-layout>
