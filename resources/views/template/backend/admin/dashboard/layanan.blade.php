@extends('template.layout.app.main')

@section('tabel')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
<!-- <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script> -->
<style>
        #map { height: 600px; }
        .info { padding: 6px 8px; font: 14px/16px Arial, Helvetica, sans-serif; background: white; background: rgba(255, 255, 255, 0.8); box-shadow: 0 0 15px rgba(0, 0, 0, 0.2); border-radius: 5px; }
        .info h4 { margin: 0 0 5px; color: #777; }
        .legend { text-align: left; line-height: 18px; color: #555; }
        .legend i { width: 18px; height: 18px; float: left; margin-right: 8px; opacity: 0.7; }
    </style>


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
              <div class="col-lg-12 col-md-6 col-sm-6 col-12 text-center">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-primary text-center">
                    <i class="far fa-user"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>Total Pengunjung</h4>
                    </div>
                    <div class="card-body">
                      {{$sum}}
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <ul class="nav nav-tabs">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{route('dash.layanan')}}">All</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('dash.rajal')}}">Rawat Jalan</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('dash.ranap')}}">Rawat Inap</a>
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
              <div class="col-6">
                <div class="card">
                  <div class="card-body">
                    <div class="row align-items-center mb-4">
                    </div>
                    <div>
                          <label for="year">Pilih Tahun:</label>
                          <select id="year-select"></select>

                    </div>

                    <div id="baris"></div>
                    
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="card">
                  <div class="card-body">
                    <div class="row align-items-center mb-4">
                    </div>
                    <div id="baris-2"></div>
                    
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="text-center">Peta Interaktif Layanan</h4>
                  </div>

                  <div class="card-body">
                    <div class="row align-items-center mb-4">
                    </div>
                    <div id="map" style="width: 100%; height: 400px;"></div>
                    
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Kode Wilayah Table Ref <a href="https://id.wikipedia.org/">Wiki Pedia 2024</a></h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped" id="myTable">
                                    <tr>
                                        <th scope="col" class="text-center">Kode</th>
                                        <th scope="col" class="text-center">Daftar Wilayah</th>
                                    </tr>
                                    @foreach ($data as $item)
                                    <tr>
                                        <td scope="col" class="text-center">{{$item->kode}}</td>
                                        <td scope="col" class="text-center">{{$item->wilayah}}</td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                          <h4>Top 10 Kunjungan Berdasarkan Wilayah </h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped" id="myTable">
                                    <tr>
                                        <th scope="col" class="text-center">No</th>
                                        <th scope="col" class="text-center">Kode</th>
                                        <th scope="col" class="text-center">Daftar Wilayah</th>
                                        <th scope="col" class="text-center">Total Kunjungan</th>
                                    </tr>
                                    @php $no =1; @endphp 
                                    @foreach ($data as $item)
                                    <tr>
                                        <td class="text-center">{{$no++}}.</td>
                                        <td scope="col" class="text-center">{{$item->kode}}</td>
                                        <td scope="col" class="text-center">{{$item->wilayah}}</td>
                                        <td scope="col" class="text-center">{{$item->kode}}</td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
          </div>
        </section>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        <script src="{{asset('stisla/dist/assets/js/dash-layanan/layanan-index.js')}}"></script>
        <script src="{{asset('stisla/dist/assets/js/dash-layanan/search-layanan-index.js')}}"></script>
        <script src="{{asset('stisla/dist/assets/js/dash-layanan/map.js')}}"></script>
@endsection

