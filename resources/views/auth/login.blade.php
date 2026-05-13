<x-guest-layout>
    <!-- Session Status -->
    @if (session('status'))
        <div class="alert alert-success border-0 rounded-3 mb-4 small">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label small fw-bold text-muted">Email Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required autofocus autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <div class="d-flex justify-content-between align-items-center mb-1">
                <label for="password" class="form-label small fw-bold text-muted mb-0">Password</label>
                @if (Route::has('password.request'))
                    <a class="small text-decoration-none" href="{{ route('password.request') }}" style="color: #64748b;">
                        Forgot?
                    </a>
                @endif
            </div>
            <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
            <label class="form-check-label small text-muted" for="remember_me">
                Remember this device
            </label>
        </div>

        <button type="submit" class="btn btn-gradient">
            Sign In to Dashboard
        </button>

        <div class="auth-footer">
            Don't have an account? <a href="{{ route('register') }}">Create one here</a>
        </div>
    </form>
</x-guest-layout>
