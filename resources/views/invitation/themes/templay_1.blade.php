{{--
  ==========================================================================
   TEMPLAY 01 — Dark Indigo Glassmorphism Wedding Template
   File : resources/views/invitation/themes/templay_1.blade.php
   blade_path : invitation.themes.templay_1

   Extends : invitation.themes.layouts.invitation
   Theme  : Dark indigo (#12193A / #201761), white text, Caramel script
   Effects: Glassmorphism cards, wave SVG separators, zoomIn, fadeInDown
  ==========================================================================
--}}
@extends('invitation.themes.layouts.invitation')

{{-- ===== Extract data before sections are evaluated ===== --}}
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

    $photos = collect($galeri)
        ->filter(fn($v, $k) => str_starts_with($k, 'foto_') && $v)
        ->values()->all();

    $guestName    = urldecode(request('to', 'Tamu Undangan'));
    $primaryColor = $fitur['primary_color'] ?? '#333380';
@endphp

{{-- ===== CSS VARIABLES ===== --}}
@section('css-variables')
    --primary: {{ $primaryColor ?? '#333380' }};
    --bg-dark: #12193A;
    --bg-dark-alt: #201761;
    --bg-gradient-start: #20176170;
    --bg-gradient-end: #12193A;
    --text-light: #F0F3F5;
    --text-white: #FFFFFF;
    --font-script: 'Caramel', cursive;
    --font-heading: 'Montserrat', sans-serif;
    --font-body: 'Montserrat', sans-serif;
@endsection

{{-- ===== TEMPLATE-SPECIFIC STYLES ===== --}}
@section('styles')
<style>
body {
    font-family: var(--font-body);
    color: var(--text-light);
    background: var(--bg-dark);
}

/* ===== COVER ===== */
.cover-section {
    min-height: 100vh; width: 100%; position: fixed; top: 0;
    left: 50%; transform: translateX(-50%); max-width: 480px;
    z-index: 999; display: flex; align-items: center;
    justify-content: center; overflow: hidden;
}
.cover-bg {
    position: absolute; inset: 0;
    background-size: cover; background-position: center;
}
.cover-bg::after {
    content: ''; position: absolute; inset: 0;
    background: #201761; opacity: 0.64;
    filter: blur(3.7px) brightness(0.81) contrast(1.62) saturate(1.24) hue-rotate(136deg);
}
.cover-inner {
    position: relative; z-index: 4;
    width: 90%; text-align: right; padding: 25px;
}
.cover-inner .label-wedding {
    font-family: var(--font-heading); font-weight: 600;
    font-size: 24px; color: var(--text-white);
}
.cover-inner .name-script {
    font-family: var(--font-script); font-size: 60px;
    color: var(--text-white); line-height: 0.9;
    margin-top: -20px;
}
.cover-inner .name-script-mobile { font-size: 50px; }
.cover-guest-card {
    margin-top: 50px; padding: 20px 25px; text-align: center;
}
.cover-guest-card .guest-label {
    font-family: var(--font-heading); font-weight: 500;
    font-size: 18px; color: #FDFDFD;
}
.cover-guest-card .guest-name {
    font-family: var(--font-heading); font-weight: 500;
    font-size: 20px; color: #F8F9FA;
}
.cover-guest-card .guest-sub {
    font-family: var(--font-heading); font-weight: 500;
    font-size: 18px; color: var(--text-white);
}
.btn-open {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(242, 247, 242, 0.4); color: #FDFDFD;
    border: 2px solid var(--text-white); border-radius: 10px;
    padding: 11px 30px; font-size: 14px; font-family: var(--font-heading);
    font-weight: 500; cursor: pointer; margin-top: 12px;
    transition: all .3s;
}
.btn-open:hover { background: rgba(255,255,255,.25); }

/* ===== HOME (Fixed section) ===== */
.home-section {
    position: relative; overflow: hidden;
    min-height: 100vh; text-align: center;
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
    background: #201761; opacity: 0.44; z-index: 1;
}
.home-content {
    position: relative; z-index: 3;
    padding: 25px; display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    min-height: 100vh;
}
.home-content .title-event {
    font-family: var(--font-heading); font-weight: 500;
    font-size: 28px; color: var(--text-white);
}
.home-content .name-script {
    font-family: var(--font-script); font-size: 60px;
    color: var(--text-white); line-height: 0.9;
    margin-top: -20px;
}
.home-content .date-display {
    font-family: var(--font-heading); font-weight: 500;
    font-size: 28px; color: var(--text-white);
}
.home-content .location-text {
    font-family: var(--font-heading); font-weight: 500;
    font-size: 18px; color: var(--text-white);
}

/* ===== COUNTDOWN ===== */
.countdown-boxes {
    display: flex; justify-content: center; gap: 5px; margin: 16px auto;
}
.cd-box {
    border: 2px solid var(--text-white); border-radius: 8px;
    padding: 5px 5px; min-width: 55px; text-align: center;
    background: transparent;
}
.cd-box .cd-num {
    font-family: 'RocknRoll One', 'Montserrat', sans-serif;
    font-size: 16px; font-weight: 300; color: var(--text-white);
}
.cd-box .cd-label {
    font-family: 'Roboto', sans-serif; font-size: 12px;
    font-weight: 400; color: var(--text-white);
    letter-spacing: 2px; line-height: 25px;
}

/* ===== MEMPELAI ===== */
.mempelai-section {
    background: var(--bg-dark); padding: 50px 30px;
    text-align: center;
}
.mempelai-section .greeting {
    font-family: var(--font-heading); font-weight: 500;
    font-size: 16px; color: var(--text-light); line-height: 20px;
}
.mempelai-photo-wrapper {
    position: relative; margin: 10px auto 30px;
    overflow: hidden;
}
.mempelai-photo-wrapper::after {
    content: ''; position: absolute; inset: 0;
    background-size: cover; background-position: center;
}
.mempelai-photo-inner {
    position: relative; z-index: 2;
    padding: 50px 30px; text-align: center;
}
.mempelai-photo-inner .name-script {
    font-family: var(--font-script); font-size: 50px;
    color: var(--text-light); font-weight: 500;
}
.mempelai-photo-inner .child-info {
    font-family: var(--font-heading); font-weight: 600;
    font-size: 16px; color: var(--text-light);
}
.mempelai-photo-inner .parent-info {
    font-family: var(--font-heading); font-weight: 600;
    font-size: 16px; color: var(--text-light);
    margin-top: -10px;
}
.mempelai-closing {
    font-family: var(--font-heading); font-weight: 500;
    font-size: 16px; color: var(--text-light); line-height: 20px;
}

/* ===== ACARA ===== */
.acara-section {
    position: relative; overflow: hidden;
    padding: 50px 30px; text-align: center;
}
.acara-section .section-title {
    font-family: var(--font-script); font-size: 50px;
    font-weight: 500; color: var(--text-light);
}
.acara-section .section-desc {
    font-family: var(--font-heading); font-weight: 500;
    font-size: 16px; color: var(--text-white); line-height: 20px;
}
.acara-block { margin-bottom: 20px; text-align: left; padding-left: 30px; }
.acara-block .event-title {
    font-family: var(--font-script); font-size: 50px;
    font-weight: 500; color: var(--text-light);
}
.acara-block .icon-list {
    list-style: none; padding: 0; margin: 0;
}
.acara-block .icon-list li {
    display: flex; align-items: flex-start; gap: 16px;
    font-family: var(--font-heading); font-weight: 500;
    font-size: 16px; color: var(--text-white);
    margin-bottom: 10px;
}
.acara-block .icon-list li i {
    font-size: 20px; color: var(--text-white); flex-shrink: 0;
    margin-top: 2px;
}
.acara-closing {
    font-family: var(--font-heading); font-weight: 500;
    font-size: 16px; color: var(--text-white);
    line-height: 20px; text-align: center;
}

/* ===== GALLERY ===== */
.gallery-section {
    position: relative; overflow: hidden;
    padding: 50px 30px; text-align: center;
}
.gallery-section::before {
    content: ''; position: absolute; inset: 0;
    background: linear-gradient(184deg, #20176170 30%, #12193A 50%);
    z-index: 0;
}
.gallery-section > * { position: relative; z-index: 1; }
.gallery-section .section-title {
    font-family: var(--font-script); font-size: 50px;
    font-weight: 500; color: var(--text-light);
}
.gallery-grid {
    display: grid; grid-template-columns: 1fr 1fr;
    gap: 6px; margin-top: 16px;
}
.gallery-grid img {
    width: 100%; aspect-ratio: 1; object-fit: cover;
    border-radius: 3px; transition: transform .4s ease;
}
.gallery-grid img:hover { transform: scale(1.04); }

/* ===== UCAPAN & DOA ===== */
.wish-section {
    background: var(--bg-dark); padding: 50px 30px; text-align: center;
}
.wish-section .section-title {
    font-family: var(--font-script); font-size: 50px;
    font-weight: 500; color: var(--text-light);
}
.wish-section blockquote {
    font-family: var(--font-heading); font-weight: 500;
    font-size: 18px; color: var(--text-white);
    line-height: 20px; letter-spacing: 1px;
    margin: 0 30px; border: none; padding: 0;
}
.wish-section .blockquote-footer {
    font-family: var(--font-heading); font-weight: 500;
    font-size: 14px; color: var(--text-white);
    line-height: 20px; margin-top: 15px;
}
.wish-section .guestbook-title {
    font-family: var(--font-script); font-size: 50px;
    font-weight: 500; color: var(--text-light);
}
.rsvp-form { width: 100%; max-width: 340px; margin: 16px auto 0; }
.rsvp-form .form-control, .rsvp-form .form-select {
    background: rgba(255,255,255,0.05); border: 2px solid var(--text-white);
    border-radius: 10px; color: var(--text-white); font-size: .88rem;
}
.rsvp-form .form-control::placeholder { color: rgba(255,255,255,0.5); }
.rsvp-form .form-control:focus, .rsvp-form .form-select:focus {
    background: rgba(255,255,255,0.1); border-color: var(--text-white);
    box-shadow: none; color: var(--text-white);
}
.rsvp-form .form-select option { background: var(--bg-dark); color: var(--text-white); }
.rsvp-form .btn-submit {
    background: rgba(97,97,206,0.08); color: var(--text-white);
    border: 2px solid var(--text-white); border-radius: 10px;
    padding: 10px 0; width: 100%; font-weight: 600; font-size: .88rem;
    transition: .3s;
}
.rsvp-form .btn-submit:hover { background: rgba(255,255,255,0.15); }
.guestbook-list {
    max-height: 280px; overflow-y: auto;
    width: 100%; max-width: 340px; margin: 16px auto 0;
}
.gb-item { border-bottom: 1px solid rgba(255,255,255,0.15); padding: 10px 0; }
.gb-item:last-child { border-bottom: none; }
.gb-item .gb-name { font-weight: 600; font-size: .88rem; color: var(--text-white); }
.gb-item .gb-date { font-size: .68rem; color: rgba(255,255,255,0.6); }
.gb-item .gb-msg { font-size: .82rem; margin-top: 3px; color: rgba(255,255,255,0.8); }

/* ===== GIFT ===== */
.gift-title {
    font-family: var(--font-script); font-size: 50px;
    font-weight: 500; color: var(--text-light);
}
.gift-desc {
    font-family: var(--font-heading); font-size: 16px;
    font-weight: 500; color: var(--text-white);
    line-height: 20px; letter-spacing: 1px; margin: 0 30px;
}
.btn-gift-toggle {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(97,97,206,0.08); color: #F9F1F1;
    border: 2px solid var(--text-white); border-radius: 10px;
    padding: 8px 30px; font-family: var(--font-heading);
    font-size: 16px; font-weight: 600; cursor: pointer;
    margin-top: 12px; transition: .3s;
}
.btn-gift-toggle:hover { background: rgba(255,255,255,0.15); }
.gift-cards {
    display: none; margin-top: 15px;
}
.gift-cards.show { display: flex; flex-wrap: wrap; gap: 12px; justify-content: center; }
.gift-card {
    background: linear-gradient(135deg, #FCFBFFEB, #7F48B62E);
    border-radius: 10px; padding: 16px 12px;
    text-align: center; flex: 1; min-width: 140px; max-width: 200px;
}
.gift-card .bank-logo { height: 50px; margin-bottom: 8px; object-fit: contain; }
.gift-card .head-text {
    font-family: 'Roboto', sans-serif; font-size: 16px;
    font-weight: 500; color: var(--text-white); letter-spacing: .5px;
}
.gift-card .acc-number {
    font-family: 'Roboto', sans-serif; font-size: 16px;
    font-weight: 500; color: var(--text-white);
}
.btn-copy {
    display: inline-flex; align-items: center; gap: 4px;
    background: transparent; color: #F2E6E6;
    border: 1px solid var(--text-white); border-radius: 10px;
    padding: 8px 20px; font-family: 'Roboto', sans-serif;
    font-size: 12px; font-weight: 500; cursor: pointer;
    margin-top: 6px;
}

/* ===== PENUTUP ===== */
.closing-section {
    position: relative; overflow: hidden;
    padding: 25px; text-align: center;
}
.closing-section::before {
    content: ''; position: absolute; inset: 0;
    background: linear-gradient(180deg, #12193A 5%, #2017613D 80%);
    z-index: 0;
}
.closing-section > * { position: relative; z-index: 1; }
.closing-section .thanks-text {
    font-family: var(--font-heading); font-weight: 500;
    font-size: 16px; color: var(--text-light); line-height: 20px;
}
.closing-section .name-script {
    font-family: var(--font-script); font-size: 50px;
    font-weight: 500; color: var(--text-light);
}
.closing-section .family-text {
    font-family: var(--font-script); font-size: 35px;
    font-weight: 500; color: var(--text-light);
}
.copyright-bar {
    background: var(--bg-dark); padding: 15px;
    text-align: center;
}
.copyright-bar h5 {
    font-family: var(--font-heading); font-weight: 500;
    font-size: 14px; color: #EEF2F3;
}

/* ===== BOTTOM NAV THEME ===== */
.bottom-nav .nav-inner {
    background: rgba(255,255,255,0.87); backdrop-filter: blur(4px);
}
.bottom-nav .nav-item { color: var(--primary); }
.bottom-nav .nav-item:hover,
.bottom-nav .nav-item.active {
    background: var(--primary); color: #fff;
}
.music-toggle {
    background: rgba(216,216,216,.85); color: #333;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 400px) {
    .cover-inner .name-script { font-size: 50px; }
    .cover-inner .label-wedding { font-size: 20px; }
    .cover-guest-card .guest-label,
    .cover-guest-card .guest-sub { font-size: 16px; }
    .cover-guest-card .guest-name { font-size: 18px; }
    .home-content .title-event { font-size: 22px; }
    .home-content .name-script { font-size: 50px; }
    .home-content .date-display { font-size: 20px; }
    .home-content .location-text { font-size: 16px; }
    .mempelai-section { padding: 50px 25px; }
    .mempelai-section .greeting { font-size: 14px; }
    .mempelai-photo-inner .name-script { font-size: 50px; }
    .mempelai-photo-inner .child-info,
    .mempelai-photo-inner .parent-info { font-size: 14px; }
    .acara-section { padding: 50px 25px; }
    .acara-section .section-title { font-size: 40px; }
    .acara-block .event-title { font-size: 40px; }
    .acara-block .icon-list li { font-size: 14px; }
    .gallery-section { padding: 50px 25px; }
    .gallery-section .section-title { font-size: 40px; }
    .wish-section blockquote { font-size: 14px; margin: 0 5px; }
    .wish-section .blockquote-footer { font-size: 11px; }
    .gift-desc { font-size: 14px; margin: 0 5px; }
    .closing-section .name-script { font-size: 40px; }
    .closing-section .thanks-text { font-size: 14px; }
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
        <div data-aos="zoom-in" data-aos-duration="800">
            <p class="label-wedding">The Wedding Of</p>
            <h1 class="name-script">{{ $namaWanita }}</h1>
            <h1 class="name-script" style="margin-top:-10px">dan</h1>
            <h1 class="name-script">{{ $namaPria }}</h1>
        </div>

        <div class="cover-guest-card glass" data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">
            <p class="guest-label">Kepada Yth :</p>
            <p class="guest-label" style="margin-top:-10px">Bapak/Ibu/Saudara/i</p>
            <p class="guest-name">{{ $guestName }}</p>
            <p class="guest-sub">Di Tempat</p>
        </div>

        <div data-aos="bounce-in" data-aos-duration="600" data-aos-delay="500">
            <button class="btn-open" id="tombol-buka" onclick="openInvitation()">
                <i class="bi bi-envelope-open"></i> Buka Undangan
            </button>
        </div>
    </div>
</section>

{{-- ====================== MAIN CONTENT ====================== --}}
<div id="mainContent" style="visibility:hidden">

    {{-- ======== HOME (Fixed) ======== --}}
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
            <h2 class="title-event" data-aos="fade-down" data-aos-duration="800">Akad & Resepsi</h2>
            <div style="height:53px"></div>

            <div data-aos="zoom-in" data-aos-duration="800">
                <h2 class="name-script">{{ $wanita['nama_lengkap'] ?? 'Putri Pratiwi' }}</h2>
                <h2 class="name-script">dan</h2>
                <h2 class="name-script">{{ $pria['nama_lengkap'] ?? 'Putra Pratama' }}</h2>
            </div>
            <div style="height:16px"></div>

            <p class="date-display" data-aos="fade-down" data-aos-duration="800">
                @if(!empty($akad['tanggal']))
                    {{ \Carbon\Carbon::parse($akad['tanggal'])->translatedFormat('d F Y') }}
                @else
                    Tanggal Akan Diumumkan
                @endif
            </p>

            {{-- Countdown --}}
            <div class="countdown-boxes" data-aos="zoom-in" data-aos-duration="800">
                <div class="cd-box"><div class="cd-num" id="cd-days">0</div><div class="cd-label">Hari</div></div>
                <div class="cd-box"><div class="cd-num" id="cd-hours">0</div><div class="cd-label">Jam</div></div>
                <div class="cd-box"><div class="cd-num" id="cd-mins">0</div><div class="cd-label">Menit</div></div>
                <div class="cd-box"><div class="cd-num" id="cd-secs">0</div><div class="cd-label">Detik</div></div>
            </div>

            <p class="location-text" data-aos="fade-down" data-aos-duration="800">
                {{ $akad['lokasi'] ?? $resepsi['lokasi'] ?? 'Lokasi akan diumumkan' }}
            </p>
        </div>
    </section>

    {{-- ======== MEMPELAI ======== --}}
    <section class="mempelai-section" id="mempelai">
        <div data-aos="zoom-in" data-aos-duration="800">
            <p class="greeting">Assalamu'alaikum Warohmatullahi Wabarokatuh</p>
            <div style="height:10px"></div>
            <p class="greeting">Maha Suci Allah SWT yang telah menciptakan makhlukNya berpasang-pasangan.
                Ya Allah, perkenankanlah dan Ridhoilah putra-putri kami :</p>
        </div>

        {{-- Mempelai Wanita --}}
        <div class="mempelai-photo-wrapper" style="margin-top:20px">
            <div class="mempelai-photo-inner"
                 style="background-image:url('{{ $wanita['foto'] ?? ($photos[1] ?? 'https://images.unsplash.com/photo-1544928147-79a2dbc1f389?q=80&w=400&auto=format&fit=crop') }}');
                        background-size:cover; background-position:center" data-aos="fade-down" data-aos-duration="800">
                <h3 class="name-script">{{ $wanita['nama_lengkap'] ?? 'Putri Pratiwi' }}</h3>
                <p class="child-info">{{ $wanita['anak_ke'] ?? 'Putri' }} dari</p>
                <p class="parent-info">{!! $wanita['orang_tua'] ?? 'Bapak ... <br>& Ibu ...' !!}</p>
            </div>
        </div>

        {{-- Mempelai Pria --}}
        <div class="mempelai-photo-wrapper" style="margin-top:30px">
            <div class="mempelai-photo-inner"
                 style="background-image:url('{{ $pria['foto'] ?? ($photos[2] ?? 'https://images.unsplash.com/photo-1583939003579-730e3918a45a?q=80&w=400&auto=format&fit=crop') }}');
                        background-size:cover; background-position:center" data-aos="fade-down" data-aos-duration="800">
                <h3 class="name-script">{{ $pria['nama_lengkap'] ?? 'Putra Pratama' }}</h3>
                <p class="child-info">{{ $pria['anak_ke'] ?? 'Putra' }} dari</p>
                <p class="parent-info">{!! $pria['orang_tua'] ?? 'Bapak ... <br>& Ibu ...' !!}</p>
            </div>
        </div>

        <div style="height:20px"></div>
        <p class="mempelai-closing" data-aos="zoom-in" data-aos-duration="800">
            Untuk Melaksanakan Syari'at Agama-Mu, Mengikuti Sunnah-Mu,
            dalam membentuk keluarga yang Sakinah, Mawaddah Wa Rohmah.
            Maka Izinkanlah kami menikahkannya.
        </p>
    </section>

    {{-- ======== WAVE TOP ======== --}}
    <div class="wave-separator wave-top">
        <svg viewBox="0 0 1000 100" preserveAspectRatio="none">
            <path d="M0,0 C300,100 700,0 1000,80 L1000,0 L0,0 Z" fill="#12193A"></path>
        </svg>
    </div>

    {{-- ======== ACARA ======== --}}
    <section class="acara-section" id="acara">
        <h3 class="section-title" data-aos="zoom-in" data-aos-duration="800">Akad dan Resepsi</h3>
        <div style="height:8px"></div>
        <p class="section-desc" data-aos="fade-down" data-aos-duration="800">
            Dengan memohon Rahmat dan Ridho Allah, izinkanlah kami berbagi
            Rasa syukur dan kebahagiaan pada Akad dan Resepsi Pernikahan Putra-Putri kami.
        </p>
        <div style="height:16px"></div>

        {{-- AKAD --}}
        @if(!empty($akad['tanggal']))
        <div class="acara-block" data-aos="fade-down" data-aos-duration="800">
            <h4 class="event-title">Akad Nikah</h4>
            <ul class="icon-list" data-aos="zoom-in" data-aos-duration="800">
                <li>
                    <i class="bi bi-calendar3"></i>
                    <span>{{ \Carbon\Carbon::parse($akad['tanggal'])->translatedFormat('d F Y') }}</span>
                </li>
                <li>
                    <i class="bi bi-clock"></i>
                    <span>{{ $akad['waktu_mulai'] ?? '09.00' }} WIB - {{ $akad['waktu_selesai'] ?? 'Selesai' }}</span>
                </li>
                <li>
                    <i class="bi bi-house-door"></i>
                    <span>{!! $akad['lokasi'] ?? 'Lokasi akan diumumkan' !!}</span>
                </li>
            </ul>
        </div>
        @endif

        {{-- RESEPSI --}}
        @if(!empty($resepsi['tanggal']))
        <div class="acara-block" data-aos="fade-down" data-aos-duration="800">
            <h4 class="event-title">Resepsi</h4>
            <ul class="icon-list" data-aos="zoom-in" data-aos-duration="800">
                <li>
                    <i class="bi bi-calendar3"></i>
                    <span>{{ \Carbon\Carbon::parse($resepsi['tanggal'])->translatedFormat('d F Y') }}</span>
                </li>
                <li>
                    <i class="bi bi-clock"></i>
                    <span>{{ $resepsi['waktu_mulai'] ?? '10.00' }} WIB - {{ $resepsi['waktu_selesai'] ?? 'Selesai' }}</span>
                </li>
                <li>
                    <i class="bi bi-house-door"></i>
                    <span>{!! $resepsi['lokasi'] ?? 'Lokasi akan diumumkan' !!}</span>
                </li>
            </ul>
        </div>
        @endif

        <div style="height:10px"></div>
        <p class="acara-closing" data-aos="fade-down" data-aos-duration="800">
            Merupakan suatu kehormatan dan kebahagiaan bagi kami,
            apabila Bapak/Ibu/Saudara/i berkenan hadir untuk memberikan
            Do'a restu kepada kedua mempelai.
        </p>
    </section>

    {{-- ======== WAVE BOTTOM ======== --}}
    <div class="wave-separator">
        <svg viewBox="0 0 1000 100" preserveAspectRatio="none">
            <path d="M0,80 C300,0 700,100 1000,20 L1000,100 L0,100 Z" fill="#150C30"></path>
        </svg>
    </div>

    {{-- ======== GALLERY ======== --}}
    <section class="gallery-section" id="gallery">
        <h3 class="section-title" data-aos="zoom-in" data-aos-duration="800">Kebersamaan Kami</h3>

        @if(count($photos) > 0)
            <div class="gallery-grid">
                @foreach($photos as $i => $photo)
                    <img src="{{ $photo }}" alt="Gallery {{ $i+1 }}" loading="lazy"
                         data-aos="{{ $i % 2 === 0 ? 'fade-right' : 'fade-left' }}"
                         data-aos-duration="600" data-aos-delay="{{ $i * 100 }}">
                @endforeach
            </div>
        @else
            <p class="text-muted small mt-3" style="color:rgba(255,255,255,.5)">Galeri belum tersedia.</p>
        @endif
    </section>

    {{-- ======== UCAPAN & DOA ======== --}}
    <section class="wish-section" id="ucapan">
        <h3 class="section-title" data-aos="zoom-in" data-aos-duration="800">Ucapan dan Do'a</h3>

        <blockquote data-aos="fade-down" data-aos-duration="800">
            <p>Semoga Allah SWT menghimpun yang terserak dari keduanya memberkati mereka berdua,
            meningkatkan kualitas keturunannya sebagai pembuka pintu rakhmat,
            sumber ilmu dan hikmah serta pemberi rasa aman bagi umat."</p>
        </blockquote>
        <p class="blockquote-footer" data-aos="fade-down" data-aos-duration="800">
            Doa Nabi Muhammad SAW, Saat pernikahan putrinya Fatimah Az Zahra dengan Ali bin Abi Thalib.
        </p>

        <div style="height:20px"></div>

        {{-- GUESTBOOK --}}
        <h4 class="guestbook-title" data-aos="zoom-in" data-aos-duration="800">Buku Tamu</h4>

        <div class="rsvp-form" data-aos="zoom-in" data-aos-duration="600">
            @if(session('success_rsvp'))
                <div class="alert alert-success small">{{ session('success_rsvp') }}</div>
            @elseif($invitation->id)
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
            @else
                <p class="small mt-2" style="color:rgba(255,255,255,.5)">Mode Preview — Form RSVP tidak aktif.</p>
            @endif
        </div>

        <div class="guestbook-list" data-aos="fade-up" data-aos-duration="600">
            @if($invitation->id)
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
                    <p class="small mt-2" style="color:rgba(255,255,255,.5)">Belum ada ucapan. Jadilah yang pertama! 💕</p>
                @endforelse
            @else
                <p class="small mt-2" style="color:rgba(255,255,255,.5)">Belum ada ucapan. Jadilah yang pertama! 💕</p>
            @endif
        </div>

        {{-- GIFT / Tanda Kasih --}}
        <div style="height:24px"></div>
        <h4 class="gift-title" data-aos="fade-up">Tanda Kasih</h4>
        <p class="gift-desc" data-aos="fade-down" data-aos-duration="800">
            Doa Restu Bapak/Ibu/Saudara/i merupakan karunia yang sangat berarti bagi kami.
            Dan jika memberi adalah ungkapan tanda kasih, Bapak/Ibu/Saudara/i
            dapat memberi kado secara cashless.
        </p>

        <button class="btn-gift-toggle" onclick="toggleGift()" data-aos="zoom-in">
            <i class="bi bi-gift"></i> Kirim Hadiah
        </button>

        <div class="gift-cards" id="giftCards">
            @if(!empty($fitur['amplop_digital']))
                @foreach($fitur['amplop_digital'] as $amp)
                    <div class="gift-card">
                        <p class="head-text">Transfer ke rekening<br>a.n {{ $amp['nama'] ?? $namaPria }}</p>
                        <p class="acc-number" style="margin-top:8px">{{ $amp['bank'] ?? 'Bank' }}</p>
                        <p class="acc-number">{{ $amp['nomor'] ?? '-' }}</p>
                        <button class="btn-copy" onclick="copyText('{{ $amp['nomor'] ?? '' }}')">
                            <i class="bi bi-copy"></i> Salin
                        </button>
                    </div>
                @endforeach
            @else
                <div class="gift-card">
                    <p class="head-text">Transfer ke rekening<br>a.n {{ $pria['nama_lengkap'] ?? 'Nama Penerima' }}</p>
                    <p class="acc-number" style="margin-top:8px">BNI</p>
                    <p class="acc-number">XXXX XXXX XX</p>
                    <button class="btn-copy" onclick="copyText('XXXXXXXXXX')"><i class="bi bi-copy"></i> Salin</button>
                </div>
                <div class="gift-card">
                    <p class="head-text">Transfer ke rekening<br>a.n {{ $wanita['nama_lengkap'] ?? 'Nama Penerima' }}</p>
                    <p class="acc-number" style="margin-top:8px">Mandiri</p>
                    <p class="acc-number">XXXX XXXX XX</p>
                    <button class="btn-copy" onclick="copyText('XXXXXXXXXX')"><i class="bi bi-copy"></i> Salin</button>
                </div>
            @endif
        </div>
    </section>

    {{-- ======== PENUTUP ======== --}}
    <section class="closing-section" id="penutup">
        <div data-aos="fade-down" data-aos-duration="800">
            <p class="thanks-text">
                Atas do'a dan restu dari Bapak/Ibu/Saudara/I, kami ucapkan banyak terima kasih
            </p>
            <p class="thanks-text" style="margin-top:8px">Wassalamualaikum Warohmatullahi Wabarokatuh</p>
        </div>

        <div style="height:40px"></div>

        <div data-aos="zoom-in" data-aos-duration="800">
            <p class="thanks-text">Kami yang berbahagia</p>
            <h2 class="name-script">{{ $namaWanita }} & {{ $namaPria }}</h2>
            <p class="family-text">
                Keluarga mempelai pria<br>Keluarga mempelai wanita
            </p>
        </div>
    </section>

    {{-- ======== COPYRIGHT ======== --}}
    <div class="copyright-bar" style="padding-bottom:80px">
        <h5>Dibuat Bersama ☕ {{ $globalName }}</h5>
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
        <a href="#gallery" class="nav-item"><i class="bi bi-images"></i></a>
        <a href="#ucapan" class="nav-item"><i class="bi bi-chat-dots"></i></a>
        <a href="#penutup" class="nav-item"><i class="bi bi-gift"></i></a>
    </div>
</nav>
@endsection

{{-- ===== TEMPLATE-SPECIFIC SCRIPTS ===== --}}
@section('scripts')
<script>
/* ===== Background Slideshow ===== */
(function() {
    const slides = document.querySelectorAll('#slideshow .slide');
    if (slides.length <= 1) return;
    let current = 0;
    setInterval(() => {
        slides[current].classList.remove('active');
        current = (current + 1) % slides.length;
        slides[current].classList.add('active');
    }, 2000);
})();

/* ===== Toggle Gift Cards ===== */
function toggleGift() {
    const el = document.getElementById('giftCards');
    el.classList.toggle('show');
}
</script>
@endsection
