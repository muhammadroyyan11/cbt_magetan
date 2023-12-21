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
                        <div class="pull-right">
                            <button class="btn btn-success btn-flat" data-toggle="modal" data-target="#modal-default">
                                <i class="fa fa-users"></i> Compare
                            </button>

                            <a href="<?= site_url('kelolaLowongan') ?>" class="btn btn-warning btn-flat">
                                <i class="fa fa-undo"></i> Kembali
                            </a>
                        </div>
                        <h3 class="box-title">Data <?= $title ?></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <?= $this->session->flashdata('pesan'); ?>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pelamar</th>
                                    <th>No Hp</th>
                                    <th>Email</th>
                                    <th>Status</th>
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
                                        <td><?= $data['nama'] ?></td>
                                        <td><?= $data['no_telp'] ?></td>
                                        <td><?= $data['email'] ?></td>
                                        <td><?php
                                            if ($data['status'] == 1) {
                                                echo 'Sudah di kirim';
                                            } else if ($data['status'] == 2) {
                                                echo 'Belum sesuai persyaratan';
                                            } else if ($data['status'] == 0) {
                                                echo 'Belum di kirim / Validasi';
                                            }
                                            ?></td>
                                        <td>
                                        <td>
                                            <!-- <a href="https://api.whatsapp.com/send?phone=<?= $data['no_telp'] ?>&text=Dear%20Calon%20Pegawai%2C%0A%0ADari%20hasil%20pengerjaan%20ujian%20test%2C%20anda%20dinyatakan%20lolos.%0A%0ARegard%2C%0AHRD%20PT%20TjARKINDO%20MAS" target="_blank" class="btn btn-circle btn-sm btn-success" title="Hubugi Kandidat"><i class="fa fa-fw fa-whatsapp"></i></a> -->
                                            <a href="https://api.whatsapp.com/send?phone=62<?= $data['no_telp'] ?>&text=Dear%20<?= $data['nama'] ?>%2C%0A%0ASelamat%20anda%20dinyatakan%20lolos%20administrasi%20data%2C%20Proses%20selanjutnya%20adalah%20pengerjaan%20soal%20test%20yang%20bisa%20diakses%20melalui%20link%20berikut%3A%0A%20%0A<?= base_url() ?>loker%2Fstart%2F<?= $data['ujian_id'] ?>%0A%0ASelamat%20mengerjakan%0A%0ASalam%20Hangat%2C%0AHRD%20PT%20Tjarkindo%20Mas" target="_blank" class="btn btn-circle btn-sm btn-success" title="Hubugi Kandidat"><i class="fa fa-fw fa-whatsapp"></i></a>
                                            <button class="btn btn-circle btn-sm btn-danger" title="Sudah di kirim" data-toggle="modal" data-target="#modal-edit<?= $data['id_lamaran'] ?>"><i class="fa fa-fw fa-check"></i></button>
                                            <a href="<?= base_url('kelolaLowongan/detail/') . $data['id_lamaran'] ?>" class="btn btn-circle btn-sm btn-primary" title="Detail Hasil"><i class="fa fa-fw fa-info"></i></a>
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
                <h4 class="modal-title">Pilih data pelamar</h4>
            </div>
            <?= form_open('kelolaLowongan/compare'); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Pelamar 1</label>
                    <select name="pelamar_one" class="form-control">
                        <option value="<?= $data['id_lamaran']?>">-- Silahkan Pilih --</option>
                        <?php
                        foreach ($lowongan as $key => $data) { ?>
                            <option value="<?= $data['id_lamaran']?>"><?= $data['nama'] ?></option>
                        <?php }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Pelamar 2</label>
                    <select name="pelamar_two" class="form-control">
                        <option value="">-- Silahkan Pilih --</option>
                        <?php
                        foreach ($lowongan as $key => $data) { ?>
                            <option value="<?= $data['id_lamaran']?>"><?= $data['nama'] ?></option>
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



<?php
$no = 0;
foreach ($lowongan as $key => $data) : $no++; ?>
    <div class="modal fade" id="modal-edit<?= $data['id_lamaran'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Status Pengiriman</h4>
                </div>
                <?= form_open('kelolaLowongan/done_send/') ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Pelamar</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" disabled name="nama" value="<?= $data['nama'] ?>" placeholder="Masukkan nama Ujian">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Status undangan</label>
                        <input type="hidden" class="form-control" name="lowongan_id" value="<?= $data['lowongan_id'] ?>" placeholder="Masukkan nama Ujian">
                        <input type="hidden" class="form-control" name="id_lamaran" value="<?= $data['id_lamaran'] ?>" placeholder="Masukkan nama Ujian">
                        <select name="status" id="" class="form-control">
                            <option value="NULL">-- Silahkan Pilih --</option>
                            <option value="1">Telah terkirim</option>
                            <option value="0">Belum di kirim</option>
                            <option value="2">Tidak Sesuai Persyaratan</option>
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