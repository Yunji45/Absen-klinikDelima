@extends('template.layout.app.main')

@section('tabel')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<section class="section">
          <div class="section-header">
            <h1>Test API Chart JavaScript</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item">{{$title}}</div>
            </div>
          </div>

          <div class="section-body">
            <h2 class="section-title">{{$title}}</h2>
            <p class="section-lead">
              We use 'Chart.JS' made by @chartjs. You can check the full documentation <a href="http://www.chartjs.org/">here</a>.
            </p>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Geolocation Map Indonesian</h4>
                  </div>
                  <div class="card-body">
                    <div class="alert alert-primary">
                      Klik Map Yang Ingin Di Lihat.
                    </div>
                    <div class="row align-items-center mb-4">
                      <div class="col-6 text-right">
                        <div class="font-weight-bold">Peta Indonesia </div>
                      </div>
                      <div class="col-6">
                        <span class="flag-icon flag-icon-id flag-icon-shadow" id="flag-icon"></span>
                      </div>
                    </div>
                    <div id="visitorMap3"></div>
                    <!-- <div id="map" style="height: 400px;"></div> -->
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4>Line Chart</h4>
                  </div>
                  <div class="card-body">
                    <canvas id="myChart"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4>Bar Chart</h4>
                  </div>
                  <div class="card-body">
                    <canvas id="myChart2"></canvas>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4>Doughnut Chart</h4>
                  </div>
                  <div class="card-body">
                    <canvas id="myChart3"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4>Pie Chart</h4>
                  </div>
                  <div class="card-body">
                    <canvas id="myChart4"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    var map = L.map('map').setView([-7.6145, 110.7125], 8); // Koordinat tengah Jawa Tengah

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Tambahkan marker untuk Jawa Tengah
    L.marker([-7.6145, 110.7125]).addTo(map)
        .bindPopup('Jawa Tengah')
        .openPopup();

    // Tambahkan marker untuk Jawa Barat
    L.marker([-6.9039, 107.6186]).addTo(map)
        .bindPopup('Jawa Barat')
        .openPopup();
</script>
@endpush