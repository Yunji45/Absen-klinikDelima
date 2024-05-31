var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

            // Inisialisasi grafik
            fetchData();

            async function fetchData() {
                try {
                    const response = await fetch('https://klinikmitradelima.com/api/api-layanan-rajal');
                    const data = await response.json();
                    updateChart(data.umum_per_month, data.kb_per_month, data.imunisasi_per_month, data.sehat_per_month, data.hamil_per_month);
                } catch (error) {
                    console.error('Error fetching data:', error);
                }
            }

            function updateChart(umumData, kbData, imunisasiData, sehatData, hamilData) {
                var categories = [];
                var dataSeriesUmum = [];
                var dataSeriesKB = [];
                var dataSeriesImunisasi = [];
                var dataSeriesSehat = [];
                var dataSeriesHamil = [];

                // Loop untuk setiap bulan
                for (var i = 1; i <= 12; i++) {
                    categories.push(monthNames[i - 1]);
                    // Mendapatkan data kunjungan per bulan
                    var umum = umumData[i] ? umumData[i] : 0;
                    var kb = kbData[i] ? kbData[i] : 0;
                    var imunisasi = imunisasiData[i] ? imunisasiData[i] : 0;
                    var sehat = sehatData[i] ? sehatData[i] : 0;
                    var hamil = hamilData[i] ? hamilData[i] : 0;

                    dataSeriesUmum.push(umum);
                    dataSeriesKB.push(kb);
                    dataSeriesImunisasi.push(imunisasi);
                    dataSeriesSehat.push(sehat);
                    dataSeriesHamil.push(hamil);
                }

                var options = {
                    series: [
                        {
                            name: "Umum",
                            data: dataSeriesUmum
                        },
                        {
                            name: "KB",
                            data: dataSeriesKB
                        },
                        {
                            name: "Imunisasi",
                            data: dataSeriesImunisasi
                        },
                        {
                            name: "Keterangan Sehat",
                            data: dataSeriesSehat
                        },
                        {
                            name: "Ibu Hamil",
                            data: dataSeriesHamil
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