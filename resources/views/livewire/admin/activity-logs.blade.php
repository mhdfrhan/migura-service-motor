<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Activity Logs</h1>
            <p class="mt-1 text-sm text-gray-600">Riwayat aktivitas sistem (Admin, Staff, Customer)</p>
        </div>
        <button wire:click="export"
            class="px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-green-500/30 transition-all flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <span>Export Excel</span>
        </button>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Logs</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ number_format($stats['total']) }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Admin</p>
                    <p class="text-3xl font-bold text-orange-600 mt-2">{{ number_format($stats['admin']) }}</p>
                </div>
                <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Staff</p>
                    <p class="text-3xl font-bold text-purple-600 mt-2">{{ number_format($stats['staff']) }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Customer</p>
                    <p class="text-3xl font-bold text-green-600 mt-2">{{ number_format($stats['customer']) }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters & Search -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex flex-col sm:flex-row gap-4">
            <!-- Search -->
            <div class="flex-1">
                <x-text-input wire:model.live.debounce.300ms="search" type="text"
                    placeholder="Cari action, model type, nama, atau email..." class="w-full" />
            </div>

            <!-- Filter Role -->
            <div class="sm:w-48">
                <select wire:model.live="filterRole"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-sky-500 focus:ring-2 focus:ring-sky-500 focus:ring-opacity-20 transition-all duration-200">
                    <option value="all">Semua Role</option>
                    <option value="admin">Admin</option>
                    <option value="staff">Staff</option>
                    <option value="customer">Customer</option>
                </select>
            </div>

            <!-- Filter Action -->
            <div class="sm:w-48">
                <select wire:model.live="filterAction"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-sky-500 focus:ring-2 focus:ring-sky-500 focus:ring-opacity-20 transition-all duration-200">
                    <option value="all">Semua Action</option>
                    @foreach($actions as $action)
                        <option value="{{ $action }}">{{ ucfirst(str_replace('_', ' ', $action)) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <!-- Logs Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">User</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Action</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Model</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">IP Address</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Waktu</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($logs as $log)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div>
                                    @if($log->user)
                                        <p class="text-sm font-medium text-gray-900">{{ $log->user->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $log->user->email }}</p>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium mt-1
                                            {{ $log->user->role === 'admin' ? 'bg-orange-100 text-orange-800' : ($log->user->role === 'staff' ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800') }}">
                                            {{ ucfirst($log->user->role) }}
                                        </span>
                                    @else
                                        <p class="text-sm text-gray-400">System</p>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ ucfirst(str_replace('_', ' ', $log->action)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($log->model_type)
                                    <p class="text-sm text-gray-900">{{ $log->model_type }}</p>
                                    @if($log->model_id)
                                        <p class="text-xs text-gray-500">ID: {{ $log->model_id }}</p>
                                    @endif
                                @else
                                    <p class="text-sm text-gray-400">-</p>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <p class="text-sm text-gray-900">{{ $log->ip_address ?? '-' }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <p class="text-sm text-gray-900">{{ $log->created_at->format('d M Y, H:i') }}</p>
                                <p class="text-xs text-gray-500">{{ $log->created_at->diffForHumans() }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <button wire:click="viewLog({{ $log->id }})"
                                    class="text-sky-600 hover:text-sky-900 font-semibold">
                                    Detail
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-500">
                                    <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <p class="text-lg font-semibold">Tidak ada data log</p>
                                    <p class="text-sm mt-1">Belum ada aktivitas yang tercatat</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($logs->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $logs->links() }}
            </div>
        @endif
    </div>

    <!-- Modal Detail -->
    @if ($selectedLog)
        <x-modal name="log-detail-modal" maxWidth="4xl" focusable>
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 mb-6">Detail Activity Log</h2>

                <div class="space-y-6">
                    <!-- User Info -->
                    <div class="bg-gray-50 rounded-xl p-6">
                        <h4 class="font-semibold text-gray-900 mb-4">Informasi User</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600">Nama</p>
                                <p class="font-semibold text-gray-900">{{ $selectedLog->user->name ?? 'System' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Email</p>
                                <p class="font-semibold text-gray-900">{{ $selectedLog->user->email ?? '-' }}</p>
                            </div>
                            @if($selectedLog->user)
                                <div>
                                    <p class="text-sm text-gray-600">Role</p>
                                    <span class="inline-flex items-center px-3 py-1 rounded text-sm font-medium
                                        {{ $selectedLog->user->role === 'admin' ? 'bg-orange-100 text-orange-800' : ($selectedLog->user->role === 'staff' ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800') }}">
                                        {{ ucfirst($selectedLog->user->role) }}
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Action Info -->
                    <div class="bg-gray-50 rounded-xl p-6">
                        <h4 class="font-semibold text-gray-900 mb-4">Informasi Action</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600">Action</p>
                                <p class="font-semibold text-gray-900">{{ ucfirst(str_replace('_', ' ', $selectedLog->action)) }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Model Type</p>
                                <p class="font-semibold text-gray-900">{{ $selectedLog->model_type ?? '-' }}</p>
                            </div>
                            @if($selectedLog->model_id)
                                <div>
                                    <p class="text-sm text-gray-600">Model ID</p>
                                    <p class="font-semibold text-gray-900">{{ $selectedLog->model_id }}</p>
                                </div>
                            @endif
                            <div>
                                <p class="text-sm text-gray-600">Waktu</p>
                                <p class="font-semibold text-gray-900">{{ $selectedLog->created_at->format('d M Y, H:i:s') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Old Values -->
                    @if($selectedLog->old_values && count($selectedLog->old_values) > 0)
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-4">Nilai Lama</h4>
                            <div class="bg-gray-50 rounded-xl p-4">
                                <pre class="text-sm text-gray-700 whitespace-pre-wrap">{{ json_encode($selectedLog->old_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                            </div>
                        </div>
                    @endif

                    <!-- New Values -->
                    @if($selectedLog->new_values && count($selectedLog->new_values) > 0)
                        <div>
                            <h4 class="font-semibold text-gray-900 mb-4">Nilai Baru</h4>
                            <div class="bg-gray-50 rounded-xl p-4">
                                <pre class="text-sm text-gray-700 whitespace-pre-wrap">{{ json_encode($selectedLog->new_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                            </div>
                        </div>
                    @endif

                    <!-- Technical Info -->
                    <div class="bg-gray-50 rounded-xl p-6">
                        <h4 class="font-semibold text-gray-900 mb-4">Informasi Teknis</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600">IP Address</p>
                                <p class="font-semibold text-gray-900">{{ $selectedLog->ip_address ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">User Agent</p>
                                <p class="font-semibold text-gray-900 text-xs break-all">{{ $selectedLog->user_agent ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button type="button" @click="$dispatch('close-modal', 'log-detail-modal')">
                        Tutup
                    </x-secondary-button>
                </div>
            </div>
        </x-modal>
    @endif
</div>
