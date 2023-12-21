<section class="content-header">
    <h1>
        <?= $title?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> - tambah data <?= $title?></a></li>
    </ol>
</section><hr>

<!-- Main content -->
<section class="content">

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Add New User Account</h3>
            <div class="pull-right">
                <a href="<?= site_url('kategori') ?>" class="btn btn-warning btn-flat">
                    <i class="fa fa-undo"></i> Kembali
                </a>
            </div>
        </div>

        <div class="box-body">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">

                    <form action="" method="post">
                        <div class="form-group <?= form_error('nama') ? 'has-error' : null ?>">
                            <label>Nama *</label>
                            <input type="text" name="nama" value="<?= set_value('nama') ?>" class="form-control">
                            <span class="help-block"><?= form_error('nama') ?></span>
                        </div>
                        <div class="form-group <?= form_error('username') ? 'has-error' : null ?>">
                            <label>Username *</label>
                            <input type="text" name="username" value="<?= set_value('username') ?>" class="form-control">
                            <span class="help-block"><?= form_error('username') ?></span>
                        </div>
                        <div class="form-group <?= form_error('password') ? 'has-error' : null ?>">
                            <label>Password *</label>
                            <input type="password" name="password" value="<?= set_value('password') ?>" class="form-control">
                            <span class="help-block"><?= form_error('password') ?></span>
                        </div>
                        <div class="form-group <?= form_error('password2') ? 'has-error' : null ?>">
                            <label>Password Konfirmasi *</label>
                            <input type="password" name="password2" class="form-control">
                            <span class="help-block"><?= form_error('password2') ?></span>
                        </div>
                        <div class="form-group <?= form_error('email') ? 'has-error' : null ?>">
                            <label>Email *</label>
                            <input type="email" name="email" class="form-control">
                            <span class="help-block"><?= form_error('email') ?></span>
                        </div>
                        <div class="form-group <?= form_error('role') ? 'has-error' : null ?>">
                            <label>Role *</label>
                            <select type="password" name="role" id="confirmation" value="<?= set_value('role') ?>" class="form-control">
                                <option value="">- Chose Role -</option>
                                <option value="1" <?= set_value('role') == 1 ? "selected" : null ?>>Administrator</option>
                                <option value="2" <?= set_value('role') == 2 ? "selected" : null ?>>User Destination</option>
                            </select>
                            <span class="help-block"><?= form_error('level') ?></span>
                        </div>
                        <div class="form-group <?= form_error('wisata_id') ? 'has-error' : null ?>"  id="destination" >
                            <label>Destination *</label>
                            <select name="wisata_id" class="form-control">
                                <option value="">-- Chose Destination --</option>
                                <?php foreach ($wisata as $l => $data) { ?>
                                    <option value="<?= $data->id_wisata ?>"><?= $data->nama ?></option>
                                <?php } ?>
                            </select>
                            <span class="help-block"><?= form_error('wisata_id') ?></span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-flat">Simpan</button>
                            <button type="reset" class="btn btn-danger btn-flat">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>