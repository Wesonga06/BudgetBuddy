<x-guest-layout>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <div class="auth-page">
        <div class="auth-container">
            <div class="auth-image-side"></div>

            <div class="auth-form-side">
                <a href="/" class="logo" style="margin-bottom: 10px; display: block;">Budget Buddy</a>
                <h2>Create Account</h2>
                <p>Start tracking your M-Pesa and savings today.</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe">
                        <x-input-error :messages="$errors->get('name')" class="error-message" />
                    </div>

                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="john@example.com">
                        <x-input-error :messages="$errors->get('email')" class="error-message" />
                    </div>

                    <div class="row">
                        <div class="form-group form-group-half">
                            <label>Password</label>
                            <input type="password" name="password" required autocomplete="new-password" placeholder="••••••••">
                        </div>
                        <div class="form-group form-group-half">
                            <label>Confirm Password</label>
                            <input type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••">
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="error-message" style="margin-top: -10px; margin-bottom: 10px;" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="error-message" />

                    <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 10px;">
                        Create Account
                    </button>
                </form>

                <div class="auth-footer-extended">
                    <p>Already have an account? <a href="{{ route('login') }}" style="color: var(--primary-color); font-weight: 600;">Log In</a></p>
                    
                    <div class="social-icons">
                        <a href="#" class="social-circle"><i class="fab fa-google"></i></a>
                        <a href="#" class="social-circle"><i class="fab fa-facebook-f"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>