<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    @stack('scripts')
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen flex flex-col">

        @unless (request()->routeIs('chatbot'))
            @include('partials.navbar')
        @endunless

        <div>
            @include('components.alert')
        </div>

        <div>
            @include('components.message')
        </div>

        <!-- Page Content -->
        <main class="{{ request()->routeIs('chatbot') ? '' : 'pt-20' }} flex-1">
            {{ $slot }}
        </main>

        @unless (request()->routeIs('chatbot'))
            @include('partials.footer')
        @endunless

        <!-- Scroll to Top Button -->
        @unless (request()->routeIs('chatbot'))
            <div x-data="{ showScrollTop: false }" @scroll.window="showScrollTop = (window.pageYOffset > 300)" x-cloak>
                <button @click="window.scrollTo({ top: 0, behavior: 'smooth' })" x-show="showScrollTop"
                    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-4"
                    class="fixed bottom-6 right-6 z-50 w-12 h-12 bg-sky-500 hover:bg-sky-600 text-white rounded-full shadow-lg hover:shadow-xl transition-all duration-200 flex items-center justify-center group"
                    aria-label="Scroll to top">
                    <svg class="w-6 h-6 transform group-hover:-translate-y-1 transition-transform duration-200"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 10l7-7m0 0l7 7m-7-7v18" />
                    </svg>
                </button>
            </div>
        @endunless
    </div>

    @livewireScripts
</body>

</html>
