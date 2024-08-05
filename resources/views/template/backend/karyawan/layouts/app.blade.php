<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>{{$title}} - Klinik Mitra Delima</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Favicons -->
  <link href="{{('mitradelima/assets/img/logo-klinik.png')}}" rel="icon">
  <link href="{{asset('nice-admin/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('nice-admin/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('nice-admin/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('nice-admin/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('nice-admin/assets/vendor/quill/quill.snow.css')}}" rel="stylesheet">
  <link href="{{asset('nice-admin/assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
  <link href="{{asset('nice-admin/assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('nice-admin/assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-vw0a3HKGO9fXg8KFFW5R5QrV5wueWEJ/VE7R8LAWPYsHDVmzizFEnJrLhfWz+Y1V" crossorigin="anonymous">

  <!-- Template Main CSS File -->
  <link href="{{asset('nice-admin/assets/css/style.css')}}" rel="stylesheet">
  <link href="{{asset('nice-admin/assets/css/bot.css')}}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Jan 29 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
  @include('template.backend.karyawan.layouts.navbar')
  @include('sweetalert::alert')
  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">
    @include('template.backend.karyawan.layouts.side')

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    @yield('content')

  </main><!-- End #main -->
  <button class="chat-toggle" id="toggle-chat">
    <img src="https://img.icons8.com/ios-filled/50/FFFFFF/phone.png" width="20" height="20">
    <strong>Live Chat</strong>
</button>

<div class="chat-widget" id="chat-widget">
    <div class="chat-header">
        <h4>👋 MitraHealth !</h4>
        <button id="close-chat">✖</button>
    </div>
    <div class="chat-body" id="chat-body">
        <div class="message bot">Halo! Ada yang bisa saya bantu?</div>
    </div>
    <div class="chat-shortcuts">
        <button class="shortcut" data-message="IP internet error">IP Internet </button>
        <button class="shortcut" data-message="Face ID">Face ID</button>
        <button class="shortcut" data-message="Bye">Bye !!</button>
        <button class="shortcut" data-message="Hallo">Hallo !!</button>
        <button class="shortcut" data-message="Siapa kamu">Siapa Kamu?</button>
        <button class="shortcut" data-message="Terima kasih">Thanks.</button>
    </div>

    <div class="chat-footer">
        <input type="text" id="user-input" placeholder="Tulis pesan...">
        <button id="send-message">Kirim</button>
    </div>
</div>

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
  @include('template.backend.karyawan.layouts.footer')
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset('nice-admin/assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{asset('nice-admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('nice-admin/assets/vendor/chart.js/chart.umd.js')}}"></script>
  <script src="{{asset('nice-admin/assets/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{asset('nice-admin/assets/vendor/quill/quill.min.js')}}"></script>
  <script src="{{asset('nice-admin/assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{asset('nice-admin/assets/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{asset('nice-admin/assets/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('nice-admin/assets/js/main.js')}}"></script>
  <script src="{{asset('nice-admin/assets/js/bot.js')}}"></script>
  <!-- Live Chat -->
  <!-- <script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>
  <div class="elfsight-app-6b9aa81d-0c88-405e-8d4d-6aa922097524" data-elfsight-app-lazy></div> -->
</body>

</html>