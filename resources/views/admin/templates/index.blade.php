@extends('layouts.dashboard')

@section('page-title', 'Manage Templates')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div></div>
    <a href="{{ route('admin.templates.create') }}" class="btn-gold">
        <i class="bi bi-plus-lg me-1"></i> Add Template
    </a>
</div>

<div class="card-royal">
    <div class="card-header-royal"><h5>All Templates</h5></div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-royal mb-0 align-middle">
                <thead>
                    <tr>
                        <th class="ps-4">Preview</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Blade Path</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($templates as $template)
                        <tr>
                            <td class="ps-4">
                                @if($template->preview_image)
                                    <img src="{{ Str::startsWith($template->preview_image, ['http://', 'https://', '/storage/']) ? $template->preview_image : Storage::url($template->preview_image) }}" alt="preview" style="width:70px;height:70px;object-fit:cover;border-radius:10px">
                                @else
                                    <div style="width:70px;height:70px;border-radius:10px;background:var(--cream);display:flex;align-items:center;justify-content:center;color:var(--text-muted);font-size:11px">No Img</div>
                                @endif
                            </td>
                            <td class="fw-bold">{{ $template->name }}</td>
                            <td><span class="badge" style="background:var(--navy);border-radius:50px">{{ $template->category ?? 'General' }}</span></td>
                            <td class="font-monospace small text-muted">{{ $template->blade_path }}</td>
                            <td class="text-end pe-4">
                                <a href="{{ route('admin.templates.edit', $template->id) }}" class="btn btn-sm btn-navy">Edit</a>
                                <form action="{{ route('admin.templates.destroy', $template->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" style="border-radius:50px">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center py-4 text-muted">No templates found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-body border-top pt-3 pb-2">{{ $templates->links() }}</div>
</div>
@endsection
