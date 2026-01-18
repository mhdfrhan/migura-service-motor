<nav class="fixed top-0 left-0 right-0 z-50 transition-all duration-300" x-data="{
    mobileMenuOpen: false,
    scrolled: false,
    lastScroll: 0,
    hidden: false
}" x-init="window.addEventListener('scroll', () => {
    let currentScroll = window.pageYOffset;
    scrolled = currentScroll > 10;

    if (currentScroll > lastScroll && currentScroll > 100) {
        hidden = true;
    } else if (currentScroll < lastScroll) {
        hidden = false;
    }

    lastScroll = currentScroll;
});"
    :class="{
        'bg-white border-b border-gray-200': scrolled,
        'bg-white/95 backdrop-blur-xl border-b border-gray-200/50': !scrolled,
        '-translate-y-full': hidden,
        'translate-y-0': !hidden
    }">

    <x-container>
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <a href="{{ route('home') }}" wire:navigate class="flex items-center group">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo"
                    class="h-12 w-auto transition-transform duration-300 group-hover:scale-105">
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center gap-2">
                @auth
                    @if (auth()->user()->role === 'admin')
                        {{-- Admin Menu --}}
                        <x-nav-link href="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')"
                            class="px-4 py-2 rounded-xl text-sm font-medium">
                            Dashboard
                        </x-nav-link>
                        <x-nav-link href="{{ route('admin.bookings.index') }}" :active="request()->routeIs('admin.bookings.*')"
                            class="px-4 py-2 rounded-xl text-sm font-medium">
                            Booking
                        </x-nav-link>
                        <x-nav-link href="{{ route('admin.payments.index') }}" :active="request()->routeIs('admin.payments.*')"
                            class="px-4 py-2 rounded-xl text-sm font-medium">
                            Pembayaran
                        </x-nav-link>
                        <x-nav-link href="{{ route('admin.customers.index') }}" :active="request()->routeIs('admin.customers.*')"
                            class="px-4 py-2 rounded-xl text-sm font-medium">
                            Customer
                        </x-nav-link>
                        <x-nav-link href="{{ route('admin.reports.index') }}" :active="request()->routeIs('admin.reports.*')"
                            class="px-4 py-2 rounded-xl text-sm font-medium">
                            Laporan
                        </x-nav-link>
                        <x-nav-link href="{{ route('admin.settings.index') }}" :active="request()->routeIs('admin.settings.*')"
                            class="px-4 py-2 rounded-xl text-sm font-medium">
                            Pengaturan
                        </x-nav-link>
                        <x-nav-link href="{{ route('admin.activity-logs.index') }}" :active="request()->routeIs('admin.activity-logs.*')"
                            class="px-4 py-2 rounded-xl text-sm font-medium">
                            Activity Logs
                        </x-nav-link>
                    @elseif(auth()->user()->role === 'staff')
                        {{-- Staff Menu --}}
                        <x-nav-link href="{{ route('staff.dashboard') }}" :active="request()->routeIs('staff.dashboard')"
                            class="px-4 py-2 rounded-xl text-sm font-medium">
                            Dashboard
                        </x-nav-link>
                        <x-nav-link href="{{ route('staff.bookings.index') }}" :active="request()->routeIs('staff.bookings.*')"
                            class="px-4 py-2 rounded-xl text-sm font-medium">
                            Booking Saya
                        </x-nav-link>
                        <x-nav-link href="{{ route('chatbot') }}" :active="request()->routeIs('chatbot')"
                            class="px-4 py-2 rounded-xl text-sm font-medium">
                            AI Assistant
                        </x-nav-link>
                    @else
                        {{-- Customer Menu --}}
                        <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')"
                            class="px-4 py-2 rounded-xl text-sm font-medium">
                            Beranda
                        </x-nav-link>
                        <x-nav-link href="{{ route('about') }}" :active="request()->routeIs('about')"
                            class="px-4 py-2 rounded-xl text-sm font-medium">
                            Tentang Kami
                        </x-nav-link>
                        <x-nav-link href="{{ route('locations') }}" :active="request()->routeIs('locations')"
                            class="px-4 py-2 rounded-xl text-sm font-medium">
                            Lokasi Kami
                        </x-nav-link>
                        <x-nav-link href="{{ route('booking.index') }}" :active="request()->routeIs('booking.*')"
                            class="px-4 py-2 rounded-xl text-sm font-medium">
                            Pesan Cucian
                        </x-nav-link>
                        <x-nav-link href="{{ route('home-service') }}" :active="request()->routeIs('home-service')"
                            class="px-4 py-2 rounded-xl text-sm font-medium">
                            Antar-Jemput
                        </x-nav-link>
                        <x-nav-link href="{{ route('promo.loyalty') }}" :active="request()->routeIs('promo.loyalty')"
                            class="px-4 py-2 rounded-xl text-sm font-medium">
                            Promosi
                        </x-nav-link>
                        <x-nav-link href="{{ route('chatbot') }}" :active="request()->routeIs('chatbot')"
                            class="px-4 py-2 rounded-xl text-sm font-medium">
                            AI Assistant
                        </x-nav-link>
                    @endif
                @else
                    {{-- Guest Mobile Menu --}}
                    {{-- Guest Menu --}}
                    <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')"
                        class="px-4 py-2 rounded-xl text-sm font-medium">
                        Beranda
                    </x-nav-link>
                    <x-nav-link href="{{ route('about') }}" :active="request()->routeIs('about')"
                        class="px-4 py-2 rounded-xl text-sm font-medium">
                        Tentang Kami
                    </x-nav-link>
                    <x-nav-link href="{{ route('locations') }}" :active="request()->routeIs('locations')"
                        class="px-4 py-2 rounded-xl text-sm font-medium">
                        Lokasi Kami
                    </x-nav-link>
                    <x-nav-link href="{{ route('promo.loyalty') }}" :active="request()->routeIs('promo.loyalty')"
                        class="px-4 py-2 rounded-xl text-sm font-medium">
                        Promosi
                    </x-nav-link>
                @endauth
            </div>

            <!-- Right Side -->
            <div class="hidden lg:flex items-center gap-3">
                @auth
                    <!-- Notifications -->
                    <livewire:notification-dropdown />

                    <!-- User Menu -->
                    <x-dropdown align="right" width="60">
                        <x-slot name="trigger">
                            <button
                                class="flex items-center gap-2 pl-2 pr-3 py-2 rounded-xl hover:bg-gray-100 transition-colors">
                                @if (auth()->user()->avatar)
                                    <img src="{{ Storage::url(auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}"
                                        class="w-8 h-8 rounded-lg object-cover">
                                @else
                                    <div
                                        class="w-8 h-8 rounded-lg bg-gradient-to-br from-sky-500 to-blue-600 flex items-center justify-center text-white font-bold text-sm">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </div>
                                @endif
                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="py-2">
                                <div class="px-4 py-3 border-b border-gray-100">
                                    <p class="text-sm font-bold text-gray-900 truncate">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-gray-500 truncate mt-0.5">{{ auth()->user()->email }}</p>
                                    <p class="text-xs font-semibold text-sky-600 mt-1 uppercase">{{ auth()->user()->role }}
                                    </p>
                                </div>

                                <div class="py-1">
                                    @if (auth()->user()->role === 'admin')
                                        {{-- Admin Dropdown Menu --}}
                                        <x-dropdown-item href="{{ route('admin.dashboard') }}">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                            </svg>
                                            <span>Dashboard</span>
                                        </x-dropdown-item>
                                        <x-dropdown-item href="{{ route('admin.bookings.index') }}">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                            </svg>
                                            <span>Kelola Booking</span>
                                        </x-dropdown-item>
                                        <x-dropdown-item href="{{ route('admin.payments.index') }}">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                            <span>Verifikasi Pembayaran</span>
                                        </x-dropdown-item>
                                        <x-dropdown-item href="{{ route('admin.reports.index') }}">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <span>Laporan</span>
                                        </x-dropdown-item>
                                    @elseif(auth()->user()->role === 'staff')
                                        {{-- Staff Dropdown Menu --}}
                                        <x-dropdown-item href="{{ route('staff.dashboard') }}">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                            </svg>
                                            <span>Dashboard</span>
                                        </x-dropdown-item>
                                        <x-dropdown-item href="{{ route('staff.bookings.index') }}">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                            </svg>
                                            <span>Booking Saya</span>
                                        </x-dropdown-item>
                                    @else
                                        {{-- Customer Dropdown Menu --}}
                                        <x-dropdown-item href="{{ route('dashboard') }}">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                            </svg>
                                            <span>Dashboard</span>
                                        </x-dropdown-item>
                                        <x-dropdown-item href="{{ route('my-orders') }}">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                            </svg>
                                            <span>Pesanan Saya</span>
                                        </x-dropdown-item>
                                        <x-dropdown-item href="{{ route('loyalty.points') }}">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                            </svg>
                                            <span>Poin Loyalitas</span>
                                        </x-dropdown-item>
                                    @endif

                                    <x-dropdown-item href="{{ route('profile.edit') }}">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        <span>Edit Profil</span>
                                    </x-dropdown-item>
                                </div>

                                <div class="border-t border-gray-100"></div>

                                <div class="py-1">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                            <span>Keluar</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a wire:navigate href="{{ route('login') }}"
                        class="px-4 py-2 text-gray-700 hover:text-sky-600 font-medium rounded-xl hover:bg-gray-50 transition-colors text-sm">
                        Masuk
                    </a>
                    <a wire:navigate href="{{ route('register') }}"
                        class="px-5 py-2 bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white font-medium rounded-xl transition-all text-sm">
                        Daftar
                    </a>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <div class="lg:hidden flex items-center gap-2">
                <button @click="mobileMenuOpen = !mobileMenuOpen"
                    class="w-10 h-10 flex items-center justify-center rounded-xl text-gray-600 hover:bg-gray-100 transition-colors">
                    <div class="w-5 h-4 relative flex flex-col justify-between">
                        <span class="w-full h-0.5 bg-current rounded-full transition-all duration-300"
                            :class="mobileMenuOpen ? 'rotate-45 translate-y-1.5' : ''"></span>
                        <span class="w-full h-0.5 bg-current rounded-full transition-all duration-300"
                            :class="mobileMenuOpen ? 'opacity-0' : ''"></span>
                        <span class="w-full h-0.5 bg-current rounded-full transition-all duration-300"
                            :class="mobileMenuOpen ? '-rotate-45 -translate-y-1.5' : ''"></span>
                    </div>
                </button>
            </div>
        </div>
    </x-container>

    <!-- Mobile Overlay -->
    <div x-show="mobileMenuOpen" x-transition:enter="transition-opacity duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity duration-250" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" @click="mobileMenuOpen = false"
        class="fixed inset-0 bg-black/30 backdrop-blur-sm z-40 lg:hidden" style="display: none;">
    </div>

    <!-- Mobile Sidebar -->
    <div x-show="mobileMenuOpen" x-transition:enter="transition transform duration-300"
        x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition transform duration-250" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="fixed top-0 left-0 bottom-0 w-80 bg-white z-50 lg:hidden shadow-2xl" style="display: none;">

        <div class="flex flex-col h-full">
            <!-- Header -->
            <div class="flex items-center justify-between p-5 border-b border-gray-200">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" class="h-10 w-auto">
                <button @click="mobileMenuOpen = false"
                    class="w-10 h-10 flex items-center justify-center rounded-xl text-gray-600 hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Content -->
            <div class="flex-1 overflow-y-auto">
                <div class="p-5">
                    @auth
                        <!-- User Profile -->
                        <div
                            class="flex items-center gap-3 p-4 bg-gradient-to-br from-sky-50 to-blue-50 rounded-2xl mb-5 border border-sky-100">
                            @if (auth()->user()->avatar)
                                <img src="{{ Storage::url(auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}"
                                    class="w-12 h-12 rounded-xl object-cover">
                            @else
                                <div
                                    class="w-12 h-12 rounded-xl bg-gradient-to-br from-sky-500 to-blue-600 flex items-center justify-center text-white font-bold text-lg">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                            @endif
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-bold text-gray-900 truncate">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-gray-600 truncate">{{ auth()->user()->email }}</p>
                            </div>
                        </div>
                    @endauth

                    <!-- Navigation -->
                    <nav class="space-y-1">
                        @auth
                            @if (auth()->user()->role === 'admin')
                                {{-- Admin Mobile Menu --}}
                                <a wire:navigate href="{{ route('admin.dashboard') }}"
                                    class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-sky-50 hover:text-sky-600 rounded-xl transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-sky-50 text-sky-600 font-bold' : 'font-medium' }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    <span>Dashboard</span>
                                </a>
                                <a wire:navigate href="{{ route('admin.bookings.index') }}"
                                    class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-sky-50 hover:text-sky-600 rounded-xl transition-colors {{ request()->routeIs('admin.bookings.*') ? 'bg-sky-50 text-sky-600 font-bold' : 'font-medium' }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    <span>Kelola Booking</span>
                                </a>
                                <a wire:navigate href="{{ route('admin.payments.index') }}"
                                    class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-sky-50 hover:text-sky-600 rounded-xl transition-colors {{ request()->routeIs('admin.payments.*') ? 'bg-sky-50 text-sky-600 font-bold' : 'font-medium' }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    <span>Verifikasi Pembayaran</span>
                                </a>
                                <a wire:navigate href="{{ route('admin.customers.index') }}"
                                    class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-sky-50 hover:text-sky-600 rounded-xl transition-colors {{ request()->routeIs('admin.customers.*') ? 'bg-sky-50 text-sky-600 font-bold' : 'font-medium' }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    <span>Customer</span>
                                </a>
                                <a wire:navigate href="{{ route('admin.reports.index') }}"
                                    class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-sky-50 hover:text-sky-600 rounded-xl transition-colors {{ request()->routeIs('admin.reports.*') ? 'bg-sky-50 text-sky-600 font-bold' : 'font-medium' }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <span>Laporan</span>
                                </a>
                                <a wire:navigate href="{{ route('admin.settings.index') }}"
                                    class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-sky-50 hover:text-sky-600 rounded-xl transition-colors {{ request()->routeIs('admin.settings.*') ? 'bg-sky-50 text-sky-600 font-bold' : 'font-medium' }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span>Pengaturan</span>
                                </a>
                                <a wire:navigate href="{{ route('admin.activity-logs.index') }}"
                                    class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-sky-50 hover:text-sky-600 rounded-xl transition-colors {{ request()->routeIs('admin.activity-logs.*') ? 'bg-sky-50 text-sky-600 font-bold' : 'font-medium' }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <span>Activity Logs</span>
                                </a>
                            @elseif(auth()->user()->role === 'staff')
                                {{-- Staff Mobile Menu --}}
                                <a wire:navigate href="{{ route('staff.dashboard') }}"
                                    class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-sky-50 hover:text-sky-600 rounded-xl transition-colors {{ request()->routeIs('staff.dashboard') ? 'bg-sky-50 text-sky-600 font-bold' : 'font-medium' }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    <span>Dashboard</span>
                                </a>
                                <a wire:navigate href="{{ route('staff.bookings.index') }}"
                                    class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-sky-50 hover:text-sky-600 rounded-xl transition-colors {{ request()->routeIs('staff.bookings.*') ? 'bg-sky-50 text-sky-600 font-bold' : 'font-medium' }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    <span>Booking Saya</span>
                                </a>
                                <a wire:navigate href="{{ route('chatbot') }}"
                                    class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-sky-50 hover:text-sky-600 rounded-xl transition-colors {{ request()->routeIs('chatbot') ? 'bg-sky-50 text-sky-600 font-bold' : 'font-medium' }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                    </svg>
                                    <span>AI Assistant</span>
                                </a>
                            @else
                                {{-- Customer Mobile Menu --}}
                                <a wire:navigate href="{{ route('home') }}"
                                    class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-sky-50 hover:text-sky-600 rounded-xl transition-colors {{ request()->routeIs('home') ? 'bg-sky-50 text-sky-600 font-bold' : 'font-medium' }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    <span>Beranda</span>
                                </a>
                                <a wire:navigate href="{{ route('about') }}"
                                    class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-sky-50 hover:text-sky-600 rounded-xl transition-colors {{ request()->routeIs('about') ? 'bg-sky-50 text-sky-600 font-bold' : 'font-medium' }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Tentang Kami</span>
                                </a>
                                <a wire:navigate href="{{ route('booking.index') }}"
                                    class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-sky-50 hover:text-sky-600 rounded-xl transition-colors {{ request()->routeIs('booking.*') ? 'bg-sky-50 text-sky-600 font-bold' : 'font-medium' }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    <span>Pesan Cucian</span>
                                </a>

                                <a wire:navigate href="{{ route('home-service') }}"
                                    class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-sky-50 hover:text-sky-600 rounded-xl transition-colors {{ request()->routeIs('home-service') ? 'bg-sky-50 text-sky-600 font-bold' : 'font-medium' }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                    <span>Antar-Jemput</span>
                                </a>

                                <a wire:navigate href="{{ route('promo.loyalty') }}"
                                    class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-sky-50 hover:text-sky-600 rounded-xl transition-colors {{ request()->routeIs('promo.loyalty') ? 'bg-sky-50 text-sky-600 font-bold' : 'font-medium' }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                                    </svg>
                                    <span>Promosi & Loyalitas</span>
                                </a>

                                <a wire:navigate href="{{ route('chatbot') }}"
                                    class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-sky-50 hover:text-sky-600 rounded-xl transition-colors {{ request()->routeIs('chatbot') ? 'bg-sky-50 text-sky-600 font-bold' : 'font-medium' }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                    </svg>
                                    <span>AI Assistant</span>
                                </a>
                            @endif
                        @else
                            {{-- Guest Mobile Menu --}}
                            <a wire:navigate href="{{ route('home') }}"
                                class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-sky-50 hover:text-sky-600 rounded-xl transition-colors {{ request()->routeIs('home') ? 'bg-sky-50 text-sky-600 font-bold' : 'font-medium' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                <span>Beranda</span>
                            </a>
                            <a wire:navigate href="{{ route('locations') }}"
                                class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-sky-50 hover:text-sky-600 rounded-xl transition-colors {{ request()->routeIs('locations') ? 'bg-sky-50 text-sky-600 font-bold' : 'font-medium' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span>Lokasi Kami</span>
                            </a>
                            <a wire:navigate href="{{ route('about') }}"
                                class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-sky-50 hover:text-sky-600 rounded-xl transition-colors {{ request()->routeIs('about') ? 'bg-sky-50 text-sky-600 font-bold' : 'font-medium' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Tentang Kami</span>
                            </a>
                            <a wire:navigate href="{{ route('promo.loyalty') }}"
                                class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-sky-50 hover:text-sky-600 rounded-xl transition-colors {{ request()->routeIs('promo.loyalty') ? 'bg-sky-50 text-sky-600 font-bold' : 'font-medium' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                                </svg>
                                <span>Promosi</span>
                            </a>
                        @endauth
                    </nav>
                </div>
            </div>

            <!-- Footer -->
            @auth
                <div class="p-5 border-t border-gray-200 bg-gray-50">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex items-center justify-center gap-2 w-full px-4 py-3 text-red-600 hover:bg-red-50 rounded-xl transition-colors font-bold">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <span>Keluar</span>
                        </button>
                    </form>
                </div>
            @else
                <div class="p-5 border-t border-gray-200 space-y-2">
                    <a wire:navigate href="{{ route('login') }}"
                        class="flex items-center justify-center gap-2 w-full px-5 py-3 text-gray-700 hover:bg-gray-50 rounded-xl transition-colors font-bold border-2 border-gray-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        Masuk
                    </a>

                    <a wire:navigate href="{{ route('register') }}"
                        class="flex items-center justify-center gap-2 w-full px-5 py-3 bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white rounded-xl transition-all font-bold">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        Daftar
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>
