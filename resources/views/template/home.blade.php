<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Home - Klinik Mitra Delima</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('index/assets/img/logo.png')}}" rel="icon">
  <link href="{{asset('index/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('index/assets/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{asset('index/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('index/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('index/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('index/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('index/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('index/assets/css/style.css')}}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Appland
  * Updated: Sep 25 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/free-bootstrap-app-landing-page-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top  header-transparent ">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        <h1><a href="index.html">MITRA DELIMA</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="index/assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#faq">Kehadiran</a></li>
          <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
          <li><a class="getstarted scrollto" href="#features">Get Started</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-lg-flex flex-lg-column justify-content-center align-items-stretch pt-5 pt-lg-0 order-2 order-lg-1" data-aos="fade-up">
            <div>
            <h1 class="rainbow-letters">
                                <span>R</span>
                                <span>A</span>
                                <span>M</span>
                                <span>A</span>
                                <span>S</span>
                                <span>i</span>
                                <span>N</span>
                                <span>T</span>
                                <span>A</span>
            </h1>
            <p style="font-size: 16px;">Klinik Mitra Delima, Sistem Informasi Terintegrasi</p>
                @if ($present)
                    @if ($present->keterangan == 'Alpha')
                        @if (strtotime(date('H:i')) >= strtotime(config('absensi.jam_masuk_PS') . ' -1 hours') && strtotime(date('H:i')) <= strtotime(config('absensi.jam_keluar_PS')))
                            <p>Silahkan Check-in</p>
                            <form action="{{ route('kehadiran.check-in') }}" method="post">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <button class="btn btn-primary" type="submit">ABSEN</button>
                            </form>
                        @elseif (strtotime(date('H:i')) >= strtotime(config('absensi.jam_masuk_SM') . ' -1 hours') && strtotime(date('H:i')) <= strtotime(config('absensi.jam_keluar_SM')))
                            <p>Silahkan Check-in</p>
                            <form action="{{ route('kehadiran.check-in') }}" method="post">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <button class="btn btn-primary" type="submit">ABSEN</button>
                            </form>
                        @elseif (strtotime(date('H:i')) >= strtotime(config('absensi.jam_masuk_PM') . ' -1 hours') && strtotime(date('H:i')) <= strtotime(config('absensi.jam_keluar_PM')))
                            <p>Silahkan Check-in</p>
                            <form action="{{ route('kehadiran.check-in') }}" method="post">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <button class="btn btn-primary" type="submit">ABSEN</button>
                            </form>
                        @elseif (strtotime(date('H:i')) >= strtotime(config('absensi.jam_masuk') . ' -1 hours') && strtotime(date('H:i')) <= strtotime(config('absensi.jam_keluar')))
                            <p>Silahkan Check-in</p>
                            <form action="{{ route('kehadiran.check-in') }}" method="post">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                <button class="btn btn-primary" type="submit">ABSEN</button>
                            </form>
                        @else
                            <p>Check-in Belum Tersedia</p>
                        @endif
                    @elseif ($present->keterangan == 'Cuti')
                        <p>Anda Sedang Cuti</p>
                    @else
                        <p>Check-in hari ini pukul: ({{ $present->jam_masuk }})</p>
                        @if ($present->jam_keluar)
                            <p>Check-out hari ini pukul: ({{ $present->jam_keluar }})</p>
                        @else
                            @if (strtotime('now') >= strtotime(config('absensi.jam_keluar_PS')) || strtotime('now') >= strtotime(config('absensi.jam_keluar_SM')) || strtotime('now') >= strtotime(config('absensi.jam_keluar_PM')))
                                <p>Jika pekerjaan telah selesai silahkan check-out</p>
                                <form action="{{ route('kehadiran.check-out', ['kehadiran' => $present]) }}" method="post">
                                    @csrf @method('patch')
                                    <button class="btn btn-primary" type="submit">ABSEN-KELUAR</button>
                                </form>
                            @else
                                <p>Check-out Belum Tersedia</p>
                            @endif
                        @endif
                    @endif
                @else
                    @if (strtotime(date('H:i')) >= strtotime(config('absensi.jam_masuk_PS') . ' -1 hours') && strtotime(date('H:i')) <= strtotime(config('absensi.jam_keluar_PS')))
                        <p>Silahkan Check-in</p>
                        <form action="{{ route('kehadiran.check-in') }}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <button class="btn btn-primary" type="submit" >ABSEN</button>
                        </form>
                    @elseif (strtotime(date('H:i')) >= strtotime(config('absensi.jam_masuk_SM') . ' -1 hours') && strtotime(date('H:i')) <= strtotime(config('absensi.jam_keluar_SM')))
                        <p>Silahkan Check-in</p>
                        <form action="{{ route('kehadiran.check-in') }}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <button class="btn btn-primary" type="submit">Absen</button>
                        </form>
                    @elseif (strtotime(date('H:i')) >= strtotime(config('absensi.jam_masuk_PM') . ' -1 hours') && strtotime(date('H:i')) <= strtotime(config('absensi.jam_keluar_PM')))
                        <p>Silahkan Check-in</p>
                        <form action="{{ route('kehadiran.check-in') }}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <button class="btn btn-primary" type="submit">ABSEN</button>
                        </form>
                    @elseif (strtotime(date('H:i')) >= strtotime(config('absensi.jam_masuk') . ' -1 hours') && strtotime(date('H:i')) <= strtotime(config('absensi.jam_keluar')))
                        <p>Silahkan Check-in</p>
                        <form action="{{ route('kehadiran.check-in') }}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <button class="btn btn-primary" type="submit">ABSEN</button>
                        </form>
                    @else
                        <p>Check-in Belum Tersedia</p>
                    @endif
                @endif
            </div>
        </div>
        <div class="col-lg-6 d-lg-flex flex-lg-column align-items-stretch order-1 order-lg-2 hero-img" data-aos="fade-up">
          <img src="{{asset('index/assets/img/logo.png')}}" class="img-fluid" width="500px" alt="" >
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">


  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset('index/assets/vendor/aos/aos.js')}}"></script>
  <script src="{{asset('index/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('index/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset('index/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{asset('index/assets/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('index/assets/js/main.js')}}"></script>

</body>

</html>