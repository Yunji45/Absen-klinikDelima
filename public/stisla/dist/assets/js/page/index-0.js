"use strict";

var statistics_chart = document.getElementById("myChart").getContext('2d');

var myChart = new Chart(statistics_chart, {
  type: 'pie',
  data: {
    labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
    datasets: [{
      label: 'Statistics',
      data: [640, 387, 530, 302, 430, 270, 488],
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
