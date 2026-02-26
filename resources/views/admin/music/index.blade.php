@extends('layouts.dashboard')

@section('page-title', 'Manage Music')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div></div>
    <a href="{{ route('admin.music.create') }}" class="btn-gold">
        <i class="bi bi-plus-lg me-1"></i> Add Music
    </a>
</div>

<div class="card-royal">
    <div class="card-header-royal"><h5>All Music</h5></div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-royal mb-0 align-middle">
                <thead>
                    <tr>
                        <th class="ps-4">Title</th>
                        <th>Preview</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($music as $item)
                        <tr>
                            <td class="ps-4 fw-bold">{{ $item->title }}</td>
                            <td>
                                @if($item->file_path)
                                    <audio controls style="height:32px;max-width:200px">
                                        <source src="{{ $item->file_path }}" type="audio/mpeg">
                                    </audio>
                                @else
                                    <span class="text-muted">No Audio</span>
                                @endif
                            </td>
                            <td>
                                @if($item->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ route('admin.music.edit', $item->id) }}" class="btn btn-sm btn-navy">Edit</a>
                                <form action="{{ route('admin.music.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" style="border-radius:50px">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center py-4 text-muted">No music found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-body border-top pt-3 pb-2">{{ $music->links() }}</div>
</div>
@endsection
