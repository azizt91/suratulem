@extends('layouts.dashboard')

@section('page-title', 'Manage Packages')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div></div>
    <a href="{{ route('admin.packages.create') }}" class="btn-gold">
        <i class="bi bi-plus-lg me-1"></i> Add Package
    </a>
</div>

<div class="card-royal">
    <div class="card-header-royal"><h5>All Packages</h5></div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-royal mb-0 align-middle">
                <thead>
                    <tr>
                        <th class="ps-4">Name</th>
                        <th>Price</th>
                        <th>Duration (Days)</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($packages as $package)
                        <tr>
                            <td class="ps-4 fw-bold">{{ $package->name }}</td>
                            <td>Rp {{ number_format($package->price, 0, ',', '.') }}</td>
                            <td>{{ $package->duration_days }}</td>
                            <td>
                                @if($package->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ route('admin.packages.edit', $package->id) }}" class="btn btn-sm btn-navy">Edit</a>
                                <form action="{{ route('admin.packages.destroy', $package->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" style="border-radius:50px">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center py-4 text-muted">No packages found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-body border-top pt-3 pb-2">{{ $packages->links() }}</div>
</div>
@endsection
