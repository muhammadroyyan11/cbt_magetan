
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
                    <form action="<?= site_url('user/prosesEdit') ?>" method="post">
                        <div class="form-group <?= form_error('nama') ? 'has-error' : null ?>">
                            <label>Nama Lengkap *</label>
                            <input type="text" name="nama" value="<?= $row->nama ?>" class="form-control">
                            <input type="hidden" name="id_user" value="<?= $row->id_user?>">
                            <span class="help-block"><?= form_error('nama') ?></span>
                        </div>
                        <div class="form-group <?= form_error('email') ? 'has-error' : null ?>">
                            <label>Email *</label>
                            <input type="email" name="email" value="<?= $row->email ?>" class="form-control">
                            <span class="help-block"><?= form_error('email') ?></span>
                        </div>
                        <div class="form-group <?= form_error('email') ? 'has-error' : null ?>">
                            <label>Password *</label>
                            <input type="password" name="password" class="form-control">
                            <small>Lewati form ini jika tidak ada perubahan</small>
                            <span class="help-block"><?= form_error('password') ?></span>
                        </div>
                        <div class="form-group <?= form_error('no_telp') ? 'has-error' : null ?>">
                            <label>No Telp *</label>
                            <input type="text" name="no_telp" value="<?= $row->no_telp ?>" class="form-control">
                            <span class="help-block"><?= form_error('no_telp') ?></span>
                        </div>
                        <div class="form-group <?= form_error('alamat') ? 'has-error' : null ?>">
                            <label>Alamat *</label>
                            <!-- <input type="text" name="no_telp" value="<?= $row->no_telp ?>" class="form-control"> -->
                            <textarea name="alamat" class="form-control" id="" cols="10"><?= $row->alamat ?></textarea>
                            <span class="help-block"><?= form_error('no_telp') ?></span>
                        </div>
                        <div class="form-group <?= form_error('ttl') ? 'has-error' : null ?>">
                            <label>Tanggal Lahir *</label>
                            <input type="date" name="ttl" value="<?= $row->ttl ?>" class="form-control">
                            <span class="help-block"><?= form_error('ttl') ?></span>
                        </div>
                        <div class="form-group <?= form_error('jenis_kelamin') ? 'has-error' : null ?>">
                            <label>Jenis Kelamin *</label>
                            <select name="jenis_kelamin" class="form-control" id="">
                                <option value="null">-- Pillih Jenis Kelamin --</option>
                                <option value="Laki-Laki" <?= $row->jenis_kelamin == 'Laki-laki' ? 'selected' : '' ?>>Laki - Laki</option>
                                <option value="Perempuan" <?= $row->jenis_kelamin == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                            </select>
                            <span class="help-block"><?= form_error('jenis_kelamin') ?></span>
                        </div>
                        <div class="form-group <?= form_error('agama') ? 'has-error' : null ?>">
                            <label>Agama *</label>
                            <select name="agama" class="form-control" id="">
                                <option value="NULL">-- Pilih Agama --</option>
                                <option value="Islam" <?= $row->agama == 'Islam' ? 'selected' : '' ?>>Islam</option>
                                <option value="Kristen" <?= $row->agama == 'Kristen' ? 'selected' : '' ?>>Kristen</option>
                                <option value="Protestan" <?= $row->agama == 'Protestan' ? 'selected' : '' ?>>Protestan</option>
                                <option value="Katolik" <?= $row->agama == 'Katolik' ? 'selected' : '' ?>>Katolik</option>
                                <option value="Hindu" <?= $row->agama == 'Hindu' ? 'selected' : '' ?>>Hindu</option>
                                <option value="Budha" <?= $row->agama == 'Budha' ? 'selected' : '' ?>>Budha</option>
                                <option value="Konghucu" <?= $row->agama == 'Konghucu' ? 'selected' : '' ?>>Konghucu</option>
                            </select>
                            <span class="help-block"><?= form_error('agama') ?></span>
                        </div>
                        <div class="form-group <?= form_error('jenjang_pendidikan') ? 'has-error' : null ?>">
                            <label>Jenjang Pendidikan *</label>
                            <select name="jenjang_pendidikan" class="form-control" id="">
                                <option value="NULL">-- Pilih Jenjang Pendidikan --</option>
                                <option value="SD" <?= $row->jenjang_pendidikan == 'SD' ? 'selected' : '' ?>>SD</option>
                                <option value="SMP" <?= $row->jenjang_pendidikan == 'SMP' ? 'selected' : '' ?>>SMP</option>
                                <option value="SMA/SMK" <?= $row->jenjang_pendidikan == 'SMA/SMK' ? 'selected' : '' ?>>SMA/SMK</option>
                                <option value="Diploma 1" <?= $row->jenjang_pendidikan == 'Diploma 1' ? 'selected' : '' ?>>Diploma 1</option>
                                <option value="Diploma 2" <?= $row->jenjang_pendidikan == 'Diploma 2' ? 'selected' : '' ?>>Diploma 2</option>
                                <option value="Diploma 3" <?= $row->jenjang_pendidikan == 'Diploma 3' ? 'selected' : '' ?>>Diploma 3</option>
                                <option value="Diploma 4" <?= $row->jenjang_pendidikan == 'Diploma 4' ? 'selected' : '' ?>>Diploma 4</option>
                                <option value="S1" <?= $row->jenjang_pendidikan == 'S1' ? 'selected' : '' ?>>S1</option>
                                <option value="S2" <?= $row->jenjang_pendidikan == 'S2' ? 'selected' : '' ?>>S2</option>
                            </select>
                            <span class="help-block"><?= form_error('jenjang_pendidikan') ?></span>
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