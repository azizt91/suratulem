@extends('invitation.themes.layouts.invitation')

{{-- ===== Data Extraction ===== --}}
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

    $guestName    = urldecode(request('to', 'Tamu Kehormatan'));
    $primaryColor = $fitur['primary_color'] ?? '#0A192F';
@endphp

{{-- ===== STYLES ===== --}}
@section('styles')
<style>
/* CSS VARIABLES - The Royal Ethereal */
:root {
    --navy: #0A192F;
    --charcoal: #112240;
    --gold: #D4AF37;
    --gold-light: rgba(212, 175, 55, 0.5);
    --ivory: #FDF5E6;
    --white: #ffffff;
    
    --font-heading: 'Playfair Display', serif;
    --font-body: 'Poppins', sans-serif;
}

body {
    background: var(--navy);
    color: var(--ivory);
    font-family: var(--font-body);
    /* Subtle gradient background */
    background: linear-gradient(135deg, var(--navy) 0%, var(--charcoal) 100%);
    min-height: 100vh;
}

/* Glassmorphism System */
.glass-container {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(212, 175, 55, 0.3);
    border-radius: 12px;
    padding: 24px;
    position: relative;
    overflow: hidden;
}

/* Typography */
h1, h2, h3, h4, h5, .title-text {
    font-family: var(--font-heading);
    color: var(--gold);
    letter-spacing: 2px;
}
.title-xl { font-size: 3rem; font-weight: 700; line-height: 1.2; text-shadow: 2px 2px 4px rgba(0,0,0,0.5); }
.title-lg { font-size: 2.2rem; font-weight: 600; }
.title-md { font-size: 1.6rem; font-weight: 600; }

p { font-weight: 300; font-size: 0.9rem; line-height: 1.6; letter-spacing: 0.5px; margin-bottom: 0; }

/* Buttons */
.btn-gold {
    background: var(--gold);
    color: var(--navy);
    border: none;
    padding: 12px 32px;
    border-radius: 30px;
    font-family: var(--font-body);
    font-weight: 500;
    letter-spacing: 1px;
    transition: all 0.3s ease;
    text-transform: uppercase;
    font-size: 0.85rem;
    box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
}
.btn-gold:hover { background: var(--ivory); color: var(--navy); transform: translateY(-2px); }

.btn-outline-gold {
    background: transparent;
    color: var(--gold);
    border: 1px solid var(--gold);
    padding: 10px 24px;
    border-radius: 30px;
    font-family: var(--font-body);
    font-weight: 500;
    letter-spacing: 1px;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
    font-size: 0.85rem;
}
.btn-outline-gold:hover { background: var(--gold); color: var(--navy); }

/* Art-Deco Corners in Glass Containers */
.deco-corners::before, .deco-corners::after {
    content: ''; position: absolute; width: 30px; height: 30px; border: 1px solid var(--gold); opacity: 0.6; pointer-events: none;
}
.deco-corners::before { top: 10px; left: 10px; border-right: none; border-bottom: none; }
.deco-corners::after { bottom: 10px; right: 10px; border-left: none; border-top: none; }
.deco-corners-inner::before, .deco-corners-inner::after {
    content: ''; position: absolute; width: 30px; height: 30px; border: 1px solid var(--gold); opacity: 0.6; pointer-events: none;
}
.deco-corners-inner::before { top: 10px; right: 10px; border-left: none; border-bottom: none; }
.deco-corners-inner::after { bottom: 10px; left: 10px; border-right: none; border-top: none; }

/* SECTIONS */
.section-wrapper { padding: 80px 24px; text-align: center; position: relative; }

/* COVER */
.cover-wrapper {
    min-height: 100vh;
    display: flex; flex-direction: column; align-items: center; justify-content: center;
    text-align: center; padding: 24px; position: fixed; inset: 0; z-index: 999;
    background: var(--navy);
    background-image: url('{{ $photos[0] ?? '' }}');
    background-size: cover; background-position: center;
}
.cover-overlay { position: absolute; inset: 0; background: rgba(10, 25, 47, 0.85); }
.cover-content { position: relative; z-index: 2; width: 100%; }

/* Cover Countdown */
.countdown-wrapper {
    display: flex; gap: 15px; justify-content: center; margin-top: 20px;
}
.cd-item {
    display: flex; flex-direction: column; align-items: center;
}
.cd-number {
    font-family: var(--font-heading); font-size: 1.8rem; font-weight: 600; color: var(--gold);
    line-height: 1; text-shadow: 0 2px 4px rgba(0,0,0,0.5);
}
.cd-label {
    font-size: 0.65rem; text-transform: uppercase; letter-spacing: 1px; margin-top: 4px; opacity: 0.8;
}

/* MEMPELAI */
.profile-img {
    width: 140px; height: 140px; border-radius: 50%; object-fit: cover;
    border: 3px solid var(--gold); padding: 4px;
    box-shadow: 0 0 20px rgba(212, 175, 55, 0.2); margin-bottom: 20px;
}
.ampersand { font-size: 2.5rem; color: var(--gold); font-family: var(--font-heading); margin: 30px 0; }

/* GUESTBOOK */
.chat-bubble {
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 16px 16px 16px 4px;
    padding: 16px; margin-bottom: 16px; text-align: left;
    backdrop-filter: blur(5px);
}
.chat-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px; border-bottom: 1px solid rgba(212,175,55,0.2); padding-bottom: 8px; }
.chat-name { font-weight: 600; color: var(--gold); font-size: 0.95rem; }
.chat-date { font-size: 0.7rem; color: rgba(253, 245, 230, 0.6); }

/* RSVP FORM */
.form-control, .form-select {
    background: rgba(10, 25, 47, 0.6); border: 1px solid rgba(212, 175, 55, 0.4);
    color: var(--ivory); font-size: 0.9rem; border-radius: 8px; padding: 12px;
}
.form-control:focus, .form-select:focus {
    background: rgba(10, 25, 47, 0.8); border-color: var(--gold);
    color: var(--white); box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.25);
}
.form-control::placeholder { color: rgba(253, 245, 230, 0.5); }
.form-select option { background: var(--navy); color: var(--ivory); }

/* Ornaments */
.floral-ornament {
    width: 120px; opacity: 0.6; margin: 0 auto; filter: drop-shadow(0px 0px 2px rgba(212,175,55,0.5));
}
</style>
@endsection

{{-- ===== HTML BODY ===== --}}
@section('body')

{{-- ====================== COVER SECTION ====================== --}}
<section class="cover-wrapper" id="header">
    <div class="cover-overlay"></div>
    <div class="cover-content" data-aos="zoom-in" data-aos-duration="1500">
        
        <!-- Subtle text ornament -->
        <p style="font-size: 0.85rem; letter-spacing: 4px; text-transform: uppercase; color: var(--gold-light); margin-bottom: 20px;">The Wedding Of</p>
        
        <h1 class="title-xl mb-4">{{ $namaPria }} <br><span style="font-size: 1.5rem; font-weight: 400; font-style: italic;">&</span><br> {{ $namaWanita }}</h1>
        
        <div class="glass-container deco-corners mt-5" style="display: inline-block; padding: 20px 32px; min-width: 300px;">
            <div class="deco-corners-inner"></div>
            <p style="font-size: 0.8rem; letter-spacing: 1px; color: var(--ivory); margin-bottom: 5px;">Kpd Yth. Bapak/Ibu/Saudara/i</p>
            <h3 class="title-md mt-2 mb-3" style="color: var(--white);">{{ $guestName }}</h3>
            
            <div style="width: 50px; height: 1px; background: rgba(212,175,55,0.4); margin: 0 auto;"></div>
            
            <!-- Countdown Timer -->
            <div class="countdown-wrapper">
                <div class="cd-item">
                    <span class="cd-number" id="cd-days">0</span>
                    <span class="cd-label">Hari</span>
                </div>
                <div class="cd-item">
                    <span class="cd-number" id="cd-hours">0</span>
                    <span class="cd-label">Jam</span>
                </div>
                <div class="cd-item">
                    <span class="cd-number" id="cd-mins">0</span>
                    <span class="cd-label">Menit</span>
                </div>
                <div class="cd-item">
                    <span class="cd-number" id="cd-secs">0</span>
                    <span class="cd-label">Detik</span>
                </div>
            </div>
        </div>
        
        <div class="mt-5">
            <button class="btn-gold" onclick="openInvitation()">
                <i class="bi bi-envelope-open me-2"></i> Buka Undangan
            </button>
        </div>
    </div>
</section>

{{-- ====================== MAIN CONTENT ====================== --}}
<div id="mainContent" style="visibility: hidden;">

    {{-- ==== GREETING ==== --}}
    <section class="section-wrapper" id="home">
        <h2 class="title-lg mb-4" data-aos="fade-up">Assalamu'alaikum <br>Wr. Wb.</h2>
        <p data-aos="fade-up" data-aos-delay="100" style="max-width: 380px; margin: 0 auto;">
            Maha Suci Allah yang telah menciptakan makhluk-Nya berpasang-pasangan. 
            Ya Allah, perkenankanlah kami merangkaikan kasih sayang yang Kau ciptakan di antara putra-putri kami:
        </p>
    </section>

    {{-- ==== MEMPELAI ==== --}}
    <section class="section-wrapper pt-2" id="mempelai">
        
        <!-- Pria -->
        <div data-aos="fade-up">
            <img src="{{ $pria['foto'] ?? ($photos[2] ?? 'https://images.unsplash.com/photo-1583939003579-730e3918a45a?q=80&w=400&auto=format&fit=crop') }}" 
                 alt="{{ $pria['nama_lengkap'] ?? 'Mempelai Pria' }}" class="profile-img">
            <h3 class="title-md">{{ $pria['nama_lengkap'] ?? 'Nama Mempelai Pria, S.E' }}</h3>
            <p class="mt-2">{{ $pria['anak_ke'] ?? 'Putra Pertama' }} dari<br>
               <strong>{{ $pria['orang_tua'] ?? 'Kel. Bapak ... & Ibu ...' }}</strong>
            </p>
            @if(!empty($pria['instagram']))
                <a href="https://instagram.com/{{ $pria['instagram'] }}" target="_blank" class="btn-outline-gold mt-3" style="padding: 6px 16px; font-size: 0.75rem;">
                    <i class="bi bi-instagram"></i> {{ '@'.$pria['instagram'] }}
                </a>
            @endif
        </div>

        <div class="ampersand" data-aos="zoom-in" data-aos-delay="200">&</div>

        <!-- Wanita -->
        <div data-aos="fade-up">
            <img src="{{ $wanita['foto'] ?? ($photos[3] ?? 'https://images.unsplash.com/photo-1544928147-79a2dbc1f389?q=80&w=400&auto=format&fit=crop') }}" 
                 alt="{{ $wanita['nama_lengkap'] ?? 'Mempelai Wanita' }}" class="profile-img">
            <h3 class="title-md">{{ $wanita['nama_lengkap'] ?? 'Nama Mempelai Wanita, S.E' }}</h3>
            <p class="mt-2">{{ $wanita['anak_ke'] ?? 'Putri Kedua' }} dari<br>
               <strong>{{ $wanita['orang_tua'] ?? 'Kel. Bapak ... & Ibu ...' }}</strong>
            </p>
            @if(!empty($wanita['instagram']))
                <a href="https://instagram.com/{{ $wanita['instagram'] }}" target="_blank" class="btn-outline-gold mt-3" style="padding: 6px 16px; font-size: 0.75rem;">
                    <i class="bi bi-instagram"></i> {{ '@'.$wanita['instagram'] }}
                </a>
            @endif
        </div>
    </section>

    {{-- ==== ACARA ==== --}}
    <section class="section-wrapper" id="acara">
        <h2 class="title-lg mb-4" data-aos="fade-up">Rangkaian Acara</h2>
        
        <!-- Akad -->
        @if(!empty($akad['tanggal']))
        <div class="glass-container deco-corners mb-4" data-aos="fade-right">
            <div class="deco-corners-inner"></div>
            <h3 class="title-md mb-3" style="color: var(--white);">Akad Nikah</h3>
            <div style="width: 40px; height: 1px; background: var(--gold); margin: 0 auto 16px;"></div>
            <p class="mb-1" style="font-weight: 500; font-size: 1rem; color: var(--gold);">{{ \Carbon\Carbon::parse($akad['tanggal'])->translatedFormat('l, d F Y') }}</p>
            <p class="mb-3">{{ $akad['waktu_mulai'] ?? '08.00' }} - {{ $akad['waktu_selesai'] ?? 'Selesai' }} WIB</p>
            <p class="mb-4" style="font-size: 0.85rem; padding: 10px; background: rgba(0,0,0,0.2); border-radius: 8px;">{{ $akad['lokasi'] ?? 'Lokasi Akad' }}</p>
            
            @if(!empty($akad['maps_url']))
                <a href="{{ $akad['maps_url'] }}" target="_blank" class="btn-outline-gold">
                    <i class="bi bi-geo-alt"></i> Buka Google Maps
                </a>
            @endif
        </div>
        @endif

        <!-- Resepsi -->
        @if(!empty($resepsi['tanggal']))
        <div class="glass-container deco-corners mb-4" data-aos="fade-left" data-aos-delay="100">
            <div class="deco-corners-inner"></div>
            <h3 class="title-md mb-3" style="color: var(--white);">Resepsi</h3>
            <div style="width: 40px; height: 1px; background: var(--gold); margin: 0 auto 16px;"></div>
            <p class="mb-1" style="font-weight: 500; font-size: 1rem; color: var(--gold);">{{ \Carbon\Carbon::parse($resepsi['tanggal'])->translatedFormat('l, d F Y') }}</p>
            <p class="mb-3">{{ $resepsi['waktu_mulai'] ?? '11.00' }} - {{ $resepsi['waktu_selesai'] ?? 'Selesai' }} WIB</p>
            <p class="mb-4" style="font-size: 0.85rem; padding: 10px; background: rgba(0,0,0,0.2); border-radius: 8px;">{{ $resepsi['lokasi'] ?? 'Lokasi Resepsi' }}</p>
            
            @if(!empty($resepsi['maps_url']))
                <a href="{{ $resepsi['maps_url'] }}" target="_blank" class="btn-outline-gold">
                    <i class="bi bi-geo-alt"></i> Buka Google Maps
                </a>
            @endif
        </div>
        @endif

        @if(!empty($fitur['video_streaming']))
        <div class="mt-5" data-aos="fade-up">
            <p class="mb-3">Kami juga akan menyiarkan acara ini secara virtual:</p>
            <a href="{{ $fitur['video_streaming'] }}" target="_blank" class="btn-gold" style="padding: 10px 24px;">
                <i class="bi bi-camera-video me-1"></i> Live Streaming
            </a>
        </div>
        @endif
    </section>

    {{-- ==== RSVP & WISH ==== --}}
    <section class="section-wrapper" id="wish">
        <h2 class="title-lg mb-4" data-aos="fade-up">RSVP & Ucapan</h2>
        <p class="mb-4" data-aos="fade-up">Kehadiran serta doa restu Bapak/Ibu/Saudara/i merupakan suatu kehormatan dan kebahagiaan bagi kami.</p>

        <!-- RSVP Form -->
        <div class="glass-container mb-5 text-start" data-aos="fade-up">
            @if(session('success_rsvp'))
                <div class="alert alert-success" style="background: rgba(61,154,98,0.2); border-color: #3D9A62; color: #fff;">{{ session('success_rsvp') }}</div>
            @elseif($invitation->id)
                <form action="{{ route('rsvp.store', $invitation->slug) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" style="font-size: 0.8rem; color: var(--gold);">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" required placeholder="Masukkan nama Anda">
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label" style="font-size: 0.8rem; color: var(--gold);">Kehadiran</label>
                            <select name="status" class="form-select" required>
                                <option value="attending">Hadir</option>
                                <option value="not_attending">Tidak Hadir</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label" style="font-size: 0.8rem; color: var(--gold);">Jumlah Tamu</label>
                            <select name="jumlah_tamu" class="form-select" required>
                                @for($i=1;$i<=5;$i++)
                                    <option value="{{ $i }}">{{ $i }} Orang</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label" style="font-size: 0.8rem; color: var(--gold);">Ucapan & Doa</label>
                        <textarea name="message" class="form-control" rows="4" placeholder="Tuliskan harapan terbaik Anda..."></textarea>
                    </div>
                    <button type="submit" class="btn-gold w-100">Kirim Konfirmasi</button>
                </form>
            @else
                <p class="text-center" style="color: rgba(253, 245, 230, 0.5);">[Mode Preview] Form RSVP dinonaktifkan.</p>
            @endif
        </div>

        <!-- Guestbook Bubbles -->
        <div style="max-height: 400px; overflow-y: auto; padding-right: 10px;" data-aos="fade-up">
            @if($invitation->id && $invitation->guestbooks->count() > 0)
                @foreach($invitation->guestbooks()->latest()->get() as $guest)
                <div class="chat-bubble">
                    <div class="chat-header">
                        <div class="chat-name">{{ $guest->name }}</div>
                        <div class="chat-date">{{ $guest->created_at->format('d M Y') }}</div>
                    </div>
                    <p class="mb-2" style="font-size: 0.85rem;">{{ $guest->message }}</p>
                    <div>
                        @if($guest->status == 'attending')
                            <span class="badge" style="background: rgba(61,154,98,0.3); color: #fff; border: 1px solid #3D9A62; font-weight: normal; font-size: 0.65rem;">Hadir · {{ $guest->jumlah_tamu }} Org</span>
                        @else
                            <span class="badge" style="background: rgba(217,10,17,0.3); color: #fff; border: 1px solid #d90a11; font-weight: normal; font-size: 0.65rem;">Absen</span>
                        @endif
                    </div>
                </div>
                @endforeach
            @else
                <!-- Dummy Data for Preview -->
                <div class="chat-bubble">
                    <div class="chat-header">
                        <div class="chat-name">Ahmad & Keluarga</div>
                        <div class="chat-date">Hari ini</div>
                    </div>
                    <p class="mb-2" style="font-size: 0.85rem;">Selamat menempuh hidup baru! Semoga menjadi keluarga yang sakinah, mawaddah, warahmah.</p>
                    <span class="badge" style="background: rgba(61,154,98,0.3); color: #fff; border: 1px solid #3D9A62; font-weight: normal; font-size: 0.65rem;">Hadir · 2 Org</span>
                </div>
                <div class="chat-bubble">
                    <div class="chat-header">
                        <div class="chat-name">Sarah</div>
                        <div class="chat-date">Kemarin</div>
                    </div>
                    <p class="mb-2" style="font-size: 0.85rem;">Lancar sampai hari H ya! Maaf belum bisa hadir.</p>
                    <span class="badge" style="background: rgba(217,10,17,0.3); color: #fff; border: 1px solid #d90a11; font-weight: normal; font-size: 0.65rem;">Absen</span>
                </div>
            @endif
        </div>
    </section>

    {{-- ==== GIFT ==== --}}
    @if(!empty($fitur['amplop_digital']) || !empty($fitur['alamat_hadiah']))
    <section class="section-wrapper" id="gift">
        <h2 class="title-lg mb-4" data-aos="fade-up">Wedding Gift</h2>
        <p class="mb-4" data-aos="fade-up">Bagi bapak/ibu/saudara/i yang ingin memberikan tanda kasih, dapat mengirimkan melalui:</p>

        @if(!empty($fitur['amplop_digital']))
            @foreach($fitur['amplop_digital'] as $amp)
            <div class="glass-container deco-corners mb-3" data-aos="fade-up">
                <div class="deco-corners-inner"></div>
                <h4 class="title-md mb-1">{{ $amp['bank'] ?? 'Bank' }}</h4>
                <p class="mb-0" style="font-size: 1.1rem; letter-spacing: 2px;">{{ $amp['nomor'] ?? '-' }}</p>
                <p class="mb-3" style="color: var(--gold);">a.n. {{ $amp['nama'] ?? 'Nama Penerima' }}</p>
                <button class="btn-outline-gold" onclick="copyText('{{ $amp['nomor'] ?? '' }}')" style="padding: 6px 16px; font-size: 0.75rem;">
                    <i class="bi bi-copy"></i> Salin Rekening
                </button>
            </div>
            @endforeach
        @endif

        @if(!empty($fitur['alamat_hadiah']))
            <div class="glass-container mt-4" data-aos="fade-up">
                <i class="bi bi-gift mb-2" style="font-size: 2rem; color: var(--gold);"></i>
                <p class="mb-3">{{ $fitur['alamat_hadiah'] }}</p>
                <button class="btn-outline-gold" onclick="copyText('{{ $fitur['alamat_hadiah'] }}')" style="padding: 6px 16px; font-size: 0.75rem;">
                    <i class="bi bi-copy"></i> Salin Alamat
                </button>
            </div>
        @endif
    </section>
    @endif

    {{-- ==== CLOSING ==== --}}
    <section class="section-wrapper" style="padding-bottom: 100px;">
        <h2 class="title-lg mb-3" data-aos="zoom-in">{{ $namaPria }} & {{ $namaWanita }}</h2>
        <p data-aos="fade-up">Terima Kasih</p>
    </section>

</div>
@endsection
