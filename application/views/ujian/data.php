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
                        <!-- <div class="pull-right">
                            <button class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modal-default">
                                <i class="fa fa-plus"></i> Add
                            </button>
                        </div> -->
                        <h3 class="box-title">Data <?= $title ?></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <?= $this->session->flashdata('pesan'); ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Ujian</th>
                                    <th>Jenis Soal</th>
                                    <th>Jumlah Soal</th>
                                    <th>Waktu</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($ujian as $key => $data) {
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $data['nama_ujian'] ?></td>
                                        <td><?= $data['jenis'] ?></td>
                                        <td><?= $data['jumlah_soal'] ?></td>
                                        <td><?= $data['waktu'] ?> Menit</td>
                                        <td>
                                            <button class="btn btn-circle btn-sm btn-warning" data-toggle="modal" data-target="#modal-edit<?= $data['id_ujian'] ?>"><i class="fa fa-fw fa-edit"></i></button>
                                            <a onclick="return confirm('Yakin ingin menghapus data?')" href="<?= base_url('ujian/delete/') . $data['id_ujian'] ?>" class="btn btn-circle btn-sm btn-danger"><i class="fa fa-fw fa-trash"></i></a>
                                            <a href="<?= base_url('ujian/report/') . $data['id_ujian'] ?>" class="btn btn-circle btn-sm btn-primary"><i class="fa fa-fw fa-file-text-o "></i></a>
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
                <h4 class="modal-title">Tambah Ujian lowongan</h4>
            </div>
            <?= form_open('ujian/proses'); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama ujian</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="ujian" placeholder="Masukkan nama Ujian">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Jenis Soal</label>
                    <select name="jenis" id="" class="form-control select2" style="width: 100%;">
                        <option value="acak">Acak</option>
                        <option value="urut">Urut</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Jumlah Soal</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" name="jumlah" placeholder="Masukkan Jumlah soal">
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
                    <label for="exampleInputEmail1">Untuk Lowongan</label>
                    <select name="lowongan_id" id="" class="form-control select2" style="width: 100%;">
                        <option value="urut" disabled>-- Pilih Lowongan --</option>
                        <?php
                        foreach ($lowongan as $key => $data) { ?>
                            <option value="<?= $data['id_lowongan'] ?>"><?= $data['title'] ?></option>
                        <?php }
                        ?>

                    </select>
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
foreach ($ujian as $key => $data) : $no++; ?>
    <div class="modal fade" id="modal-edit<?= $data['id_ujian'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit ujian lowongan</h4>
                </div>
                <?= form_open('ujian/prosesEdit/' . $data['id_ujian']); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama ujian</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="ujian" value="<?= $data['nama_ujian']?>" placeholder="Masukkan nama Ujian">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Jenis Soal</label>
                        <select name="jenis" id="" class="form-control select2" style="width: 100%;">
                            <option value="acak" <?= $data['jenis'] == 'acak' ? 'selected' : '' ?>>Acak</option>
                            <option value="urut" <?= $data['jenis'] == 'urut' ? 'selected' : '' ?>>Urut</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Jumlah Soal</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" name="jumlah" value="<?= $data['jumlah_soal']?>" placeholder="Masukkan Jumlah soal">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Waktu Ujian (Menit)</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" name="waktu" value="<?= $data['waktu'] ?>" placeholder="Masukkan Jumlah soal">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tanggal Selesai Ujian</label>
                        <input type="datetime-local" class="form-control" id="exampleInputEmail1" name="tgl_selesai" value="<?= $data['tgl_selesai'] ?>" placeholder="Masukkan waktu dalam bentuk menit">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Untuk Lowongan</label>
                        <select name="lowongan_id" id="" class="form-control select2" style="width: 100%;">
                            <option value="urut" disabled>-- Pilih Lowongan --</option>
                            <?php
                            $row = $data['lowongan_id'];
                            foreach ($lowongan as $key => $data) { ?>
                                <option value="<?= $data['id_lowongan'] ?>" <?= $row == $data['id_lowongan'] ? 'selected' : '' ?>><?= $data['title'] ?></option>
                            <?php }
                            ?>

                        </select>
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