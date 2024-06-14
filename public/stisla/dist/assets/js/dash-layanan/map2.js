// Inisialisasi peta
const map = L.map('map').setView([-6.9854865, 109.3917492], 8);

// Menambahkan lapisan tile dari OpenStreetMap
const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://portofolio-ihya.netlify.app">Ihya Natik W</a>'
}).addTo(map);

// Kontrol untuk menampilkan informasi
const info = L.control();

info.onAdd = function () {
    this._div = L.DomUtil.create('div', 'info');
    this.update();
    return this._div;
};

info.update = function (props) {
    const contents = props ? `<b>${props.name}</b>` : 'Klinik Mitra Delima';
    this._div.innerHTML = `<h4>Area Coverage</h4>${contents}`;
};

info.addTo(map);

// Fungsi untuk menentukan warna
function getColor(d) {
    return d > 1000 ? '#800026' :
        d > 500 ? '#BD0026' :
        d > 200 ? '#E31A1C' :
        d > 100 ? '#FC4E2A' :
        d > 50 ? '#FD8D3C' :
        d > 20 ? '#FEB24C' :
        d > 10 ? '#FED976' :
        '#FFEDA0';
}

// Fungsi untuk menentukan gaya
function style(feature) {
    // Menentukan warna berdasarkan properti name
    let fillColor;
    if (feature.properties.name.includes("Kabupaten")) {
        fillColor = 'blue'; // Warna untuk kabupaten
    } else {
        fillColor = 'red'; // Warna untuk kota
    }

    return {
        radius: 8, // Ukuran titik
        fillColor: fillColor, // Warna titik
        color: "#000", // Warna garis tepi
        weight: 1, // Ketebalan garis tepi
        opacity: 1, // Opasitas garis tepi
        fillOpacity: 0.8 // Opasitas dari pengisian area
    };
}

// Fungsi untuk menyoroti fitur
function highlightFeature(e) {
    const layer = e.target;

    layer.setStyle({
        weight: 5,
        color: '#666',
        dashArray: '',
        fillOpacity: 0.7
    });

    layer.bringToFront();

    info.update(layer.feature.properties);
}

// Fungsi untuk mereset sorotan
function resetHighlight(e) {
    geojson.resetStyle(e.target);
    info.update();
}

// Fungsi untuk zoom ke fitur
function zoomToFeature(e) {
    map.fitBounds(e.target.getBounds());
}

// Fungsi untuk setiap fitur
function onEachFeature(feature, layer) {
    layer.on({
        mouseover: highlightFeature,
        mouseout: resetHighlight,
        click: function (e) {
            const props = e.target.feature.properties;
            const content = `
                <b>${props.name}</b><br>
                Rajal: ${props.rajal}<br>
                Ranap: ${props.ranap}<br>
                Khitan: ${props.khitan}<br>
                USG: ${props.usg}<br>
                Lab: ${props.lab}<br>
                Estetika: ${props.estetika}
            `;
            L.popup()
                .setLatLng(e.latlng)
                .setContent(content)
                .openOn(map);
        }
    });
}

// Membuat layer GeoJSON dari data yang diambil dari server
let geojsonData;
let geojson;

fetch('https://klinikmitradelima.com/api/api-map')
    .then(response => response.json())
    .then(data => {
        geojsonData = data;
        geojson = L.geoJson(geojsonData, {
            style,
            onEachFeature
        }).addTo(map);

        // Kontrol untuk pencarian
        const searchControl = new L.Control.Search({
            layer: geojson,
            propertyName: 'name',
            marker: false,
            moveToLocation: function (latlng, title) {
                map.setView(latlng, 12); // Sesuaikan tingkat zoom sesuai kebutuhan
            }
        });

        searchControl.on('search:locationfound', function (e) {
            e.layer.setStyle({
                weight: 3,
                color: '#0f0',
                dashArray: '',
                fillOpacity: 0.7
            });
            if (e.layer._popup) e.layer.openPopup();
        }).on('search:collapsed', function () {
            geojson.eachLayer(function (layer) {
                geojson.resetStyle(layer);
            });
        });

        map.addControl(searchControl);

    })
    .catch(error => {
        console.error('Error fetching GeoJSON:', error);
    });

// Menambahkan atribusi untuk data
map.attributionControl.addAttribution('Data Kunjungan &copy; <a href="http://klinikmitradelima.com/">Klinik Mitradelima</a>');

// Kontrol untuk legenda
const legend = L.control({ position: 'bottomright' });

legend.onAdd = function () {
    const div = L.DomUtil.create('div', 'info legend');
    const grades = [0, 10, 20, 50, 100, 200, 500, 1000];
    const labels = [];
    let from, to;

    for (let i = 0; i < grades.length; i++) {
        from = grades[i];
        to = grades[i + 1];

        labels.push(`<i style="background:${getColor(from + 1)}"></i> ${from}${to ? `&ndash;${to}` : '+'}`);
    }

    div.innerHTML = labels.join('<br>');
    return div;
};

legend.addTo(map);
