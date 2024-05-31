// document.addEventListener('DOMContentLoaded', function() {
//     fetchLineChartData();
//     fetchBarChartData();
// });

// async function fetchLineChartData() {
//     try {
//         const response = await fetch('https://klinikmitradelima.com/api/api-layanan-ranap-line');
//         const data = await response.json();
//         updateLineChart(data.umum_per_month, data.persalinan_per_month);
//     } catch (error) {
//         console.error('Error fetching line chart data:', error);
//     }
// }

// async function fetchBarChartData() {
//     try {
//         const response = await fetch('https://klinikmitradelima.com/api/api-layanan-ranap-bar');
//         if (!response.ok) {
//             throw new Error('Failed to fetch bar chart data');
//         }
//         const data = await response.json();
//         if (!data || !data.umum_count || !data.persalinan_count || !data.persentase || !data.years) {
//             throw new Error('Invalid data format received');
//         }

//         // Filter data yang memiliki umum_count dan persalinan_count tidak sama dengan 0
//         const filteredData = {
//             umum_count: data.umum_count.filter(value => value !== 0),
//             persalinan_count: data.persalinan_count.filter(value => value !== 0),
//             persentase: data.persentase.filter(value => value !== 0),
//             years: data.years.filter((value, index) => data.umum_count[index] !== 0 && data.persalinan_count[index] !== 0)
//         };

//         updateBarChart(filteredData);
//     } catch (error) {
//         console.error('Error fetching bar chart data:', error);
//     }
// }

// function updateLineChart(umumData, persalinanData) {
//     const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
//     var categories = monthNames;
//     var dataSeriesUmum = [];
//     var dataSeriesPersalinan = [];

//     for (var i = 0; i < monthNames.length; i++) {
//         var umum = umumData[i] || 0;
//         var persalinan = persalinanData[i] || 0;

//         dataSeriesUmum.push(umum);
//         dataSeriesPersalinan.push(persalinan);
//     }

//     var options = {
//         series: [
//             {
//                 name: "Umum",
//                 data: dataSeriesUmum
//             },
//             {
//                 name: "Persalinan",
//                 data: dataSeriesPersalinan
//             }
//         ],
//         chart: {
//             height: 350,
//             type: 'line',
//             zoom: {
//                 enabled: false
//             },
//         },
//         title: {
//             text: 'Trend Data Layanan',
//             align: 'center'
//         },
//         xaxis: {
//             categories: categories
//         }
//     };

//     var chart = new ApexCharts(document.querySelector("#chart"), options);
//     chart.render();
// }

// function updateBarChart(data) {
//     const { umum_count, persalinan_count, persentase, years } = data;

//     var options = {
//         chart: {
//             height: 350,
//             type: "bar",
//             stacked: false
//         },
//         dataLabels: {
//             enabled: false
//         },
//         colors: ['#99C2A2', '#C5EDAC', '#66C7F4'],
//         series: [
//             {
//                 name: 'Umum',
//                 data: umum_count
//             },
//             {
//                 name: "Persalinan",
//                 data: persalinan_count
//             },
//             {
//                 name: "Persentase",
//                 type: 'line',
//                 data: persentase
//             },
//         ],
//         xaxis: {
//             categories: years
//         },
//         yaxis: [
//             {
//                 seriesName: 'Column A',
//                 axisTicks: {
//                     show: true
//                 },
//                 axisBorder: {
//                     show: true,
//                 },
//                 title: {
//                     text: "Columns"
//                 }
//             },
//             {
//                 seriesName: 'Column A',
//                 show: false
//             }, {
//                 opposite: true,
//                 seriesName: 'Line C',
//                 axisTicks: {
//                     show: true
//                 },
//                 axisBorder: {
//                     show: true,
//                 },
//                 title: {
//                     text: "Line"
//                 }
//             }
//         ],
//         tooltip: {
//             shared: false,
//             intersect: true,
//             x: {
//                 show: false
//             }
//         },
//         title: {
//             text: 'Trend Data Rawat Inap',
//             align: 'left'
//         },
//         legend: {
//             horizontalAlign: "left",
//             offsetX: 40
//         }
//     };

//     var chart = new ApexCharts(document.querySelector("#baris"), options);
//     chart.render();
// }

document.addEventListener('DOMContentLoaded', function() {
    fetchLineChartData();
    updateChart();
});

async function fetchLineChartData() {
    try {
        const response = await fetch('https://klinikmitradelima.com/api/api-layanan-ranap-line');
        const data = await response.json();
        updateLineChart(data.umum_per_month, data.persalinan_per_month);
    } catch (error) {
        console.error('Error fetching line chart data:', error);
    }
}

function updateLineChart(umumData, persalinanData) {
    const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    var categories = monthNames;
    var dataSeriesUmum = [];
    var dataSeriesPersalinan = [];

    for (var i = 0; i < monthNames.length; i++) {
        var umum = umumData[i] || 0;
        var persalinan = persalinanData[i] || 0;

        dataSeriesUmum.push(umum);
        dataSeriesPersalinan.push(persalinan);
    }

    var options = {
        series: [
            {
                name: "Umum",
                data: dataSeriesUmum,
                color: "#FF0000"
            },
            {
                name: "Persalinan",
                data: dataSeriesPersalinan,
                color: "#006400"
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

async function updateChart() {
    try {
        const response = await fetch('https://klinikmitradelima.com/api/api-layanan-ranap-bar');
        const data = await response.json();
        const { umum_count, persalinan_count, persentase, years } = data;

        var options = {
            chart: {
                height: 350,
                type: "line",
                stacked: false
            },
            dataLabels: {
                enabled: false
            },
            colors: ['#006400', '#FF0000', '#FFFF00'],
            series: [
                {
                    name: 'Umum',
                    type: 'column',
                    data: umum_count,
                },
                {
                    name: "Persalinan",
                    type: 'column',
                    data: persalinan_count
                },
                {
                    name: "Persentase",
                    type: 'line',
                    data: persentase
                },
            ],
            stroke: {
                width: [4, 4, 4]
            },
            plotOptions: {
                bar: {
                    columnWidth: "20%"
                }
            },
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
                align: 'center'
            },
            legend: {
                horizontalAlign: "center",
                offsetX: 40
            }
        };

        var chart = new ApexCharts(document.querySelector("#baris"), options);
        chart.render();
    } catch (error) {
        console.error('Error fetching data:', error);
    }
}
