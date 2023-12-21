<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="title-5 m-b-35"> <?= $title ?></h3><br>

                    <form action="<?= site_url('bankSoal/prosesAdd') ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="card">
                            <div class="card-body card-block">
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="text-input" class=" form-control-label">Soal</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <div class="form-group">
                                            <center>
                                                <img src="<?= base_url() ?>assets/uploads/bank_soal/<?= $row->file ?>" style="max-width:50rem;" alt=""><br>
                                            </center>
                                            <input type="file" name="file_soal" class="form-control" style="margin-top: 15px;">
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control summernote" name="pertanyaan"><?= $this->input->post("pertanyaan") ?? $row->pertanyaan ?></textarea>
                                            <?php
                                            if ($page == 'edit') { ?>
                                                <input type="hidden" value="<?= $row->id_soal ?>" name="id_soal">
                                            <?php }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                $abjad = ['a', 'b', 'c', 'd'];
                                foreach ($abjad as $abj) :
                                    $abjd = $abj;
                                    $opsi = 'p_' . $abj;
                                ?>
                                    <div class="row form-group">
                                        <div class="col col-md-3">
                                            <label for="textarea-input" class=" form-control-label">Pilihan <?= strtoupper($abjd) ?></label>
                                        </div>
                                        <div class="col-12 col-md-9">
                                            <!-- <div class="form-group">
                                                <input type="file" name="file_<?= $abjd ?>" class="form-control">
                                            </div> -->
                                            <div class="form-group">
                                                <textarea class="form-control summernote" name="p_<?= $abjd ?>"><?= $this->input->post("p_'<?= $abjd ?>'") ?? $row->$opsi ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                <?php endforeach; ?>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="textarea-input" class=" form-control-label">Kunci Jawaban</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select name="kunci" id="" class="form-control">
                                            <option value="a" <?= $row->kunci == 'a' ? 'selected' : '' ?>>Pilihan A</option>
                                            <option value="b" <?= $row->kunci == 'b' ? 'selected' : '' ?>>Pilihan B</option>
                                            <option value="c" <?= $row->kunci == 'c' ? 'selected' : '' ?>>Pilihan C</option>
                                            <option value="d" <?= $row->kunci == 'd' ? 'selected' : '' ?>>Pilihan D</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="textarea-input" class=" form-control-label">Departement</label>
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <select name="dept_id" id="select" class="form-control">
                                            <option value="">-- Pilih Department --</option>
                                            s <?php foreach ($kategori as $l => $data) { ?>
                                                <option value="<?= $data['id_sub'] ?>" <?= $row->dept_id == $data['id_sub'] ? 'selected' : '' ?>><?= $data['nama_kategori'] ?> - <?= $data['nama_sub'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" name="<?= $page ?>" class="btn btn-primary btn-sm">
                                    <i class="fa fa-dot-circle-o"></i> Submit
                                </button>
                                <button type="reset" class="btn btn-danger btn-sm">
                                    <i class="fa fa-ban"></i> Reset
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>