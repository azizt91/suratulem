@extends('layouts.dashboard')

@section('page-title', 'Manage Users')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div></div>
    <form method="GET" action="{{ route('admin.users.index') }}" class="d-flex align-items-center gap-2">
        <select name="status" class="form-select w-auto" style="border-radius:12px;font-size:13px">
            <option value="">All Users</option>
            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active Subscription</option>
            <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Expired/No Sub</option>
        </select>
        <button type="submit" class="btn-navy" style="padding:6px 14px;font-size:13px">Filter</button>
    </form>
</div>

<div class="card-royal">
    <div class="card-header-royal"><h5>All Users</h5></div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-royal mb-0 align-middle">
                <thead>
                    <tr>
                        <th class="ps-4">Name</th>
                        <th>Email</th>
                        <th>Subscription</th>
                        <th>Expires At</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        @php
                            $sub = $user->subscription;
                            $isActive = $sub && $sub->expires_at && $sub->expires_at->isFuture();
                        @endphp
                        <tr>
                            <td class="ps-4 fw-bold">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($isActive)
                                    <span class="badge bg-success">Active ({{ $sub->package->name }})</span>
                                @else
                                    <span class="badge bg-danger">Expired / None</span>
                                @endif
                            </td>
                            <td>
                                @if($sub && $sub->expires_at)
                                    {{ $sub->expires_at->format('d M Y') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <button type="button" class="btn btn-sm btn-navy" data-bs-toggle="modal" data-bs-target="#activateModal{{ $user->id }}">
                                    Manual Activation
                                </button>

                                {{-- Activate Modal --}}
                                <div class="modal fade" id="activateModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content text-start" style="border-radius:20px;overflow:hidden">
                                            <div class="modal-header" style="background:var(--navy);color:#fff;border:none">
                                                <h5 class="modal-title" style="font-family:'Playfair Display',serif">Manual Activation: {{ $user->name }}</h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="{{ route('admin.users.activate', $user->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <p class="mb-2 small">Select a package to manually activate for this user.</p>
                                                    <select class="form-select" name="package_id" required style="border-radius:12px">
                                                        <option value="" disabled selected>-- Select Package --</option>
                                                        @foreach($packages as $pkg)
                                                            <option value="{{ $pkg->id }}">{{ $pkg->name }} - Rp {{ number_format($pkg->price, 0, ',', '.') }} ({{ $pkg->duration_days }} Days)</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="modal-footer border-0">
                                                    <button type="button" class="btn btn-sm" style="border-radius:50px" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn-gold">Activate Now</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center py-4 text-muted">No users found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-body border-top pt-3 pb-2">{{ $users->links() }}</div>
</div>
@endsection
