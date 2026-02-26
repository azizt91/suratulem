@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="fw-bold">Edit Undangan Digital</h2>
            <p class="text-muted">Lengkapi data untuk undangan Anda secara bertahap.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-3 mb-4">
            <!-- Nav tabs -->
            <div class="nav flex-column nav-pills shadow-sm bg-white rounded-3 p-3 overflow-hidden" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <button class="nav-link active text-start mb-2" id="v-pills-pengaturan-tab" data-bs-toggle="pill" data-bs-target="#v-pills-pengaturan" type="button" role="tab" aria-controls="v-pills-pengaturan" aria-selected="true">
                    <i class="bi bi-gear-fill me-2"></i> Pengaturan Link
                </button>
                <button class="nav-link text-start mb-2" id="v-pills-mempelai-tab" data-bs-toggle="pill" data-bs-target="#v-pills-mempelai" type="button" role="tab" aria-controls="v-pills-mempelai" aria-selected="false">
                    <i class="bi bi-heart-fill me-2"></i> Data Mempelai
                </button>
                <button class="nav-link text-start mb-2" id="v-pills-acara-tab" data-bs-toggle="pill" data-bs-target="#v-pills-acara" type="button" role="tab" aria-controls="v-pills-acara" aria-selected="false">
                    <i class="bi bi-calendar-event-fill me-2"></i> Acara (Resepsi/Akad)
                </button>
                <button class="nav-link text-start" id="v-pills-galeri-tab" data-bs-toggle="pill" data-bs-target="#v-pills-galeri" type="button" role="tab" aria-controls="v-pills-galeri" aria-selected="false">
                    <i class="bi bi-images me-2"></i> Galeri & Musik
                </button>
            </div>
        </div>
        
        <div class="col-md-9">
            <form action="{{ route('invitation.update', $invitation->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="tab-content bg-white p-4 shadow-sm rounded-3" id="v-pills-tabContent">
                    
                    <!-- Tab Pengaturan -->
                    <div class="tab-pane fade show active" id="v-pills-pengaturan" role="tabpanel" aria-labelledby="v-pills-pengaturan-tab" tabindex="0">
                        <h4 class="fw-bold bg-light p-3 rounded-2 mb-4">Pengaturan Tautan</h4>
                        <div class="mb-3">
                            <label for="slug" class="form-label fw-bold">Link Undangan (Slug)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">{{ url('/invitation') }}/</span>
                                <input type="text" class="form-control border-start-0 ps-0 @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $invitation->slug) }}" required>
                            </div>
                            <div class="form-text">Gunakan huruf kecil dan tanpa spasi terpisa dash (misal: romeo-juliet).</div>
                            @error('slug')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <!-- Tab Mempelai -->
                    <div class="tab-pane fade" id="v-pills-mempelai" role="tabpanel" aria-labelledby="v-pills-mempelai-tab" tabindex="0">
                        <h4 class="fw-bold bg-light p-3 rounded-2 mb-4">Data Pasangan</h4>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <h5 class="fw-bold text-primary mb-3">Mempelai Pria</h5>
                                <div class="mb-2">
                                    <label class="form-label small text-muted">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="data_mempelai[pria][nama_lengkap]" value="{{ $invitation->data_mempelai['pria']['nama_lengkap'] ?? '' }}">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label small text-muted">Nama Panggilan</label>
                                    <input type="text" class="form-control" name="data_mempelai[pria][nama_panggilan]" value="{{ $invitation->data_mempelai['pria']['nama_panggilan'] ?? '' }}">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label small text-muted">Nama Orang Tua</label>
                                    <input type="text" class="form-control" name="data_mempelai[pria][orang_tua]" value="{{ $invitation->data_mempelai['pria']['orang_tua'] ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <h5 class="fw-bold text-pink mb-3" style="color: #d81b60;">Mempelai Wanita</h5>
                                <div class="mb-2">
                                    <label class="form-label small text-muted">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="data_mempelai[wanita][nama_lengkap]" value="{{ $invitation->data_mempelai['wanita']['nama_lengkap'] ?? '' }}">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label small text-muted">Nama Panggilan</label>
                                    <input type="text" class="form-control" name="data_mempelai[wanita][nama_panggilan]" value="{{ $invitation->data_mempelai['wanita']['nama_panggilan'] ?? '' }}">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label small text-muted">Nama Orang Tua</label>
                                    <input type="text" class="form-control" name="data_mempelai[wanita][orang_tua]" value="{{ $invitation->data_mempelai['wanita']['orang_tua'] ?? '' }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Acara -->
                    <div class="tab-pane fade" id="v-pills-acara" role="tabpanel" aria-labelledby="v-pills-acara-tab" tabindex="0">
                        <h4 class="fw-bold bg-light p-3 rounded-2 mb-4">Jadwal Acara</h4>
                        <!-- Simple Akad Config -->
                        <div class="mb-4 border-bottom pb-4">
                            <h5 class="fw-bold text-dark">Akad Nikah</h5>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label small text-muted">Tanggal</label>
                                    <input type="date" class="form-control" name="data_acara[akad][tanggal]" value="{{ $invitation->data_acara['akad']['tanggal'] ?? '' }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small text-muted">Waktu Mulai</label>
                                    <input type="time" class="form-control" name="data_acara[akad][waktu_mulai]" value="{{ $invitation->data_acara['akad']['waktu_mulai'] ?? '' }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small text-muted">Waktu Selesai</label>
                                    <input type="time" class="form-control" name="data_acara[akad][waktu_selesai]" value="{{ $invitation->data_acara['akad']['waktu_selesai'] ?? '' }}">
                                </div>
                                <div class="col-12">
                                    <label class="form-label small text-muted">Lokasi</label>
                                    <textarea class="form-control" name="data_acara[akad][lokasi]" rows="2">{{ $invitation->data_acara['akad']['lokasi'] ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Simple Resepsi Config -->
                        <div>
                            <h5 class="fw-bold text-dark">Resepsi</h5>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label small text-muted">Tanggal</label>
                                    <input type="date" class="form-control" name="data_acara[resepsi][tanggal]" value="{{ $invitation->data_acara['resepsi']['tanggal'] ?? '' }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small text-muted">Waktu Mulai</label>
                                    <input type="time" class="form-control" name="data_acara[resepsi][waktu_mulai]" value="{{ $invitation->data_acara['resepsi']['waktu_mulai'] ?? '' }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label small text-muted">Waktu Selesai</label>
                                    <input type="time" class="form-control" name="data_acara[resepsi][waktu_selesai]" value="{{ $invitation->data_acara['resepsi']['waktu_selesai'] ?? '' }}">
                                </div>
                                <div class="col-12">
                                    <label class="form-label small text-muted">Lokasi</label>
                                    <textarea class="form-control" name="data_acara[resepsi][lokasi]" rows="2">{{ $invitation->data_acara['resepsi']['lokasi'] ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Galeri & Musik -->
                    <div class="tab-pane fade" id="v-pills-galeri" role="tabpanel" aria-labelledby="v-pills-galeri-tab" tabindex="0">
                        <h4 class="fw-bold bg-light p-3 rounded-2 mb-4">Galeri & Musik</h4>
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle-fill me-2"></i> Fitur upload foto masih dalam pengembangan. Masukkan URL foto langsung untuk sementara.
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Link Foto 1</label>
                            <input type="url" class="form-control" name="data_galeri[foto_1]" value="{{ $invitation->data_galeri['foto_1'] ?? '' }}" placeholder="https://example.com/foto1.jpg">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Link Foto 2</label>
                            <input type="url" class="form-control" name="data_galeri[foto_2]" value="{{ $invitation->data_galeri['foto_2'] ?? '' }}" placeholder="https://example.com/foto2.jpg">
                        </div>
                        
                        <hr class="my-4">
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Pilih Musik Latar</label>
                            <select class="form-select" name="music_id">
                                <option value="">Tanpa Musik</option>
                                {{-- @foreach($musics as $music) --}}
                                    {{-- <option value="{{ $music->id }}" {{ $invitation->music_id == $music->id ? 'selected' : '' }}>{{ $music->title }}</option> --}}
                                {{-- @endforeach --}}
                            </select>
                        </div>
                    </div>

                    <!-- Submit action -->
                    <div class="d-flex justify-content-end mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-primary px-5 py-2 fw-bold rounded-pill shadow">Simpan Perubahan</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
@endsection
