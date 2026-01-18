<div class="space-y-6">
    <!-- Success Message -->
    @if (session()->has('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-xl flex items-center gap-3">
            <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Menunggu Verifikasi</p>
                    <p class="text-3xl font-bold text-yellow-600 mt-2">{{ $stats['pending'] }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Terverifikasi</p>
                    <p class="text-3xl font-bold text-green-600 mt-2">{{ $stats['verified'] }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Ditolak</p>
                    <p class="text-3xl font-bold text-red-600 mt-2">{{ $stats['rejected'] }}</p>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
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
                    placeholder="Cari booking code, nama, atau email..." class="w-full" />
            </div>

            <!-- Filter Status -->
            <div class="sm:w-48">
                <select wire:model.live="filterStatus"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-sky-500 focus:ring-2 focus:ring-sky-500 focus:ring-opacity-20 transition-all duration-200">
                    <option value="all">Semua Status</option>
                    <option value="pending">Menunggu</option>
                    <option value="verified">Terverifikasi</option>
                    <option value="rejected">Ditolak</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Payment Proofs Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Booking</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Customer</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Layanan</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Total</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Upload</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Status</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($paymentProofs as $proof)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">{{ $proof->booking->booking_code }}
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        {{ $proof->booking->booking_date->format('d M Y') }}
                                    </p>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $proof->booking->user->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $proof->booking->user->email }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div>
                                    <p class="text-sm text-gray-900">{{ $proof->booking->servicePackage->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $proof->booking->engineCapacity->name }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <p class="text-sm font-semibold text-gray-900">{{ formatRupiah($proof->amount) }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <p class="text-xs text-gray-500">{{ $proof->created_at->diffForHumans() }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($proof->verification_status === 'pending')
                                    <span
                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Menunggu
                                    </span>
                                @elseif($proof->verification_status === 'verified')
                                    <span
                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Terverifikasi
                                    </span>
                                @else
                                    <span
                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Ditolak
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <button wire:click="viewProof({{ $proof->id }})"
                                    class="text-sky-600 hover:text-sky-900 font-semibold">
                                    Lihat Detail
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-500">
                                    <svg class="w-16 h-16 mb-4" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <p class="text-lg font-semibold">Tidak ada data pembayaran</p>
                                    <p class="text-sm mt-1">Belum ada bukti pembayaran yang diupload</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($paymentProofs->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $paymentProofs->links() }}
            </div>
        @endif
    </div>

    <!-- Modal -->
    <x-modal name="payment-detail-modal" maxWidth="4xl" :show="$showModal" focusable>
        @if ($selectedProof)
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900 mb-6">
                    Detail Pembayaran
                </h2>

                <div class="space-y-6">
                    <!-- Booking Info -->
                    <div class="bg-gray-50 rounded-xl p-6">
                        <h4 class="font-semibold text-gray-900 mb-4">Informasi Booking</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600">Kode Booking</p>
                                <p class="font-semibold text-gray-900">{{ $selectedProof->booking->booking_code }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Tanggal Booking</p>
                                <p class="font-semibold text-gray-900">
                                    {{ $selectedProof->booking->booking_date->format('d M Y, H:i') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Customer</p>
                                <p class="font-semibold text-gray-900">{{ $selectedProof->booking->user->name }}</p>
                                <p class="text-xs text-gray-500">{{ $selectedProof->booking->user->email }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Layanan</p>
                                <p class="font-semibold text-gray-900">
                                    {{ $selectedProof->booking->servicePackage->name }}</p>
                                <p class="text-xs text-gray-500">{{ $selectedProof->booking->engineCapacity->name }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Total Pembayaran</p>
                                <p class="text-2xl font-bold text-sky-600">{{ formatRupiah($selectedProof->amount) }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Metode Pembayaran</p>
                                <p class="font-semibold text-gray-900">
                                    {{ ucfirst($selectedProof->payment_method) }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Proof Image -->
                    <div>
                        <h4 class="font-semibold text-gray-900 mb-4">Bukti Pembayaran</h4>
                        <div class="bg-gray-100 rounded-xl p-4">
                            <img src="{{ $selectedProof->proof_image_url }}" alt="Bukti Pembayaran"
                                class="rounded-lg shadow-lg h-[400px] object-cover">
                        </div>
                    </div>

                    <!-- Rejection Reason (if rejected) -->
                    @if ($selectedProof->verification_status === 'rejected' && $selectedProof->rejection_reason)
                        <div class="bg-red-50 border border-red-200 rounded-xl p-4">
                            <h4 class="font-semibold text-red-900 mb-2">Alasan Penolakan</h4>
                            <p class="text-red-800">{{ $selectedProof->rejection_reason }}</p>
                        </div>
                    @endif

                    <!-- Rejection Form (if pending) -->
                    @if ($selectedProof->verification_status === 'pending')
                        <div>
                            <x-input-label for="rejectionReason"
                                value="Alasan Penolakan (Opsional, hanya jika ditolak)" />
                            <textarea wire:model="rejectionReason" id="rejectionReason" rows="3"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-sky-500 focus:ring-2 focus:ring-sky-500 focus:ring-opacity-20 transition-all duration-200"
                                placeholder="Masukkan alasan penolakan jika pembayaran ditolak..."></textarea>
                            <x-input-error :messages="$errors->get('rejectionReason')" class="mt-2" />
                        </div>
                    @endif
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    @if ($selectedProof->verification_status === 'pending')
                        <x-secondary-button type="button" @click="$dispatch('close-modal', 'payment-detail-modal')">
                            Batal
                        </x-secondary-button>

                        <x-danger-button type="button" wire:click="rejectPayment">
                            Tolak Pembayaran
                        </x-danger-button>

                        <x-primary-button type="button" wire:click="approvePayment"
                            class="bg-gradient-to-r from-green-500 to-emerald-600 hover:shadow-lg hover:shadow-green-500/30">
                            Verifikasi Pembayaran
                        </x-primary-button>
                    @else
                        <x-secondary-button type="button" @click="$dispatch('close-modal', 'payment-detail-modal')">
                            Tutup
                        </x-secondary-button>
                    @endif
                </div>
            </div>
        @endif
    </x-modal>
</div>
