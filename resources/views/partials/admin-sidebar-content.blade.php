<div class="p-3 sidebar-brand">
    <a href="{{ route('admin.dashboard') }}" class="text-decoration-none d-flex align-items-center">
        <i class="bi bi-gem fs-4 me-2" style="color: var(--veloria-primary-light);"></i>
        <div>
            <span class="fs-5 fw-bold brand-name" style="font-family: 'Playfair Display', serif; letter-spacing: 2px;">VELORIA</span>
            <div class="small" style="color: rgba(255,255,255,0.4); font-size: 0.65rem; letter-spacing: 1px;">ADMIN PANEL</div>
        </div>
    </a>
</div>

<nav class="nav flex-column py-3 flex-grow-1 flex-nowrap w-100">
    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
        <i class="bi bi-grid-1x2"></i> Dashboard
    </a>
    <div class="px-3 py-2 mt-2">
        <small class="text-uppercase fw-semibold" style="color: rgba(255,255,255,0.3); font-size: 0.65rem; letter-spacing: 1px;">Catalogue</small>
    </div>
    <a class="nav-link" href="#">
        <i class="bi bi-folder"></i> Categories
    </a>
    <a class="nav-link" href="#">
        <i class="bi bi-handbag"></i> Products
    </a>
    <div class="px-3 py-2 mt-2">
        <small class="text-uppercase fw-semibold" style="color: rgba(255,255,255,0.3); font-size: 0.65rem; letter-spacing: 1px;">Sales</small>
    </div>
    <a class="nav-link" href="#">
        <i class="bi bi-bag-check"></i> Orders
    </a>
    <a class="nav-link" href="#">
        <i class="bi bi-people"></i> Customers
    </a>
    <a class="nav-link" href="#">
        <i class="bi bi-credit-card"></i> Payments
    </a>
    <div class="px-3 py-2 mt-2">
        <small class="text-uppercase fw-semibold" style="color: rgba(255,255,255,0.3); font-size: 0.65rem; letter-spacing: 1px;">Marketing</small>
    </div>
    <a class="nav-link" href="#">
        <i class="bi bi-ticket-perforated"></i> Coupons
    </a>
    <a class="nav-link" href="#">
        <i class="bi bi-star"></i> Reviews
    </a>
    <a class="nav-link" href="#">
        <i class="bi bi-bar-chart"></i> Reports
    </a>
    <div class="px-3 py-2 mt-2">
        <small class="text-uppercase fw-semibold" style="color: rgba(255,255,255,0.3); font-size: 0.65rem; letter-spacing: 1px;">System</small>
    </div>
    <a class="nav-link" href="#">
        <i class="bi bi-gear"></i> Settings
    </a>
</nav>

<div class="p-3" style="border-top: 1px solid rgba(255,255,255,0.08);">
    <div class="d-flex align-items-center">
        <div class="rounded-circle d-flex align-items-center justify-content-center me-2 flex-shrink-0" style="width: 36px; height: 36px; background: var(--veloria-primary);">
            <span class="fw-bold text-white small">{{ substr(Auth::user()->name, 0, 1) }}</span>
        </div>
        <div class="flex-grow-1 overflow-hidden">
            <div class="small fw-semibold text-white text-truncate">{{ Auth::user()->name }}</div>
            <div class="small" style="color: rgba(255,255,255,0.4); font-size: 0.7rem;">Administrator</div>
        </div>
        <form method="POST" action="{{ route('logout') }}" class="ms-2 flex-shrink-0">
            @csrf
            <button type="submit" class="btn btn-link p-0" style="color: rgba(255,255,255,0.5);" title="Logout">
                <i class="bi bi-box-arrow-right"></i>
            </button>
        </form>
    </div>
</div>
