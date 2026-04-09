<div id="map" style="width: 100%; height: 500px;"></div>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>

// layer peta
var peta1 = L.tileLayer(
'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
{
 attribution:'© OpenStreetMap contributors'
});

var peta2 = L.tileLayer(
'https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png',
{
 attribution:'© OpenStreetMap contributors'
});

var peta3 = L.tileLayer(
'https://tiles.stadiamaps.com/tiles/alidade_smooth/{z}/{x}/{y}{r}.png',
{
 attribution:'© Stadia Maps'
});

var peta4 = L.tileLayer(
'https://tiles.stadiamaps.com/tiles/alidade_smooth_dark/{z}/{x}/{y}{r}.png',
{
 attribution:'© Stadia Maps'
});

// tampilkan map
const map = L.map('map', {
 center: [-7.239401858334516, 108.98264289428558],
 zoom: 12,
 layers: [peta1]
});

// pilihan layer
const baseMaps = {
 "Standar": peta1,
 "HOT Map": peta2,
 "Smooth": peta3,
 "Dark": peta4
};

const overlayMaps = {};

L.control.layers(baseMaps, overlayMaps).addTo(map);

</script>