<section class="content-header">
    <h1>
        <?= $title ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> - tambah data <?= $title ?></a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Edit <?= $title ?></h3>
            <div class="pull-right">
                <a href="<?= site_url('kelolaLowongan') ?>" class="btn btn-warning btn-flat">
                    <i class="fa fa-undo"></i> Kembali
                </a>
            </div>
        </div>

        <div class="box-body">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <form action="<?= site_url('KelolaLowongan/prosesEdit/'). $row->id_lowongan ?>" method="post">
                        <div class="form-group <?= form_error('nama') ? 'has-error' : null ?>">
                            <label>Nama lowongan *</label>
                            <input type="text" name="nama" value="<?= $row->title ?>" class="form-control">
                            <span class="help-block"><?= form_error('nama') ?></span>
                        </div>
                        <div class="form-group <?= form_error('username') ? 'has-error' : null ?>">
                            <label>Requirement *</label>
                            <!-- <input type="text" name="username" value="<?= set_value('username') ?>" class="form-control"> -->
                            <textarea name="requrement" id="editor1" name="require" class="form-control" cols="30" rows="10"><?= $row->requirements ?></textarea>
                            <span class="help-block"><?= form_error('require') ?></span>
                        </div>
                        <div class="form-group <?= form_error('password') ? 'has-error' : null ?>">
                            <label>Deskripsi *</label>
                            <textarea id="editor2" name="deskripsi" class="form-control" rows="10" cols="80">   ></textarea>
                            <span class="help-block"><?= form_error('password') ?></span>
                        </div>
                        <div class="form-group <?= form_error('wisata_id') ? 'has-error' : null ?>" id="destination">
                            <label>Section / Bagian *</label>
                            <select name="section" id="select" class="form-control">
                                <option value="null">-- Pilih Bagian --</option>
                                <option value="Staff Kantor" <?= $row->section == 'Staff Kantor' ? 'selected' : '' ?>>Staff Kantor</option>
                                <option value="Staff Produksi" <?= $row->section  == 'Staff Produksi' ? 'selected' : '' ?>>Staff Produksi</option>
                            </select>
                            <span class="help-block"><?= form_error('wisata_id') ?></span>
                        </div>
                        <div class="form-group <?= form_error('wisata_id') ? 'has-error' : null ?>" id="destination">
                            <label>Status kerja *</label>
                            <select name="tipe" id="select" class="form-control">
                                <option value="null">-- Pilih Status Kerja --</option>
                                <option value="Kontrak" <?= $row->tipe == 'Kontrak' ? 'selected' : '' ?>>Kontrak</option>
                                <option value="Karyawan Tetap" <?= $row->tipe == 'Karyawan Tetap' ? 'selected' : '' ?>>Karyawan Tetap</option>
                            </select>
                            </select>
                            <span class="help-block"><?= form_error('wisata_id') ?></span>
                        </div>
                        <div class="form-group <?= form_error('wisata_id') ? 'has-error' : null ?>" id="destination">
                            <label>Deptartment / Categori *</label>
                            <select name="dept_id" id="select" class="form-control">
                                <option value="">-- Pilih Department --</option>
                                <?php foreach ($kategori as $l => $data) { ?>
                                    <option value="<?= $data['id_sub'] ?>" <?=  $data['id_sub']  ==  $data['id_sub']  ? 'selected' : '' ?>><b><?= $data['nama_kategori'] ?></b> - <?= $data['nama_sub'] ?></option>
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