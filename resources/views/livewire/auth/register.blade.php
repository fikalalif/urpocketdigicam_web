<?php
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public bool $isLoading = false;

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $this->isLoading = true;
        
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        $this->isLoading = false;
        
        $this->redirectIntended(route('dashboard', absolute: false), navigate: true);
    }
}; 
?>

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-50 via-blue-50 to-gray-100 py-12 px-4">
    <div class="w-full max-w-md">
        <!-- Main Card -->
        <div class="bg-white/95 backdrop-blur-sm rounded-2xl shadow-2xl border border-white/20 p-8 space-y-8 relative overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 bg-gradient-to-br from-blue-600/5 via-transparent to-blue-600/5"></div>
            <div class="absolute -top-24 -right-24 w-48 h-48 bg-blue-600/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -left-24 w-48 h-48 bg-blue-600/10 rounded-full"></div>
            
            <!-- Content -->
            <div class="relative z-10">
                <!-- Header -->
                <div class="text-center mb-8">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-blue-600 to-blue-700 rounded-2xl shadow-lg mb-6 transform hover:scale-105 transition-transform duration-300">
                        <img src="{{ asset('images/cam.jpg') }}" alt="URPOCKETDIGICAM Logo" class="w-12 h-12 rounded-lg object-cover">
                    </div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2 tracking-tight">{{ __('Create Account') }}</h1>
                    <p class="text-gray-600 text-lg">{{ __('Join URPOCKETDIGICAM today') }}</p>
                    <div class="w-16 h-1 bg-gradient-to-r from-blue-600 to-blue-700 rounded-full mx-auto mt-4"></div>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-6" :status="session('status')" />

                <!-- Registration Form -->
                <form wire:submit="register" class="space-y-6">
                    <!-- Name Field -->
                    <div class="group">
                        <flux:input 
                            wire:model="name" 
                            :label="__('Full Name')" 
                            type="text" 
                            required 
                            autofocus 
                            autocomplete="name"
                            :placeholder="__('Enter your full name')"
                            class="w-full px-4 py-4 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 transition-all duration-300 text-gray-900 placeholder-gray-500 bg-gray-50/50 hover:bg-white" 
                        />
                    </div>

                    <!-- Email Field -->
                    <div class="group">
                        <flux:input 
                            wire:model="email" 
                            :label="__('Email Address')" 
                            type="email" 
                            required 
                            autocomplete="email"
                            placeholder="you@example.com"
                            class="w-full px-4 py-4 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 transition-all duration-300 text-gray-900 placeholder-gray-500 bg-gray-50/50 hover:bg-white" 
                        />
                    </div>

                    <!-- Password Field -->
                    <div class="group">
                        <flux:input 
                            wire:model="password" 
                            :label="__('Password')" 
                            type="password" 
                            required
                            autocomplete="new-password" 
                            :placeholder="__('Create a strong password')" 
                            viewable
                            class="w-full px-4 py-4 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 transition-all duration-300 text-gray-900 placeholder-gray-500 bg-gray-50/50 hover:bg-white" 
                        />
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="group">
                        <flux:input 
                            wire:model="password_confirmation" 
                            :label="__('Confirm Password')" 
                            type="password" 
                            required
                            autocomplete="new-password" 
                            :placeholder="__('Confirm your password')" 
                            viewable
                            class="w-full px-4 py-4 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/20 transition-all duration-300 text-gray-900 placeholder-gray-500 bg-gray-50/50 hover:bg-white" 
                        />
                    </div>

                    <!-- Terms and Privacy -->
                    <div class="flex items-start space-x-3 p-4 bg-blue-50/50 rounded-xl border border-blue-100">
                        <input type="checkbox" required class="mt-1 w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <p class="text-sm text-gray-700 leading-relaxed">
                            {{ __('I agree to the') }} 
                            <a href="#" class="text-blue-600 hover:text-blue-700 font-medium hover:underline">{{ __('Terms of Service') }}</a> 
                            {{ __('and') }} 
                            <a href="#" class="text-blue-600 hover:text-blue-700 font-medium hover:underline">{{ __('Privacy Policy') }}</a>
                        </p>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-2">
                        <flux:button 
                            type="submit" 
                            variant="primary"
                            :disabled="$isLoading"
                            class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-4 px-6 rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 focus:ring-4 focus:ring-blue-500/50 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none"
                        >
                            <div class="flex items-center justify-center space-x-2">
                                @if($isLoading)
                                    <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    <span>{{ __('Creating Account...') }}</span>
                                @else
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                    </svg>
                                    <span>{{ __('Create Account') }}</span>
                                @endif
                            </div>
                        </flux:button>
                    </div>
                </form>

                <!-- Divider -->
                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-gray-500 font-medium">{{ __('Already have an account?') }}</span>
                    </div>
                </div>

                <!-- Login Link -->
                <div class="text-center">
                    <a href="{{ route('login') }}" 
                       class="inline-flex items-center space-x-2 text-blue-600 hover:text-blue-700 font-semibold text-lg transition-colors duration-200 hover:underline decoration-2 underline-offset-4">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013 3v1"></path>
                        </svg>
                        <span>{{ __('Sign in to your account') }}</span>
                    </a>
                </div>

                <!-- Security Badge -->
                <div class="mt-8 flex items-center justify-center space-x-2 text-sm text-gray-500">
                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.031 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                    <span>{{ __('Your data is secure and encrypted') }}</span>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8 text-sm text-gray-600">
            <p>{{ __('© 2024 URPOCKETDIGICAM. Professional Camera Equipment.') }}</p>
        </div>
    </div>
</div>
