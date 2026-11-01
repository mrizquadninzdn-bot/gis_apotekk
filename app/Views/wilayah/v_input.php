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
              $errors = session()->getFlashdata('errors');
              if (! is_array($errors)) {
                  $errors = [];
              }
              $warnaInput = old('warna');
              if (! is_string($warnaInput) || ! preg_match('/^#[0-9a-fA-F]{6}$/', $warnaInput)) {
                  $warnaInput = '#3388ff';
              }
              ?>
              <?php echo form_open('Wilayah/InsertData') ?>

                <div class="row">
                    <div class="col-sm-6">
                    <div class="form-group">
                <label>Nama Wilayah</label>
                <input name="nama_wilayah" value="<?= old('nama_wilayah') ?>" class="form-control">
                <p class="text-danger"><?= isset($errors['nama_wilayah']) ? esc($errors['nama_wilayah']) : '' ?></p>
              </div>
                    </div>

                    <div class="col-sm-6">
                    <div class="form-group">
                <label>Warna Wilayah</label>
                <input type="color" name="warna" value="<?= esc($warnaInput) ?>" class="form-control" style="height: 38px; padding: 4px; width: 90px;" title="Pilih warna wilayah">
                <small class="text-muted">Klik kotak warna untuk memilih.</small>
                <p class="text-danger"><?= isset($errors['warna']) ? esc($errors['warna']) : '' ?></p>
            </div>                        
                    </div>
                </div>

                <div class="form-group">
                <label>GeoJSON</label>
                <textarea name="geojson" class="form-control" rows="15"><?= old('geojson') ?></textarea>
                <p class="text-danger"><?= isset($errors['geojson']) ? esc($errors['geojson']) : '' ?></p>
            </div>        
            
            
            <button class="btn btn-primary btn-flat" type="submit">Simpan</button>
            <a href="<?= base_url('Wilayah') ?>"class="btn btn-success btn-flat">Kembali</a>

              <?php echo form_close() ?>

        </div>
    </div>
</div>
