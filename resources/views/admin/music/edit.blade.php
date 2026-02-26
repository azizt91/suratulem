@extends('layouts.dashboard')

@section('page-title', 'Edit Music')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.music.index') }}" class="btn-navy">
        <i class="bi bi-arrow-left me-1"></i> Back
    </a>
</div>

<div class="card-royal" style="max-width:600px">
    <div class="card-header-royal"><h5>Edit: {{ $music->title }}</h5></div>
    <div class="card-body">
        <form action="{{ route('admin.music.update', $music->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label fw-bold">Music Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $music->title) }}" required style="border-radius:12px">
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold">MP3 File</label>
                @if($music->file_path)
                    <div class="mb-2">
                        <audio controls style="height:32px;max-width:280px">
                            <source src="{{ $music->file_path }}" type="audio/mpeg">
                        </audio>
                        <div class="form-text">Leave blank to keep current.</div>
                    </div>
                @endif
                <input type="file" class="form-control @error('file_path') is-invalid @enderror" name="file_path" accept="audio/mpeg, audio/mp3" style="border-radius:12px">
                <div class="form-text">Max 10MB. MP3 format.</div>
                @error('file_path') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-4 form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="isActiveSwitch" name="is_active" value="1" {{ old('is_active', $music->is_active) ? 'checked' : '' }}>
                <label class="form-check-label fw-bold" for="isActiveSwitch">Active status</label>
            </div>
            <button type="submit" class="btn-gold"><i class="bi bi-check-lg me-1"></i> Update Music</button>
        </form>
    </div>
</div>
@endsection
