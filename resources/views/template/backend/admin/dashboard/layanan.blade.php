@extends('template.layout.app.main')

@section('tabel')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
     <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

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
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <div class="row align-items-center mb-4">
                    </div>
                    <div id="daftarWilayah"></div>
                    
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
              <div class="col-6">
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
                    <div id="baris"></div>
                    
                  </div>
                </div>
              </div>
              <div class="col-6">
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
                    <div id="baris-2"></div>
                    
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
                          <select id="year" onchange="updateChart(this.value)">
                              <option value="2022">2022</option>
                              <option value="2023">2023</option>
                              <option value="2024">2024</option>
                              <!-- Tambahkan opsi tahun sesuai kebutuhan -->
                          </select>
                      </div>
                    <div id="gender"></div>
                    
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
          </div>
        </section>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script src="{{asset('stisla/dist/assets/js/dash-layanan/layanan-index.js')}}"></script>
        <!-- <script>
          var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

          // Inisialisasi grafik
          fetchData();

          async function fetchData() {
              try {
                  const response = await fetch('http://localhost:8000/api/api-layanan');
                  const data = await response.json();
                  updateChart(data.rajal_per_month, data.ranap_per_month, data.khitan_per_month, data.persalinan_per_month);
              } catch (error) {
                  console.error('Error fetching data:', error);
              }
          }

          function updateChart(rajalData, ranapData, khitanData, persalinanData) {
              var categories = [];
              var dataSeriesRajal = [];
              var dataSeriesRanap = [];
              var dataSeriesKhitan = [];
              var dataSeriesPersalinan = [];
              // Loop untuk setiap bulan
              for (var i = 1; i <= 12; i++) {
                  categories.push(monthNames[i - 1]);
                  // Mendapatkan data kunjungan per bulan
                  var rajal = rajalData[i] ? rajalData[i] : 0;
                  var ranap = ranapData[i] ? ranapData[i] : 0;
                  var khitan = khitanData[i] ? khitanData[i] : 0;
                  var persalinan = persalinanData[i] ? persalinanData[i] : 0;

                  dataSeriesRajal.push(rajal);
                  dataSeriesRanap.push(ranap);
                  dataSeriesKhitan.push(khitan);
                  dataSeriesPersalinan.push(persalinan);
              }

              var options = {
                  series: [
                      {
                          name: "Rajal",
                          data: dataSeriesRajal
                      },
                      {
                          name: "Ranap",
                          data: dataSeriesRanap
                      },
                      {
                          name: "Khitan",
                          data: dataSeriesKhitan
                      },
                      {
                          name: "Persalinan",
                          data: dataSeriesPersalinan
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
      <script>

        const map = L.map('map').setView([-7.314931134411498, 108.43086308707107], 8);

        const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
          maxZoom: 19,
          attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        L.control({position: 'topleft'}).onAdd = function (map) {
            var div = L.DomUtil.create('div', 'info');
            div.innerHTML = '<h4>Trend Data Pengunjung</h4>';
            return div;
        }.addTo(map);


      </script>

        <!-- <script>
          var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
          var currentYear = new Date().getFullYear(); // Tahun saat ini

          // Inisialisasi grafik dengan tahun saat ini
          updateChart(currentYear);

          function updateChart(selectedYear) {
              var categories = [];
              var dataSeries = [];

              // Looping untuk mendapatkan data bulan per tahun yang dipilih
              for (var i = 0; i < 12; i++) {
                  var daysInMonth = new Date(selectedYear, i + 1, 0).getDate(); // Jumlah hari dalam bulan
                  var monthData = [];
                  for (var j = 1; j <= daysInMonth; j++) {
                      categories.push(j + " " + monthNames[i]);
                      // Mendapatkan data dari controller berdasarkan bulan dan tahun
                      // Contoh: var data = getDataFromController(selectedYear, i + 1, j);
                      var data = Math.floor(Math.random() * 100); // Dummy data
                      monthData.push(data);
                  }
                  dataSeries.push({
                      name: monthNames[i],
                      data: monthData
                  });
              }

              var options = {
                  series: dataSeries,
                  chart: {
                      height: 350,
                      type: 'line',
                      zoom: {
                          enabled: false
                      },
                  },
                  dataLabels: {
                      enabled: false
                  },
                  stroke: {
                      width: [5, 7, 5],
                      curve: 'straight',
                      dashArray: [0, 8, 5]
                  },
                  title: {
                      text: 'Trend Data Linear Pengunjung',
                      align: 'left'
                  },
                  legend: {
                      tooltipHoverFormatter: function (val, opts) {
                          return val + ' - <strong>' + opts.w.globals.series[opts.seriesIndex][opts.dataPointIndex] + '</strong>'
                      }
                  },
                  markers: {
                      size: 0,
                      hover: {
                          sizeOffset: 6
                      }
                  },
                  xaxis: {
                      categories: categories,
                  },
                  tooltip: {
                      y: [
                          {
                              title: {
                                  formatter: function (val) {
                                      return val + " (mins)"
                                  }
                              }
                          },
                          {
                              title: {
                                  formatter: function (val) {
                                      return val + " per session"
                                  }
                              }
                          },
                          {
                              title: {
                                  formatter: function (val) {
                                      return val;
                                  }
                              }
                          }
                      ]
                  },
                  grid: {
                      borderColor: '#f1f1f1',
                  }
              };

              var chart = new ApexCharts(document.querySelector("#chart"), options);
              chart.render();
          }
        </script> -->
@endsection

