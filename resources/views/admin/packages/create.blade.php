@extends('layouts.dashboard')

@section('page-title', 'Add Package')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.packages.index') }}" class="btn-navy">
        <i class="bi bi-arrow-left me-1"></i> Back
    </a>
</div>

<div class="card-royal" style="max-width:600px">
    <div class="card-header-royal"><h5>New Package</h5></div>
    <div class="card-body">
        <form action="{{ route('admin.packages.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-bold">Package Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required placeholder="e.g. Basic Package" style="border-radius:12px">
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Price (Rp)</label>
                <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required min="0" placeholder="e.g. 150000" style="border-radius:12px">
                @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Duration (Days)</label>
                <input type="number" class="form-control @error('duration_days') is-invalid @enderror" name="duration_days" value="{{ old('duration_days', 30) }}" required min="1" style="border-radius:12px">
                @error('duration_days') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold">Features (Comma Separated)</label>
                <textarea class="form-control @error('features') is-invalid @enderror" name="features" rows="3" placeholder="e.g. Digital Guestbook, Background Music, Custom Link" style="border-radius:12px">{{ old('features') }}</textarea>
                <div class="form-text">List features separated by a comma.</div>
                @error('features') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-4 form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="isActiveSwitch" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                <label class="form-check-label fw-bold" for="isActiveSwitch">Active status (Visible for purchase)</label>
            </div>
            <button type="submit" class="btn-gold"><i class="bi bi-check-lg me-1"></i> Save Package</button>
        </form>
    </div>
</div>
@endsection
