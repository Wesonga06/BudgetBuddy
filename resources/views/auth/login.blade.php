<x-guest-layout>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <style>
        .min-h-screen { background: none !important; padding: 0 !important; }
        .w-full { max-width: none !important; }
        .sm\:max-w-md { max-width: none !important; }
        .shadow-md { box-shadow: none !important; }
        .bg-white { background: none !important; }
    </style>

    <div class="auth-page">
        <div class="auth-container">
            <div class="auth-image-side" style="background-image: url('https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?q=80&w=2071&auto=format&fit=crop');"></div>

            <div class="auth-form-side" style="background-color: #0f1115; color: white;">
                <h1 style="color: #3b82f6; font-size: 2.5rem; font-weight: bold; margin-bottom: 5px;">Budget Buddy</h1>
                <h2 style="color: white; margin-bottom: 5px;">Welcome back!</h2>
                <p style="color: #9ca3af; margin-bottom: 30px;">Please login to your account.</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label style="color: white;">Email</label>
                        <input type="email" name="email" :value="old('email')" required autofocus 
                               style="background: #1a1d24; border: 1px solid #3b82f6; color: white;">
                        <x-input-error :messages="$errors->get('email')" class="error-message" />
                    </div>

                    <div class="form-group">
                        <label style="color: white;">Password</label>
                        <input type="password" name="password" required autocomplete="current-password"
                               style="background: #1a1d24; border: 1px solid #3b82f6; color: white;">
                        <x-input-error :messages="$errors->get('password')" class="error-message" />
                    </div>

                    <div style="display: flex; align-items: center; margin-bottom: 20px;">
                        <input id="remember_me" type="checkbox" name="remember" style="margin-right: 10px;">
                        <span style="color: #9ca3af; font-size: 0.9rem;">Remember me</span>
                    </div>

                    <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px; font-weight: bold;">
                        Log in
                    </button>

                    <div style="margin-top: 25px; text-align: center;">
                        <a href="{{ route('password.request') }}" style="color: #9ca3af; font-size: 0.8rem; text-decoration: underline;">
                            Forgot your password?
                        </a>
                    </div>
                </form>

                <div class="auth-footer-extended" style="border-top: 1px solid #333;">
                    <p style="color: #9ca3af;">Don't have an account? 
                        <a href="{{ route('register') }}" style="color: #3b82f6; font-weight: bold;">Register</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>