@extends('template.layout.app.main')

@section('tabel')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<section class="section">
          <div class="section-header">
            <h1>{{$title}}</h1>
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
              <div class="col-lg-4 col-md-6 col-sm-6 col-12 text-center">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-primary text-center">
                    <i class="far fa-user"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>Poli Umum</h4>
                    </div>
                    <div class="card-body">
                      {{$umum}}
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12 text-center">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-primary text-center">
                    <i class="far fa-user"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>KB</h4>
                    </div>
                    <div class="card-body">
                      {{$KB}}
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12 text-center">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-primary text-center">
                    <i class="far fa-user"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>Imunisasi</h4>
                    </div>
                    <div class="card-body">
                      {{$imunisasi}}
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12 text-center">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-primary text-center">
                    <i class="far fa-user"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>Ibu Hamil</h4>
                    </div>
                    <div class="card-body">
                      {{$hamil}}
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12 text-center">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-primary text-center">
                    <i class="far fa-user"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>Keterangan Sehat</h4>
                    </div>
                    <div class="card-body">
                      {{$sehat}}
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12 text-center">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-primary text-center">
                    <i class="far fa-user"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>Total Kunjungan</h4>
                    </div>
                    <div class="card-body">
                      {{$total}}
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <ul class="nav nav-tabs">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{route('dash.layanan')}}">All</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="{{route('dash.rajal')}}">Rawat Jalan</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('dash.ranap')}}">Rawat Inap</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Khitanan</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Laboratorium</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">USG</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Estetika</a>
              </li>
            </ul>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <div class="row align-items-center mb-4">
                    </div>
                      <div>
                          <label for="year">Pilih Tahun:</label>
                          <select id="year" onchange="updateChart(this.value)">
                              <option value="2022">2022</option>
                              <option value="2023">2023</option>
                              <option value="2024">2024</option>
                              <!-- Tambahkan opsi tahun sesuai kebutuhan -->
                          </select>
                      </div>
                    <div id="chart"></div>
                    
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                  <div class="card-body">
                    <div id="mychart"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <!-- <script src="{{asset('stisla/dist/assets/js/dash-layanan/test.js')}}"></script> -->
        <script src="{{asset('stisla/dist/assets/js/dash-layanan/layanan-rajal-line.js')}}"></script>
        <script src="{{asset('stisla/dist/assets/js/dash-layanan/layanan-rajal-bar.js')}}"></script>
        
@endsection
