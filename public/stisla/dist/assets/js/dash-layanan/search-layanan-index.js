document.addEventListener('DOMContentLoaded', function() {
    var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    var chart;

    // Inisialisasi grafik
    fetchAvailableYears();

    async function fetchAvailableYears() {
        try {
            const response = await fetch('https://klinikmitradelima.com/api/api-tahun-layanan');
            const years = await response.json();
            const yearSelect = document.getElementById('year');

            years.forEach(year => {
                const option = document.createElement('option');
                option.value = year;
                option.textContent = year;
                yearSelect.appendChild(option);
            });

            // Fetch data for the initial year
            fetchData(years[0]);
        } catch (error) {
            console.error('Error fetching available years:', error);
        }
    }

    async function fetchData(year = new Date().getFullYear()) {
        console.log(`Fetching data for year: ${year}`);
        try {
            const response = await fetch(`https://klinikmitradelima.com/api/api-search-layanan?year=${year}`);
            const data = await response.json();
            console.log('Data fetched:', data);
            updateChart(data.rajal_per_month, data.ranap_per_month, data.khitan_per_month, data.lab_per_month, data.usg_per_month, data.usg_per_month);
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    }

    function updateChart(rajalData, ranapData, khitanData, labData , usgData, estetikaData) {
        var categories = [];
        var dataSeriesRajal = [];
        var dataSeriesRanap = [];
        var dataSeriesKhitan = [];
        var dataSeriesLab = [];
        var dataSeriesUsg = [];
        var dataSeriesEstetika = [];


        // Loop untuk setiap bulan
        for (var i = 1; i <= 12; i++) {
            categories.push(monthNames[i - 1]);

            // Mendapatkan data kunjungan per bulan
            var rajal = rajalData[i] ? rajalData[i] : 0;
            var ranap = ranapData[i] ? ranapData[i] : 0;
            var khitan = khitanData[i] ? khitanData[i] : 0;
            var lab = labData[i] ? labData[i] : 0;
            var usg = usgData[i] ? usgData[i] : 0;
            var estetika = estetikaData[i] ? estetikaData[i] : 0;


            dataSeriesRajal.push(rajal);
            dataSeriesRanap.push(ranap);
            dataSeriesKhitan.push(khitan);
            dataSeriesLab.push(lab);
            dataSeriesUsg.push(usg);
            dataSeriesEstetika.push(estetika);
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
                    name: "Lab",
                    data: dataSeriesLab
                },
                {
                    name: "Usg",
                    data: dataSeriesUsg
                },
                {
                    name: "Estetika",
                    data: dataSeriesEstetika
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
                text: 'Trend Data 6 Sub Layanan',
                align: 'center'
            },
            xaxis: {
                categories: categories
            }
        };

        if (chart) {
            chart.updateOptions(options);
        } else {
            chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        }
    }

    document.getElementById('year').addEventListener('change', function() {
        var selectedYear = this.value;
        console.log(`Year selected: ${selectedYear}`);
        fetchData(selectedYear);
    });
});
