<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Kelola Metode Pembayaran</h1>
            <p class="mt-1 text-sm text-gray-600">Kelola metode pembayaran yang tersedia untuk pelanggan</p>
        </div>
        <x-primary-button type="button" wire:click="openCreateModal">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Metode
        </x-primary-button>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Metode</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total'] }}</p>
                </div>
                <div class="w-12 h-12 bg-sky-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Aktif</p>
                    <p class="text-3xl font-bold text-green-600 mt-2">{{ $stats['active'] }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Bank Transfer</p>
                    <p class="text-3xl font-bold text-blue-600 mt-2">{{ $stats['banks'] }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">E-Wallet</p>
                    <p class="text-3xl font-bold text-purple-600 mt-2">{{ $stats['wallets'] }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                </div>
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
                            Metode</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No.
                            Rekening</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Atas
                            Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($paymentMethods as $method)
                        <tr wire:key="method-{{ $method->id }}" class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg flex items-center justify-center"
                                        style="background-color: {{ $method->icon_color }}">
                                        <span class="text-white font-bold text-xs">{{ $method->code }}</span>
                                    </div>
                                    <span class="font-semibold text-gray-900">{{ $method->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $method->type === 'bank_transfer' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                    {{ $method->getTypeLabel() }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm font-mono text-gray-900">
                                {{ $method->account_number ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                {{ $method->account_name }}
                            </td>
                            <td class="px-6 py-4">
                                <button wire:click="toggleActive({{ $method->id }})" type="button"
                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $method->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} hover:opacity-80 transition-opacity">
                                    <span
                                        class="w-2 h-2 rounded-full mr-1.5 {{ $method->is_active ? 'bg-green-600' : 'bg-red-600' }}"></span>
                                    {{ $method->is_active ? 'Aktif' : 'Nonaktif' }}
                                </button>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <button wire:click="openEditModal({{ $method->id }})" type="button"
                                        class="p-2 text-blue-600 hover:text-blue-700 transition-colors" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <button wire:click="confirmDelete({{ $method->id }})" type="button"
                                        class="p-2 text-red-600 hover:text-red-700 transition-colors" title="Hapus">
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
                            <td colspan="6" class="px-6 py-12 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada metode pembayaran</h3>
                                <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan metode pembayaran baru.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($paymentMethods->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $paymentMethods->links() }}
            </div>
        @endif
    </div>

    <!-- Modal Create/Edit -->
    <x-modal name="payment-method-form-modal" maxWidth="lg" focusable>
        <form wire:submit="save" class="p-6">
            <h2 class="text-lg font-medium text-gray-900 mb-6">
                {{ $editMode ? 'Edit Metode Pembayaran' : 'Tambah Metode Pembayaran' }}
            </h2>

            <div class="space-y-4">
                <!-- Type -->
                <div>
                    <x-input-label for="type" value="Tipe" />
                    <select wire:model="type" id="type"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-sky-500 focus:ring-2 focus:ring-sky-500 focus:ring-opacity-20 transition-all duration-200">
                        <option value="bank_transfer">Bank Transfer</option>
                        <option value="e_wallet">E-Wallet</option>
                    </select>
                    <x-input-error :messages="$errors->get('type')" class="mt-2" />
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <!-- Name -->
                    <div>
                        <x-input-label for="name" value="Nama" />
                        <x-text-input wire:model="name" id="name" type="text" placeholder="Bank BCA" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Code -->
                    <div>
                        <x-input-label for="code" value="Kode" />
                        <x-text-input wire:model="code" id="code" type="text" placeholder="BCA" />
                        <x-input-error :messages="$errors->get('code')" class="mt-2" />
                    </div>
                </div>

                <!-- Account Number -->
                <div>
                    <x-input-label for="account_number" value="No. Rekening / Telepon" />
                    <x-text-input wire:model="account_number" id="account_number" type="text"
                        placeholder="1234567890" />
                    <x-input-error :messages="$errors->get('account_number')" class="mt-2" />
                </div>

                <!-- Account Name -->
                <div>
                    <x-input-label for="account_name" value="Atas Nama" />
                    <x-text-input wire:model="account_name" id="account_name" type="text"
                        placeholder="Migura Wash Service" />
                    <x-input-error :messages="$errors->get('account_name')" class="mt-2" />
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <!-- Icon Color -->
                    <div>
                        <x-input-label for="icon_color" value="Warna Icon" />
                        <div class="flex items-center gap-3">
                            <input type="color" wire:model="icon_color" id="icon_color"
                                class="h-10 w-16 rounded-lg border border-gray-300 cursor-pointer">
                            <x-text-input wire:model="icon_color" type="text" placeholder="#0ea5e9"
                                class="flex-1" />
                        </div>
                        <x-input-error :messages="$errors->get('icon_color')" class="mt-2" />
                    </div>

                    <!-- Sort Order -->
                    <div>
                        <x-input-label for="sort_order" value="Urutan" />
                        <x-text-input wire:model="sort_order" id="sort_order" type="number" min="0" />
                        <x-input-error :messages="$errors->get('sort_order')" class="mt-2" />
                    </div>
                </div>

                <!-- Is Active -->
                <div class="space-y-2">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input wire:model="is_active" type="checkbox"
                            class="w-4 h-4 text-sky-600 border-gray-300 rounded focus:ring-sky-500">
                        <span class="text-sm text-gray-700">Metode aktif (tersedia untuk pembayaran)</span>
                    </label>
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button type="button" @click="$dispatch('close-modal', 'payment-method-form-modal')">
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
                if (confirm('Apakah Anda yakin ingin menghapus metode pembayaran ini?')) {
                    $wire.delete(event.methodId);
                }
            });
        </script>
    @endscript
</div>
