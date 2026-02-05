@if (auth()->user()->role === 'admin')
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ url('/') }}" class="brand-link">
            <img src="{{ asset('assets') }}/assets/img/favicon/logo.png" height="80" class="brand-image" />
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ request()->is('/') ? 'active' : '' }}">
            <a href="{{ url('/') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>

        <!-- Menu Header: Master Data -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Master Data</span>
        </li>

        <!-- Data Pengguna -->
        <li class="menu-item {{ request()->is('user*') ? 'active' : '' }}">
            <a href="{{ url('/user') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-circle"></i>
                <div data-i18n="Data Pengguna">Data Pengguna</div>
            </a>
        </li>

        <!-- Kategori UMKM -->
        <li class="menu-item {{ request()->is('kategori*') ? 'active' : '' }}">
            <a href="{{ url('/kategori') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-category"></i>
                <div data-i18n="Kategori UMKM">Kategori UMKM</div>
            </a>
        </li>

        <!-- Data UMKM -->
        <li class="menu-item {{ request()->is('umkm*') ? 'active' : '' }}">
            <a href="{{ url('/umkm') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-store-alt"></i>
                <div data-i18n="Data UMKM">Data UMKM</div>
            </a>
        </li>

        <!-- Menu Header: Monitoring -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Monitoring</span>
        </li>

        <!-- Aktivitas UMKM -->
        <li class="menu-item {{ request()->is('aktivitas*') ? 'active' : '' }}">
            <a href="{{ url('/aktivitas') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-task"></i>
                <div data-i18n="Aktivitas UMKM">Aktivitas UMKM</div>
            </a>
        </li>

        <!-- Status Risiko -->
        <li class="menu-item {{ request()->is('status-risiko*') ? 'active' : '' }}">
            <a href="{{ url('/status-risiko') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-error-circle"></i>
                <div data-i18n="Status Risiko">Status Risiko</div>
            </a>
        </li>

        <!-- Menu Header: Laporan -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Laporan</span>
        </li>

        <!-- Histori Limit -->
        <li class="menu-item {{ request()->is('histori-limit*') ? 'active' : '' }}">
            <a href="{{ url('/histori-limit') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-history"></i>
                <div data-i18n="Histori Limit">Histori Limit</div>
            </a>
        </li>
    </ul>
</aside>
    
@elseif (auth()->user()->role === 'mentor')
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ url('/') }}" class="brand-link">
            <img src="{{ asset('assets') }}/assets/img/favicon/logo.png" height="80" class="brand-image" />
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ request()->is('/') ? 'active' : '' }}">
            <a href="{{ url('/') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>

        <!-- Menu Header: Master Data -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Master Data</span>
        </li>

        <!-- Kategori UMKM -->
        <li class="menu-item {{ request()->is('kategori*') ? 'active' : '' }}">
            <a href="{{ url('/kategori') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-category"></i>
                <div data-i18n="Kategori UMKM">Kategori UMKM</div>
            </a>
        </li>

        <!-- Data UMKM -->
        <li class="menu-item {{ request()->is('umkm*') ? 'active' : '' }}">
            <a href="{{ url('/umkm') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-store-alt"></i>
                <div data-i18n="Data UMKM">Data UMKM</div>
            </a>
        </li>

        <!-- Menu Header: Transaksi -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Transaksi</span>
        </li>

        <!-- Data Peminjaman -->
        <li class="menu-item {{ request()->is('peminjaman*') ? 'active' : '' }}">
            <a href="{{ url('/peminjaman') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-credit-card"></i>
                <div data-i18n="Data Peminjaman">Data Peminjaman</div>
            </a>
        </li>

        <!-- Data Pengembalian -->
        <li class="menu-item {{ request()->is('pengembalian*') ? 'active' : '' }}">
            <a href="{{ url('/pengembalian') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-money"></i>
                <div data-i18n="Pengembalian">Pengembalian</div>
            </a>
        </li>

        <!-- Menu Header: Monitoring -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Monitoring</span>
        </li>

        <!-- Aktivitas UMKM -->
        <li class="menu-item {{ request()->is('aktivitas*') ? 'active' : '' }}">
            <a href="{{ url('/aktivitas') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-task"></i>
                <div data-i18n="Aktivitas UMKM">Aktivitas UMKM</div>
            </a>
        </li>

        <!-- Status Risiko -->
        <li class="menu-item {{ request()->is('status-risiko*') ? 'active' : '' }}">
            <a href="{{ url('/status-risiko') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-error-circle"></i>
                <div data-i18n="Status Risiko">Status Risiko</div>
            </a>
        </li>

        <!-- Menu Header: Laporan -->
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Laporan</span>
        </li>

        <!-- Histori Limit -->
        <li class="menu-item {{ request()->is('histori-limit*') ? 'active' : '' }}">
            <a href="{{ url('/histori-limit') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-history"></i>
                <div data-i18n="Histori Limit">Histori Limit</div>
            </a>
        </li>
    </ul>
</aside>    
@endif

<style>
    /* Sidebar Professional Styling */
    .layout-menu {
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.08);
    }

    /* Brand Area */
    .app-brand.demo {
        padding: 1.5rem 1.75rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
    }

    .brand-link {
        display: flex;
        justify-content: center;
        align-items: center;
        transition: transform 0.3s ease;
    }

    .brand-link:hover {
        transform: scale(1.05);
    }

    .brand-image {
        filter: drop-shadow(0 2px 8px rgba(0, 0, 0, 0.1));
        transition: filter 0.3s ease;
    }

    .brand-link:hover .brand-image {
        filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.15));
    }

    /* Menu Header */
    .menu-header {
        padding: 1.5rem 1.75rem 0.75rem !important;
        margin-top: 0.5rem;
    }

    .menu-header-text {
        font-weight: 700;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        color: #6c757d;
        text-transform: uppercase;
        position: relative;
        padding-left: 0.5rem;
    }

    .menu-header-text::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 3px;
        height: 12px;
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        border-radius: 2px;
    }

    /* Menu Items */
    .menu-inner .menu-item {
        margin-bottom: 0.25rem;
    }

    .menu-inner .menu-item .menu-link {
        padding: 0.75rem 1.75rem;
        border-radius: 0;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .menu-inner .menu-item .menu-link::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        transform: scaleY(0);
        transition: transform 0.3s ease;
    }

    .menu-inner .menu-item:hover .menu-link::before,
    .menu-inner .menu-item.active .menu-link::before {
        transform: scaleY(1);
    }

    .menu-inner .menu-item:hover .menu-link {
        background: linear-gradient(90deg, rgba(220, 53, 69, 0.05) 0%, transparent 100%);
        padding-left: 2rem;
    }

    .menu-inner .menu-item.active .menu-link {
        background: linear-gradient(90deg, rgba(220, 53, 69, 0.1) 0%, rgba(220, 53, 69, 0.02) 100%);
        color: #ffffff;
        font-weight: 600;
        padding-left: 2rem;
    }

    /* Menu Icons */
    .menu-icon {
        margin-right: 1rem !important;
        font-size: 1.25rem !important;
        color: #6c757d;
        transition: all 0.3s ease;
    }

    .menu-item:hover .menu-icon,
    .menu-item.active .menu-icon {
        color: #ffffff;
        transform: scale(1.1);
    }

    .menu-item:hover .menu-icon{
        color: #dc3545
    }

    /* Active Menu Animation */
    .menu-item.active .menu-icon {
        animation: iconPulse 2s ease-in-out infinite;
    }

    @keyframes iconPulse {
        0%, 100% {
            transform: scale(1.1);
        }
        50% {
            transform: scale(1.2);
        }
    }

    /* Menu Text */
    .menu-item .menu-link > div {
        font-size: 0.9rem;
        font-weight: 500;
        color: #495057;
        transition: color 0.3s ease;
    }

    .menu-item:hover .menu-link > div,
    .menu-item.active .menu-link > div {
        color: #ffffff;
    }

    .menu-item:hover .menu-link > div{
        color: #dc3545
    }

    /* Scrollbar Styling */
    .menu-inner::-webkit-scrollbar {
        width: 6px;
    }

    .menu-inner::-webkit-scrollbar-track {
        background: transparent;
    }

    .menu-inner::-webkit-scrollbar-thumb {
        background: rgba(220, 53, 69, 0.3);
        border-radius: 10px;
    }

    .menu-inner::-webkit-scrollbar-thumb:hover {
        background: rgba(220, 53, 69, 0.5);
    }

    /* Menu Shadow Effect */
    .menu-inner-shadow {
        display: none;
    }

    /* Responsive */
    @media (max-width: 1199.98px) {
        .menu-inner .menu-item .menu-link {
            padding: 0.625rem 1.5rem;
        }

        .menu-header {
            padding: 1.25rem 1.5rem 0.625rem !important;
        }
    }

    /* Badge for Menu Items (Optional) */
    .menu-badge {
        position: absolute;
        right: 1.5rem;
        top: 50%;
        transform: translateY(-50%);
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        color: white;
        font-size: 0.7rem;
        padding: 0.15rem 0.5rem;
        border-radius: 10px;
        font-weight: 600;
    }

    /* Hover Effect Enhancement */
    .menu-item {
        position: relative;
    }

    .menu-item::after {
        content: '';
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%) translateX(10px);
        width: 0;
        height: 0;
        border-top: 6px solid transparent;
        border-bottom: 6px solid transparent;
        border-right: 6px solid #dc3545;
        opacity: 0;
        transition: all 0.3s ease;
    }

    .menu-item.active::after {
        opacity: 1;
        transform: translateY(-50%) translateX(0);
    }
</style>