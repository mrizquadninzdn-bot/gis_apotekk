<div class="card card-outline card-primary w-100" style="width: 100% !important;">
    <div class="card-header">
        <h3 class="card-title"><?= $judul ?></h3>
    </div>
    
    <div class="card-body">
        <?php 
        $errors = session()->getFlashdata('errors'); 
        ?>
        
<form action="<?= base_url('User/UpdateData/' . $user['id_user']) ?>" method="post" enctype="multipart/form-data"> <div class="form-group">
                <label>Nama User</label>
                <input name="nama_user" value="<?= $user['nama_user'] ?>" placeholder="Nama User" class="form-control">
                <p class="text-danger"><?= isset($errors['nama_user']) ? $errors['nama_user'] : '' ?></p>
            </div>

            <div class="form-group">
                <label>E-Mail</label>
                <input type="email" name="email" value="<?= $user['email'] ?>" placeholder="E-Mail" class="form-control">
                <p class="text-danger"><?= isset($errors['email']) ? $errors['email'] : '' ?></p>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" value="<?= $user['password'] ?>" placeholder="Password" class="form-control">
                <p class="text-danger"><?= isset($errors['password']) ? $errors['password'] : '' ?></p>
            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Ganti Foto</label>
                        <input type="file" name="foto" class="form-control" accept="image/*">
                        <p class="text-danger"><?= isset($errors['foto']) ? $errors['foto'] : '' ?></p>
                    </div>
                </div>
                <div class="col-sm-8">
                    <img src="<?= base_url('foto/' . $user['foto']) ?>" width="150px">
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-flat">Simpan</button>
                <a href="<?= base_url('User') ?>" class="btn btn-success btn-flat">Kembali</a>
            </div>
        </form>
    </div>
</div>