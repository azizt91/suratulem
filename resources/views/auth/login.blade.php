@extends('layouts.auth')

@section('title', 'Masuk')

@section('content')
<div class="auth-card">
    <h2 class="card-title">Masuk</h2>
    <p class="card-subtitle">Selamat datang kembali! Silakan masuk ke akun Anda.</p>

    <div class="gold-divider">
        <hr><i class="bi bi-diamond-fill"></i><hr>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label for="email">Email</label>
            <div class="input-icon-wrapper">
                <input id="email" type="email"
                       class="form-control @error('email') is-invalid @enderror"
                       name="email" value="{{ old('email') }}"
                       required autocomplete="email" autofocus
                       placeholder="nama@email.com">
                <i class="bi bi-envelope"></i>
            </div>
        </div>

        <div class="form-group">
            <label for="password">
                Password
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-link float-end">Lupa Password?</a>
                @endif
            </label>
            <div class="input-icon-wrapper">
                <input id="password" type="password"
                       class="form-control @error('password') is-invalid @enderror"
                       name="password" required autocomplete="current-password"
                       placeholder="••••••••">
                <i class="bi bi-lock"></i>
            </div>
        </div>

        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember"
                       id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">Ingat saya</label>
            </div>
        </div>

        <button type="submit" class="btn-auth">
            <i class="bi bi-box-arrow-in-right"></i> Masuk
        </button>
    </form>

    <div class="text-center" style="margin-top:20px;">
        <a href="{{ route('register') }}" class="auth-link">
            Belum punya akun? <strong>Daftar Sekarang</strong>
        </a>
    </div>
</div>
@endsection
