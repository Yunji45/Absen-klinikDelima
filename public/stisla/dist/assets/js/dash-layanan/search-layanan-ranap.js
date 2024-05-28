document.addEventListener('DOMContentLoaded', function() {
    var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    var chart;

    fetchAvailableYears();

    async function fetchAvailableYears() {
        try {
            const response = await fetch('http://localhost:8000/api/api-tahun-ranap');
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
            const response = await fetch(`http://localhost:8000/api/api-search-ranap?year=${year}`);
            const data = await response.json();
            console.log('Data fetched:', data);
            updateChart(data.umum_per_month, data.persalinan_per_month);
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    }

    function updateChart(umumData, persalinanData) {
        var categories = [];
        var dataSeriesUmum = [];
        var dataSeriesPersalinan = [];

        for (var i = 1; i <= 12; i++) {
            categories.push(monthNames[i - 1]);
            dataSeriesUmum.push(umumData[i] ? umumData[i] : 0);
            dataSeriesPersalinan.push(persalinanData[i] ? persalinanData[i] : 0);
        }

        var options = {
            series: [
                { name: "Umum", data: dataSeriesUmum ,color: "#FF0000"},
                { name: "Persalinan", data: dataSeriesPersalinan,color: "#006400" }
            ],
            chart: {
                height: 350,
                type: 'line',
                zoom: { enabled: false },
            },
            title: { text: 'Trend Data Layanan Rawat Inap', align: 'center' },
            xaxis: { categories: categories }
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
