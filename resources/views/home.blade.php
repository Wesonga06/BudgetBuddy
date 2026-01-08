<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Buddy - Financial Freedom</title>

    <!-- Your main CSS (make sure style.css is in public/css/) -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <h1 class="logo">Budget Buddy</h1>
            <nav class="main-nav">
                <a href="/login" class="btn btn-secondary">Login</a>
                <a href="/register" class="btn btn-primary">Sign Up</a>
            </nav>
        </div>
    </header>

    <main class="hero-section">
        <div class="container">
            <h2>Your Money, Mastered.</h2>
            <p>Track expenses, lock savings for goals, and achieve financial security with the app that keeps you accountable.</p>
            <a href="/register" class="btn btn-white btn-large" style="background: white; color: var(--primary-color);">Start Saving Free</a>
        </div>
    </main>

    <section class="features-section">
        <div class="container">
            <h3>Why Budget Buddy?</h3>
            <div class="feature-grid">
                <div class="feature-card">
                    <i class="fas fa-chart-pie"></i>
                    <h4>Smart Tracking</h4>
                    <p>Connect MPESA & Bank accounts to see exactly where every shilling goes automatically.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-lock"></i>
                    <h4>Goal Locking</h4>
                    <p>Lock your savings until you reach your goal. No more dipping into funds early!</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-bell"></i>
                    <h4>Daily Nudges</h4>
                    <p>Get friendly reminders when you're about to overspend in a specific category.</p>
                </div>
            </div>
        </div>
    </section>
</body>
</html>