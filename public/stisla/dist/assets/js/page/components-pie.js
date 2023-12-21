// "use strict";

// var statistics_chart = document.getElementById("myChart9").getContext('2d');

// var myChart = new Chart(statistics_chart, {
//   type: 'pie',
//   data: {
//     labels: ["Dokter", "Perawat", "Bidan", "Apoteker", "Asisten Apoteker", "Analys LAB", "Nutrisionis"],
//     datasets: [{
//       label: 'Statistics',
//       data: [2, 3, 9, 1, 2, 2, 1],
//       // borderWidth: 5,
//       // borderColor: '#6777ef',
//       backgroundColor: ['red', 'blue', 'green', 'yellow', 'orange', 'purple', 'pink'], // Warna untuk setiap sektor pada pie chart
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

// Mendapatkan elemen canvas
var statistics_chart = document.getElementById("myChart200").getContext('2d');

// Melakukan permintaan ke API untuk mendapatkan data
fetch('http://localhost:8000/api/api-nakes') // Ganti URL dengan URL API sebenarnya
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
    var colors = ['red', 'blue', 'green', 'yellow', 'orange', 'purple', 'pink']; // Sesuaikan dengan kebutuhan Anda

    // Memanggil fungsi createChart dengan data dari API
    createChart({ labels, values, colors });
  })
  .catch(error => {
    console.error('Terjadi kesalahan:', error);
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
