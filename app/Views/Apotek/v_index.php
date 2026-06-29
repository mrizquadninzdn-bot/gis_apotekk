<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>

            <div class="card-tools">
                <a href="<?= base_url('Apotek/Input') ?>" class="btn btn-flat btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Tambah
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <table id="example2" class="table table-sm table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th width="50px">No</th>
                        <th>Nama Apotek</th>
                        <th>Alamat</th>
                        <th>Jenjang</th>
                        <th>Koordinat</th>
                        <th>Foto</th>
                        <th width="100px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    // PERBAIKAN UTAMA: Menggunakan $apotek yang bersumber dari ModelApotek
                    foreach ($apotek as $key => $value) { ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td class="text-center"><?= $value['nama_apotek'] ?? $value['nama_Apotek'] ?? 'Belum ada nama' ?></td>
                            <td class="text-center"><?= $value['alamat'] ?? 'Belum ada alamat' ?></td>
                             <td class="text-center"><?= $value['jenjang'] ?? 'Belum ada alamat' ?></td>
                            <td>
                                <?= $value['lat'] ?? $value['latitude'] ?? '0' ?>, 
                                <?= $value['lng'] ?? $value['longitude'] ?? '0' ?>
                            </td>
                            <td class="text-center">
                                <img src="<?= base_url('foto/' . $value['foto']) ?>" width="150px" class="img-thumbnail" alt="Foto Apotek">
                            </td>
                            <td class="text-center">
                                <a href="<?= base_url('Apotek/Edit/'. ($value['id_apotek'] ?? $value['id'] ?? '')) ?>" class="btn btn-xs btn-success btn-flat"><i class="fas fa-eye"></i></a>
                                <a href="<?= base_url('Apotek/Edit/'. ($value['id_apotek'] ?? $value['id'] ?? '')) ?>" class="btn btn-xs btn-warning btn-flat"><i class="fas fa-pencil-alt"></i></a>
                                <a href="<?= base_url('Apotek/Delete/'. ($value['id_apotek'] ?? $value['id'] ?? '')) ?>" onclick="return confirm('Yakin Hapus Data Apotek..?')" class="btn btn-xs btn-danger btn-flat"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

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