<div id="map" style="width: 100%; height: 500px;"></div>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
var peta1 = L.tileLayer(
'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw',
{
    attribution: 'Map data © OpenStreetMap contributors, Imagery © Mapbox',
    id: 'mapbox/streets-v11'
});

var peta2 = L.tileLayer(
'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw',
{
    attribution: 'Map data © OpenStreetMap contributors, Imagery © Mapbox',
    id: 'mapbox/satellite-v9'
});

var peta3 = L.tileLayer(
'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
{
    attribution: '© OpenStreetMap contributors'
});

var peta4 = L.tileLayer(
'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw',
{
    attribution: 'Map data © OpenStreetMap contributors, Imagery © Mapbox',
    id: 'mapbox/dark-v10'
});

const map = L.map('map', {
    center: [-7.239401858334516, 108.98264289428558],
    zoom: 12,
    layers: [peta1]
});

const baseMaps = {
    "OpenStreetMap": peta1,
    "Satellite": peta2,
    "Streets": peta3,
    "Night": peta4
};

// WAJIB ADA walaupun kosong
const overlayMaps = {};

L.control.layers(baseMaps, overlayMaps).addTo(map);
</script>