<div class="col-lg-3 mb-4">
    <div class="card border-0 shadow-sm">
        <div class="card-body p-3">
            <div class="d-flex align-items-center gap-3 mb-3 pb-3 border-bottom">
                <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width:45px;height:45px;background:var(--veloria-primary);">
                    <span class="text-white fw-bold">{{ substr(auth()->user()->name,0,1) }}</span>
                </div>
                <div>
                    <div class="fw-semibold">{{ auth()->user()->name }}</div>
                    <small class="text-muted">{{ auth()->user()->email }}</small>
                </div>
            </div>
            <nav class="nav flex-column">
                <a class="nav-link px-2 py-2 rounded small {{ request()->routeIs('account.profile') ? 'active fw-semibold' : 'text-dark' }}" href="{{ route('account.profile') }}" style="{{ request()->routeIs('account.profile') ? 'background:var(--veloria-pink-soft);color:var(--veloria-primary) !important;' : '' }}"><i class="bi bi-person me-2"></i>Profile</a>
                <a class="nav-link px-2 py-2 rounded small {{ request()->routeIs('account.orders*') ? 'active fw-semibold' : 'text-dark' }}" href="{{ route('account.orders') }}" style="{{ request()->routeIs('account.orders*') ? 'background:var(--veloria-pink-soft);color:var(--veloria-primary) !important;' : '' }}"><i class="bi bi-bag me-2"></i>My Orders</a>
                <a class="nav-link px-2 py-2 rounded small {{ request()->routeIs('account.addresses') ? 'active fw-semibold' : 'text-dark' }}" href="{{ route('account.addresses') }}" style="{{ request()->routeIs('account.addresses') ? 'background:var(--veloria-pink-soft);color:var(--veloria-primary) !important;' : '' }}"><i class="bi bi-geo-alt me-2"></i>Addresses</a>
                <a class="nav-link px-2 py-2 rounded small text-dark" href="{{ route('wishlist.index') }}"><i class="bi bi-heart me-2"></i>Wishlist</a>
            </nav>
        </div>
    </div>
</div>
