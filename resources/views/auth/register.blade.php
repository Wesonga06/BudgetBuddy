<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Buddy - Register</title>

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="auth-page">
    <div class="auth-container">
        <!-- Image side -->
        <div class="auth-image-side"></div>

        <!-- Form side -->
        <div class="auth-form-side">
            <h1 class="logo">Budget Buddy</h1>
            <h2>Create Account</h2>
            <p>Start your journey to financial freedom.</p>

            <!-- Form -->
            <form method="POST" action="{{ route('register') }}" class="auth-form">
                @csrf

                <!-- First & Last Name -->
                <div class="form-group row">
                    <div class="form-group-half">
                        <input 
                            type="text" 
                            name="first_name" 
                            id="firstName" 
                            placeholder="First Name" 
                            value="{{ old('first_name') }}" 
                            required
                        >
                        @error('first_name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group-half">
                        <input 
                            type="text" 
                            name="last_name" 
                            id="lastName" 
                            placeholder="Last Name" 
                            value="{{ old('last_name') }}" 
                            required
                        >
                        @error('last_name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        placeholder="Email Address" 
                        value="{{ old('email') }}" 
                        required
                    >
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Phone -->
                <div class="form-group">
                    <input 
                        type="tel" 
                        name="phone" 
                        id="phone" 
                        placeholder="Phone (e.g., 07xx-xxx-xxx)" 
                        value="{{ old('phone') }}"
                    >
                    @error('phone')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password & Confirm -->
                <div class="form-group row">
                    <div class="form-group-half">
                        <input 
                            type="password" 
                            name="password" 
                            id="password" 
                            placeholder="Password" 
                            required
                        >
                    </div>
                    <div class="form-group-half">
                        <input 
                            type="password" 
                            name="password_confirmation" 
                            id="confirmPassword" 
                            placeholder="Confirm" 
                            required
                        >
                    </div>
                </div>
                <small class="error-message" id="pwdError">
                    @error('password')
                        {{ $message }}
                    @enderror
                </small>

                <!-- Submit -->
                <button type="submit" class="btn btn-primary" style="width: 100%;">
                    Sign Up
                </button>
            </form>

            <!-- Footer links -->
            <div class="auth-footer-extended">
                <p>Member already? 
                    <a href="{{ route('login') }}" style="color: var(--primary-color); font-weight:bold;">
                        Login!
                    </a>
                </p>
                <div class="social-icons">
                    <a href="#" class="social-circle"><i class="fab fa-google"></i></a>
                    <a href="#" class="social-circle"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-circle"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Client-side password validation -->
    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            const pwd = document.getElementById('password');
            const confirm = document.getElementById('confirmPassword');
            const error = document.getElementById('pwdError');

            error.textContent = '';

            if (pwd.value.length < 6) {
                pwd.classList.add('is-invalid');
                error.textContent = "Password must be at least 6 characters";
                e.preventDefault();
                return;
            }
            if (pwd.value !== confirm.value) {
                confirm.classList.add('is-invalid');
                error.textContent = "Passwords do not match";
                e.preventDefault();
                return;
            }

            // Clear any previous errors
            pwd.classList.remove('is-invalid');
            confirm.classList.remove('is-invalid');
        });
    </script>
</body>
</html>
