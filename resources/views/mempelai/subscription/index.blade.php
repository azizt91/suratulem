@extends('layouts.dashboard')

@section('page-title', 'Pilih Paket')

@section('content')
<div class="text-center mb-4">
    <h3 style="font-family:'Playfair Display',serif;font-weight:700;color:var(--navy)">Pilih Paket Undangan Digital</h3>
    <p class="text-muted small">Desain premium dan fitur lengkap untuk hari spesial Anda.</p>
</div>

<div class="row justify-content-center g-4">
    @forelse($packages as $package)
        <div class="col-md-6 col-lg-4">
            <div class="card-royal h-100 {{ $loop->first ? 'border-2' : '' }}" style="{{ $loop->first ? 'border-color:var(--gold) !important' : '' }}">
                <div class="card-body p-4 d-flex flex-column text-center">
                    @if($loop->first)
                        <span class="badge mb-2 mx-auto" style="background:var(--gold);color:var(--navy);border-radius:50px;padding:5px 16px;font-size:11px;width:fit-content">
                            <i class="bi bi-star-fill me-1"></i> Populer
                        </span>
                    @endif
                    <h4 class="fw-bold mb-1" style="font-family:'Playfair Display',serif;color:var(--navy)">{{ $package->name }}</h4>
                    <div class="my-3">
                        <h2 class="fw-bold mb-0" style="color:var(--navy)">Rp {{ number_format($package->price, 0, ',', '.') }}</h2>
                        <span class="text-muted small">Masa aktif {{ $package->duration_days }} hari</span>
                    </div>

                    <ul class="list-unstyled text-start mb-4 mx-auto" style="max-width:250px">
                        @if(isset($package->features))
                            @foreach(json_decode($package->features, true) ?? [] as $feature)
                                <li class="mb-2" style="font-size:13px"><i class="bi bi-check-circle-fill me-2" style="color:var(--gold)"></i>{{ $feature }}</li>
                            @endforeach
                        @else
                            <li class="mb-2" style="font-size:13px"><i class="bi bi-check-circle-fill me-2" style="color:var(--gold)"></i>Fitur Dasar</li>
                            <li class="mb-2" style="font-size:13px"><i class="bi bi-check-circle-fill me-2" style="color:var(--gold)"></i>Galeri Foto</li>
                            <li class="mb-2" style="font-size:13px"><i class="bi bi-check-circle-fill me-2" style="color:var(--gold)"></i>Background Musik</li>
                        @endif
                    </ul>

                    <div class="mt-auto">
                        <form action="{{ route('subscription.checkout', $package->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="{{ $loop->first ? 'btn-gold' : 'btn-navy' }} w-100" style="padding:12px;font-size:14px">
                                Pilih Paket
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center">
            <div class="card-royal p-4">
                <p class="text-muted mb-0">Belum ada paket langganan yang tersedia saat ini.</p>
            </div>
        </div>
    @endforelse
</div>
@endsection
