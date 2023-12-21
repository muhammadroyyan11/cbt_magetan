<!-- Main content -->
<section class="content">

    <div class="row">

        <!-- /.col -->
        <div class="col-md-6">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">

                    <li class="active"><a href="#settings" data-toggle="tab">Data Pelamar 1</a></li>
                </ul>
                <div class="tab-content">
                    <!-- /.tab-pane -->
                    <div class="active tab-pane" id="settings">
                        <form class="form-horizontal">
                            <center><img class="profile-user-img img-responsive" src="<?= base_url() ?>assets/uploads/foto/<?= $satu->foto ?>" alt="User profile picture"><br>
                                <a href="<?= base_url() ?>assets/uploads/cv/<?= $satu->cv ?>" target="_blank" class="btn btn-primary"><b>Download CV</b></a>
                            </center><br>
                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">Lowongan</label>

                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputName" value="<?= strtoupper($satu->title) ?>" placeholder="Name" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputEmail" value="<?= $satu->email ?>" disabled placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">No Telp</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName" value="<?= $satu->no_telp ?>" disabled placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputExperience" class="col-sm-2 control-label">Agama</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName" value="<?= $satu->agama ?>" disabled placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputExperience" class="col-sm-2 control-label">Jenjang Pendidikan</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName" value="<?= $satu->jenjang_pendidikan ?>" disabled placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputExperience" class="col-sm-2 control-label">Deskripsi melamar</label>

                                <div class="col-sm-10">
                                    <!-- <textarea name="Deskripsi" class="form-control" id="editor5" cols="30" satus="10"></textarea> -->
                                    <?= $satu->desc ?>
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

        <div class="col-md-6">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">

                    <li class="active"><a href="#settings" data-toggle="tab">Data Pelamar 2</a></li>
                </ul>
                <div class="tab-content">
                    <!-- /.tab-pane -->
                    <div class="active tab-pane" id="settings">
                        <form class="form-horizontal">
                            <center>
                                <img class="profile-user-img img-responsive" src="<?= base_url() ?>assets/uploads/foto/<?= $dua->foto ?>" alt="User profile picture"><br>
                                <a href="<?= base_url() ?>assets/uploads/cv/<?= $satu->cv ?>" target="_blank" class="btn btn-primary"><b>Download CV</b></a>
                            </center><br>
                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">Lowongan</label>

                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputName" value="<?= strtoupper($dua->title) ?>" placeholder="Name" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputEmail" value="<?= $dua->email ?>" disabled placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">No Telp</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName" value="<?= $dua->no_telp ?>" disabled placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputExperience" class="col-sm-2 control-label">Agama</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName" value="<?= $dua->agama ?>" disabled placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputExperience" class="col-sm-2 control-label">Jenjang Pendidikan</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName" value="<?= $dua->jenjang_pendidikan ?>" disabled placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputExperience" class="col-sm-2 control-label">Deskripsi melamar</label>

                                <div class="col-sm-10">
                                    <!-- <textarea name="Deskripsi" class="form-control" id="editor5" cols="30" rows="10"></textarea> -->
                                    <?= $dua->desc ?>
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
    </div>
    <!-- /.row -->

</section>
<!-- /.content -->