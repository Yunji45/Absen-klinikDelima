<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ $title }}</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{asset('stisla/dist/assets/modules/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('stisla/dist/assets/modules/fontawesome/css/all.min.css')}}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{asset('stisla/dist/assets/modules/jqvmap/dist/jqvmap.min.css')}}">
    <link rel="stylesheet" href="{{asset('stisla/dist/assets/modules/weather-icon/css/weather-icons.min.css')}}">
    <link rel="stylesheet" href="{{asset('stisla/dist/assets/modules/weather-icon/css/weather-icons-wind.min.css')}}">
    <link rel="stylesheet" href="{{asset('stisla/dist/assets/modules/summernote/summernote-bs4.css')}}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('stisla/dist/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('stisla/dist/assets/css/components.css')}}">

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-94034622-3');
    </script>
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <!-- Navbar -->
            @include('template.layout.app.navbar')

                @if (session('success'))
                <div class="alert alert-success alert-dismissible show fade" role="alert">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                        {{ session('success') }}
                    </div>
                </div>
                @endif @if (session('error'))
                <div class="alert alert-danger alert-dismissible show fade" role="alert">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                        {{ session('error') }}
                    </div>
                </div>
                @endif            
                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
                @endif

            <!-- Sidebar -->
            @include('template.layout.app.side')

            <!-- Main Content -->
            <div class="main-content">
                @yield('dashboard')
                @yield('tabel')
            </div>
            @include('template.layout.app.footer')
        </div>
    </div>
      <!-- General JS Scripts -->
    <script src="{{asset('stisla/dist/assets/modules/jquery.min.js')}}"></script>
    <script src="{{asset('stisla/dist/assets/modules/popper.js')}}"></script>
    <script src="{{asset('stisla/dist/assets/modules/tooltip.js')}}"></script>
    <script src="{{asset('stisla/dist/assets/modules/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('stisla/dist/assets/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
    <script src="{{asset('stisla/dist/assets/modules/moment.min.js')}}"></script>
    <script src="{{asset('stisla/dist/assets/js/stisla.js')}}"></script>
  
  <!-- JS Libraies -->
  <script src="{{asset('stisla/dist/assets/modules/simple-weather/jquery.simpleWeather.min.js')}}"></script>
  <script src="{{asset('stisla/dist/assets/modules/chart.min.js')}}"></script>
  <script src="{{asset('stisla/dist/assets/modules/jqvmap/dist/jquery.vmap.min.js')}}"></script>
  <script src="{{asset('stisla/dist/assets/modules/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
  <script src="{{asset('stisla/dist/assets/modules/summernote/summernote-bs4.js')}}"></script>
  <script src="{{asset('stisla/dist/assets/modules/chocolat/dist/js/jquery.chocolat.min.js')}}"></script>

  <!-- Page Specific JS File -->
  <script src="{{asset('stisla/dist/assets/js/page/index-0.js')}}"></script>
  <!-- Template JS File -->
  <script src="{{asset('stisla/dist/assets/js/scripts.js')}}"></script>
  <script src="{{asset('stisla/dist/assets/js/custom.js')}}"></script>
  <script src="{{asset('stisla/dist/assets/js/bundle.js')}}"></script>

</body>

</html>