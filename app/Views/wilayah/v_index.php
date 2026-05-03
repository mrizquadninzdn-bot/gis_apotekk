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