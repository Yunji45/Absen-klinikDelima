document.addEventListener('DOMContentLoaded', function() {
    var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    var chart;

    fetchAvailableYears();

    async function fetchAvailableYears() {
        try {
            const response = await fetch('https://klinikmitradelima.com/api/api-tahun-estetika');
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
            const response = await fetch(`https://klinikmitradelima.com/api/api-search-estetika?year=${year}`);
            const data = await response.json();
            console.log('Data fetched:', data);
            updateChart(data.estetika_per_month);
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    }

    function updateChart(labData) {
        var categories = [];
        var dataSeriesLab = [];

        for (var i = 1; i <= 12; i++) {
            categories.push(monthNames[i - 1]);
            dataSeriesLab.push(labData[i] ? labData[i] : 0);
        }

        var options = {
            series: [
                { name: "Laboratorium", data: dataSeriesLab ,color: "#00E396"},
            ],
            chart: {
                height: 350,
                type: 'line',
                zoom: { enabled: false },
            },
            title: { text: 'Product Trend By Month', align: 'center' },
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
