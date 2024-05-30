document.addEventListener('DOMContentLoaded', function() {
    kode_wilayah();
    line_chart();
    pie_chart();
    gender();
    bar_chart();
});

// function pie_chart()
// {
//     var options = {
//         series: [44, 55, 41, 17, 15,48],
//         chart: {
//         width: 380,
//         type: 'donut',
//         dropShadow: {
//           enabled: true,
//           color: '#111',
//           top: -1,
//           left: 3,
//           blur: 3,
//           opacity: 0.2
//         },
//       },
//       stroke: {
//         width: 0,
//       },
//       plotOptions: {
//         pie: {
//           donut: {
//             labels: {
//               show: true,
//               total: {
//                 showAlways: true,
//                 show: true
//               }
//             }
//           }
//         }
//       },
//       labels: ["Rawat Jalan", "Rawat Inap", "Khitan", "Laboratorium", "USG","Estetika"],
//       dataLabels: {
//         dropShadow: {
//           blur: 3,
//           opacity: 0.8
//         }
//       },
//       fill: {
//       type: 'pattern',
//         opacity: 1,
//         pattern: {
//           enabled: true,
//           style: ['verticalLines', 'squares', 'horizontalLines', 'circles','slantedLines'],
//         },
//       },
//       states: {
//         hover: {
//           filter: 'none'
//         }
//       },
//       theme: {
//         palette: 'palette2'
//       },
//       title: {
//         text: "Contribution Visitors Type",
//         align: 'middle',
//       },
//       responsive: [{
//         breakpoint: 480,
//         options: {
//           chart: {
//             width: 200
//           },
//           legend: {
//             position: 'bottom'
//           }
//         }
//       }]
//       };
    
//       var chart = new ApexCharts(document.querySelector("#baris"), options);
//       chart.render();
// }
// function pie_chart() {
//     var options = {
//         series: [44, 55, 41, 17, 15, 48],
//         chart: {
//             width: 380,
//             type: 'donut',
//             dropShadow: {
//                 enabled: true,
//                 color: '#111',
//                 top: -1,
//                 left: 3,
//                 blur: 3,
//                 opacity: 0.2
//             },
//         },
//         stroke: {
//             width: 0,
//         },
//         plotOptions: {
//             pie: {
//                 donut: {
//                     labels: {
//                         show: true,
//                         total: {
//                             showAlways: true,
//                             show: true
//                         }
//                     }
//                 }
//             }
//         },
//         labels: ["Rawat Jalan", "Rawat Inap", "Khitan", "Laboratorium", "USG", "Estetika"],
//         dataLabels: {
//             dropShadow: {
//                 blur: 3,
//                 opacity: 0.8
//             }
//         },
//         fill: {
//             type: 'pattern',
//             opacity: 1,
//             pattern: {
//                 enabled: true,
//                 style: ['verticalLines', 'squares', 'horizontalLines', 'circles', 'slantedLines'],
//             },
//         },
//         states: {
//             hover: {
//                 filter: 'none'
//             }
//         },
//         theme: {
//             palette: 'palette2'
//         },
//         title: {
//             text: "Contribution Visitors Type",
//             align: 'center', // Align title to the center
//             margin: 10 // Add some margin to the title
//         },
//         responsive: [{
//             breakpoint: 480,
//             options: {
//                 chart: {
//                     width: 200
//                 },
//                 legend: {
//                     position: 'bottom'
//                 }
//             }
//         }]
//     };

//     var chart = new ApexCharts(document.querySelector("#baris"), options);
//     chart.render();
// }

function pie_chart() {
  // Mengambil data dari API
  fetch('http://localhost:8000/api/api-layanan-pie')
      .then(response => response.json())
      .then(data => {
          // Data yang diperoleh dari API
          var series = data.series;
          var labels = data.labels;

          // Options untuk grafik pie
          var options = {
              series: series,
              chart: {
                  width: 380,
                  type: 'donut',
                  dropShadow: {
                      enabled: true,
                      color: '#111',
                      top: -1,
                      left: 3,
                      blur: 3,
                      opacity: 0.2
                  },
              },
              stroke: {
                  width: 0,
              },
              plotOptions: {
                  pie: {
                      donut: {
                          labels: {
                              show: true,
                              total: {
                                  showAlways: true,
                                  show: true
                              }
                          }
                      }
                  }
              },
              labels: labels,
              dataLabels: {
                  dropShadow: {
                      blur: 3,
                      opacity: 0.8
                  }
              },
              fill: {
                  type: 'pattern',
                  opacity: 1,
                  pattern: {
                      enabled: true,
                      style: ['verticalLines', 'squares', 'horizontalLines', 'circles', 'slantedLines'],
                  },
              },
              states: {
                  hover: {
                      filter: 'none'
                  }
              },
              theme: {
                  palette: 'palette2'
              },
              title: {
                  text: "Contribution Visitors Type",
                  align: 'center', // Align title to the center
                  margin: 10 // Add some margin to the title
              },
              responsive: [{
                  breakpoint: 480,
                  options: {
                      chart: {
                          width: 200
                      },
                      legend: {
                          position: 'bottom'
                      }
                  }
              }]
          };

          // Membuat grafik pie
          var chart = new ApexCharts(document.querySelector("#baris"), options);
          chart.render();
      })
      .catch(error => {
          console.error('Error fetching data:', error);
      });
}

// function bar_chart()
// {
//     var options = {
//         series: [
//         {
//           name: "",
//           data: [200, 330, 548, 740, 880, 990],
//         },
//       ],
//         chart: {
//         type: 'bar',
//         height: 350,
//       },
//       plotOptions: {
//         bar: {
//           borderRadius: 0,
//           horizontal: true,
//           distributed: true,
//           barHeight: '80%',
//           isFunnel: true,
//         },
//       },
//       colors: [
//         '#F44F5E',
//         '#E55A89',
//         '#D863B1',
//         '#CA6CD8',
//         '#B57BED',
//         '#8D95EB',
//       ],
//       dataLabels: {
//         enabled: true,
//         formatter: function (val, opt) {
//           return opt.w.globals.labels[opt.dataPointIndex] 
//         },
//         dropShadow: {
//           enabled: true,
//         },
//       },
//       title: {
//         text: 'Visitors Pyramid Chart',
//         align: 'middle',
//       },
//       xaxis: {
//         categories: ['Rawat Jalan','Rawat Inap','Khitan','Laboratorium','USG','Estetika'],
//       },
//       legend: {
//         show: false,
//       },
//       };

//       var chart = new ApexCharts(document.querySelector("#baris-2"), options);
//       chart.render();
    
    
  
// }
function bar_chart() {
  // Mengambil data dari API
  fetch('http://localhost:8000/api/api-layanan-piramid')
      .then(response => response.json())
      .then(data => {
          // Data yang diperoleh dari API
          var seriesData = data.series[0].data;
          var categories = data.categories;

          // Options untuk grafik bar
          var options = {
              series: [
                  {
                      name: "",
                      data: seriesData,
                  },
              ],
              chart: {
                  type: 'bar',
                  height: 350,
              },
              plotOptions: {
                  bar: {
                      borderRadius: 0,
                      horizontal: true,
                      distributed: true,
                      barHeight: '80%',
                      isFunnel: true,
                  },
              },
              colors: [
                  '#F44F5E',
                  '#E55A89',
                  '#D863B1',
                  '#CA6CD8',
                  '#B57BED',
                  '#8D95EB',
              ],
              dataLabels: {
                  enabled: true,
                  formatter: function (val, opt) {
                      return opt.w.globals.labels[opt.dataPointIndex];
                  },
                  dropShadow: {
                      enabled: true,
                  },
              },
              title: {
                  text: 'Visitors Pyramid Chart',
                  align: 'middle',
              },
              xaxis: {
                  categories: categories,
              },
              legend: {
                  show: false,
              },
          };

          // Membuat grafik bar
          var chart = new ApexCharts(document.querySelector("#baris-2"), options);
          chart.render();
      })
      .catch(error => {
          console.error('Error fetching data:', error);
      });
}

function line_chart()
{
    var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

          // Inisialisasi grafik
          fetchData();

          async function fetchData() {
              try {
                  const response = await fetch('http://localhost:8000/api/api-layanan');
                  const data = await response.json();
                  updateChart(data.rajal_per_month, data.ranap_per_month, data.khitan_per_month, data.persalinan_per_month);
              } catch (error) {
                  console.error('Error fetching data:', error);
              }
          }

          function updateChart(rajalData, ranapData, khitanData, persalinanData) {
              var categories = [];
              var dataSeriesRajal = [];
              var dataSeriesRanap = [];
              var dataSeriesKhitan = [];
              var dataSeriesPersalinan = [];
              // Loop untuk setiap bulan
              for (var i = 1; i <= 12; i++) {
                  categories.push(monthNames[i - 1]);
                  // Mendapatkan data kunjungan per bulan
                  var rajal = rajalData[i] ? rajalData[i] : 0;
                  var ranap = ranapData[i] ? ranapData[i] : 0;
                  var khitan = khitanData[i] ? khitanData[i] : 0;
                  var persalinan = persalinanData[i] ? persalinanData[i] : 0;

                  dataSeriesRajal.push(rajal);
                  dataSeriesRanap.push(ranap);
                  dataSeriesKhitan.push(khitan);
                  dataSeriesPersalinan.push(persalinan);
              }

              var options = {
                  series: [
                      {
                          name: "Rajal",
                          data: dataSeriesRajal
                      },
                      {
                          name: "Ranap",
                          data: dataSeriesRanap
                      },
                      {
                          name: "Khitan",
                          data: dataSeriesKhitan
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
                  // Sisanya adalah konfigurasi grafik
                  // ...
              };

              var chart = new ApexCharts(document.querySelector("#chart"), options);
              chart.render();
          }
}

function kode_wilayah() {
    var kodeWilayah = [
        { id: 1, nama: "Ciamis", kode: "11" },
        { id: 2, nama: "Banjarsari", kode: "12" },
        { id: 3, nama: "Sukajadi", kode: "13" },
        { id: 4, nama: "Sukamukti", kode: "14" }
        // Tambahkan data wilayah lain di sini jika diperlukan
    ];

    // Fungsi untuk menambahkan daftar wilayah ke dalam elemen HTML
    function tambahkanDaftarWilayah() {
        var daftarWilayahElem = document.getElementById("daftarWilayah");
        var titleElem = document.createElement("h5"); // Buat elemen judul
        titleElem.textContent = "Test API Kemendagri Daftar Kode Wilayah JABAR dan JATENG Untuk Pemetaan Wilayah"; // Isi teks judul
        daftarWilayahElem.appendChild(titleElem); // Tambahkan judul ke dalam elemen daftarWilayah

        kodeWilayah.forEach(function(wilayah) {
            var li = document.createElement("li");
            li.textContent = wilayah.nama + " (Kode: " + wilayah.kode + ")";
            li.classList.add("wilayah-" + wilayah.id); // Tambahkan kelas warna sesuai dengan id wilayah
            li.style.color = getColorById(wilayah.id); // Set warna teks sesuai dengan id wilayah
            daftarWilayahElem.appendChild(li);
        });
    }

    // Fungsi untuk mendapatkan warna berdasarkan id wilayah
    function getColorById(id) {
        switch(id) {
            case 1:
                return "red"; // Misalnya, wilayah dengan id 1 akan berwarna merah
            case 2:
                return "blue"; // Misalnya, wilayah dengan id 2 akan berwarna biru
            case 3:
                return "green"; // Misalnya, wilayah dengan id 3 akan berwarna hijau
            case 4:
                return "orange"; // Misalnya, wilayah dengan id 4 akan berwarna orange
            default:
                return "black"; // Default warna hitam
        }
    }

    // Panggil fungsi untuk menambahkan daftar wilayah
    tambahkanDaftarWilayah();
}

// function gender()
// {
//     var options = {
//         series: [{
//         name: 'Laki-Laki',
//         data: [0.4, 0.65, 0.76, 0.88, 1.5, 2.1, 2.9, 3.8, 3.9, 4.2, 4, 4.3, 4.1, 4.2, 4.5,
//           3.9, 3.5, 3
//         ]
//       },
//       {
//         name: 'Perempuan',
//         data: [-0.8, -1.05, -1.06, -1.18, -1.4, -2.2, -2.85, -3.7, -3.96, -4.22, -4.3, -4.4,
//           -4.1, -4, -4.1, -3.4, -3.1, -2.8
//         ]
//       }
//       ],
//         chart: {
//         type: 'bar',
//         height: 440,
//         stacked: true
//       },
//       colors: ['#008FFB', '#FF4560'],
//       plotOptions: {
//         bar: {
//           borderRadius: 5,
//           borderRadiusApplication: 'end', // 'around', 'end'
//           borderRadiusWhenStacked: 'all', // 'all', 'last'
//           horizontal: true,
//           barHeight: '80%',
//         },
//       },
//       dataLabels: {
//         enabled: false
//       },
//       stroke: {
//         width: 1,
//         colors: ["#fff"]
//       },
      
//       grid: {
//         xaxis: {
//           lines: {
//             show: false
//           }
//         }
//       },
//       yaxis: {
//         stepSize: 1
//       },
//       tooltip: {
//         shared: false,
//         x: {
//           formatter: function (val) {
//             return val
//           }
//         },
//         y: {
//           formatter: function (val) {
//             return Math.abs(val) + "%"
//           }
//         }
//       },
//       title: {
//         text: 'Population With Gender',
//         align: 'center'
//       },
//       xaxis: {
//         categories: ['85+', '80-84', '75-79', '70-74', '65-69', '60-64', '55-59', '50-54',
//           '45-49', '40-44', '35-39', '30-34', '25-29', '20-24', '15-19', '10-14', '5-9',
//           '0-4'
//         ],
//         title: {
//           text: 'Persentase'
//         },
//         labels: {
//           formatter: function (val) {
//             return Math.abs(Math.round(val)) + "%"
//           }
//         }
//       },
//       };

//       var chart = new ApexCharts(document.querySelector("#gender"), options);
//       chart.render();
// }
function gender() {
  // Lakukan permintaan HTTP ke endpoint API
  fetch('http://localhost:8000/api/api-layanan-gender')
      .then(response => response.json())
      .then(data => {
          // Proses data yang diterima
          const { khitan, ranap, rajal } = data;

          // Ubah struktur data menjadi sesuai dengan format yang diperlukan oleh grafik
          const lakiLakiData = [];
          const perempuanData = [];

          Object.keys(khitan).forEach(year => {
              lakiLakiData.push(khitan[year]['Laki-laki']);
              perempuanData.push(khitan[year]['Perempuan']);
          });

          Object.keys(ranap).forEach(year => {
              lakiLakiData.push(ranap[year]['Laki-laki']);
              perempuanData.push(ranap[year]['Perempuan']);
          });

          Object.keys(rajal).forEach(year => {
              lakiLakiData.push(rajal[year]['Laki-laki']);
              perempuanData.push(rajal[year]['Perempuan']);
          });

          // Buat konfigurasi grafik dengan data yang telah diproses
          var options = {
              series: [
                  {
                      name: 'Laki-Laki',
                      data: lakiLakiData
                  },
                  {
                      name: 'Perempuan',
                      data: perempuanData
                  }
              ],
              chart: {
                  type: 'bar',
                  height: 440,
                  stacked: true
              },
              colors: ['#008FFB', '#FF4560'],
              plotOptions: {
                  bar: {
                      borderRadius: 5,
                      borderRadiusApplication: 'end', // 'around', 'end'
                      borderRadiusWhenStacked: 'all', // 'all', 'last'
                      horizontal: true,
                      barHeight: '60%',
                  },
              },
              dataLabels: {
                  enabled: false
              },
              stroke: {
                  width: 1,
                  colors: ["#fff"]
              },
              grid: {
                  xaxis: {
                      lines: {
                          show: false
                      }
                  }
              },
              yaxis: {
                  stepSize: 1
              },
              tooltip: {
                  shared: false,
                  x: {
                      formatter: function (val) {
                          return val
                      }
                  },
                  y: {
                      formatter: function (val) {
                          return Math.abs(val) 
                      }
                  }
              },
              title: {
                  text: 'Population With Gender',
                  align: 'center'
              },
              xaxis: {
                  categories: Object.keys(khitan), // Menggunakan tahun sebagai kategori x-axis
                  title: {
                      text: 'Persentase'
                  },
                  labels: {
                      formatter: function (val) {
                          return Math.abs(Math.round(val)) + "%"
                      }
                  }
              },
          };

          // Render grafik dengan konfigurasi yang telah dibuat
          var chart = new ApexCharts(document.querySelector("#gender"), options);
          chart.render();
      })
      .catch(error => {
          // Tangani kesalahan jika ada
          console.error('Error fetching data:', error);
      });
}


