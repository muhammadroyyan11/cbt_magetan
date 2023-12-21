<section class="content-header">
    <h1>
        Users
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Users</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Input visitor <?= $row->nama ?></h3>
        </div>

        <div class="box-body">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">

                    <form action="<?= site_url('visitor/proses') ?>" method="post">
                        <div class="form-group <?= form_error('dewasa') ? 'has-error' : null ?>">
                            <label>Dewasa / Adult *</label>
                            <input type="number" name="dewasa" value="<?= set_value('dewasa') ?>" class="form-control">
                            <span class="help-block"><?= form_error('dewasa') ?></span>
                        </div>
                        <div class="form-group <?= form_error('anak') ? 'has-error' : null ?>">
                            <label>Anak - Anak / Childern *</label>
                            <input type="number" name="anak" value="<?= set_value('anak') ?>" class="form-control">
                            <span class="help-block"><?= form_error('anak') ?></span>
                        </div>

                        <input type="hidden" name="wisata_id" value="<?= userdata('wisata_id') ?>" class="form-control" disabled>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-flat">Simpan</button>
                            <button type="reset" class="btn btn-danger btn-flat">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>