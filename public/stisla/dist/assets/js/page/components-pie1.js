"use strict";

var statistics_chart = document.getElementById("myChart11").getContext('2d');

var myChart = new Chart(statistics_chart, {
  type: 'pie',
  data: {
    labels: ["Administrasi", "Umum", "Rumah Tangga"],
    datasets: [{
      label: 'Statistics',
      data: [2, 4, 7],
    //   borderWidth: 5,
    //   borderColor: '#6777ef',
      backgroundColor: ['green', 'yellow', 'orange'], // Warna untuk setiap sektor pada pie chart
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