<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Buddy - Dashboard</title>
    <!--Logo -->
    <h1 class="logo">
    <img src="{{ asset('images/BB.png') }}" alt="Budget Buddy" style="height: 40px;">
    </h1>

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="dashboard-page">
    <header class="header dashboard-header">
        <div class="container">
            <h1 class="logo">Budget Buddy</h1>
            <nav class="main-nav">
                <a href="/dashboard" class="active" style="color: var(--primary-color); border-bottom: 2px solid var(--primary-color);">Dashboard</a>
                <a href="#" style="text-decoration: none; color: #666;">Transactions</a>
                <a href="#" style="text-decoration: none; color: #666;">Goals</a>
            </nav>
            <div class="user-info" style="display: flex; align-items: center; gap: 15px;">
                <span>Welcome, <strong>Alex</strong></span>
                <i class="fas fa-bell" style="cursor: pointer;"></i>
                <a href="/" style="color: var(--error);"><i class="fas fa-sign-out-alt"></i></a>
            </div>
        </div>
    </header>

    <main class="dashboard-main container">
        
        <section class="card">
            <div class="card-header">
                <h3>My Accounts</h3>
                <button class="btn btn-primary btn-small"><i class="fas fa-plus"></i> Add</button>
            </div>
            <div class="account-grid">
                <div class="account-card mpesa">
                    <i class="fas fa-mobile-alt"></i>
                    <h4>MPESA</h4>
                    <p>sh. 4,500</p>
                    <span class="status connected">Active</span>
                </div>
                <div class="account-card bank">
                    <i class="fas fa-university"></i>
                    <h4>KCB Bank</h4>
                    <p>sh. 120,000</p>
                    <span class="status connected">Active</span>
                </div>
            </div>

            <div style="background: #fff9e6; padding: 15px; border-left: 4px solid var(--warning); border-radius: 4px; display: flex; align-items: center; gap: 15px; margin-top: 20px;">
                <i class="fas fa-lightbulb" style="color: var(--warning); font-size: 1.5rem;"></i>
                <div>
                    <h4 style="color: var(--warning); margin-bottom: 2px;">Smart Nudge</h4>
                    <p style="font-size: 0.9rem; margin: 0;">You've spent 80% of your "Eating Out" budget. Try cooking at home!</p>
                </div>
            </div>
        </section>

        <section class="card">
            <div class="card-header">
                <h3><i class="fas fa-lock"></i> Goal-Locked Savings</h3>
            </div>
            
            <div class="goal-item" style="display: flex; justify-content: space-between; padding: 15px 0; border-bottom: 1px solid #eee;">
                <div>
                    <h4>Emergency Fund</h4>
                    <div style="width: 200px; height: 8px; background: #eee; border-radius: 4px; margin-top: 5px;">
                        <div style="width: 45%; height: 100%; background: var(--success); border-radius: 4px;"></div>
                    </div>
                    <small>sh. 45,000 / 100,000</small>
                </div>
                <span style="color: var(--error); font-weight: bold;"><i class="fas fa-lock"></i> Locked</span>
            </div>

            <div class="goal-item" style="display: flex; justify-content: space-between; padding: 15px 0;">
                <div>
                    <h4>New Laptop</h4>
                    <div style="width: 200px; height: 8px; background: #eee; border-radius: 4px; margin-top: 5px;">
                        <div style="width: 75%; height: 100%; background: var(--primary-color); border-radius: 4px;"></div>
                    </div>
                    <small>sh. 75,000 / 100,000</small>
                </div>
                <span style="color: var(--error); font-weight: bold;"><i class="fas fa-lock"></i> Locked</span>
            </div>
        </section>

    </main>
</body>
</html>