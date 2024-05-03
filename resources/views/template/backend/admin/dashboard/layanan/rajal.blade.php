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
        <script src="{{asset('stisla/dist/assets/js/dash-layanan/layanan-rajal-line.js')}}"></script>
        <script src="{{asset('stisla/dist/assets/js/dash-layanan/layanan-rajal-bar.js')}}"></script>
        
        <!-- <script>
            var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

            // Inisialisasi grafik
            fetchData();

            async function fetchData() {
                try {
                    const response = await fetch('http://localhost:8000/api/api-layanan-rajal');
                    const data = await response.json();
                    updateChart(data.umum_per_month, data.kb_per_month, data.imunisasi_per_month, data.sehat_per_month, data.hamil_per_month);
                } catch (error) {
                    console.error('Error fetching data:', error);
                }
            }

            function updateChart(umumData, kbData, imunisasiData, sehatData, hamilData) {
                var categories = [];
                var dataSeriesUmum = [];
                var dataSeriesKB = [];
                var dataSeriesImunisasi = [];
                var dataSeriesSehat = [];
                var dataSeriesHamil = [];

                // Loop untuk setiap bulan
                for (var i = 1; i <= 12; i++) {
                    categories.push(monthNames[i - 1]);
                    // Mendapatkan data kunjungan per bulan
                    var umum = umumData[i] ? umumData[i] : 0;
                    var kb = kbData[i] ? kbData[i] : 0;
                    var imunisasi = imunisasiData[i] ? imunisasiData[i] : 0;
                    var sehat = sehatData[i] ? sehatData[i] : 0;
                    var hamil = hamilData[i] ? hamilData[i] : 0;

                    dataSeriesUmum.push(umum);
                    dataSeriesKB.push(kb);
                    dataSeriesImunisasi.push(imunisasi);
                    dataSeriesSehat.push(sehat);
                    dataSeriesHamil.push(hamil);
                }

                var options = {
                    series: [
                        {
                            name: "Umum",
                            data: dataSeriesUmum
                        },
                        {
                            name: "KB",
                            data: dataSeriesKB
                        },
                        {
                            name: "Imunisasi",
                            data: dataSeriesImunisasi
                        },
                        {
                            name: "Keterangan Sehat",
                            data: dataSeriesSehat
                        },
                        {
                            name: "Ibu Hamil",
                            data: dataSeriesHamil
                        }
                    ],
                    chart: {
                        height: 350,
                        type: 'line',
                        zoom: {
                            enabled: false
                        },
                    },
                    title: {
                        text: 'Trend Data Layanan',
                        align: 'center'
                    },
                    xaxis: {
                        categories: categories
                    }
                    // Sisanya adalah konfigurasi grafik
                    // ...
                };

                var chart = new ApexCharts(document.querySelector("#chart"), options);
                chart.render();
            }
        </script> -->
        <!-- <script>
          var options = {
            series: [{
              name: 'Ibu Hamil',
              data: [44, 55, 41, 37, 22, 43, 21]
            }, {
              name: 'Imunisasi',
              data: [53, 32, 33, 52, 13, 43, 32]
            }, {
              name: 'KB',
              data: [12, 17, 11, 9, 15, 11, 20]
            }, {
              name: 'Poli Umum',
              data: [9, 7, 5, 8, 6, 9, 4]
            }, {
              name: 'Keterangan Sehat',
              data: [25, 12, 19, 32, 25, 24, 10]
            }],
            chart: {
              type: 'bar',
              height: 350,
              stacked: true,
            },
            plotOptions: {
              bar: {
                horizontal: true,
                dataLabels: {
                  total: {
                    enabled: true,
                    offsetX: 0,
                    style: {
                      fontSize: '13px',
                      fontWeight: 900
                    }
                  }
                }
              },
            },
            stroke: {
              width: 1,
              colors: ['#fff']
            },
            title: {
              text: 'Trend Bar Rawat Jalan'
            },
            xaxis: {
              categories: [2018, 2019, 2020, 2021,2022,2023,2024],
              labels: {
                formatter: function (val) {
                  return val + "K"
                }
              }
            },
            yaxis: {
              title: {
                text: undefined
              },
            },
            tooltip: {
              y: {
                formatter: function (val) {
                  return val + "K"
                }
              }
            },
            fill: {
              opacity: 1
            },
            legend: {
              position: 'top',
              horizontalAlign: 'left',
              offsetX: 40
            }
          };

          var chart = new ApexCharts(document.querySelector("#mychart"), options);
          chart.render();
        </script> -->
@endsection
