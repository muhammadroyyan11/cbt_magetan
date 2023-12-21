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

            <?php 
            if (userdata('role') == 1) { ?>
                <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <!-- <div class="pull-right">
                        <button class="btn btn-primary btn-flat" data-toggle="modal" data-target="#modal-default">
                            <i class="fa fa-plus"></i> Add
                        </button>
                    </div> -->
                        <h3 class="box-title">Print <?= $title ?></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <?= $this->session->flashdata('pesan'); ?>
                        <?= form_open(); ?>
                        <div class="form-group">
                            <div class="form-group has-feedback">
                                <label for="inputPassword3" class="col-sm-2 control-label">Periode Tanggal</label>

                                <div class="col-sm-10">
                                    <input type="text" id="reservation" class="form-control" name="tanggal" placeholder="Pilih Range Tanggal" value="<?= set_value('tanggal'); ?>">
                                    <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
                                </div>
                            </div>
                        </div><br><br>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info pull-right">Cetak</button>
                        </div>
                        <!-- /.box-footer -->
                        <?= form_close(); ?>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <?php }
            ?> 
            


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
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Destination Name</th>
                                    <th>Amount</th>
                                    <th>Age group</th>
                                    <th>Date Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($report as $key => $data) {
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $data->nama ?></td>
                                        <td><?= $data->jumlah ?></td>
                                        <td><?= $data->golongan ?></td>
                                        <td><?= $data->dateTime ?></td>
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