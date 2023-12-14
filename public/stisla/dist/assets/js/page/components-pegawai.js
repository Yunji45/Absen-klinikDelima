// "use strict";

// var sparkline_values = [10, 7, 4, 8, 5, 8, 6, 5, 2, 4, 7, 4, 9, 6, 5, 9];
// var sparkline_values_chart = [2, 6, 4, 8, 3, 5, 2, 7];
// var sparkline_values_bar = [10, 7, 4, 8, 5, 8, 6, 5, 2, 4, 7, 4, 9, 10, 7, 4, 8, 5, 8, 6, 5, 2, 4, 7, 4, 9, 8, 6, 5, 2, 4, 7, 4, 9, 10, 2, 4, 7, 4, 9, 7, 4, 8, 5, 8, 6, 5];

// $('.sparkline-inline').sparkline(sparkline_values, {
//   type: 'line',
//   width: '100%',
//   height: '32',
//   lineWidth: 3,
//   lineColor: 'rgba(87,75,144,.1)',
//   fillColor: 'rgba(87,75,144,.25)',
//   highlightSpotColor: 'rgba(87,75,144,.1)',
//   highlightLineColor: 'rgba(87,75,144,.1)',
//   spotRadius: 3,
// });

// $('.sparkline-line').sparkline(sparkline_values, {
//   type: 'line',
//   width: '100%',
//   height: '32',
//   lineWidth: 3,
//   lineColor: 'rgba(63, 82, 227, .5)',
//   fillColor: 'transparent',
//   highlightSpotColor: 'rgba(63, 82, 227, .5)',
//   highlightLineColor: 'rgba(63, 82, 227, .5)',
//   spotRadius: 3,
// });

// $('.sparkline-line-chart').sparkline(sparkline_values_chart, {
//   type: 'line',
//   width: '100%',
//   height: '32',
//   lineWidth: 2,
//   lineColor: 'rgba(63, 82, 227, .5)',
//   fillColor: 'transparent',
//   highlightSpotColor: 'rgba(63, 82, 227, .5)',
//   highlightLineColor: 'rgba(63, 82, 227, .5)',
//   spotRadius: 2,
// });

// $(".sparkline-bar").sparkline(sparkline_values_bar, {
//   type: 'bar',
//   height: '32',
//   disableTooltips: true,
//   barColor: 'rgb(87,75,144)'
// });


// var ctx = document.getElementById("myChart7").getContext('2d');
// var myChart = new Chart(ctx, {
//   type: 'bar',
//   data: {
//     labels: ["2023", "2024", "2025", "2026", "2027", "2028", "2029"],
//     datasets: [{
//       label: 'Tetap',
//       data: [460, 458, 330, 502, 430, 610, 488],
//       borderWidth: 2,
//       backgroundColor: 'rgba(128, 0, 128, 0.7)',
//       borderColor: 'rgba(128, 0, 128, 0.7)',
//       borderWidth: 2.5,
//       pointBackgroundColor: '#ffffff',
//       pointRadius: 4
//     },{
//       label: 'Kontrak',
//       data: [550, 558, 390, 562, 490, 670, 538],
//       borderWidth: 2,
//       backgroundColor: 'rgba(255, 182, 193, 0.7)',
//       borderColor: 'rgba(255, 182, 193, 0.7)',
//       borderWidth: 0,
//       pointBackgroundColor: '#999',
//       pointRadius: 4
//     }]
//   },
//   options: {
//     legend: {
//       display: false
//     },
//     scales: {
//       yAxes: [{
//         gridLines: {
//           drawBorder: false,
//           color: '#f2f2f2',
//         },
//         ticks: {
//           beginAtZero: true,
//           stepSize: 150
//         }
//       }],
//       xAxes: [{
//         gridLines: {
//           display: false
//         }
//       }]
//     },
//   }
// });

// var ctx = document.getElementById("myChart3").getContext('2d');
// var myChart = new Chart(ctx, {
//   type: 'line',
//   data: {
//     labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
//     datasets: [{
//       label: 'Google',
//       data: [290, 358, 220, 402, 690, 510, 688],
//       borderWidth: 2,
//       backgroundColor: 'transparent',
//       borderColor: 'rgba(254,86,83,.7)',
//       borderWidth: 2.5,
//       pointBackgroundColor: 'transparent',
//       pointBorderColor: 'transparent',
//       pointRadius: 4
//     },
//     {
//       label: 'Facebook',
//       data: [450, 258, 390, 162, 440, 570, 438],
//       borderWidth: 2,
//       backgroundColor: 'transparent',
//       borderColor: 'rgba(63,82,227,.8)',
//       borderWidth: 0,
//       pointBackgroundColor: 'transparent',
//       pointBorderColor: 'transparent',
//       pointRadius: 4
//     },
//     ]
//   },
//   options: {
//     legend: {
//       display: false
//     },
//     scales: {
//       yAxes: [{
//         gridLines: {
//           drawBorder: false,
//           color: '#f2f2f2',
//         },
//         ticks: {
//           beginAtZero: true,
//           stepSize: 200
//         }
//       }],
//       xAxes: [{
//         gridLines: {
//           display: false
//         }
//       }]
//     },
//   }
// });

// $('#visitorMap').vectorMap(
// {
//   map: 'world_en',
//   backgroundColor: '#ffffff',
//   borderColor: '#f2f2f2',
//   borderOpacity: .8,
//   borderWidth: 1,
//   hoverColor: '#000',
//   hoverOpacity: .8,
//   color: '#ddd',
//   normalizeFunction: 'linear',
//   selectedRegions: false,
//   showTooltip: true,
//   pins: {
//     id: '<div class="jqvmap-circle"></div>',
//     my: '<div class="jqvmap-circle"></div>',
//     th: '<div class="jqvmap-circle"></div>',
//     sy: '<div class="jqvmap-circle"></div>',
//     eg: '<div class="jqvmap-circle"></div>',
//     ae: '<div class="jqvmap-circle"></div>',
//     nz: '<div class="jqvmap-circle"></div>',
//     tl: '<div class="jqvmap-circle"></div>',
//     ng: '<div class="jqvmap-circle"></div>',
//     si: '<div class="jqvmap-circle"></div>',
//     pa: '<div class="jqvmap-circle"></div>',
//     au: '<div class="jqvmap-circle"></div>',
//     ca: '<div class="jqvmap-circle"></div>',
//     tr: '<div class="jqvmap-circle"></div>',
//   },
// });
"use strict";

// Fungsi untuk mengambil data dari API
async function fetchData(url) {
  try {
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error('Gagal mendapatkan data dari API.');
    }
    const data = await response.json();
    return data;
  } catch (error) {
    console.error('Terjadi kesalahan:', error);
    throw error; // Melempar kembali error untuk penanganan lebih lanjut jika diperlukan
  }
}

// Ambil data untuk chart gender
fetchData('http://localhost:8000/api/api-pekerjaan') // Ganti dengan URL API yang sesuai
  .then(data => {
    // Asumsi data memiliki properti 'data'
    const pekerjaanData = data.data;

    // Mendapatkan label tahun dari data yang diambil
    const years = Object.keys(pekerjaanData);

    // Mendapatkan data KONTRAK dan TETAP dari data yang diambil
    const kontrakData = years.map(year => pekerjaanData[year]['KONTRAK']);
    const tetapData = years.map(year => pekerjaanData[year]['TETAP']);

    // Perbarui chart pekerjaan
    updatePekerjaanChart(years, kontrakData, tetapData);
  })
  .catch(error => {
    alert('Terjadi kesalahan saat mengambil data dari API. Mohon periksa konsol browser untuk informasi lebih lanjut.');
  });

// Fungsi untuk memperbarui chart pekerjaan
function updatePekerjaanChart(years, kontrakData, tetapData) {
  var ctx = document.getElementById("myChart10").getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: years,
      datasets: [
        {
          label: 'Kontrak',
          data: kontrakData,
          borderWidth: 2,
          backgroundColor: 'rgba(255, 192, 203, 0.7)', // Warna pink
          borderColor: 'rgba(254, 86, 83, 1)',
          borderWidth: 2.5,
          pointBackgroundColor: '#ffffff',
          pointRadius: 4
        },
        {
          label: 'Tetap',
          data: tetapData,
          borderWidth: 2,
          backgroundColor: 'rgba(63, 82, 82, 0.8)', // Warna gelap
          borderColor: 'rgba(0, 128, 0, 0.7)',
          borderWidth: 0,
          pointBackgroundColor: '#999',
          pointRadius: 4
        }
      ]
    },
    options: {
      legend: {
        display: true,
      },
      scales: {
        yAxes: [{
          gridLines: {
            drawBorder: false,
            color: '#f2f2f2',
          },
          ticks: {
            beginAtZero: true,
            stepSize: 2 // Sesuaikan dengan kebutuhan Anda
          }
        }],
        xAxes: [{
          gridLines: {
            display: false
          }
        }]
      },
    }
  });
}
