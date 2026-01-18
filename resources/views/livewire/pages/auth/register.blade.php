<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public string $name = '';
    public string $phone = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public bool $terms = false;

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'terms' => ['accepted'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <!-- Header -->
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-2">Buat Akun Anda</h2>
        <p class="text-gray-600">Mulailah dalam hitungan detik untuk memesan cuci sepeda motor Anda berikutnya.</p>
    </div>

    <form wire:submit="register" class="space-y-5">
        <!-- Name -->
        <div>
            <x-input-label for="name" value="Nama Lengkap" />
            <x-text-input wire:model="name" id="name" type="text" name="name"
                placeholder="Masukkan nama lengkap Anda" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div>
            <x-input-label for="phone" value="Nomor Telepon" />
            <x-text-input wire:model="phone" id="phone" type="tel" name="phone"
                placeholder="Contoh: 081234567890" required autocomplete="tel" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Alamat Email" />
            <x-text-input wire:model="email" id="email" type="email" name="email"
                placeholder="Masukkan alamat email Anda" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" value="Password" />
            <x-text-input wire:model="password" id="password" type="password" name="password"
                placeholder="Masukkan password Anda" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" value="Konfirmasi Password" />
            <x-text-input wire:model="password_confirmation" id="password_confirmation" type="password"
                name="password_confirmation" placeholder="Konfirmasi password Anda" required
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Terms & Privacy -->
        <div>
            <label for="terms" class="inline-flex items-start cursor-pointer group">
                <input wire:model="terms" id="terms" type="checkbox"
                    class="mt-1 rounded-md border-gray-300 text-sky-600 shadow-sm focus:ring-sky-500 transition-colors cursor-pointer"
                    name="terms" required>
                <span class="ms-3 text-sm text-gray-600 group-hover:text-gray-900 transition-colors">
                    Saya setuju dengan
                    <a href="{{ route('terms') }}" target="_blank"
                        class="font-semibold text-sky-600 hover:text-sky-700 transition-colors">Syarat & Ketentuan</a>
                    dan
                    <a href="{{ route('privacy') }}" target="_blank"
                        class="font-semibold text-sky-600 hover:text-sky-700 transition-colors">Kebijakan Privasi</a>.
                </span>
            </label>
            <x-input-error :messages="$errors->get('terms')" class="mt-2" />
        </div>

        <!-- Submit Button -->
        <div class="space-y-4 pt-2">
            <x-primary-button class="w-full justify-center py-3 text-base">
                Daftar Sekarang
            </x-primary-button>

            <!-- Login Link -->
            <p class="text-center text-sm text-gray-600">
                Sudah punya akun?
                <a href="{{ route('login') }}" wire:navigate
                    class="font-semibold text-sky-600 hover:text-sky-700 transition-colors">
                    Masuk
                </a>
            </p>
        </div>
    </form>

    <!-- Divider -->
    <div class="relative my-8">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-200"></div>
        </div>
        <div class="relative flex justify-center text-sm">
            <span class="px-4 bg-white text-gray-500">Atau</span>
        </div>
    </div>

    <!-- Footer Links -->
    <div class="text-center space-y-3">
        <a href="{{ route('home') }}" wire:navigate
            class="text-sm text-gray-600 hover:text-gray-900 transition-colors block">
            ← Kembali ke Beranda
        </a>
        <div class="flex items-center justify-center gap-4 text-xs text-gray-500">
            <span>© {{ date('Y') }} {{ config('app.name') }}</span>
            <span>•</span>
            <a href="#" class="hover:text-gray-900 transition-colors">Tentang Kami</a>
            <span>•</span>
            <a href="#" class="hover:text-gray-900 transition-colors">Kontak</a>
        </div>
    </div>
</div>
