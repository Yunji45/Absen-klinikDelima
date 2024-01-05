<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Mitra Delima</a>
            <!-- <img src="{{ asset('mitradelima/assets/img/logo-klasik.png') }}" alt="" class="img-fluid"> -->
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">MD</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Beranda</li>
            @if (auth()->user()->role == 'admin')
            <li class="nav-item dropdown {{ $type === 'dashboard' ? 'active' : '' }}">
                <a class="nav-link" href="{{route('dash.admin')}}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            @endif
            <li class="menu-header">SDM</li>
            @if (auth()->user()->role == 'admin')
            <li class="nav-item dropdown {{ $type === 'presensi' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('kehadiran.index') }}">
                    <i class="fas fa-check"></i>
                    <span>Kehadiran</span>
                </a>
            </li>
            <li class="nav-item dropdown {{ $type === 'users' ? 'active' : '' }}">
                <a class="nav-link" href="{{route('users.index')}}">
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
            <li class="nav-item dropdown {{ $type === 'detail-user' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-list"></i>
                    <span>Informasi Pegawai</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::currentRouteName() === 'detail.pegawai.admin' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('detail.pegawai.admin')}}">Detail Pegawai</a>
                    </li>
                    <li>
                        <a class="nav-link" href="">Dokumen</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ $type === 'jasamedis' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-list"></i>
                    <span>Jasa Medis / Tindakan</span>
                </a>
                <ul class="dropdown-menu">
                    <!-- <li class="{{ Route::currentRouteName() === 'target.jasa.medis' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('target.jasa.medis')}}">Rekam Tarif Jasa Medis</a>
                    </li> -->
                    <!-- <li class="{{ Route::currentRouteName() === 'opr.medis' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('opr.medis')}}">Riwayat Jasa Medis</a>
                    </li>
                    <li class="{{ Route::currentRouteName() === 'home.care' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('home.care')}}">Home Care</a>
                    </li> -->
                    <li class="{{ Route::currentRouteName() === 'kategori.jasa' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('kategori.jasa')}}">Setting Kategory</a>
                    </li>
                    <li class="{{ Route::currentRouteName() === 'daftar.pasien' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('daftar.pasien')}}">Daftar Pasien</a>
                    </li>
                    <li class="{{ Route::currentRouteName() === 'daftar.tugas' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('daftar.tugas')}}">Daftar Tugas Jasa Medis</a>
                    </li>
                </ul>
            </li>
            <!-- <li class="nav-item dropdown {{ $type === 'tasklist' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-list"></i>
                    <span>Jasa Medis / Layanan</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::currentRouteName() === 'task.list.index' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('task.list.index')}}">Ceklis Layanan Pasien</a>
                    </li>
                    <li class="{{ Route::currentRouteName() === 'task.list.history' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('task.list.history')}}">Rekap Jasa Medis</a>
                    </li>
                   
                </ul>
            </li> -->
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
                <a class="nav-link" href="{{route('ip.index')}}">
                    <i class="far fa-square"></i>
                    <span>Setting IP Address</span>
                </a>
            </li>
            <li class="menu-header">Layout</li>
            <li class="nav-item dropdown ">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-list"></i>
                    <span>Content Management</span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="">Content Beranda</a>
                    </li>
                    <li>
                        <a class="nav-link" href="">Content Profil</a>
                    </li>
                    <li>
                        <a class="nav-link" href="">Content Layanan</a>
                    </li>
                    <li>
                        <a class="nav-link" href="">Content Divisi</a>
                    </li>
                    <li>
                        <a class="nav-link" href="">Content Foto</a>
                    </li>
                    <li>
                        <a class="nav-link" href="">Pengaduan Layanan</a>
                    </li>
                   
                </ul>
            </li>
            <li class="nav-item dropdown ">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-list"></i>
                    <span>Career Management</span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="">Divisi</a>
                    </li>
                    <li>
                        <a class="nav-link" href="">Kriteria Hire</a>
                    </li>
                    <li>
                        <a class="nav-link" href="">Management Berkas</a>
                    </li>
                    <li>
                        <a class="nav-link" href="">Announcment</a>
                    </li>
                </ul>
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
            <li class="nav-item dropdown {{ $type === 'tasklist' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-list"></i>
                    <span>Jasa Medis / Layanan</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::currentRouteName() === 'task.list.index' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('task.list.index')}}">Ceklis Layanan Pasien</a>
                    </li>
                    <li class="{{ Route::currentRouteName() === 'task.list.history' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('task.list.history')}}">Rekap Jasa Medis</a>
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
            <li class="nav-item dropdown {{ $type === 'tasklist' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-list"></i>
                    <span>Jasa Medis / Layanan</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::currentRouteName() === 'task.list.index' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('task.list.index')}}">Ceklis Layanan Pasien</a>
                    </li>
                    <li class="{{ Route::currentRouteName() === 'task.list.history' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('task.list.history')}}">Rekap Jasa Medis</a>
                    </li>
                   
                </ul>
            </li>
            @endif
            @if (auth()->user()->role == 'pegawai')
            <li class="nav-item dropdown {{ $type === 'tasklist' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-list"></i>
                    <span>Jasa Medis / Layanan</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::currentRouteName() === 'task.list.index' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('task.list.index')}}">Ceklis Layanan Pasien</a>
                    </li>
                    <li class="{{ Route::currentRouteName() === 'task.list.history' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('task.list.history')}}">Rekap Jasa Medis</a>
                    </li>
                   
                </ul>
            </li>
            <li class="nav-item dropdown {{ $type === 'jasamedis' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-list"></i>
                    <span>Jasa Medis / Tindakan</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::currentRouteName() === 'daftar.pasien' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('daftar.pasien')}}">Daftar Pasien</a>
                    </li>
                    <li class="{{ Route::currentRouteName() === 'daftar.tugas' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('daftar.tugas')}}">Daftar Tugas Jasa Medis</a>
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
                href="{{route('daftar-hadir')}}"
                class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i>
                Home
            </a>
        </div>
    </aside>
</div>