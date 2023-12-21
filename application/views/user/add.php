<section class="content-header">
    <h1>
        <?= $title ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-list"></i> <?= $title ?></a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="box">
        <div class="box-header">
            <h3 class="box-title"></h3>
            <div class="pull-right">
                <a href="<?= site_url('user') ?>" class="btn btn-warning btn-flat">
                    <i class="fa fa-undo"></i> Kembali
                </a>
            </div>
        </div>

        <div class="box-body">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <form action="" method="post">
                        <div class="form-group <?= form_error('nama') ? 'has-error' : null ?>">
                            <label>Nama Lengkap *</label>
                            <input type="text" name="nama" class="form-control" require>
                            <span class="help-block"><?= form_error('nama') ?></span>
                        </div>
                        <div class="form-group <?= form_error('email') ? 'has-error' : null ?>">
                            <label>Email *</label>
                            <input type="email" name="email" class="form-control" require>
                            <span class="help-block"><?= form_error('email') ?></span>
                        </div>
                        <div class="form-group <?= form_error('password') ? 'has-error' : null ?>">
                            <label>Password *</label>
                            <input type="password" name="password" class="form-control" require>
                            <span class="help-block"><?= form_error('password') ?></span>
                        </div>
                        <div class="form-group <?= form_error('password2') ? 'has-error' : null ?>">
                            <label>Konfirmasi Password *</label>
                            <input type="password" name="password2" class="form-control" require>
                            <span class="help-block"><?= form_error('password2') ?></span>
                        </div>
                        <div class="form-group <?= form_error('no_telp') ? 'has-error' : null ?>">
                            <label>No Telp *</label>
                            <input type="text" name="no_telp" class="form-control">
                            <span class="help-block"><?= form_error('no_telp') ?></span>
                        </div>
                        <div class="form-group <?= form_error('alamat') ? 'has-error' : null ?>">
                            <label>Alamat *</label>
                            <!-- <input type="text" name="no_telp" value="<?= $row->no_telp ?>" class="form-control"> -->
                            <textarea name="alamat" class="form-control" id="" cols="10"></textarea>
                            <span class="help-block"><?= form_error('alamat') ?></span>
                        </div>
                        <div class="form-group <?= form_error('ttl') ? 'has-error' : null ?>">
                            <label>Tanggal Lahir *</label>
                            <input type="date" name="ttl"  class="form-control">
                            <span class="help-block"><?= form_error('ttl') ?></span>
                        </div>
                        <div class="form-group <?= form_error('jenis_kelamin') ? 'has-error' : null ?>">
                            <label>Jenis Kelamin *</label>
                            <select name="jenis_kelamin" class="form-control" id="">
                                <option value="null">-- Pillih Jenis Kelamin --</option>
                                <option value="Laki-Laki">Laki - Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            <span class="help-block"><?= form_error('jenis_kelamin') ?></span>
                        </div>
                        <div class="form-group <?= form_error('agama') ? 'has-error' : null ?>">
                            <label>Agama *</label>
                            <select name="agama" class="form-control" id="">
                                <option value="NULL">-- Pilih Agama --</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Protestan">Protestan</option>
                                <option value="Katolik">Katolik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Budha">Budha</option>
                                <option value="Konghucu">Konghucu</option>
                            </select>
                            <span class="help-block"><?= form_error('agama') ?></span>
                        </div>
                        <div class="form-group <?= form_error('jenjang_pendidikan') ? 'has-error' : null ?>">
                            <label>Jenjang Pendidikan *</label>
                            <select name="jenjang_pendidikan" class="form-control" id="">
                                <option value="NULL">-- Pilih Jenjang Pendidikan --</option>
                                <option value="SD">SD</option>
                                <option value="SMP">SMP</option>
                                <option value="SMA/SMK">SMA/SMK</option>
                                <option value="Diploma 1">Diploma 1</option>
                                <option value="Diploma 2">Diploma 2</option>
                                <option value="Diploma 3">Diploma 3</option>
                                <option value="Diploma 4">Diploma 4</option>
                                <option value="S1">S1</option>
                                <option value="S2">S2</option>
                            </select>
                            <span class="help-block"><?= form_error('jenjang_pendidikan') ?></span>
                        </div>

                        <div class="form-group <?= form_error('role') ? 'has-error' : null ?>">
                            <label>Role *</label>
                            <select name="role" class="form-control" id="">
                                <option value="NULL">-- Pilih Role --</option>
                                <option value="2">HRD</option>
                                <option value="3">Calon Karyawan</option>
                            </select>
                            <span class="help-block"><?= form_error('role') ?></span>
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