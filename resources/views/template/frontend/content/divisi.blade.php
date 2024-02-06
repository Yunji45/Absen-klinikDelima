@extends('template.frontend.layout.main')
@section('content-index')
<style>
#departments {
            margin-top: 100px; /* Sesuaikan dengan tinggi navbar Anda */
        }
</style>
    <section id="departments" class="departments">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
        <h2>Divisi</h2>
        <p>Di Klinik Kami, kami memiliki sejumlah divisi yang berkomitmen untuk memberikan layanan kesehatan yang terbaik. Mulai dari pelayanan medis umum hingga spesialisasi kesehatan yang lebih khusus, setiap divisi kami dipimpin oleh tim profesional yang berpengalaman. Kami bertekad untuk memenuhi kebutuhan kesehatan Anda dengan perawatan yang berkualitas dan terpercaya. Temukan solusi terbaik untuk kesehatan Anda di Klinik Kami.</p>
        </div>

        <!-- <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-4 mb-5 mb-lg-0">
            <ul class="nav nav-tabs flex-column">
              <li class="nav-item">
                <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#tab-1">
                  <h4>Cardiology</h4>
                  <p>Quis excepturi porro totam sint earum quo nulla perspiciatis eius.</p>
                </a>
              </li>
              <li class="nav-item mt-2">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-2">
                  <h4>Neurology</h4>
                  <p>Voluptas vel esse repudiandae quo excepturi.</p>
                </a>
              </li>
              <li class="nav-item mt-2">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-3">
                  <h4>Hepatology</h4>
                  <p>Velit veniam ipsa sit nihil blanditiis mollitia natus.</p>
                </a>
              </li>
              <li class="nav-item mt-2">
                <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-4">
                  <h4>Pediatrics</h4>
                  <p>Ratione hic sapiente nostrum doloremque illum nulla praesentium id</p>
                </a>
              </li>
            </ul>
          </div>
          <div class="col-lg-8">
            <div class="tab-content">
              <div class="tab-pane active show" id="tab-1">
                <h3>Cardiology</h3>
                <p class="fst-italic">Qui laudantium consequatur laborum sit qui ad sapiente dila parde sonata raqer a videna mareta paulona marka</p>
                <img src="mitradelima/assets/img/departments-1.jpg" alt="" class="img-fluid">
                <p>Et nobis maiores eius. Voluptatibus ut enim blanditiis atque harum sint. Laborum eos ipsum ipsa odit magni. Incidunt hic ut molestiae aut qui. Est repellat minima eveniet eius et quis magni nihil. Consequatur dolorem quaerat quos qui similique accusamus nostrum rem vero</p>
              </div>
              <div class="tab-pane" id="tab-2">
                <h3>Neurology</h3>
                <p class="fst-italic">Qui laudantium consequatur laborum sit qui ad sapiente dila parde sonata raqer a videna mareta paulona marka</p>
                <img src="mitradelima/assets/img/departments-2.jpg" alt="" class="img-fluid">
                <p>Et nobis maiores eius. Voluptatibus ut enim blanditiis atque harum sint. Laborum eos ipsum ipsa odit magni. Incidunt hic ut molestiae aut qui. Est repellat minima eveniet eius et quis magni nihil. Consequatur dolorem quaerat quos qui similique accusamus nostrum rem vero</p>
              </div>
              <div class="tab-pane" id="tab-3">
                <h3>Hepatology</h3>
                <p class="fst-italic">Qui laudantium consequatur laborum sit qui ad sapiente dila parde sonata raqer a videna mareta paulona marka</p>
                <img src="mitradelima/assets/img/departments-3.jpg" alt="" class="img-fluid">
                <p>Et nobis maiores eius. Voluptatibus ut enim blanditiis atque harum sint. Laborum eos ipsum ipsa odit magni. Incidunt hic ut molestiae aut qui. Est repellat minima eveniet eius et quis magni nihil. Consequatur dolorem quaerat quos qui similique accusamus nostrum rem vero</p>
              </div>
              <div class="tab-pane" id="tab-4">
                <h3>Pediatrics</h3>
                <p class="fst-italic">Qui laudantium consequatur laborum sit qui ad sapiente dila parde sonata raqer a videna mareta paulona marka</p>
                <img src="mitradelima/assets/img/departments-4.jpg" alt="" class="img-fluid">
                <p>Et nobis maiores eius. Voluptatibus ut enim blanditiis atque harum sint. Laborum eos ipsum ipsa odit magni. Incidunt hic ut molestiae aut qui. Est repellat minima eveniet eius et quis magni nihil. Consequatur dolorem quaerat quos qui similique accusamus nostrum rem vero</p>
              </div>
            </div>
          </div>
        </div> -->
        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-4 mb-5 mb-lg-0">
            <ul class="nav nav-tabs flex-column">
              @foreach($divisi as $index => $item)
              <li class="nav-item">
                <a class="nav-link{{ $index === 0 ? ' active show' : '' }}" data-bs-toggle="tab" data-bs-target="#tab-{{ $index + 1 }}">
                  <h4>{{ $item->nama_divisi }}</h4>
                  <p>{{ $item->deskripsi_singkat }}</p>
                </a>
              </li>
              @endforeach
            </ul>
          </div>
          <div class="col-lg-8">
            <div class="tab-content">
              @foreach($divisi as $index => $item)
              <div class="tab-pane{{ $index === 0 ? ' active show' : '' }}" id="tab-{{ $index + 1 }}">
                <h3>{{ $item->nama_divisi }}</h3>
                <p class="fst-italic">{{ $item->deskripsi_singkat }}</p>
                <img src="{{ asset(Storage::url('content-divisi/'.$item->foto_divisi)) }}" alt="" class="img-fluid">
                <p>{{ $item->deskripsi_divisi }}</p>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection