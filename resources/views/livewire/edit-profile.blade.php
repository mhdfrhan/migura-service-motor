<div class="min-h-screen bg-gray-100 py-8">
    <x-container>
        <div class="max-w-md mx-auto">
            <!-- Card -->
            <div class="bg-white rounded-3xl shadow-sm p-8">
                <!-- Header -->
                <div class="flex items-center gap-4 mb-8">
                    <a wire:navigate href="{{ route('dashboard') }}"
                        class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-gray-100 transition-colors">
                        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </a>
                    <h1 class="text-xl font-bold text-gray-900">Edit Profil</h1>
                </div>

                <!-- Avatar Section -->
                <div class="flex flex-col items-center mb-8">
                    <div class="relative mb-4">
                        <div class="w-28 h-28 rounded-full overflow-hidden border-4 border-sky-100 shadow-lg">
                            <img src="{{ $this->avatarUrl }}" alt="Avatar" class="w-full h-full object-cover">
                        </div>
                        <label for="avatar-upload"
                            class="absolute bottom-0 right-0 w-8 h-8 bg-sky-500 rounded-full flex items-center justify-center cursor-pointer hover:bg-sky-600 transition-colors shadow-lg">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                            <input type="file" wire:model="avatar" id="avatar-upload" class="hidden"
                                accept="image/*">
                        </label>
                    </div>
                    <label for="avatar-upload"
                        class="px-4 py-2 text-sm font-semibold text-sky-600 hover:text-sky-700 cursor-pointer hover:bg-sky-50 rounded-full transition-colors">
                        Ganti Foto
                    </label>
                    @error('avatar')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Form -->
                <form wire:submit="save" class="space-y-6">
                    <!-- Full Name -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
                        <input type="text" wire:model="name"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:border-sky-500 focus:ring-2 focus:ring-sky-500 focus:ring-opacity-20 transition-all duration-200"
                            placeholder="Masukkan nama lengkap">
                        @error('name')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                        <input type="email" wire:model="email"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:border-sky-500 focus:ring-2 focus:ring-sky-500 focus:ring-opacity-20 transition-all duration-200"
                            placeholder="Masukkan email">
                        @error('email')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Phone Number</label>
                        <input type="text" wire:model="phone"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:border-sky-500 focus:ring-2 focus:ring-sky-500 focus:ring-opacity-20 transition-all duration-200"
                            placeholder="+62 812 3456 7890">
                        @error('phone')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                        <div class="relative">
                            <input type="password" wire:model="password"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:border-sky-500 focus:ring-2 focus:ring-sky-500 focus:ring-opacity-20 transition-all duration-200"
                                placeholder="Masukkan password baru">
                            <button type="button"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                </svg>
                            </button>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah password</p>
                        @error('password')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    @if ($password)
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password</label>
                            <input type="password" wire:model="password_confirmation"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:border-sky-500 focus:ring-2 focus:ring-sky-500 focus:ring-opacity-20 transition-all duration-200"
                                placeholder="Konfirmasi password baru">
                        </div>
                    @endif

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full px-6 py-4 bg-gradient-to-r from-sky-500 to-cyan-500 hover:from-sky-600 hover:to-cyan-600 text-white font-bold rounded-full shadow-lg hover:shadow-xl transition-all duration-200">
                        <span wire:loading.remove wire:target="save">Simpan</span>
                        <span wire:loading wire:target="save">
                            <svg class="animate-spin h-5 w-5 mx-auto" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </span>
                    </button>
                </form>
            </div>
        </div>
    </x-container>
</div>
