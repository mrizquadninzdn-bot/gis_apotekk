<div id="map" style="width: 100%; height: 500px;"></div>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
var peta1 = L.tileLayer(
'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
{
 attribution:'© OpenStreetMap'
});
});

var peta2 = L.tileLayer(
var peta1 = L.tileLayer(
'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
{
 attribution:'© OpenStreetMap'
});

var peta3 = L.tileLayer(
'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
{
    attribution: '© OpenStreetMap contributors'
});

var peta4 = L.tileLayer(
<div id="map" style="width:100%; height:500px;"></div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
var peta1 = L.tileLayer(
'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
{
    attribution: '&copy; OpenStreetMap contributors'
});

var peta2 = L.tileLayer(
'https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png',
{
    attribution: '&copy; OpenStreetMap contributors'
});

var peta3 = L.tileLayer(
'https://tiles.stadiamaps.com/tiles/alidade_smooth/{z}/{x}/{y}{r}.png',
{
    attribution: '&copy; Stadia Maps'
});

const map = L.map('map', {
    center: [-7.239401858334516, 108.98264289428558],
    zoom: 12,
    layers: [peta1]
});

const baseMaps = {
    "Standar": peta1,
    "HOT Map": peta2,
    "Smooth": peta3
};

const overlayMaps = {};

L.control.layers(baseMaps, overlayMaps).addTo(map);
</script>