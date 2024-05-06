var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

// Inisialisasi grafik
fetchData();

async function fetchData() {
    try {
        const response = await fetch('http://localhost:8000/api/api-layanan-ranap-line');
        const data = await response.json();
        updateChart(data.umum_per_month, data.persalinan_per_month);
    } catch (error) {
        console.error('Error fetching data:', error);
    }
}

function updateChart(umumData, persalinanData) {
    var categories = [];
    var dataSeriesUmum = [];
    var dataSeriesPersalinan = [];

    // Loop untuk setiap bulan
    for (var i = 1; i <= 12; i++) {
        categories.push(monthNames[i - 1]);
        // Mendapatkan data kunjungan per bulan
        var umum = umumData[i] ? umumData[i] : 0;
        var persalinan = persalinanData[i] ? persalinanData[i] : 0;

        dataSeriesUmum.push(umum);
        dataSeriesPersalinan.push(persalinan);
    }

    var options = {
        series: [
            {
                name: "Umum",
                data: dataSeriesUmum
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
