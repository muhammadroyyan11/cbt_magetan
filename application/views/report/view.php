<section class="content">


    <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Cetak rekap data</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?= form_open(); ?>
            <div class="box-body">
                <?= $this->session->flashdata('pesan'); ?>  
                <div class="form-group">
                    
                <div class="form-group has-feedback">
                    <label for="inputPassword3" class="col-sm-2 control-label">Periode Tanggal</label>

                    <div class="col-sm-10">
                        <input type="text" id="reservation" class="form-control" name="tanggal" placeholder="Pilih Range Tanggal" value="<?= set_value('tanggal'); ?>">
                        <span class="glyphicon glyphicon-calendar form-control-feedback"></span>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right">Cetak</button>
            </div>
            <!-- /.box-footer -->
            <?= form_close(); ?>
        </div>
    </div>
    <!-- /.col -->

</section>