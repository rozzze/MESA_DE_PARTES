<?php

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();
        $this->ensureIsNotRateLimited();

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }
}; ?>

<div class="min-h-screen flex items-center justify-center p-4 relative">
    <div class="relative w-full max-w-md z-10">
        <div class="bg-gradient-to-b from-white/15 to-white/8 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 p-8">

            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-[#B88900] mb-2">Mesa de Partes Digital</h1>
                <p class="text-gray-700 text-sm leading-relaxed">Instituto de Educación Superior Tecnológico Público<br>"Pedro P. Díaz"</p>
            </div>

            <x-auth-session-status class="mb-6 text-[#0D0D0D]" :status="session('status')" />

            <form wire:submit="login" class="space-y-6">
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-medium text-[#0D0D0D]">
                        Correo Electrónico
                    </label>
                    <div class="relative">
                        <input
                            wire:model="email"
                            id="email"
                            type="email"
                            required
                            autofocus
                            autocomplete="email"
                            placeholder="usuario@gmail.com"
                            class="w-full px-4 py-3 bg-white/10 backdrop-blur-sm border border-[#0D0D0D] rounded-xl text-[#0D0D0D] placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#F2C84B] focus:border-[#F2C84B] transition-all duration-300"
                        />
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <svg class="h-5 w-5 text-[#F2C84B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                            </svg>
                        </div>
                    </div>
                    @error('email') <p class="text-sm text-[#F20519]">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-2">
                    <label for="password" class="block text-sm font-medium text-[#0D0D0D]">
                        Contraseña
                    </label>
                    <div class="relative">
                        <input
                            wire:model="password"
                            id="password"
                            type="password"
                            required
                            autocomplete="current-password"
                            placeholder="••••••••"
                            class="w-full px-4 py-3 bg-white/10 backdrop-blur-sm border border-[#0D0D0D] rounded-xl text-[#0D0D0D] placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-[#F2C84B] focus:border-[#F2C84B] transition-all duration-300"
                        />
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <svg class="h-5 w-5 text-[#F2C84B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                    </div>
                    @error('password') <p class="text-sm text-[#F20519]">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input
                            wire:model="remember"
                            type="checkbox"
                            class="w-4 h-4 text-[#F2C84B] bg-white/10 border-white/30 rounded focus:ring-[#F2C84B] focus:ring-2"
                        />
                        <span class="ml-2 text-sm text-gray-700">Recordarme</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                           class="text-sm text-[#0477BF] hover:text-[#002D64] transition-colors duration-200"
                           wire:navigate>
                            ¿Olvidaste tu contraseña?
                        </a>
                    @endif
                </div>

                <button
                    type="submit"
                    class="w-full bg-gradient-to-r from-[#F2C84B] to-[#B88900] hover:from-[#B88900] hover:to-[#F2C84B] text-[#0D0D0D] font-semibold py-3 px-4 rounded-xl shadow-lg transform hover:scale-105 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-[#F2C84B]/50"
                >
                    <span class="flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #0D0D0D;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        Iniciar Sesión
                    </span>
                </button>
            </form>

            @if (Route::has('register'))
                <div class="mt-6 text-center">
                    <p class="text-gray-700 text-sm">
                        ¿No tienes una cuenta?
                        <a href="{{ route('register') }}"
                           class="text-[#0477BF] hover:text-[#002D64] font-medium transition-colors duration-200"
                           wire:navigate>
                            Regístrate aquí
                        </a>
                    </p>
                </div>
            @endif
        </div>

        <div class="mt-8 text-center">
            <p class="text-gray-500 text-xs">
                ©️ 2025 Instituto de Educación Superior Tecnológico Público "Pedro P. Díaz"
            </p>
            <p class="text-gray-400 text-xs mt-1">
                Todos los derechos reservados
            </p>
        </div>
    </div>
</div>