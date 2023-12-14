// "use strict";

// var statistics_chart = document.getElementById("myChart11").getContext('2d');

// var myChart = new Chart(statistics_chart, {
//   type: 'pie',
//   data: {
//     labels: ["Administrasi", "Umum", "Rumah Tangga"],
//     datasets: [{
//       label: 'Statistics',
//       data: [2, 4, 7],
//     //   borderWidth: 5,
//     //   borderColor: '#6777ef',
//       backgroundColor: ['green', 'yellow', 'orange'], // Warna untuk setiap sektor pada pie chart
//       pointBackgroundColor: '#fff',
//       pointBorderColor: '#6777ef',
//       pointRadius: 4
//     }]
//   },
//   options: {
//     legend: {
//       display: true,
//       position: 'bottom'
//     },
//   }
// });
"use strict";

var statistics_chart = document.getElementById("myChart11").getContext('2d');

// Melakukan permintaan ke API untuk mendapatkan data
fetch('http://localhost:8000/api/api-non-nakes') // Ganti URL dengan URL API sebenarnya
  .then(response => {
    if (!response.ok) {
      throw new Error('Gagal mendapatkan data dari API.');
    }
    return response.json();
  })
  .then(data => {
    // Mengambil data dari respons API
    var labels = Object.keys(data.data);
    var values = Object.values(data.data);
    var colors = ['green', 'yellow', 'orange']; // Sesuaikan dengan kebutuhan Anda

    // Memanggil fungsi createChart dengan data dari API
    createChart({ labels, values, colors });
  })
  .catch(error => {
    console.error('Terjadi kesalahan:', error);
    alert('Terjadi kesalahan saat mengambil data dari API. Mohon periksa konsol browser untuk informasi lebih lanjut.');
  });

// Mendefinisikan fungsi untuk membuat chart
function createChart(data) {
  var myChart = new Chart(statistics_chart, {
    type: 'pie',
    data: {
      labels: data.labels,
      datasets: [{
        label: 'Statistics',
        data: data.values,
        backgroundColor: data.colors,
        pointRadius: 4
      }]
    },
    options: {
      legend: {
        display: true,
        position: 'bottom'
      },
    }
  });
}
