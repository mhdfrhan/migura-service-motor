<x-main-layout>
    <x-slot name="title">Pesanan Saya</x-slot>

    @php
        $orders = [
            [
                'id' => 'ORD-2026-001',
                'type' => 'home-service',
                'package' => 'Premium Wash & Wax',
                'date' => '12 Januari 2026',
                'time' => '10:00',
                'status' => 'ongoing',
                'status_label' => 'Sedang Dikerjakan',
                'address' => 'Jl. Melati Indah No. 12, Pekanbaru',
                'price' => 50000,
                'service_fee' => 25000,
                'total' => 75000,
            ],
            [
                'id' => 'ORD-2026-002',
                'type' => 'regular',
                'package' => 'Regular Wash',
                'date' => '10 Januari 2026',
                'time' => '14:00',
                'status' => 'completed',
                'status_label' => 'Selesai',
                'price' => 25000,
                'total' => 25000,
            ],
            [
                'id' => 'ORD-2026-003',
                'type' => 'home-service',
                'package' => 'Regular Wash',
                'date' => '8 Januari 2026',
                'time' => '09:00',
                'status' => 'completed',
                'status_label' => 'Selesai',
                'address' => 'Jl. Sudirman No. 45, Pekanbaru',
                'price' => 20000,
                'service_fee' => 20000,
                'total' => 40000,
            ],
            [
                'id' => 'ORD-2026-004',
                'type' => 'regular',
                'package' => 'Premium Wash & Wax',
                'date' => '5 Januari 2026',
                'time' => '11:00',
                'status' => 'cancelled',
                'status_label' => 'Dibatalkan',
                'price' => 50000,
                'total' => 50000,
            ],
        ];

        $statusColors = [
            'pending' => ['bg' => 'bg-yellow-50', 'text' => 'text-yellow-600', 'dot' => 'bg-yellow-500'],
            'ongoing' => ['bg' => 'bg-blue-50', 'text' => 'text-blue-600', 'dot' => 'bg-blue-500'],
            'completed' => ['bg' => 'bg-green-50', 'text' => 'text-green-600', 'dot' => 'bg-green-500'],
            'cancelled' => ['bg' => 'bg-gray-50', 'text' => 'text-gray-600', 'dot' => 'bg-gray-400'],
        ];
    @endphp

    <div class="min-h-screen bg-white pb-20" x-data="{ activeTab: 'all' }">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Header -->
            <div class="flex items-center gap-4 mb-8">
                <a wire:navigate href="{{ route('dashboard') }}"
                    class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Pesanan Saya</h1>
            </div>

            <!-- Tabs Filter -->
            <div class="flex gap-2 mb-6 overflow-x-auto pb-2">
                <button @click="activeTab = 'all'"
                    :class="activeTab === 'all' ? 'bg-sky-500 text-white' : 'text-gray-600 hover:text-gray-900'"
                    class="px-4 py-2 rounded-lg font-medium text-sm transition-colors whitespace-nowrap">
                    Semua
                </button>
                <button @click="activeTab = 'ongoing'"
                    :class="activeTab === 'ongoing' ? 'bg-sky-500 text-white' : 'text-gray-600 hover:text-gray-900'"
                    class="px-4 py-2 rounded-lg font-medium text-sm transition-colors whitespace-nowrap">
                    Sedang Berjalan
                </button>
                <button @click="activeTab = 'completed'"
                    :class="activeTab === 'completed' ? 'bg-sky-500 text-white' : 'text-gray-600 hover:text-gray-900'"
                    class="px-4 py-2 rounded-lg font-medium text-sm transition-colors whitespace-nowrap">
                    Selesai
                </button>
                <button @click="activeTab = 'cancelled'"
                    :class="activeTab === 'cancelled' ? 'bg-sky-500 text-white' : 'text-gray-600 hover:text-gray-900'"
                    class="px-4 py-2 rounded-lg font-medium text-sm transition-colors whitespace-nowrap">
                    Dibatalkan
                </button>
            </div>

            <!-- Orders List -->
            <div class="space-y-4">
                @foreach ($orders as $order)
                    <div x-show="activeTab === 'all' || activeTab === '{{ $order['status'] }}'"
                        class="border border-gray-200 rounded-xl overflow-hidden hover:border-gray-300 transition-all">

                        <!-- Order Body -->
                        <div class="p-6">
                            <!-- Header: ID & Status -->
                            <div class="flex items-center justify-between mb-4">
                                <span class="font-semibold text-gray-900">{{ $order['id'] }}</span>
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 rounded-full {{ $statusColors[$order['status']]['dot'] }}">
                                    </div>
                                    <span class="text-sm text-gray-600">{{ $order['status_label'] }}</span>
                                </div>
                            </div>

                            <!-- Package & Type -->
                            <div class="mb-4">
                                <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $order['package'] }}</h3>
                                <p class="text-sm text-gray-600">
                                    {{ $order['type'] === 'home-service' ? 'Home Service' : 'Datang ke Toko' }}</p>
                            </div>

                            <!-- Details Grid -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">Tanggal & Waktu</p>
                                    <p class="text-sm text-gray-900">{{ $order['date'] }}</p>
                                    <p class="text-sm text-gray-900">{{ $order['time'] }} WIB</p>
                                </div>
                                @if ($order['type'] === 'home-service')
                                    <div>
                                        <p class="text-xs text-gray-500 mb-1">Alamat</p>
                                        <p class="text-sm text-gray-900">{{ $order['address'] }}</p>
                                    </div>
                                @endif
                            </div>

                            <!-- Price & Actions -->
                            <div class="pt-4 border-t border-gray-200 flex items-center justify-between">
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">Total Pembayaran</p>
                                    <p class="text-xl font-bold text-gray-900">
                                        Rp{{ number_format($order['total'], 0, ',', '.') }}</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('booking.show', $order['id']) }}" wire:navigate
                                        class="px-4 py-2 bg-sky-500 text-white text-sm font-medium rounded-lg hover:bg-sky-600 transition-colors">
                                        Detail
                                    </a>
                                    @if ($order['status'] === 'completed')
                                        <a href="{{ route('booking.show', $order['id']) }}?review=true" wire:navigate
                                            class="px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition-colors">
                                            Ulasan
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Empty State (conditional) -->
            <div x-show="activeTab !== 'all' && activeTab === 'ongoing' && {{ count(array_filter($orders, fn($o) => $o['status'] === 'ongoing')) === 0 ? 'true' : 'false' }}"
                class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center" style="display: none;">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Tidak Ada Pesanan</h3>
                <p class="text-gray-600 mb-6">Belum ada pesanan dengan status ini</p>
                <a wire:navigate href="{{ route('booking.index') }}"
                    class="inline-flex items-center px-6 py-3 bg-sky-500 text-white font-semibold rounded-lg hover:bg-sky-600 transition-colors">
                    Buat Pesanan Baru
                </a>
            </div>
        </div>
    </div>
</x-main-layout>
