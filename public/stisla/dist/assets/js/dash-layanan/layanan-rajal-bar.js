var options = {
    series: [{
      name: 'Ibu Hamil',
      data: [44, 55, 41, 37, 22, 43, 21]
    }, {
      name: 'Imunisasi',
      data: [53, 32, 33, 52, 13, 43, 32]
    }, {
      name: 'KB',
      data: [12, 17, 11, 9, 15, 11, 20]
    }, {
      name: 'Poli Umum',
      data: [9, 7, 5, 8, 6, 9, 4]
    }, {
      name: 'Keterangan Sehat',
      data: [25, 12, 19, 32, 25, 24, 10]
    }],
    chart: {
      type: 'bar',
      height: 350,
      stacked: true,
    },
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
      text: 'Trend Bar Rawat Jalan'
    },
    xaxis: {
      categories: [2018, 2019, 2020, 2021,2022,2023,2024],
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
          return val + " "+"Pasien"
        }
      }
    },
    fill: {
      opacity: 1
    },
    legend: {
      position: 'top',
      horizontalAlign: 'left',
      offsetX: 40
    }
  };

  var chart = new ApexCharts(document.querySelector("#mychart"), options);
  chart.render();