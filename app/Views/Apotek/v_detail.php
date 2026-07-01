<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div id="map" style="width:100%; height:500px; margin-bottom: 10px;"></div>
                </div>

                <div class="col-sm-6">
                    <img src="<?= base_url('foto/' . $apotek['foto']) ?>" style="width: 100%; height: 500px; object-fit: cover; border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);" alt="Foto Apotek">                </div>

                <div class="col-sm-12">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nama Apotek</th>
                            <th width="30px">:</th>
                            <td><?= $apotek['nama_apotek'] ?></td>
                        <tr>
                        <tr>
                            <th>Jenjang Sekolah</th>
                            <th>:</th>
                            <td><?= $apotek['jenjang'] ?></td>
                        <tr>
                        <tr>
                            <th>Status Sekolah</th>
                            <th>:</th>
                            <td><?= $apotek['status'] ?></td>
                        <tr>
                        <tr>
                            <th>Alamat Sekolah</th>
                            <th>:</th>
                            <td><?= $apotek['alamat'] ?>, <?= $apotek['nama_kecamatan'] ?>, <?= $apotek['nama_kabupaten'] ?>, <?= $apotek['nama_provinsi'] ?></td>
                        <tr>
                    </table>
                    <a href="<?= base_url('Apotek') ?>" class="btn btn-success btn-flat">Kembali</a>
                </div>
</div>

<script>
var peta1 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {});
var peta2 = L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {});
var peta3 = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {});
var peta4 = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {});
var petaSatelit = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {});

const map = L.map('map',{
 center:[parseFloat("<?= $apotek['latitude'] ?>"), parseFloat("<?= $apotek['longitude'] ?>")],
 zoom: 16, 
 layers:[petaSatelit] // <--- Ubah dari petaSatelit menjadi peta1 dulu untuk tes
});

const baseMaps={
 "Standar":peta1,
 "HOT Map":peta2,
 "Light":peta3,
 "Dark":peta4, 
 "Satelit":petaSatelit
};

L.geoJSON(<?= $apotek['geojson'] ?>, {
            fillColor: '<?= $apotek['warna'] ?>',
            fillOpacity: 0.7,
        })
        .bindPopup("<b><?= $apotek['nama_wilayah'] ?></b>")
        .addTo(map);

var icon = L.icon({
    iconUrl: '<?= base_url('marker/' . ($apotek['marker'] ?? 'default.png')) ?>',
    iconSize: [40, 45],
});
L.marker([parseFloat("<?= $apotek['latitude'] ?>"), parseFloat("<?= $apotek['longitude'] ?>")], {
    icon : icon
}).addTo(map);


</script>