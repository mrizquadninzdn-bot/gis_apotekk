 <div class="col-md-12">
            <div class="card card-outline card-primary">
              <div class="card-header">
                <h3 class="card-title"><?= $judul ?></h3>

                <div class="card-tools">
                <a href="<?= base_url('Wilayah/Input') ?>" class="btn btn-sm btn-flat btn-primary">
                    <i class="fas fa-plus"></i> Tambah
                </a>
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
              <table id="example2" class="table table-bordered table-striped">
                 <thead>
                    <tr class="text-center">
                        <th width="50px">No</th>
                        <th>Nama Wilayah</th>
                        <th>Warna</th>
                        <th width="100px">Aksi</th>
                    </tr>
                 </thead>
                 <tbody>
                   <?php $no = 1;
                    foreach ($wilayah as $key => $value) { ?>
                       <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $value['nama_wilayah'] ?></td>
                        <td style="background-color: <?= $value['warna'] ?> ;"></td>
                        <td class="text-center">
                            <a href="<?= base_url('Wilayah/Edit/'. $value['id_wilayah']) ?>" class="btn btn-sm btn-warning btn-flat"><i class="fas fa-pencil-alt"></i></a>
                            <a href="<?= base_url('Wilayah/Delete/'. $value['id_wilayah']) ?>" onclick="return confirm('Yakin Hapus Data..?')" class="btn btn-sm btn-danger btn-flat"><i class="fas fa-trash"></i></a>
                          </td>
                       </tr>
                   <?php } ?>
                 </tbody>
              </table>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <div class="col-md-12">
            <div id="map" style="width: 100%; height: 800px;"></div>
          </div>
<script>
    // 1. Alternatif OpenStreetMap Standar (Tanpa Token)
  var peta1 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  });

  // 2. Alternatif SATELIT dari Esri (Gratis & Tanpa Token - PENGGANTI YANG PUTIH)
  var peta2 = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
    attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
  });

  // 3. Alternatif Peta Jalanan Ringan (CartoDB Positron)
  var peta3 = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>'
  });

  // 4. Alternatif Mode Gelap/Malam (CartoDB Dark Matter)
  var peta4 = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>'
  });

      
  

    const map = L.map('map', {
	    center: [<?= $web['coordinat_kota'] ?>],
	    zoom: <?= $web['zoom_view'] ?>,
	    layers: [peta3]
});

    const baseMaps = {
	    'OpenStreetMap': peta1,
	    'satelite': peta2,
        'streets': peta3,
        'night': peta4
    };

    var layerControl = L.control.layers(baseMaps).addTo(map);

    <?php foreach ($wilayah as $key => $value) { ?>
        L.geoJSON(<?= $value['geojson'] ?>, {
            fillColor: '<?= $value['warna'] ?>',
            fillOpacity: 0.7,
        })
        .bindPopup("<b><?= $value['nama_wilayah'] ?></b>")
        .addTo(map);
    <?php } ?>


</script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>