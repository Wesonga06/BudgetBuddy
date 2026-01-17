<x-guest-layout>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <div class="auth-page">
        <div class="auth-image-side"></div>

        <div class="auth-form-side">
            <div class="auth-form-container" style="width: 100%; max-width: 400px;">
                
                <div style="text-align: center; margin-bottom: 2rem;">
                    <h1 style="color: var(--primary-color); font-size: 2rem; font-weight: bold;">Budget Buddy</h1>
                    <p style="color: #666;">Welcome back! Please login.</p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="email" style="display: block; margin-bottom: 5px; color: #333;">Email</label>
                        <input id="email" type="email" name="email" :value="old('email')" required autofocus 
                               style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <label for="password" style="display: block; margin-bottom: 5px; color: #333;">Password</label>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                               style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" name="remember" style="border-radius: 4px; border-color: #ddd;">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4" style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px;">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <button type="submit" style="background-color: var(--primary-color); color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
                            {{ __('Log in') }}
                        </button>
                    </div>
                    
                    <div style="margin-top: 20px; text-align: center;">
                        <p>Don't have an account? <a href="{{ route('register') }}" style="color: var(--primary-color);">Register here</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
