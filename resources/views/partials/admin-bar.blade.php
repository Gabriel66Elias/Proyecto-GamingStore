<div class="admin-topbar">
    <div class="container">
        <div class="admin-topbar-inner">

            <div class="admin-topbar-left">
                <span class="admin-topbar-dot"></span>
                <span class="admin-topbar-label">Modo Admin</span>
                <span class="admin-topbar-sep"></span>
                <span class="admin-topbar-user d-none d-sm-inline">{{ Auth::user()->nombre }}</span>
            </div>

            <a href="{{ route('admin.dashboard') }}" class="admin-topbar-btn admin-topbar-btn--primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" fill="currentColor" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                </svg>
                Volver al Panel de Admin
            </a>

        </div>
    </div>
</div>
