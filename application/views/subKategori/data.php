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
                            <button class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modal-default">
                                <i class="fa fa-plus"></i> Add
                            </button>
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
                                    <th>Department</th>
                                    <th>Sub Department</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($sub as $key => $data) {
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $data['nama_kategori'] ?></td>
                                        <td><?= $data['nama_sub'] ?></td>
                                        <td>
                                            <button class="btn btn-circle btn-sm btn-warning" data-toggle="modal" data-target="#modal-edit<?= $data['id_sub'] ?>"><i class="fa fa-fw fa-edit"></i></button>
                                            <a onclick="return confirm('Yakin ingin menghapus data?')" href="<?= base_url('subKategori/delete/') . $data['id_sub'] ?>" class="btn btn-circle btn-sm btn-danger"><i class="fa fa-fw fa-trash"></i></a>
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
                <h4 class="modal-title">Tambah Sub Department</h4>
            </div>
            <?= form_open('SubKategori/proses'); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Sub Kategori</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="nama_sub" placeholder="Masukkan nama sub kategori">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Nama Kategori</label>
                    <select name="kategori" class="form-control select2" style="width: 100%;">
                        <option value="null">-- pilih --</option>
                        <?php
                        foreach ($kategori as $key => $data) { ?>
                            <option value="<?= $data['id_kategori'] ?>"><?= $data['nama_kategori'] ?></option>
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
foreach ($sub as $key => $data) : $no++; ?>
    <div class="modal fade" id="modal-edit<?= $data['id_sub'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Sub Department</h4>
                </div>
                <?= form_open('subKategori/prosesEdit/' . $data['id_sub']); ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Kategori</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="nama_sub" value="<?= $data['nama_sub'] ?>" placeholder="Masukkan nama kategori">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Kategori</label>
                        <select name="id_kategori" class="form-control select2" style="width: 100%;">
                            <option value="null">-- pilih --</option>
                            <?php
                            foreach ($kategori as $key => $data) { ?>
                                <option value="<?= $data['id_kategori'] ?>" <?= $data['id_kategori'] == $data['id_kategori'] ? 'selected' : '' ?>><?= $data['nama_kategori'] ?></option>
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