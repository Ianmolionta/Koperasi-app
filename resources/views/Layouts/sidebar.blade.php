<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
                <img src="{{ asset('assets') }}/assets/img/favicon/logo.png" height="100" />
                <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                    <i class="bx bx-chevron-left bx-sm align-middle"></i>
                </a>
            </div>

            <div class="menu-inner-shadow"></div>

            <ul class="menu-inner py-1">
                <!-- Dashboard -->
                <li class="menu-item {{ request()->is('/') ? 'active' : '' }}">
                    <a href="{{ url('/') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-grid-alt"></i>
                        <div>Dashboard</div>
                    </a>
                </li>

                <!-- Kategori UMKM -->
                <li class="menu-item {{ request()->is('kategori*') ? 'active' : '' }}">
                    <a href="{{ url('/kategori') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-purchase-tag"></i>
                        <div>Kategori UMKM</div>
                    </a>
                </li>
                
                <!-- Data UMKM -->
                <li class="menu-item {{ request()->is('umkm*') ? 'active' : '' }}">
                    <a href="{{ url('/umkm') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-store-alt"></i>
                        <div>Data UMKM</div>
                    </a>
                </li>

                <!-- Data Peminjaman -->
                <li class="menu-item {{ request()->is('peminjaman*') ? 'active' : '' }}">
                    <a href="{{ url('/peminjaman') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-wallet"></i>
                        <div>Data Peminjaman</div>
                    </a>
                </li>

                <!-- Data Pengembalian -->
                <li class="menu-item {{ request()->is('pengembalian*') ? 'active' : '' }}">
                    <a href="{{ url('/pengembalian') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-money"></i>
                        <div>Pengembalian</div>
                    </a>
                </li>

                <!-- Laporan -->
                <li class="menu-item {{ request()->is('histori-limit*') ? 'active' : '' }}">
                    <a href="{{ url('/histori-limit') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-history"></i>
                        <div>Histori Limit</div>
                    </a>
                </li>

                <!-- Pengaturan -->
                <li class="menu-item {{ request()->is('status-risiko*') ? 'active' : '' }}">
                    <a href="{{ url('/status-risiko') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-shield-quarter"></i>
                        <div>Status Risiko</div>
                    </a>
                </li>
            </ul>
        </aside>