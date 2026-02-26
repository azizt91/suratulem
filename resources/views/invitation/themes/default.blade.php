<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Pernikahan: {{ $invitation->data_mempelai['pria']['nama_panggilan'] ?? 'Pria' }} & {{ $invitation->data_mempelai['wanita']['nama_panggilan'] ?? 'Wanita' }}</title>
    
    <!-- SEO & OpenGraph Meta Tags -->
    <meta name="description" content="Undangan Pernikahan {{ $invitation->data_mempelai['pria']['nama_panggilan'] ?? '' }} dan {{ $invitation->data_mempelai['wanita']['nama_panggilan'] ?? '' }}. Klik untuk melihat detail acara.">
    <meta property="og:title" content="Undangan Pernikahan: {{ $invitation->data_mempelai['pria']['nama_panggilan'] ?? 'Pria' }} & {{ $invitation->data_mempelai['wanita']['nama_panggilan'] ?? 'Wanita' }}">
    <meta property="og:description" content="Kami mengundang Bapak/Ibu/Saudara/i untuk hadir pada acara pernikahan kami.">
    <meta property="og:image" content="{{ $invitation->data_galeri['foto_1'] ?? $globalAppLogo ?? url('/img/default-og.png') }}">
    <meta property="og:url" content="{{ request()->url() }}">
    <meta property="og:type" content="website">
    <!-- Pre-load Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Montserrat', sans-serif; background-color: #fcf9f2; }
        .hero { min-height: 100vh; display: flex; align-items: center; justify-content: center; text-align: center; background-image: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('{{ $invitation->data_galeri['foto_1'] ?? 'https://source.unsplash.com/1600x900/?wedding' }}'); background-size: cover; background-position: center; color: white; }
        .title-font { font-family: 'Great Vibes', cursive; font-size: 4rem; }
        .section-title { font-family: 'Great Vibes', cursive; font-size: 3rem; color: #d4af37; text-align: center; margin-bottom: 30px; }
        .mempelai-card { background: white; padding: 40px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); text-align: center; }
        .event-card { border-left: 4px solid #d4af37; padding: 20px; background: white; box-shadow: 0 5px 15px rgba(0,0,0,0.05); margin-bottom: 20px; }
    </style>
</head>
<body>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h4 class="fw-light mb-4">The Wedding Of</h4>
            <h1 class="title-font mb-4">
                {{ $invitation->data_mempelai['pria']['nama_panggilan'] ?? 'Romeo' }} <br>&<br> {{ $invitation->data_mempelai['wanita']['nama_panggilan'] ?? 'Juliet' }}
            </h1>
            <p class="lead fw-light">Saves The Date | {{ isset($invitation->data_acara['akad']['tanggal']) ? \Carbon\Carbon::parse($invitation->data_acara['akad']['tanggal'])->format('d M Y') : 'TBA' }}</p>
        </div>
    </section>

    <!-- Mempelai Section -->
    <section class="py-5">
        <div class="container py-5">
            <h2 class="section-title">Mempelai</h2>
            <div class="row g-4 justify-content-center">
                <div class="col-md-5">
                    <div class="mempelai-card h-100">
                        <h3 class="title-font text-dark mb-3">{{ $invitation->data_mempelai['pria']['nama_lengkap'] ?? 'Nama Mempelai Pria' }}</h3>
                        <p class="text-muted mb-0">Putra dari Bapak {{ $invitation->data_mempelai['pria']['orang_tua'] ?? 'Nama Ayah & Ibu' }}</p>
                    </div>
                </div>
                <div class="col-md-2 d-flex align-items-center justify-content-center">
                    <h1 class="title-font text-muted">&</h1>
                </div>
                <div class="col-md-5">
                    <div class="mempelai-card h-100">
                        <h3 class="title-font text-dark mb-3">{{ $invitation->data_mempelai['wanita']['nama_lengkap'] ?? 'Nama Mempelai Wanita' }}</h3>
                        <p class="text-muted mb-0">Putri dari Bapak {{ $invitation->data_mempelai['wanita']['orang_tua'] ?? 'Nama Ayah & Ibu' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Acara Section -->
    <section class="py-5 bg-white">
        <div class="container py-5">
            <h2 class="section-title">Acara Pernikahan</h2>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <!-- Akad -->
                    <div class="event-card">
                        <h4 class="fw-bold mb-3">Akad Nikah</h4>
                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <strong><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-event me-2" viewBox="0 0 16 16"><path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/><path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/></svg> Tanggal:</strong><br>
                                {{ isset($invitation->data_acara['akad']['tanggal']) ? \Carbon\Carbon::parse($invitation->data_acara['akad']['tanggal'])->format('d/m/Y') : '-' }}
                            </div>
                            <div class="col-sm-6 mb-2">
                                <strong><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock me-2" viewBox="0 0 16 16"><path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/><path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/></svg> Waktu:</strong><br>
                                {{ $invitation->data_acara['akad']['waktu_mulai'] ?? '-' }} - {{ $invitation->data_acara['akad']['waktu_selesai'] ?? 'Selesai' }}
                            </div>
                            <div class="col-12 mt-2">
                                <strong><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt me-2" viewBox="0 0 16 16"><path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10"/><path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/></svg> Lokasi:</strong><br>
                                {{ $invitation->data_acara['akad']['lokasi'] ?? '-' }}
                            </div>
                        </div>
                    </div>

                    <!-- Resepsi -->
                    <div class="event-card">
                        <h4 class="fw-bold mb-3">Resepsi</h4>
                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <strong><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-event me-2" viewBox="0 0 16 16"><path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/><path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/></svg> Tanggal:</strong><br>
                                {{ isset($invitation->data_acara['resepsi']['tanggal']) ? \Carbon\Carbon::parse($invitation->data_acara['resepsi']['tanggal'])->format('d/m/Y') : '-' }}
                            </div>
                            <div class="col-sm-6 mb-2">
                                <strong><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock me-2" viewBox="0 0 16 16"><path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/><path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/></svg> Waktu:</strong><br>
                                {{ $invitation->data_acara['resepsi']['waktu_mulai'] ?? '-' }} - {{ $invitation->data_acara['resepsi']['waktu_selesai'] ?? 'Selesai' }}
                            </div>
                            <div class="col-12 mt-2">
                                <strong><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt me-2" viewBox="0 0 16 16"><path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10"/><path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/></svg> Lokasi:</strong><br>
                                {{ $invitation->data_acara['resepsi']['lokasi'] ?? '-' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- RSVP Section -->
    <section id="rsvp-section" class="py-5" style="background-color: #fcf9f2;">
        <div class="container py-5">
            <h2 class="section-title text-center">RSVP & Ucapan</h2>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card border-0 shadow-sm rounded-4 p-4 mb-5">
                        @if(session('success_rsvp'))
                            <div class="alert alert-success">{{ session('success_rsvp') }}</div>
                        @else
                            <form action="{{ route('rsvp.store', $invitation->slug) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Nama Anda</label>
                                    <input type="text" name="name" class="form-control" required placeholder="Contoh: Budi Santoso">
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Kehadiran</label>
                                        <select name="status" class="form-select" required>
                                            <option value="attending">Hadir</option>
                                            <option value="not_attending">Tidak Hadir</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Jumlah Tamu</label>
                                        <select name="jumlah_tamu" class="form-select" required>
                                            <option value="1">1 Orang</option>
                                            <option value="2">2 Orang</option>
                                            <option value="3">3 Orang</option>
                                            <option value="4">4 Orang</option>
                                            <option value="5">5 Orang</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Ucapan & Doa</label>
                                    <textarea name="message" class="form-control" rows="3" placeholder="Tulis ucapan selamat..."></textarea>
                                </div>
                                <button type="submit" class="btn btn-dark w-100 py-2 fw-bold">Kirim Konfirmasi</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Guestbook Messages -->
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h4 class="fw-bold mb-4 text-center">Ucapan dari Tamu</h4>
                    <div class="bg-white p-4 rounded-4 shadow-sm" style="max-height: 400px; overflow-y: auto;">
                        @forelse($invitation->guestbooks()->latest()->get() as $guest)
                            <div class="border-bottom pb-3 mb-3">
                                <h6 class="fw-bold mb-1">{{ $guest->name }} 
                                    @if($guest->status == 'attending') 
                                        <span class="badge bg-success ms-2" style="font-size: 0.7em;">Hadir</span> 
                                    @else 
                                        <span class="badge bg-secondary ms-2" style="font-size: 0.7em;">Tidak Hadir</span> 
                                    @endif
                                    <span class="badge bg-light text-dark border ms-1" style="font-size: 0.7em;">{{ $guest->jumlah_tamu }} Orang</span>
                                </h6>
                                <p class="text-muted small mb-2">{{ $guest->created_at->format('d M Y H:i') }}</p>
                                <p class="mb-0">{{ $guest->message }}</p>
                            </div>
                        @empty
                            <p class="text-muted text-center mb-0">Belum ada ucapan. Jadilah yang pertama!</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center py-4 bg-dark text-white">
        <p class="small mb-0">Powered by {{ $globalAppName ?? 'SuratUlem' }}</p>
    </footer>

</body>
</html>
