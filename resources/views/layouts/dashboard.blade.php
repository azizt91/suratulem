<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('page-title', 'Dashboard') — {{ $globalAppName ?? config('app.name', 'SuratUlem') }}</title>

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

    @php
        $primaryColor = $globalPrimaryColor ?? '#1A2B48';
    @endphp

    <style>
        :root {
            --navy: #1A2B48;
            --navy-light: #243758;
            --navy-hover: #2E4570;
            --gold: #D4AF37;
            --gold-light: #E8D48B;
            --cream: #F9F5F0;
            --cream-dark: #F0EBE3;
            --text-dark: #2C2C2C;
            --text-muted: #7A7A7A;
            --white: #FFFFFF;
            --radius: 20px;
            --radius-sm: 12px;
            --sidebar-w: 260px;
            --topbar-h: 64px;
            --primary: {{ $primaryColor }};
        }

        * { box-sizing: border-box; }
        body {
            font-family: 'Poppins', sans-serif;
            background: var(--cream);
            color: var(--text-dark);
            margin: 0; overflow-x: hidden;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            position: fixed; top: 0; left: 0; bottom: 0;
            width: var(--sidebar-w); background: var(--navy);
            z-index: 100; display: flex; flex-direction: column;
            transition: transform .3s;
        }
        .sidebar-brand {
            padding: 20px 24px; display: flex; align-items: center; gap: 12px;
            border-bottom: 1px solid rgba(212,175,55,0.15);
        }
        .sidebar-brand .brand-logo {
            height: 30px; filter: brightness(1.3);
        }
        .sidebar-brand .brand-name {
            font-family: 'Playfair Display', serif; font-weight: 700;
            font-size: 20px; color: var(--gold); letter-spacing: .5px;
            text-decoration: none;
        }
        .sidebar-nav {
            flex: 1; padding: 16px 12px; overflow-y: auto;
        }
        .sidebar-nav .nav-section {
            font-size: 10px; font-weight: 600; color: rgba(255,255,255,.35);
            text-transform: uppercase; letter-spacing: 2px;
            padding: 16px 12px 6px; margin-top: 8px;
        }
        .sidebar-nav .nav-section:first-child { margin-top: 0; }
        .sidebar-nav .nav-link {
            display: flex; align-items: center; gap: 12px;
            padding: 10px 14px; border-radius: 10px;
            color: rgba(255,255,255,.65); font-size: 13.5px; font-weight: 400;
            text-decoration: none; transition: all .25s; margin-bottom: 2px;
        }
        .sidebar-nav .nav-link i {
            font-size: 17px; width: 22px; text-align: center;
            color: rgba(212,175,55,.5); transition: .25s;
        }
        .sidebar-nav .nav-link:hover {
            background: var(--navy-hover); color: rgba(255,255,255,.9);
        }
        .sidebar-nav .nav-link:hover i { color: var(--gold); }
        .sidebar-nav .nav-link.active {
            background: var(--gold); color: var(--navy);
            font-weight: 600;
        }
        .sidebar-nav .nav-link.active i { color: var(--navy); }
        .sidebar-footer {
            padding: 16px 20px; border-top: 1px solid rgba(255,255,255,.08);
        }
        .sidebar-footer .user-box {
            display: flex; align-items: center; gap: 10px;
        }
        .sidebar-footer .user-avatar {
            width: 36px; height: 36px; border-radius: 50%;
            background: var(--gold); display: flex; align-items: center;
            justify-content: center; font-weight: 700; font-size: 14px;
            color: var(--navy);
        }
        .sidebar-footer .user-name {
            font-size: 13px; font-weight: 500; color: rgba(255,255,255,.85);
            max-width: 140px; overflow: hidden; text-overflow: ellipsis;
            white-space: nowrap;
        }
        .sidebar-footer .user-role {
            font-size: 11px; color: var(--gold); font-weight: 500;
        }

        /* ===== TOPBAR ===== */
        .topbar {
            position: fixed; top: 0; left: var(--sidebar-w); right: 0;
            height: var(--topbar-h); background: var(--white);
            border-bottom: 1px solid var(--cream-dark);
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 28px; z-index: 99;
            box-shadow: 0 1px 6px rgba(0,0,0,.03);
        }
        .topbar .page-title {
            font-family: 'Playfair Display', serif; font-weight: 600;
            font-size: 20px; color: var(--navy); margin: 0;
        }
        .topbar-actions { display: flex; align-items: center; gap: 12px; }
        .topbar-actions .btn-landing {
            display: inline-flex; align-items: center; gap: 6px;
            background: transparent; color: var(--navy);
            border: 1.5px solid var(--cream-dark); border-radius: 50px;
            padding: 7px 16px; font-size: 12.5px; font-weight: 500;
            text-decoration: none; transition: .3s;
        }
        .topbar-actions .btn-landing:hover {
            border-color: var(--gold); color: var(--gold);
        }
        .topbar-actions .btn-logout {
            display: inline-flex; align-items: center; gap: 6px;
            background: var(--cream); color: var(--text-muted);
            border: none; border-radius: 50px;
            padding: 7px 16px; font-size: 12.5px; font-weight: 500;
            cursor: pointer; transition: .3s;
        }
        .topbar-actions .btn-logout:hover { background: #f0e0e0; color: #c0392b; }
        .btn-sidebar-toggle {
            display: none; background: none; border: none;
            font-size: 22px; color: var(--navy); cursor: pointer;
        }

        /* ===== MAIN CONTENT ===== */
        .main-content {
            margin-left: var(--sidebar-w);
            margin-top: var(--topbar-h);
            padding: 28px;
            min-height: calc(100vh - var(--topbar-h));
        }

        /* ===== CARD DESIGN SYSTEM ===== */
        .card-royal {
            background: var(--white);
            border: 1px solid rgba(212,175,55,.08);
            border-radius: var(--radius);
            box-shadow: 0 4px 20px rgba(26,43,72,.04);
            overflow: hidden;
        }
        .card-royal .card-header-royal {
            padding: 18px 24px; border-bottom: 1px solid var(--cream-dark);
            background: transparent;
        }
        .card-royal .card-header-royal h5 {
            font-family: 'Playfair Display', serif; font-weight: 600;
            font-size: 17px; color: var(--navy); margin: 0;
        }
        .card-royal .card-body { padding: 24px; }

        /* ===== STAT CARD ===== */
        .stat-card {
            background: var(--white); border-radius: var(--radius);
            border: 1px solid rgba(212,175,55,.08);
            box-shadow: 0 4px 20px rgba(26,43,72,.04);
            padding: 22px 24px; display: flex; align-items: center; gap: 16px;
            transition: transform .3s, box-shadow .3s;
        }
        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(26,43,72,.08);
        }
        .stat-card .stat-icon {
            width: 52px; height: 52px; border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-size: 22px;
        }
        .stat-card .stat-icon.gold { background: rgba(212,175,55,.12); color: var(--gold); }
        .stat-card .stat-icon.navy { background: rgba(26,43,72,.08); color: var(--navy); }
        .stat-card .stat-icon.green { background: rgba(40,167,69,.1); color: #28a745; }
        .stat-card .stat-icon.info { background: rgba(23,162,184,.1); color: #17a2b8; }
        .stat-card .stat-label {
            font-size: 12px; font-weight: 500; color: var(--text-muted);
            margin-bottom: 2px;
        }
        .stat-card .stat-value {
            font-family: 'Playfair Display', serif; font-weight: 700;
            font-size: 22px; color: var(--navy);
        }

        /* ===== TABLE ===== */
        .table-royal {
            font-size: 13.5px; color: var(--text-dark);
        }
        .table-royal thead th {
            font-weight: 600; font-size: 11.5px; text-transform: uppercase;
            letter-spacing: 1px; color: var(--text-muted);
            border-bottom: 2px solid var(--cream-dark);
            padding: 12px 16px; background: transparent;
        }
        .table-royal tbody td {
            padding: 14px 16px; vertical-align: middle;
            border-bottom: 1px solid var(--cream);
        }
        .table-royal tbody tr:hover { background: rgba(249,245,240,.6); }

        /* ===== BUTTONS (system) ===== */
        .btn-gold {
            background: var(--gold); color: var(--navy); border: none;
            border-radius: 50px; padding: 8px 20px; font-weight: 600;
            font-size: 13px; transition: .3s;
        }
        .btn-gold:hover {
            background: var(--navy); color: var(--gold);
            box-shadow: 0 4px 16px rgba(26,43,72,.2);
        }
        .btn-navy {
            background: var(--navy); color: var(--white); border: none;
            border-radius: 50px; padding: 8px 20px; font-weight: 600;
            font-size: 13px; transition: .3s;
        }
        .btn-navy:hover {
            background: var(--gold); color: var(--navy);
        }

        /* ===== MOBILE ===== */
        @media (max-width: 991px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .topbar { left: 0; }
            .main-content { margin-left: 0; }
            .btn-sidebar-toggle { display: block; }
            .sidebar-overlay {
                display: none; position: fixed; inset: 0;
                background: rgba(0,0,0,.4); z-index: 99;
            }
            .sidebar-overlay.show { display: block; }
        }
    </style>

    @stack('head')
</head>
<body>

{{-- ===== SIDEBAR ===== --}}
<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        @if(isset($globalAppLogo) && $globalAppLogo !== '/img/logo.png')
            <img src="{{ $globalAppLogo }}" alt="Logo" class="brand-logo">
        @endif
        <a href="{{ url('/') }}" class="brand-name">{{ $globalAppName ?? 'SuratUlem' }}</a>
    </div>

    <nav class="sidebar-nav">
        @if(auth()->user()->hasRole('admin'))
            {{-- ===== ADMIN NAV ===== --}}
            <div class="nav-section">Dashboard</div>
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2"></i> Overview
            </a>

            <div class="nav-section">Kelola</div>
            <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Pengguna
            </a>
            <a href="{{ route('admin.packages.index') }}" class="nav-link {{ request()->routeIs('admin.packages.*') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i> Paket
            </a>
            <a href="{{ route('admin.templates.index') }}" class="nav-link {{ request()->routeIs('admin.templates.*') ? 'active' : '' }}">
                <i class="bi bi-palette"></i> Template
            </a>
            <a href="{{ route('admin.music.index') }}" class="nav-link {{ request()->routeIs('admin.music.*') ? 'active' : '' }}">
                <i class="bi bi-music-note-beamed"></i> Musik
            </a>

            <div class="nav-section">Keuangan</div>
            <a href="{{ route('admin.revenue.index') }}" class="nav-link {{ request()->routeIs('admin.revenue.*') ? 'active' : '' }}">
                <i class="bi bi-cash-coin"></i> Revenue
            </a>
        @else
            {{-- ===== MEMPELAI NAV ===== --}}
            <div class="nav-section">Undangan</div>
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2"></i> Dashboard
            </a>
            @if(auth()->user()->invitation)
                <a href="{{ route('invitation.edit', auth()->user()->invitation) }}" class="nav-link {{ request()->routeIs('invitation.edit') ? 'active' : '' }}">
                    <i class="bi bi-pencil-square"></i> Edit Undangan
                </a>
            @endif

            <div class="nav-section">Langganan</div>
            <a href="{{ route('subscription.index') }}" class="nav-link {{ request()->routeIs('subscription.*') ? 'active' : '' }}">
                <i class="bi bi-credit-card-2-front"></i> Paket & Pembayaran
            </a>
        @endif
    </nav>

    <div class="sidebar-footer">
        <div class="user-box">
            <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            <div>
                <div class="user-name">{{ Auth::user()->name }}</div>
                <div class="user-role">{{ ucfirst(Auth::user()->getRoleNames()->first() ?? 'user') }}</div>
            </div>
        </div>
    </div>
</aside>

{{-- ===== MOBILE OVERLAY ===== --}}
<div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

{{-- ===== TOPBAR ===== --}}
<header class="topbar">
    <div class="d-flex align-items-center gap-3">
        <button class="btn-sidebar-toggle" onclick="toggleSidebar()">
            <i class="bi bi-list"></i>
        </button>
        <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
    </div>
    <div class="topbar-actions">
        <a href="{{ url('/') }}" class="btn-landing" target="_blank">
            <i class="bi bi-globe2"></i> Lihat Landing Page
        </a>
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </div>
</header>

{{-- ===== MAIN ===== --}}
<main class="main-content">
    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('open');
        document.getElementById('sidebarOverlay').classList.toggle('show');
    }

    document.addEventListener('DOMContentLoaded', function() {
        @if(session('success'))
            Swal.fire({ icon:'success', title:'Berhasil!', text:'{{ session('success') }}',
                confirmButtonColor:'{{ $primaryColor }}' });
        @endif
        @if(session('error'))
            Swal.fire({ icon:'error', title:'Oops...', text:'{{ session('error') }}',
                confirmButtonColor:'{{ $primaryColor }}' });
        @endif
    });
</script>
@stack('scripts')
</body>
</html>
