// document.addEventListener("DOMContentLoaded", () => {
//   new ApexCharts(document.querySelector("#reportsChart"), {
//     series: [{
//       name: 'On-time',
//       // data: [31, 40, 28, 51, 42, 82, 56],
//       data: [20, 42, 21, 10, 30, 11, 4]
//     }, {
//       name: 'Telat',
//       data: [11, 32, 45, 32, 34, 52, 41]
//     }, {
//       name: 'Izin',
//       data: [15, 11, 32, 18, 9, 24, 11]
//     }],
//     chart: {
//       height: 350,
//       type: 'area',
//       toolbar: {
//         show: false
//       },
//     },
//     markers: {
//       size: 4
//     },
//     colors: ['#4154f1', '#2eca6a', '#ff771d'],
//     fill: {
//       type: "gradient",
//       gradient: {
//         shadeIntensity: 1,
//         opacityFrom: 0.3,
//         opacityTo: 0.4,
//         stops: [0, 90, 100]
//       }
//     },
//     dataLabels: {
//       enabled: false
//     },
//     stroke: {
//       curve: 'smooth',
//       width: 2
//     },
//     xaxis: {
//       type: 'datetime',
//       categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z"]
//     },
//     tooltip: {
//       x: {
//         format: 'dd/MM/yy HH:mm'
//       },
//     }
//   }).render();
// });
document.addEventListener("DOMContentLoaded", () => {
  document.getElementById("userForm").addEventListener("submit", function (event) {
      event.preventDefault();

      let userId = document.getElementById("userId").value;

      fetch(`https://klinikmitradelima.com/api/absensi?user_id=${userId}`)
          .then(response => response.json())
          .then(data => {
              const seriesData = [];

              for (const [key, value] of Object.entries(data)) {
                  const series = {
                      name: key,
                      data: value.map(item => ({
                          x: new Date(item.date).getTime(),
                          y: item.value
                      }))
                  };
                  seriesData.push(series);
              }

              new ApexCharts(document.querySelector("#reportsChart"), {
                  series: seriesData,
                  chart: {
                      height: 350,
                      type: 'area',
                      toolbar: {
                          show: false
                      },
                  },
                  markers: {
                      size: 4
                  },
                  colors: ['#4154f1', '#2eca6a', '#ff771d'],
                  fill: {
                      type: "gradient",
                      gradient: {
                          shadeIntensity: 1,
                          opacityFrom: 0.3,
                          opacityTo: 0.4,
                          stops: [0, 90, 100]
                      }
                  },
                  dataLabels: {
                      enabled: false
                  },
                  stroke: {
                      curve: 'smooth',
                      width: 2
                  },
                  xaxis: {
                      type: 'datetime',
                      tooltip: {
                          enabled: false
                      }
                  },
                  tooltip: {
                      x: {
                          format: 'dd/MM/yy'
                      },
                  }
              }).render();
          })
          .catch(error => console.error('Error fetching data:', error));
  });
});
