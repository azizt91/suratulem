@extends('layouts.auth')

@section('title', 'Daftar Akun')

@section('content')
<div class="auth-card">
    <h2 class="card-title">Daftar Akun</h2>
    <p class="card-subtitle">Buat akun untuk mulai membuat undangan digital impianmu.</p>

    <div class="gold-divider">
        <hr><i class="bi bi-diamond-fill"></i><hr>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- Name --}}
        <div class="form-group">
            <label for="name">Nama Lengkap</label>
            <div class="input-icon-wrapper">
                <input id="name" type="text"
                       class="form-control @error('name') is-invalid @enderror"
                       name="name" value="{{ old('name') }}"
                       required autocomplete="name" autofocus
                       placeholder="Masukkan nama lengkap">
                <i class="bi bi-person"></i>
            </div>
        </div>

        {{-- Email --}}
        <div class="form-group">
            <label for="email">Email</label>
            <div class="input-icon-wrapper">
                <input id="email" type="email"
                       class="form-control @error('email') is-invalid @enderror"
                       name="email" value="{{ old('email') }}"
                       required autocomplete="email"
                       placeholder="nama@email.com">
                <i class="bi bi-envelope"></i>
            </div>
        </div>

        {{-- WhatsApp --}}
        <div class="form-group">
            <label for="whatsapp">Nomor WhatsApp</label>
            <div class="input-icon-wrapper">
                <input id="whatsapp" type="text"
                       class="form-control @error('whatsapp') is-invalid @enderror"
                       name="whatsapp" value="{{ old('whatsapp') }}"
                       required inputmode="numeric"
                       placeholder="08xxxxxxxxxx">
                <i class="bi bi-whatsapp" style="color:#25D366"></i>
            </div>
            <small style="font-size:11px; color:#7A7A7A; margin-top:4px; display:block;">
                Digunakan untuk notifikasi & konfirmasi undangan
            </small>
        </div>

        {{-- Password --}}
        <div class="form-group">
            <label for="password">Password</label>
            <div class="input-icon-wrapper">
                <input id="password" type="password"
                       class="form-control @error('password') is-invalid @enderror"
                       name="password" required autocomplete="new-password"
                       placeholder="Min. 8 karakter">
                <i class="bi bi-lock"></i>
            </div>
        </div>

        {{-- Confirm Password --}}
        <div class="form-group">
            <label for="password-confirm">Konfirmasi Password</label>
            <div class="input-icon-wrapper">
                <input id="password-confirm" type="password" class="form-control"
                       name="password_confirmation" required autocomplete="new-password"
                       placeholder="Ulangi password">
                <i class="bi bi-lock-fill"></i>
            </div>
        </div>

        <button type="submit" class="btn-auth" style="margin-top:8px;">
            <i class="bi bi-person-plus"></i> Daftar Sekarang
        </button>
    </form>

    <div class="text-center" style="margin-top:20px;">
        <a href="{{ route('login') }}" class="auth-link">
            Sudah punya akun? <strong>Masuk</strong>
        </a>
    </div>
</div>
@endsection
