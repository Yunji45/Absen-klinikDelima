@extends('template.frontend.layout.main')
@section('content-index')
<style>
#faq {
            margin-top: 100px; /* Sesuaikan dengan tinggi navbar Anda */
        }
</style>
    <section id="faq" class="faq section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Frequently Asked Questioins (FAQ)</h2>
          <p>Selamat datang di halaman Pertanyaan yang Sering Diajukan (FAQ) Klinik Mitra Delima. Kami senang dapat memberikan informasi yang mungkin Anda perlukan untuk memahami lebih lanjut tentang layanan dan prosedur di Klinik Mitra Delima. Silakan jelajahi pertanyaan-pertanyaan umum di bawah ini.</p>
        </div>

        <ul class="faq-list">
        @foreach($faqs as $index => $faq)
            <li>
                <div data-bs-toggle="collapse" href="#faq{{ $index + 1 }}" class="collapsed question">
                    {{ $faq->pertanyaan }}
                    <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i>
                </div>
                <div id="faq{{ $index + 1 }}" class="collapse" data-bs-parent=".faq-list">
                    <p>{{ $faq->jawaban }}</p>
                </div>
            </li>
        @endforeach
          <!-- <li>
            <div data-bs-toggle="collapse" class="collapsed question" href="#faq1">Apa itu Klinik Mitra Delima dan bagaimana cara menghubunginya ? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq1" class="collapse" data-bs-parent=".faq-list">
                <p>
                    Klinik Mitra Delima adalah sebuah pusat kesehatan yang menyediakan layanan kesehatan ibu, anak, persalinan, dan khitanan. Anda dapat menghubungi kami melalui informasi kontak yang tersedia di situs web atau datang langsung ke klinik.
                </p>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq2" class="collapsed question">Apa jenis layanan medis yang tersedia di Klinik Mitra Delima ?<i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq2" class="collapse" data-bs-parent=".faq-list">
            <p>Klinik Mitra Delima menawarkan layanan kesehatan ibu hamil, kesehatan ibu dan anak, persalinan, dan khitanan. Kami juga menyediakan pemeriksaan medis umum dan konsultasi dokter.</p>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq3" class="collapsed question">Bagaimana cara membuat janji temu dengan dokter di Klinik Mitra Delima ? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq3" class="collapse" data-bs-parent=".faq-list">
            <p>Anda dapat membuat janji temu dengan dokter di Klinik Mitra Delima dengan menghubungi nomor telepon yang tertera di situs website kami atau datang langsung ke klinik untuk membuat janji.</p>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq4" class="collapsed question"> Bagaimana cara melakukan pendaftaran sebagai pasien di Klinik Mitra Delima ? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq4" class="collapse" data-bs-parent=".faq-list">
            <p>Untuk mendaftar sebagai pasien di Klinik Mitra Delima, Anda dapat datang langsung ke klinik dan mengisi formulir pendaftaran yang disediakan. Pastikan untuk membawa dokumen identitas.</p>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq5" class="collapsed question">Apakah Klinik Mitra Delima menerima asuransi kesehatan ? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq5" class="collapse" data-bs-parent=".faq-list">
            <p>Ya, Klinik Mitra Delima menerima beberapa jenis asuransi kesehatan. Anda dapat menghubungi pihak klinik untuk informasi lebih lanjut tentang jenis asuransi yang diterima.</p>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq6" class="collapsed question"> Bagaimana saya dapat memberikan umpan balik atau saran untuk Klinik Mitra Delima ? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq6" class="collapse" data-bs-parent=".faq-list">
            <p>Anda dapat memberikan umpan balik atau saran untuk Klinik Mitra Delima dengan mengisi formulir yang disediakan di menu kritik & saran yang tertera di situs website kami.</p>
            </div>
          </li> -->

        </ul>

      </div>
    </section>
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <h2>Kontak</h2>
          <p>Terima kasih atas minat dan kepercayaan Anda pada Klinik Mitra Delima. Kami siap membantu dan melayani Anda. Untuk pertanyaan lebih lanjut atau untuk membuat janji temu, silakan hubungi kami melalui informasi kontak di bawah ini:</p>
        </div>

      </div>

      <div>
      <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d253221.23250420968!2d108.30156376612786!3d-7.400670471205!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6588aeffffffff%3A0x188e86562df36fce!2sKlinik%20Mitra%20Delima!5e0!3m2!1sid!2sid!4v1705824591731!5m2!1sid!2sid" frameborder="0" allowfullscreen="" ></iframe>
        <!-- <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" allowfullscreen></iframe> -->
      </div>

      <div class="container">

        <div class="row mt-5">

          <div class="col-lg-6">

            <div class="row">
              <div class="col-md-12">
                <div class="info-box">
                  <i class="bx bx-map"></i>
                  <h3>Alamat Kami</h3>
                  <p>Dsn.Kotaharja Sukamukti Pamarican, Ciamis, INA 46382</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box mt-4">
                  <i class="bx bx-envelope"></i>
                  <h3>Kirim Email</h3>
                  <p>klinikmitradelima@gmail.com</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box mt-4">
                  <i class="bx bx-phone-call"></i>
                  <h3>Hubungi Kami</h3>
                  <p>+62 822 4008 5447</p>
                </div>
              </div>
            </div>

          </div>

          <div class="col-lg-6">
            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required="">
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required="">
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required="">
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="7" placeholder="Message" required=""></textarea>
              </div>
              <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div>

        </div>

      </div>
    </section>
@endsection