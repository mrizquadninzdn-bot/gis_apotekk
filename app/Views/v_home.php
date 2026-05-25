<div id="map" style="width:100%; height:500px;"></div>

<link rel="stylesheet"
href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>

// standar OSM
var peta1 = L.tileLayer(
'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
{
});

// OSM Humanitarian (HOT)
var peta2 = L.tileLayer(
'https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png',
{
});

// Carto Light
var peta3 = L.tileLayer(
'https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png',
{
});

// Carto Dark
var peta4 = L.tileLayer(
'https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png',
{
});

var petaSatelit = L.tileLayer(
'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}',
{
});

// tampilkan map
const map = L.map('map',{
 center:[<?= $web['coordinat_kota'] ?>],
 zoom: [<?= $web['zoom_view'] ?>],
 layers:[peta1]
});

// pilihan layer
const baseMaps={
 "Standar":peta1,
 "HOT Map":peta2,
 "Light":peta3,
 "Dark":peta4,
 "Satelit":petaSatelit
};

L.control.layers(baseMaps).addTo(map);

// contoh marker
L.marker([-7.239401858334516,108.98264289428558])
.addTo(map)
.bindPopup("Lokasi Apotek");
<?php foreach ($wilayah as $key => $value) { ?>
        L.geoJSON(<?= $value['geojson'] ?>, {
            fillColor: '<?= $value['warna'] ?>',
            fillOpacity: 0.7,
        })
        .bindPopup("<b><?= $value['nama_wilayah'] ?></b>")
        .addTo(map);
    <?php } ?>

</script>