"use strict";

var statistics_chart = document.getElementById("myChart9").getContext('2d');

var myChart = new Chart(statistics_chart, {
  type: 'pie',
  data: {
    labels: ["Dokter", "Perawat", "Bidan", "Apoteker", "Asisten Apoteker", "Analys LAB", "Nutrisionis"],
    datasets: [{
      label: 'Statistics',
      data: [2, 3, 9, 1, 2, 2, 1],
      borderWidth: 5,
      borderColor: '#6777ef',
      backgroundColor: ['red', 'blue', 'green', 'yellow', 'orange', 'purple', 'pink'], // Warna untuk setiap sektor pada pie chart
      pointBackgroundColor: '#fff',
      pointBorderColor: '#6777ef',
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