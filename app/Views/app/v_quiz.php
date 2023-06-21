<?php if ($role == '1' || $role == '2' || $role == '3') { ?>
    <?php if (!empty($item)) { ?>
        <div class="section mb-5 p-2">
            <div class="col-12">
                <div class="section-title text-primary">Daftar Quiz</div>
                <div class="row">
                    <?php $i = 1; ?>
                    <?php foreach ($item as $data) { ?>
                        <?php if (!empty($quiz)) { ?>
                            <?php foreach ($quiz as $row) { ?>
                                <div class="col-2 text-center mt-1">
                                    <a href="<?= base_url('/quiz_data&temapelajaran=' . $tema . '&subtema=' . $kunci . '&bagan=' . $url . '&id=' . $data['soal_id']) ?>" class="text-decoration-none">
                                        <div class="card <?= $data['soal_id'] == $row['soal_id'] ? 'bg-primary' : '' ?>">
                                            <div class="card-body">
                                                <h3 class="card-title"><?= $i++; ?></h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php } ?>
                        <?php } else { ?>
                            <div class="col-2 text-center mt-1">
                                <a href="<?= base_url('/quiz_data&temapelajaran=' . $tema . '&subtema=' . $kunci . '&bagan=' . $url . '&id=' . $data['soal_id']) ?>" class="text-decoration-none">
                                    <div class="card">
                                        <div class="card-body">
                                            <h3 class="card-title"><?= $i++; ?></h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    <?php } ?>

                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="section mt-2 mb-2 text-center">
            <div class="card">
                <div class="card-body">
                    <div class="mb-1">
                        <img src="<?php echo base_url('assets/img/illustration/error.jpg') ?>" alt="image" class="imaged w-75">
                        <h3 class="card-title">Quiz Masih belum Ada</h3>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <!-- <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <?php $i = 1; ?>
                <?php foreach ($item as $data) { ?>
                    <div class="col-sm-1">
                        <a href="<?php echo base_url('/quiz_data&temapelajaran=' . $tema . '&subtema=' . $kunci . '&bagan=' . $url . '&id=' . $data['soal_id']) ?>" class="text-decoration-none">
                            <div class="card ">
                                <div class="card-body">
                                    <h3 class="card-title"><?= $i++; ?></h3>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php } ?>

                <a href="<?php echo base_url('/pembelajaran&temapelajaran=' . $tema . '&subtema=' . $kunci . '&bagan=' . $url) ?>">
                    <button type="submit" class="btn btn-primary">Kembali</button>
                </a>
            </div>
        </div>
    </div> -->
<?php } else { ?>
    <p>User tidak Ditemukan</p>
<?php } ?>