{{--
  ==========================================================================
   MINIMALIST 2 — Dusty Rose / Warm Minimalist Wedding Template
   File : resources/views/invitation/themes/minimalist_2.blade.php
   blade_path : invitation.themes.minimalist_2

   Extends : invitation.themes.layouts.invitation
   Source  : SATUNESIA A2.json
   Theme  : Dusty rose (#AB7979), white sections, warm gradient overlays
   Fonts  : Quantico (headings), Revalia (names), Red Hat Text (body),
            Noto Serif Telugu (event details), Raleway (parent info)
   Effects: Triangle shape dividers, gradient overlays, fadeIn animations,
            vertical letter labels (PRIA / WANITA / AKAD / RESEPSI)
  ==========================================================================
--}}
@extends('invitation.themes.layouts.invitation')

{{-- ===== CSS VARIABLES ===== --}}
@section('css-variables')
    --primary: {{ $primaryColor ?? '#AB7979' }};
    --primary-dark: #7D4D4D;
    --primary-light: #BA9090;
    --primary-lighter: #A77F7F;
    --cover-bg: #BD2C2C;
    --cover-overlay-a: #E0937F;
    --cover-overlay-b: #A26675;
    --text-dark: #333030;
    --text-heading: #000000;
    --text-muted: #776F6F;
    --text-white: #FFFFFF;
    --bg-white: #FFFFFF;
    --bg-light: #EBEBEB;
    --btn-hover: #F3BE6C;
    --font-heading: 'Quantico', sans-serif;
    --font-name: 'Revalia', sans-serif;
    --font-body: 'Red Hat Text', sans-serif;
    --font-display: 'Red Hat Display', sans-serif;
    --font-detail: 'Noto Serif Telugu', serif;
    --font-parent: 'Raleway', sans-serif;
    --font-btn: 'Play', sans-serif;
@endsection

{{-- ===== TEMPLATE-SPECIFIC STYLES ===== --}}
@section('styles')
{{-- Extra fonts not in base layout --}}
<link href="https://fonts.googleapis.com/css2?family=Quantico:wght@400;700&family=Revalia&family=Red+Hat+Text:wght@400;500;600;700&family=Red+Hat+Display:wght@400;500;600;700;800&family=Noto+Serif+Telugu:wght@400;500;700&family=Raleway:wght@400;500;600&family=Play:wght@400;700&family=Italiana&display=swap" rel="stylesheet">

<style>
body {
    font-family: var(--font-body);
    color: var(--text-dark);
    background: var(--bg-white);
}

/* ===== COVER ===== */
.cover-section {
    min-height: 100vh; width: 100%; position: fixed; top: 0;
    left: 50%; transform: translateX(-50%); max-width: 480px;
    z-index: 999; display: flex; align-items: flex-end;
    justify-content: flex-end; overflow: hidden;
}
.cover-bg {
    position: absolute; inset: 0;
    background-size: cover; background-position: center;
}
.cover-bg::after {
    content: ''; position: absolute; inset: 0;
    background: linear-gradient(80deg, var(--cover-overlay-a) 39%, var(--cover-overlay-b) 77%);
    opacity: 0.8;
}
.cover-inner {
    position: relative; z-index: 4;
    width: 100%; text-align: right; padding: 30px 15px;
}
.cover-inner .label-wedding {
    font-family: var(--font-heading); font-weight: 600;
    font-size: 18px; color: var(--text-white);
    letter-spacing: 2.2px;
}
.cover-inner .name-display {
    font-family: var(--font-name); font-size: 28px;
    font-weight: 600; color: var(--text-white);
    letter-spacing: 1px;
}
.cover-inner .guest-label {
    font-family: var(--font-body); font-weight: 400;
    font-size: 15px; color: var(--text-white);
    font-style: italic; letter-spacing: 1px;
}
.cover-inner .guest-name {
    font-family: var(--font-body); font-weight: 600;
    font-size: 17px; color: var(--text-white);
}
.btn-open {
    display: inline-flex; align-items: center; gap: 10px;
    background: #EFEFEF; color: #BD8686;
    border: none; border-radius: 35px 0 0 35px;
    padding: 10px 22px; font-size: 12px;
    font-family: 'Red Hat Display', sans-serif;
    font-weight: 500; cursor: pointer;
    transition: all .3s;
}
.btn-open:hover { background: #1B1B1B; color: #fff; }

/* ===== HOME ===== */
.home-section {
    position: relative; overflow: hidden;
    min-height: 100vh; text-align: right;
}
.home-bg-slideshow {
    position: absolute; inset: 0; z-index: 0;
}
.home-bg-slideshow .slide {
    position: absolute; inset: 0;
    background-size: cover; background-position: center;
    opacity: 0; transition: opacity 2.5s ease;
}
.home-bg-slideshow .slide.active { opacity: 1; }
.home-overlay {
    position: absolute; inset: 0;
    background: var(--primary); opacity: 0.81; z-index: 1;
}
.home-content {
    position: relative; z-index: 3;
    padding: 25px 10px; display: flex; flex-direction: column;
    align-items: flex-end; justify-content: flex-end;
    min-height: 100vh;
}
.home-content .label-wedding {
    font-family: var(--font-body); font-weight: 600;
    font-size: 16px; color: var(--text-white);
}
.home-content .name-display {
    font-family: var(--font-name); font-size: 28px;
    font-weight: 600; color: var(--text-white);
    letter-spacing: 1px; text-align: right;
}
.home-content .date-display {
    font-family: var(--font-body); font-weight: 600;
    font-size: 16px; color: var(--text-white);
}
.btn-save-date {
    display: inline-flex; align-items: center; gap: 6px;
    background: #FBFFFB; color: var(--primary);
    border: none; border-radius: 4px; padding: 6px 12px;
    font-family: 'Red Hat Display', sans-serif;
    font-size: 12px; font-weight: 700;
    cursor: pointer; animation: pulse 3.8s infinite;
    text-decoration: none;
}

/* ===== PENGANTIN ===== */
.pengantin-section {
    background: var(--bg-white); padding: 50px 5px;
    text-align: center;
}
.pengantin-section .greeting {
    font-family: var(--font-heading); font-weight: 600;
    font-size: 13px; color: var(--text-heading);
    letter-spacing: 1px;
}
.pengantin-section .intro-text {
    font-family: var(--font-heading); font-weight: 500;
    font-size: 10px; color: var(--text-dark);
    letter-spacing: 1.6px; line-height: 1.8;
    padding: 0 5px;
}
.pengantin-row {
    display: flex; align-items: stretch; margin-top: 10px;
}
/* Mempelai column with photo */
.mp-col-photo {
    flex: 80%; text-align: right; padding: 0 5px;
}
.mp-col-photo.left { text-align: left; }
/* Vertical label column */
.mp-col-label {
    flex: 20%; display: flex; align-items: center;
    justify-content: center;
}
.mp-col-label .vertical-text {
    font-family: var(--font-heading); font-weight: 500;
    font-size: 25px; color: var(--primary);
    letter-spacing: 0.4px; writing-mode: vertical-lr;
    text-orientation: mixed; line-height: 3.5;
}
.mp-col-photo img {
    width: 73%; height: 280px; object-fit: cover;
    border-radius: 0; filter: brightness(1.1);
    box-shadow: 0 0 10px 4px rgba(0,0,0,.5);
}
.mp-col-photo .mp-name {
    font-family: var(--font-heading); font-weight: 500;
    font-size: 15px; color: var(--text-heading);
    letter-spacing: 0.4px; padding-top: 7px;
}
.mp-col-photo .mp-parent {
    font-family: var(--font-parent); font-weight: 500;
    font-size: 11px; color: #54595F;
}
.mp-col-photo .btn-ig {
    display: inline-flex; align-items: center; gap: 6px;
    background: var(--primary); color: var(--text-white);
    border: none; border-radius: 5px; padding: 5px 10px;
    font-family: var(--font-btn); font-size: 11px; font-weight: 500;
    text-decoration: none;
}
/* Separator row */
.mp-separator {
    display: flex; align-items: center; justify-content: center;
    border-top: 2px solid var(--primary);
    border-bottom: 2px solid var(--primary);
    padding: 8px; margin: 5px 0;
}
.mp-separator .amp {
    font-family: var(--font-heading); font-weight: 500;
    font-size: 25px; color: var(--text-heading);
    line-height: 2.3;
}

/* ===== ACARA ===== */
.acara-section {
    position: relative; overflow: hidden;
    padding: 50px 0; text-align: center;
    background: linear-gradient(180deg, var(--primary) 0%, var(--primary-light) 100%);
}
.acara-section .section-title {
    font-family: var(--font-heading); font-size: 20px;
    font-weight: 600; color: var(--text-white);
    letter-spacing: 3.7px;
}
.acara-section .ayat-text {
    font-family: var(--font-display); font-weight: 600;
    font-size: 11px; color: #F6F6F6; line-height: 1.5;
    letter-spacing: 1.6px; padding: 0 15px;
}
/* Triangle shape dividers */
.triangle-divider {
    position: absolute; left: 0; width: 112%; overflow: hidden;
    line-height: 0;
}
.triangle-divider.top { top: 0; }
.triangle-divider.bottom { bottom: 0; }
.triangle-divider svg { display: block; width: 100%; height: 18px; }

.acara-event-row {
    display: flex; align-items: stretch; text-align: left;
    margin-top: 15px; padding: 0 5px;
}
.acara-label-col {
    flex: 10%; display: flex; align-items: center; justify-content: center;
}
.acara-label-col .vertical-text {
    font-family: var(--font-heading); font-weight: 700;
    font-size: 14px; color: var(--text-white);
    writing-mode: vertical-lr; text-orientation: mixed;
    line-height: 1.8;
}
.acara-detail-col {
    flex: 90%; padding-left: 10px;
    border-left: 2px dotted var(--text-white);
}
.acara-detail-col.right {
    text-align: right; padding-left: 0; padding-right: 10px;
    border-left: none; border-right: 2px dotted var(--text-white);
}
.acara-detail-col .event-date {
    font-family: var(--font-detail); font-weight: 500;
    font-size: 17px; color: var(--text-white);
    letter-spacing: 0.4px;
}
.acara-detail-col .event-time {
    font-family: var(--font-detail); font-weight: 500;
    font-size: 15px; color: var(--text-white);
    letter-spacing: 0.4px;
}
.acara-detail-col .event-venue {
    font-family: var(--font-detail); font-weight: 500;
    font-size: 15px; color: var(--primary);
    letter-spacing: 0.4px; background: var(--bg-light);
    border-radius: 0 5px 5px 0; padding: 7px 5px;
    line-height: 1.3; margin-top: 5px; display: inline-block;
}
.acara-detail-col .event-venue.right-align {
    border-radius: 5px 0 0 5px;
}
.btn-maps, .btn-stream {
    display: inline-flex; align-items: center; gap: 6px;
    background: #EFEFEF; color: var(--primary);
    border: none; border-radius: 5px; padding: 7px 10px;
    font-family: var(--font-btn); font-size: 11px;
    font-weight: 600; letter-spacing: 1.1px;
    text-decoration: none; margin-top: 5px;
}
.btn-calendar {
    display: inline-flex; align-items: center; gap: 6px;
    background: #DBDBDB; color: var(--text-muted);
    border: none; border-radius: 5px; padding: 5px 10px;
    font-family: 'Red Hat Display', sans-serif;
    font-size: 11px; font-weight: 800;
    text-decoration: none; margin-top: 5px;
}

/* ===== WISH & GIFT ===== */
.wish-section {
    background: var(--bg-white); padding: 50px 15px; text-align: center;
}
.wish-section .section-title {
    font-family: var(--font-heading); font-size: 20px;
    font-weight: 600; color: var(--text-muted);
    letter-spacing: 3.7px;
}
.wish-section .sub-title {
    font-family: var(--font-heading); font-size: 17px;
    font-weight: 600; color: var(--text-muted);
    letter-spacing: 3.7px;
}
/* RSVP form */
.rsvp-form { width: 100%; max-width: 340px; margin: 16px auto 0; }
.rsvp-form .form-control, .rsvp-form .form-select {
    background: #fafafa; border: 1px solid #ddd;
    border-radius: 6px; color: var(--text-dark); font-size: .88rem;
}
.rsvp-form .form-control:focus, .rsvp-form .form-select:focus {
    border-color: var(--primary); box-shadow: none;
}
.rsvp-form .btn-submit {
    background: var(--primary); color: var(--text-white);
    border: none; border-radius: 6px;
    padding: 10px 0; width: 100%; font-weight: 600; font-size: .88rem;
    transition: .3s;
}
.rsvp-form .btn-submit:hover { background: var(--primary-dark); }
.guestbook-list {
    max-height: 280px; overflow-y: auto;
    width: 100%; max-width: 340px; margin: 16px auto 0;
}
.gb-item { border-bottom: 1px solid #eee; padding: 10px 0; text-align: left; }
.gb-item:last-child { border-bottom: none; }
.gb-item .gb-name { font-weight: 600; font-size: .88rem; color: var(--text-heading); }
.gb-item .gb-date { font-size: .68rem; color: #999; }
.gb-item .gb-msg { font-size: .82rem; margin-top: 3px; color: var(--text-dark); }

/* Gift cards */
.gift-cards-grid {
    display: flex; flex-direction: column; gap: 10px;
    margin-top: 12px; padding: 0 10px;
}
.gift-card {
    border-radius: 5px; padding: 10px; text-align: center;
    color: #EEEEEE;
}
.gift-card.card-a { background: var(--primary-lighter); }
.gift-card.card-b { background: var(--primary); }
.gift-card.card-c { background: var(--primary-dark); }
.gift-card .gc-bank {
    font-family: var(--font-detail); font-size: 19px;
    font-weight: 500; letter-spacing: 0.4px;
}
.gift-card .gc-name {
    font-family: var(--font-detail); font-size: 15px;
    font-weight: 500; letter-spacing: 0.4px;
}
.gift-card .gc-number {
    font-family: var(--font-detail); font-size: 15px;
    font-weight: 500; letter-spacing: 0.4px;
}
.btn-copy {
    display: inline-flex; align-items: center; gap: 4px;
    background: #E0E0E0; color: var(--text-muted);
    border: none; border-radius: 4px; padding: 5px 10px;
    font-family: 'Manuale', serif; font-size: 13px;
    font-weight: 600; cursor: pointer; margin-top: 5px;
}

/* ===== GALERI ===== */
.gallery-section {
    background: var(--bg-white); padding: 50px 5px; text-align: center;
}
.gallery-section .section-title {
    font-family: var(--font-heading); font-size: 20px;
    font-weight: 600; color: var(--text-muted);
    letter-spacing: 3.7px;
}
.gallery-section .sub-title {
    font-family: var(--font-heading); font-size: 17px;
    font-weight: 600; color: var(--text-muted);
    letter-spacing: 3.7px;
}
.gallery-grid {
    display: grid; grid-template-columns: 1fr 1fr;
    gap: 6px; margin-top: 16px; padding: 0 5px;
}
.gallery-grid img {
    width: 100%; aspect-ratio: 1; object-fit: cover;
    border-radius: 3px; transition: transform .4s ease;
}
.gallery-grid img:hover { transform: scale(1.04); }

/* ===== AKHIR (Closing) ===== */
.closing-section {
    position: relative; overflow: hidden;
    min-height: 50vh; text-align: center;
}
.closing-bg-slideshow {
    position: absolute; inset: 0; z-index: 0;
}
.closing-bg-slideshow .slide {
    position: absolute; inset: 0;
    background-size: cover; background-position: center;
    opacity: 0; transition: opacity 2.5s ease;
}
.closing-bg-slideshow .slide.active { opacity: 1; }
.closing-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(80deg, var(--primary-dark) 29%, #C27E7E 72%);
    opacity: 0.45; z-index: 1;
}
.closing-content {
    position: relative; z-index: 3;
    padding: 50px 15px; display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    min-height: 50vh;
}
.closing-content .label-wedding {
    font-family: var(--font-heading); font-weight: 600;
    font-size: 16px; color: var(--text-white);
    text-decoration: overline; letter-spacing: 2.8px;
}
.closing-content .name-display {
    font-family: var(--font-name); font-size: 28px;
    font-weight: 600; color: var(--text-white); letter-spacing: 1px;
}
.closing-section .triangle-bottom svg path { fill: var(--bg-white); }

/* Copyright */
.copyright-bar {
    background: var(--bg-white); padding: 15px; text-align: center;
}
.copyright-bar h5 {
    font-family: 'Italiana', serif; font-weight: 600;
    font-size: 16px; color: #373D44; letter-spacing: 2.9px;
}

/* ===== BOTTOM NAV THEME ===== */
.bottom-nav .nav-inner {
    background: var(--bg-white); border-radius: 10px;
}
.bottom-nav .nav-item {
    color: #565553; background: var(--bg-white);
    border-radius: 5px; padding: 3px 2px;
    font-size: 1rem;
}
.bottom-nav .nav-item:hover,
.bottom-nav .nav-item.active {
    background: var(--btn-hover); color: #fff;
}
.music-toggle {
    background: rgba(216,216,216,.85); color: #565553;
}

/* ===== ANIMATIONS ===== */
@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

/* ===== RESPONSIVE ===== */
@media (max-width: 400px) {
    .cover-inner .name-display { font-size: 24px; }
    .home-content .name-display { font-size: 24px; }
    .closing-content .name-display { font-size: 24px; }
    .pengantin-section .greeting { font-size: 12px; }
    .pengantin-section .intro-text { font-size: 9px; }
    .mp-col-photo img { height: 240px; }
    .gift-card .gc-bank { font-size: 16px; }
    .gift-card .gc-name, .gift-card .gc-number { font-size: 13px; }
}
</style>
@endsection

{{-- ===== BODY ===== --}}
@section('body')

{{-- ====================== COVER ====================== --}}
<section class="cover-section" id="header">
    <div class="cover-bg"
         style="background-image:url('{{ $photos[0] ?? 'https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=600&auto=format&fit=crop' }}')">
    </div>

    <div class="cover-inner">
        <div data-aos="fade-in" data-aos-duration="1200">
            <p class="label-wedding">the wedding</p>
            <hr style="border-color:#fff; width:38%; margin-left:auto; margin-right:0; opacity:.5">
            <h1 class="name-display">{{ $namaWanita }} & {{ $namaPria }}</h1>
        </div>

        <div style="height:218px"></div>

        <div data-aos="fade-in" data-aos-duration="1200" data-aos-delay="100">
            <p class="guest-label">dear</p>
            <p class="guest-name">{{ $guestName }}</p>
        </div>

        <div data-aos="fade-in" data-aos-duration="1200" data-aos-delay="200">
            <button class="btn-open" id="tombol-buka" onclick="openInvitation()">
                <i class="bi bi-envelope-open"></i> Buka Undangan
            </button>
        </div>
    </div>
</section>

{{-- ====================== MAIN CONTENT ====================== --}}
<div id="mainContent" style="visibility:hidden">

    {{-- ======== HOME ======== --}}
    <section class="home-section" id="buka">
        <div class="home-bg-slideshow" id="slideshow">
            @foreach($photos as $i => $photo)
                <div class="slide {{ $i === 0 ? 'active' : '' }}"
                     style="background-image:url('{{ $photo }}')"></div>
            @endforeach
            @if(count($photos) === 0)
                <div class="slide active"
                     style="background-image:url('https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=600&auto=format&fit=crop')"></div>
            @endif
        </div>
        <div class="home-overlay"></div>

        <div class="home-content">
            <p class="label-wedding" data-aos="fade-in" data-aos-duration="1200">the wedding</p>
            <h2 class="name-display" data-aos="fade-in" data-aos-duration="1200" data-aos-delay="200">{{ $namaWanita }} & {{ $namaPria }}</h2>
            <p class="date-display" data-aos="fade-in" data-aos-duration="1200">
                @if(!empty($akad['tanggal']))
                    {{ \Carbon\Carbon::parse($akad['tanggal'])->translatedFormat('l, d F Y') }}
                @else
                    Tanggal Akan Diumumkan
                @endif
            </p>

            <a href="#acara" class="btn-save-date" data-aos="fade-in" data-aos-duration="1200" data-aos-delay="150">
                <i class="bi bi-calendar-event"></i> Save The Date
            </a>

            <div style="height:199px"></div>
        </div>
    </section>

    {{-- ======== PENGANTIN ======== --}}
    <section class="pengantin-section" id="mempelai">
        <p class="greeting" data-aos="fade-in" data-aos-duration="1200">Assalamu'alaikum wr wb</p>
        <div style="height:8px"></div>
        <p class="intro-text" data-aos="fade-in" data-aos-duration="1200">
            Segala Puji Bagi Allah SWT yang telah menjadikan hambanya hidup berpasang-pasangan.
            Dengan memohon Ridho, Rahmat, dan Berkah Allah SWT, kami bermaksud untuk mengundang
            Saudara/i dalam acara pernikahan yang kami selenggarakan.
        </p>
        <div style="height:10px"></div>

        {{-- Mempelai Pria --}}
        <div class="pengantin-row" data-aos="fade-in" data-aos-duration="1200" data-aos-delay="100">
            <div class="mp-col-photo">
                <img src="{{ $pria['foto'] ?? ($photos[1] ?? 'https://images.unsplash.com/photo-1583939003579-730e3918a45a?q=80&w=400&auto=format&fit=crop') }}"
                     alt="{{ $pria['nama_lengkap'] ?? 'Mempelai Pria' }}" loading="lazy">
                <p class="mp-name">{{ $pria['nama_lengkap'] ?? 'Putra Pratama, SE' }}</p>
                <p class="mp-parent">{{ $pria['anak_ke'] ?? 'Putra Pertama' }} dari</p>
                <p class="mp-parent">{!! $pria['orang_tua'] ?? 'Bapak ... & Ibu ...' !!}</p>
                @if(!empty($pria['instagram']))
                    <a href="https://instagram.com/{{ $pria['instagram'] }}" class="btn-ig" target="_blank">
                        <i class="bi bi-instagram"></i> {{ $pria['instagram'] }}
                    </a>
                @endif
            </div>
            <div class="mp-col-label">
                <span class="vertical-text" data-aos="fade-left" data-aos-duration="1200" data-aos-delay="150">
                    P R I A
                </span>
            </div>
        </div>

        {{-- Separator --}}
        <div class="mp-separator">
            <span class="amp">&</span>
        </div>

        {{-- Mempelai Wanita --}}
        <div class="pengantin-row" data-aos="fade-in" data-aos-duration="1200" data-aos-delay="200">
            <div class="mp-col-label">
                <span class="vertical-text" data-aos="fade-right" data-aos-duration="1200" data-aos-delay="250">
                    W A N I T A
                </span>
            </div>
            <div class="mp-col-photo left">
                <img src="{{ $wanita['foto'] ?? ($photos[2] ?? 'https://images.unsplash.com/photo-1544928147-79a2dbc1f389?q=80&w=400&auto=format&fit=crop') }}"
                     alt="{{ $wanita['nama_lengkap'] ?? 'Mempelai Wanita' }}" loading="lazy">
                <p class="mp-name">{{ $wanita['nama_lengkap'] ?? 'Putri Pratiwi, SE' }}</p>
                <p class="mp-parent">{{ $wanita['anak_ke'] ?? 'Putri Pertama' }} dari</p>
                <p class="mp-parent">{!! $wanita['orang_tua'] ?? 'Bapak ... & Ibu ...' !!}</p>
                @if(!empty($wanita['instagram']))
                    <a href="https://instagram.com/{{ $wanita['instagram'] }}" class="btn-ig" target="_blank">
                        <i class="bi bi-instagram"></i> {{ $wanita['instagram'] }}
                    </a>
                @endif
            </div>
        </div>
    </section>

    {{-- ======== ACARA ======== --}}
    <section class="acara-section" id="acara">
        {{-- Triangle top --}}
        <div class="triangle-divider top">
            <svg viewBox="0 0 1200 18" preserveAspectRatio="none">
                <polygon points="600,18 0,0 1200,0" fill="#FFFFFF"/>
            </svg>
        </div>

        <div style="height:32px"></div>
        <h3 class="section-title" data-aos="fade-in" data-aos-duration="1200">The Wedding</h3>
        <div style="height:10px"></div>
        <p class="ayat-text" data-aos="fade-in" data-aos-duration="1200">
            "Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan untukmu isteri-isteri dari
            jenismu sendiri, supaya kamu cenderung dan merasa tenteram kepadanya, dan dijadikan-nya di
            antaramu rasa kasih dan sayang. Sesungguhnya pada yang demikian itu benar-benar terdapat
            tanda-tanda bagi kamu yang berpikir."
            <br><br>AR-RUM AYAT : 21
        </p>

        <div style="height:32px"></div>

        {{-- AKAD --}}
        @if(!empty($akad['tanggal']))
        <div class="acara-event-row" data-aos="fade-right" data-aos-duration="1200" data-aos-delay="100">
            <div class="acara-label-col">
                <span class="vertical-text" data-aos="fade-left" data-aos-duration="1200" data-aos-delay="50">A K A D &nbsp; N I K A H</span>
            </div>
            <div class="acara-detail-col" data-aos="fade-right" data-aos-duration="1200" data-aos-delay="100">
                <p class="event-date">{{ \Carbon\Carbon::parse($akad['tanggal'])->translatedFormat('l, d F Y') }}</p>
                <p class="event-time">{{ $akad['waktu_mulai'] ?? '08.00' }} - {{ $akad['waktu_selesai'] ?? '10.00' }} WIB</p>
                <div class="event-venue">
                    {!! $akad['lokasi'] ?? 'Lokasi akan diumumkan' !!}
                </div>
                @if(!empty($akad['maps_url']))
                    <br>
                    <a href="{{ $akad['maps_url'] }}" class="btn-maps" target="_blank">
                        <i class="bi bi-geo-alt-fill"></i> MAPS LOKASI
                    </a>
                @endif
            </div>
        </div>
        @endif

        <div style="height:15px; border-top:2px dotted #fff; margin:15px 20px 0"></div>

        {{-- RESEPSI --}}
        @if(!empty($resepsi['tanggal']))
        <div class="acara-event-row" style="flex-direction:row-reverse" data-aos="fade-left" data-aos-duration="1200" data-aos-delay="150">
            <div class="acara-label-col">
                <span class="vertical-text" data-aos="fade-right" data-aos-duration="1200" data-aos-delay="150">R E S E P S I</span>
            </div>
            <div class="acara-detail-col right" data-aos="fade-left" data-aos-duration="1200" data-aos-delay="200">
                <p class="event-date">{{ \Carbon\Carbon::parse($resepsi['tanggal'])->translatedFormat('l, d F Y') }}</p>
                <p class="event-time">{{ $resepsi['waktu_mulai'] ?? '10.00' }} - {{ $resepsi['waktu_selesai'] ?? 'Selesai' }} WIB</p>
                <div class="event-venue right-align">
                    {!! $resepsi['lokasi'] ?? 'Lokasi akan diumumkan' !!}
                </div>
                @if(!empty($resepsi['maps_url']))
                    <br>
                    <a href="{{ $resepsi['maps_url'] }}" class="btn-maps" target="_blank">
                        <i class="bi bi-geo-alt-fill"></i> MAPS LOKASI
                    </a>
                @endif

                {{-- Save The Date / Google Calendar --}}
                @if(!empty($akad['tanggal']))
                    @php
                        $calStart = \Carbon\Carbon::parse($akad['tanggal'])->format('Ymd');
                        $calEnd   = \Carbon\Carbon::parse($akad['tanggal'])->addDay()->format('Ymd');
                        $calUrl   = "https://calendar.google.com/calendar/r/eventedit?text=Pernikahan+{$namaWanita}+%26+{$namaPria}&dates={$calStart}/{$calEnd}&details=Undangan+Pernikahan&location=" . urlencode($akad['lokasi'] ?? '');
                    @endphp
                    <br>
                    <a href="{{ $calUrl }}" class="btn-calendar" target="_blank">
                        <i class="bi bi-calendar-plus"></i> Save The Date
                    </a>
                @endif
            </div>
        </div>
        @endif

        <div style="height:40px"></div>

        {{-- Triangle bottom --}}
        <div class="triangle-divider bottom">
            <svg viewBox="0 0 1200 18" preserveAspectRatio="none">
                <polygon points="600,0 0,18 1200,18" fill="#FFFFFF"/>
            </svg>
        </div>
    </section>

    {{-- ======== WISH & GIFT ======== --}}
    <section class="wish-section" id="wish">
        <h3 class="section-title" data-aos="fade-in" data-aos-duration="1200">Wish & Gift</h3>
        <div style="height:15px"></div>
        <hr style="width:47%; margin:0 auto; opacity:.3">
        <h4 class="sub-title" data-aos="fade-in" data-aos-duration="1200">Wish</h4>

        {{-- Guestbook --}}
        <div class="rsvp-form" data-aos="fade-in" data-aos-duration="800">
            @if(session('success_rsvp'))
                <div class="alert alert-success small">{{ session('success_rsvp') }}</div>
            @else
                <form action="{{ route('rsvp.store', $invitation->slug) }}" method="POST">
                    @csrf
                    <div class="mb-2">
                        <input type="text" name="name" class="form-control" required placeholder="Nama Anda">
                    </div>
                    <div class="row g-2 mb-2">
                        <div class="col-6">
                            <select name="status" class="form-select" required>
                                <option value="attending">Hadir</option>
                                <option value="not_attending">Tidak Hadir</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <select name="jumlah_tamu" class="form-select" required>
                                @for($i=1;$i<=5;$i++)
                                    <option value="{{ $i }}">{{ $i }} Orang</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="mb-2">
                        <textarea name="message" class="form-control" rows="3" placeholder="Tulis ucapan & doa..."></textarea>
                    </div>
                    <button type="submit" class="btn-submit">Kirim</button>
                </form>
            @endif
        </div>

        <div class="guestbook-list" data-aos="fade-up" data-aos-duration="600">
            @forelse($invitation->guestbooks()->latest()->get() as $guest)
                <div class="gb-item">
                    <span class="gb-name">{{ $guest->name }}
                        @if($guest->status == 'attending')
                            <span class="badge bg-success" style="font-size:.65rem">Hadir</span>
                        @else
                            <span class="badge bg-secondary" style="font-size:.65rem">Absen</span>
                        @endif
                        <span class="badge bg-light text-dark border" style="font-size:.65rem">{{ $guest->jumlah_tamu }} Org</span>
                    </span>
                    <div class="gb-date">{{ $guest->created_at->format('d M Y H:i') }}</div>
                    <div class="gb-msg">{{ $guest->message }}</div>
                </div>
            @empty
                <p class="small mt-2 text-muted">Belum ada ucapan. Jadilah yang pertama! 💕</p>
            @endforelse
        </div>

        <div style="height:20px"></div>
        <hr style="width:47%; margin:0 auto; opacity:.3">
        <h4 class="sub-title" data-aos="fade-in" data-aos-duration="1200">Gift</h4>

        <div class="gift-cards-grid">
            @if(!empty($fitur['amplop_digital']))
                @foreach($fitur['amplop_digital'] as $idx => $amp)
                    @php $cardClass = ['card-a','card-b','card-c'][$idx % 3]; @endphp
                    <div class="gift-card {{ $cardClass }}" data-aos="fade-in" data-aos-duration="1200" data-aos-delay="{{ 200 + ($idx * 100) }}">
                        <p class="gc-bank">{{ $amp['bank'] ?? 'Bank' }}</p>
                        <p class="gc-name">{{ $amp['nama'] ?? $namaPria }}</p>
                        <p class="gc-number">{{ $amp['nomor'] ?? '-' }}</p>
                        <button class="btn-copy" onclick="copyText('{{ $amp['nomor'] ?? '' }}')">
                            <i class="bi bi-clipboard"></i> Salin
                        </button>
                    </div>
                @endforeach
            @else
                <div class="gift-card card-a" data-aos="fade-in" data-aos-duration="1200" data-aos-delay="200">
                    <p class="gc-bank">BCA</p>
                    <p class="gc-name">{{ $pria['nama_lengkap'] ?? 'Nama Penerima' }}</p>
                    <p class="gc-number">XXXXXXXXXX</p>
                    <button class="btn-copy" onclick="copyText('XXXXXXXXXX')"><i class="bi bi-clipboard"></i> Salin</button>
                </div>
                <div class="gift-card card-b" data-aos="fade-in" data-aos-duration="1200" data-aos-delay="300">
                    <p class="gc-bank">BCA</p>
                    <p class="gc-name">{{ $wanita['nama_lengkap'] ?? 'Nama Penerima' }}</p>
                    <p class="gc-number">XXXXXXXXXX</p>
                    <button class="btn-copy" onclick="copyText('XXXXXXXXXX')"><i class="bi bi-clipboard"></i> Salin</button>
                </div>
            @endif
        </div>
    </section>

    {{-- ======== GALERI ======== --}}
    <section class="gallery-section" id="galeri">
        <h3 class="section-title" data-aos="fade-in" data-aos-duration="1200">The Moment</h3>
        <div style="height:15px"></div>
        <hr style="width:47%; margin:0 auto 0 5px; opacity:.3">
        <h4 class="sub-title" style="text-align:left; padding-left:5px" data-aos="fade-in" data-aos-duration="1200">Galeri</h4>

        @if(count($photos) > 0)
            <div class="gallery-grid">
                @foreach($photos as $i => $photo)
                    <img src="{{ $photo }}" alt="Gallery {{ $i+1 }}" loading="lazy"
                         data-aos="fade-in" data-aos-duration="800" data-aos-delay="{{ $i * 80 }}">
                @endforeach
            </div>
        @else
            <p class="small mt-3 text-muted">Galeri belum tersedia.</p>
        @endif
    </section>

    {{-- ======== AKHIR (Closing) ======== --}}
    <section class="closing-section" id="penutup">
        <div class="closing-bg-slideshow" id="closingSlideshow">
            @foreach($photos as $i => $photo)
                <div class="slide {{ $i === 0 ? 'active' : '' }}"
                     style="background-image:url('{{ $photo }}')"></div>
            @endforeach
            @if(count($photos) === 0)
                <div class="slide active"
                     style="background-image:url('https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=600&auto=format&fit=crop')"></div>
            @endif
        </div>
        <div class="closing-overlay"></div>

        <div class="closing-content">
            <p class="label-wedding" data-aos="fade-in" data-aos-duration="1200">the wedding</p>
            <h2 class="name-display" data-aos="fade-in" data-aos-duration="1200" data-aos-delay="200">{{ $namaWanita }} & {{ $namaPria }}</h2>
        </div>

        {{-- Triangle bottom --}}
        <div class="triangle-divider bottom triangle-bottom">
            <svg viewBox="0 0 1200 24" preserveAspectRatio="none">
                <polygon points="600,0 0,24 1200,24" fill="#FFFFFF"/>
            </svg>
        </div>
    </section>

    {{-- ======== COPYRIGHT ======== --}}
    <div class="copyright-bar" style="padding-bottom:80px">
        <h5>{{ $globalName }}</h5>
    </div>
</div>
@endsection

{{-- ===== BOTTOM NAV ===== --}}
@section('bottom-nav')
<nav class="bottom-nav hidden" id="bottomNav">
    <div class="nav-inner">
        <a href="#buka" class="nav-item active"><i class="bi bi-house"></i></a>
        <a href="#mempelai" class="nav-item"><i class="bi bi-heart"></i></a>
        <a href="#acara" class="nav-item"><i class="bi bi-calendar3"></i></a>
        <a href="#galeri" class="nav-item"><i class="bi bi-images"></i></a>
        <a href="#wish" class="nav-item"><i class="bi bi-chat-dots"></i></a>
    </div>
</nav>
@endsection

{{-- ===== TEMPLATE-SPECIFIC SCRIPTS ===== --}}
@section('scripts')
<script>
/* ===== Background Slideshow (Home) ===== */
(function() {
    const slides = document.querySelectorAll('#slideshow .slide');
    if (slides.length <= 1) return;
    let current = 0;
    setInterval(() => {
        slides[current].classList.remove('active');
        current = (current + 1) % slides.length;
        slides[current].classList.add('active');
    }, 3000);
})();

/* ===== Background Slideshow (Closing) ===== */
(function() {
    const slides = document.querySelectorAll('#closingSlideshow .slide');
    if (slides.length <= 1) return;
    let current = 0;
    setInterval(() => {
        slides[current].classList.remove('active');
        current = (current + 1) % slides.length;
        slides[current].classList.add('active');
    }, 3500);
})();
</script>
@endsection
