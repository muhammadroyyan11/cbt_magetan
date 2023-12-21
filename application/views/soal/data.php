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
                            <a href="<?= site_url('bankSoal/add')?>" class="btn btn-primary btn-flat">
                                <i class="fa fa-plus"></i> Add
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
                                    <th>Pertanyaan</th>
                                    <th>Pilihan A</th>
                                    <th>Pilihan B</th>
                                    <th>Pilihan C</th>
                                    <th>Pilihan D</th>
                                    <th>kunci jawaban</th>
                                    <th>Sub Department</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($soal as $key => $data) {
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= character_limiter($data['pertanyaan'], 200) ?></td>
                                        <td><?= $data['p_a'] ?></td>
                                        <td><?= $data['p_b'] ?></td>
                                        <td><?= $data['p_c']?></td>
                                        <td><?= $data['p_d']?></td>
                                        <td><?= $data['kunci'] ?></td>
                                        <td><?= $data['nama_sub'] ?></td>
                                        <td>
                                            <a href="<?= base_url('bankSoal/edit/') . $data['id_soal'] ?>" class="btn btn-circle btn-sm btn-warning"><i class="fa fa-fw fa-edit"></i></a>
                                            <a onclick="return confirm('Yakin ingin menghapus data?')" href="<?= base_url('bankSoal/del/') . $data['id_soal'] ?>" class="btn btn-circle btn-sm btn-danger"><i class="fa fa-fw fa-trash"></i></a>
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