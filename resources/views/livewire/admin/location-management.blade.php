<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Kelola Lokasi</h1>
            <p class="mt-1 text-sm text-gray-600">Kelola cabang dan lokasi Migura Wash</p>
        </div>
        <x-primary-button wire:click="openCreateModal">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Lokasi
        </x-primary-button>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_locations'] }}</p>
                    <p class="text-xs text-gray-600">Total Lokasi</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['active_locations'] }}</p>
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
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['inactive_locations'] }}</p>
                    <p class="text-xs text-gray-600">Nonaktif</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['main_branches'] }}</p>
                    <p class="text-xs text-gray-600">Cabang Utama</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Search -->
            <div class="md:col-span-2">
                <x-input-label for="search" value="Cari Lokasi" />
                <x-text-input wire:model.live.debounce.300ms="search" id="search" type="text"
                    placeholder="Cari nama, kode, alamat, atau telepon..." />
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
                                <span>Lokasi</span>
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
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Area Layanan
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Kapasitas
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Jam Operasional
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($locations as $location)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <p class="text-sm font-semibold text-gray-900">{{ $location->name }}</p>
                                        @if ($location->is_main_branch)
                                            <span
                                                class="inline-flex px-2 py-0.5 text-xs font-semibold text-orange-700 bg-orange-100 rounded-full">
                                                Utama
                                            </span>
                                        @endif
                                    </div>
                                    <p class="text-xs text-gray-500">{{ $location->code }}</p>
                                    <p class="text-xs text-gray-600 mt-1 max-w-xs">{{ $location->address }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-900">{{ $location->phone ?? '-' }}</p>
                                <p class="text-xs text-gray-500">{{ $location->email ?? '-' }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-1">
                                    <svg class="w-4 h-4 text-sky-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span
                                        class="text-sm font-semibold text-gray-900">{{ $location->max_service_radius_km }}
                                        km</span>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Radius layanan</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm font-semibold text-gray-900">{{ $location->daily_capacity }}/hari
                                </p>
                                <p class="text-xs text-gray-500">{{ $location->slot_capacity }}/slot</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-900">{{ substr($location->open_time, 0, 5) }} -
                                    {{ substr($location->close_time, 0, 5) }}</p>
                                <p class="text-xs text-gray-500">{{ count($location->operating_days ?? []) }} hari</p>
                            </td>
                            <td class="px-6 py-4">
                                @if ($location->is_active)
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
                                <div class="flex items-center justify-end gap-2">
                                    <button wire:click="viewDetail({{ $location->id }})" title="Detail"
                                        class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>

                                    <button wire:click="openEditModal({{ $location->id }})" title="Edit"
                                        class="p-2 text-yellow-600 hover:bg-yellow-50 rounded-lg transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>

                                    <button wire:click="toggleStatus({{ $location->id }})"
                                        title="{{ $location->is_active ? 'Nonaktifkan' : 'Aktifkan' }}"
                                        class="p-2 {{ $location->is_active ? 'text-orange-600 hover:bg-orange-50' : 'text-green-600 hover:bg-green-50' }} rounded-lg transition-colors">
                                        @if ($location->is_active)
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

                                    <button wire:click="confirmDelete({{ $location->id }})" title="Hapus"
                                        class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <p class="text-gray-500 text-lg font-medium">Tidak ada data lokasi</p>
                                    <p class="text-gray-400 text-sm mt-1">Klik tombol "Tambah Lokasi" untuk menambahkan
                                        lokasi baru</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($locations->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $locations->links() }}
            </div>
        @endif
    </div>

    <!-- Form Modal -->
    <x-modal name="location-form-modal" maxWidth="4xl">
        <form wire:submit="save" class="p-6">
            <h3 class="text-lg font-bold text-gray-900 mb-6">
                {{ $locationId ? 'Edit Lokasi' : 'Tambah Lokasi Baru' }}
            </h3>

            <div class="space-y-4 max-h-[70vh] overflow-y-auto pr-2">
                <!-- Basic Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="name" value="Nama Lokasi *" />
                        <x-text-input wire:model="name" id="name" type="text" required
                            placeholder="Migura Wash Pekanbaru Pusat" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="code" value="Kode Lokasi *" />
                        <x-text-input wire:model="code" id="code" type="text" required
                            placeholder="MIG-PKU-01" />
                        <x-input-error :messages="$errors->get('code')" class="mt-2" />
                    </div>
                </div>

                <!-- Address -->
                <div>
                    <x-input-label for="address" value="Alamat Lengkap *" />
                    <textarea wire:model="address" id="address" rows="2" required placeholder="Jl. Sudirman No. 123, Pekanbaru"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-sky-500 focus:ring-2 focus:ring-sky-500 focus:ring-opacity-20 transition-all duration-200"></textarea>
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>

                <!-- Coordinates -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="latitude" value="Latitude *" />
                        <x-text-input wire:model="latitude" id="latitude" type="number" step="any" required
                            placeholder="0.478652" />
                        <x-input-error :messages="$errors->get('latitude')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="longitude" value="Longitude *" />
                        <x-text-input wire:model="longitude" id="longitude" type="number" step="any" required
                            placeholder="101.402108" />
                        <x-input-error :messages="$errors->get('longitude')" class="mt-2" />
                    </div>
                </div>

                <!-- Contact -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="phone" value="Telepon" />
                        <x-text-input wire:model="phone" id="phone" type="tel"
                            placeholder="0812-3456-7890" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="email" value="Email" />
                        <x-text-input wire:model="email" id="email" type="email"
                            placeholder="pekanbaru@migurawash.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>

                <!-- Operating Hours -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="open_time" value="Jam Buka *" />
                        <x-text-input wire:model="open_time" id="open_time" type="time" required />
                        <x-input-error :messages="$errors->get('open_time')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="close_time" value="Jam Tutup *" />
                        <x-text-input wire:model="close_time" id="close_time" type="time" required />
                        <x-input-error :messages="$errors->get('close_time')" class="mt-2" />
                    </div>
                </div>

                <!-- Operating Days -->
                <div>
                    <x-input-label value="Hari Operasional *" />
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mt-2">
                        @foreach (['monday' => 'Senin', 'tuesday' => 'Selasa', 'wednesday' => 'Rabu', 'thursday' => 'Kamis', 'friday' => 'Jumat', 'saturday' => 'Sabtu', 'sunday' => 'Minggu'] as $day => $label)
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" wire:model="operating_days" value="{{ $day }}"
                                    class="w-4 h-4 text-sky-600 border-gray-300 rounded focus:ring-sky-500">
                                <span class="text-sm text-gray-700">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                    <x-input-error :messages="$errors->get('operating_days')" class="mt-2" />
                </div>

                <!-- Service & Capacity -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <x-input-label for="max_service_radius_km" value="Radius Layanan (km) *" />
                        <x-text-input wire:model="max_service_radius_km" id="max_service_radius_km" type="number"
                            min="1" max="100" required />
                        <x-input-error :messages="$errors->get('max_service_radius_km')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="daily_capacity" value="Kapasitas Harian *" />
                        <x-text-input wire:model="daily_capacity" id="daily_capacity" type="number" min="1"
                            required />
                        <x-input-error :messages="$errors->get('daily_capacity')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="slot_capacity" value="Kapasitas per Slot *" />
                        <x-text-input wire:model="slot_capacity" id="slot_capacity" type="number" min="1"
                            required />
                        <x-input-error :messages="$errors->get('slot_capacity')" class="mt-2" />
                    </div>
                </div>

                <!-- Facilities -->
                <div>
                    <x-input-label value="Fasilitas" />
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3 mt-2">
                        @foreach (['parking' => 'Parkir', 'wifi' => 'WiFi', 'waiting_room' => 'Ruang Tunggu', 'toilet' => 'Toilet', 'musholla' => 'Musholla', 'cafeteria' => 'Kafetaria'] as $facility => $label)
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" wire:model="facilities" value="{{ $facility }}"
                                    class="w-4 h-4 text-sky-600 border-gray-300 rounded focus:ring-sky-500">
                                <span class="text-sm text-gray-700">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <x-input-label for="description" value="Deskripsi" />
                    <textarea wire:model="description" id="description" rows="3"
                        placeholder="Deskripsi singkat tentang lokasi ini..."
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-sky-500 focus:ring-2 focus:ring-sky-500 focus:ring-opacity-20 transition-all duration-200"></textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <!-- Status & Flags -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="flex items-center gap-3">
                        <input type="checkbox" wire:model="is_active" id="is_active"
                            class="w-4 h-4 text-sky-600 border-gray-300 rounded focus:ring-sky-500">
                        <x-input-label for="is_active" value="Aktif" class="mb-0!" />
                    </div>

                    <div class="flex items-center gap-3">
                        <input type="checkbox" wire:model="is_main_branch" id="is_main_branch"
                            class="w-4 h-4 text-sky-600 border-gray-300 rounded focus:ring-sky-500">
                        <x-input-label for="is_main_branch" value="Cabang Utama" class="mb-0!" />
                    </div>

                    <div>
                        <x-input-label for="sort_order" value="Urutan Tampil" />
                        <x-text-input wire:model="sort_order" id="sort_order" type="number" />
                    </div>
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-3 border-t pt-4">
                <x-secondary-button type="button" x-on:click="$dispatch('close-modal', 'location-form-modal')">
                    Batal
                </x-secondary-button>
                <x-primary-button type="submit">
                    {{ $locationId ? 'Simpan Perubahan' : 'Tambah Lokasi' }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>

    <!-- Detail Modal -->
    <x-modal name="location-detail-modal" maxWidth="3xl">
        @if ($selectedLocation)
            <div class="p-6">
                <div class="flex items-start justify-between mb-6">
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <h3 class="text-xl font-bold text-gray-900">{{ $selectedLocation->name }}</h3>
                            @if ($selectedLocation->is_main_branch)
                                <span
                                    class="inline-flex px-3 py-1 text-xs font-semibold text-orange-700 bg-orange-100 rounded-full">
                                    Cabang Utama
                                </span>
                            @endif
                        </div>
                        <p class="text-sm text-gray-600">{{ $selectedLocation->code }}</p>
                    </div>
                    <button wire:click="closeDetailModal" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Location Info -->
                <div class="space-y-4">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="text-sm font-semibold text-gray-900 mb-3">Alamat & Kontak</h4>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Alamat:</span>
                                <span
                                    class="text-sm font-medium text-gray-900 text-right max-w-xs">{{ $selectedLocation->address }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Koordinat:</span>
                                <span class="text-sm font-medium text-gray-900">{{ $selectedLocation->latitude }},
                                    {{ $selectedLocation->longitude }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Telepon:</span>
                                <span
                                    class="text-sm font-medium text-gray-900">{{ $selectedLocation->phone ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Email:</span>
                                <span
                                    class="text-sm font-medium text-gray-900">{{ $selectedLocation->email ?? '-' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="text-sm font-semibold text-gray-900 mb-3">Operasional</h4>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Jam Operasional:</span>
                                <span
                                    class="text-sm font-medium text-gray-900">{{ substr($selectedLocation->open_time, 0, 5) }}
                                    - {{ substr($selectedLocation->close_time, 0, 5) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Hari Operasional:</span>
                                <span
                                    class="text-sm font-medium text-gray-900">{{ count($selectedLocation->operating_days ?? []) }}
                                    hari</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Radius Layanan:</span>
                                <span
                                    class="text-sm font-medium text-gray-900">{{ $selectedLocation->max_service_radius_km }}
                                    km</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="text-sm font-semibold text-gray-900 mb-3">Kapasitas</h4>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Kapasitas Harian:</span>
                                <span
                                    class="text-sm font-medium text-gray-900">{{ $selectedLocation->daily_capacity }}
                                    booking/hari</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Kapasitas per Slot:</span>
                                <span class="text-sm font-medium text-gray-900">{{ $selectedLocation->slot_capacity }}
                                    booking/slot</span>
                            </div>
                        </div>
                    </div>

                    @if ($selectedLocation->facilities && count($selectedLocation->facilities) > 0)
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h4 class="text-sm font-semibold text-gray-900 mb-3">Fasilitas</h4>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($selectedLocation->facilities as $facility)
                                    <span
                                        class="inline-flex px-3 py-1 text-xs font-medium text-sky-700 bg-sky-100 rounded-full">
                                        {{ ucfirst(str_replace('_', ' ', $facility)) }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if ($selectedLocation->description)
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h4 class="text-sm font-semibold text-gray-900 mb-2">Deskripsi</h4>
                            <p class="text-sm text-gray-700">{{ $selectedLocation->description }}</p>
                        </div>
                    @endif
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <x-secondary-button wire:click="closeDetailModal">
                        Tutup
                    </x-secondary-button>
                    <x-primary-button wire:click="editFromDetail({{ $selectedLocation->id }})">
                        Edit Lokasi
                    </x-primary-button>
                </div>
            </div>
        @endif
    </x-modal>

    @script
        <script>
            $wire.on('confirm-delete', (event) => {
                if (confirm('Apakah Anda yakin ingin menghapus lokasi ini?')) {
                    $wire.call('delete', event.locationId);
                }
            });

            $wire.on('open-edit-delayed', (event) => {
                setTimeout(() => {
                    $wire.call('openEditModal', event.id);
                }, 300);
            });
        </script>
    @endscript
</div>
