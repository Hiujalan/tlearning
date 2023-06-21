<?php if (isset($user['telp'])) { ?>

    <!-- BEGIN Page Content -->
    <div class="content">
        <div class="container-fluid g-5">
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN Portlet -->
                    <div class="portlet">
                        <div class="portlet-header portlet-header-bordered">
                            <h3 class="portlet-title">Edit Pembelajaran</h3>
                        </div>
                        <form action="<?php echo base_url('/be_proses_edit_pembelajaran_data&subtema=' . $kunci . '&bagan=' . $url) ?>" method="post" enctype="multipart/form-data">
                            <div class="portlet-body">
                                <!-- BEGIN Grid -->
                                <div class="d-grid gap-3">
                                    <div>
                                        <label for="" class="form-label">Pembelajaran</label>
                                        <input type="text" name="pembelajaran" id="pembelajaran" class="form-control col-xs-12" value="<?= $item['pembelajaran']; ?>">
                                    </div>
                                    <div>
                                        <label for="" class="form-label">Judul Video</label>
                                        <input type="text" name="judulvideo" id="judulvideo" class="form-control col-xs-12" value="<?= $item['judul_video']; ?>">
                                    </div>
                                    <div>
                                        <label for="" class="form-label">File Video</label>
                                        <div class="input-group">
                                            <input type="file" name="video" class="form-control col-xs-12">
                                            <label class="input-group-text" for="inputGroupFile02"><?= $item['nama_video']; ?></label>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="input-wrapper">
                                            <label for="" class="form-label">Judul Materi</label>
                                            <input type="text" name="judulmateri" id="judulmateri" class="form-control col-xs-12" value="<?= $item['judul_materi']; ?>">
                                        </div>
                                    </div>
                                    <div>
                                        <label for="" class="form-label">File Materi</label>
                                        <div class="input-group">
                                            <input type="file" name="materi" class="form-control col-xs-12">
                                            <label class="input-group-text" for="inputGroupFile02"><?= $item['nama_materi']; ?></label>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="" class="form-label">Diskusi</label>
                                        <input type="text" name="diskusi" id="diskusi" class="form-control col-xs-12" value="<?= $item['diskusi']; ?>">
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-block btn-lg my-2">Simpan</button>
                                </div>
                                <!-- END Grid -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->

    <!-- <div class="section mb-5 p-2">

        <form action="<?php echo base_url('/be_proses_edit_pembelajaran_data&subtema=' . $kunci . '&bagan=' . $url) ?>" method="post" enctype="multipart/form-data">
            <div class="card">
                <div class="card-body pb-1">
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label for="" class="form-label">Pembelajaran</label>
                            <input type="text" name="pembelajaran" id="pembelajaran" class="form-control col-xs-12" value="<?= $item['pembelajaran']; ?>">
                        </div>

                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label for="" class="form-label">Judul Video</label>
                            <input type="text" name="judulvideo" id="judulvideo" class="form-control col-xs-12" value="<?= $item['judul_video']; ?>">
                        </div>

                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label for="" class="form-label">File Video</label>
                            <div class="input-group">
                                <input type="file" name="video" class="form-control col-xs-12">
                                <label class="input-group-text" for="inputGroupFile02"><?= $item['nama_video']; ?></label>
                            </div>
                        </div>

                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label for="" class="form-label">Judul Materi</label>
                            <input type="text" name="judulmateri" id="judulmateri" class="form-control col-xs-12" value="<?= $item['judul_materi']; ?>">
                        </div>

                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label for="" class="form-label">File Materi</label>
                            <div class="input-group">
                                <input type="file" name="materi" class="form-control col-xs-12">
                                <label class="input-group-text" for="inputGroupFile02"><?= $item['nama_materi']; ?></label>
                            </div>
                        </div>

                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label for="" class="form-label">Diskusi</label>
                            <input type="text" name="diskusi" id="diskusi" class="form-control col-xs-12" value="<?= $item['diskusi']; ?>">
                        </div>

                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>


                    <div class=" transparent mt-3 mb-2">
                        <button type="submit" class="btn btn-primary btn-block btn-lg">Simpan</button>
                    </div>

                </div>
            </div>
        </form> -->
    <?php } else { ?>
        <p>Admin tidak Ditemukan</p>
    <?php } ?>