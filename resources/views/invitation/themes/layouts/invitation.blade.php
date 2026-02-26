{{--
  ==========================================================================
   BASE INVITATION LAYOUT — Shared by all Templay-series templates
   Path: resources/views/invitation/themes/layouts/invitation.blade.php

   Child templates: @extends('invitation.themes.layouts.invitation')
   Yields: css-variables, styles, body, scripts, bottom-nav
   Provides: $pria, $wanita, $akad, $resepsi, $galeri, $fitur,
             $photos, $guestName, $namaPria, $namaWanita, $primaryColor
  ==========================================================================
--}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    {{-- ===== Shared data extraction ===== --}}
    @php
        $pria    = $invitation->data_mempelai['pria']   ?? [];
        $wanita  = $invitation->data_mempelai['wanita']  ?? [];
        $akad    = $invitation->data_acara['akad']       ?? [];
        $resepsi = $invitation->data_acara['resepsi']    ?? [];
        $galeri  = $invitation->data_galeri              ?? [];
        $fitur   = $invitation->data_fitur_tambahan      ?? [];

        $namaPria   = $pria['nama_panggilan']   ?? 'Putra';
        $namaWanita = $wanita['nama_panggilan'] ?? 'Putri';
        $globalName = $globalAppName ?? 'SuratUlem';

        // Collect all foto_* keys that have a truthy value
        $photos = collect($galeri)
            ->filter(fn($v, $k) => str_starts_with($k, 'foto_') && $v)
            ->values()->all();

        // urldecode so "Budi%20%26%20Susi" → "Budi & Susi"
        $guestName = urldecode(request('to', 'Tamu Undangan'));

        // Primary color — user-customisable via dashboard
        $primaryColor = $fitur['primary_color'] ?? '#333380';

        // Music — child templates can set $disableBaseMusic = true to skip
        $disableBaseMusic = $disableBaseMusic ?? false;
    @endphp

    <title>{{ $namaWanita }} & {{ $namaPria }} — The Wedding</title>

    {{-- SEO --}}
    <meta name="description" content="Undangan Pernikahan {{ $namaWanita }} & {{ $namaPria }}.">
    <meta property="og:title" content="The Wedding of {{ $namaWanita }} & {{ $namaPria }}">
    <meta property="og:description" content="Kami mengundang Bapak/Ibu/Saudara/i untuk hadir pada acara pernikahan kami.">
    <meta property="og:image" content="{{ $photos[0] ?? '' }}">
    <meta property="og:url" content="{{ request()->url() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Google Fonts (display=swap for instant text) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caramel&family=Montserrat:wght@400;500;600;700&family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    {{-- Bootstrap 5 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    {{-- AOS — Animate on Scroll --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    {{-- ===== Per-template CSS variables ===== --}}
    <style>
        :root {
            @yield('css-variables')
        }

        /* ===== Shared resets ===== */
        * { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            max-width: 480px;
            margin: 0 auto;
            overflow-x: hidden;
            position: relative;
        }

        /* ===== Glassmorphism (from Elementor custom CSS) ===== */
        .glass {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(3px);
            -webkit-backdrop-filter: blur(3px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* ===== Wave Separator (curve-asymmetrical from Elementor shape dividers) ===== */
        .wave-separator {
            position: relative;
            width: 100%;
            overflow: hidden;
            line-height: 0;
        }
        .wave-separator svg {
            display: block;
            width: 100%;
            height: auto;
        }
        .wave-separator.wave-top { transform: rotate(180deg); }

        /* ===== Shared Bottom Nav ===== */
        .bottom-nav {
            position: fixed; bottom: 10px; left: 50%; transform: translateX(-50%);
            max-width: 380px; width: 92%; z-index: 500;
        }
        .bottom-nav .nav-inner {
            display: flex; align-items: center; justify-content: space-around;
            border-radius: 14px; padding: 6px 4px;
            box-shadow: 0 4px 20px rgba(0,0,0,.25);
        }
        .bottom-nav .nav-item {
            flex: 1; display: flex; align-items: center; justify-content: center;
            padding: 8px 0; border-radius: 8px; font-size: 1.1rem;
            cursor: pointer; transition: .3s; text-decoration: none;
        }
        .bottom-nav .nav-item:hover,
        .bottom-nav .nav-item.active { color: #fff; }

        /* ===== Music Toggle ===== */
        .music-toggle {
            position: fixed; bottom: 80px; left: 50%; transform: translateX(-50%);
            margin-left: -200px; z-index: 501; width: 35px; height: 35px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 50%; font-size: 1rem; cursor: pointer; border: none;
        }

        .hidden { display: none; }
    </style>

    {{-- ===== Per-template styles ===== --}}
    @yield('styles')
</head>
<body>

    @yield('body')

    {{-- ===== Bottom Nav (overridable) ===== --}}
    @hasSection('bottom-nav')
        @yield('bottom-nav')
    @endif

    {{-- ===== Music Player (unless disabled by child template) ===== --}}
    @unless($disableBaseMusic)
        @if($invitation->id && $invitation->music)
            <audio id="song" loop>
                <source src="{{ Storage::url($invitation->music->file_path) }}" type="audio/mpeg">
            </audio>
            <button class="music-toggle hidden" id="musicToggle" onclick="toggleMusic()">
                <i class="bi bi-music-note-beamed" id="musicIcon"></i>
            </button>
        @endif
    @endunless

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
    {{-- AOS --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
    /* ===== Lock scroll until cover is opened ===== */
    document.body.style.overflowY = 'hidden';

    /* ===== AOS init ===== */
    AOS.init({ once: true, offset: 30, easing: 'ease-out-cubic', startEvent: 'DOMContentLoaded' });

    /* ===== Open Invitation (called by child templates) ===== */
    function openInvitation() {
        const cover = document.getElementById('header');
        const main  = document.getElementById('mainContent');
        const nav   = document.getElementById('bottomNav');
        const mt    = document.getElementById('musicToggle');

        if (cover) {
            cover.style.transition = 'opacity .6s ease';
            cover.style.opacity = '0';
            setTimeout(() => {
                cover.style.display = 'none';
                if (main) main.style.visibility = 'visible';
                document.body.style.overflowY = 'auto';
                if (nav) nav.classList.remove('hidden');
                if (mt)  mt.classList.remove('hidden');
                AOS.refreshHard();
                playAudio();
                startCountdown();
            }, 600);
        }
    }

    /* ===== Music controls ===== */
    function playAudio() {
        const a = document.getElementById('song');
        if (a) a.play().catch(() => {});
    }
    function toggleMusic() {
        const a = document.getElementById('song');
        const i = document.getElementById('musicIcon');
        if (!a) return;
        if (a.paused) { a.play(); i.className = 'bi bi-music-note-beamed'; }
        else { a.pause(); i.className = 'bi bi-pause-circle'; }
    }

    /* ===== Countdown timer ===== */
    function startCountdown() {
        @if(!empty($akad['tanggal']))
            const target = new Date('{{ \Carbon\Carbon::parse($akad['tanggal'])->format('Y-m-d') }}T{{ $akad['waktu_mulai'] ?? '08:00' }}:00').getTime();
            function tick() {
                const now = Date.now(), d = target - now;
                if (d <= 0) {
                    ['cd-days','cd-hours','cd-mins','cd-secs'].forEach(id => {
                        const el = document.getElementById(id); if (el) el.textContent = '0';
                    });
                    return;
                }
                const el = (id, v) => { const e = document.getElementById(id); if (e) e.textContent = v; };
                el('cd-days',  Math.floor(d / 86400000));
                el('cd-hours', Math.floor((d % 86400000) / 3600000));
                el('cd-mins',  Math.floor((d % 3600000) / 60000));
                el('cd-secs',  Math.floor((d % 60000) / 1000));
            }
            tick();
            setInterval(tick, 1000);
        @endif
    }

    /* ===== Copy to clipboard ===== */
    function copyText(t) {
        navigator.clipboard.writeText(t).then(() => alert('Berhasil disalin: ' + t));
    }

    /* ===== Scroll spy for bottom nav ===== */
    const navItems = document.querySelectorAll('.bottom-nav .nav-item');
    const spySections = document.querySelectorAll('[id]');
    window.addEventListener('scroll', () => {
        let cur = '';
        spySections.forEach(s => {
            if (s.id && window.scrollY >= s.offsetTop - 200) cur = s.id;
        });
        navItems.forEach(n => {
            n.classList.remove('active');
            if (n.getAttribute('href') === '#' + cur) n.classList.add('active');
        });
    });
    </script>

    {{-- ===== Per-template scripts ===== --}}
    @yield('scripts')
</body>
</html>
