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
                                <th>Destination Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($des as $key => $data) {
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $data['nama'] ?></td>
                                    <td>
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#modal-edit<?= $data['id_wisata'] ?>">
                                            <i class="fa fa-plus"></i> Edit
                                        </button>
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

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Input New Destination</h4>
            </div>
            <?= form_open('destination/proses'); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="destination" placeholder="Input destination name">
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

<!-- Modal Ubah -->
<?php
$no = 0;
foreach ($des as $key => $data) : $no++ ?>
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="modal-edit<?= $data['id_wisata'] ?>" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h4 class="modal-title">Ubah Data</h4>
                </div>
                <form class="form-horizontal" action="<?= site_url('destination/edit/' . $data['id_wisata']) ?>" method="post" enctype="multipart/form-data" role="form">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-lg-2 col-sm-2 control-label">Nama Wisata</label>
                            <div class="col-lg-10">
                                <input type="hidden" id="id_wisata" value=<?= $data['id_wisata'] ?> name="id_wisata">
                                <input type="text" class="form-control" id="nama" name="nama" value="<?= $data['nama'] ?>" placeholder="Tuliskan Nama Wisata">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-info" type="submit"> Simpan&nbsp;</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal"> Batal</button>
                    </div>+
                </form>
            </div>
        </div>
    </div>
<?php
endforeach;
?>
<!-- END Modal Ubah -->