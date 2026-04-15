<div class="col-md-12">
  <div class="card card-outline card-primary">
    <div class="card-header">
      <h3 class="card-title"><?= $judul ?></h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
          <i class="fas fa-minus"></i>
        </button>
      </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">
                
      <?php echo form_open() ?>

      <div class="row">
        <div class="col-sm-7">
          <div class="form-group">
            <label>Nama Website</label>
            <input name="nama_web" class="form-control" placeholder="Nama Website">
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <label>Coordinat Kota</label>
            <input name="coordinat_kota" class="form-control" placeholder="Coordinat Kota">
          </div>
        </div>

        <div class="col-sm-2">
          <div class="form-group">
            <label>Zoom View</label>
            <input type="number" name="coordinat_kota" min="0" max="20" class="form-control" placeholder="Coordinat Kota">
          </div>
        </div>
      </div>

      <button class="btn btn-primary" type="submit" >Simpan</button>

      <?php echo form_close() ?>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>



<div class="col-md-12">
    <div id="map" style="width:100%; height:500px;"></div>
</div>

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