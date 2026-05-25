<div class="col-md-12">
            <div class="card card-outline card-primary">
              <div class="card-header">
                <h3 class="card-title"><?= $judul ?></h3>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <?php 
              session();
              $validation = \Config\Services::validation();
              ?>
              <?php echo form_open_multipart('Apotek/InsertData') ?>

                <div class="row">
                    <div class="col-sm-7">
                    <div class="form-group">
                <label>Nama Apotek</label>
                <input name="nama_apotek" value="<?= old('nama_apotek') ?>" class="form-control">
                <p class="text-danger"><?= $validation->hasError('nama_apotek') ? $validation->getError('nama_wilayah') : '' ?></p>
              </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="">--Pilih Status--</option>
                        <option value="Negeri">Negeri</option>
                        <option value="Swasta">Swasta</option>
                    </select>
                    <p class="text-danger"><?= $validation->hasError('status') ? $validation->getError('warna') : '' ?></p>
                  </div>                        
                </div>
              </div>

                <div class="form-group">
                <label>Coordinat Apotek</label>
                <div id="map" style="width:100%; height:500px;"></div>
                <input name="coordinat" value="<?= old('coordinat') ?>" class="form-control" readonly>
                <p class="text-danger"><?= $validation->hasError('coordinat') ? $validation->getError('nama_wilayah') : '' ?></p>
            </div>        
            <div class="row">
                <div class="col-sm-4">
                    <label>Provinsi</label>
                    <select name="provinsi" class="form-control">
                    </select>
                    <p class="text-danger"><?= $validation->hasError('provinsi') ? $validation->getError('warna') : '' ?></p>
                  </div>                        
                </div>
            </div>
            
            <button class="btn btn-primary btn-flat" type="submit">Simpan</button>
            <a href="<?= base_url('Wilayah') ?>"class="btn btn-success btn-flat">Kembali</a>

              <?php echo form_close() ?>

        </div>
    </div>
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
 center:[<?= $web['coordinat_kota'] ?>],
 zoom: [<?= $web['zoom_view'] ?>],
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
