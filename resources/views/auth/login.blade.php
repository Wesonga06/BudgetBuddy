<x-guest-layout>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <div class="auth-page">
        <div class="auth-container">
            <div class="auth-image-side"></div>

            <div class="auth-form-side">
                <a href="/" class="logo" style="margin-bottom: 10px; display: block; text-decoration: none; color: var(--primary-color);">
                    Budget Buddy
                </a>
                
                <h2>Welcome Back</h2>
                <p>Please login to your account to continue.</p>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="auth-form">
                    @csrf

                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" :value="old('email')" required autofocus autocomplete="username" 
                               placeholder="john@example.com">
                        <x-input-error :messages="$errors->get('email')" class="error-message" />
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" required autocomplete="current-password" 
                               placeholder="••••••••">
                        <x-input-error :messages="$errors->get('password')" class="error-message" />
                    </div>

                    <div class="form-group" style="display: flex; justify-content: space-between; align-items: center; margin-top: 10px; margin-bottom: 20px;">
                        
                        <label for="remember_me" style="display: flex; align-items: center; cursor: pointer; margin-bottom: 0;">
                            <input id="remember_me" type="checkbox" name="remember" style="width: auto; margin-right: 8px;">
                            <span style="font-size: 0.9rem; color: #666;">Remember me</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" style="font-size: 0.9rem; color: var(--primary-color); text-decoration: none; font-weight: 500;">
                                Forgot Password?
                            </a>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary" style="width: 100%;">
                        Log In
                    </button>
                </form>

                <div class="auth-footer-extended">
                    <p>Don't have an account? <a href="{{ route('register') }}" style="color: var(--primary-color); font-weight: bold;">Sign Up</a></p>
                    
                    <div class="social-icons">
                        <a href="#" class="social-circle"><i class="fab fa-google"></i></a>
                        <a href="#" class="social-circle"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-circle"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>