<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Mitra Delima</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">MD</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Beranda</li>
            <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{route('dash.admin')}}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a class="nav-link" href="">
                    <i class="fas fa-palette"></i>
                    <span>Beranda</span>
                </a>

            </li>
            <li class="menu-header">SDM</li>
            @if (auth()->user()->role == 'admin')
            <li>
                <a class="nav-link" href="">
                    <i class="fas fa-check"></i>
                    <span>Kehadiran</span>
                </a>
            </li>
            <li>
                <a class="nav-link" href="">
                    <i class="far fa-user"></i>
                    <span>Manage User</span>
                </a>
            </li>
            <li class="nav-item dropdown {{ $type === 'jadwal' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-cogs"></i>
                    <span>Pengaturan Jaga</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::currentRouteName() === 'jadwal.shift' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('jadwal.shift')}}">Jadwal Jaga</a>
                    </li>
                    <li class="{{ Route::currentRouteName() === 'konfirmasi.izin' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('konfirmasi.izin')}}">Permohonan Izin</a>
                    </li>
                    <li class="{{ Route::currentRouteName() === 'permohonan.index' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('permohonan.index')}}">Perubahan Jaga</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-list"></i>
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
            <li class="nav-item dropdown {{ $type === 'kpi' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-handshake"></i>
                    <span>KPI</span>
                </a>
                <ul class="dropdown-menu">
                    <!-- <li>
                        <a class="nav-link" href="{{route('coba')}}">Coba Input Multiple User</a>
                    </li> -->

                    <li class="{{ Route::currentRouteName() === 'target.kpi' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('target.kpi')}}">Target KPI</a>
                    </li>
                    <li class="{{ Route::currentRouteName() === 'kpi.datakinerja' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('kpi.datakinerja')}}">Realisasi KPI</a>
                    </li>
                    <li class="{{ Route::currentRouteName() === 'kpi.index' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('kpi.index')}}">Evaluasi Kinerja KPI</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ $type === 'gaji' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-money-bill"></i>
                    <span>Salary Pegawai</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::currentRouteName() === 'gaji.indexUMR' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('gaji.indexUMR')}}">Setup UMR</a>
                    </li>
                    <li class="{{ Route::currentRouteName() === 'setup.insentif' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('setup.insentif')}}">Setup Insentif</a>
                    </li>
                    <li class="{{ Route::currentRouteName() === 'gaji.adm' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('gaji.adm')}}">Gaji</a>
                    </li>
                    <li class="{{ Route::currentRouteName() === 'insentif.kpi' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('insentif.kpi')}}">Insentif</a>
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
            @if(auth()->user()->role == 'keuangan')
            <li class="nav-item dropdown {{ $type === 'gaji' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-money-bill"></i>
                    <span>Salary Pegawai</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::currentRouteName() === 'gaji.indexUMR' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('gaji.indexUMR')}}">Setup UMR</a>
                    </li>
                    <li class="{{ Route::currentRouteName() === 'setup.insentif' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('setup.insentif')}}">Setup Insentif</a>
                    </li>
                    <li class="{{ Route::currentRouteName() === 'gaji.adm' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('gaji.adm')}}">Gaji</a>
                    </li>
                    <li class="{{ Route::currentRouteName() === 'insentif.kpi' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('insentif.kpi')}}">Insentif</a>
                    </li>
                </ul>
            </li>
            @endif
            @if(auth()->user()->role == 'evaluator')
            <li class="nav-item dropdown {{ $type === 'kpi' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-handshake"></i>
                    <span>KPI</span>
                </a>
                <ul class="dropdown-menu">
                    <!-- <li>
                        <a class="nav-link" href="{{route('coba')}}">Coba Input Multiple User</a>
                    </li> -->

                    <li class="{{ Route::currentRouteName() === 'target.kpi' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('target.kpi')}}">Target KPI</a>
                    </li>
                    <li class="{{ Route::currentRouteName() === 'kpi.datakinerja' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('kpi.datakinerja')}}">Realisasi KPI</a>
                    </li>
                    <li class="{{ Route::currentRouteName() === 'kpi.index' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('kpi.index')}}">Evaluasi Kinerja KPI</a>
                    </li>
                </ul>
            </li>
            @endif

            <li class="menu-header">HELP IT</li>
            <li>
                <a class="nav-link" href="{{route('dok.api')}}">
                    <i class="fas fa-code"></i>
                    <span>Dokumentasi API</span>
                </a>
            </li>
            <li>
                <a class="nav-link" href="">
                    <i class="fas fa-comments"></i>
                    <span>Help IT</span>
                </a>
            </li>
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a
                href="{{route('home')}}"
                class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i>
                Home
            </a>
        </div>
    </aside>
</div>