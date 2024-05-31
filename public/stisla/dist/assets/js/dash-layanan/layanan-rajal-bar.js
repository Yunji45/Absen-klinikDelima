// var options = {
//     series: [{
//       name: 'Ibu Hamil',
//       data: [44, 55, 41, 37, 22, 43, 21]
//     }, {
//       name: 'Imunisasi',
//       data: [53, 32, 33, 52, 13, 43, 32]
//     }, {
//       name: 'KB',
//       data: [12, 17, 11, 9, 15, 11, 20]
//     }, {
//       name: 'Poli Umum',
//       data: [9, 7, 5, 8, 6, 9, 4]
//     }, {
//       name: 'Keterangan Sehat',
//       data: [25, 12, 19, 32, 25, 24, 10]
//     }],
//     chart: {
//       type: 'bar',
//       height: 350,
//       stacked: true,
//     },
//     plotOptions: {
//       bar: {
//         horizontal: true,
//         dataLabels: {
//           total: {
//             enabled: true,
//             offsetX: 0,
//             style: {
//               fontSize: '13px',
//               fontWeight: 900
//             }
//           }
//         }
//       },
//     },
//     stroke: {
//       width: 1,
//       colors: ['#fff']
//     },
//     title: {
//       text: 'Trend Bar Rawat Jalan'
//     },
//     xaxis: {
//       categories: [2018, 2019, 2020, 2021,2022,2023,2024],
//       labels: {
//         formatter: function (val) {
//           return val + "K"
//         }
//       }
//     },
//     yaxis: {
//       title: {
//         text: undefined
//       },
//     },
//     tooltip: {
//       y: {
//         formatter: function (val) {
//           return val + " "+"Pasien"
//         }
//       }
//     },
//     fill: {
//       opacity: 1
//     },
//     legend: {
//       position: 'top',
//       horizontalAlign: 'left',
//       offsetX: 40
//     }
//   };

//   var chart = new ApexCharts(document.querySelector("#mychart"), options);
//   chart.render();
// Fungsi untuk mendapatkan data dari API
async function getDataFromAPI() {
  var url = 'https://klinikmitradelima.com/api/api-layanan-rajal-bar'; // Sesuaikan dengan URL API Anda

  try {
    const response = await fetch(url);
    const data = await response.json();
    // Panggil fungsi untuk menggambar grafik dengan data yang diperoleh dari API
    drawChart(data);
  } catch (error) {
    console.error('Error fetching data:', error);
  }
}

// Fungsi untuk menggambar grafik dengan data yang diperoleh dari API
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
      text: 'Trend Bar Rawat Jalan',
      align: 'center'
    },
    xaxis: {
      categories: [],
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
          return val + " " + "Kunjungan"
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

  // Mengisi data series dan kategori x-axis dari data API
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
  var chart = new ApexCharts(document.querySelector("#mychart"), options);
  chart.render();
}

// Memanggil fungsi untuk mendapatkan data dari API saat halaman dimuat
getDataFromAPI();
