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
                      <h4>Persalinan</h4>
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
                <a class="nav-link" href="{{route('dash.rajal')}}">Rawat Jalan</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="{{route('dash.ranap')}}">Rawat Inap</a>
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
              <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                  <div class="card-body">
                    <div id="chart"></div>
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
        <script>
          var monthNames = ["Pasien Umum", "Persalinan"];
          var currentYear = new Date().getFullYear(); // Tahun saat ini

          // Inisialisasi grafik dengan tahun saat ini
          updateChart(currentYear);

          function updateChart(selectedYear) {
              // Fungsi ini akan diperbarui untuk mengambil data dari API atau sumber data lainnya sesuai dengan kebutuhan Anda
              // Data dummy ditampilkan di sini untuk tujuan demonstrasi
              var categories = [];
              var dataSeries = [];

              // Looping untuk mendapatkan data bulan per tahun yang dipilih
              for (var i = 0; i < 2; i++) {
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
                      text: 'Trend Data Rawat Inap',
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
            chart: {
              height: 350,
              type: "line",
              stacked: false
            },
            dataLabels: {
              enabled: false
            },
            colors: ['#99C2A2', '#C5EDAC', '#66C7F4'],
            series: [
              
              {
                name: 'Pasien Umum',
                type: 'column',
                data: [21.1, 23, 33.1, 34, 44.1, 44.9, 56.5, 58.5]
              },
              {
                name: "Persalinan",
                type: 'column',
                data: [10, 19, 27, 26, 34, 35, 40, 38]
              },
              {
                name: "Line C",
                type: 'line',
                data: [1.4, 2, 2.5, 1.5, 2.5, 2.8, 3.8, 4.6]
              },
            ],
            stroke: {
              width: [4, 4, 4]
            },
            plotOptions: {
              bar: {
                columnWidth: "20%"
              }
            },
            xaxis: {
              categories: [2017, 2018, 2019, 2020, 2021, 2022, 2023, 2024]
            },
            yaxis: [
              {
                seriesName: 'Column A',
                axisTicks: {
                  show: true
                },
                axisBorder: {
                  show: true,
                },
                title: {
                  text: "Columns"
                }
              },
              {
                seriesName: 'Column A',
                show: false
              }, {
                opposite: true,
                seriesName: 'Line C',
                axisTicks: {
                  show: true
                },
                axisBorder: {
                  show: true,
                },
                title: {
                  text: "Line"
                }
              }
            ],
            tooltip: {
              shared: false,
              intersect: true,
              x: {
                show: false
              }
            },
            title: {
                      text: 'Trend Data Rawat Inap',
                      align: 'left'
                  },
            legend: {
              horizontalAlign: "left",
              offsetX: 40
            }
          };

          var chart = new ApexCharts(document.querySelector("#baris"), options);

          chart.render();
        </script>
@endsection