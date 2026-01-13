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
            <form id="registerForm" method="POST" action="{{ url('/register') }}" class="auth-form"> 
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