<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Buddy - Login</title>

    <!-- Your main stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="auth-page">
    <div class="auth-container">
        <!-- Left side - image -->
        <div class="auth-image-side"></div>

        <!-- Right side - form -->
        <div class="auth-form-side">
            <h1 class="logo">Budget Buddy</h1>
            <h2>Welcome Back</h2>
            <p>Login to manage your savings.</p>

            <!-- Laravel form with CSRF protection -->
            <form method="POST" action="{{ route('login') }}" class="auth-form">
                @csrf

                <!-- Email -->
                <div class="form-group">
                    <input 
                        type="email" 
                        name="email" 
                        id="loginEmail" 
                        placeholder="Email Address" 
                        value="{{ old('email') }}" 
                        required 
                        autofocus
                        autocomplete="email"
                    >
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <input 
                        type="password" 
                        name="password" 
                        id="loginPassword" 
                        placeholder="Password" 
                        required 
                        autocomplete="current-password"
                    >
                    @error('password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary" style="width: 100%;">
                    Log In
                </button>
            </form>

            <!-- Links & social buttons -->
            <div class="auth-footer-extended">
                <p>Don't have an account? 
                    <a href="{{ route('register') }}" style="color: var(--primary-color); font-weight:bold;">
                        Sign up!
                    </a>
                </p>
                <div class="social-icons">
                    <a href="#" class="social-circle" title="Google"><i class="fab fa-google"></i></a>
                    <a href="#" class="social-circle" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-circle" title="Twitter"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional: Keep your client-side validation if you want extra feedback -->
    <script>
        function validateLoginForm() {
            const email = document.getElementById('loginEmail');
            const password = document.getElementById('loginPassword');
            let isValid = true;

            if (!email.value.includes('@')) {
                email.classList.add('is-invalid');
                isValid = false;
            } else {
                email.classList.remove('is-invalid');
                email.classList.add('is-valid');
            }

            if (password.value === '') {
                password.classList.add('is-invalid');
                isValid = false;
            } else {
                password.classList.remove('is-invalid');
                password.classList.add('is-valid');
            }

            return isValid;
        }

        // Optional: attach to form
        document.getElementById('loginForm')?.addEventListener('submit', function(e) {
            if (!validateLoginForm()) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>