document.addEventListener('DOMContentLoaded', function() {
    line_chart();
    bar_chart();
});

function line_chart()
{
    var options = {
        series: [{
          name: "Laboratorium",
          data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
      }],
        chart: {
        height: 350,
        type: 'line',
        zoom: {
          enabled: false
        }
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        curve: 'straight'
      },
      title: {
        text: 'Product Trends by Month',
        align: 'center'
      },
      grid: {
        row: {
          colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
          opacity: 0.5
        },
      },
      xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
      }
      };
    
      var chart = new ApexCharts(document.querySelector("#chart"), options);
      chart.render();
    
}
function bar_chart()
  {
    var options = {
        series: [
        {
          name: 'Q1 Budget',
          group: 'budget',
          data: [44000, 55000, 41000, 67000, 22000]
        },
        {
          name: 'Q1 Laki-Laki',
          group: 'actual',
          data: [48000, 50000, 40000, 65000, 25000]
        },
        {
          name: 'Q2 Budget',
          group: 'budget',
          data: [13000, 36000, 20000, 8000, 13000]
        },
        {
          name: 'Q2 Perempuan',
          group: 'actual',
          data: [20000, 40000, 25000, 10000, 12000]
        },
      ],
        chart: {
        type: 'bar',
        height: 350,
        stacked: true,
      },
      stroke: {
        width: 1,
        colors: ['#fff']
      },
      dataLabels: {
        formatter: (val) => {
          return val / 1000 + 'K'
        }
      },
      plotOptions: {
        bar: {
          horizontal: true
        }
      },
      title: {
        text: 'Product Trends by Year',
        align: 'center'
      },

      xaxis: {
        categories: [
          'Online advertising',
          'Sales Training',
          'Print advertising',
          'Catalogs',
          'Meetings'
        ],
        labels: {
          formatter: (val) => {
            return val / 1000 + 'K'
          }
        }
      },
      fill: {
        opacity: 1,
      },
      colors: ['#80c7fd', '#008FFB', '#80f1cb', '#00E396'],
      legend: {
        position: 'top',
        horizontalAlign: 'center',
      }
      };

      var chart = new ApexCharts(document.querySelector("#baris"), options);
      chart.render();
  }