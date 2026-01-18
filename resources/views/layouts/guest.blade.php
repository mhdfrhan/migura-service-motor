<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col lg:flex-row">
        <!-- Left Side - Branding -->
        <div
            class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-sky-500 to-blue-600 p-12 items-center justify-center relative overflow-hidden">
            <div
                class="absolute inset-0 bg-grid-white/10 [mask-image:linear-gradient(0deg,transparent,rgba(255,255,255,0.5))]">
            </div>
            <div class="relative z-10 text-white max-w-md">
                <a href="{{ route('home') }}" wire:navigate class="inline-block mb-8 bg-white p-3 rounded-2xl shadow-lg hover:scale-105 transition-all duration-300">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Migura" class="h-16 w-auto">
                </a>
                <h1 class="text-4xl font-bold mb-4">Selamat Datang di Migura</h1>
                <p class="text-xl text-sky-100 leading-relaxed">
                    Sistem pemesanan cuci motor online yang cepat, mudah, dan terpercaya dengan teknologi AI.
                </p>
                <div class="mt-12 space-y-4">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <span class="text-lg">Booking Online 24/7</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <span class="text-lg">AI Queue Prediction</span>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <span class="text-lg">Pembayaran Digital</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Form -->
        <div class="flex-1 flex items-center justify-center p-6 sm:p-12 bg-white">
            <div class="w-full max-w-md">
                <!-- Mobile Logo -->
                <div class="lg:hidden text-center mb-8">
                    <a href="/" wire:navigate class="inline-block">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="Migura" class="h-12 w-auto mx-auto">
                    </a>
                </div>

                {{ $slot }}
            </div>
        </div>
    </div>
</body>

</html>
