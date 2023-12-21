<section class="content-header">
    <h1>
        <?= $title ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-list"></i> <?= $title ?></a></li>
    </ol>
    <hr>
</section>


<section class="content">
    <div class="row">
        <div class="col-md-12">

            <!-- /.col -->
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="float-end">
                            <a href="<?= site_url('KelolaLowongan/add') ?>" class="btn btn-primary btn-flat">
                                <i class="fa fa-plus"></i> Add
                            </a>
                        </div>
                        <h3 class="box-title">Data <?= $title ?></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <!-- <th>IsActive</th> -->
                                    <th>Nama lowongan Lowongan</th>
                                    <th>Tipe Kontrak</th>
                                    <th>Departement</th>
                                    <th>Sub Department</th>
                                    <th>Nilai Minimum</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($lowongan as $key => $data) {
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $data['title'] ?></td>
                                        <td><?= $data['tipe'] ?></td>
                                        <td><?= $data['nama_kategori'] ?></td>
                                        <td><?= $data['nama_sub'] ?></td>
                                        <td><?= $data['kkm'] ?></td>
                                        <td>
                                            <a href="<?= site_url('kelolaLowongan/edit/') . $data['id_lowongan'] ?>" class="btn btn-circle btn-sm btn-warning"><i class="fa fa-fw fa-edit"></i></a>
                                            <a onclick="return confirm('Yakin ingin menghapus data?')" href="<?= base_url('kelolaLowongan/delete/') . $data['id_lowongan'] ?>" class="btn btn-circle btn-sm btn-danger"><i class="fa fa-fw fa-trash"></i></a>
                                            <a href="<?= base_url('kelolaLowongan/report/') . $data['id_lowongan'] ?>" title="Data Pelamar" class="btn btn-circle btn-sm btn-primary"><i class="fa fa-fw fa-file-text-o "></i></a>
                                        </td>
                                    </tr>
                                <?php
                                } ?>
                            </tbody>

                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
</section>


<!-- Modal Add -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah lowongan lowongan</h4>
            </div>
            <?= form_open('lowongan/proses'); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama lowongan</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="lowongan" placeholder="Masukkan nama lowongan">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



<!-- Modal edit -->
<?php
$no = 0;
foreach ($lowongan as $key => $data) : $no++; ?>
    <div class="modal fade" id="modal-edit<?= $data['id_lowongan'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit lowongan lowongan</h4>
                </div>
                <?= form_open('lowongan/prosesEdit/' . $data['id_lowongan']); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama lowongan</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="lowongan" value="<?= $data['title'] ?>" placeholder="Masukkan nama lowongan">
                    </div>
                    <div class="form-group">
                        <label>Requirement *</label>
                        <!-- <input type="text" name="username" value="<?= set_value('username') ?>" class="form-control"> -->
                        <textarea name="requrement" id="editor3" name="require" class="form-control" cols="30" rows="10"><?= $data['requirements'] ?></textarea>
                        <span class="help-block"><?= form_error('require') ?></span>
                    </div>
                    <div class="form-group">
                        <label>Deskripsi *</label>
                        <textarea id="editor4" name="deskripsi" class="form-control" rows="10" cols="80"><?= $data['requirements'] ?></textarea>
                        <span class="help-block"><?= form_error('password') ?></span>
                    </div>
                    <div class="form-group">
                        <label>Section / Bagian *</label>
                        <select name="section" id="select" class="form-control">
                            <option value="">-- Pilih Bagian --</option>
                            <option value="Staff Kantor" <?= $data['section'] == 'Staff Kantor' ? 'selected' : '' ?>>Staff Kantor</option>
                            <option value="Staff Produksi" <?= $data['section'] == 'Staff Produksi' ? 'selected' : '' ?>>Staff Produksi</option>
                        </select>
                        <small>Biarkan form ini jika tidak ada perubahan</small>
                        <span class="help-block"><?= form_error('wisata_id') ?></span>
                    </div>
                    <div class="form-group <?= form_error('wisata_id') ? 'has-error' : null ?>" id="destination">
                        <label>Status kerja *</label>
                        <select name="tipe" id="select" class="form-control">
                            <option value="">-- Pilih Status Kerja --</option>
                            <option value="Kontrak" <?= $data['tipe'] == 'Kontrak' ? 'selected' : '' ?>>Kontrak</option>
                            <option value="Karyawan Tetap" <?= $data['tipe'] == 'Karyawan Tetap' ? 'selected' : '' ?>>Karyawan Tetap</option>
                        </select>
                        <small>Biarkan form ini jika tidak ada perubahan</small>
                        <span class="help-block"><?= form_error('wisata_id') ?></span>
                    </div>
                    <div class="form-group <?= form_error('wisata_id') ? 'has-error' : null ?>" id="destination">
                        <label>Deptartment / Categori *</label>
                        <select name="dept_id" id="select" class="form-control">
                            <option value="">-- Pilih Department --</option>
                            <?php foreach ($kategori as $l => $data) { ?>
                                <option value="<?= $data['id_sub'] ?>" <?= $data['id_sub'] == $data['id_sub'] ? 'selected' : '' ?>><b><?= $data['nama_kategori'] ?></b> - <?= $data['nama_sub'] ?></option>
                            <?php } ?>
                        </select>
                        <small>Biarkan form ini jika tidak ada perubahan</small>
                        <span class="help-block"><?= form_error('wisata_id') ?></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach;
?>