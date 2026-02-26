<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Masuk') — {{ $globalAppName ?? config('app.name', 'SuratUlem') }}</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    {{-- SweetAlert2 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        :root {
            --cream: #F9F5F0;
            --navy: #1A2B48;
            --gold: #D4AF37;
            --gold-light: #E8D48B;
            --text-dark: #2C2C2C;
            --text-muted: #7A7A7A;
            --white: #FFFFFF;
            --radius: 12px;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Poppins', sans-serif;
            background: var(--cream);
            min-height: 100vh;
            color: var(--text-dark);
        }

        /* ===== SPLIT LAYOUT ===== */
        .auth-wrapper {
            display: flex; min-height: 100vh;
        }

        /* Left: Illustration panel (desktop only) */
        .auth-side {
            flex: 0 0 45%; position: relative; overflow: hidden;
            display: flex; align-items: center; justify-content: center;
            background: linear-gradient(135deg, var(--navy) 0%, #2A3F5F 50%, #1A2B48 100%);
        }
        .auth-side-inner {
            position: relative; z-index: 2; text-align: center;
            padding: 40px; color: var(--white);
        }
        .auth-side-inner .brand-title {
            font-family: 'Playfair Display', serif; font-weight: 700;
            font-size: 36px; color: var(--gold);
            letter-spacing: 1px; margin-bottom: 12px;
        }
        .auth-side-inner .brand-subtitle {
            font-family: 'Poppins', sans-serif; font-weight: 300;
            font-size: 15px; color: rgba(255,255,255,0.8);
            line-height: 1.6; max-width: 340px; margin: 0 auto;
        }

        /* Decorative botanical elements (CSS-only) */
        .deco-ring {
            position: absolute; border: 1px solid rgba(212,175,55,0.15);
            border-radius: 50%;
        }
        .deco-ring-1 { width: 400px; height: 400px; top: -100px; left: -100px; }
        .deco-ring-2 { width: 300px; height: 300px; bottom: -80px; right: -60px; }
        .deco-ring-3 { width: 200px; height: 200px; top: 40%; left: 50%; transform: translate(-50%,-50%); border-width: 2px; }
        .deco-leaf {
            position: absolute; font-size: 80px; opacity: 0.08; color: var(--gold);
        }
        .deco-leaf-1 { top: 15%; right: 10%; transform: rotate(30deg); }
        .deco-leaf-2 { bottom: 20%; left: 15%; transform: rotate(-20deg); font-size: 60px; }
        .deco-leaf-3 { top: 60%; right: 30%; transform: rotate(60deg); font-size: 50px; }
        .deco-gold-line {
            position: absolute; bottom: 0; left: 0; right: 0;
            height: 4px; background: linear-gradient(90deg, transparent, var(--gold), transparent);
        }

        /* Right: Form panel */
        .auth-form-panel {
            flex: 1; display: flex; align-items: center; justify-content: center;
            padding: 40px 30px; background: var(--cream);
        }
        .auth-card {
            width: 100%; max-width: 440px;
            background: var(--white);
            border-radius: 20px;
            padding: 40px 36px;
            box-shadow: 0 8px 40px rgba(26,43,72,0.06);
            border: 1px solid rgba(212,175,55,0.12);
        }
        .auth-card .card-title {
            font-family: 'Playfair Display', serif; font-weight: 700;
            font-size: 28px; color: var(--navy);
            margin-bottom: 4px;
        }
        .auth-card .card-subtitle {
            font-family: 'Poppins', sans-serif; font-weight: 300;
            font-size: 14px; color: var(--text-muted);
            margin-bottom: 24px;
        }

        /* Divider with gold accent */
        .gold-divider {
            display: flex; align-items: center; gap: 12px; margin-bottom: 24px;
        }
        .gold-divider hr {
            flex: 1; border: none; height: 1px;
            background: linear-gradient(90deg, var(--gold), transparent);
        }
        .gold-divider i { color: var(--gold); font-size: 12px; }

        /* Form controls */
        .form-group { margin-bottom: 16px; }
        .form-group label {
            font-family: 'Poppins', sans-serif; font-weight: 500;
            font-size: 13px; color: var(--text-dark);
            margin-bottom: 6px; display: block;
        }
        .input-icon-wrapper {
            position: relative;
        }
        .input-icon-wrapper i {
            position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
            color: var(--text-muted); font-size: 16px; transition: .3s;
        }
        .input-icon-wrapper .form-control {
            padding-left: 42px;
        }
        .form-control {
            font-family: 'Poppins', sans-serif; font-size: 14px;
            border: 1.5px solid #E0DCD5; border-radius: var(--radius);
            padding: 12px 16px; color: var(--text-dark);
            background: #FAFAF8; transition: all .3s;
        }
        .form-control:focus {
            border-color: var(--gold); box-shadow: 0 0 0 3px rgba(212,175,55,0.12);
            background: var(--white);
        }
        .form-control:focus + i,
        .input-icon-wrapper:focus-within i { color: var(--gold); }
        .form-control::placeholder { color: #BDB8AE; }
        .form-control.is-invalid { border-color: #dc3545; }

        .form-check-label {
            font-size: 13px; color: var(--text-muted);
        }
        .form-check-input:checked {
            background-color: var(--gold); border-color: var(--gold);
        }

        /* Submit button */
        .btn-auth {
            width: 100%; padding: 13px; border: none;
            border-radius: 50px; font-family: 'Poppins', sans-serif;
            font-weight: 600; font-size: 15px; letter-spacing: 0.5px;
            background: var(--navy); color: var(--white);
            cursor: pointer; transition: all .4s;
            display: flex; align-items: center; justify-content: center; gap: 10px;
        }
        .btn-auth:hover {
            background: linear-gradient(135deg, var(--gold) 0%, #BF9B30 100%);
            color: var(--navy); transform: translateY(-1px);
            box-shadow: 0 6px 24px rgba(212,175,55,0.35);
        }

        /* Links */
        .auth-link {
            font-size: 13px; color: var(--text-muted);
            text-decoration: none; transition: .3s;
        }
        .auth-link:hover { color: var(--gold); }
        .auth-link strong { color: var(--navy); font-weight: 600; }
        .auth-link:hover strong { color: var(--gold); }

        .forgot-link {
            font-size: 12px; color: var(--gold); text-decoration: none;
        }
        .forgot-link:hover { text-decoration: underline; }

        /* Mobile: stack vertically, hide illustration */
        @media (max-width: 991px) {
            .auth-side { display: none; }
            .auth-form-panel { padding: 30px 20px; }
            .auth-card { padding: 30px 24px; }
        }
    </style>

    @yield('styles')
</head>
<body>

<div class="auth-wrapper">
    {{-- ===== Illustration Side ===== --}}
    <div class="auth-side">
        <div class="deco-ring deco-ring-1"></div>
        <div class="deco-ring deco-ring-2"></div>
        <div class="deco-ring deco-ring-3"></div>
        <div class="deco-leaf deco-leaf-1">🌿</div>
        <div class="deco-leaf deco-leaf-2">🍃</div>
        <div class="deco-leaf deco-leaf-3">🌸</div>
        <div class="deco-gold-line"></div>

        <div class="auth-side-inner">
            <p style="font-size:48px; margin-bottom:16px;">💍</p>
            <h1 class="brand-title">{{ $globalAppName ?? 'SuratUlem' }}</h1>
            <p class="brand-subtitle">
                Buat undangan pernikahan digital yang elegan, personal, dan berkesan —
                hanya dalam beberapa menit.
            </p>
            <div style="margin-top:32px; display:flex; justify-content:center; gap:24px; color:rgba(255,255,255,.5); font-size:13px;">
                <span><i class="bi bi-check-circle"></i> 12+ Template</span>
                <span><i class="bi bi-check-circle"></i> RSVP Online</span>
                <span><i class="bi bi-check-circle"></i> Musik</span>
            </div>
        </div>
    </div>

    {{-- ===== Form Side ===== --}}
    <div class="auth-form-panel">
        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- SweetAlert2 toast for validation errors --}}
@if($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const errors = @json($errors->all());
        Swal.fire({
            icon: 'error',
            title: 'Oops!',
            html: errors.map(e => '• ' + e).join('<br>'),
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 6000,
            timerProgressBar: true,
            customClass: { popup: 'swal-toast-custom' }
        });
    });
</script>
@endif

@yield('scripts')
</body>
</html>
