<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Mitra Delima</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">MD</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li>
                <a class="nav-link" href="{{route('kpi.index')}}">
                    <i class="fa fa-palette"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="menu-header">SDM</li>
            @if (auth()->user()->role == 'admin')
            <li>
                <a class="nav-link" href="">
                    <i class="fa fa-user"></i>
                    <span>Kehadiran</span>
                </a>
            </li>
            <li>
                <a class="nav-link" href="">
                    <i class="far fa-square"></i>
                    <span>Manage User</span>
                </a>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-columns"></i>
                    <span>Pengaturan Jaga</span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="">Jadwal Jaga</a>
                    </li>
                    <li>
                        <a class="nav-link" href="">Permohonan Izin</a>
                    </li>
                    <li>
                        <a class="nav-link" href="">Perubahan Jaga</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-columns"></i>
                    <span>Informasi Pegawai</span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="">Detail Pegawai</a>
                    </li>
                    <li>
                        <a class="nav-link" href="">Dokumen</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-columns"></i>
                    <span>Salary Pegawai</span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{route('gaji.adm')}}">Gaji</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{route('kpi.index')}}">KPI</a>
                    </li>
                    <li>
                        <a class="nav-link" href="">Setup UMR</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="nav-link" href="">
                    <i class="far fa-square"></i>
                    <span>Blank Page</span>
                </a>
            </li>
            @endif
            <li class="menu-header">HELP IT</li>
            <li>
                <a class="nav-link" href="">
                    <i class="fas fa-pencil-ruler"></i>
                    <span>Documentasi API</span>
                </a>
            </li>
            <li>
                <a class="nav-link" href="">
                    <i class="fas fa-pencil-ruler"></i>
                    <span>Help IT</span>
                </a>
            </li>
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a
                href="{{route('home')}}"
                class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i>
                Documentation
            </a>
        </div>
    </aside>
</div>