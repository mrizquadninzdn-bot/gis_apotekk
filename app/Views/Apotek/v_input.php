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
                <input name="nama_apotek" value="<?= old('nama_apotek') ?>" placeholder="Nama Apotek" class="form-control">
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
                <input name="coordinat" id="Coordinat" value="<?= old('coordinat') ?>" placeholder="Coordinat Apotek" class="form-control" readonly>
                <p class="text-danger"><?= $validation->hasError('coordinat') ? $validation->getError('nama_wilayah') : '' ?></p>
            </div>        
            <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Provinsi</label>
                    <select name="id_Provinsi" id="id_provinsi" class="form-control select2-lg">
                      <option value="">--Pilih Provinsi--</option>
                      <?php foreach ($provinsi as $key => $value) { ?>
                      <option value="<?= $value['id_provinsi'] ?>"><?= $value['nama_provinsi'] ?></option>
                    <?php } ?>
                    </select>

                    <p class="text-danger"><?= $validation->hasError('id_Provinsi') ? $validation->getError('id_provinsi') : '' ?></p>
                  </div>                        
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Kabupaten</label>
                    <select name="id_kabupaten" id="id_kabupaten" class="form-control select2-lg">
                        <option value="">--Pilih Kabupaten--</option>
                    </select>
                    <p class="text-danger"><?= $validation->hasError('id_kabupaten') ? $validation->getError('id_kabupaten') : '' ?></p>
                  </div>                        
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label>Kecamatan</label>
                    <<select name="id_kecamatan" id="id_kecamatan" class="form-control form-control select2-lg">
                        <option value="">--Pilih Kecamatan--</option>
                    </select>
                    <p class="text-danger"><?= $validation->hasError('id_kecamatan') ? $validation->getError('id_kecamatan') : '' ?></p>
                  </div>                        
                </div>
            </div>

            <div class="row">
              <div class="col-sm-8">
                <div class="form-group">
                  <label>Alamat</label>
                  <input name="alamat" value="<?= old('alamat') ?>" placeholder="Alamat Apotek" class="form-control">
                  <p class="text-danger"><?= $validation->hasError('alamat') ? $validation->getError('alamat') : '' ?></p>
                </div>
              </div>

              <div class="col-sm-4">
                  <div class="form-group">
                    <label>Wilayah Administrasi</label>
                    <select name="id_wilayah" class="form-control">
                      <option value="">--Pilih Wilayah Administrasi--</option>
                      <?php foreach ($wilayah as $key => $value) { ?>
                      <option value="<?= $value['id_wilayah'] ?>"><?= $value['nama_wilayah'] ?></option>
                    <?php } ?>
                    </select>
                    <p class="text-danger"><?= $validation->hasError('id_wilayah') ? $validation->getError('id_wilayah') : '' ?></p>
                  </div>                        
                </div>
            </div>

            <div class="form-group">
              <label>Foto Apotek</label>
              <input type="file" accept= ".jpg" name="Foto" value="<?= old('foto') ?>" class="form-control">
              <p class="text-danger"><?= $validation->hasError('foto') ? $validation->getError('foto') : '' ?></p>
            </div>
            
            <button class="btn btn-primary btn-flat" type="submit">Simpan</button>
            <a href="<?= base_url('Wilayah') ?>"class="btn btn-success btn-flat">Kembali</a>

              <?php echo form_close() ?>

        </div>
    </div>
</div>

<script>
  $(function () {
    // Pastikan select2 aktif di awal
    $('.select2').select2();

    $('#id_provinsi').change(function(e) {
      e.preventDefault();
      var id_provinsi = $(this).val();
      
      if(id_provinsi != "") {
         $.ajax({
           type: "POST",
           url: "<?= site_url('Apotek/Kabupaten') ?>",
           // csrf_token_hash otomatis disertakan oleh CI4 jika form dibuka
           data: {
             id_provinsi: id_provinsi,
           },
           success: function (response) {
             // Masukkan text <option> dari controller
             $('#id_kabupaten').html(response);
             
             // Refresh visual select2 kabupaten agar tampilannya terupdate
             $('#id_kabupaten').trigger('change');
           },
           error: function(xhr, status, error) {
             console.error("Gagal mengambil data kabupaten: " + error);
           }
         });
      }
    });

    $('#id_kabupaten').change(function(e) {
      e.preventDefault();
      var id_kabupaten = $(this).val(); 
  
      if(id_kabupaten != "") {
          $.ajax({
            type: "POST",
            url: "<?= site_url('Apotek/Kecamatan') ?>", 
            data: {
              id_kabupaten: id_kabupaten // <-- Pastikan ini ditulis 'id_kabupaten', bukan yang lain
            },
            success: function (response) {
              $('#id_kecamatan').html(response);
              $('#id_kecamatan').trigger('change');
            },
            error: function(xhr, status, error) {
              console.error("Gagal memuat data kecamatan: " + error);
            }
          });
        }
    });
});
</script>

<script>

// 1. Definisikan semua layer peta
var peta1 = L.tileLayer(
'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
{
});

var peta2 = L.tileLayer(
'https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png',
{
});

var peta3 = L.tileLayer(
'https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png',
{
});

var peta4 = L.tileLayer(
'https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png',
{
});

var petaSatelit = L.tileLayer(
'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}',
{
});

// 2. Inisialisasi Peta (Menampilkan Satelit sebagai default saat pertama dimuat)
const map = L.map('map',{
 center:[<?= $web['coordinat_kota'] ?>],
 zoom: <?= $web['zoom_view'] ?>, // Catatan: Jika koordinat/zoom masih bermasalah, pastikan nilainya berupa angka (misal: 12) tanpa tanda kurung siku []
 layers:[petaSatelit] 
});

// 3. Gabungkan opsi ke dalam menu kontrol layer (Sudah ditambahkan koma yang benar)
const baseMaps={
 "Standar":peta1,
 "HOT Map":peta2,
 "Light":peta3,
 "Dark":peta4, // <--- Koma di sini sudah aman sekarang
 "Satelit":petaSatelit
};

// 4. Tambahkan kontrol layer ke peta
L.control.layers(baseMaps).addTo(map);


var coordinatInput = document.querySelector("[name=coordinat]");

var curLocation = [<?= $web['coordinat_kota'] ?>];
map.attributionControl.setPrefix(false);
var marker = new L.marker(curLocation, {
  draggable: 'true',
});

//mengambil coordinat saat marker di geser
marker.on('dragend', function(e) {
  var position = marker.getLatLng();
  marker.setLatLng(position,{curLocation}).bindPopup(position).update();
  $("#Coordinat").val(position.lat + "," + position.lng);
});

//mengambil coordinat saat map di klik
map.on("click", function(e) {
  var lat = e.latlng.lat;
  var lng = e.latlng.lng;
  if (!marker) {
    marker = L.marker(e.latlng).addTo(map);
  }else{
    marker.setLatLng(e.latlng);
  }
  coordinatInput.value = lat + ',' + lng;
});

map.addLayer(marker);
</script>
