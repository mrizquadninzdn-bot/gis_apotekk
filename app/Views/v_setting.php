<div class="col-md-12">
  <div class="card card-outline card-primary">
    <div class="card-header">
      <h3 class="card-title"><?= $judul ?></h3>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
          <i class="fas fa-minus"></i>
        </button>
      </div>
    </div>
    
    <div class="card-body">
      <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h5><i class="icon fas fa-check"></i> <?= session()->getFlashdata('pesan') ?></h5>
        </div>
      <?php endif; ?>
                
      <?php echo form_open('Admin/UpdateSetting') ?>

      <div class="row">
        <div class="col-sm-7">
          <div class="form-group">
            <label>Nama Website</label>
            <input name="nama_web" value="<?= $web['nama_web'] ?>" class="form-control" placeholder="Nama Website" required>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <label>Coordinat Kota</label>
            <!-- Diubah ke coordinat_kota sesuai database kamu -->
            <input name="coordinat_kota" value="<?= $web['coordinat_kota'] ?>" class="form-control" placeholder="Contoh: -7.23, 108.98" required>
          </div>
        </div>

        <div class="col-sm-2">
          <div class="form-group">
            <label>Zoom View</label>
            <input type="number" name="zoom_view" value="<?= $web['zoom_view'] ?>" min="0" max="20" class="form-control" required>
          </div>
        </div>
      </div>

      <button class="btn btn-primary" type="submit">Simpan</button>

      <?php echo form_close() ?>
    </div>
  </div>
</div>

<div class="col-md-12">
    <div id="map" style="width:100%; height:500px;"></div>
</div>

<script>
// 1. Definisikan dulu pilihan layernya (Gunakan alternatif gratis agar tidak putih)
  var peta1 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  });

  var peta2 = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
    attribution: 'Tiles &copy; Esri &mdash; Source: Esri'
  });

  var peta3 = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
    attribution: '&copy; OpenStreetMap &copy; CARTO'
  });

  var peta4 = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
    attribution: '&copy; OpenStreetMap &copy; CARTO'
  });

  // 2. Inisialisasi Map (Gunakan peta1 atau peta2 sebagai default layer awal)
  const map = L.map('map', {
      center: [<?= $web['coordinat_kota'] ?>],
      zoom: <?= $web['zoom_view'] ?>,
      layers: [peta1] // ini layer yang otomatis aktif pertama kali
  });

  // 3. Masukkan daftar layer ke dalam objek baseMaps
  const baseMaps = {
      'OpenStreetMap': peta1,
      'Satelit': peta2,
      'Gaya Terang': peta3,
      'Mode Gelap': peta4
  };

  // 4. JANGAN LUPA BARIS INI: Tombol pemilih layer di pojok kanan atas
  var layerControl = L.control.layers(baseMaps).addTo(map);

L.marker([<?= $web['coordinat_kota'] ?>]).addTo(map)
    .bindPopup("<?= $web['nama_web'] ?>");
</script>
