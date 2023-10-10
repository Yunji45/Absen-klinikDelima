<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Mitra Delima</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">MD</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="active">
                <a class="nav-link" href="{{route('home')}}">
                    <i class="fas fa-fire"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="menu-header">SDM</li>
            @if (auth()->user()->role == 'admin')
            <li class="active">
                <a class="nav-link" href="{{route('kpi.index')}}">
                    <i class="far fa-address-card"></i>
                    <span>KPI</span>
                </a>
            </li>
        
            @endif
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a
                href="{{route('home')}}"
                class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i>
                Logout
            </a>
        </div>
    </aside>
</div>