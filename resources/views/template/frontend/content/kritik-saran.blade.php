@extends('template.frontend.layout.main')
@section('content-index')
<style>
#appointment {
            margin-top: 100px; /* Sesuaikan dengan tinggi navbar Anda */
        }
</style>
    <section id="appointment" class="appointment section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Kritik & Saran</h2>
          <p>Kami menghargai setiap kritik, saran, dan masukan yang Anda berikan. Untuk membantu kami terus meningkatkan layanan, silakan berikan pendapat Anda. Kami berkomitmen untuk mendengarkan dan merespons setiap umpan balik yang diberikan oleh Anda, pelanggan kami yang berharga.</p>
        </div>

        <form action="{{route('kritik.save')}}" method="post" role="form" class="php-email-form" data-aos="fade-up" data-aos-delay="100">
          @csrf
          <div class="row">
            <div class="col-md-4 form-group">
              <input type="text" name="nama" class="form-control" id="nama" placeholder="Your Name" required>
            </div>
            <div class="col-md-4 form-group mt-3 mt-md-0">
              <input type="number" class="form-control" name="no_tlp" id="no_tlp" placeholder="Your Phone" required>
            </div>
            <div class="col-md-4 form-group mt-3 mt-md-0">
                <select name="kategori" id="kategori" class="form-select">
                    <option value="" selected disabled>Pilih kategori</option>
                    <option value="Pelayanan Pasien">Pelayanan Pasien</option>
                    <option value="Infrastruktur dan Kebersihan">Infrastruktur dan Kebersihan</option>
                    <option value="Prosedur dan Waktu Tunggu">Prosedur dan Waktu Tunggu</option>
                    <option value="Komunikasi dan Edukasi">Komunikasi dan Edukasi</option>
                    <option value="Kualitas Layanan Medis">Kualitas Layanan Medis</option>
                    <option value="Etika Profesional">Etika Profesional</option>
                    <option value="Sistem Administrasi">Sistem Administrasi</option>
                    <option value="Pembaruan dan Inovasi">Pembaruan dan Inovasi</option>
                    <option value="Harga dan Biaya">Harga dan Biaya</option>
                </select>
            </div>
          </div>
          <!-- <div class="row">
            <div class="col-md-4 form-group mt-3">
              <input type="datetime" name="date" class="form-control datepicker" id="date" placeholder="Appointment Date" required>
            </div>
            <div class="col-md-4 form-group mt-3">
              <select name="department" id="department" class="form-select">
                <option value="">Select Department</option>
                <option value="Department 1">Department 1</option>
                <option value="Department 2">Department 2</option>
                <option value="Department 3">Department 3</option>
              </select>
            </div>
            <div class="col-md-4 form-group mt-3">
              <select name="doctor" id="doctor" class="form-select">
                <option value="">Select Doctor</option>
                <option value="Doctor 1">Doctor 1</option>
                <option value="Doctor 2">Doctor 2</option>
                <option value="Doctor 3">Doctor 3</option>
              </select>
            </div>
          </div> -->

          <div class="form-group mt-3">
            <textarea class="form-control" name="deskripsi" id="deskripsi" rows="5" placeholder="Message (Optional)"></textarea>
          </div>
          <!-- <div class="my-3">
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Your appointment request has been sent successfully. Thank you!</div>
          </div> -->
          <div class="text-center"><button type="submit">Kirim Kritik & Saran</button></div>
        </form>

      </div>
    </section>
@endsection