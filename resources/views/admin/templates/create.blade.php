@extends('layouts.dashboard')

@section('page-title', 'Add Template')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.templates.index') }}" class="btn-navy">
        <i class="bi bi-arrow-left me-1"></i> Back
    </a>
</div>

<div class="card-royal" style="max-width:600px">
    <div class="card-header-royal"><h5>New Template</h5></div>
    <div class="card-body">
        <form action="{{ route('admin.templates.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-bold">Template Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required placeholder="e.g. Classic Gold" style="border-radius:12px">
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Slug (Optional)</label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" value="{{ old('slug') }}" placeholder="Auto-generated if blank" style="border-radius:12px">
                @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Category</label>
                <select class="form-select @error('category') is-invalid @enderror" name="category" style="border-radius:12px">
                    <option value="Luxury / Premium" {{ old('category') == 'Luxury / Premium' ? 'selected' : '' }}>Luxury / Premium</option>
                    <option value="Minimalist" {{ old('category') == 'Minimalist' ? 'selected' : '' }}>Minimalist</option>
                    <option value="Floral & Botanical" {{ old('category') == 'Floral & Botanical' ? 'selected' : '' }}>Floral & Botanical</option>
                    <option value="Modern & Creative" {{ old('category') == 'Modern & Creative' ? 'selected' : '' }}>Modern & Creative</option>
                    <option value="Religious / Traditional" {{ old('category') == 'Religious / Traditional' ? 'selected' : '' }}>Religious / Traditional</option>
                    <option value="Khitan" {{ old('category') == 'Khitan' ? 'selected' : '' }}>Khitan</option>
                </select>
                @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Blade Path</label>
                <input type="text" class="form-control @error('blade_path') is-invalid @enderror" name="blade_path" value="{{ old('blade_path', 'invitation.themes.default') }}" required style="border-radius:12px">
                <div class="form-text">e.g. <code>invitation.themes.classic_gold</code></div>
                @error('blade_path') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold">Preview Thumbnail</label>
                <input type="file" class="form-control @error('preview_image') is-invalid @enderror" name="preview_image" accept="image/png, image/jpeg, image/jpg" style="border-radius:12px">
                <div class="form-text">Max 2MB. JPG, JPEG, PNG.</div>
                @error('preview_image') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <button type="submit" class="btn-gold"><i class="bi bi-check-lg me-1"></i> Save Template</button>
        </form>
    </div>
</div>
@endsection
