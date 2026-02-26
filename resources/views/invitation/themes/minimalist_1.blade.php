{{--
  ============================================================================
   SATUNESIA A1 — Minimalist Elegant Wedding Template
   File : resources/views/invitation/themes/minimalist_1.blade.php
   blade_path : invitation.themes.minimalist_1
  ============================================================================
--}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    @php
        $pria  = $invitation->data_mempelai['pria'] ?? [];
        $wanita = $invitation->data_mempelai['wanita'] ?? [];
        $akad  = $invitation->data_acara['akad'] ?? [];
        $resepsi = $invitation->data_acara['resepsi'] ?? [];
        $galeri = $invitation->data_galeri ?? [];
        $fitur  = $invitation->data_fitur_tambahan ?? [];
        $namaPria = $pria['nama_panggilan'] ?? 'Pria';
        $namaWanita = $wanita['nama_panggilan'] ?? 'Wanita';
        $globalName = $globalAppName ?? 'SuratUlem';

        // Gallery images array (flatten all foto_* keys)
        $photos = collect($galeri)->filter(fn($v, $k) => str_starts_with($k, 'foto_') && $v)->values()->all();

        // Guest name from URL param
        $guestName = request('to', 'Nama Tamu');
    @endphp
    <title>{{ $namaPria }} & {{ $namaWanita }} — The Wedding</title>

    <!-- SEO -->
    <meta name="description" content="Undangan Pernikahan {{ $namaPria }} & {{ $namaWanita }}. Klik untuk melihat detail acara.">
    <meta property="og:title" content="The Wedding of {{ $namaPria }} & {{ $namaWanita }}">
    <meta property="og:description" content="Kami mengundang Bapak/Ibu/Saudara/i untuk hadir pada acara pernikahan kami.">
    <meta property="og:image" content="{{ $photos[0] ?? $globalAppLogo ?? '' }}">
    <meta property="og:url" content="{{ request()->url() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Poppins:wght@300;400;500;600&family=Red+Hat+Display:wght@400;500;600;700&family=Noto+Serif:ital,wght@0,400;0,500;1,400&family=Raleway:wght@400;500&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
/* ===== ROOT ===== */
:root{
    --bg:#fff;
    --bg-dark:#606060;
    --text:#333;
    --text-light:#54595F;
    --accent:#776F6F;
    --white:#fff;
    --navy:#1B2A4A;
    --gold:#D4AF37;
    --gold-light:#F3BE6C;
    --badge-hadir:#3D9A62;
    --badge-absent:#d90a11;
    --font-display:'Poppins',sans-serif;
    --font-serif:'Noto Serif',serif;
    --font-heading:'Playfair Display',serif;
}
*{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
body{
    font-family:var(--font-display);
    color:var(--text);
    background:var(--bg);
    max-width:480px;
    margin:0 auto;
    overflow-x:hidden;
    position:relative;
}

/* ===== GLASSMORPHISM CARD ===== */
.glass-card{
    background:rgba(255,255,255,.12);
    border-radius:16px;
    box-shadow:0 8px 32px rgba(0,0,0,.18);
    backdrop-filter:blur(12px);
    -webkit-backdrop-filter:blur(12px);
    border:1px solid rgba(255,255,255,.25);
    padding:20px 24px;
}

/* ===== COVER (Opening) ===== */
.cover-section{
    min-height:100vh;width:100%;position:fixed;top:0;left:50%;
    transform:translateX(-50%);max-width:480px;z-index:999;
    display:flex;align-items:center;justify-content:center;text-align:center;
    background-color:var(--accent);background-size:cover;background-position:center;
}
.cover-overlay{
    position:absolute;inset:0;
    background:linear-gradient(180deg,rgba(34,34,35,.55) 0%,rgba(34,34,35,.7) 100%);
}
.cover-content{position:relative;z-index:2;color:#fff;padding:0 24px}
.cover-content .label{font-family:var(--font-heading);font-weight:600;font-size:.95rem;letter-spacing:3px;margin-bottom:8px;text-transform:uppercase}
.cover-content .divider{width:50px;height:2px;background:var(--gold);margin:8px auto 16px}
.cover-content .names{font-family:var(--font-heading);font-size:2.6rem;font-weight:600;letter-spacing:1px;line-height:1.2}
.cover-content .dear{font-style:italic;font-size:.88rem;margin-top:16px;font-weight:300;letter-spacing:.5px}
.cover-content .guest-name{font-weight:600;font-size:1.05rem;margin-top:4px}
.btn-open{
    display:inline-flex;align-items:center;gap:10px;margin-top:24px;
    background:var(--navy);color:#fff;border:2px solid var(--gold);
    border-radius:50px;padding:13px 34px;font-family:var(--font-display);
    font-weight:500;font-size:.88rem;cursor:pointer;transition:all .35s ease;
    letter-spacing:.5px;box-shadow:0 4px 15px rgba(212,175,55,.25);
}
.btn-open:hover{background:var(--gold);color:var(--navy);border-color:var(--gold)}
.btn-open i{font-size:1rem}

/* ===== FULL-PAGE SECTIONS ===== */
.inv-section{
    min-height:100vh;display:flex;align-items:center;justify-content:center;
    flex-direction:column;padding:70px 24px;position:relative;overflow:hidden;
    margin-bottom:0;
}

/* ===== HOME ===== */
.home-section{
    background-size:cover;background-position:center;position:relative;
    text-align:right;
}
.home-section::before{
    content:'';position:absolute;inset:0;background:rgba(0,0,0,.45);
}
.home-section .home-content{position:relative;z-index:2;color:#fff;width:100%;padding:0 10px}
.home-section .home-content .label{font-family:var(--font-heading);font-weight:600;font-size:.95rem;letter-spacing:3px;text-transform:uppercase}
.home-section .home-content .names{font-family:var(--font-heading);font-size:2.6rem;font-weight:600;letter-spacing:1px}
.home-section .home-content .date{font-family:var(--font-display);font-size:.88rem;font-weight:500;letter-spacing:1.6px}

/* ===== PENGANTIN ===== */
.pengantin-section{background:var(--bg)}
.pengantin-section .greeting{font-family:var(--font-heading);font-weight:600;font-size:1.3rem;letter-spacing:1px;text-align:center}
.pengantin-section .intro{text-align:center;color:var(--text-light);font-size:.82rem;font-weight:400;letter-spacing:.3px;line-height:1.7;max-width:340px;margin:16px auto 0}
.profile-card{text-align:center;padding:24px 0}
.profile-card img{
    width:70%;max-width:220px;height:auto;aspect-ratio:3/4;
    object-fit:cover;border-radius:20px;
    box-shadow:0 8px 25px rgba(0,0,0,.2);
    transition:transform .4s ease;
}
.profile-card img:hover{transform:scale(1.03)}
.profile-card .name{font-family:var(--font-heading);font-size:1.15rem;font-weight:600;letter-spacing:1px;margin-top:16px}
.profile-card .parents{font-family:var(--font-display);font-size:.8rem;color:var(--text-light);line-height:1.5;margin-top:4px}
.profile-card .ig-btn{
    display:inline-flex;align-items:center;gap:6px;
    background:var(--navy);color:#fff;border:none;border-radius:50px;
    padding:8px 18px;font-size:.78rem;font-family:var(--font-display);
    font-weight:500;margin-top:12px;text-decoration:none;transition:.3s;
}
.profile-card .ig-btn:hover{background:var(--gold);color:var(--navy)}
.ampersand{font-family:var(--font-heading);font-size:1.6rem;font-weight:400;letter-spacing:1px;text-align:center;margin:10px 0;color:var(--gold)}

/* ===== ACARA ===== */
.acara-section{background:var(--navy);color:#fff;text-align:center}
.acara-section .sec-title{font-family:var(--font-heading);font-size:1.4rem;font-weight:600;letter-spacing:1.5px;margin-bottom:12px}
.acara-section .ayat{font-size:.78rem;line-height:1.6;letter-spacing:.5px;font-weight:300;color:rgba(255,255,255,.85);max-width:340px;margin:0 auto 28px;font-style:italic}
.event-block{width:100%;margin-bottom:30px}
.event-block .event-label{font-family:var(--font-heading);font-size:1.1rem;font-weight:400;position:relative;display:inline-block;padding:0 16px}
.event-block .event-label::before,.event-block .event-label::after{content:'';position:absolute;top:50%;width:40px;height:1px;background:var(--gold)}
.event-block .event-label::before{left:-40px}
.event-block .event-label::after{right:-40px}
.event-block .event-date{font-family:var(--font-heading);font-size:1.05rem;font-weight:500;letter-spacing:1px;margin-top:16px}
.event-block .event-time{font-size:.92rem;margin-top:6px;opacity:.9;font-weight:300}
.event-block .event-venue{
    background:rgba(255,255,255,.1);color:#fff;font-size:.88rem;font-weight:400;
    padding:12px 16px;line-height:1.5;margin-top:12px;border-radius:8px;
    border:1px solid rgba(255,255,255,.15);
}
.btn-maps,.btn-livestream{
    display:inline-flex;align-items:center;gap:6px;
    background:var(--gold);color:var(--navy);border:none;border-radius:50px;
    padding:10px 20px;font-size:.78rem;font-family:var(--font-display);
    font-weight:600;text-decoration:none;margin-top:12px;transition:all .3s ease;
    letter-spacing:.3px;
}
.btn-maps:hover,.btn-livestream:hover{background:#fff;color:var(--navy)}

/* ===== WISH & GIFT ===== */
.wish-section{background:var(--bg);text-align:center}
.wish-section .sec-title{font-family:var(--font-heading);font-size:1.4rem;font-weight:600;letter-spacing:1.5px;margin-bottom:24px}
.gift-card{
    background:var(--navy);border-radius:12px;padding:22px 16px;
    color:#fff;text-align:center;margin-bottom:14px;
    border:1px solid rgba(212,175,55,.3);
}
.gift-card .bank-name{font-family:var(--font-heading);font-size:1.05rem;font-weight:500;letter-spacing:1.5px}
.gift-card .acc-name{font-size:.88rem;margin-top:6px;font-weight:300;opacity:.9}
.gift-card .acc-number{font-size:1rem;font-weight:500;letter-spacing:2px;margin-top:6px}
.btn-copy{
    display:inline-flex;align-items:center;gap:5px;
    background:transparent;color:var(--gold);border:1.5px solid var(--gold);
    border-radius:50px;padding:7px 18px;font-size:.78rem;font-weight:500;
    margin-top:10px;cursor:pointer;transition:all .3s ease;
}
.btn-copy:hover{background:var(--gold);color:var(--navy)}
.gift-address{
    background:var(--navy);border-radius:12px;padding:22px 16px;color:#fff;
    text-align:center;margin-bottom:14px;border:1px solid rgba(212,175,55,.3);
}

/* ===== GALERI ===== */
.galeri-section{background:var(--bg);text-align:center}
.galeri-section .sec-title{font-family:var(--font-heading);font-size:1.4rem;font-weight:600;letter-spacing:1.5px;margin-bottom:24px}
.gallery-grid{
    display:grid;grid-template-columns:1fr 1fr;gap:6px;
    width:100%;
}
.gallery-grid img{
    width:100%;aspect-ratio:1;object-fit:cover;border-radius:6px;
    transition:transform .4s ease,filter .4s ease;
}
.gallery-grid img:hover{transform:scale(1.04);filter:brightness(1.05)}
.video-block{margin-top:24px;width:100%}
.video-block .ratio{border-radius:12px;overflow:hidden}

/* ===== CLOSING ===== */
.closing-section{
    background-size:cover;background-position:center;position:relative;text-align:right;
}
.closing-section::before{content:'';position:absolute;inset:0;background:rgba(0,0,0,.45)}
.closing-section .closing-content{position:relative;z-index:2;color:#fff;width:100%}

/* ===== COPYRIGHT ===== */
.copyright-section{
    min-height:auto;padding:30px 24px;text-align:center;
    background:var(--bg);
}
.copyright-section h5{font-family:'Italiana',serif;font-weight:600;letter-spacing:2px;color:#373D44}

/* ===== BOTTOM NAV ===== */
.bottom-nav{
    position:fixed;bottom:10px;left:50%;transform:translateX(-50%);
    max-width:360px;width:90%;z-index:500;
}
.bottom-nav .nav-inner{
    display:flex;align-items:center;justify-content:space-around;
    background:#fff;border-radius:14px;padding:6px 4px;
    box-shadow:0 4px 20px rgba(0,0,0,.15);
}
.bottom-nav .nav-item{
    flex:1;display:flex;align-items:center;justify-content:center;
    padding:8px 0;border-radius:8px;color:#565553;font-size:1.1rem;
    cursor:pointer;transition:.3s;text-decoration:none;
}
.bottom-nav .nav-item:hover,.bottom-nav .nav-item.active{
    background:var(--navy);color:var(--gold);
}

/* ===== MUSIC TOGGLE ===== */
.music-toggle{
    position:fixed;bottom:80px;left:50%;transform:translateX(-50%);
    margin-left:-200px;z-index:501;width:35px;height:35px;
    display:flex;align-items:center;justify-content:center;
    background:rgba(216,216,216,.8);border-radius:50%;
    color:#333;font-size:1rem;cursor:pointer;border:none;
}

/* ===== RSVP FORM ===== */
.rsvp-form{width:100%;max-width:360px;margin:0 auto}
.rsvp-form .form-control,.rsvp-form .form-select{
    border:1px solid #ddd;border-radius:10px;font-size:.88rem;
    padding:10px 14px;transition:border-color .3s;
}
.rsvp-form .form-control:focus,.rsvp-form .form-select:focus{
    border-color:var(--gold);box-shadow:0 0 0 3px rgba(212,175,55,.15);
}
.rsvp-form .btn-submit{
    background:var(--navy);color:#fff;border:2px solid var(--gold);
    border-radius:50px;padding:12px 0;width:100%;font-weight:600;
    font-size:.88rem;transition:all .35s ease;letter-spacing:.3px;
}
.rsvp-form .btn-submit:hover{background:var(--gold);color:var(--navy)}

/* ===== GUESTBOOK LIST ===== */
.guestbook-list{max-height:320px;overflow-y:auto;width:100%;max-width:360px;margin:16px auto 0}
.guestbook-item{
    border-bottom:1px solid #eee;padding:14px 0;
}
.guestbook-item:last-child{border-bottom:none}
.guestbook-item .gb-name{font-weight:600;font-size:.9rem}
.guestbook-item .gb-date{font-size:.7rem;color:#999;margin-top:2px}
.guestbook-item .gb-msg{font-size:.85rem;margin-top:5px;color:#555;line-height:1.4}
.guestbook-item .gb-badge{font-size:.65rem;border-radius:50px;padding:2px 8px}
.badge-hadir{background:var(--badge-hadir)!important;color:#fff!important}
.badge-absent{background:var(--badge-absent)!important;color:#fff!important}

/* ===== UTILITIES ===== */
.hidden{display:none}
.mb-xs{margin-bottom:8px}

/* ===== COVER ANIMATION (independent of AOS) ===== */
@keyframes fadeInCover{
    from{opacity:0;transform:translateY(20px)}
    to{opacity:1;transform:translateY(0)}
}
</style>
</head>
<body>

{{-- ====================== COVER ====================== --}}
<section class="cover-section" id="header"
    style="background-image:url('{{ $photos[0] ?? 'https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=600&auto=format&fit=crop' }}')">
    <div class="cover-overlay"></div>
    <div class="cover-content" style="animation: fadeInCover 1s ease forwards">
        <p class="label">the wedding</p>
        <div class="divider"></div>
        <h1 class="names">{{ $namaPria }} & {{ $namaWanita }}</h1>
        <div style="height:16px"></div>
        <div class="glass-card" style="display:inline-block">
            <p class="dear">dear</p>
            <p class="guest-name">{{ $guestName }}</p>
        </div>
        <div style="height:10px"></div>
        <button class="btn-open" id="tombol-buka" onclick="openInvitation()">
            <i class="bi bi-envelope-open"></i> Buka Undangan
        </button>
    </div>
</section>

{{-- ====================== MAIN CONTENT (hidden until opened) ====================== --}}
<div id="mainContent" style="visibility:hidden">

    {{-- ======== HOME ======== --}}
    <section class="inv-section home-section" id="cover"
        style="background-image:url('{{ $photos[1] ?? $photos[0] ?? 'https://images.unsplash.com/photo-1522673607200-164d1b6ce486?q=80&w=600&auto=format&fit=crop' }}')">
        <div class="home-content" data-aos="fade-in" data-aos-duration="600">
            <div style="height:280px"></div>
            <p class="label">the wedding</p>
            <h1 class="names">{{ $namaPria }} & {{ $namaWanita }}</h1>
            <p class="date mt-2">
                @if(!empty($akad['tanggal']))
                    {{ \Carbon\Carbon::parse($akad['tanggal'])->translatedFormat('l, d F Y') }}
                @else
                    Tanggal Akan Diumumkan
                @endif
            </p>
        </div>
    </section>

    {{-- ======== PENGANTIN ======== --}}
    <section class="inv-section pengantin-section" id="mempelai">
        <div style="height:32px"></div>
        <h3 class="greeting" data-aos="fade-up">Assalamu'alaikum Wr. Wb.</h3>
        <p class="intro" data-aos="fade-up" data-aos-delay="100">
            Segala Puji Bagi Allah SWT yang telah menjadikan hambanya hidup berpasang-pasangan.
            Dengan memohon Ridho, Rahmat, dan Berkah Allah SWT, kami bermaksud untuk mengundang
            Saudara/i dalam acara pernikahan yang kami selenggarakan.
        </p>
        <div style="height:20px"></div>

        {{-- Pria --}}
        <div class="profile-card" data-aos="fade-in" data-aos-duration="600">
            <img src="{{ $pria['foto'] ?? ($photos[2] ?? 'https://images.unsplash.com/photo-1583939003579-730e3918a45a?q=80&w=400&auto=format&fit=crop') }}"
                 alt="{{ $pria['nama_lengkap'] ?? 'Mempelai Pria' }}">
            <h4 class="name">{{ $pria['nama_lengkap'] ?? 'Nama Mempelai Pria, S.E' }}</h4>
            <div class="parents">
                <span>{{ $pria['anak_ke'] ?? 'Putra Pertama' }} dari</span><br>
                <span>{{ $pria['orang_tua'] ?? 'Bapak ... & Ibu ...' }}</span>
            </div>
            @if(!empty($pria['instagram']))
                <a href="https://instagram.com/{{ $pria['instagram'] }}" target="_blank" class="ig-btn">
                    <i class="bi bi-instagram"></i> {{ $pria['instagram'] }}
                </a>
            @endif
        </div>

        <div class="ampersand" data-aos="fade-up">&</div>

        {{-- Wanita --}}
        <div class="profile-card" data-aos="fade-in" data-aos-duration="600" data-aos-delay="200">
            <img src="{{ $wanita['foto'] ?? ($photos[3] ?? 'https://images.unsplash.com/photo-1544928147-79a2dbc1f389?q=80&w=400&auto=format&fit=crop') }}"
                 alt="{{ $wanita['nama_lengkap'] ?? 'Mempelai Wanita' }}">
            <h4 class="name">{{ $wanita['nama_lengkap'] ?? 'Nama Mempelai Wanita, S.E' }}</h4>
            <div class="parents">
                <span>{{ $wanita['anak_ke'] ?? 'Putri Kedua' }} dari</span><br>
                <span>{{ $wanita['orang_tua'] ?? 'Bapak ... & Ibu ...' }}</span>
            </div>
            @if(!empty($wanita['instagram']))
                <a href="https://instagram.com/{{ $wanita['instagram'] }}" target="_blank" class="ig-btn">
                    <i class="bi bi-instagram"></i> {{ $wanita['instagram'] }}
                </a>
            @endif
        </div>
        <div style="height:32px"></div>
    </section>

    {{-- ======== ACARA ======== --}}
    <section class="inv-section acara-section" id="acara">
        <div style="height:32px"></div>
        <h3 class="sec-title" data-aos="fade-up">The Wedding</h3>
        <p class="ayat" data-aos="fade-up" data-aos-delay="100">
            "Dan di antara tanda-tanda kekuasaan-Nya ialah Dia menciptakan untukmu
            isteri-isteri dari jenismu sendiri, supaya kamu cenderung dan merasa tenteram
            kepadanya, dan dijadikan-Nya di antaramu rasa kasih dan sayang."
            <br><br>AR-RUM AYAT : 21
        </p>

        @if(!empty($fitur['video_streaming']))
            <a href="{{ $fitur['video_streaming'] }}" target="_blank" class="btn-livestream mb-4" data-aos="fade-up">
                <i class="bi bi-camera-video"></i> LIVE STREAMING
            </a>
        @endif

        <div style="height:32px"></div>

        {{-- AKAD --}}
        @if(!empty($akad['tanggal']))
        <div class="event-block" data-aos="fade-left" data-aos-duration="600">
            <span class="event-label">AKAD NIKAH</span>
            <div style="height:16px"></div>
            <p class="event-date">{{ \Carbon\Carbon::parse($akad['tanggal'])->translatedFormat('l, d F Y') }}</p>
            <p class="event-time">{{ $akad['waktu_mulai'] ?? '08.00' }} - {{ $akad['waktu_selesai'] ?? 'Selesai' }} WIB</p>
            <p class="event-venue">{{ $akad['lokasi'] ?? 'Lokasi akan diumumkan' }}</p>
            @if(!empty($akad['maps_url']))
                <a href="{{ $akad['maps_url'] }}" target="_blank" class="btn-maps">
                    <i class="bi bi-geo-alt"></i> MAPS LOKASI
                </a>
            @endif
        </div>
        <div style="height:10px"></div>
        @endif

        {{-- RESEPSI --}}
        @if(!empty($resepsi['tanggal']))
        <div class="event-block" data-aos="fade-right" data-aos-duration="600" data-aos-delay="200">
            <span class="event-label">RESEPSI</span>
            <div style="height:16px"></div>
            <p class="event-date">{{ \Carbon\Carbon::parse($resepsi['tanggal'])->translatedFormat('l, d F Y') }}</p>
            <p class="event-time">{{ $resepsi['waktu_mulai'] ?? '10.00' }} - {{ $resepsi['waktu_selesai'] ?? 'Selesai' }} WIB</p>
            <p class="event-venue">{{ $resepsi['lokasi'] ?? 'Lokasi akan diumumkan' }}</p>
            @if(!empty($resepsi['maps_url']))
                <a href="{{ $resepsi['maps_url'] }}" target="_blank" class="btn-maps">
                    <i class="bi bi-geo-alt"></i> MAPS LOKASI
                </a>
            @endif
        </div>
        @endif

        <div style="height:32px"></div>
    </section>

    {{-- ======== WISH & GIFT ======== --}}
    <section class="inv-section wish-section" id="wish">
        <div style="height:32px"></div>
        <h3 class="sec-title" data-aos="fade-up">Wish & Gift</h3>
        <div style="height:16px"></div>

        {{-- RSVP / Wish Form --}}
        <h5 style="font-family:var(--font-serif);font-weight:500;letter-spacing:1px" data-aos="fade-up">Wish</h5>
        <div style="height:10px"></div>

        <div class="rsvp-form" data-aos="fade-up">
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
                    <button type="submit" class="btn-submit">Kirim Ucapan</button>
                </form>
            @else
                <p class="text-muted small">Mode Preview — Form RSVP tidak aktif.</p>
            @endif
        </div>

        {{-- Guestbook --}}
        <div style="height:20px"></div>
        <div class="guestbook-list" data-aos="fade-up">
            @if($invitation->id)
                @forelse($invitation->guestbooks()->latest()->get() as $guest)
                    <div class="guestbook-item">
                        <span class="gb-name">{{ $guest->name }}
                            @if($guest->status == 'attending')
                                <span class="badge badge-hadir gb-badge ms-1">Hadir</span>
                            @else
                                <span class="badge badge-absent gb-badge ms-1">Tidak Hadir</span>
                            @endif
                            <span class="badge bg-light text-dark border gb-badge ms-1">{{ $guest->jumlah_tamu }} Orang</span>
                        </span>
                        <div class="gb-date">{{ $guest->created_at->format('d M Y H:i') }}</div>
                        <div class="gb-msg">{{ $guest->message }}</div>
                    </div>
                @empty
                    <p class="text-muted small">Belum ada ucapan. Jadilah yang pertama! 💕</p>
                @endforelse
            @else
                <p class="text-muted small">Belum ada ucapan. Jadilah yang pertama! 💕</p>
            @endif
        </div>

        {{-- Gift / Amplop Digital --}}
        <div style="height:30px"></div>
        <h5 style="font-family:var(--font-serif);font-weight:500;letter-spacing:1px" data-aos="fade-up">Gift</h5>
        <div style="height:10px"></div>

        @if(!empty($fitur['amplop_digital']))
            @foreach($fitur['amplop_digital'] as $amp)
                <div class="gift-card" data-aos="fade-up">
                    <p class="bank-name">{{ $amp['bank'] ?? 'Bank' }}</p>
                    <p class="acc-name">{{ $amp['nama'] ?? $namaPria }}</p>
                    <p class="acc-number">{{ $amp['nomor'] ?? '-' }}</p>
                    <button class="btn-copy" onclick="copyText('{{ $amp['nomor'] ?? '' }}')">
                        <i class="bi bi-copy"></i> Salin
                    </button>
                </div>
            @endforeach
        @else
            <div class="gift-card" data-aos="fade-up">
                <p class="bank-name">BCA</p>
                <p class="acc-name">{{ $pria['nama_lengkap'] ?? 'Nama Penerima' }}</p>
                <p class="acc-number">XXXXXXXX</p>
                <button class="btn-copy" onclick="copyText('XXXXXXXX')"><i class="bi bi-copy"></i> Salin</button>
            </div>
        @endif

        @if(!empty($fitur['alamat_hadiah']))
            <div class="gift-address" data-aos="fade-up">
                <i class="bi bi-gift" style="font-size:1.6rem"></i>
                <p class="mt-2 mb-1" style="font-size:.9rem">{{ $fitur['alamat_hadiah'] }}</p>
                <button class="btn-copy" onclick="copyText('{{ $fitur['alamat_hadiah'] }}')">
                    <i class="bi bi-copy"></i> Salin
                </button>
            </div>
        @endif
        <div style="height:32px"></div>
    </section>

    {{-- ======== GALERI ======== --}}
    <section class="inv-section galeri-section" id="galeri">
        <div style="height:32px"></div>
        <h3 class="sec-title" data-aos="fade-up">The Moment</h3>

        @if(count($photos) > 0)
            <div class="gallery-grid" data-aos="fade-up">
                @foreach($photos as $photo)
                    <img src="{{ $photo }}" alt="Gallery" loading="lazy">
                @endforeach
            </div>
        @else
            <p class="text-muted small">Galeri belum tersedia.</p>
        @endif

        {{-- Video --}}
        @if(!empty($fitur['video_url']))
            <div style="height:20px"></div>
            <h5 style="font-family:var(--font-serif);font-weight:500;letter-spacing:1px" data-aos="fade-up">Video</h5>
            <div class="video-block" data-aos="fade-up">
                <div class="ratio ratio-16x9">
                    @php
                        $videoId = '';
                        if(preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&]+)/', $fitur['video_url'], $m)) {
                            $videoId = $m[1];
                        }
                    @endphp
                    @if($videoId)
                        <iframe src="https://www.youtube.com/embed/{{ $videoId }}?modestbranding=1" allowfullscreen loading="lazy"></iframe>
                    @endif
                </div>
            </div>
        @endif
        <div style="height:32px"></div>
    </section>

    {{-- ======== CLOSING ======== --}}
    <section class="inv-section closing-section"
        style="background-image:url('{{ $photos[1] ?? $photos[0] ?? 'https://images.unsplash.com/photo-1522673607200-164d1b6ce486?q=80&w=600&auto=format&fit=crop' }}')">
        <div class="closing-content" data-aos="fade-in" data-aos-duration="600">
            <div class="row align-items-center">
                <div class="col-6 text-end">
                    <p class="label" style="font-weight:600;font-size:.9rem">the wedding</p>
                    <h2 class="names" style="font-size:2.4rem">{{ $namaPria }} & {{ $namaWanita }}</h2>
                </div>
                <div class="col-6 text-start">
                    <p style="font-size:.8rem;opacity:.8">Thanks for visiting</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ======== COPYRIGHT ======== --}}
    <section class="copyright-section">
        <h5>{{ $globalName }}</h5>
    </section>
</div>

{{-- ====================== BOTTOM NAV ====================== --}}
<nav class="bottom-nav hidden" id="bottomNav">
    <div class="nav-inner">
        <a href="#cover" class="nav-item active"><i class="bi bi-house"></i></a>
        <a href="#mempelai" class="nav-item"><i class="bi bi-heart"></i></a>
        <a href="#acara" class="nav-item"><i class="bi bi-calendar3"></i></a>
        <a href="#galeri" class="nav-item"><i class="bi bi-images"></i></a>
        <a href="#wish" class="nav-item"><i class="bi bi-chat-dots"></i></a>
    </div>
</nav>

{{-- ====================== MUSIC ====================== --}}
@if($invitation->id && $invitation->music)
    <audio id="song" loop>
        <source src="{{ Storage::url($invitation->music->file_path) }}" type="audio/mpeg">
    </audio>
    <button class="music-toggle hidden" id="musicToggle" onclick="toggleMusic()">
        <i class="bi bi-music-note-beamed" id="musicIcon"></i>
    </button>
@endif

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- AOS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
// Disable scroll until opened
document.body.style.overflowY = 'hidden';

function openInvitation() {
    const cover = document.getElementById('header');
    const main = document.getElementById('mainContent');
    const nav = document.getElementById('bottomNav');
    const musicToggle = document.getElementById('musicToggle');

    cover.style.transition = 'opacity .6s ease';
    cover.style.opacity = '0';
    setTimeout(() => {
        cover.style.display = 'none';
        main.style.visibility = 'visible';
        document.body.style.overflowY = 'auto';
        nav.classList.remove('hidden');
        if (musicToggle) musicToggle.classList.remove('hidden');
        AOS.init({ once: true, offset: 60, easing: 'ease-out-cubic' });
        playAudio();
    }, 600);
}

// Music
function playAudio() {
    const audio = document.getElementById('song');
    if (audio) audio.play().catch(() => {});
}
function toggleMusic() {
    const audio = document.getElementById('song');
    const icon = document.getElementById('musicIcon');
    if (!audio) return;
    if (audio.paused) {
        audio.play();
        icon.className = 'bi bi-music-note-beamed';
    } else {
        audio.pause();
        icon.className = 'bi bi-pause-circle';
    }
}

// Copy to clipboard
function copyText(text) {
    navigator.clipboard.writeText(text).then(() => {
        alert('Berhasil disalin: ' + text);
    });
}

// Active nav indicator
const navItems = document.querySelectorAll('.bottom-nav .nav-item');
const sections = document.querySelectorAll('.inv-section[id]');
window.addEventListener('scroll', () => {
    let current = '';
    sections.forEach(sec => {
        if (window.scrollY >= sec.offsetTop - 200) current = sec.getAttribute('id');
    });
    navItems.forEach(item => {
        item.classList.remove('active');
        if (item.getAttribute('href') === '#' + current) item.classList.add('active');
    });
});
</script>
</body>
</html>
