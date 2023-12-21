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
            <h3 class="box-title">Add New User Account</h3>
            <div class="pull-right">
                <a href="<?= site_url('kelolaLowongan') ?>" class="btn btn-warning btn-flat">
                    <i class="fa fa-undo"></i> Kembali
                </a>
            </div>
        </div>

        <div class="box-body">
        <?= $this->session->flashdata('pesan'); ?>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <form action="<?= site_url('KelolaLowongan/proses') ?>" method="post">
                        <div class="form-group <?= form_error('nama') ? 'has-error' : null ?>">
                            <label>Nama lowongan *</label>
                            <input type="text" name="nama" value="<?= set_value('nama') ?>" class="form-control">
                            <span class="help-block"><?= form_error('nama') ?></span>
                        </div>
                        <div class="form-group <?= form_error('username') ? 'has-error' : null ?>">
                            <label>Requirement *</label>
                            <!-- <input type="text" name="username" value="<?= set_value('username') ?>" class="form-control"> -->
                            <textarea name="requrement" id="editor1" name="require" class="form-control" cols="30" rows="10"></textarea>
                            <span class="help-block"><?= form_error('require') ?></span>
                        </div>
                        <div class="form-group <?= form_error('password') ? 'has-error' : null ?>">
                            <label>Deskripsi *</label>
                            <textarea id="editor2" name="deskripsi" class="form-control" rows="10" cols="80"></textarea>
                            <span class="help-block"><?= form_error('password') ?></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Lowongan dibuka sampai</label>
                            <input type="datetime-local" class="form-control" id="exampleInputEmail1" name="deadline" placeholder="Masukkan Jumlah soal">
                        </div>
                        <div class="form-group <?= form_error('wisata_id') ? 'has-error' : null ?>" id="destination">
                            <label>Section / Bagian *</label>
                            <select name="section" id="select" class="form-control">
                                <option value="">-- Pilih Bagian --</option>
                                <option value="Staff Kantor">Staff Kantor</option>
                                <option value="Staff Produksi">Staff Produksi</option>
                            </select>
                            <span class="help-block"><?= form_error('wisata_id') ?></span>
                        </div>
                        <div class="form-group <?= form_error('wisata_id') ? 'has-error' : null ?>" id="destination">
                            <label>Status kerja *</label>
                            <select name="tipe" id="select" class="form-control">
                                <option value="">-- Pilih Status Kerja --</option>
                                <option value="Kontrak">Kontrak</option>
                                <option value="Karyawan Tetap">Karyawan Tetap</option>
                            </select>
                            <span class="help-block"><?= form_error('wisata_id') ?></span>
                        </div>
                        <div class="form-group <?= form_error('wisata_id') ? 'has-error' : null ?>" id="destination">
                            <label>Deptartment / Categori *</label>
                            <select name="dept_id" id="select" class="form-control">
                                <option value="">-- Pilih Department --</option>
                                <?php foreach ($kategori as $l => $data) { ?>
                                    <option value="<?= $data['id_sub'] ?>"><b><?= $data['nama_kategori'] ?></b> - <?= $data['nama_sub'] ?></option>
                                <?php } ?>
                            </select>
                            <span class="help-block"><?= form_error('wisata_id') ?></span>
                        </div>
                        <div class="form-group <?= form_error('wisata_id') ? 'has-error' : null ?>" id="destination">
                            <label>Pendidikan *</label>
                            <select name="pendidikan" id="select" class="form-control">
                                <option value="">-- Pilih Pendidikan --</option>
                                <option value="SMK">SMK / SMA</option>
                                <option value="D1">D1</option>
                                <option value="D2">D2</option>
                                <option value="D3">D3</option>
                                <option value="D4">D4</option>
                                <option value="S1">S1</option>
                                <option value="S2">S2</option>
                                <option value="S3">S3</option>
                            </select>
                            <span class="help-block"><?= form_error('wisata_id') ?></span>
                        </div>
                        <div class="form-group <?= form_error('wisata_id') ? 'has-error' : null ?>" id="destination">
                            <label for="exampleInputEmail1">Jumlah Soal Ujian *</label>
                            <input type="number" class="form-control" id="exampleInputEmail1" name="jumlah" placeholder="Masukkan Jumlah soal">
                            <span class="help-block"><?= form_error('wisata_id') ?></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nilai KKM</label>
                            <input type="number" class="form-control" id="exampleInputEmail1" name="kkm" placeholder="Masukkan Nilai KKM" min="1" max="100" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jenis Soal Ujian</label>
                            <select name="jenis" id="" class="form-control select2" style="width: 100%;">
                                <option value="acak">Acak</option>
                                <option value="urut">Urut</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Waktu Ujian (Menit)</label>
                            <input type="number" class="form-control" id="exampleInputEmail1" name="waktu" placeholder="Masukkan waktu dalam bentuk menit">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tanggal Selesai Ujian</label>
                            <input type="datetime-local" class="form-control" id="exampleInputEmail1" name="tgl_selesai" placeholder="Masukkan Jumlah soal">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tanggal Wawancara</label>
                            <input type="date" class="form-control" id="exampleInputEmail1" name="tgl_wawancara" placeholder="Masukkan Tanggal Wawancara">
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