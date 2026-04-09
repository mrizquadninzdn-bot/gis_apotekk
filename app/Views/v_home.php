<div id="map" style="width:100%; height:500px;"></div>

<link rel="stylesheet"
href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>

// standar OSM
var peta1 = L.tileLayer(
'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
{
 attribution:'© OpenStreetMap contributors'
});

// OSM Humanitarian (HOT)
var peta2 = L.tileLayer(
'https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png',
{
 attribution:'© OpenStreetMap contributors'
});

// Carto Light
var peta3 = L.tileLayer(
'https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png',
{
 attribution:'© Carto'
});

// Carto Dark
var peta4 = L.tileLayer(
'https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png',
{
 attribution:'© Carto'
});

// tampilkan map
const map = L.map('map',{
 center:[-7.239401858334516,108.98264289428558],
 zoom:13,
 layers:[peta1]
});

// pilihan layer
const baseMaps={
 "Standar":peta1,
 "HOT Map":peta2,
 "Light":peta3,
 "Dark":peta4
};

L.control.layers(baseMaps).addTo(map);

// contoh marker
L.marker([-7.239401858334516,108.98264289428558])
.addTo(map)
.bindPopup("Lokasi Apotek");

</script>