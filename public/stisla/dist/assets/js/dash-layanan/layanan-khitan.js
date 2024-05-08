document.addEventListener('DOMContentLoaded', function() {
    fetchLineChartData();
    bar_khitan();
});

async function fetchLineChartData() {
    try {
        const response = await fetch('http://localhost:8000/api/api-layanan-khitan-line');
        const data = await response.json();
        updateLineChart(data.khitan_per_month);
    } catch (error) {
        console.error('Error fetching line chart data:', error);
    }
}

function updateLineChart(khitanData) {
    const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    var categories = monthNames;
    var dataSeriesKhitan = [];

    for (var i = 0; i < monthNames.length; i++) {
        var khitan = khitanData[i] || 0;

        dataSeriesKhitan.push(khitan);
    }

    var options = {
        series: [
            {
                name: "Khitan",
                data: dataSeriesKhitan,
                color: "#FF0000" // Merah untuk data khitan
            },
        ],
        chart: {
            height: 350,
            type: 'line',
            zoom: {
                enabled: false
            },
        },
        title: {
            text: 'Trend Data Khitan',
            align: 'center'
        },
        xaxis: {
            categories: categories
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
}

function bar_khitan() {
    fetch('http://localhost:8000/api/api-layanan-khitan-bar')
    .then(response => response.json())
    .then(data => {
        var years = Object.keys(data);
        var series = [];

        years.forEach(year => {
            series.push({
                name: year,
                data: Object.values(data[year])
            });
        });

        var options = {
            series: series,
            chart: {
                height: 350,
                type: 'bar',
            },
            plotOptions: {
                bar: {
                    borderRadius: 10,
                    columnWidth: '20%',
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                width: 0
            },
            grid: {
                row: {
                    colors: ['#fff', '#f2f2f2']
                }
            },
            title: {
                text: 'Trend Data Bar Khitan',
                align: 'center'
            },
            xaxis: {
                labels: {
                    rotate: -45
                },
                categories: Object.keys(data[years[0]]), // Mengambil kategori poli dari tahun pertama
                tickPlacement: 'on'
            },
            yaxis: {
                title: {
                    text: 'Visitors Khitan',
                },
            },
            fill: {
                colors: ['#006400', '#FF0000'], // Warna hijau tua dan merah
                type: 'gradient',
                gradient: {
                    shade: 'light',
                    type: "horizontal",
                    shadeIntensity: 0.25,
                    gradientToColors: undefined,
                    inverseColors: true,
                    opacityFrom: 0.85,
                    opacityTo: 0.85,
                    stops: [50, 0, 100]
                },
            }
        };

        var chart = new ApexCharts(document.querySelector("#baris"), options);
        chart.render();
    })
    .catch(error => console.error('Error fetching bar khitan data:', error));
}

