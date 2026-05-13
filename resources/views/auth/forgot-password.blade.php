<x-guest-layout>
    <div class="mb-4 small text-muted text-center">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.') }}
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="alert alert-success border-0 rounded-3 mb-4 small">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email" class="form-label small fw-bold text-muted">Email Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-gradient mb-3">
            Send Reset Link
        </button>

        <div class="auth-footer">
            <a href="{{ route('login') }}"><i class="bi bi-arrow-left me-1"></i> Back to login</a>
        </div>
    </form>
</x-guest-layout>
