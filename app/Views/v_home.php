<div id="map" style="width:100%; height:500px;"></div>

<link rel="stylesheet"
href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>

var peta1 = L.tileLayer(
'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
{
 attribution:'© OpenStreetMap contributors'
});

const map = L.map('map',{
 center:[-7.239401858334516,108.98264289428558],
 zoom:13,
 layers:[peta1]
});

L.marker([-7.239401858334516,108.98264289428558])
.addTo(map)
.bindPopup("Lokasi Apotek");

</script>