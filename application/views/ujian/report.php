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
                            <?php
                            if ($count > 0) {
                                if ($row->section == 'Staff Kantor') { ?>
                                    <a href="<?= site_url('Ujian/generate_kantor/' . $id) ?>" class="btn btn-danger btn-flat">
                                        <i class="fa fa-undo"></i> Generate Hasil
                                    </a>
                                <?php } else { ?>
                                    <a href="<?= site_url('Ujian/generate/' . $id) ?>" class="btn btn-danger btn-flat">
                                        <i class="fa fa-undo"></i> Generate
                                    </a>
                            <?php }
                            }
                            ?>

                            <a href="<?= site_url('Ujian') ?>" class="btn btn-warning btn-flat">
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
                                    <th>Lowongan</th>
                                    <th>Nilai</th>
                                    <th>Keputusan</th>
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
                                        <td><?= $data['nama'] ?></td>
                                        <td><?= $data['no_telp'] ?></td>
                                        <td><?= $data['email'] ?></td>
                                        <td><?= $data['title'] ?> </td>
                                        <td><?= $data['nilai'] ?> </td>
                                        <td><?= $data['hasilUjian'] ?> </td>
                                        <td>
                                            <!-- <a href="https://api.whatsapp.com/send?phone=<?= $data['no_telp'] ?>&text=Dear%20Calon%20Pegawai%2C%0A%0ADari%20hasil%20pengerjaan%20ujian%20test%2C%20anda%20dinyatakan%20lolos.%0A%0ARegard%2C%0AHRD%20PT%20TjARKINDO%20MAS" target="_blank" class="btn btn-circle btn-sm btn-success" title="Hubugi Kandidat"><i class="fa fa-fw fa-whatsapp"></i></a> -->
                                            <a href="<?= base_url('ujian/detail/') . $data['id_hasil'] ?>" class="btn btn-circle btn-sm btn-primary" title="Detail Hasil"><i class="fa fa-fw fa-info"></i></a>
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