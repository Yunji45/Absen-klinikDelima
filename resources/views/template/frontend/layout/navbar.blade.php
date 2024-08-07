<!-- ======= Top Bar ======= -->
<div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex align-items-center justify-content-center justify-content-md-between">
      <div class="align-items-center d-none d-md-flex">
        <i class="bi bi-clock"></i> Setiap Hari , 07:00 s/d 21:00 WIB
        <!-- <i id="waktu"></i> -->
      </div>
      <div class="d-flex align-items-center">
        <i class="bi bi-phone"></i> Call Center +62 822 4008 5447
      </div>
    </div>
  </div>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">
      <a href="{{ route('frontend') }}" class="logo me-auto d-none d-sm-block">
          <img src="{{ asset('mitradelima/assets/img/logo-klasik.png') }}" alt="" class="img-fluid">
      </a>
      <!-- <a href="{{ route('frontend') }}" class="logo me-auto">
          <img src="{{ asset('mitradelima/assets/img/logo-klasik.png') }}" alt="" class="img-fluid">
      </a> -->
      <!-- <a href="{{route('frontend')}}" class="logo me-auto"><img src="{{asset('mitradelima/assets/img/logo-klinik.png')}}" alt=""></a> -->
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <h1 class="logo me-auto"><a href="index.html">Medicio</a></h1> -->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto" href="{{route('frontend')}}">Beranda</a></li>
          <li><a class="nav-link scrollto" href="{{route('frontend.tentang')}}">Tentang</a></li>
          <li><a class="nav-link scrollto" href="{{route('frontend.layanan')}}">Layanan</a></li>
          <li><a class="nav-link scrollto" href="{{route('frontend.divisi')}}">Divisi</a></li>
          <li><a class="nav-link scrollto" href="{{route('frontend.dokter')}}">Dokter</a></li>
          <li><a class="nav-link scrollto" href="{{route('karir')}}">Loker</a></li>
          <!-- <li><a class="nav-link scrollto" href="#contact">Kontak</a></li> -->
          <li class="dropdown"><a href="#"><span>Lain - Lain</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="{{route('frontend.kontak')}}">FAQ & KONTAK</a></li>
              <li><a href="{{route('frontend.kritik-saran')}}">KRITIK & SARAN</a></li>
            </ul>
          </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
      @if(Auth::check())
          <a href="{{ route('daftar-hadir') }}" class="appointment-btn scrollto" style="margin-right: 20px;">
              <span class="d-none d-md-inline">{{ Auth::user()->name }}</span><span class="d-inline d-md-none">{{ Auth::user()->name }}</span>
          </a>
      @else
          <a href="{{ route('auth.index') }}" class="appointment-btn scrollto" style="margin-right: 20px;">
              <span class="d-none d-md-inline">Log In</span><span class="d-inline d-md-none">Log In</span>
          </a>
      @endif

      <!-- <a href="{{route('auth.index')}}" class="appointment-btn scrollto" style="margin-right: 20px;"><span class="d-none d-md-inline">Log</span> In</a> -->
      <img src="{{ asset('mitradelima/assets/img/paripurna.png') }}" alt="" class="img-fluid" style="width: 150px; height: auto;">


      <!-- <a href="#appointment" class="appointment-btn scrollto"><span class="d-none d-md-inline">Sign</span> In</a> -->

    </div>
  </header><!-- End Header -->