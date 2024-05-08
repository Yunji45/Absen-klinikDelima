document.addEventListener('DOMContentLoaded', function() {
    kode_wilayah();
    line_chart();
    pie_chart();
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
function pie_chart() {
    var options = {
        series: [44, 55, 41, 17, 15, 48],
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
        labels: ["Rawat Jalan", "Rawat Inap", "Khitan", "Laboratorium", "USG", "Estetika"],
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

    var chart = new ApexCharts(document.querySelector("#baris"), options);
    chart.render();
}

function bar_chart()
{
    var options = {
        series: [
        {
          name: "",
          data: [200, 330, 548, 740, 880, 990],
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
          return opt.w.globals.labels[opt.dataPointIndex] 
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
        categories: ['Rawat Jalan','Rawat Inap','Khitan','Laboratorium','USG','Estetika'],
      },
      legend: {
        show: false,
      },
      };

      var chart = new ApexCharts(document.querySelector("#baris-2"), options);
      chart.render();
    
    
  
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
        titleElem.textContent = "Test API Daftar Kode Wilayah JABAR dan JATENG Untuk Pemetaan Wilayah"; // Isi teks judul
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

