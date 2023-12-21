<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive" src="<?= base_url() ?>assets/uploads/foto/<?= $row->foto ?>" alt="User profile picture">

                    <h3 class="profile-username text-center"><?= $row->nama ?></h3>

                    <p class="text-muted text-center">Peserta Wawancara</p>


                    <a href="<?= base_url() ?>assets/uploads/cv/<?= $row->cv ?>" target="_blank" class="btn btn-primary btn-block"><b>Download CV</b></a>
                    <a href="<?= site_url('kelolaWawancara/terima/'.$row->id_haswan) ?>" class="btn btn-success btn-block"><b>Di terima</b></a>
                    <a href="<?= site_url('kelolaWawancara/tolak/'.$row->id_haswan) ?>" class="btn btn-danger btn-block"><b>Tidak di terima</b></a>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#settings" data-toggle="tab">Detail</a></li>
                </ul>
                <div class="tab-content">
                    <!-- /.tab-pane -->
                    <div class="active tab-pane" id="settings">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputEmail" value="<?= $row->email ?>" disabled placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">No Telp</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName" value="<?= $row->no_telp ?>" disabled placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputExperience" class="col-sm-2 control-label">Agama</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName" value="<?= $row->agama ?>" disabled placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputExperience" class="col-sm-2 control-label">Jenjang Pendidikan</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName" value="<?= $row->jenjang_pendidikan ?>" disabled placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputExperience" class="col-sm-2 control-label">Kesimpulan</label>

                                <div class="col-sm-10">
                                    <textarea name="Deskripsi" class="form-control" id="editor1" cols="30" rows="10" disabled><?= $row->deskripsi ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputExperience" class="col-sm-2 control-label">Waktu selesai wawancara</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName" value="<?= $row->tgl_selesai ?>" disabled placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputExperience" class="col-sm-2 control-label">Kriteria</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName" value="<?= $row->kriteria ?>" disabled placeholder="Name">
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <button type="submit" class="btn btn-success btn-flat">Simpan</button>
                            </div> -->
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