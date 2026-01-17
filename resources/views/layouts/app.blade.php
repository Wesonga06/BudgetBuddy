<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Budget Buddy') }}</title>

        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="dashboard-page">
        <div class="min-h-screen">
            <header class="header dashboard-header">
                <div class="container">
                    <a href="{{ route('dashboard') }}" class="logo">Budget Buddy</a>
                    
                    <nav class="main-nav">
                        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                        <a href="{{ route('transactions') }}" class="{{ request()->routeIs('transactions') ? 'active' : '' }}">Transactions</a>
                        <a href="{{ route('goals') }}" class="{{ request()->routeIs('goals') ? 'active' : '' }}">Goals</a>
                    </nav>

                    <div class="user-info" style="display: flex; align-items: center; gap: 15px;">
                        <span>Welcome, <strong>{{ Auth::user()->name }}</strong></span>
                        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-small btn-secondary">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            @isset($header)
                <div class="container" style="margin-top: 20px;">
                    {{ $header }}
                </div>
            @endisset

            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
