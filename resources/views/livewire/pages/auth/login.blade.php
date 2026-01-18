<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        // Redirect based on user role
        $user = auth()->user();
        
        $defaultRoute = match ($user->role) {
            'admin' => route('admin.dashboard', absolute: false),
            'staff' => route('staff.dashboard', absolute: false),
            'customer' => route('dashboard', absolute: false),
            default => route('dashboard', absolute: false),
        };

        $this->redirectIntended(default: $defaultRoute, navigate: true);
    }
}; ?>

<div>
    <!-- Header -->
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-2">Selamat Datang Kembali!</h2>
        <p class="text-gray-600">Masuk ke akun Anda untuk memesan pencucian.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form wire:submit="login" class="space-y-6">
        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="Email atau Telepon" />
            <x-text-input wire:model="form.email" id="email" type="email" name="email"
                placeholder="Masukkan email atau telepon Anda" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" value="Password" />
            <x-text-input wire:model="form.password" id="password" type="password" name="password"
                placeholder="Masukkan password Anda" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between">
            <label for="remember" class="inline-flex items-center cursor-pointer group">
                <input wire:model="form.remember" id="remember" type="checkbox"
                    class="rounded-md border-gray-300 text-sky-600 shadow-sm focus:ring-sky-500 transition-colors cursor-pointer"
                    name="remember">
                <span class="ms-2 text-sm text-gray-600 group-hover:text-gray-900 transition-colors">Ingat Saya</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm font-semibold text-sky-600 hover:text-sky-700 transition-colors"
                    href="{{ route('password.request') }}" wire:navigate>
                    Lupa Password?
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="space-y-4">
            <x-primary-button class="w-full justify-center py-3 text-base">
                Masuk
            </x-primary-button>

            <!-- Register Link -->
            <p class="text-center text-sm text-gray-600">
                Belum punya akun?
                <a href="{{ route('register') }}" wire:navigate
                    class="font-semibold text-sky-600 hover:text-sky-700 transition-colors">
                    Daftar Sekarang
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

    <!-- Social Login (Optional) -->
    <div class="text-center">
        <a href="{{ route('home') }}" wire:navigate class="text-sm text-gray-600 hover:text-gray-900 transition-colors">
            ← Kembali ke Beranda
        </a>
    </div>
</div>
