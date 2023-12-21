<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive" src="<?= base_url() ?>assets/uploads/foto/<?= $row->foto ?>" alt="User profile picture">

                    <h3 class="profile-username text-center"><?= $row->nama ?></h3>

                    <p class="text-muted text-center">Calon Karyawan</p>


                    <a href="<?= base_url() ?>assets/uploads/cv/<?= $row->cv ?>" target="_blank" class="btn btn-primary btn-block"><b>Download CV</b></a>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

            <!-- About Me Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Biodata</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <strong><i class="fa fa-book margin-r-5"></i> Nomor Hp</strong>

                    <p class="text-muted">
                        <?= $row->no_telp ?>
                    </p>

                    <hr>

                    <strong><i class="fa fa-map-marker margin-r-5"></i> Alamat lengkap</strong>

                    <p class="text-muted"> <?= $row->alamat ?></p>
                    <hr>
                    <strong><i class="fa fa-file-text-o margin-r-5"></i> Jenjang Pendidikan</strong>

                    <p class="text-muted"><?= $row->jenjang_pendidikan ?></p>
                    <hr>
                    <strong><i class="fa fa-file-text-o margin-r-5"></i> Agama</strong>

                    <p class="text-muted"> <?= $row->agama ?></p>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">

                    <li class="active"><a href="#settings" data-toggle="tab">Hasil Ujian</a></li>
                </ul>
                <div class="tab-content">
                    <!-- /.tab-pane -->
                    <div class="active tab-pane" id="settings">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">Lowongan</label>

                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputName" value="<?= strtoupper($row->title) ?>" placeholder="Name" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="col-sm-2 control-label">Section</label>

                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputEmail" value="<?= $row->section ?>" disabled placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">Nilai Ujian</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName" value="<?= $row->nilai ?>" disabled placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputExperience" class="col-sm-2 control-label">Hasil Keputusan</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName" value="<?= $row->statusLamaran ?>" disabled placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputExperience" class="col-sm-2 control-label">Deskripsi melamar</label>

                                <div class="col-sm-10">
                                    <!-- <textarea name="Deskripsi" class="form-control" id="editor5" cols="30" rows="10"></textarea> -->
                                    <?= $row->deskripsi ?>
                                </div>
                            </div>


                        </form>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

</section>
<!-- /.content -->