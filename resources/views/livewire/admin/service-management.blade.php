<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Kelola Paket Layanan</h1>
            <p class="mt-1 text-sm text-gray-600">Kelola paket layanan cucian motor Anda</p>
        </div>
        <x-primary-button type="button" wire:click="openCreateModal">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Paket
        </x-primary-button>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Search -->
            <div>
                <x-input-label for="search" value="Cari Paket" />
                <x-text-input wire:model.live.debounce.300ms="search" id="search" type="text"
                    placeholder="Cari nama atau deskripsi..." />
            </div>

            <!-- Filter Status -->
            <div>
                <x-input-label for="filterStatus" value="Filter Status" />
                <select wire:model.live="filterStatus" id="filterStatus"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-sky-500 focus:ring-2 focus:ring-sky-500 focus:ring-opacity-20 transition-all duration-200">
                    <option value="all">Semua Status</option>
                    <option value="active">Aktif</option>
                    <option value="inactive">Tidak Aktif</option>
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
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Paket
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Harga
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Durasi
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Fitur
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
                    @forelse ($packages as $package)
                        <tr wire:key="package-{{ $package->id }}" class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-start gap-3">
                                    <div
                                        class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-2">
                                            <p class="text-sm font-semibold text-gray-900">{{ $package->name }}</p>
                                            @if ($package->is_popular)
                                                <span
                                                    class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path
                                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                        </path>
                                                    </svg>
                                                    Populer
                                                </span>
                                            @endif
                                        </div>
                                        <p class="text-sm text-gray-600 mt-1 line-clamp-2">{{ $package->description }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm font-semibold text-gray-900">
                                    {{ format_currency($package->base_price) }}
                                </p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-900">{{ $package->estimated_duration }} menit</p>
                            </td>
                            <td class="px-6 py-4">
                                @if ($package->features && count($package->features) > 0)
                                    <div class="flex flex-wrap gap-1">
                                        @foreach (array_slice($package->features, 0, 2) as $feature)
                                            <span
                                                class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-700">
                                                {{ $feature }}
                                            </span>
                                        @endforeach
                                        @if (count($package->features) > 2)
                                            <span
                                                class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                                                +{{ count($package->features) - 2 }}
                                            </span>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-sm text-gray-400">Tidak ada</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col gap-1">
                                    <button wire:click="toggleStatus({{ $package->id }})" type="button"
                                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $package->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} hover:opacity-80 transition-opacity">
                                        <span
                                            class="w-2 h-2 rounded-full mr-1.5 {{ $package->is_active ? 'bg-green-600' : 'bg-red-600' }}"></span>
                                        {{ $package->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </button>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <button wire:click="togglePopular({{ $package->id }})" type="button"
                                        class="p-2 {{ $package->is_popular ? 'text-yellow-600 hover:text-yellow-700' : 'text-gray-400 hover:text-yellow-600' }} transition-colors"
                                        title="{{ $package->is_popular ? 'Hapus dari populer' : 'Tandai sebagai populer' }}">
                                        <svg class="w-5 h-5"
                                            fill="{{ $package->is_popular ? 'currentColor' : 'none' }}"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                                            </path>
                                        </svg>
                                    </button>
                                    <button wire:click="openEditModal({{ $package->id }})" type="button"
                                        class="p-2 text-blue-600 hover:text-blue-700 transition-colors" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </button>
                                    <button wire:click="confirmDelete({{ $package->id }})" type="button"
                                        class="p-2 text-red-600 hover:text-red-700 transition-colors" title="Hapus">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                    </path>
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada paket</h3>
                                <p class="mt-1 text-sm text-gray-500">Mulai dengan membuat paket layanan baru.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($packages->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $packages->links() }}
            </div>
        @endif
    </div>

    <!-- Modal Create/Edit -->
    <x-modal name="service-form-modal" maxWidth="2xl" focusable>
        <form wire:submit="save" class="p-6">
            <h2 class="text-lg font-medium text-gray-900 mb-6">
                {{ $editMode ? 'Edit Paket Layanan' : 'Tambah Paket Layanan' }}
            </h2>

            <div class="space-y-4 max-h-[60vh] overflow-y-auto px-1">
                <!-- Name -->
                <div>
                    <x-input-label for="name" value="Nama Paket" />
                    <x-text-input wire:model="name" id="name" type="text" placeholder="Contoh: Premium Wash"
                        required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Description -->
                <div>
                    <x-input-label for="description" value="Deskripsi" />
                    <textarea wire:model="description" id="description" rows="3" placeholder="Deskripsi paket layanan..." required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-sky-500 focus:ring-2 focus:ring-sky-500 focus:ring-opacity-20 transition-all duration-200"></textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <!-- Price & Duration -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="base_price" value="Harga (Rp)" />
                        <x-text-input wire:model="base_price" id="base_price" type="number" min="0"
                            step="1000" placeholder="15000" required />
                        <x-input-error :messages="$errors->get('base_price')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="estimated_duration" value="Durasi (menit)" />
                        <x-text-input wire:model="estimated_duration" id="estimated_duration" type="number"
                            min="1" placeholder="30" required />
                        <x-input-error :messages="$errors->get('estimated_duration')" class="mt-2" />
                    </div>
                </div>

                <!-- Features -->
                <div>
                    <x-input-label for="features" value="Fitur (satu per baris)" />
                    <textarea wire:model="features" id="features" rows="4"
                        placeholder="Cuci bodi motor&#10;Cuci velg&#10;Lap kering&#10;Semir ban"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-sky-500 focus:ring-2 focus:ring-sky-500 focus:ring-opacity-20 transition-all duration-200 font-mono text-sm"></textarea>
                    <p class="mt-1 text-xs text-gray-500">Tulis setiap fitur di baris baru</p>
                </div>

                <!-- Sort Order -->
                <div>
                    <x-input-label for="sort_order" value="Urutan Tampil" />
                    <x-text-input wire:model="sort_order" id="sort_order" type="number" min="0"
                        placeholder="0" />
                    <p class="mt-1 text-xs text-gray-500">Semakin kecil angka, semakin awal ditampilkan</p>
                </div>

                <!-- Checkboxes -->
                <div class="space-y-2">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input wire:model="is_popular" type="checkbox"
                            class="w-4 h-4 text-sky-600 border-gray-300 rounded focus:ring-sky-500">
                        <span class="text-sm text-gray-700">Tandai sebagai paket populer</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input wire:model="is_active" type="checkbox"
                            class="w-4 h-4 text-sky-600 border-gray-300 rounded focus:ring-sky-500">
                        <span class="text-sm text-gray-700">Paket aktif (tersedia untuk booking)</span>
                    </label>
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button type="button" @click="$dispatch('close-modal', 'service-form-modal')">
                    Batal
                </x-secondary-button>

                <x-primary-button type="submit" wire:loading.attr="disabled">
                    <span wire:loading.remove>{{ $editMode ? 'Perbarui' : 'Simpan' }}</span>
                    <span wire:loading>Menyimpan...</span>
                </x-primary-button>
            </div>
        </form>
    </x-modal>

    @script
        <script>
            $wire.on('confirm-delete', (event) => {
                if (confirm(
                        'Apakah Anda yakin ingin menghapus paket ini? Paket yang sudah digunakan tidak dapat dihapus.'
                        )) {
                    $wire.delete(event.packageId);
                }
            });

            // Listen for open modal event from Livewire
            $wire.on('open-service-modal', () => {
                $dispatch('open-modal', 'service-form-modal');
            });
        </script>
    @endscript
</div>
