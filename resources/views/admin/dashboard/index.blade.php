@extends('layouts.dashboard')

@section('page-title', 'Admin Dashboard')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-12 col-sm-6 col-xl-4">
        <div class="stat-card">
            <div class="stat-icon green"><i class="bi bi-cash-stack"></i></div>
            <div>
                <div class="stat-label">Total Revenue</div>
                <div class="stat-value">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-4">
        <div class="stat-card">
            <div class="stat-icon navy"><i class="bi bi-people-fill"></i></div>
            <div>
                <div class="stat-label">Active Users</div>
                <div class="stat-value">{{ $totalUsers ?? 0 }}</div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-xl-4">
        <div class="stat-card">
            <div class="stat-icon gold"><i class="bi bi-envelope-paper-heart"></i></div>
            <div>
                <div class="stat-label">Total Invitations</div>
                <div class="stat-value">{{ $totalInvitations ?? 0 }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
