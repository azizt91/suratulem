@extends('layouts.app')

@section('content')
@php
    $appName   = $globalAppName ?? 'SuratUlem';
    $pageTitle = $appName . ' - Undangan Digital Elegan, Praktis & Modern';
    $pageDesc  = 'Buat undangan pernikahan digital mewah. RSVP, Buku Tamu, Amplop Digital & Manajemen Tamu.';
    $navy      = $globalPrimaryColor ?? '#1A2B48';
    $gold      = '#D4AF37';
    $cream     = '#F9F5F0';
@endphp

@push('head')
<title>{{ $pageTitle }}</title>
<meta name="description" content="{{ $pageDesc }}">
<meta property="og:title" content="{{ $pageTitle }}">
<meta property="og:description" content="{{ $pageDesc }}">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
/* ===== ROOT ===== */
:root{
    --navy:{{ $navy }};
    --gold:{{ $gold }};
    --cream:{{ $cream }};
    --font-head:'Playfair Display',serif;
    --font-body:'Poppins',sans-serif;
}
*{box-sizing:border-box}
body{font-family:var(--font-body);background:var(--cream);color:#444;margin:0}
h1,h2,h3,h4,h5,h6{font-family:var(--font-head);color:var(--navy)}
.text-gold{color:var(--gold)!important}
main.py-4{padding-top:0!important}

/* ===== HERO ===== */
.hero{
    position:relative;min-height:92vh;display:flex;align-items:center;
    background:var(--navy);overflow:hidden;padding:80px 0 60px;
}
.hero-bg-img{
    position:absolute;inset:0;
    background:url('https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=2070&auto=format&fit=crop') center/cover no-repeat;
    opacity:.18;
}
.hero-deco{
    position:absolute;top:-60px;right:-60px;width:500px;height:500px;
    background:radial-gradient(circle at 70% 30%,rgba(212,175,55,.25) 0%,transparent 60%);
    border-radius:50%;pointer-events:none;z-index:1;
}
.hero-deco::before{
    content:'';position:absolute;bottom:-40px;left:-80px;width:300px;height:300px;
    background:radial-gradient(circle,rgba(212,175,55,.12) 0%,transparent 70%);border-radius:50%;
}
.hero-content{position:relative;z-index:2}
.hero h1{font-size:clamp(2.2rem,5vw,3.8rem);font-weight:700;color:#fff;line-height:1.15}
.hero p.lead{color:rgba(255,255,255,.65);max-width:480px}
.btn-gold{
    background:var(--gold);color:var(--navy);border:2px solid var(--gold);
    font-weight:600;border-radius:50px;padding:14px 36px;transition:.3s;display:inline-block;text-decoration:none;
}
.btn-gold:hover{background:transparent;color:var(--gold);box-shadow:0 0 20px rgba(212,175,55,.4)}
.btn-outline-w{
    border:2px solid #fff;color:#fff;border-radius:50px;padding:14px 36px;
    font-weight:500;transition:.3s;display:inline-block;text-decoration:none;
}
.btn-outline-w:hover{background:#fff;color:var(--navy)}

/* ===== DEVICE MOCKUPS ===== */
.mockup-group{position:relative;height:420px;width:100%}
.dev{
    position:absolute;background:#111;border-radius:16px;overflow:hidden;
    box-shadow:0 25px 60px rgba(0,0,0,.55);border:6px solid #222;
}
.dev img{width:100%;height:100%;object-fit:cover;object-position:top;display:block}
.dev-phone{width:150px;height:310px;right:40px;bottom:0;z-index:3;border-radius:22px;border-width:8px}
.dev-phone::before{
    content:'';position:absolute;top:2px;left:50%;transform:translateX(-50%);
    width:36%;height:10px;background:#111;border-radius:0 0 6px 6px;z-index:5;
}
.dev-tablet{width:220px;height:320px;right:160px;bottom:10px;z-index:2;border-width:8px}
.dev-desktop{width:380px;height:240px;right:60px;top:0;z-index:1;border-radius:12px 12px 6px 6px;border-width:8px 8px 20px 8px}
@media(max-width:991px){
    .mockup-group{height:320px;display:flex;justify-content:center;margin-top:2rem}
    .dev-tablet,.dev-desktop{display:none}
    .dev-phone{position:relative;right:auto;bottom:auto;width:190px;height:390px;border-width:10px;border-radius:28px}
}

/* ===== COUNTER STRIP ===== */
.counter-strip{
    background:linear-gradient(135deg,var(--gold) 0%,#c9a227 60%,var(--navy) 100%);
    padding:48px 0;text-align:center;
}
.counter-strip h2{font-size:clamp(3rem,8vw,5rem);color:#fff;margin:0}
.counter-strip p{color:rgba(255,255,255,.85);font-size:1.1rem;margin:0}

/* ===== SECTION UTILS ===== */
.sec-title{font-weight:700;position:relative;display:inline-block;margin-bottom:1.8rem}
.sec-title::after{
    content:'';position:absolute;left:50%;bottom:-14px;transform:translateX(-50%);
    width:50px;height:3px;background:var(--gold);
}

/* ===== TENTANG ===== */
.tentang-section{background:#fff}

/* ===== FEATURE GRID (Sesuaikan Fitur) ===== */
.fitur-card{
    background:#fff;border-radius:16px;padding:1.8rem 1.2rem;text-align:center;
    box-shadow:0 8px 30px rgba(0,0,0,.05);transition:.3s;height:100%;
    border:1px solid rgba(0,0,0,.03);
}
.fitur-card:hover{transform:translateY(-5px);box-shadow:0 14px 40px rgba(0,0,0,.1);border-color:rgba(212,175,55,.2)}
.fitur-icon{
    width:60px;height:60px;border-radius:14px;display:inline-flex;
    align-items:center;justify-content:center;font-size:1.6rem;margin-bottom:1rem;color:#fff;
}

/* ===== GRADIENT FEATURE CARDS ===== */
.feat-card{
    border-radius:20px;padding:2rem 1.4rem;color:#fff;
    min-height:230px;transition:.3s;position:relative;overflow:hidden;
    box-shadow:0 12px 35px rgba(0,0,0,.12);
}
.feat-card:hover{transform:translateY(-6px);box-shadow:0 18px 50px rgba(0,0,0,.18)}
.feat-card .fc-icon{font-size:2.6rem;margin-bottom:1rem;opacity:.9}
.feat-card h5{font-family:var(--font-body);font-weight:600;font-size:1.05rem}
.feat-card p{font-size:.85rem;opacity:.85;margin:0}
.feat-card::after{
    content:'';position:absolute;top:-30px;right:-30px;width:100px;height:100px;
    background:rgba(255,255,255,.08);border-radius:50%;
}
.grad-1{background:linear-gradient(135deg,#667eea 0%,#764ba2 100%)}
.grad-2{background:linear-gradient(135deg,#2193b0 0%,#6dd5ed 100%)}
.grad-3{background:linear-gradient(135deg,#11998e 0%,#38ef7d 100%)}
.grad-4{background:linear-gradient(135deg,var(--gold) 0%,#f0c040 100%);color:var(--navy)}

/* ===== TEMPLATE CAROUSEL ===== */
.tpl-track{
    display:flex;gap:20px;overflow-x:auto;scroll-behavior:smooth;
    padding:10px 4px 20px;-ms-overflow-style:none;scrollbar-width:none;
}
.tpl-track::-webkit-scrollbar{display:none}
.tpl-card{
    min-width:200px;max-width:200px;border-radius:16px;overflow:hidden;
    background:#fff;box-shadow:0 8px 30px rgba(0,0,0,.07);
    transition:.3s;flex-shrink:0;border:2px solid transparent;
}
.tpl-card:hover{border-color:var(--gold);transform:translateY(-4px)}
.tpl-card img{width:100%;height:260px;object-fit:cover}
.tpl-card .tpl-body{padding:14px;text-align:center}
.tpl-card .tpl-body h6{font-family:var(--font-body);font-weight:600;font-size:.92rem;color:var(--navy);margin-bottom:0}
.carousel-nav{
    width:44px;height:44px;border-radius:50%;border:2px solid var(--navy);
    background:#fff;color:var(--navy);font-size:1.2rem;display:flex;
    align-items:center;justify-content:center;cursor:pointer;transition:.3s;
    position:absolute;top:50%;transform:translateY(-50%);z-index:5;
    box-shadow:0 4px 15px rgba(0,0,0,.1);
}
.carousel-nav:hover{background:var(--navy);color:#fff}
.carousel-nav.prev{left:-22px}
.carousel-nav.next{right:-22px}

/* ===== STEPS ===== */
.step-box{position:relative;text-align:center;padding-top:2rem}
.step-num{
    font-family:var(--font-head);font-size:7rem;font-weight:700;
    color:var(--gold);opacity:.12;position:absolute;top:-30px;
    left:50%;transform:translateX(-50%);line-height:1;z-index:0;
}
.step-box .step-content{position:relative;z-index:1}

/* ===== PRICING ===== */
.price-card{
    border-radius:20px;border:1px solid #eee;background:#fff;
    box-shadow:0 8px 30px rgba(0,0,0,.04);transition:.3s;overflow:hidden;
}
.price-card:hover{transform:translateY(-8px);box-shadow:0 15px 40px rgba(0,0,0,.1)}
.price-pop{
    border:2px solid var(--gold);transform:scale(1.04);z-index:2;
    box-shadow:0 20px 50px rgba(26,43,72,.12);
}
.price-pop:hover{transform:scale(1.04) translateY(-5px)}
.price-head-pop{background:#1A2B48;color:#fff;padding:2rem 1.5rem;text-align:center}
.price-head-pop h4,.price-head-pop h2{color:var(--gold)}
.price-head-normal{padding:2rem 1.5rem;text-align:center;border-bottom:1px solid #eee}
.price-badge{
    display:inline-block;background:var(--gold);color:var(--navy);
    font-size:.7rem;font-weight:700;padding:4px 14px;border-radius:20px;
    position:absolute;top:-14px;left:50%;transform:translateX(-50%);
    text-transform:uppercase;letter-spacing:1px;
}
.price-list{list-style:none;padding:0;margin:0}
.price-list li{padding:8px 0;border-bottom:1px solid #f5f5f5;font-size:.88rem;color:#555}
.price-list li i{margin-right:8px}
.price-list li i.bi-check-circle-fill{color:var(--gold)}
.price-list li i.bi-x-circle-fill{color:#ccc}
.btn-navy{
    background:var(--navy);color:#fff;border:none;border-radius:50px;
    padding:12px 0;width:100%;font-weight:600;transition:.3s;display:block;text-align:center;text-decoration:none;
}
.btn-navy:hover{opacity:.85;color:#fff}
.btn-outline-navy{
    border:2px solid var(--navy);color:var(--navy);border-radius:50px;
    padding:12px 0;width:100%;font-weight:600;background:transparent;transition:.3s;display:block;text-align:center;text-decoration:none;
}
.btn-outline-navy:hover{background:var(--navy);color:#fff}

/* ===== TESTIMONIALS ===== */
.testi-card{
    background:#fff;border-radius:20px;padding:2rem;position:relative;
    box-shadow:0 8px 30px rgba(0,0,0,.05);height:100%;display:flex;flex-direction:column;
}
.testi-card .quote-icon{font-size:2.4rem;color:var(--gold);opacity:.35;font-family:Georgia,serif;line-height:1;margin-bottom:.5rem}

/* ===== FAQ ===== */
.faq-acc .accordion-button{font-weight:600;font-family:var(--font-body);padding:1.2rem 1.4rem;font-size:.95rem}
.faq-acc .accordion-button:not(.collapsed){background:rgba(212,175,55,.06);color:var(--navy)}
.faq-acc .accordion-button:focus{box-shadow:none;border-color:var(--gold)}
.faq-acc .accordion-item{border:1px solid #eee;margin-bottom:8px;border-radius:12px!important;overflow:hidden}

/* ===== FOOTER ===== */
.footer{background:var(--navy);color:rgba(255,255,255,.7);padding:60px 0 30px;position:relative;overflow:hidden}
.footer h6{color:var(--gold);font-family:var(--font-body);font-weight:600;margin-bottom:1rem;text-transform:uppercase;font-size:.85rem;letter-spacing:1px}
.footer a{color:rgba(255,255,255,.6);text-decoration:none;font-size:.9rem;transition:.3s}
.footer a:hover{color:var(--gold)}
.footer-bottom{border-top:1px solid rgba(255,255,255,.1);padding-top:1.5rem;margin-top:2rem}
.footer .social-icon{
    display:inline-flex;align-items:center;justify-content:center;
    width:36px;height:36px;border-radius:50%;border:1px solid rgba(255,255,255,.2);
    color:#fff;font-size:.9rem;transition:.3s;margin-right:6px;
}
.footer .social-icon:hover{background:var(--gold);border-color:var(--gold);color:var(--navy)}
.footer-deco{
    position:absolute;bottom:-40px;right:-40px;width:200px;height:200px;
    background:radial-gradient(circle,rgba(212,175,55,.15) 0%,transparent 70%);
    border-radius:50%;pointer-events:none;
}

/* ===== FLOATING WA ===== */
.wa-float{
    position:fixed;bottom:28px;right:28px;width:58px;height:58px;
    background:#25d366;color:#fff;border-radius:50%;display:flex;
    align-items:center;justify-content:center;font-size:28px;
    box-shadow:0 8px 25px rgba(37,211,102,.4);z-index:1000;transition:.3s;
}
.wa-float:hover{background:#128C7E;color:#fff;transform:scale(1.1)}

/* ===== BG-PATTERN ===== */
.bg-pattern{
    background-image:url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23d4af37" fill-opacity="0.04"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');
}
</style>
@endpush

{{-- ============================== HERO ============================== --}}
<section class="hero">
    <div class="hero-bg-img"></div>
    <div class="hero-deco"></div>
    <div class="container hero-content">
        <div class="row align-items-center">
            <div class="col-lg-6 text-center text-lg-start" data-aos="fade-right" data-aos-duration="600">
                <h1 class="mb-4">Undangan Digital Elegan,<br>Praktis, &amp; <span class="text-gold">Modern</span></h1>
                <p class="lead mb-5">Sebarkan momen bahagia dengan undangan digital premium — elegan, cepat, tanpa batas cetak.</p>
                <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center justify-content-lg-start">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-gold">Masuk Dashboard</a>
                    @else
                        <a href="{{ route('register') }}" class="btn-gold">Buat Undangan</a>
                    @endauth
                    <a href="#templates" class="btn-outline-w">Lihat Template</a>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block" data-aos="fade-left" data-aos-duration="600" data-aos-delay="200">
                <div class="mockup-group">
                    <div class="dev dev-desktop">
                        <img src="https://images.unsplash.com/photo-1583939003579-730e3918a45a?q=80&w=800&auto=format&fit=crop" alt="Desktop Preview">
                    </div>
                    <div class="dev dev-tablet">
                        <img src="https://images.unsplash.com/photo-1522673607200-164d1b6ce486?q=80&w=600&auto=format&fit=crop" alt="Tablet Preview">
                    </div>
                    <div class="dev dev-phone">
                        <img src="https://images.unsplash.com/photo-1544928147-79a2dbc1f389?q=80&w=400&auto=format&fit=crop" alt="Phone Preview">
                    </div>
                </div>
            </div>
            <div class="col-12 d-lg-none mt-4" data-aos="fade-up" data-aos-duration="500">
                <div class="mockup-group">
                    <div class="dev dev-phone" style="position:relative;right:auto;bottom:auto;margin:0 auto">
                        <img src="https://images.unsplash.com/photo-1544928147-79a2dbc1f389?q=80&w=400&auto=format&fit=crop" alt="Phone Preview">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ======================== COUNTER STRIP ======================== --}}
<!-- <section class="counter-strip" data-aos="fade-up" data-aos-duration="500">
    <div class="container">
        <h2>{{ number_format(max($totalInvitations, 10000)) }}+</h2>
        <p>Dipercaya oleh {{ number_format(max($totalInvitations, 10000)) }}+ Pasangan Bahagia</p>
    </div>
</section> -->

{{-- ======================== TENTANG ======================== --}}
<section id="tentang" class="py-5 tentang-section">
    <div class="container py-4">
        <div class="text-center mb-5" data-aos="fade-up" data-aos-duration="500">
            <h2 class="sec-title">Tentang {{ $appName }}</h2>
        </div>
        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="100">
            <div class="col-lg-10">
                <p class="text-muted mb-4" style="line-height:1.9">
                    <strong class="text-dark">{{ $appName }}</strong> adalah platform undangan pernikahan digital yang membantu pasangan calon pengantin membagikan momen spesial mereka dengan cara yang elegan, praktis, dan personal. Dengan berbagai pilihan desain menarik dan fitur interaktif, {{ $appName }} membuat setiap undangan terasa istimewa dan mudah diakses oleh semua tamu.
                </p>
                <p class="text-muted" style="line-height:1.9">
                    Platform {{ $appName }} memiliki interaksi yang mudah dipahami dan diikuti untuk orang awam, memastikan setiap pengguna dapat menciptakan undangan yang elegan dengan langkah-langkah yang sederhana. Dengan dukungan layanan pelanggan yang responsif dan sistem pembuatan undangan yang fleksibel, {{ $appName }} menjadi solusi ideal bagi pasangan yang ingin merayakan cinta mereka secara modern dan berkesan.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- ======================== SESUAIKAN FITUR ======================== --}}
<section id="features" class="py-5 bg-pattern">
    <div class="container py-4">
        <div class="text-center mb-5" data-aos="fade-up" data-aos-duration="500">
            <h2 class="sec-title">Sesuaikan Fitur</h2>
            <p class="text-muted mt-4">Semua yang Anda butuhkan untuk undangan pernikahan digital yang sempurna.</p>
        </div>
        @php
            $fiturList = [
                ['icon'=>'bi-people-fill','color'=>'linear-gradient(135deg,#667eea,#764ba2)','title'=>'Nama Mempelai','desc'=>'Mengisi nama kedua mempelai untuk informasi pernikahan.'],
                ['icon'=>'bi-heart-fill','color'=>'linear-gradient(135deg,#f093fb,#f5576c)','title'=>'Cerita Mempelai','desc'=>'Bisa menambahkan perjalanan cerita cinta kedua mempelai.'],
                ['icon'=>'bi-house-heart-fill','color'=>'linear-gradient(135deg,#4facfe,#00f2fe)','title'=>'Keluarga Mempelai','desc'=>'Menambahkan informasi keluarga kedua mempelai dalam pernikahan.'],
                ['icon'=>'bi-calendar-event','color'=>'linear-gradient(135deg,#43e97b,#38f9d7)','title'=>'Jadwal Acara','desc'=>'Lengkapi acara untuk tanggal pernikahan, Akad dan Resepsi pernikahan.'],
                ['icon'=>'bi-wallet2','color'=>'linear-gradient(135deg,#fa709a,#fee140)','title'=>'Amplop Digital','desc'=>'Beri hadiah berupa amplop digital pada kedua mempelai.'],
                ['icon'=>'bi-geo-alt-fill','color'=>'linear-gradient(135deg,#2193b0,#6dd5ed)','title'=>'Lokasi Acara','desc'=>'Dapat mengisi lokasi acara untuk mengarahkan tamu undangan.'],
                ['icon'=>'bi-images','color'=>'linear-gradient(135deg,#a18cd1,#fbc2eb)','title'=>'Galeri Undangan','desc'=>'Bagikan galeri undangan bersama pasangan untuk undangan pernikahan.'],
                ['icon'=>'bi-play-circle-fill','color'=>'linear-gradient(135deg,#ff0844,#ffb199)','title'=>'Video Undangan','desc'=>'Bagikan live streaming video undangan pernikahan.'],
                ['icon'=>'bi-music-note-beamed','color'=>'linear-gradient(135deg,#667eea,#764ba2)','title'=>'Musik Undangan','desc'=>'Pilih musik yang telah disediakan untuk undangan pernikahan digital.'],
                ['icon'=>'bi-globe','color'=>'linear-gradient(135deg,#11998e,#38ef7d)','title'=>'Undangan Website','desc'=>'Tentukan sendiri nama undangan website pernikahan digital.'],
                ['icon'=>'bi-share-fill','color'=>'linear-gradient(135deg,#f7971e,#ffd200)','title'=>'Share Undangan','desc'=>'Buat dan share link undangan ke keluarga, teman, dan saudara.'],
                ['icon'=>'bi-envelope-paper-heart','color'=>'linear-gradient(135deg,'.($gold).',#f0c040)','title'=>'RSVP Undangan','desc'=>'Isi kehadiran bahkan beri ucapan dan doa ke kedua mempelai.'],
            ];
        @endphp
        <div class="row g-4">
            @foreach($fiturList as $i => $f)
            <div class="col-lg-3 col-md-4 col-6" data-aos="fade-up" data-aos-delay="{{ ($i % 4) * 100 }}">
                <div class="fitur-card">
                    <div class="fitur-icon mx-auto" style="background:{{ $f['color'] }}">
                        <i class="bi {{ $f['icon'] }}"></i>
                    </div>
                    <h6 class="fw-bold mb-2" style="font-family:var(--font-body);font-size:.95rem;color:var(--navy)">{{ $f['title'] }}</h6>
                    <p class="text-muted small mb-0">{{ $f['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ======================== TEMPLATE CAROUSEL ======================== --}}
<section id="templates" class="py-5" style="background:#fff">
    <div class="container py-4">
        <div class="text-center mb-5" data-aos="fade-up" data-aos-duration="500">
            <h2 class="sec-title">Koleksi Template Elegan</h2>
            <p class="text-muted mt-4">Pilih desain eksklusif yang memancarkan kepribadian acara Anda.</p>
        </div>
        <div class="position-relative" data-aos="fade-up" data-aos-duration="500">
            <button class="carousel-nav prev" onclick="document.getElementById('tplTrack').scrollBy({left:-240,behavior:'smooth'})"><i class="bi bi-chevron-left"></i></button>
            <button class="carousel-nav next" onclick="document.getElementById('tplTrack').scrollBy({left:240,behavior:'smooth'})"><i class="bi bi-chevron-right"></i></button>
            <div class="tpl-track" id="tplTrack">
                @forelse($templates as $tpl)
                    <div class="tpl-card" style="position:relative">
                        <img src="{{ Str::startsWith($tpl->preview_image, ['http://', 'https://', '/storage/']) ? $tpl->preview_image : Storage::url($tpl->preview_image) }}" alt="{{ $tpl->name }}" onerror="this.src='https://placehold.co/400x520/F9F5F0/D4AF37?text=Preview'">
                        <div class="tpl-body">
                            <h6>{{ $tpl->name }}</h6>
                            <a href="{{ route('template.preview', $tpl->slug) }}" target="_blank" class="btn-gold mt-2" style="padding: 6px 16px; font-size: 12px; border-radius: 20px;">Preview</a>
                        </div>
                    </div>
                @empty
                    @for($i = 1; $i <= 6; $i++)
                    <div class="tpl-card">
                        <img src="https://placehold.co/400x520/F9F5F0/D4AF37?text=Tema+{{ $i }}" alt="Tema {{ $i }}">
                        <div class="tpl-body"><h6>Tema Elegan {{ $i }}</h6></div>
                    </div>
                    @endfor
                @endforelse
            </div>
        </div>
        <div class="text-center mt-5">
            <a href="{{ route('register') }}" class="btn-gold">Lihat Semua Tema</a>
        </div>
    </div>
</section>

{{-- ======================== HOW IT WORKS ======================== --}}
<section class="py-5 bg-pattern">
    <div class="container py-4">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="sec-title">Cara Buat Undangan</h2>
        </div>
        <div class="row g-4 mt-3">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="step-box">
                    <div class="step-num">1.</div>
                    <div class="step-content">
                        <h5 class="fw-bold mb-2">Daftar &amp; Pilih Paket</h5>
                        <p class="text-muted small">Cukup daftar akun dengan mudah lalu temukan ragam paket yang pas sesuai kebutuhan.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="step-box">
                    <div class="step-num">2.</div>
                    <div class="step-content">
                        <h5 class="fw-bold mb-2">Isi Data &amp; Modifikasi</h5>
                        <p class="text-muted small">Lengkapi data mempelai, lokasi &amp; galeri langsung dari dashboard Anda yang intuitif.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="step-box">
                    <div class="step-num">3.</div>
                    <div class="step-content">
                        <h5 class="fw-bold mb-2">Sebarkan Unlimited</h5>
                        <p class="text-muted small">Link undangan siap dibagikan ke WhatsApp, Instagram &amp; sosmed tanpa batas kuota.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ======================== PRICING ======================== --}}
<section id="pricing" class="py-5" style="background:#fff">
    <div class="container py-4">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="sec-title">Pilihan Paket Harga</h2>
            <p class="text-muted mt-4">Pilih layanan terbaik untuk momen istimewa Anda.</p>
        </div>

        <div class="row justify-content-center align-items-center g-4">
            {{-- Demo --}}
            <div class="col-lg-5 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="price-card my-lg-3">
                    <div class="price-head-normal">
                        <h4 class="fw-bold mb-2">Demo</h4>
                        <h2 class="fw-bold mb-1">Rp 0</h2>
                        <p class="text-muted small mb-0">Uji coba gratis tanpa biaya</p>
                    </div>
                    <div class="p-4">
                        <p class="text-muted small mb-3">Uji coba layanan undangan digital kami tanpa biaya. Pilihan tepat untuk melihat kemudahan dan tampilan profesional {{ $appName }}. ❤️</p>
                        <ul class="price-list mb-4">
                            <li><i class="bi bi-check-circle-fill"></i> Masa aktif <strong>1 hari</strong></li>
                            <li><i class="bi bi-check-circle-fill"></i> Mengisi nama mempelai pria dan wanita</li>
                            <li><i class="bi bi-check-circle-fill"></i> Mengisi tanggal pernikahan</li>
                            <li><i class="bi bi-check-circle-fill"></i> Maksimal <strong>2 foto</strong> dalam galeri</li>
                            <li><i class="bi bi-check-circle-fill"></i> Maksimal <strong>2 cerita kita</strong></li>
                            <li><i class="bi bi-check-circle-fill"></i> Memilih musik undangan</li>
                            <li><i class="bi bi-check-circle-fill"></i> Nama website <strong>otomatis oleh sistem</strong></li>
                            <li><i class="bi bi-check-circle-fill"></i> Hanya <strong>1 template</strong> tersedia</li>
                            <li><i class="bi bi-check-circle-fill"></i> RSVP undangan digital</li>
                            <li><i class="bi bi-check-circle-fill"></i> Bisa dibantu &amp; dibuatin Admin</li>
                        </ul>
                        <a href="{{ route('register') }}" class="btn-outline-navy">Coba Demo</a>
                    </div>
                </div>
            </div>

            {{-- Premium --}}
            <div class="col-lg-5 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="price-card price-pop position-relative">

                    <div class="price-head-pop">
                        <h4 class="fw-bold mb-2">Premium</h4>
                        <h2 class="fw-bold mb-1">Rp 99.000</h2>
                        <p class="small mb-0" style="color:rgba(255,255,255,.6)">Paket lengkap untuk momen istimewa</p>
                    </div>
                    <div class="p-4">
                        <p class="text-muted small mb-3">Nikmati pengalaman lengkap undangan digital yang dirancang elegan dan profesional. Sempurna untuk momen istimewa Kakak. ❤️</p>
                        <ul class="price-list mb-4">
                            <li><i class="bi bi-check-circle-fill"></i> Masa aktif <strong>1 bulan</strong></li>
                            <li><i class="bi bi-check-circle-fill"></i> Mengisi nama mempelai pria dan wanita</li>
                            <li><i class="bi bi-check-circle-fill"></i> <strong>Unlimited</strong> jumlah cerita kita</li>
                            <li><i class="bi bi-check-circle-fill"></i> Informasi keluarga mempelai</li>
                            <li><i class="bi bi-check-circle-fill"></i> Detail jadwal acara pernikahan</li>
                            <li><i class="bi bi-check-circle-fill"></i> Informasi rekening amplop digital</li>
                            <li><i class="bi bi-check-circle-fill"></i> Lokasi acara + <strong>Google Maps</strong></li>
                            <li><i class="bi bi-check-circle-fill"></i> <strong>Unlimited</strong> foto galeri</li>
                            <li><i class="bi bi-check-circle-fill"></i> Video live streaming undangan</li>
                            <li><i class="bi bi-check-circle-fill"></i> Memilih musik undangan</li>
                            <li><i class="bi bi-check-circle-fill"></i> Menentukan <strong>nama website sendiri</strong></li>
                            <li><i class="bi bi-check-circle-fill"></i> Akses <strong>semua template</strong> tanpa batasan</li>
                            <li><i class="bi bi-check-circle-fill"></i> Buat &amp; bagikan link undangan digital</li>
                            <li><i class="bi bi-check-circle-fill"></i> RSVP undangan digital</li>
                            <li><i class="bi bi-check-circle-fill"></i> Bisa dibantu &amp; dibuatin Admin</li>
                        </ul>
                        <a href="{{ route('register') }}" class="btn-navy">Pilih Premium</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ======================== TESTIMONIALS ======================== --}}
<section class="py-5 bg-pattern">
    <div class="container py-4">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="sec-title">Apa Kata Mereka?</h2>
        </div>
        <div class="row g-4">
            @php
                $reviews = [
                    ['name'=>'Diandra & Putra','city'=>'Jakarta Selatan','text'=>'Tema premium! Warnanya begitu royal dan sesuai dengan pesta kami. Fitur RSVP sangat membantu pencatatan katering.'],
                    ['name'=>'Syifa & Rio','city'=>'Surabaya','text'=>'Sudah dicoba dengan banyak undangan online, tapi hasilnya di sini paling elegan. Tamu-tamu langsung memuji desainnya.'],
                    ['name'=>'Bella & Ken','city'=>'Bali','text'=>'Service luar biasa. Admin responsif, hasil website cepat & tidak ada gangguan meski ratusan tamu mengakses bersamaan.'],
                ];
            @endphp
            @foreach($reviews as $r)
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                <div class="testi-card">
                    <div class="quote-icon">&ldquo;&ldquo;</div>
                    <p class="text-muted mb-4">{{ $r['text'] }}</p>
                    <div class="d-flex align-items-center gap-2 mt-auto">
                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center" style="width:40px;height:40px"><i class="bi bi-person-fill text-muted"></i></div>
                        <div>
                            <h6 class="mb-0 fw-bold" style="font-size:.9rem;color:var(--navy)">{{ $r['name'] }}</h6>
                            <small class="text-muted">{{ $r['city'] }}</small>
                        </div>
                    </div>
                    <div class="text-end mt-2 text-gold" style="font-size:2rem;opacity:.3;font-family:Georgia,serif;line-height:1">&rdquo;&rdquo;</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ======================== FAQ ======================== --}}
<section id="faq" class="py-5" style="background:#fff">
    <div class="container py-4">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="sec-title">Pertanyaan Sering Diajukan</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-9" data-aos="fade-up">
                @php
                    $csWa = App\Models\Setting::getVal('cs_whatsapp', '6281914170701');
                    $faqs = [
                        ['q'=>'Bagaimana sistem pembayaran paket premium?','a'=>'Pembayaran paket Premium dilakukan secara otomatis melalui payment gateway Duitku yang mendukung metode pembayaran bank seperti BNI, BRI, Mandiri, BCA, dan QRIS. Setelah pembayaran berhasil, undangan akan aktif sesuai durasi paket yang dipilih.'],
                        ['q'=>'Apakah saya bisa mengganti template undangan setelah memilih?','a'=>'Ya, Kakak dapat mengganti template undangan kapan saja selama masa aktif undangan pada paket Premium.'],
                        ['q'=>'Apakah saya bisa mengedit informasi pernikahan setelah undangan dibuat?','a'=>'Tentu saja! Kakak dapat login ke akun Kakak dan mengedit informasi pernikahan seperti tanggal, lokasi, nama mempelai, galeri, dan lainnya.'],
                        ['q'=>'Apa yang terjadi jika masa aktif paket habis?','a'=>'Jika masa aktif paket Kakak telah habis, undangan akan dinonaktifkan secara otomatis. Kakak bisa memperpanjang paket untuk mengaktifkan kembali undangan tersebut.'],
                        ['q'=>'Apakah langganan dapat dibatalkan setelah melakukan pembayaran?','a'=>'Mohon maaf, langganan tidak dapat dibatalkan setelah pembayaran berhasil dilakukan. Karena sistem '.$appName.' langsung memproses pesanan secara otomatis, seluruh transaksi bersifat final dan tidak dapat diuangkan kembali.'],
                        ['q'=>'Bagaimana jika saya mengalami masalah teknis?','a'=>'Silakan hubungi Admin selaku pengembang dan pendiri '.$appName.' melalui WhatsApp untuk informasi lebih lanjut.'],
                        ['q'=>'Apakah undangan bisa dibagikan lewat WhatsApp atau media sosial?','a'=>'Tentu saja bisa! Undangan berbentuk website sehingga mudah dibagikan ke WhatsApp, Instagram, Facebook, atau media sosial lainnya pada fitur buat link undangan.'],
                        ['q'=>'Apakah ada batasan jumlah tamu undangan yang bisa RSVP?','a'=>'Tidak ada batasan jumlah tamu yang dapat mengisi RSVP. Data RSVP seperti kehadiran tamu akan masuk ke dashboard Kakak secara real-time.'],
                        ['q'=>'Bisakah saya melihat demo undangan sebelum membuatnya?','a'=>'Ya sangat bisa! Kakak bisa melihat demo undangan pada menu preview di halaman ini atau di dalam aplikasi web '.$appName.'.'],
                        ['q'=>'Apakah saya bisa menyematkan video dari media sosial lain?','a'=>'Saat ini, '.$appName.' hanya mendukung penyematan video dari YouTube. Silakan unggah video Kakak ke YouTube terlebih dahulu, kemudian bagikan link nya ke '.$appName.'.'],
                        ['q'=>'Apakah '.$appName.' bisa upload musik sendiri?','a'=>'Tidak. Demi alasan hak cipta, Kakak tidak dapat mengunggah musik sendiri. '.$appName.' hanya menyediakan pilihan musik resmi yang legal dan bebas lisensi.'],
                        ['q'=>'Apakah data saya aman di '.$appName.'?','a'=>'Tentu! Keamanan data pengguna merupakan prioritas utama kami. Seluruh data disimpan dengan enkripsi standar industri dan hanya dapat diakses oleh pemilik akun. Kami tidak akan pernah membagikan data pribadi Kakak kepada pihak ketiga tanpa izin.'],
                    ];
                @endphp
                <div class="accordion faq-acc" id="faqAcc">
                    @foreach($faqs as $i => $faq)
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button {{ $i > 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#faq{{ $i }}">{{ $faq['q'] }}</button>
                        </h2>
                        <div id="faq{{ $i }}" class="accordion-collapse collapse {{ $i == 0 ? 'show' : '' }}" data-bs-parent="#faqAcc">
                            <div class="accordion-body text-muted">
                                {!! $faq['a'] !!}
                                @if($i == 5)
                                    <a href="https://wa.me/{{ $csWa }}" target="_blank" class="text-gold fw-bold">👉 Via WhatsApp 👈</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ======================== FOOTER ======================== --}}
<footer class="footer">
    <div class="footer-deco"></div>
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <h5 class="text-white fw-bold mb-3" style="font-family:var(--font-head)">{{ $appName }}</h5>
                <p class="small">Undangan Digital Elegan, Praktis &amp; Modern.<br>Mudah dibuat &amp; indah untuk dibagikan.</p>
                <p class="small mb-0">&copy; {{ date('Y') }} {{ $appName }}. All rights reserved.</p>
            </div>
            <div class="col-lg-2 col-md-6">
                <h6>Links</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="#tentang">Tentang</a></li>
                    <li class="mb-2"><a href="#features">Fitur</a></li>
                    <li class="mb-2"><a href="#templates">Template</a></li>
                    <li class="mb-2"><a href="#pricing">Harga</a></li>
                    <li class="mb-2"><a href="#faq">FAQ</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-6">
                <h6>Layanan</h6>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ route('login') }}">Login</a></li>
                    <li class="mb-2"><a href="{{ route('register') }}">Daftar</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-6">
                <h6>Social Media</h6>
                <div class="mb-3">
                    <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-tiktok"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-youtube"></i></a>
                </div>
                <h6>Subscribe Newsletter</h6>
                <div class="input-group input-group-sm">
                    <input type="email" class="form-control rounded-start-pill border-0" placeholder="Enter your email..." style="background:rgba(255,255,255,.1);color:#fff">
                    <button class="btn rounded-end-pill px-3" style="background:var(--gold);color:var(--navy);font-weight:600" type="button">Subscribe</button>
                </div>
            </div>
        </div>
        <div class="footer-bottom text-center">
            <small>Powered by <strong class="text-gold">{{ $appName }}</strong></small>
        </div>
    </div>
</footer>

{{-- ======================== FLOATING WA ======================== --}}
@php $csNumber = App\Models\Setting::getVal('cs_whatsapp', '6281914170701'); @endphp
<a href="https://wa.me/{{ $csNumber }}?text=Halo%20Admin%20{{ $appName }}!%20Saya%20tertarik%20dengan%20layanan%20undangan%20digital." target="_blank" class="wa-float"><i class="bi bi-whatsapp"></i></a>

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init({once:true,offset:80,easing:'ease-out-cubic'});</script>
@endpush
@endsection
