document.addEventListener('DOMContentLoaded', function() {
    var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    var chart;

    fetchAvailableYears();

    async function fetchAvailableYears() {
        try {
            const response = await fetch('http://localhost:8000/api/api-tahun-rajal');
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
            const response = await fetch(`http://localhost:8000/api/api-search-rajal?year=${year}`);
            const data = await response.json();
            console.log('Data fetched:', data);
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

        for (var i = 1; i <= 12; i++) {
            categories.push(monthNames[i - 1]);
            dataSeriesUmum.push(umumData[i] ? umumData[i] : 0);
            dataSeriesKB.push(kbData[i] ? kbData[i] : 0);
            dataSeriesImunisasi.push(imunisasiData[i] ? imunisasiData[i] : 0);
            dataSeriesSehat.push(sehatData[i] ? sehatData[i] : 0);
            dataSeriesHamil.push(hamilData[i] ? hamilData[i] : 0);
        }

        var options = {
            series: [
                { name: "Umum", data: dataSeriesUmum },
                { name: "KB", data: dataSeriesKB },
                { name: "Imunisasi", data: dataSeriesImunisasi },
                { name: "Keterangan Sehat", data: dataSeriesSehat },
                { name: "Ibu Hamil", data: dataSeriesHamil }
            ],
            chart: {
                height: 350,
                type: 'line',
                zoom: { enabled: false },
            },
            title: { text: 'Trend Data Layanan', align: 'center' },
            xaxis: { categories: categories }
        };

        if (chart) {
            chart.updateOptions(options);
        } else {
            chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        }
    }

    // document.getElementById('year').addEventListener('change', function() {
    //     var selectedYear = this.value;
    //     fetchData(selectedYear);
    // });
    document.getElementById('year').addEventListener('change', function() {
        var selectedYear = this.value;
        console.log(`Year selected: ${selectedYear}`);
        fetchData(selectedYear);
    });

});
