<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Mitra Delima</a>
            <!-- <a href="index.html" style="font-family: Rammetto One, cursive; color: #ff0000;">R</a>
            <a href="index.html" style="font-family: Amatic SC, cursive; color: #ff7f00;">A</a>
            <a href="index.html" style="font-family: Monoton, cursive; color: #ffff00;">M</a>
            <a href="index.html" style="font-family: Indie Flower, cursive; color: #00ff00;">A</a>
            <a href="index.html" style="font-family: Sacramento, cursive; color: #0000ff;">S</a>
            <a href="index.html" style="font-family: Caveat, cursive; color: #4b0082;">I</a>
            <a href="index.html" style="font-family: Fredericka the Great, cursive; color: #9400d3;">N</a>
            <a href="index.html" style="font-family: Pacifico, cursive; color: #8a2be2;">T</a>
            <a href="index.html" style="font-family: Satisfy, cursive; color: #ff1493;">A</a> -->
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
                    <span>Dashboard SDM</span>
                </a>
            </li>
            <li class="nav-item dropdown {{ $type === 'dash_layanan' ? 'active' : '' }}">
                <a class="nav-link" href="{{route('dash.layanan')}}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard Layanan</span>
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
                    <i class="fas fa-folder-open"></i>
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
                    <li class="{{ Route::currentRouteName() === 'note-karyawan.index' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('note-karyawan.index') }}">Catatan Karyawan</a>
                    </li>

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
                    <li class="{{ Route::currentRouteName() === 'thr.idul-fitri' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('thr.idul-fitri')}}">THR Idul Fitri</a>
                    </li>
                </ul>
            </li>
            <li>
                <a class="nav-link" href="{{route('ip.index')}}">
                    <i class="far fa-square"></i>
                    <span>Setting IP Address</span>
                </a>
            </li>
            <li class="menu-header">Layanan</li>
            <li class="nav-item dropdown {{ $type === 'jasamedis' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-stethoscope"></i>
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
            <li class="nav-item dropdown {{ $type === 'layanan-dataset' ? 'active' : '' }} ">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-window-restore"></i>
                    <span>Dataset Layanan</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::currentRouteName() === 'dataset.rajal' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('dataset.rajal')}}">Rawat Jalan (Poli & UGD)</a>
                    </li>
                    <li class="{{ Route::currentRouteName() === 'dataset.ranap' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('dataset.ranap')}}">Rawat Inap</a>
                    </li>
                    <li class="{{ Route::currentRouteName() === 'dataset.persalinan' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('dataset.persalinan')}}">Persalinan</a>
                    </li>
                    <li class="{{ Route::currentRouteName() === 'dataset.khitan' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('dataset.khitan')}}">Khitan</a>
                    </li>
                    <li class="{{ Route::currentRouteName() === 'dataset.lab' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('dataset.lab')}}">Laboratorium</a>
                    </li>
                    <li class="{{ Route::currentRouteName() === 'dataset.usg' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('dataset.usg')}}">USG</a>
                    </li>
                    <li class="{{ Route::currentRouteName() === 'dataset.estetika' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('dataset.estetika')}}">Estetika</a>
                    </li>
                </ul>
            </li>
            <li class="menu-header">Layout</li>
            <li class="nav-item dropdown {{ $type === 'content' ? 'active' : '' }} ">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-window-restore"></i>
                    <span>Content Management</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::currentRouteName() === 'setting-content.index' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('setting-content.index')}}">Setting Content</a>
                    </li>
                    <li class="{{ Route::currentRouteName() === 'kritik-saran' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('kritik-saran')}}">Kritik & Saran</a>
                    </li>
                   
                </ul>
            </li>
            <li class="nav-item dropdown {{ $type === 'layout' ? 'active' : '' }} ">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-user-nurse"></i>
                    <span>Open Recruitment</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Route::currentRouteName() === 'job-vacancy.index' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('job-vacancy.index')}}">Job Openings</a>
                    </li>
                    <li class="{{ Route::currentRouteName() === 'job-app' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('job-app')}}">Jobseeker Data</a>
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
                    <i class="fas fa-headset"></i>
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