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
              $warnaInput = is_string($wilayah['warna']) ? $wilayah['warna'] : '';
              $warnaLama = [
                  'biru' => '#0000ff',
                  'merah' => '#ff0000',
                  'hijau' => '#008000',
                  'kuning' => '#ffff00',
                  'hitam' => '#000000',
                  'putih' => '#ffffff',
                  'ungu' => '#800080',
                  'jingga' => '#ffa500',
                  'oranye' => '#ffa500',
              ];
              if (isset($warnaLama[strtolower($warnaInput)])) {
                  $warnaInput = $warnaLama[strtolower($warnaInput)];
              }
              if (! is_string($warnaInput) || ! preg_match('/^#[0-9a-fA-F]{6}$/', $warnaInput)) {
                  $warnaInput = '#3388ff';
              }
              ?>
              <?php echo form_open('Wilayah/UpdateData/'. $wilayah['id_wilayah']) ?>

                <div class="row">
                    <div class="col-sm-6">
                    <div class="form-group">
                <label>Nama Wilayah</label>
                <input name="nama_wilayah" value="<?= $wilayah['nama_wilayah'] ?>" class="form-control">
                <p class="text-danger"><?= $validation->hasError('nama_wilayah') ? $validation->getError('nama_wilayah') : '' ?></p>
              </div>
                    </div>

                    <div class="col-sm-6">
                    <div class="form-group">
                <label>Warna Wilayah</label>
                <input type="color" name="warna" value="<?= esc($warnaInput) ?>" class="form-control" style="height: 38px; padding: 4px; width: 90px;" title="Pilih warna wilayah">
                <small class="text-muted">Klik kotak warna untuk memilih.</small>
                <p class="text-danger"><?= $validation->hasError('warna') ? $validation->getError('warna') : '' ?></p>
            </div>                        
                    </div>
                </div>

                <div class="form-group">
                <label>GeoJSON</label>
                <textarea name="geojson" class="form-control" rows="15"><?= $wilayah['geojson'] ?></textarea>
                <p class="text-danger"><?= $validation->hasError('geojson') ? $validation->getError('geojson') : '' ?></p>
            </div>        
            
            
            <button class="btn btn-primary btn-flat" type="submit">Simpan</button>
            <a href="<?= base_url('Wilayah') ?>"class="btn btn-success btn-flat">Kembali</a>

              <?php echo form_close() ?>

        </div>
    </div>
</div>
