<x-guest-layout>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <div class="auth-page">
        <div class="auth-container">
            <div class="auth-image-side"></div>

            <div class="auth-form-side">
                <a href="/" class="logo" style="text-decoration: none;">Budget Buddy</a>
                <h2 style="margin-top: 10px;">{{ __('auth.verify_heading') }}</h2>
                
                <div class="mb-4 text-sm" style="color: #666; margin: 20px 0;">
                    {{ __('auth.verify_message') }}
                </div>

                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 font-medium text-sm" style="color: var(--success); margin-bottom: 20px;">
                        {{ __('auth.verify_link_sent') }}
                    </div>
                @endif

                <div class="auth-form">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary" style="width: 100%;">
                            {{ __('auth.resend_button') }}
                        </button>
                    </form>

                    <div style="margin-top: 20px; text-align: center;">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" style="background: none; border: none; color: var(--primary-color); cursor: pointer; text-decoration: underline; font-size: 0.9rem;">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>