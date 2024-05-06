document.addEventListener('DOMContentLoaded', function() {
    fetchLineChartData();
    fetchBarChartData();
});

async function fetchLineChartData() {
    try {
        const response = await fetch('http://localhost:8000/api/api-layanan-ranap-line');
        const data = await response.json();
        updateLineChart(data.umum_per_month, data.persalinan_per_month);
    } catch (error) {
        console.error('Error fetching line chart data:', error);
    }
}

async function fetchBarChartData() {
    try {
        const response = await fetch('http://localhost:8000/api/api-layanan-ranap-bar');
        const data = await response.json();
        updateBarChart(data);
    } catch (error) {
        console.error('Error fetching bar chart data:', error);
    }
}

function updateLineChart(umumData, persalinanData) {
    var categories = [];
    var dataSeriesUmum = [];
    var dataSeriesPersalinan = [];

    for (var i = 1; i <= 12; i++) {
        categories.push(monthNames[i - 1]);
        var umum = umumData[i] ? umumData[i] : 0;
        var persalinan = persalinanData[i] ? persalinanData[i] : 0;

        dataSeriesUmum.push(umum);
        dataSeriesPersalinan.push(persalinan);
    }

    var options = {
        series: [
            {
                name: "Umum",
                data: dataSeriesUmum
            },
            {
                name: "Persalinan",
                data: dataSeriesPersalinan
            }
        ],
        chart: {
            height: 350,
            type: 'line',
            zoom: {
                enabled: false
            },
        },
        title: {
            text: 'Trend Data Layanan',
            align: 'center'
        },
        xaxis: {
            categories: categories
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
}

function updateBarChart(data) {
    const { umum_count, persalinan_count, persentase, years } = data;

    var options = {
        chart: {
            height: 350,
            type: "bar",
            stacked: false
        },
        dataLabels: {
            enabled: false
        },
        colors: ['#99C2A2', '#C5EDAC', '#66C7F4'],
        series: [
            {
                name: 'Umum',
                data: umum_count
            },
            {
                name: "Persalinan",
                data: persalinan_count
            },
            {
                name: "Persentase",
                type: 'line',
                data: persentase
            },
        ],
        xaxis: {
            categories: years
        },
        yaxis: [
            {
                seriesName: 'Column A',
                axisTicks: {
                    show: true
                },
                axisBorder: {
                    show: true,
                },
                title: {
                    text: "Columns"
                }
            },
            {
                seriesName: 'Column A',
                show: false
            }, {
                opposite: true,
                seriesName: 'Line C',
                axisTicks: {
                    show: true
                },
                axisBorder: {
                    show: true,
                },
                title: {
                    text: "Line"
                }
            }
        ],
        tooltip: {
            shared: false,
            intersect: true,
            x: {
                show: false
            }
        },
        title: {
            text: 'Trend Data Rawat Inap',
            align: 'left'
        },
        legend: {
            horizontalAlign: "left",
            offsetX: 40
        }
    };

    var chart = new ApexCharts(document.querySelector("#baris"), options);
    chart.render();
}
