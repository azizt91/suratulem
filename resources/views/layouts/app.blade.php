<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $globalAppName ?? config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Playfair Display for Navbar Brand -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @stack('head')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark shadow" style="background:{{ $globalPrimaryColor ?? '#1A2B48' }};border:none;padding:.75rem 0">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}" style="font-family:'Playfair Display',serif;font-weight:700;font-size:1.5rem;color:#D4AF37;letter-spacing:.5px">
                    @if(isset($globalAppLogo) && $globalAppLogo !== '/img/logo.png')
                        <img src="{{ $globalAppLogo }}" alt="Logo" height="34" class="d-inline-block align-text-top me-2" style="filter:brightness(1.2)"> 
                    @endif
                    {{ $globalAppName ?? config('app.name', 'SuratUlem') }}
                </a>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left / Center Nav Links -->
                    <ul class="navbar-nav mx-auto">
                        @auth
                            @if(auth()->user()->hasRole('admin'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('dashboard') }}" style="color:rgba(255,255,255,.85)">Admin Dashboard</a>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('dashboard') }}" style="color:rgba(255,255,255,.85)">Dashboard</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item"><a class="nav-link" href="#tentang" style="color:rgba(255,255,255,.75);font-size:.9rem;font-weight:500">Tentang</a></li>
                            <li class="nav-item"><a class="nav-link" href="#features" style="color:rgba(255,255,255,.75);font-size:.9rem;font-weight:500">Fitur</a></li>
                            <li class="nav-item"><a class="nav-link" href="#templates" style="color:rgba(255,255,255,.75);font-size:.9rem;font-weight:500">Template</a></li>
                            <li class="nav-item"><a class="nav-link" href="#pricing" style="color:rgba(255,255,255,.75);font-size:.9rem;font-weight:500">Harga</a></li>
                            <li class="nav-item"><a class="nav-link" href="#faq" style="color:rgba(255,255,255,.75);font-size:.9rem;font-weight:500">FAQ</a></li>
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link px-3" href="{{ route('login') }}" style="color:#fff;font-weight:500;font-size:.9rem">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link px-3 ms-1" href="{{ route('register') }}" style="background:#D4AF37;color:#1A2B48;border-radius:50px;font-weight:600;font-size:.9rem;padding:.45rem 1.2rem!important">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color:rgba(255,255,255,.9)">
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '{{ $globalPrimaryColor ?? '#0d6efd' }}'
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '{{ session('error') }}',
                    confirmButtonColor: '{{ $globalPrimaryColor ?? '#0d6efd' }}'
                });
            @endif
        });
    </script>
    @stack('scripts')
</body>
</html>
