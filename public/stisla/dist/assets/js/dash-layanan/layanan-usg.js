document.addEventListener('DOMContentLoaded', function() {
    async function fetchBarChartData() {
        try {
            const response = await fetch('https://klinikmitradelima.com/api/api-layanan-usg-bar');
            const data = await response.json();
  
            var options = {
                series: data.series,
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
                        return val;
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
                    categories: data.years
                },
                fill: {
                    opacity: 1,
                },
                colors: ['#80c7fd', '#008FFB', '#80f1cb', '#00E396', '#FF4560'],
                legend: {
                    position: 'top',
                    horizontalAlign: 'center',
                }
            };
  
            var chart = new ApexCharts(document.querySelector("#baris"), options);
            chart.render();
        } catch (error) {
            console.error('Error fetching bar chart data:', error);
        }
    }
  
    fetchBarChartData();
  });