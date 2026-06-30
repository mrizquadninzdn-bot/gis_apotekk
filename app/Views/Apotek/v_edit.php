<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>
        </div>
        <div class="card-body">
            <?php 
            // Mengambil flashdata errors dari controller jika validasi gagal
            $errors = session()->getFlashdata('errors'); 
            ?>  
            <form action="<?= base_url('Apotek/UpdateData/' . $apotek['id_apotek']) ?>" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Nama Apotek</label>
                            <input name="nama_apotek" value="<?= old('nama_apotek', $apotek['nama_apotek']) ?>" placeholder="Nama Apotek" class="form-control">
                            <p class="text-danger"><?= isset($errors['nama_apotek']) ? $errors['nama_apotek'] : '' ?></p>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="">--Pilih Status--</option>
                                <option value="Negeri" <?= (strtoupper($apotek['status'])) == 'NEGERI' ? 'selected' : '' ?>>Negeri</option>
                                <option value="Swasta" <?= (strtoupper($apotek['status'])) == 'SWASTA' ? 'selected' : '' ?>>Swasta</option>
                            </select>
                            <p class="text-danger"><?= isset($errors['status']) ? $errors['status'] : '' ?></p>
                        </div>                                        
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Jenjang</label>
                            <select name="id_jenjang" class="form-control">
                                <option value="">--Pilih Jenjang--</option>
                                <?php foreach ($jenjang as $key => $value) { ?>
                                  <option value="<?= $value['id_jenjang'] ?>" <?= ($apotek['id_jenjang'] == $value['id_jenjang']) ? 'selected' : '' ?>>
                                    <?= $value['jenjang'] ?>
                                  </option>
                                <?php } ?>
                            </select>
                            <p class="text-danger"><?= isset($errors['id_jenjang']) ? $errors['id_jenjang'] : '' ?></p>
                        </div>                                        
                    </div>
                </div>
                

                <div class="form-group">
                    <label>Coordinat Apotek</label>
                    <div id="map" style="width:100%; height:500px; margin-bottom: 10px;"></div>
                    <input name="coordinat" id="coordinat" value="<?= $apotek['latitude'] . ',' . $apotek['longitude'] ?>" placeholder="Coordinat Apotek" class="form-control" readonly>
                    <p class="text-danger"><?= isset($errors['coordinat']) ? $errors['coordinat'] : '' ?></p>
                </div>        

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Provinsi</label>
                            <select name="id_Provinsi" id="id_provinsi" class="form-control select2-lg">
                                <option value="">--Pilih Provinsi--</option>
                                <?php foreach ($provinsi as $key => $value) { ?>
                                    <option value="<?= $value['id_provinsi'] ?>" <?= ($apotek['id_provinsi'] == $value['id_provinsi']) ? 'selected' : '' ?>><?= $value['nama_provinsi'] ?></option>
                                <?php } ?>
                            </select>
                            <p class="text-danger"><?= isset($errors['id_Provinsi']) ? $errors['id_Provinsi'] : '' ?></p>
                        </div>                                        
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Kabupaten</label>
                            <select name="id_kabupaten" id="id_kabupaten" class="form-control select2-lg">
                                <option value="><?= $apotek['id_kabupaten'] ?>"><?= $apotek['nama_kabupaten'] ?></option><?= $apotek['nama_kabupaten'] ?>
                            </select>
                            <p class="text-danger"><?= isset($errors['id_kabupaten']) ? $errors['id_kabupaten'] : '' ?></p>
                        </div>                                        
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Kecamatan</label>
                            <select name="id_kecamatan" id="id_kecamatan" class="form-control select2-lg">
                                <option value="><?= $apotek['id_kecamatan'] ?>"><?= $apotek['nama_kecamatan'] ?></option><?= $apotek['nama_kecamatan'] ?>
                            </select>
                            <p class="text-danger"><?= isset($errors['id_kecamatan']) ? $errors['id_kecamatan'] : '' ?></p>
                        </div>                                        
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label>Alamat</label>
                            <input name="alamat" value="<?= $apotek['alamat'] ?>" placeholder="Alamat Apotek" class="form-control">
                            <p class="text-danger"><?= isset($errors['alamat']) ? $errors['alamat'] : '' ?></p>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Wilayah Administrasi</label>
                            <select name="id_wilayah" class="form-control">
                                <option value="">--Pilih Wilayah Administrasi--</option>
                                <?php foreach ($wilayah as $key => $value) { ?>
                                    <option value="<?= $value['id_wilayah'] ?>" <?= $value['id_wilayah'] ?>" <?= ($apotek['id_wilayah'] == $value['id_wilayah']) ? 'selected' : '' ?>><?= $value['nama_wilayah'] ?></option>
                                <?php } ?>
                            </select>
                            <p class="text-danger"><?= isset($errors['id_wilayah']) ? $errors['id_wilayah'] : '' ?></p>
                        </div>                                        
                    </div>
                </div>

                <div class="form-group">
                    <label>Ganti Foto Apotek</label>
                    <input type="file" accept=".jpg,.jpeg,.png" name="foto" class="form-control">
                    <p class="text-danger"><?= isset($errors['foto']) ? $errors['foto'] : '' ?></p>
                </div>
                
                <button type="submit" class="btn btn-primary btn-flat">Simpan</button>
                <a href="<?= base_url('Apotek') ?>" class="btn btn-success btn-flat">Kembali</a>

            </form>
        </div>
    </div>
</div>

<script>
  $(function () {
    $('.select2').select2();

    $('#id_provinsi').change(function(e) {
      e.preventDefault();
      var id_provinsi = $(this).val();
      
      if(id_provinsi != "") {
         $.ajax({
           type: "POST",
           url: "<?= site_url('Apotek/Kabupaten') ?>",
           data: {
             id_provinsi: id_provinsi,
           },
           success: function (response) {
             $('#id_kabupaten').html(response);
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
              id_kabupaten: id_kabupaten
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
var peta1 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {});
var peta2 = L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {});
var peta3 = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {});
var peta4 = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {});
var petaSatelit = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {});

const map = L.map('map',{
 center:[<?= $web['coordinat_kota'] ?>],
 zoom: <?= $web['zoom_view'] ?>, 
 layers:[petaSatelit] 
});

const baseMaps={
 "Standar":peta1,
 "HOT Map":peta2,
 "Light":peta3,
 "Dark":peta4, 
 "Satelit":petaSatelit
};

L.control.layers(baseMaps).addTo(map);

var coordinatInput = document.getElementById("coordinat");
var curLocation = [<?= $web['coordinat_kota'] ?>];
map.attributionControl.setPrefix(false);

var marker = new L.marker(curLocation, {
  draggable: 'true',
}).addTo(map);

// PERBAIKAN: Menggunakan ID #coordinat huruf kecil agar sinkron sewaktu marker digeser
marker.on('dragend', function(e) {
  var position = marker.getLatLng();
  marker.setLatLng(position).bindPopup(position).update();
  $("#coordinat").val(position.lat + "," + position.lng);
});

// PERBAIKAN: Sinkronisasi klik peta ke ID #coordinat huruf kecil
map.on("click", function(e) {
  var lat = e.latlng.lat;
  var lng = e.latlng.lng;
  if (!marker) {
    marker = L.marker(e.latlng).addTo(map);
  } else {
    marker.setLatLng(e.latlng);
  }
  coordinatInput.value = lat + ',' + lng;
});
</script>