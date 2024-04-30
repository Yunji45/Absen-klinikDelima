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
                      0
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
                      0
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
                      0
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
                      0
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
                      0
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
                      0
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
        <script>
          var monthNames = ["Ibu Hamil", "Imunisasi", "Keterangan Sehat", "Poli Umum", "KB"];
          var currentYear = new Date().getFullYear(); // Tahun saat ini

          // Inisialisasi grafik dengan tahun saat ini
          updateChart(currentYear);

          function updateChart(selectedYear) {
              // Fungsi ini akan diperbarui untuk mengambil data dari API atau sumber data lainnya sesuai dengan kebutuhan Anda
              // Data dummy ditampilkan di sini untuk tujuan demonstrasi
              var categories = [];
              var dataSeries = [];

              // Looping untuk mendapatkan data bulan per tahun yang dipilih
              for (var i = 0; i < 5; i++) {
                  var monthData = [];
                  for (var j = 0; j < 12; j++) {
                      var data = Math.floor(Math.random() * 100); // Dummy data
                      monthData.push(data);
                  }
                  dataSeries.push({
                      name: monthNames[i],
                      data: monthData
                  });
              }

              // Membuat label untuk setiap bulan
              for (var j = 0; j < 12; j++) {
                  categories.push(monthNames[j]);
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
                      width: [5, 7, 5, 3, 4],
                      curve: 'straight',
                      dashArray: [0, 8, 5]
                  },
                  title: {
                      text: 'Trend Data Rawat Jalan',
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
                                      return val + " (ibu hamil)"
                                  }
                              }
                          },
                          {
                              title: {
                                  formatter: function (val) {
                                      return val + " (imunisasi)"
                                  }
                              }
                          },
                          {
                              title: {
                                  formatter: function (val) {
                                      return val + " (keterangan sehat)"
                                  }
                              }
                          },
                          {
                              title: {
                                  formatter: function (val) {
                                      return val + " (poli umum)"
                                  }
                              }
                          },
                          {
                              title: {
                                  formatter: function (val) {
                                      return val + " (KB)"
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
        </script>
        <script>
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
        </script>
@endsection
