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
                      <h4>Pasien Umum</h4>
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
                      <h4>Persalinan</h4>
                    </div>
                    <div class="card-body">
                      {{$persalinan}}
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
                <a class="nav-link" href="{{route('dash.rajal')}}">Rawat Jalan</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="{{route('dash.ranap')}}">Rawat Inap</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('dash.khitan')}}">Khitanan</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('dash.lab')}}">Laboratorium</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('dash.usg')}}">USG</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('dash.estetika')}}">Estetika</a>
              </li>
            </ul>
            <div class="row">
              <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                  <div class="card-body">
                    <div>
                          <label for="year">Pilih Tahun:</label>
                          <select id="year">
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
                    <div class="statistic-details mt-sm-4">
                      <div class="statistic-details-item">
                        <span class="text-muted">
                            <span class="{{ $perbandinganHariIni >= 0 ? 'text-primary' : 'text-danger' }}">
                                <i class="fas fa-caret-{{ $perbandinganHariIni >= 0 ? 'up' : 'down' }}"></i>
                            </span> 
                            {{ number_format(abs($perbandinganHariIni), 0) }}%
                        </span>
                        <div class="detail-value">{{$kunjunganHariIni}}</div>
                        <div class="detail-name">Kunjungan Hari Ini</div>
                        <div class="detail-value">{{$kunjunganKemarin}}</div>
                        <div class="detail-name">Kunjungan Hari Kemarin</div>
                      </div>
                      <div class="statistic-details-item">
                          <span class="text-muted">
                              <span class="{{ $perbandinganMingguIni >= 0 ? 'text-primary' : 'text-danger' }}">
                                  <i class="fas fa-caret-{{ $perbandinganMingguIni >= 0 ? 'up' : 'down' }}"></i>
                              </span> 
                              {{ number_format(abs($perbandinganMingguIni), 0) }}%
                          </span>
                          <div class="detail-value">{{ $kunjunganMingguIni }}</div>
                          <div class="detail-name">Kunjungan Minggu Ini</div>
                          <div class="detail-value">{{ $kunjunganMingguLalu }}</div>
                          <div class="detail-name">Kunjungan Minggu Lalu</div>
                      </div>

                      <div class="statistic-details-item">
                          <span class="text-muted">
                              <span class="{{ $perbandinganBulanIni >= 0 ? 'text-primary' : 'text-danger' }}">
                                  <i class="fas fa-caret-{{ $perbandinganBulanIni >= 0 ? 'up' : 'down' }}"></i>
                              </span> 
                              {{ number_format(abs($perbandinganBulanIni), 0) }}%
                          </span>
                          <div class="detail-value">{{ $kunjunganBulanIni }}</div>
                          <div class="detail-name">Kunjungan Bulan Ini</div>
                          <div class="detail-value">{{ $kunjunganBulanLalu }}</div>
                          <div class="detail-name">Kunjungan Bulan Lalu</div>
                      </div>

                      <div class="statistic-details-item">
                          <span class="text-muted">
                              <span class="{{ $perbandinganTahunIni >= 0 ? 'text-primary' : 'text-danger' }}">
                                  <i class="fas fa-caret-{{ $perbandinganTahunIni >= 0 ? 'up' : 'down' }}"></i>
                              </span> 
                              {{ number_format(abs($perbandinganTahunIni), 0) }}%
                          </span>
                          <div class="detail-value">{{ $kunjunganTahunIni }}</div>
                          <div class="detail-name">Kunjungan Tahun Ini</div>
                          <div class="detail-value">{{ $kunjunganTahunLalu }}</div>
                          <div class="detail-name">Kunjungan Tahun Lalu</div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <div class="row align-items-center mb-4">
                    </div>
                    <div id="baris"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script src="{{asset('stisla/dist/assets/js/dash-layanan/layanan-ranap.js')}}"></script>
        <script src="{{asset('stisla/dist/assets/js/dash-layanan/search-layanan-ranap.js')}}"></script>
        <!-- <script src="{{asset('stisla/dist/assets/js/dash-layanan/layanan-ranap-line.js')}}"></script>
        <script src="{{asset('stisla/dist/assets/js/dash-layanan/layanan-ranap-bar.js')}}"></script> -->
@endsection