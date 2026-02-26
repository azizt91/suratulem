@extends('layouts.dashboard')

@section('page-title', 'Edit Package')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.packages.index') }}" class="btn-navy">
        <i class="bi bi-arrow-left me-1"></i> Back
    </a>
</div>

<div class="card-royal" style="max-width:600px">
    <div class="card-header-royal"><h5>Edit: {{ $package->name }}</h5></div>
    <div class="card-body">
        <form action="{{ route('admin.packages.update', $package->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label fw-bold">Package Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $package->name) }}" required style="border-radius:12px">
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Price (Rp)</label>
                <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price', $package->price) }}" required min="0" style="border-radius:12px">
                @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Duration (Days)</label>
                <input type="number" class="form-control @error('duration_days') is-invalid @enderror" name="duration_days" value="{{ old('duration_days', $package->duration_days) }}" required min="1" style="border-radius:12px">
                @error('duration_days') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold">Features (Comma Separated)</label>
                @php
                    $featuresArr = json_decode($package->features, true) ?? [];
                    $featuresStr = implode(', ', $featuresArr);
                @endphp
                <textarea class="form-control @error('features') is-invalid @enderror" name="features" rows="3" style="border-radius:12px">{{ old('features', $featuresStr) }}</textarea>
                <div class="form-text">List features separated by a comma.</div>
                @error('features') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-4 form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="isActiveSwitch" name="is_active" value="1" {{ old('is_active', $package->is_active) ? 'checked' : '' }}>
                <label class="form-check-label fw-bold" for="isActiveSwitch">Active status</label>
            </div>
            <button type="submit" class="btn-gold"><i class="bi bi-check-lg me-1"></i> Update Package</button>
        </form>
    </div>
</div>
@endsection
