<?php if ($role == '1' || $role == '2' || $role == '3') { ?>

    <div class="section mt-2">
        <div class="section-title text-primary">Pembelajaran</div>
        <div class="text-center row">
            <video class="col-12" controls>
                <source src="<?php echo base_url('uploads/videos/' . $item['video']); ?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <div class="transactions">
            <!-- item -->

            <div class="item row mt-3">
                <div class="detail ">
                    <div class="col-6">
                        <h4 class="fw-bold">Materi Pembelajaran</h4>
                    </div>
                    <div class="col-6">
                        <div class="text-end">
                            <ion-icon name="document-outline" size="large"></ion-icon>
                        </div>
                    </div>
                </div>
                <div class="detail">
                    <div class="col-12">
                        <h5>Unduh Materi Tentang '<?= $item['judul_materi']; ?>' untuk belajar Kapanpun dan Dimanapun</h5>
                        <a href="<?php echo base_url('/download_file&file=' . $url) ?>" class="col-xs-6 col-sm-6 text-decoration-none ">
                            <button type="button" class="btn btn-lg btn-primary btn-block mt-1">Unduh Materi</button>
                        </a>
                    </div>
                </div>
            </div>

            <!-- * item -->
            <!-- item -->
            <a href="<?php echo base_url('/diskusi&temapelajaran=' . $tema . '&subtema=' . $kunci . '&bagan=' . $url . '&diskusi=' . $diskusi) ?>" class="col-xs-6 col-sm-6 text-decoration-none mt-3">
                <div class="item row">
                    <div class="detail ">
                        <div class="col-6">
                            <h4 class="fw-bold">Diskusi</h4>
                        </div>
                        <div class="col-6">
                            <div class="text-end">
                                <ion-icon name="chatbubbles-outline" size="large"></ion-icon>
                            </div>
                        </div>
                    </div>
                    <div class="detail">
                        <div class="col-12">
                            <h5><?= $item['diskusi']; ?></h5>
                        </div>
                    </div>
                </div>
            </a>
            <!-- * item -->
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6 <?= isset($idsoal) && $jawabsoal == null ? 'col-6' : 'col-12'; ?>">
                        <a href="<?php echo base_url('/quiz&temapelajaran=' . $tema . '&subtema=' . $kunci . '&bagan=' . $url) ?>" class="btn btn-lg btn-outline-primary btn-block">Quiz
                        </a>
                    </div>
                    <div class="col-6">
                        <?php if ($jawabsoal == '0') { ?>
                        <?php } else { ?>
                            <?php if (isset($idsoal)) { ?>
                                <button type="button" class="btn btn-primary btn-block btn-lg" data-bs-toggle="modal" data-bs-target="#DialogBasic">Soal</button>
                        <?php }
                        } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade dialogbox" id="DialogBasic" data-bs-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Soal</h5>
                    </div>
                    <div class="modal-body">
                        Apa Anda Yakin?
                    </div>
                    <div class="modal-footer">
                        <div class="btn-inline">
                            <a href="#" class="btn btn-text-secondary" data-bs-dismiss="modal">CANCEL</a>
                            <a href="<?php echo base_url('/soal&temapelajaran=' . $tema . '&subtema=' . $kunci . '&bagan=' . $url . '&id=' . $idsoal) ?>" class="btn btn-text-primary">IYA</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <?php if ($role == '1') : ?>

            <div class="position-fixed" style="bottom: 55px; right:15px;">
                <div class="row mb-2">
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <ion-icon name="pencil-outline"></ion-icon>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?php echo base_url('/create_quiz&temapelajaran=' . $tema . '&subtema=' . $kunci . '&bagan=' . $url) ?>">
                                <ion-icon name="add-outline"></ion-icon>
                                Buat Quiz
                            </a>
                            <a class="dropdown-item" href="<?php echo base_url('/create_soal&temapelajaran=' . $tema . '&subtema=' . $kunci . '&bagan=' . $url) ?>">
                                <ion-icon name="add-outline"></ion-icon>
                                Buat Soal
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        <?php endif; ?> -->
    </div>

    <!-- <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 mt-5">
                <video class="col-xs-12 col-sm-12" controls>
                    <source src="<?php echo base_url('uploads/videos/' . $item['video']); ?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>

            <div class="col-xs-12 col-sm-6 mt-5">
                <div class="row">
                    <div class="col-xs-12 mb-3">
                        <a href="<?php echo base_url('/download_file&file=' . $url) ?>" class="col-xs-6 col-sm-6 text-decoration-none mt-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h4 class="fw-bold">Unduh materi Pembelajaran</h4>
                                </div>
                                <div class="card-footer text-body-secondary">
                                    <h5>Unduh Materi Tentang '<?= $item['judul_materi']; ?>' untuk belajar Kapanpun dan Dimanapun</h5>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-xs-12 mb-3">
                        <a href="<?php echo base_url('/diskusi&temapelajaran=' . $tema . '&subtema=' . $kunci . '&bagan=' . $url . '&diskusi=' . $diskusi) ?>" class="col-xs-6 col-sm-6 text-decoration-none mt-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h4 class="fw-bold">Diskusi</h4>
                                </div>
                                <div class="card-footer text-body-secondary">
                                    <h5><?= $item['diskusi']; ?></h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12">
                <a href="<?php echo base_url('/temapelajaran=' . $tema . '&subtema=' . $kunci) ?>">
                    <button type="submit" class="btn btn-outline-primary">Kembali</button>
                </a>

                <a href="<?php echo base_url('/quiz&temapelajaran=' . $tema . '&subtema=' . $kunci . '&bagan=' . $url) ?>">
                    <button type="submit" class="btn btn-primary">Quiz</button>
                </a>
                <?php if (isset($idsoal)) { ?>
                    <a href="<?php echo base_url('/soal&temapelajaran=' . $tema . '&subtema=' . $kunci . '&bagan=' . $url . '&id=' . $idsoal) ?>">
                        <button type="submit" class="btn btn-outline-primary" onclick="alert('Apakah anda yakin ingin mengerjakan')">Soal</button>
                    </a>
                <?php } ?>

                <?php if ($role == '1') : ?>
                    <a href="<?php echo base_url('/create_quiz&temapelajaran=' . $tema . '&subtema=' . $kunci . '&bagan=' . $url) ?>">
                        <button type="submit" class="btn btn-outline-primary">
                            <i class="fa fa-plus"></i> Buat Quiz
                        </button>
                    </a>
                    <a href="<?php echo base_url('/create_soal&temapelajaran=' . $tema . '&subtema=' . $kunci . '&bagan=' . $url) ?>">
                        <button type="submit" class="btn btn-outline-primary">
                            <i class="fa fa-plus"></i> Buat Soal
                        </button>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div> -->
<?php } else { ?>
    <p>User tidak Ditemukan</p>
<?php } ?>