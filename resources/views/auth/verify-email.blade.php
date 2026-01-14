<x-guest-layout>
    <link rel="stylesheet" href="{{ asset('public/css/style.css') }}">

    <div class="auth-page">
        <div class="auth-container">
            <div class="auth-image-side"></div>

            <div class="auth-form-side">
                <h1 class="logo">Budget Buddy</h1>
                <h2>Verify Your Email</h2>
                
                <div class="mb-4 text-sm" style="color: #666; margin-bottom: 20px;">
                    {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you?') }}
                </div>

                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 font-medium text-sm" style="color: var(--success); margin-bottom: 20px;">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </div>
                @endif

                <div class="auth-form">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary" style="width: 100%;">
                            {{ __('Resend Verification Email') }}
                        </button>
                    </form>

                    <div style="margin-top: 20px; text-align: center;">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="underline text-sm" style="background: none; border: none; color: var(--primary-color); cursor: pointer; text-decoration: underline;">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>