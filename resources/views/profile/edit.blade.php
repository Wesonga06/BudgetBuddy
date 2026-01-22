<x-app-layout>
    <div class="container" style="padding-top: 30px; max-width: 800px;">
        
        @if (session('success'))
            <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
                {{ session('success') }}
            </div>
        @endif

        <div class="card" style="margin-bottom: 30px;">
            <div style="border-bottom: 1px solid #eee; padding-bottom: 15px; margin-bottom: 20px;">
                <h3 style="color: var(--primary-color);"><i class="fas fa-user-circle"></i> Profile Information</h3>
                <p style="color: #666; font-size: 0.9rem;">Update your account's profile information and email address.</p>
            </div>

            <form method="post" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')

                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="name" style="display: block; margin-bottom: 8px; font-weight: 500;">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
                           required autofocus autocomplete="name"
                           style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                    @error('name') <span style="color: var(--error); font-size: 0.85rem;">{{ $message }}</span> @enderror
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="email" style="display: block; margin-bottom: 8px; font-weight: 500;">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
                           required autocomplete="username"
                           style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                    @error('email') <span style="color: var(--error); font-size: 0.85rem;">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="btn btn-primary" style="background: var(--primary-color); color: white; padding: 10px 25px; border: none; border-radius: 8px; cursor: pointer;">
                    Save Changes
                </button>
            </form>
        </div>

        <div class="card">
            <div style="border-bottom: 1px solid #eee; padding-bottom: 15px; margin-bottom: 20px;">
                <h3 style="color: var(--primary-color);"><i class="fas fa-lock"></i> Update Password</h3>
                <p style="color: #666; font-size: 0.9rem;">Ensure your account is using a long, random password to stay secure.</p>
            </div>

            <form method="post" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')

                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="current_password" style="display: block; margin-bottom: 8px; font-weight: 500;">Current Password</label>
                    <input type="password" name="current_password" id="current_password" autocomplete="current-password"
                           style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                    @error('current_password') <span style="color: var(--error); font-size: 0.85rem;">{{ $message }}</span> @enderror
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="password" style="display: block; margin-bottom: 8px; font-weight: 500;">New Password</label>
                    <input type="password" name="password" id="password" autocomplete="new-password"
                           style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                    @error('password') <span style="color: var(--error); font-size: 0.85rem;">{{ $message }}</span> @enderror
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="password_confirmation" style="display: block; margin-bottom: 8px; font-weight: 500;">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" autocomplete="new-password"
                           style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                    @error('password_confirmation') <span style="color: var(--error); font-size: 0.85rem;">{{ $message }}</span> @enderror
                </div>

                <button type="submit" class="btn btn-primary" style="background: var(--dark-color); color: white; padding: 10px 25px; border: none; border-radius: 8px; cursor: pointer;">
                    Update Password
                </button>
            </form>
        </div>

    </div>
</x-app-layout>