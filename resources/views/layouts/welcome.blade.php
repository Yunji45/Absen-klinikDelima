<!--

=========================================================
* Argon Dashboard - v1.1.2
=========================================================

*

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
    <link href="{{ url('argon') }}/assets/img/brand/favicon.png" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="{{ url('argon') }}/assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
    <link href="{{ url('argon') }}/assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="{{ url('argon') }}/assets/css/argon-dashboard.css?v=1.1.2" rel="stylesheet" />
</head>
<style>
    .rainbow-letters {
  font-size: 35px;
  font-family: sans-serif;
  text-transform: uppercase;
}

.rainbow-letters span:nth-child(10n + 1) {
  color: #ff5722; /* Warna oranye yang cerah */
}

.rainbow-letters span:nth-child(10n + 2) {
  color: #ff9800; /* Warna oranye keemasan */
}

.rainbow-letters span:nth-child(10n + 3){
  color: #ffc107; /* Warna kuning yang cerah */
}

.rainbow-letters span:nth-child(10n + 4) {
  color: #ffeb3b; /* Warna kuning cerah */
}

.rainbow-letters span:nth-child(10n + 5){
  color: #cddc39; /* Warna hijau cerah */
}

.rainbow-letters span:nth-child(10n + 6){
  color: #8bc34a; /* Warna hijau cerah */
}

.rainbow-letters span:nth-child(10n + 7){
  color: #4caf50; /* Warna hijau terang */
}

.rainbow-letters span:nth-child(10n + 8){
  color: #009688; /* Warna hijau toska cerah */
}

</style>

<body class="bg-default">
    <!-- Navbar -->
    @auth
    <nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
        <div class="container px-4">
            <a class="navbar-brand" href="{{ route('home') }}">
                <h1 class="text-white">Mitra Delima</h1>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse-main"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar-collapse-main">
                <!-- Collapse header -->
                <div class="navbar-collapse-header d-md-none">
                    <div class="row">
                        <div class="col-6 collapse-brand">
                            <a href="{{ route('home') }}">
                                <h1>Mitra Delima</h1>
                            </a>
                        </div>
                        <div class="col-6 collapse-close">
                            <button type="button" class="navbar-toggler" data-toggle="collapse"
                                data-target="#navbar-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
                                aria-label="Toggle sidenav">
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Navbar items -->
                <ul class="navbar-nav ml-auto">
                    @if (auth()->user()->role == "admin")
                        <li class="nav-item">
                            <a href="{{route('users.index')}}" class="nav-link nav-link-icon">
                                <i class="ni ni-circle-08"></i>
                                <span class="nav-link-inner--text">Management User</span>
                            </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        @if (auth()->user()->role == "admin")
                            <a class="nav-link nav-link-icon" href="{{ route('kehadiran.index') }}">
                        @else
                            <a class="nav-link nav-link-icon" href="{{route('daftar-hadir')}}">
                        @endif
                            <i class="ni ni-check-bold"></i>
                            <span class="nav-link-inner--text">Kehadiran</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" href="{{route('profil')}}">
                            <i class="ni ni-single-02"></i>
                            <span class="nav-link-inner--text">Profil</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" href="{{ route('auth.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="ni ni-user-run"></i>
                            <span class="nav-link-inner--text">Keluar</span>
                        </a>

                        <form id="logout-form" action="{{ route('auth.logout') }}" method="GET" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @endauth

    <div class="main-content">
        <!-- Header -->
        <div class="header bg-gradient-primary py-7 py-lg-8">
            <div class="container">
                <div class="header-body text-center mb-7">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 col-md-6">
                            <img src="{{asset('argon/logo.png')}}" alt="Logo Desa" width="100px"> <!-- Ganti 'path-to-your-logo.png' dengan URL atau path ke gambar logo Anda -->
                            <h1 class="rainbow-letters">
                                <span>R</span>
                                <span>A</span>
                                <span>M</span>
                                <span>A</span>
                                <span>S</span>
                                <span>I</span>
                                <span>N</span>
                                <span>T</span>
                                <span>A</span>
                            </h1>
                            <p class="text-lead text-light">Klinik Mitra Delima, Sistem Informasi Terintegrasi</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="separator separator-bottom separator-skew zindex-100">
                <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1"
                    xmlns="http://www.w3.org/2000/svg">
                    <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
        </div>
        <!-- Page content -->
        <div class="container mt--9 pb-5">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card bg-secondary shadow border-0">
                        <div class="card-body px-lg-5 py-lg-5">
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
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="py-5">
            <div class="container">
                <div class="copyright text-center">
                    © {{ date('Y')}} Developed By <a href="https://klinikmitradelima.com/" class="font-weight-bold ml-1"
                                target="_lank">Klinik Mitra Delima</a> Theme By <a href="https://lovely-rabanadas-9fc482.netlify.app/"
                                class="font-weight-bold ml-1" target="_blank">JSTechno</a>
                </div>
            </div>
        </footer>
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
    <script src="{{ asset('js/myscript.js') }}"></script>
    <script>
    // Ambil semua elemen span dalam elemen dengan kelas .rainbow-letters
    const rainbowLetters = document.querySelectorAll('.rainbow-letters span');

    // Loop melalui setiap elemen span
    rainbowLetters.forEach((span) => {
        // Cek apakah teks dalam elemen span adalah 'I'
        if (span.innerText === 'I') {
            // Jika ya, ubah menjadi huruf besar
            span.style.textTransform = 'lowercase';
        } else {
            // Jika tidak, ubah menjadi huruf kecil
            span.style.textTransform = 'uppercase';
        }
    });
</script>


</body>

</html>
