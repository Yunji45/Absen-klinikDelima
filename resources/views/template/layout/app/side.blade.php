<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Dashboard</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="active">
                <a class="nav-link" href="{{route('dashboard')}}">
                    <i class="fas fa-fire"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="menu-header">Pages</li>
            @if (auth()->user()->role == 'admin')
            <li class="active">
                <a class="nav-link" href="{{route('user')}}">
                    <i class="far fa-address-card"></i>
                    <span>User</span>
                </a>
            </li>
            <li class="active">
                <a class="nav-link" href="{{route('barang')}}">
                    <i class="far fa-folder-open"></i>
                    <span>Barang</span>
                </a>
            </li>
            <li class="active">
                <a class="nav-link" href="{{route('lokasi')}}">
                    <i class="fas fa-plane"></i>
                    <span>Lokasi</span>
                </a>
            </li>
            @endif
            <li class="active">
                <a class="nav-link" href="{{route('pengiriman')}}">
                    <i class="fas fa-chart-line"></i>
                    <span>Pengiriman</span>
                </a>
            </li>

        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a
                href="{{route('logout')}}"
                class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i>
                Logout
            </a>
        </div>
    </aside>
</div>