<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Kelola Promo Codes</h1>
            <p class="mt-1 text-sm text-gray-600">Buat dan kelola kode promo untuk diskon booking</p>
        </div>
        <button wire:click="createPromoCode"
            class="px-6 py-3 bg-gradient-to-r from-sky-500 to-blue-600 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-sky-500/30 transition-all flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <span>Tambah Promo Code</span>
        </button>
    </div>

    <!-- Success/Error Messages -->
    @if (session()->has('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-xl flex items-center gap-3">
            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Promo</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2">{{ number_format($stats['total']) }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Aktif</p>
                    <p class="text-3xl font-bold text-green-600 mt-2">{{ number_format($stats['active']) }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Tidak Aktif</p>
                    <p class="text-3xl font-bold text-gray-600 mt-2">{{ number_format($stats['inactive']) }}</p>
                </div>
                <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Kedaluwarsa</p>
                    <p class="text-3xl font-bold text-red-600 mt-2">{{ number_format($stats['expired']) }}</p>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex flex-col sm:flex-row gap-4">
            <!-- Search -->
            <div class="flex-1">
                <x-text-input wire:model.live.debounce.300ms="search" type="text"
                    placeholder="Cari kode atau deskripsi promo..." class="w-full" />
            </div>

            <!-- Filter Status -->
            <div class="sm:w-48">
                <select wire:model.live="filterStatus"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-sky-500 focus:ring-2 focus:ring-sky-500 focus:ring-opacity-20 transition-all duration-200">
                    <option value="all">Semua Status</option>
                    <option value="active">Aktif</option>
                    <option value="inactive">Tidak Aktif</option>
                    <option value="expired">Kedaluwarsa</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kode</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Deskripsi</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Diskon</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Periode</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Penggunaan</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($promoCodes as $promoCode)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <span class="px-3 py-1 bg-gradient-to-r from-purple-500 to-pink-600 text-white font-bold rounded-lg text-sm">
                                        {{ $promoCode->code }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-900 max-w-xs">{{ $promoCode->description }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm">
                                    <p class="font-semibold text-gray-900">
                                        @if($promoCode->discount_type === 'percentage')
                                            {{ number_format($promoCode->discount_value, 0) }}%
                                        @else
                                            Rp{{ number_format($promoCode->discount_value, 0, ',', '.') }}
                                        @endif
                                    </p>
                                    @if($promoCode->min_transaction > 0)
                                        <p class="text-xs text-gray-500">Min: Rp{{ number_format($promoCode->min_transaction, 0, ',', '.') }}</p>
                                    @endif
                                    @if($promoCode->max_discount)
                                        <p class="text-xs text-gray-500">Max: Rp{{ number_format($promoCode->max_discount, 0, ',', '.') }}</p>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm">
                                    <p class="text-gray-900">{{ $promoCode->valid_from->format('d M Y') }}</p>
                                    <p class="text-gray-500">{{ $promoCode->valid_until->format('d M Y') }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm">
                                    <p class="text-gray-900">{{ $promoCode->usage_count }}</p>
                                    @if($promoCode->usage_limit)
                                        <p class="text-gray-500">/ {{ $promoCode->usage_limit }}</p>
                                    @else
                                        <p class="text-gray-500">/ ∞</p>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button wire:click="toggleStatus({{ $promoCode->id }})"
                                    class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full transition-colors
                                        {{ $promoCode->is_active && $promoCode->valid_until >= today() ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-red-100 text-red-800 hover:bg-red-200' }}">
                                    {{ $promoCode->is_active && $promoCode->valid_until >= today() ? 'Aktif' : ($promoCode->valid_until < today() ? 'Kedaluwarsa' : 'Tidak Aktif') }}
                                </button>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                <div class="flex items-center justify-end gap-2">
                                    <button wire:click="editPromoCode({{ $promoCode->id }})"
                                        class="text-sky-600 hover:text-sky-900 font-semibold">
                                        Edit
                                    </button>
                                    @if($promoCode->usages()->count() === 0)
                                        <button wire:click="deletePromoCode({{ $promoCode->id }})"
                                            wire:confirm="Apakah Anda yakin ingin menghapus promo code ini?"
                                            class="text-red-600 hover:text-red-900 font-semibold">
                                            Hapus
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-500">
                                    <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                    <p class="text-lg font-semibold">Tidak ada promo code</p>
                                    <p class="text-sm mt-1">Belum ada promo code yang dibuat</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($promoCodes->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $promoCodes->links() }}
            </div>
        @endif
    </div>

    <!-- Modal Form -->
    <x-modal name="promo-code-form-modal" maxWidth="2xl" focusable>
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900 mb-6">
                {{ $promoCodeId ? 'Edit Promo Code' : 'Tambah Promo Code' }}
            </h2>

            <form wire:submit.prevent="savePromoCode" class="space-y-6">
                <!-- Code -->
                <div>
                    <x-input-label for="code" value="Kode Promo" />
                    <x-text-input wire:model="code" id="code" type="text" class="mt-1 block w-full uppercase" placeholder="DISKON50" />
                    <x-input-error :messages="$errors->get('code')" class="mt-2" />
                    <p class="mt-1 text-xs text-gray-500">Kode akan otomatis diubah menjadi huruf besar</p>
                </div>

                <!-- Description -->
                <div>
                    <x-input-label for="description" value="Deskripsi" />
                    <textarea wire:model="description" id="description" rows="3"
                        class="mt-1 block w-full border-gray-300 rounded-xl focus:border-sky-500 focus:ring-sky-500"
                        placeholder="Deskripsi promo code..."></textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <!-- Discount Type & Value -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="discountType" value="Tipe Diskon" />
                        <select wire:model="discountType" id="discountType"
                            class="mt-1 block w-full border-gray-300 rounded-xl focus:border-sky-500 focus:ring-sky-500">
                            <option value="percentage">Persentase (%)</option>
                            <option value="fixed">Nominal (Rp)</option>
                        </select>
                        <x-input-error :messages="$errors->get('discountType')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="discountValue" value="Nilai Diskon" />
                        <x-text-input wire:model="discountValue" id="discountValue" type="number" step="0.01" min="0"
                            class="mt-1 block w-full" placeholder="{{ $discountType === 'percentage' ? '50' : '10000' }}" />
                        <x-input-error :messages="$errors->get('discountValue')" class="mt-2" />
                    </div>
                </div>

                <!-- Min Transaction & Max Discount -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="minTransaction" value="Min. Transaksi (Rp)" />
                        <x-text-input wire:model="minTransaction" id="minTransaction" type="number" step="1000" min="0"
                            class="mt-1 block w-full" placeholder="0" />
                        <x-input-error :messages="$errors->get('minTransaction')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="maxDiscount" value="Max. Diskon (Rp)" />
                        <x-text-input wire:model="maxDiscount" id="maxDiscount" type="number" step="1000" min="0"
                            class="mt-1 block w-full" placeholder="Opsional" />
                        <x-input-error :messages="$errors->get('maxDiscount')" class="mt-2" />
                        <p class="mt-1 text-xs text-gray-500">Hanya untuk tipe persentase</p>
                    </div>
                </div>

                <!-- Usage Limit & Dates -->
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <x-input-label for="usageLimit" value="Batas Penggunaan" />
                        <x-text-input wire:model="usageLimit" id="usageLimit" type="number" min="1"
                            class="mt-1 block w-full" placeholder="∞" />
                        <x-input-error :messages="$errors->get('usageLimit')" class="mt-2" />
                        <p class="mt-1 text-xs text-gray-500">Kosongkan untuk unlimited</p>
                    </div>
                    <div>
                        <x-input-label for="validFrom" value="Tanggal Mulai" />
                        <x-text-input wire:model="validFrom" id="validFrom" type="date"
                            class="mt-1 block w-full" />
                        <x-input-error :messages="$errors->get('validFrom')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="validUntil" value="Tanggal Berakhir" />
                        <x-text-input wire:model="validUntil" id="validUntil" type="date"
                            class="mt-1 block w-full" />
                        <x-input-error :messages="$errors->get('validUntil')" class="mt-2" />
                    </div>
                </div>

                <!-- Is Active -->
                <div class="flex items-center">
                    <input wire:model="isActive" id="isActive" type="checkbox"
                        class="rounded border-gray-300 text-sky-600 shadow-sm focus:border-sky-500 focus:ring-sky-500">
                    <label for="isActive" class="ml-2 text-sm text-gray-600">Aktif</label>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-end gap-3">
                    <x-secondary-button type="button" @click="$dispatch('close-modal', 'promo-code-form-modal')">
                        Batal
                    </x-secondary-button>
                    <x-primary-button type="submit">
                        {{ $promoCodeId ? 'Simpan Perubahan' : 'Tambah Promo Code' }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </x-modal>

    <!-- Notification Alert -->
    <x-alert />
</div>
