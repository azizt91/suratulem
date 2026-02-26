{{--
  ============================================================================
   ANIMASI 1 — Animated Nature Wedding Template
   File : resources/views/invitation/themes/animasi_1.blade.php
   blade_path : invitation.themes.animasi_1
   Focus: Motion & Entrance Effects with CSS Variables for theming
  ============================================================================
--}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    @php
        $pria   = $invitation->data_mempelai['pria'] ?? [];
        $wanita = $invitation->data_mempelai['wanita'] ?? [];
        $akad   = $invitation->data_acara['akad'] ?? [];
        $resepsi = $invitation->data_acara['resepsi'] ?? [];
        $galeri = $invitation->data_galeri ?? [];
        $fitur  = $invitation->data_fitur_tambahan ?? [];
        $namaPria   = $pria['nama_panggilan'] ?? 'Putra';
        $namaWanita = $wanita['nama_panggilan'] ?? 'Putri';
        $globalName = $globalAppName ?? 'SuratUlem';

        $photos = collect($galeri)->filter(fn($v, $k) => str_starts_with($k, 'foto_') && $v)->values()->all();
        $guestName = request('to', 'Tamu Undangan');

        // Primary color from dashboard or default (nature green from JSON)
        $primaryColor = $fitur['primary_color'] ?? '#446348';
    @endphp
    <title>{{ $namaWanita }} & {{ $namaPria }} — The Wedding</title>

    <!-- SEO -->
    <meta name="description" content="Undangan Pernikahan {{ $namaWanita }} & {{ $namaPria }}.">
    <meta property="og:title" content="The Wedding of {{ $namaWanita }} & {{ $namaPria }}">
    <meta property="og:description" content="Kami mengundang Bapak/Ibu/Saudara/i untuk hadir pada acara pernikahan kami.">
    <meta property="og:image" content="{{ $photos[0] ?? '' }}">
    <meta property="og:url" content="{{ request()->url() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts (Pinyon Script, Helvetica fallback, Poppins) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pinyon+Script&family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 (CSS only, no JS bundle needed until bottom) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- AOS — Animate on Scroll -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
/* ===== CSS VARIABLES (user-themeable via primary_color) ===== */
:root{
    --primary: {{ $primaryColor }};
    --primary-light: {{ $primaryColor }}CC;
    --bg: #FFFFFF;
    --bg-overlay: rgba(255,255,255,0.61);
    --text: #333333;
    --text-light: #474747;
    --border-accent: #977485;
    --font-script: 'Pinyon Script', cursive;
    --font-heading: 'Playfair Display', serif;
    --font-body: 'Poppins', 'Helvetica', sans-serif;
}
*{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
body{
    font-family:var(--font-body);color:var(--text);
    background:var(--bg);max-width:480px;margin:0 auto;
    overflow-x:hidden;position:relative;
}

/* ===== FLORAL DECORATIONS (absolute positioned) ===== */
.floral{position:absolute;z-index:3;pointer-events:none;opacity:.85}
.floral-tl{top:-30px;left:-60px;width:45%;transform:rotate(-25deg)}
.floral-br{bottom:-50px;right:-60px;width:41%;transform:rotate(-28deg)}

/* ===== COVER SECTION ===== */
.cover-section{
    min-height:100vh;width:100%;position:fixed;top:0;left:50%;
    transform:translateX(-50%);max-width:480px;z-index:999;
    display:flex;align-items:center;justify-content:center;
    overflow:hidden;
}
.cover-bg{
    position:absolute;inset:0;
    background-size:cover;background-position:center;
}
.cover-bg::after{
    content:'';position:absolute;inset:0;
    background:var(--bg-overlay);
}
.cover-frame{
    position:relative;z-index:4;width:82%;
    border:2px solid var(--border-accent);
    border-radius:170px 170px 0 0;
    padding:50px 16px 40px;text-align:center;
    background:var(--bg-overlay);
    backdrop-filter:blur(2px);
}
.cover-frame .label-sm{
    font-family:var(--font-body);font-weight:600;
    font-size:14px;color:var(--text);letter-spacing:1px;
}
.cover-frame .names-script{
    font-family:var(--font-script);font-size:48px;
    color:var(--text);line-height:1;margin:4px 0;
}
.cover-frame .ampersand{
    font-family:var(--font-script);font-size:68px;
    color:var(--text);line-height:.7;
}
.cover-frame .divider-line{
    width:80%;height:1.8px;background:var(--text);
    margin:6px auto;display:flex;align-items:center;
    justify-content:center;position:relative;
}
.cover-frame .dear-label{
    font-size:16px;font-weight:400;color:var(--text);margin-top:16px;
}
.cover-frame .guest-name-display{
    font-size:20px;font-weight:400;color:var(--text-light);
}
.btn-open-inv{
    display:inline-flex;align-items:center;gap:8px;
    background:var(--primary);color:#fff;border:none;
    border-radius:3px;padding:11px 40px;font-size:12px;
    font-family:var(--font-body);font-weight:400;
    cursor:pointer;margin-top:10px;
    animation:headShake 1.5s ease-in-out infinite;
}
.btn-open-inv i{font-size:14px}

/* ===== SHARED SECTION ===== */
.inv-section{
    padding:50px 20px;position:relative;overflow:hidden;text-align:center;
}
.inv-section-framed{
    position:relative;overflow:hidden;
}
.frame-wrapper{
    border:2px solid var(--border-accent);
    border-radius:170px 170px 0 0;
    background:var(--bg-overlay);
    backdrop-filter:blur(2px);
    padding:70px 16px 40px;
    margin:0 16px;
}
.section-bg{
    position:absolute;inset:0;
    background-size:cover;background-position:center;
    z-index:0;
}
.section-bg::after{
    content:'';position:absolute;inset:0;
    background:var(--bg-overlay);
}

/* ===== HOME / POST-COVER ===== */
.home-section .frame-wrapper{position:relative;z-index:4}
.home-section .names-script{font-family:var(--font-script);font-size:48px;color:#303030}
.home-section .label-sm{font-family:var(--font-body);font-weight:600;font-size:15px;color:var(--text)}
.home-section .date-divider{
    width:88%;height:2px;background:#1D1D1D;
    margin:6px auto;position:relative;
}
.home-section .date-divider span{
    background:var(--bg-overlay);padding:0 8px;
    position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);
    font-size:13px;color:var(--text);white-space:nowrap;
}

/* ===== AYAT / QURAN SECTION ===== */
.ayat-section{
    background:var(--primary);color:#fff;padding:24px 20px;text-align:center;
}
.ayat-section .ayat-text{
    font-family:var(--font-body);font-size:11px;font-weight:500;
    line-height:1.4;letter-spacing:.5px;max-width:340px;margin:0 auto;
}
.ayat-section .ayat-source{
    font-size:12px;margin-top:8px;opacity:.9;
}

/* ===== PENGANTIN / MEMPELAI ===== */
.mempelai-section .section-title{
    font-family:var(--font-heading);font-size:30px;
    font-weight:500;color:var(--text);
}
.mempelai-section .greeting-text{
    font-size:12px;line-height:1.4;color:#3E3E3E;
    max-width:320px;margin:6px auto 20px;
}
.profile-photo{
    width:59%;max-width:200px;aspect-ratio:3/4;
    object-fit:cover;border-radius:16px;
    box-shadow:0 4px 15px rgba(0,0,0,.15);
}
.profile-name{
    font-family:var(--font-heading);font-size:26px;
    font-weight:300;color:#292929;margin-top:8px;
}
.profile-parents{
    font-family:var(--font-body);font-size:14px;
    color:var(--text-light);line-height:1.4;margin-top:2px;
}
.btn-ig{
    display:inline-flex;align-items:center;gap:6px;
    background:var(--primary);color:#fff;border:none;
    border-radius:3px;padding:10px 30px;font-size:12px;
    font-weight:400;text-decoration:none;margin-top:6px;
    animation:headShake 2s ease-in-out 1;
}
.ampersand-divider{
    font-family:var(--font-script);font-size:62px;
    color:#353535;line-height:1;margin:4px 0;
}
.ampersand-divider::before,.ampersand-divider::after{
    content:'';display:inline-block;width:30%;height:1.8px;
    background:#292929;vertical-align:middle;margin:0 8px;
}

/* ===== COUNTDOWN ===== */
.countdown-section{
    background:var(--primary);color:#fff;padding:30px 20px;text-align:center;
}
.countdown-section .section-title{
    font-family:var(--font-heading);font-size:30px;
    font-weight:500;color:#fff;
}
.countdown-boxes{
    display:flex;justify-content:center;gap:12px;
    margin:16px auto;max-width:320px;
}
.cd-box{
    background:#fff;border-radius:4px;padding:8px 6px;
    min-width:58px;text-align:center;
    border:1px solid #fff;
}
.cd-box .cd-num{font-size:18px;font-weight:400;color:#515151}
.cd-box .cd-label{font-size:10px;font-weight:500;color:#515151;margin-top:2px}
.countdown-section .event-date{font-size:14px;font-weight:500}
.btn-save-date{
    display:inline-flex;align-items:center;gap:6px;
    background:#fff;color:#313131;border:none;
    border-radius:3px;padding:11px 40px;font-size:12px;
    font-weight:400;margin-top:8px;
    animation:headShake 2s ease-in-out 1;
}

/* ===== ACARA ===== */
.acara-section .section-title{
    font-family:var(--font-heading);font-size:30px;
    font-weight:500;color:#2A2A2A;
}
.acara-section .acara-intro{
    font-size:12px;color:#2A2A2A;line-height:1.4;
    max-width:320px;margin:0 auto 16px;
}
.acara-block{margin-bottom:24px}
.acara-block .event-title{
    font-family:var(--font-heading);font-size:30px;font-weight:500;
    color:#272727;
}
.date-display{
    display:flex;justify-content:center;align-items:center;
    gap:0;margin:10px auto;max-width:280px;
}
.date-display .day-name,.date-display .month-name{
    flex:1;font-size:16px;font-weight:700;color:var(--text-light);text-align:center;
}
.date-display .date-num{
    font-family:var(--font-heading);font-size:34px;font-weight:600;
    color:#2E2E2E;min-width:60px;text-align:center;
    border-left:5px solid var(--primary);
    border-right:5px solid var(--primary);
    border-radius:22px;padding:2px 12px;
}
.time-display{
    font-size:16px;font-weight:700;color:var(--text-light);margin-top:8px;
}
.location-display{
    font-size:15px;font-weight:600;color:#424242;line-height:1.4;margin-top:4px;
}
.btn-maps{
    display:inline-flex;align-items:center;gap:6px;
    background:var(--primary);color:#fff;border:none;
    border-radius:3px;padding:10px 30px;font-size:12px;
    font-weight:400;text-decoration:none;margin-top:6px;
    animation:headShake 2s ease-in-out 1;
}

/* ===== LIVE STREAMING ===== */
.livestream-section{
    background:var(--primary);color:#fff;padding:30px 20px;text-align:center;
}
.livestream-section .section-title{
    font-family:var(--font-heading);font-size:30px;font-weight:500;color:#fff;
}
.livestream-section .desc{font-size:13px;line-height:1.4;max-width:320px;margin:6px auto 12px}
.btn-livestream{
    display:inline-flex;align-items:center;gap:6px;
    background:#fff;color:#313131;border:none;
    border-radius:3px;padding:11px 40px;font-size:12px;
    font-weight:400;text-decoration:none;
    animation:headShake 2s ease-in-out 1;
}

/* ===== GALERI ===== */
.galeri-section .section-title{
    font-family:var(--font-heading);font-size:30px;
    font-weight:500;color:var(--text);
}
.gallery-grid{
    display:grid;grid-template-columns:1fr 1fr;gap:5px;
    width:100%;margin-top:16px;
}
.gallery-grid img{
    width:100%;aspect-ratio:1;object-fit:cover;border-radius:3px;
    transition:transform .4s ease;
}
.gallery-grid img:hover{transform:scale(1.04)}
.video-block{margin-top:16px;width:100%}
.video-block .ratio{border-radius:6px;overflow:hidden}

/* ===== WISH / RSVP ===== */
.wish-section .section-title{
    font-family:var(--font-heading);font-size:30px;
    font-weight:500;color:var(--text);
}
.rsvp-form{width:100%;max-width:340px;margin:16px auto 0}
.rsvp-form .form-control,.rsvp-form .form-select{
    border:1px solid #ddd;border-radius:6px;font-size:.88rem;
}
.rsvp-form .btn-submit{
    background:var(--primary);color:#fff;border:none;border-radius:4px;
    padding:10px 0;width:100%;font-weight:500;font-size:.88rem;transition:.3s;
}
.rsvp-form .btn-submit:hover{opacity:.85}
.guestbook-list{
    max-height:280px;overflow-y:auto;
    width:100%;max-width:340px;margin:16px auto 0;
}
.gb-item{border-bottom:1px solid #eee;padding:10px 0}
.gb-item:last-child{border-bottom:none}
.gb-item .gb-name{font-weight:600;font-size:.88rem}
.gb-item .gb-date{font-size:.68rem;color:#999}
.gb-item .gb-msg{font-size:.82rem;margin-top:3px;color:#555}

/* ===== GIFT ===== */
.gift-card{
    background:var(--primary);border-radius:6px;padding:16px 12px;
    color:#fff;text-align:center;margin-bottom:10px;
}
.gift-card .bank-name{font-family:var(--font-heading);font-size:1rem;font-weight:500}
.gift-card .acc-name{font-size:.88rem;margin-top:3px}
.gift-card .acc-number{font-size:.95rem;font-weight:500;letter-spacing:1px;margin-top:3px}
.btn-copy{
    display:inline-flex;align-items:center;gap:4px;
    background:#fff;color:var(--primary);border:none;border-radius:3px;
    padding:5px 14px;font-size:.75rem;font-weight:600;margin-top:6px;cursor:pointer;
}
.gift-address{
    background:#555;border-radius:6px;padding:16px 12px;
    color:#eee;text-align:center;margin-bottom:10px;
}

/* ===== CLOSING ===== */
.closing-section{position:relative;overflow:hidden;text-align:center;padding:0}
.closing-frame{
    position:relative;z-index:4;
    border:2px solid var(--border-accent);
    border-radius:170px 170px 0 0;
    background:var(--bg-overlay);
    backdrop-filter:blur(2px);
    padding:70px 16px 50px;
    margin:0 16px;
}
.closing-section .names-script{font-family:var(--font-script);font-size:48px;color:#303030}
.closing-section .thanks{font-size:13px;color:var(--text-light);margin-top:8px}

/* ===== COPYRIGHT ===== */
.copyright-bar{
    padding:20px;text-align:center;background:var(--bg);
}
.copyright-bar h5{
    font-family:var(--font-heading);font-weight:600;
    letter-spacing:2px;color:#373D44;font-size:14px;
}

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
    background:var(--primary);color:#fff;
}

/* ===== MUSIC ===== */
.music-toggle{
    position:fixed;bottom:80px;left:50%;transform:translateX(-50%);
    margin-left:-200px;z-index:501;width:35px;height:35px;
    display:flex;align-items:center;justify-content:center;
    background:rgba(216,216,216,.85);border-radius:50%;
    color:#333;font-size:1rem;cursor:pointer;border:none;
}

/* ===== HEADSHAKE KEYFRAMES ===== */
@keyframes headShake{
    0%{transform:translateX(0)}
    6.5%{transform:translateX(-6px) rotateY(-9deg)}
    18.5%{transform:translateX(5px) rotateY(7deg)}
    31.5%{transform:translateX(-3px) rotateY(-5deg)}
    43.5%{transform:translateX(2px) rotateY(3deg)}
    50%{transform:translateX(0)}
}

.hidden{display:none}
</style>
</head>
<body>

{{-- ====================== COVER ====================== --}}
<section class="cover-section" id="header">
    <div class="cover-bg"
         style="background-image:url('{{ $photos[0] ?? 'https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=600&auto=format&fit=crop' }}')">
    </div>

    {{-- Floral decorations --}}
    <img src="https://templateku.my.id/wp-content/uploads/2023/06/gkhkhkg-e1686024606150.png"
         class="floral floral-tl" alt="" data-aos="fade-down" data-aos-duration="1200">
    <img src="https://templateku.my.id/wp-content/uploads/2023/06/nsans-e1686097358511.png"
         class="floral floral-br" alt="" data-aos="fade-right" data-aos-duration="1200">

    <div class="cover-frame">
        <p class="label-sm" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">The Wedding of</p>
        <h1 class="names-script" data-aos="zoom-in" data-aos-duration="800" data-aos-delay="400">{{ $namaWanita }}</h1>
        <div class="ampersand" data-aos="zoom-in" data-aos-duration="800" data-aos-delay="500">&</div>
        <h1 class="names-script" data-aos="zoom-in" data-aos-duration="800" data-aos-delay="600">{{ $namaPria }}</h1>

        <div style="height:16px"></div>
        <p class="dear-label" data-aos="fade-up" data-aos-duration="800" data-aos-delay="700">Kepada Yth. Bapak/Ibu/Sdr/i</p>
        <p class="guest-name-display" data-aos="fade-down" data-aos-duration="800" data-aos-delay="800">{{ $guestName }}</p>

        <button class="btn-open-inv" id="tombol-buka" onclick="openInvitation()">
            <i class="bi bi-envelope-open"></i> Buka Undangan
        </button>
    </div>
</section>

{{-- ====================== MAIN CONTENT ====================== --}}
<div id="mainContent" style="visibility:hidden">

    {{-- ======== HOME ======== --}}
    <section class="inv-section-framed home-section" id="cover">
        <div class="section-bg"
             style="background-image:url('{{ $photos[0] ?? 'https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=600&auto=format&fit=crop' }}')"></div>

        <img src="https://templateku.my.id/wp-content/uploads/2023/06/gkhkhkg-e1686024606150.png"
             class="floral floral-tl" alt="" data-aos="fade-down" data-aos-duration="1200">
        <img src="https://templateku.my.id/wp-content/uploads/2023/06/nsans-e1686097358511.png"
             class="floral floral-br" alt="" data-aos="fade-right" data-aos-duration="1200">

        <div class="frame-wrapper">
            <img src="https://templateku.my.id/wp-content/uploads/2023/06/Picture1fff-e1686100172813.png"
                 alt="ornament" style="width:74%;margin:0 auto 8px;display:block" data-aos="zoom-in" data-aos-duration="800">

            <p class="label-sm" data-aos="fade-up" data-aos-duration="800">The Wedding of</p>
            <h2 class="names-script" data-aos="zoom-in" data-aos-duration="800">{{ $namaWanita }} & {{ $namaPria }}</h2>

            <div class="date-divider" data-aos="fade-up" data-aos-duration="600">
                <span>
                    @if(!empty($akad['tanggal']))
                        {{ \Carbon\Carbon::parse($akad['tanggal'])->translatedFormat('d F Y') }}
                    @else
                        Tanggal Akan Diumumkan
                    @endif
                </span>
            </div>
            <div style="height:40px"></div>
        </div>
    </section>

    {{-- ======== AYAT ======== --}}
    <section class="ayat-section">
        <p class="ayat-text" data-aos="fade-up" data-aos-duration="800">
            "Dan di antara tanda-tanda (kebesaran)-Nya adalah Dia menciptakan pasangan-pasangan
            untukmu dari jenismu sendiri, agar kamu cenderung dan merasa tenteram kepadanya,
            dan Dia menjadikan di antaramu rasa kasih dan sayang. Sungguh pada yang demikian itu
            benar-benar terdapat tanda-tanda kebesaran Allah bagi kaum yang berpikir."
        </p>
        <div style="width:89%;height:2px;background:#fff;margin:8px auto;position:relative">
            <span style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);background:var(--primary);padding:0 8px;font-size:12px;white-space:nowrap;color:#fff">
                Ar-Ruum ayat 21
            </span>
        </div>
    </section>

    {{-- ======== PASANGAN MEMPELAI ======== --}}
    <section class="inv-section-framed mempelai-section" id="mempelai">
        <div class="section-bg"
             style="background-image:url('{{ $photos[0] ?? 'https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=600&auto=format&fit=crop' }}')"></div>
        <img src="https://templateku.my.id/wp-content/uploads/2023/06/nsans-e1686097358511.png"
             class="floral floral-br" alt="" data-aos="fade-right" data-aos-duration="1200">
        <img src="https://templateku.my.id/wp-content/uploads/2023/06/gkhkhkg-e1686024606150.png"
             class="floral floral-tl" alt="" data-aos="fade-down" data-aos-duration="1200">

        <div class="frame-wrapper">
            <h3 class="section-title" data-aos="fade-up" data-aos-duration="800">Pasangan Mempelai</h3>
            <p class="greeting-text" data-aos="zoom-in" data-aos-duration="800">
                Assalamu'alaikum Wr. Wb.<br>
                Dengan memohon rahmat dan ridho Allah Subhanahu Wa Ta'ala,
                insyaaAllah kami akan menyelenggarakan acara pernikahan kami:
            </p>

            {{-- Mempelai Wanita (Putri) --}}
            <div data-aos="fade-up" data-aos-duration="800">
                <img src="{{ $wanita['foto'] ?? ($photos[1] ?? 'https://images.unsplash.com/photo-1544928147-79a2dbc1f389?q=80&w=400&auto=format&fit=crop') }}"
                     alt="{{ $wanita['nama_lengkap'] ?? 'Mempelai Wanita' }}"
                     class="profile-photo">
            </div>
            <h4 class="profile-name" data-aos="zoom-in" data-aos-duration="800">{{ $wanita['nama_lengkap'] ?? 'Putri Pratiwi' }}</h4>
            <p class="profile-parents" data-aos="fade-up" data-aos-duration="800">
                {{ $wanita['anak_ke'] ?? 'Putri' }} dari<br>
                {{ $wanita['orang_tua'] ?? 'Bapak ... & Ibu ...' }}
            </p>
            @if(!empty($wanita['instagram']))
                <a href="https://instagram.com/{{ $wanita['instagram'] }}" target="_blank" class="btn-ig" data-aos="fade-up">
                    <i class="bi bi-instagram"></i> {{ $wanita['instagram'] }}
                </a>
            @endif

            <div class="ampersand-divider" data-aos="fade-up" data-aos-duration="600">&</div>

            {{-- Mempelai Pria (Putra) --}}
            <div data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                <img src="{{ $pria['foto'] ?? ($photos[2] ?? 'https://images.unsplash.com/photo-1583939003579-730e3918a45a?q=80&w=400&auto=format&fit=crop') }}"
                     alt="{{ $pria['nama_lengkap'] ?? 'Mempelai Pria' }}"
                     class="profile-photo">
            </div>
            <h4 class="profile-name" data-aos="zoom-in" data-aos-duration="800">{{ $pria['nama_lengkap'] ?? 'Putra Pratama' }}</h4>
            <p class="profile-parents" data-aos="fade-up" data-aos-duration="800">
                {{ $pria['anak_ke'] ?? 'Putra' }} dari<br>
                {{ $pria['orang_tua'] ?? 'Bapak ... & Ibu ...' }}
            </p>
            @if(!empty($pria['instagram']))
                <a href="https://instagram.com/{{ $pria['instagram'] }}" target="_blank" class="btn-ig" data-aos="fade-up">
                    <i class="bi bi-instagram"></i> {{ $pria['instagram'] }}
                </a>
            @endif
            <div style="height:20px"></div>
        </div>
    </section>

    {{-- ======== COUNTDOWN ======== --}}
    <section class="countdown-section" id="countdown">
        <h3 class="section-title" data-aos="fade-up" data-aos-duration="800">Menuju Hari Bahagia</h3>
        <div style="height:12px"></div>

        <div class="countdown-boxes" data-aos="fade-down" data-aos-duration="800">
            <div class="cd-box"><div class="cd-num" id="cd-days">0</div><div class="cd-label">Hari</div></div>
            <div class="cd-box"><div class="cd-num" id="cd-hours">0</div><div class="cd-label">Jam</div></div>
            <div class="cd-box"><div class="cd-num" id="cd-mins">0</div><div class="cd-label">Menit</div></div>
            <div class="cd-box"><div class="cd-num" id="cd-secs">0</div><div class="cd-label">Detik</div></div>
        </div>

        <p class="event-date" data-aos="zoom-in" data-aos-duration="800">
            @if(!empty($akad['tanggal']))
                {{ \Carbon\Carbon::parse($akad['tanggal'])->translatedFormat('l, d F Y') }}
            @endif
        </p>

        @if(!empty($akad['tanggal']))
            <a href="https://calendar.google.com/calendar/r/eventedit?text=The+Wedding+of+{{ urlencode($namaWanita.' & '.$namaPria) }}&dates={{ \Carbon\Carbon::parse($akad['tanggal'])->format('Ymd') }}T{{ str_replace(['.',':'],'',$akad['waktu_mulai'] ?? '0800') }}00/{{ \Carbon\Carbon::parse($akad['tanggal'])->format('Ymd') }}T{{ str_replace(['.',':'],'',$akad['waktu_selesai'] ?? '1700') }}00&details=Undangan+Pernikahan&location={{ urlencode($akad['lokasi'] ?? '') }}"
               target="_blank" class="btn-save-date" data-aos="fade-up">
                <i class="bi bi-calendar-check"></i> Simpan Tanggal
            </a>
        @endif
    </section>

    {{-- ======== ACARA ======== --}}
    <section class="inv-section-framed" id="acara">
        <div class="section-bg"
             style="background-image:url('{{ $photos[0] ?? 'https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=600&auto=format&fit=crop' }}')"></div>
        <img src="https://templateku.my.id/wp-content/uploads/2023/06/nsans-e1686097358511.png"
             class="floral floral-br" alt="" data-aos="fade-right" data-aos-duration="1200">
        <img src="https://templateku.my.id/wp-content/uploads/2023/06/gkhkhkg-e1686024606150.png"
             class="floral floral-tl" alt="" data-aos="fade-down" data-aos-duration="1200">

        <div class="frame-wrapper">
            <p class="acara-intro" data-aos="fade-down" data-aos-duration="800">
                Dengan segala kerendahan hati kami berharap kehadiran Bapak/Ibu/Saudara/i
                dalam acara pernikahan kami yang akan diselenggarakan pada:
            </p>

            {{-- AKAD --}}
            @if(!empty($akad['tanggal']))
            <div class="acara-block">
                <h4 class="event-title" data-aos="fade-up" data-aos-duration="800">Akad Nikah</h4>
                @php $akadDate = \Carbon\Carbon::parse($akad['tanggal']); @endphp
                <div class="date-display" data-aos="fade-up" data-aos-duration="600">
                    <span class="day-name" data-aos="fade-left" data-aos-duration="800">{{ $akadDate->translatedFormat('l') }}</span>
                    <span class="date-num" data-aos="zoom-in" data-aos-duration="800">{{ $akadDate->format('d') }}</span>
                    <span class="month-name" data-aos="fade-right" data-aos-duration="800">{{ $akadDate->translatedFormat('F') }}</span>
                </div>
                <p class="time-display" data-aos="zoom-in" data-aos-duration="800">
                    Pukul : {{ $akad['waktu_mulai'] ?? '08.00' }} - {{ $akad['waktu_selesai'] ?? 'Selesai' }} WIB
                </p>
                <p class="location-display" data-aos="zoom-in" data-aos-duration="800">
                    Bertempat di,<br>{{ $akad['lokasi'] ?? 'Lokasi akan diumumkan' }}
                </p>
                @if(!empty($akad['maps_url']))
                    <a href="{{ $akad['maps_url'] }}" target="_blank" class="btn-maps" data-aos="fade-up">
                        <i class="bi bi-geo-alt-fill"></i> Lihat Lokasi
                    </a>
                @endif
            </div>
            @endif

            {{-- RESEPSI --}}
            @if(!empty($resepsi['tanggal']))
            <div class="acara-block">
                <h4 class="event-title" data-aos="fade-up" data-aos-duration="800">Resepsi</h4>
                @php $resepsiDate = \Carbon\Carbon::parse($resepsi['tanggal']); @endphp
                <div class="date-display" data-aos="fade-up" data-aos-duration="600">
                    <span class="day-name" data-aos="fade-left" data-aos-duration="800">{{ $resepsiDate->translatedFormat('l') }}</span>
                    <span class="date-num" data-aos="zoom-in" data-aos-duration="800">{{ $resepsiDate->format('d') }}</span>
                    <span class="month-name" data-aos="fade-right" data-aos-duration="800">{{ $resepsiDate->translatedFormat('F') }}</span>
                </div>
                <p class="time-display" data-aos="zoom-in" data-aos-duration="800">
                    Pukul : {{ $resepsi['waktu_mulai'] ?? '10.00' }} - {{ $resepsi['waktu_selesai'] ?? 'Selesai' }} WIB
                </p>
                <p class="location-display" data-aos="zoom-in" data-aos-duration="800">
                    Bertempat di,<br>{{ $resepsi['lokasi'] ?? 'Lokasi akan diumumkan' }}
                </p>
                @if(!empty($resepsi['maps_url']))
                    <a href="{{ $resepsi['maps_url'] }}" target="_blank" class="btn-maps" data-aos="fade-up">
                        <i class="bi bi-geo-alt-fill"></i> Lihat Lokasi
                    </a>
                @endif
            </div>
            @endif
            <div style="height:20px"></div>
        </div>
    </section>

    {{-- ======== LIVE STREAMING ======== --}}
    @if(!empty($fitur['video_streaming']))
    <section class="livestream-section">
        <h3 class="section-title" data-aos="fade-up" data-aos-duration="800">Live Streaming</h3>
        <p class="desc" data-aos="fade-down" data-aos-duration="800">
            Temui kami secara virtual untuk menyaksikan acara pernikahan kami
            yang insya Allah akan disiarkan langsung.
        </p>
        <a href="{{ $fitur['video_streaming'] }}" target="_blank" class="btn-livestream" data-aos="fade-up">
            <i class="bi bi-instagram"></i> Live Streaming
        </a>
    </section>
    @endif

    {{-- ======== GALERI ======== --}}
    <section class="inv-section galeri-section" id="galeri">
        <h3 class="section-title" data-aos="fade-up" data-aos-duration="800">Gallery</h3>
        @if(count($photos) > 0)
            <div class="gallery-grid">
                @foreach($photos as $i => $photo)
                    <img src="{{ $photo }}" alt="Gallery {{ $i+1 }}" loading="lazy"
                         data-aos="{{ $i % 2 === 0 ? 'fade-right' : 'fade-left' }}" data-aos-duration="600"
                         data-aos-delay="{{ $i * 100 }}">
                @endforeach
            </div>
        @else
            <p class="text-muted small mt-3">Galeri belum tersedia.</p>
        @endif

        @if(!empty($fitur['video_url']))
            <div class="video-block" data-aos="fade-up" data-aos-duration="800">
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
    </section>

    {{-- ======== WISH / RSVP ======== --}}
    <section class="inv-section wish-section" id="wish">
        <h3 class="section-title" data-aos="fade-up" data-aos-duration="800">Ucapan & Doa</h3>
        <div style="height:8px"></div>

        <div class="rsvp-form" data-aos="zoom-in" data-aos-duration="600">
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
                    <button type="submit" class="btn-submit">Kirim Ucapan</button>
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
                <p class="text-muted small mt-2">Belum ada ucapan. Jadilah yang pertama! 💕</p>
            @endforelse
        </div>

        {{-- GIFT / Amplop Digital --}}
        <div style="height:24px"></div>
        <h4 style="font-family:var(--font-heading);font-weight:500;font-size:24px" data-aos="fade-up">Wedding Gift</h4>
        <div style="height:8px"></div>

        @if(!empty($fitur['amplop_digital']))
            @foreach($fitur['amplop_digital'] as $amp)
                <div class="gift-card" data-aos="zoom-in" data-aos-duration="600">
                    <p class="bank-name">{{ $amp['bank'] ?? 'Bank' }}</p>
                    <p class="acc-name">{{ $amp['nama'] ?? $namaPria }}</p>
                    <p class="acc-number">{{ $amp['nomor'] ?? '-' }}</p>
                    <button class="btn-copy" onclick="copyText('{{ $amp['nomor'] ?? '' }}')">
                        <i class="bi bi-copy"></i> Salin
                    </button>
                </div>
            @endforeach
        @else
            <div class="gift-card" data-aos="zoom-in" data-aos-duration="600">
                <p class="bank-name">BCA</p>
                <p class="acc-name">{{ $pria['nama_lengkap'] ?? 'Nama Penerima' }}</p>
                <p class="acc-number">XXXXXXXX</p>
                <button class="btn-copy" onclick="copyText('XXXXXXXX')"><i class="bi bi-copy"></i> Salin</button>
            </div>
        @endif

        @if(!empty($fitur['alamat_hadiah']))
            <div class="gift-address" data-aos="zoom-in" data-aos-duration="600">
                <i class="bi bi-gift" style="font-size:1.4rem"></i>
                <p class="mt-2 mb-1" style="font-size:.88rem">{{ $fitur['alamat_hadiah'] }}</p>
                <button class="btn-copy" onclick="copyText('{{ $fitur['alamat_hadiah'] }}')">
                    <i class="bi bi-copy"></i> Salin Alamat
                </button>
            </div>
        @endif
    </section>

    {{-- ======== CLOSING ======== --}}
    <section class="closing-section">
        <div class="section-bg"
             style="background-image:url('{{ $photos[0] ?? 'https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=600&auto=format&fit=crop' }}')"></div>
        <img src="https://templateku.my.id/wp-content/uploads/2023/06/gkhkhkg-e1686024606150.png"
             class="floral floral-tl" alt="" data-aos="fade-down" data-aos-duration="1200">
        <img src="https://templateku.my.id/wp-content/uploads/2023/06/nsans-e1686097358511.png"
             class="floral floral-br" alt="" data-aos="fade-right" data-aos-duration="1200">

        <div class="closing-frame" data-aos="fade-in" data-aos-duration="800">
            <p class="label-sm">Terima Kasih</p>
            <h2 class="names-script" data-aos="zoom-in" data-aos-duration="800">{{ $namaWanita }} & {{ $namaPria }}</h2>
            <p class="thanks" data-aos="fade-up" data-aos-duration="600">
                Merupakan suatu kehormatan dan kebahagiaan bagi kami
                apabila Bapak/Ibu/Saudara/i berkenan hadir.
            </p>
        </div>
    </section>

    {{-- ======== COPYRIGHT ======== --}}
    <div class="copyright-bar">
        <h5>{{ $globalName }}</h5>
    </div>
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
@if($invitation->music)
    <audio id="song" loop>
        <source src="{{ Storage::url($invitation->music->file_path) }}" type="audio/mpeg">
    </audio>
    <button class="music-toggle hidden" id="musicToggle" onclick="toggleMusic()">
        <i class="bi bi-music-note-beamed" id="musicIcon"></i>
    </button>
@endif

<!-- Bootstrap JS (deferred) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
<!-- AOS (deferred init) -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
// Lock scroll until opened
document.body.style.overflowY = 'hidden';

// Pre-init AOS for cover only
AOS.init({ once: true, offset: 30, easing: 'ease-out-cubic', startEvent: 'DOMContentLoaded' });

function openInvitation() {
    const cover = document.getElementById('header');
    const main  = document.getElementById('mainContent');
    const nav   = document.getElementById('bottomNav');
    const mt    = document.getElementById('musicToggle');

    cover.style.transition = 'opacity .6s ease';
    cover.style.opacity = '0';
    setTimeout(() => {
        cover.style.display = 'none';
        main.style.visibility = 'visible';
        document.body.style.overflowY = 'auto';
        nav.classList.remove('hidden');
        if (mt) mt.classList.remove('hidden');
        // Reinit AOS for scrolled content
        AOS.refreshHard();
        playAudio();
        startCountdown();
    }, 600);
}

// Music
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

// Countdown
function startCountdown() {
    @if(!empty($akad['tanggal']))
        const target = new Date('{{ \Carbon\Carbon::parse($akad['tanggal'])->format('Y-m-d') }}T{{ $akad['waktu_mulai'] ?? '08:00' }}:00').getTime();
        function tick() {
            const now = Date.now(), d = target - now;
            if (d <= 0) {
                document.getElementById('cd-days').textContent = '0';
                document.getElementById('cd-hours').textContent = '0';
                document.getElementById('cd-mins').textContent = '0';
                document.getElementById('cd-secs').textContent = '0';
                return;
            }
            document.getElementById('cd-days').textContent  = Math.floor(d / 86400000);
            document.getElementById('cd-hours').textContent = Math.floor((d % 86400000) / 3600000);
            document.getElementById('cd-mins').textContent  = Math.floor((d % 3600000) / 60000);
            document.getElementById('cd-secs').textContent  = Math.floor((d % 60000) / 1000);
        }
        tick();
        setInterval(tick, 1000);
    @endif
}

// Copy
function copyText(t) {
    navigator.clipboard.writeText(t).then(() => alert('Berhasil disalin: ' + t));
}

// Active nav
const navItems = document.querySelectorAll('.bottom-nav .nav-item');
const sections = document.querySelectorAll('[id]');
window.addEventListener('scroll', () => {
    let cur = '';
    sections.forEach(s => {
        if (s.id && window.scrollY >= s.offsetTop - 200) cur = s.id;
    });
    navItems.forEach(n => {
        n.classList.remove('active');
        if (n.getAttribute('href') === '#' + cur) n.classList.add('active');
    });
});
</script>
</body>
</html>
