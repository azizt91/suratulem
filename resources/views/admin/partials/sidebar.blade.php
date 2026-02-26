<div class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse shadow-sm" style="min-height: calc(100vh - 56px);">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active fw-bold text-primary' : 'text-dark' }}" aria-current="page" href="{{ route('dashboard') }}">
                    <i class="bi bi-house-door me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="#">
                    <i class="bi bi-gear me-2"></i> Settings (White-label)
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active fw-bold text-primary' : 'text-dark' }}" href="{{ route('admin.users.index') }}">
                    <i class="bi bi-people me-2"></i> Manage Users
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.packages.*') ? 'active fw-bold text-primary' : 'text-dark' }}" href="{{ route('admin.packages.index') }}">
                    <i class="bi bi-box me-2"></i> Packages
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.templates.*') ? 'active fw-bold text-primary' : 'text-dark' }}" href="{{ route('admin.templates.index') }}">
                    <i class="bi bi-palette me-2"></i> Templates
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.music.*') ? 'active fw-bold text-primary' : 'text-dark' }}" href="{{ route('admin.music.index') }}">
                    <i class="bi bi-music-note me-2"></i> Music
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.revenue.*') ? 'active fw-bold text-primary' : 'text-dark' }}" href="{{ route('admin.revenue.index') }}">
                    <i class="bi bi-cash-coin me-2"></i> Revenue & Payments
                </a>
            </li>
        </ul>
    </div>
</div>
