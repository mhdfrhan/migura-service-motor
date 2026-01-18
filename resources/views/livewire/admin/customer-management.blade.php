<div class="space-y-6">
    <!-- Header -->
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Kelola Pengguna</h1>
        <p class="mt-1 text-sm text-gray-600">Kelola data customer, staff, dan admin</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_users'] }}</p>
                    <p class="text-xs text-gray-600">Total User</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_customers'] }}</p>
                    <p class="text-xs text-gray-600">Customer</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_staff'] }}</p>
                    <p class="text-xs text-gray-600">Staff</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_admins'] }}</p>
                    <p class="text-xs text-gray-600">Admin</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['active_users'] }}</p>
                    <p class="text-xs text-gray-600">Aktif</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['inactive_users'] }}</p>
                    <p class="text-xs text-gray-600">Nonaktif</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Search -->
            <div class="md:col-span-2">
                <x-input-label for="search" value="Cari Pengguna" />
                <x-text-input wire:model.live.debounce.300ms="search" id="search" type="text"
                    placeholder="Cari nama, email, atau telepon..." />
            </div>

            <!-- Filter Role -->
            <div>
                <x-input-label for="filterRole" value="Filter Role" />
                <select wire:model.live="filterRole" id="filterRole"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-sky-500 focus:ring-2 focus:ring-sky-500 focus:ring-opacity-20 transition-all duration-200">
                    <option value="all">Semua Role</option>
                    <option value="customer">Customer</option>
                    <option value="staff">Staff</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <!-- Filter Status -->
            <div>
                <x-input-label for="filterStatus" value="Filter Status" />
                <select wire:model.live="filterStatus" id="filterStatus"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-sky-500 focus:ring-2 focus:ring-sky-500 focus:ring-opacity-20 transition-all duration-200">
                    <option value="all">Semua Status</option>
                    <option value="active">Aktif</option>
                    <option value="inactive">Nonaktif</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left">
                            <button wire:click="sortByColumn('name')"
                                class="flex items-center gap-2 text-xs font-medium text-gray-500 uppercase tracking-wider hover:text-gray-700">
                                <span>Pengguna</span>
                                @if ($sortBy === 'name')
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="{{ $sortDirection === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                                    </svg>
                                @endif
                            </button>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Kontak
                        </th>
                        <th class="px-6 py-3 text-left">
                            <button wire:click="sortByColumn('role')"
                                class="flex items-center gap-2 text-xs font-medium text-gray-500 uppercase tracking-wider hover:text-gray-700">
                                <span>Role</span>
                                @if ($sortBy === 'role')
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="{{ $sortDirection === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                                    </svg>
                                @endif
                            </button>
                        </th>
                        <th class="px-6 py-3 text-left">
                            <button wire:click="sortByColumn('total_bookings')"
                                class="flex items-center gap-2 text-xs font-medium text-gray-500 uppercase tracking-wider hover:text-gray-700">
                                <span>Booking</span>
                                @if ($sortBy === 'total_bookings')
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="{{ $sortDirection === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                                    </svg>
                                @endif
                            </button>
                        </th>
                        <th class="px-6 py-3 text-left">
                            <button wire:click="sortByColumn('loyalty_points')"
                                class="flex items-center gap-2 text-xs font-medium text-gray-500 uppercase tracking-wider hover:text-gray-700">
                                <span>Loyalty</span>
                                @if ($sortBy === 'loyalty_points')
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="{{ $sortDirection === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                                    </svg>
                                @endif
                            </button>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-6 py-3 text-left">
                            <button wire:click="sortByColumn('created_at')"
                                class="flex items-center gap-2 text-xs font-medium text-gray-500 uppercase tracking-wider hover:text-gray-700">
                                <span>Terdaftar</span>
                                @if ($sortBy === 'created_at')
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="{{ $sortDirection === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" />
                                    </svg>
                                @endif
                            </button>
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($users as $user)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @if ($user->avatar)
                                        <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}"
                                            class="w-10 h-10 rounded-lg object-cover">
                                    @else
                                        <div
                                            class="w-10 h-10 rounded-lg bg-gradient-to-br from-sky-500 to-blue-600 flex items-center justify-center text-white font-bold">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                    @endif
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">{{ $user->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-900">{{ $user->phone ?? '-' }}</p>
                                <p class="text-xs text-gray-500 max-w-xs truncate">{{ $user->address ?? '-' }}</p>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $roleColors = [
                                        'customer' => 'bg-blue-100 text-blue-700',
                                        'staff' => 'bg-purple-100 text-purple-700',
                                        'admin' => 'bg-orange-100 text-orange-700',
                                    ];
                                @endphp
                                <span
                                    class="inline-flex px-3 py-1 text-xs font-semibold rounded-full {{ $roleColors[$user->role] }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm font-semibold text-gray-900">{{ $user->bookings_count }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    <span
                                        class="text-sm font-semibold text-gray-900">{{ $user->loyalty_points }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if ($user->is_active)
                                    <span
                                        class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Aktif
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1 px-3 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded-full">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-900">{{ $user->created_at->format('d M Y') }}</p>
                                <p class="text-xs text-gray-500">{{ $user->created_at->diffForHumans() }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <button wire:click="viewDetail({{ $user->id }})" title="Detail"
                                        class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>

                                    <button wire:click="openEditModal({{ $user->id }})" title="Edit"
                                        class="p-2 text-yellow-600 hover:bg-yellow-50 rounded-lg transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>

                                    <button wire:click="toggleStatus({{ $user->id }})"
                                        title="{{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}"
                                        class="p-2 {{ $user->is_active ? 'text-orange-600 hover:bg-orange-50' : 'text-green-600 hover:bg-green-50' }} rounded-lg transition-colors">
                                        @if ($user->is_active)
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                            </svg>
                                        @else
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        @endif
                                    </button>

                                    @if ($user->id !== auth()->id())
                                        <button wire:click="confirmDelete({{ $user->id }})" title="Hapus"
                                            class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    <p class="text-gray-500 text-lg font-medium">Tidak ada data pengguna</p>
                                    <p class="text-gray-400 text-sm mt-1">Coba ubah filter pencarian Anda</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($users->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $users->links() }}
            </div>
        @endif
    </div>

    <!-- Detail Modal -->
    <x-modal name="user-detail-modal" maxWidth="4xl">
        @if ($selectedUser)
            <div class="p-6">
                <div class="flex items-start justify-between mb-6">
                    <div class="flex items-center gap-4">
                        @if ($selectedUser->avatar)
                            <img src="{{ Storage::url($selectedUser->avatar) }}" alt="{{ $selectedUser->name }}"
                                class="w-16 h-16 rounded-xl object-cover">
                        @else
                            <div
                                class="w-16 h-16 rounded-xl bg-gradient-to-br from-sky-500 to-blue-600 flex items-center justify-center text-white font-bold text-2xl">
                                {{ strtoupper(substr($selectedUser->name, 0, 1)) }}
                            </div>
                        @endif
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">{{ $selectedUser->name }}</h3>
                            <p class="text-sm text-gray-600">{{ $selectedUser->email }}</p>
                            @php
                                $roleColors = [
                                    'customer' => 'bg-blue-100 text-blue-700',
                                    'staff' => 'bg-purple-100 text-purple-700',
                                    'admin' => 'bg-orange-100 text-orange-700',
                                ];
                            @endphp
                            <span
                                class="inline-flex mt-2 px-3 py-1 text-xs font-semibold rounded-full {{ $roleColors[$selectedUser->role] }}">
                                {{ ucfirst($selectedUser->role) }}
                            </span>
                        </div>
                    </div>
                    <button wire:click="closeDetailModal" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                    <div class="bg-blue-50 rounded-lg p-4">
                        <div class="flex items-center gap-2 mb-2">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            <span class="text-sm font-medium text-blue-900">Total Booking</span>
                        </div>
                        <p class="text-2xl font-bold text-blue-900">{{ $selectedUser->bookings_count }}</p>
                    </div>

                    <div class="bg-yellow-50 rounded-lg p-4">
                        <div class="flex items-center gap-2 mb-2">
                            <svg class="w-5 h-5 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <span class="text-sm font-medium text-yellow-900">Loyalty Points</span>
                        </div>
                        <p class="text-2xl font-bold text-yellow-900">{{ $selectedUser->loyalty_points }}</p>
                    </div>

                    <div class="bg-green-50 rounded-lg p-4">
                        <div class="flex items-center gap-2 mb-2">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-sm font-medium text-green-900">Total Spent</span>
                        </div>
                        <p class="text-2xl font-bold text-green-900">
                            {{ format_currency($selectedUser->total_spent ?? 0) }}</p>
                    </div>

                    <div class="bg-purple-50 rounded-lg p-4">
                        <div class="flex items-center gap-2 mb-2">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                            <span class="text-sm font-medium text-purple-900">Reviews</span>
                        </div>
                        <p class="text-2xl font-bold text-purple-900">{{ $selectedUser->reviews_count }}</p>
                    </div>
                </div>

                <!-- User Info -->
                <div class="mb-6">
                    <h4 class="text-sm font-semibold text-gray-900 mb-3">Informasi Pengguna</h4>
                    <div class="bg-gray-50 rounded-lg p-4 space-y-2">
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Telepon:</span>
                            <span class="text-sm font-medium text-gray-900">{{ $selectedUser->phone ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Alamat:</span>
                            <span
                                class="text-sm font-medium text-gray-900 text-right max-w-xs">{{ $selectedUser->address ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Status:</span>
                            <span
                                class="text-sm font-medium {{ $selectedUser->is_active ? 'text-green-600' : 'text-red-600' }}">
                                {{ $selectedUser->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Terdaftar:</span>
                            <span
                                class="text-sm font-medium text-gray-900">{{ $selectedUser->created_at->format('d M Y H:i') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Recent Bookings -->
                @if ($selectedUser->bookings->count() > 0)
                    <div>
                        <h4 class="text-sm font-semibold text-gray-900 mb-3">Booking Terakhir</h4>
                        <div class="space-y-2">
                            @foreach ($selectedUser->bookings as $booking)
                                <div class="bg-gray-50 rounded-lg p-3 flex justify-between items-center">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $booking->booking_code }}</p>
                                        <p class="text-xs text-gray-600">{{ $booking->servicePackage->name }} •
                                            {{ $booking->booking_date->format('d M Y') }}</p>
                                    </div>
                                    <span
                                        class="text-xs font-semibold px-2 py-1 rounded-full {{ $booking->status === 'completed'
                                            ? 'bg-green-100 text-green-700'
                                            : ($booking->status === 'cancelled'
                                                ? 'bg-red-100 text-red-700'
                                                : 'bg-blue-100 text-blue-700') }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="mt-6 flex justify-end gap-3">
                    <x-secondary-button wire:click="closeDetailModal">
                        Tutup
                    </x-secondary-button>
                    <x-primary-button wire:click="openEditModal({{ $selectedUser->id }})">
                        Edit Pengguna
                    </x-primary-button>
                </div>
            </div>
        @endif
    </x-modal>

    <!-- Edit Modal -->
    <x-modal name="user-edit-modal" maxWidth="2xl">
            <form wire:submit="save" class="p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-6">Edit Pengguna</h3>

                <div class="space-y-4">
                    <div>
                        <x-input-label for="name" value="Nama Lengkap" />
                        <x-text-input wire:model="name" id="name" type="text" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="email" value="Email" />
                        <x-text-input wire:model="email" id="email" type="email" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="phone" value="Telepon" />
                        <x-text-input wire:model="phone" id="phone" type="tel" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="address" value="Alamat" />
                        <textarea wire:model="address" id="address" rows="3"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-sky-500 focus:ring-2 focus:ring-sky-500 focus:ring-opacity-20 transition-all duration-200"></textarea>
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="role" value="Role" />
                        <select wire:model="role" id="role"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-sky-500 focus:ring-2 focus:ring-sky-500 focus:ring-opacity-20 transition-all duration-200">
                            <option value="customer">Customer</option>
                            <option value="staff">Staff</option>
                            <option value="admin">Admin</option>
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-3">
                        <input type="checkbox" wire:model="is_active" id="is_active"
                            class="w-4 h-4 text-sky-600 border-gray-300 rounded focus:ring-sky-500">
                        <x-input-label for="is_active" value="Aktif" class="!mb-0" />
                    </div>

                    <div class="border-t border-gray-200 pt-4">
                        <p class="text-sm font-medium text-gray-700 mb-3">Ubah Password (Opsional)</p>

                        <div class="space-y-4">
                            <div>
                                <x-input-label for="password" value="Password Baru" />
                                <x-text-input wire:model="password" id="password" type="password" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="password_confirmation" value="Konfirmasi Password" />
                                <x-text-input wire:model="password_confirmation" id="password_confirmation"
                                    type="password" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <x-secondary-button type="button" wire:click="closeEditModal">
                        Batal
                    </x-secondary-button>
                    <x-primary-button type="submit">
                        Simpan Perubahan
                    </x-primary-button>
                </div>
            </form>
    </x-modal>

    @script
        <script>
            $wire.on('confirm-delete', (event) => {
                if (confirm('Apakah Anda yakin ingin menghapus pengguna ini?')) {
                    $wire.call('delete', event.userId);
                }
            });
        </script>
    @endscript
</div>
