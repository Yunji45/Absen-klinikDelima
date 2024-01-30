@extends('template.frontend.layout.main')
@section('content-index')
    <style>
        #about {
            margin-top: 100px; /* Sesuaikan dengan tinggi navbar Anda */
        }
    </style>

    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Tentang Kami</h2>
          <p>{{$tentang->content_1}}</p>
          <!-- <p>Menapaki jejak sejak Desember 2012, Klinik Mitra Delima membangun fondasi di Dsn. Kotaharja 14/03, Ds. Sukamukti, Kec. Pamarican. Terbentuk dari praktek bidan mandiri dan balai pengobatan, dipimpin oleh Ibu Bidan Hj.Iis dan Bapak H.Agus, klinik ini mengutamakan pelayanan pada ibu hamil, kesehatan ibu dan anak, persalinan, dan khitanan. Dengan semangat untuk menciptakan lingkungan kesehatan yang nyaman dan peduli, Klinik Mitra Delima mewujudkan visinya sebagai pusat kesehatan terdepan.</p> -->
        </div>

        <div class="row">
          <div class="col-lg-6" data-aos="fade-right">
            <!-- <img src="mitradelima/assets/img/about.jpg" class="img-fluid" alt=""> -->
            <img src="{{ asset(Storage::url('content-tentang/'.$tentang->foto_1)) }}" class="img-fluid" alt="foto.jpg">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 content" data-aos="fade-left">
            <h3>{{$tentang->sub_judul_2}}</h3>
            <!-- <h3>Pengalaman Unik di Klinik Mitra Delima.</h3> -->
            <!-- <p class="fst-italic">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
              magna aliqua.
            </p>
            <ul>
              <li><i class="bi bi-check-circle"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
              <li><i class="bi bi-check-circle"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
              <li><i class="bi bi-check-circle"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</li>
            </ul> -->
            <!-- <p>
            Di Dsn. Kotaharja 14/03, Klinik Mitra Delima bukan sekadar tempat pelayanan medis. Ini adalah tempat di mana kesehatan didefinisikan ulang. Didukung oleh Ibu Bidan Hajah Iis dan Bapak Haji Agus, setiap kunjungan ke klinik ini tidak hanya memberikan perawatan medis yang komprehensif, tetapi juga menciptakan momen di mana pengunjung merasa dihargai dan didengar. Bergabunglah dengan kami dan rasakan pengalaman kesehatan yang penuh kehangatan dan perhatian.
            </p> -->
            <p>{{$tentang->content_2}}</p>
          </div>
        </div>

      </div>
    </section>
@endsection