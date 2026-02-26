@extends('layouts.dashboard')

@section('page-title', 'Pilih Paket Undangan')

@section('styles')
<style>
/* Royal Luxury Details for Package Cards */
.card-package {
    background: var(--white);
    border-radius: 16px;
    padding: 2rem 1.5rem;
    position: relative;
    border: 1px solid rgba(212, 175, 55, 0.2);
    transition: all 0.3s ease;
    box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    display: flex;
    flex-direction: column;
    height: 100%;
}
.card-package:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(212, 175, 55, 0.15);
    border-color: var(--gold);
}
.card-package.popular {
    border: 2px solid var(--gold);
    background: linear-gradient(to bottom, #ffffff, #fdfbfa);
}
.badge-popular {
    position: absolute;
    top: -12px;
    left: 50%;
    transform: translateX(-50%);
    background: var(--navy);
    color: var(--gold);
    padding: 4px 16px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    letter-spacing: 1px;
    box-shadow: 0 4px 10px rgba(10, 25, 47, 0.2);
}
.pkg-name {
    color: var(--navy);
    font-family: 'Playfair Display', serif;
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}
.pkg-price {
    font-size: 2rem;
    font-weight: 700;
    color: var(--gold);
    margin-bottom: 1.5rem;
}
.pkg-features {
    list-style: none;
    padding: 0;
    margin-bottom: 2rem;
    flex-grow: 1;
}
.pkg-features li {
    padding: 8px 0;
    border-bottom: 1px dashed rgba(212, 175, 55, 0.3);
    color: #555;
    font-size: 0.95rem;
    display: flex;
    align-items: center;
}
.pkg-features li i {
    color: var(--gold);
    margin-right: 10px;
    font-size: 1.1rem;
}
.btn-select-pkg {
    background: var(--navy);
    color: var(--gold);
    border: none;
    padding: 12px 24px;
    border-radius: 30px;
    font-weight: 600;
    transition: all 0.3s;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-size: 0.9rem;
    width: 100%;
}
.btn-select-pkg:hover {
    background: var(--gold);
    color: var(--navy);
    box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
}
</style>
@endsection

@section('content')
<div class="row justify-content-center mb-5">
    <div class="col-lg-8 text-center pt-4">
        <h2 class="fw-bold" style="color: var(--navy); font-family: 'Playfair Display', serif;">Pilih Paket Undangan Anda</h2>
        <p class="text-muted">Temukan paket yang paling sesuai dengan kebutuhan pernikahan impian Anda. Nikmati fitur premium dan desain elegan eksklusif dari SuratUlem.</p>
    </div>
</div>

<div class="row g-4 justify-content-center">
    @forelse($packages as $index => $pkg)
        <div class="col-md-6 col-lg-4">
            <div class="card-package {{ $index == 1 || $pkg->name == 'Gold' ? 'popular' : '' }}">
                @if($index == 1 || $pkg->name == 'Gold')
                    <div class="badge-popular">PALING DIMINATI</div>
                @endif
                <div class="text-center">
                    <h3 class="pkg-name">{{ $pkg->name }}</h3>
                    <div class="pkg-price">Rp {{ number_format($pkg->price, 0, ',', '.') }}</div>
                </div>
                
                <ul class="pkg-features">
                    @php
                        // Assuming features is stored as JSON or comma-separated string
                        // If it's a string from a textarea, we explode by newline
                        $features = $pkg->features;
                        if(is_array($features)) {
                            $featureList = $features;
                        } else {
                            // Trim and split by newline
                            $featureList = array_filter(array_map('trim', explode("\n", $features)));
                        }
                    @endphp
                    
                    @if(count($featureList) > 0)
                        @foreach($featureList as $feature)
                            <li><i class="bi bi-check2-circle"></i> {{ $feature }}</li>
                        @endforeach
                    @else
                        <li><i class="bi bi-check2-circle"></i> Tema Premium Bebas Pilih</li>
                        <li><i class="bi bi-check2-circle"></i> Konfirmasi Kehadiran (RSVP)</li>
                        <li><i class="bi bi-check2-circle"></i> Galeri Foto & Video</li>
                        <li><i class="bi bi-check2-circle"></i> Amplop Digital / Hadiah</li>
                        <li><i class="bi bi-check2-circle"></i> Navigasi Peta Lokasi (Maps)</li>
                        <li><i class="bi bi-check2-circle"></i> Musik Latar Pilihan</li>
                    @endif
                    
                    <li class="mt-3 text-center border-0" style="justify-content: center; font-weight: 500; color: var(--navy);">
                        <i class="bi bi-clock-history text-muted me-1"></i> Masa Aktif: {{ $pkg->duration_days }} Hari
                    </li>
                </ul>
                
                <div class="mt-auto">
                    <!-- Target route placeholder for picking subscription, 
                         e.g. route('subscription.checkout', $pkg->id) or memepelai route -->
                    <form action="#" method="GET">
                        <button type="button" class="btn-select-pkg" onclick="alert('Fitur Pembayaran/Checkout segera hadir!')">
                            Pilih Paket Ini
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center text-muted py-5">
            <i class="bi bi-box-seam fs-1 mb-3"></i>
            <p>Belum ada paket undangan yang tersedia saat ini.</p>
        </div>
    @endforelse
</div>
@endsection
