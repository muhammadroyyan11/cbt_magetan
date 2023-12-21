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

                            <a href="<?= site_url('kelolaWawancara') ?>" class="btn btn-warning btn-flat">
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
                                    <th>Status Lamaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($wawancara as $key => $data) {
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $data['nama'] ?></td>
                                        <td><?= $data['no_telp'] ?></td>
                                        <td><?= $data['email'] ?></td>
                                        <td><?php
                                            if ($data['status'] != 1) {
                                                echo 'Belum di nilai';
                                            } else {
                                                echo 'Nilai telah di berikan';
                                            }
                                            ?></td>
                                        <td><?= $data['hasil'] ?></td>
                                        <td>
                                            <!-- <a href="https://api.whatsapp.com/send?phone=<?= $data['no_telp'] ?>&text=Dear%20Calon%20Pegawai%2C%0A%0ADari%20hasil%20pengerjaan%20ujian%20test%2C%20anda%20dinyatakan%20lolos.%0A%0ARegard%2C%0AHRD%20PT%20TjARKINDO%20MAS" target="_blank" class="btn btn-circle btn-sm btn-success" title="Hubugi Kandidat"><i class="fa fa-fw fa-whatsapp"></i></a> -->
                                            <a href="https://api.whatsapp.com/send?phone=<?= $data['no_telp'] ?>&text=Dear%20<?= $data['nama'] ?>%2C%0A%0ASelamat%20anda%20dinyatakan%20lolos%20ke%20tahap%20berikutnya%2C%20Proses%20selanjutnya%20adalah%20wawancara%20test%20yang%20di%20laksanakan%20pada%3A%0A%20%0AHari%2C%20tanggal%09%09%3A%20<?= mediumdate_indo($data['tanggal']) ?>%0APukul%09%09%09%3A%2009.00%20-%20Selesai%0ATempat%09%09%09%3A%20PT%20Tjarkindo%20Mas%0A%0A%0ASekian%20pemberitahuan%20dari%20kami%2C%20Terima%20kasih%0A%0ASalam%20Hangat%2C%0AHRD%20PT%20Tjarkindo%20Mas" target="_blank" class="btn btn-circle btn-sm btn-success" title="Hubugi Kandidat"><i class="fa fa-fw fa-whatsapp"></i></a>
                                            <?php if ($data['status'] != 1) { ?>
                                                <button class="btn btn-circle btn-sm btn-warning" title="Berikan Nilai" data-toggle="modal" data-target="#modal-edit<?= $data['id_peserta'] ?>"><i class="fa fa-fw fa-edit"></i></button>
                                            <?php
                                            } else { ?>
                                                <a href="<?= site_url('kelolaWawancara/detail/' . $data['id_peserta']) ?>" class="btn btn-circle btn-sm btn-primary" title="Detail"><i class="fa fa-fw fa-info"></i></a>
                                            <?php } ?>
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




<?php

$no = 0;
foreach ($wawancara as $key => $data) : $no++; ?>
    <div class="modal fade" id="modal-edit<?= $data['id_peserta'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Feedback</h4>
                </div>
                <?= form_open('kelolaWawancara/prosesFeedback/') ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Peserta Wawancara</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" disabled name="nama" value="<?= $data['nama'] ?>" placeholder="Masukkan nama Ujian">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tanggal selesai Wawancara</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" disabled name="tgl_selesai" value="<?= date('Y-m-d H:i:s') ?>" placeholder="Masukkan nama Ujian">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Keterangan</label>
                        <!-- <input type="text" class="form-control" id="editor1" disabled name="tgl_selesai" value="<?= date('Y-m-d H:i:s') ?>" placeholder="Masukkan nama Ujian"> -->
                        <textarea name="deskripsi" class="form-control" id="editor1" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kriteria Hasil</label>
                        <input type="hidden" class="form-control" name="peserta_id" value="<?= $data['id_peserta'] ?>" placeholder="Masukkan nama Ujian">
                        <input type="hidden" class="form-control" name="user_id" value="<?= $data['user_id'] ?>" placeholder="Masukkan nama Ujian">
                        <input type="hidden" class="form-control" name="wawancara_id" value="<?= $data['wawancara_id'] ?>" placeholder="Masukkan nama Ujian">
                        <input type="hidden" class="form-control" name="lowongan_id" value="<?= $data['lowongan_id'] ?>" placeholder="Masukkan nama Ujian">
                        <select name="kriteria" id="" class="form-control">
                            <option value="NULL">-- Silahkan Pilih --</option>
                            <option value="Kurang">Kurang</option>
                            <option value="Cukup">Cukup</option>
                            <option value="Baik">Baik</option>
                        </select>
                    </div>
                    <!-- <div class="form-group">
                        <label for="exampleInputEmail1">Hasil Akhir Lamaran</label>
                        <select name="status_pelamar" id="" class="form-control">
                            <option value="NULL">-- Silahkan Pilih --</option>
                            <option value="Di Terima">Di terima kerja</option>
                            <option value="Tidak Di Terima">Tidak di terima</option>
                        </select>
                    </div> -->
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