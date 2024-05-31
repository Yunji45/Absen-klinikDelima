        //   var options = {
        //     chart: {
        //       height: 350,
        //       type: "line",
        //       stacked: false
        //     },
        //     dataLabels: {
        //       enabled: false
        //     },
        //     colors: ['#99C2A2', '#C5EDAC', '#66C7F4'],
        //     series: [
              
        //       {
        //         name: 'Umum',
        //         type: 'column',
        //         data: [21.1, 23, 33.1, 34, 44.1, 44.9, 56.5, 58.5]
        //       },
        //       {
        //         name: "Persalinan",
        //         type: 'column',
        //         data: [10, 19, 27, 26, 34, 35, 40, 38]
        //       },
        //       {
        //         name: "Persentase",
        //         type: 'line',
        //         data: [1.4, 2, 2.5, 1.5, 2.5, 2.8, 3.8, 4.6]
        //       },
        //     ],
        //     stroke: {
        //       width: [4, 4, 4]
        //     },
        //     plotOptions: {
        //       bar: {
        //         columnWidth: "20%"
        //       }
        //     },
        //     xaxis: {
        //       categories: [2017, 2018, 2019, 2020, 2021, 2022, 2023, 2024]
        //     },
        //     yaxis: [
        //       {
        //         seriesName: 'Column A',
        //         axisTicks: {
        //           show: true
        //         },
        //         axisBorder: {
        //           show: true,
        //         },
        //         title: {
        //           text: "Columns"
        //         }
        //       },
        //       {
        //         seriesName: 'Column A',
        //         show: false
        //       }, {
        //         opposite: true,
        //         seriesName: 'Line C',
        //         axisTicks: {
        //           show: true
        //         },
        //         axisBorder: {
        //           show: true,
        //         },
        //         title: {
        //           text: "Line"
        //         }
        //       }
        //     ],
        //     tooltip: {
        //       shared: false,
        //       intersect: true,
        //       x: {
        //         show: false
        //       }
        //     },
        //     title: {
        //               text: 'Trend Data Rawat Inap',
        //               align: 'left'
        //           },
        //     legend: {
        //       horizontalAlign: "left",
        //       offsetX: 40
        //     }
        //   };

        //   var chart = new ApexCharts(document.querySelector("#baris"), options);

        //   chart.render();

        // async function updateChart() {
        //     try {
        //         const response = await fetch('https://klinikmitradelima.com/api/api-layanan-ranap-bar');
        //         const data = await response.json();
        //         const { umum_count, persalinan_count, persentase, years } = data;
        
        //         var options = {
        //             chart: {
        //                 height: 350,
        //                 type: "line",
        //                 stacked: false
        //             },
        //             dataLabels: {
        //                 enabled: false
        //             },
        //             colors: ['#99C2A2', '#C5EDAC', '#66C7F4'],
        //             series: [
        //                 {
        //                     name: 'Umum',
        //                     type: 'column',
        //                     data: umum_count
        //                 },
        //                 {
        //                     name: "Persalinan",
        //                     type: 'column',
        //                     data: persalinan_count
        //                 },
        //                 {
        //                     name: "Persentase",
        //                     type: 'line',
        //                     data: persentase
        //                 },
        //             ],
        //             stroke: {
        //                 width: [4, 4, 4]
        //             },
        //             plotOptions: {
        //                 bar: {
        //                     columnWidth: "20%"
        //                 }
        //             },
        //             xaxis: {
        //                 categories: years
        //             },
        //             yaxis: [
        //                 {
        //                     seriesName: 'Column A',
        //                     axisTicks: {
        //                         show: true
        //                     },
        //                     axisBorder: {
        //                         show: true,
        //                     },
        //                     title: {
        //                         text: "Columns"
        //                     }
        //                 },
        //                 {
        //                     seriesName: 'Column A',
        //                     show: false
        //                 }, {
        //                     opposite: true,
        //                     seriesName: 'Line C',
        //                     axisTicks: {
        //                         show: true
        //                     },
        //                     axisBorder: {
        //                         show: true,
        //                     },
        //                     title: {
        //                         text: "Line"
        //                     }
        //                 }
        //             ],
        //             tooltip: {
        //                 shared: false,
        //                 intersect: true,
        //                 x: {
        //                     show: false
        //                 }
        //             },
        //             title: {
        //                 text: 'Trend Data Rawat Inap',
        //                 align: 'left'
        //             },
        //             legend: {
        //                 horizontalAlign: "left",
        //                 offsetX: 40
        //             }
        //         };
        
        //         var chart = new ApexCharts(document.querySelector("#baris"), options);
        //         chart.render();
        //     } catch (error) {
        //         console.error('Error fetching data:', error);
        //     }
        // }
        
        document.addEventListener('DOMContentLoaded', function() {
            updateChart();
        });
        
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
                    colors: ['#99C2A2', '#C5EDAC', '#66C7F4'],
                    series: [
                        {
                            name: 'Umum',
                            type: 'column',
                            data: umum_count
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
                        align: 'left'
                    },
                    legend: {
                        horizontalAlign: "left",
                        offsetX: 40
                    }
                };
        
                var chart = new ApexCharts(document.querySelector("#baris"), options);
                chart.render();
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        }
        