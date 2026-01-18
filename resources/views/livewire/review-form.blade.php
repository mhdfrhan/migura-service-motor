<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12">
    <x-container>
        <div class="max-w-3xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <a wire:navigate href="{{ route('my-orders') }}" 
                   class="inline-flex items-center gap-2 text-gray-600 hover:text-sky-600 transition-colors mb-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    <span>Kembali ke Pesanan</span>
                </a>

                <h1 class="text-3xl font-bold text-gray-900 mb-2">
                    {{ $existingReview ? 'Edit Review' : 'Tulis Review' }}
                </h1>
                <p class="text-gray-600">
                    Bagikan pengalaman Anda tentang layanan kami
                </p>
            </div>

            <!-- Booking Info Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-8">
                <div class="flex items-start gap-4">
                    <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-sky-500 to-blue-600 flex items-center justify-center text-white flex-shrink-0">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="font-bold text-gray-900">{{ $booking->servicePackage->name }}</h3>
                            <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">
                                Selesai
                            </span>
                        </div>
                        <p class="text-sm text-gray-600 mb-2">Kode Booking: <span class="font-mono font-bold text-gray-900">{{ $booking->booking_code }}</span></p>
                        <p class="text-sm text-gray-600">Tanggal: {{ \Carbon\Carbon::parse($booking->booking_date)->isoFormat('D MMMM Y') }}</p>
                        @if($booking->staffAssignments->isNotEmpty())
                            <p class="text-sm text-gray-600 mt-1">
                                Petugas: <span class="font-semibold text-gray-900">{{ $booking->staffAssignments->first()->staff->name }}</span>
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Review Form -->
            <form wire:submit="submitReview" class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
                <!-- Rating -->
                <div class="mb-8">
                    <x-input-label value="Rating Layanan *" class="mb-3" />
                    <div class="flex items-center gap-2">
                        @for ($i = 1; $i <= 5; $i++)
                            <button type="button" wire:click="$set('rating', {{ $i }})" 
                                    class="focus:outline-none transition-all transform hover:scale-110">
                                <svg class="w-12 h-12 {{ $rating >= $i ? 'text-yellow-400 fill-current' : 'text-gray-300' }}" 
                                     viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </button>
                        @endfor
                    </div>
                    <p class="text-sm text-gray-600 mt-2">
                        {{ match($rating) {
                            1 => '⭐ Sangat Buruk',
                            2 => '⭐⭐ Buruk',
                            3 => '⭐⭐⭐ Cukup',
                            4 => '⭐⭐⭐⭐ Baik',
                            5 => '⭐⭐⭐⭐⭐ Sangat Baik',
                            default => 'Pilih rating'
                        } }}
                    </p>
                    <x-input-error :messages="$errors->get('rating')" class="mt-2" />
                </div>

                <!-- Comment -->
                <div class="mb-8">
                    <x-input-label for="comment" value="Ceritakan Pengalaman Anda *" class="mb-3" />
                    <textarea wire:model="comment" id="comment" rows="6" 
                              placeholder="Bagaimana pengalaman Anda dengan layanan kami? Apa yang Anda suka atau bisa kami tingkatkan?"
                              class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-sky-500 focus:ring-2 focus:ring-sky-500 focus:ring-opacity-20 transition-all resize-none"></textarea>
                    <div class="flex items-center justify-between mt-2">
                        <p class="text-xs text-gray-500">Minimal 10 karakter, maksimal 500 karakter</p>
                        <p class="text-xs text-gray-500">{{ strlen($comment) }}/500</p>
                    </div>
                    <x-input-error :messages="$errors->get('comment')" class="mt-2" />
                </div>

                <!-- Photos Upload -->
                <div class="mb-8">
                    <x-input-label value="Foto Layanan (Opsional)" class="mb-3" />
                    <p class="text-sm text-gray-600 mb-3">Upload foto hasil cucian atau suasana layanan (maksimal 4 foto, masing-masing 2MB)</p>
                    
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                        @foreach($photos as $index => $photo)
                            <div class="relative group">
                                <img src="{{ $photo->temporaryUrl() }}" alt="Preview" class="w-full h-32 object-cover rounded-xl border-2 border-gray-200">
                                <button type="button" wire:click="removePhoto({{ $index }})" 
                                        class="absolute -top-2 -right-2 w-8 h-8 bg-red-500 text-white rounded-full flex items-center justify-center shadow-lg hover:bg-red-600 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                    </div>

                    @if(count($photos) < 4)
                        <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:bg-gray-50 transition-colors">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                <p class="text-sm text-gray-600 font-medium">Klik untuk upload foto</p>
                                <p class="text-xs text-gray-500 mt-1">PNG, JPG (max. 2MB)</p>
                            </div>
                            <input type="file" wire:model="photos" class="hidden" accept="image/*" multiple>
                        </label>
                    @endif

                    <x-input-error :messages="$errors->get('photos.*')" class="mt-2" />

                    <div wire:loading wire:target="photos" class="mt-3 text-sm text-sky-600 flex items-center gap-2">
                        <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span>Mengupload foto...</span>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex items-center gap-4 pt-6 border-t border-gray-200">
                    <x-secondary-button wire:navigate href="{{ route('my-orders') }}" type="button">
                        Batal
                    </x-secondary-button>
                    
                    <x-primary-button type="submit" wire:loading.attr="disabled" class="flex-1">
                        <span wire:loading.remove wire:target="submitReview">
                            {{ $existingReview ? 'Perbarui Review' : 'Kirim Review' }}
                        </span>
                        <span wire:loading wire:target="submitReview" class="flex items-center justify-center gap-2">
                            <svg class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Mengirim...
                        </span>
                    </x-primary-button>
                </div>
            </form>
        </div>
    </x-container>
</div>
