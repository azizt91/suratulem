@extends('layouts.dashboard')

@section('page-title', 'Add Music')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.music.index') }}" class="btn-navy">
        <i class="bi bi-arrow-left me-1"></i> Back
    </a>
</div>

<div class="card-royal" style="max-width:600px">
    <div class="card-header-royal"><h5>New Music</h5></div>
    <div class="card-body">
        <form action="{{ route('admin.music.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-bold">Music Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required placeholder="e.g. A Thousand Years" style="border-radius:12px">
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold">MP3 File</label>
                <input type="file" class="form-control @error('file_path') is-invalid @enderror" name="file_path" accept="audio/mpeg, audio/mp3" required style="border-radius:12px">
                <div class="form-text">Max 10MB. Must be MP3 format.</div>
                @error('file_path') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-4 form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="isActiveSwitch" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                <label class="form-check-label fw-bold" for="isActiveSwitch">Active status</label>
            </div>
            <button type="submit" class="btn-gold"><i class="bi bi-check-lg me-1"></i> Save Music</button>
        </form>
    </div>
</div>
@endsection
