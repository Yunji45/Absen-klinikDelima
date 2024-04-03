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
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

        <script>
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
</script>
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