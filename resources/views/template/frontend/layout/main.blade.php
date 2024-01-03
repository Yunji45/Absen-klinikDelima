<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Klinik Mitra Delima</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('mitradelima/assets/img/logo-klinik.png')}}" rel="icon">
  <link href="{{asset('mitradelima/assets/img/logo-klinik.png')}}" rel="apple-touch-icon">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('mitradelima/assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
  <link href="{{asset('mitradelima/assets/vendor/animate.css/animate.min.css')}}" rel="stylesheet">
  <link href="{{asset('mitradelima/assets/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{asset('mitradelima/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('mitradelima/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('mitradelima/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('mitradelima/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('mitradelima/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('mitradelima/assets/css/style.css')}}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Medicio
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/medicio-free-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  @include('template.frontend.layout.navbar')

  @yield('content-index')

  @include('template.frontend.layout.footer')
  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset('mitradelima/assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
  <script src="{{asset('mitradelima/assets/vendor/aos/aos.js')}}"></script>
  <script src="{{asset('mitradelima/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('mitradelima/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset('mitradelima/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{asset('mitradelima/assets/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('mitradelima/assets/js/main.js')}}"></script>
  <script>
        function updateWaktu() {
            var now = new Date();
            var jam = now.getHours();
            var menit = now.getMinutes();

            // Ganti dengan jam operasional yang sesuai
            var jamBuka = 7;
            var jamTutup = 21;

            var waktuOperasional = "Buka Setiap Hari, " + pad(jamBuka) + ":" + pad(0) + " - " + pad(jamTutup) + ":" + pad(0);
            document.getElementById("waktu").innerHTML = '<i class="bi bi-clock"></i> ' + waktuOperasional;
        }

        function pad(n) {
            return (n < 10) ? ("0" + n) : n;
        }

        // Pemanggilan fungsi updateWaktu setiap detik
        setInterval(updateWaktu, 1000);

        // Pemanggilan fungsi untuk menampilkan waktu saat halaman dimuat
        window.onload = updateWaktu;
    </script>

</body>

</html>