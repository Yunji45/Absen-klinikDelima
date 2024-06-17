document.addEventListener('DOMContentLoaded', function() {
    fetchYears();
    // kode_wilayah();
    // line_chart();
    pie_chart();
    getDataFromAPI();
    gender();
    bar_chart();
});
function fetchYears() {
    fetch('https://klinikmitradelima.com/api/api-tahun-layanan')
        .then(response => response.json())
        .then(years => {
            const yearSelect = document.getElementById('year-select');
            years.forEach(year => {
                const option = document.createElement('option');
                option.value = year;
                option.textContent = year;
                yearSelect.appendChild(option);
            });

            if (years.length > 0) {
                pie_chart(years[0]);
            }

            yearSelect.addEventListener('change', function() {
                pie_chart(this.value);
            });
        })
        .catch(error => {
            console.error('Error fetching years:', error);
        });
}

function pie_chart(year) {
    fetch(`https://klinikmitradelima.com/api/api-layanan-pie?year=${year}`)
        .then(response => response.json())
        .then(data => {
            var series = data.series;
            var labels = data.labels;

            var options = {
                series: series,
                chart: {
                    width: 380,
                    type: 'donut',
                    dropShadow: {
                        enabled: true,
                        color: '#111',
                        top: -1,
                        left: 3,
                        blur: 3,
                        opacity: 0.2
                    },
                },
                stroke: {
                    width: 0,
                },
                plotOptions: {
                    pie: {
                        donut: {
                            labels: {
                                show: true,
                                total: {
                                    showAlways: true,
                                    show: true
                                }
                            }
                        }
                    }
                },
                labels: labels,
                dataLabels: {
                    dropShadow: {
                        blur: 3,
                        opacity: 0.8
                    }
                },
                fill: {
                    type: 'pattern',
                    opacity: 1,
                    pattern: {
                        enabled: true,
                        style: ['verticalLines', 'squares', 'horizontalLines', 'circles', 'slantedLines'],
                    },
                },
                states: {
                    hover: {
                        filter: 'none'
                    }
                },
                theme: {
                    palette: 'palette2'
                },
                title: {
                    text: "Trend Kontribusi 6 Sub Layanan",
                    align: 'center',
                    margin: 10
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };

            var chart = new ApexCharts(document.querySelector("#baris"), options);
            chart.render();
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
}

async function getDataFromAPI() {
    var url = 'https://klinikmitradelima.com/api/api-layanan-piramid';
  
    try {
      const response = await fetch(url);
      const data = await response.json();
      // Panggil fungsi untuk menggambar grafik dengan data yang diperoleh dari API
      drawChart(data);
    } catch (error) {
      console.error('Error fetching data:', error);
    }
  }
  function drawChart(data) {
    var options = {
        series: [],
        chart: {
            type: 'bar',
            height: 350,
            stacked: true,
        },
        colors: ['#008FFB', '#00E396', '#FEB019', '#FF4560', '#775DD0', '#FF7A57'], // Sesuaikan palet warna di sini
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
            text: 'Trend Bar 6 Sub Layanan',
            align: 'center'
        },
        xaxis: {
            categories: [],
            labels: {
                formatter: function (val) {
                    return val 
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
                    return val + " Kunjungan"
                }
            }
        },
        fill: {
            opacity: 1
        },
        legend: {
            position: 'top',
            horizontalAlign: 'center',
            offsetX: 40
        }
    };

    // Mengisi data series dari data API
    for (var year in data) {
        options.xaxis.categories.push(year);
        for (var poli in data[year]) {
          // Membuat objek seri untuk setiap jenis poli
          var seriesIndex = options.series.findIndex(series => series.name === poli);
          if (seriesIndex === -1) {
            options.series.push({
              name: poli,
              data: []
            });
            seriesIndex = options.series.length - 1;
          }
          // Menambahkan data kunjungan untuk setiap jenis poli
          options.series[seriesIndex].data.push(data[year][poli]);
        }
      }
    
    // Membuat dan merender grafik menggunakan data dan opsi yang telah diatur
    var chart = new ApexCharts(document.querySelector("#baris-2"), options);
    chart.render();
}




function gender() {
  // Lakukan permintaan HTTP ke endpoint API
  fetch('https://klinikmitradelima.com/api/api-layanan-gender')
      .then(response => response.json())
      .then(data => {
          // Proses data yang diterima
          const { khitan, ranap, rajal } = data;

          // Ubah struktur data menjadi sesuai dengan format yang diperlukan oleh grafik
          const lakiLakiData = [];
          const perempuanData = [];

          Object.keys(khitan).forEach(year => {
              lakiLakiData.push(khitan[year]['Laki-laki']);
              perempuanData.push(khitan[year]['Perempuan']);
          });

          Object.keys(ranap).forEach(year => {
              lakiLakiData.push(ranap[year]['Laki-laki']);
              perempuanData.push(ranap[year]['Perempuan']);
          });

          Object.keys(rajal).forEach(year => {
              lakiLakiData.push(rajal[year]['Laki-laki']);
              perempuanData.push(rajal[year]['Perempuan']);
          });

          // Buat konfigurasi grafik dengan data yang telah diproses
          var options = {
              series: [
                  {
                      name: 'Laki-Laki',
                      data: lakiLakiData
                  },
                  {
                      name: 'Perempuan',
                      data: perempuanData
                  }
              ],
              chart: {
                  type: 'bar',
                  height: 440,
                  stacked: true
              },
              colors: ['#008FFB', '#FF4560'],
              plotOptions: {
                  bar: {
                      borderRadius: 5,
                      borderRadiusApplication: 'end', // 'around', 'end'
                      borderRadiusWhenStacked: 'all', // 'all', 'last'
                      horizontal: true,
                      barHeight: '60%',
                  },
              },
              dataLabels: {
                  enabled: false
              },
              stroke: {
                  width: 1,
                  colors: ["#fff"]
              },
              grid: {
                  xaxis: {
                      lines: {
                          show: false
                      }
                  }
              },
              yaxis: {
                  stepSize: 1
              },
              tooltip: {
                  shared: false,
                  x: {
                      formatter: function (val) {
                          return val
                      }
                  },
                  y: {
                      formatter: function (val) {
                          return Math.abs(val) 
                      }
                  }
              },
              title: {
                  text: 'Population With Gender',
                  align: 'center'
              },
              xaxis: {
                  categories: Object.keys(khitan), // Menggunakan tahun sebagai kategori x-axis
                  title: {
                      text: 'Persentase'
                  },
                  labels: {
                      formatter: function (val) {
                          return Math.abs(Math.round(val)) + "%"
                      }
                  }
              },
          };

          // Render grafik dengan konfigurasi yang telah dibuat
          var chart = new ApexCharts(document.querySelector("#gender"), options);
          chart.render();
      })
      .catch(error => {
          // Tangani kesalahan jika ada
          console.error('Error fetching data:', error);
      });
}


