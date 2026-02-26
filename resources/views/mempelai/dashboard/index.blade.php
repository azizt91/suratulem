@extends('layouts.dashboard')

@section('page-title', 'Dashboard Mempelai')

@section('content')
<div class="row g-4 mb-4">
    {{-- Subscription Status --}}
    <div class="col-12 col-md-6">
        <div class="card-royal h-100">
            <div class="card-header-royal"><h5><i class="bi bi-star-fill me-2" style="color:var(--gold)"></i>Status Langganan</h5></div>
            <div class="card-body">
                @if(isset($subscription) && $subscription->status === 'active')
                    <div class="d-flex align-items-center gap-12 mb-3">
                        <div class="stat-icon gold" style="width:44px;height:44px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:18px">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <div style="margin-left:12px">
                            <div style="font-weight:600;font-size:15px;color:var(--navy)">{{ $subscription->package->name }}</div>
                            <div style="font-size:12px;color:var(--text-muted)">Berakhir: {{ \Carbon\Carbon::parse($subscription->expires_at)->format('d M Y') }}</div>
                        </div>
                    </div>
                @else
                    <div class="text-center py-2">
                        <p class="text-muted small mb-3">Anda belum memiliki paket langganan aktif.</p>
                        <a href="{{ route('subscription.index') }}" class="btn-gold"><i class="bi bi-box-seam me-1"></i> Lihat Paket Harga</a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Invitation Management --}}
    <div class="col-12 col-md-6">
        <div class="card-royal h-100">
            <div class="card-header-royal"><h5><i class="bi bi-envelope-heart me-2" style="color:var(--gold)"></i>Undangan Digital</h5></div>
            <div class="card-body text-center d-flex flex-column justify-content-center">
                @if(isset($invitation))
                    <p class="small text-muted mb-3">Kelola data tamu, acara, dan galeri pre-wedding.</p>
                    <div class="d-grid gap-2">
                        <a href="{{ route('invitation.edit', $invitation->slug ?? $invitation->id) }}" class="btn-navy" style="text-align:center;text-decoration:none">
                            <i class="bi bi-pencil-square me-1"></i> Edit Undangan
                        </a>
                        @if(isset($invitation->slug))
                            <a href="{{ route('invitation.show', $invitation->slug) }}" target="_blank" class="btn-gold" style="text-align:center;text-decoration:none">
                                <i class="bi bi-eye me-1"></i> Lihat Undangan
                            </a>
                        @else
                            <button disabled class="btn-navy" style="opacity:.5">Lihat Undangan (Slug belum diatur)</button>
                        @endif
                    </div>
                @else
                    <div class="py-2">
                        <i class="bi bi-envelope-paper" style="font-size:48px;color:var(--gold);opacity:.5"></i>
                        <h6 class="fw-bold mt-2" style="color:var(--navy)">Buat Undangan Digital</h6>
                        <p class="text-muted small">Pilih tema dan isi data untuk memulai.</p>
                        <a href="#" class="btn-gold" style="text-decoration:none"><i class="bi bi-plus-lg me-1"></i> Mulai Buat</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- RSVP Table --}}
@if(isset($invitation) && $invitation->guestbooks->count() > 0)
<div class="row g-4 mb-4">
    <div class="col-12 col-md-4">
        <div class="stat-card">
            <div class="stat-icon navy"><i class="bi bi-people-fill"></i></div>
            <div>
                <div class="stat-label">Total RSVP</div>
                <div class="stat-value">{{ $invitation->guestbooks->count() }}</div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="stat-card">
            <div class="stat-icon green"><i class="bi bi-check-circle-fill"></i></div>
            <div>
                <div class="stat-label">Estimasi Hadir</div>
                <div class="stat-value">{{ $invitation->guestbooks->where('status', 'attending')->sum('jumlah_tamu') }}</div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <div class="stat-card">
            <div class="stat-icon" style="background:rgba(108,117,125,.1);color:#6c757d"><i class="bi bi-x-circle-fill"></i></div>
            <div>
                <div class="stat-label">Tidak Hadir</div>
                <div class="stat-value">{{ $invitation->guestbooks->where('status', 'not_attending')->count() }}</div>
            </div>
        </div>
    </div>
</div>

<div class="card-royal">
    <div class="card-header-royal"><h5>Daftar RSVP & Tamu</h5></div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-royal mb-0 align-middle">
                <thead>
                    <tr>
                        <th class="ps-4">Tanggal</th>
                        <th>Nama Tamu</th>
                        <th>Status</th>
                        <th>Orang</th>
                        <th>Pesan & Doa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invitation->guestbooks()->latest()->get() as $guest)
                    <tr>
                        <td class="ps-4 small">{{ $guest->created_at->format('d M Y, H:i') }}</td>
                        <td class="fw-bold">{{ $guest->name }}</td>
                        <td>
                            @if($guest->status == 'attending')
                                <span class="badge bg-success">Hadir</span>
                            @else
                                <span class="badge bg-secondary">Tidak Hadir</span>
                            @endif
                        </td>
                        <td>{{ $guest->jumlah_tamu }}</td>
                        <td class="small text-muted">{{ $guest->message ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif
@endsection
