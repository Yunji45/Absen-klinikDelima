<!--

=========================================================
* Argon Dashboard - v1.1.2
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2020 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        @yield('title')
    </title>
    <!-- Favicon -->
    <link href="{{ url('argon') }}/logo.png" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="{{ url('argon') }}/assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
    <link href="{{ url('argon') }}/assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="{{ url('argon') }}/assets/css/argon-dashboard.css?v=1.1.2" rel="stylesheet" />
    @yield('styles')
    

</head>


<body class="">
    <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
        <div class="container-fluid">
            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
                aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Brand -->
            <a class="navbar-brand pt-0" href="{{ route('home') }}">
                <h1>Mitra Delima</h1>
            </a>
            <!-- User -->
            <ul class="nav align-items-center d-md-none">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <div class="media align-items-center">
                            <span class="avatar avatar-sm rounded-circle">
                                <img alt="Image placeholder" src="{{ asset(Storage::url(Auth::user()->foto)) }}"
                                    alt="{{ Auth::user()->foto }}" >
                            </span>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                        <a href="{{ route('auth.logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="dropdown-item">
                            <i class="ni ni-user-run"></i>
                            <span>Keluar</span>
                        </a>
                    </div>
                </li>
            </ul>
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Collapse header -->
                <div class="navbar-collapse-header d-md-none">
                    <div class="row">
                        <div class="col-6 collapse-brand">
                            <a href="{{ route('home') }}">
                                <h1>Klinik Mitra Delima</h1>
                            </a>
                        </div>
                        <div class="col-6 collapse-close">
                            <button type="button" class="navbar-toggler" data-toggle="collapse"
                                data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
                                aria-label="Toggle sidenav">
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Navigation -->
                <ul class="navbar-nav">
                    @if (auth()->user()->role == "admin")
                    
                        @if (Request::segment(1) == 'kehadiran')
                            <li class="nav-item active">
                            <a class="nav-link active" href="{{ route('kehadiran.index') }}">
                        @else
                            <li class="nav-item">
                            <a class="nav-link" href="{{ route('kehadiran.index') }}">
                        @endif
                                <i class="ni ni-check-bold text-primary"></i> Kehadiran
                            </a>
                        </li>

                        @if (Request::segment(1) == 'users')
                            <li class="nav-item active">
                            <a class="nav-link active" href="{{route('users.index')}}">
                        @else
                            <li class="nav-item">
                            <a class="nav-link" href="{{route('users.index')}}">
                        @endif
                                <i class="ni ni-circle-08 text-primary"></i> Management User
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="konfirmasiDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ni ni-settings text-dark"></i> Pengaturan Jaga
                            </a>
                            <div class="dropdown-menu" aria-labelledby="konfirmasiDropdown">
                                <a class="dropdown-item" href="{{ route('jadwal.shift') }}">Jadwal Jaga</a>
                                <a class="dropdown-item" href="{{ route('konfirmasi.izin') }}">Permohonan Izin</a>
                                <a class="dropdown-item" href="{{ route('permohonan.index') }}">Perubahan Jaga</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ni ni-bullet-list-67 text-info"></i> Informasi Pegawai
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="{{ route('detail.pegawai.admin') }}">Detail Pegawai</a>
                                <a class="dropdown-item" href="{{route('adm.dokumen')}}">Dokumen Pegawai</a>
                                <a class="dropdown-item" href="{{route('adm.sertifikat')}}">Sertifikat Pegawai</a>
                                <!-- Tambahkan lebih banyak opsi dropdown sesuai kebutuhan -->
                            </div>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{route('ip.index')}}" >
                                <i class="fa fa-power-off text-danger"></i>Setting IP Address
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="konfirmasiDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ni ni-credit-card text-success"></i> Salary Pegawai
                            </a>
                            <div class="dropdown-menu" aria-labelledby="konfirmasiDropdown">
                                <a class="dropdown-item" href="{{ route('gaji.adm') }}">Gaji</a>
                                <a class="dropdown-item" href="{{route('gaji.indexUMR')}}">Setup UMR</a>
                                <a class="dropdown-item" href="{{route('kpi.index')}}">Insentif</a>
                            </div>
                        </li>

                    @else
                        @if (Request::segment(1) == 'daftar-hadir')
                            <li class="nav-item active">
                            <a class="nav-link active" href="{{ route('daftar-hadir') }}">
                        @else
                            <li class="nav-item">
                            <a class="nav-link" href="{{ route('daftar-hadir') }}">
                        @endif
                                <i class="ni ni-check-bold text-primary"></i> Kehadiran
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->role == 'pegawai')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="permohonanDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ni ni-settings text-success"></i> Pengaturan Jaga
                            </a>
                            <div class="dropdown-menu" aria-labelledby="permohonanDropdown">
                                <a class="dropdown-item" href="{{ route('jadwal.user') }}">Jadwal Jaga</a>
                                <a class="dropdown-item" href="{{ route('index.izin.user') }}">Permohonan Izin</a>
                                <a class="dropdown-item" href="{{ route('permohonan.jadwal.user') }}">Rubah Jadwal</a>
                            </div>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{route('daftar.pasien')}}" >
                                <i class="fa fa-suitcase text-success"></i> Jasa Medis / Tindakan
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{route('task.list.index')}}" >
                                <i class="fa fa-suitcase text-success"></i> Jasa Medis & Layanan
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="permohonanDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-credit-card text-danger"></i> Salary
                            </a>
                            <div class="dropdown-menu" aria-labelledby="permohonanDropdown">
                                <a class="dropdown-item" href="{{route('gaji.pegawai')}}">Gaji</a>
                                <a class="dropdown-item" href="{{ route('insentif.pegawai') }}">Insentif</a>
                            </div>
                        </li>
                    @endif
                    @if(auth()->user()->role == 'keuangan')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="permohonanDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ni ni-settings text-success"></i> Pengaturan Jaga
                            </a>
                            <div class="dropdown-menu" aria-labelledby="permohonanDropdown">
                                <a class="dropdown-item" href="{{ route('jadwal.user') }}">Jadwal Jaga</a>
                                <a class="dropdown-item" href="{{ route('index.izin.user') }}">Permohonan Izin</a>
                                <a class="dropdown-item" href="{{ route('permohonan.jadwal.user') }}">Rubah Jadwal</a>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="konfirmasiDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ni ni-credit-card text-success"></i> Salary Pegawai
                            </a>
                            <div class="dropdown-menu" aria-labelledby="konfirmasiDropdown">
                                <a class="dropdown-item" href="{{ route('gaji.adm') }}">Gaji</a>
                                <a class="dropdown-item" href="{{route('gaji.indexUMR')}}">Setup UMR</a>
                                <a class="dropdown-item" href="{{route('kpi.index')}}">Insentif</a>
                            </div>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{route('task.list.index')}}" >
                                <i class="fa fa-suitcase text-success"></i> Jasa Medis & Layanan
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="permohonanDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-credit-card text-danger"></i> Salary
                            </a>
                            <div class="dropdown-menu" aria-labelledby="permohonanDropdown">
                                <a class="dropdown-item" href="{{route('gaji.pegawai')}}">Gaji</a>
                                <a class="dropdown-item" href="{{ route('insentif.pegawai') }}">Insentif</a>
                            </div>
                        </li>

                    @endif
                    @if(auth()->user()->role == 'evaluator')
                    <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="permohonanDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ni ni-settings text-success"></i> Pengaturan Jaga
                            </a>
                            <div class="dropdown-menu" aria-labelledby="permohonanDropdown">
                                <a class="dropdown-item" href="{{ route('jadwal.user') }}">Jadwal Jaga</a>
                                <a class="dropdown-item" href="{{ route('index.izin.user') }}">Permohonan Izin</a>
                                <a class="dropdown-item" href="{{ route('permohonan.jadwal.user') }}">Rubah Jadwal</a>
                            </div>
                        </li>

                    <li class="nav-item ">
                            <a class="nav-link" href="{{route('target.kpi')}}" >
                                <i class="fa fa-suitcase text-success"></i> Evaluasi Karwayan
                            </a>
                    </li>
                    <li class="nav-item ">
                            <a class="nav-link" href="{{route('task.list.index')}}" >
                                <i class="fa fa-suitcase text-success"></i> Jasa Medis & Layanan
                            </a>
                    </li>
                    <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="permohonanDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-credit-card text-danger"></i> Salary
                            </a>
                            <div class="dropdown-menu" aria-labelledby="permohonanDropdown">
                                <a class="dropdown-item" href="{{route('gaji.pegawai')}}">Gaji</a>
                                <a class="dropdown-item" href="{{ route('insentif.pegawai') }}">Insentif</a>
                            </div>
                        </li>


                    @endif

                    @if (Request::segment(1) == 'profil')
                        <li class="nav-item active">
                        <a class="nav-link active" href="{{ route('profil') }}">
                    @else
                        <li class="nav-item">
                        <a class="nav-link" href="{{ route('profil') }}">
                    @endif
                            <i class="ni ni-single-02 text-yellow"></i> Profil
                        </a>
                    </li>

                    @if (Request::segment(1) == 'ganti-password')
                        <li class="nav-item active">
                        <a class="nav-link active" href="{{ route('ganti-password') }}">
                    @else
                        <li class="nav-item">
                        <a class="nav-link" href="{{ route('ganti-password') }}">
                    @endif
                            <i class="ni ni-key-25 text-danger"></i> Ganti Password
                        </a>
                    </li>
                    <li class="nav-item ">
                            <a class="nav-link" href="/Chat" >
                                <i class="fa fa-question-circle text-primary"></i> Help IT
                            </a>
                    </li>
                </ul>
                <hr class="my-3">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('auth.logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="ni ni-user-run text-info"></i> Keluar
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="main-content">
        <!-- Navbar -->
        <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
            <div class="container-fluid">
                <!-- Brand -->
                <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block"
                    href="{{ route('home') }}">Home</a>
                <!-- User -->
                <ul class="navbar-nav align-items-center d-none d-md-flex">
                    <li class="nav-item dropdown">
                        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <div class="media align-items-center">
                                <span class="avatar avatar-sm rounded-circle">
                                    <img alt="Image placeholder" src="{{ Storage::url(Auth::user()->foto ) }}"
                                        alt="{{ Auth::user()->foto }}" >
                                </span>
                                <div class="media-body ml-2 d-none d-lg-block">
                                    <span class="mb-0 text-sm  font-weight-bold">{{ auth()->user()->name }}</span>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                            <a href="{{ route('auth.logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="dropdown-item">
                                <i class="ni ni-user-run"></i>
                                <span>Logout</span>
                            </a>

                            <form id="logout-form" action="{{ route('auth.logout') }}" method="GET" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- End Navbar -->

        <!-- Header -->
        <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
            <div class="container-fluid">
                <div class="header-body">
                    <!-- Card stats -->
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if ($errors->any())<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
                    @yield('header')
                </div>
            </div>
        </div>
        <div class="container-fluid mt--7">
            @yield('content')
            <!-- Footer -->
            <footer class="footer">
                <div class="row align-items-center justify-content-xl-between">
                    <div class="col-xl-6">
                        <div class="copyright text-center text-xl-left text-muted">
                            © {{ date('Y')}} Developed By <a href="https://klinikmitradelima.com/" class="font-weight-bold ml-1"
                                target="_lank">Klinik Delima</a> Theme By <a href="https://portofolio-ihya.netlify.app/"
                                class="font-weight-bold ml-1" target="_blank">JSTechno</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!--   Core   -->
    <script src="{{ url('argon') }}/assets/js/plugins/jquery/dist/jquery.min.js"></script>
    <script src="{{ url('argon') }}/assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <!--   Optional JS   -->
    @stack('scripts')

    <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
    <script>
        window.TrackJS &&
            TrackJS.install({
                token: "ee6fab19c5a04ac1a32a645abde4613a",
                application: "argon-dashboard-free"
            });
    </script>

</body>

</html>
