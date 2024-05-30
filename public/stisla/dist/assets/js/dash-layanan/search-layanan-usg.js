document.addEventListener('DOMContentLoaded', function() {
    var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    var chart;

    fetchAvailableYears();

    async function fetchAvailableYears() {
        try {
            const response = await fetch('http://localhost:8000/api/api-tahun-usg');
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
            const response = await fetch(`http://localhost:8000/api/api-search-usg?year=${year}`);
            const data = await response.json();
            console.log('Data fetched:', data);
            updateChart(data.usg_per_month);
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    }

    function updateChart(usgData) {
        var categories = [];
        var dataSeriesUsg = [];

        for (var i = 1; i <= 12; i++) {
            categories.push(monthNames[i - 1]);
            dataSeriesUsg.push(usgData[i] ? usgData[i] : 0);
        }

        var options = {
            series: [
                { name: "USG", data: dataSeriesUsg ,color: "#008FFB"},
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
