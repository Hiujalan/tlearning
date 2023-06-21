<?php if ($role == '1' || $role == '2' || $role == '3') { ?>

    <div class="section mb-5 p-2">

        <div class="card">
            <div class="card-body pb-1 text-center">
                <h1>Selamat.. !!</h1>

                <img src="<?php echo base_url('assets/img/illustration/congrats.jpg') ?>" alt="" class="imaged w-75">

                <p>Hasil - <?= $kunci ?> - <?= $url; ?></p>

                <div class="row">
                    <div class="col-6">
                        <h3>Jumlah Soal</h3>
                        <div class="row text-primary">
                            <div class="col-6 text-end">
                                <ion-icon name="document-outline" size="large"></ion-icon>
                            </div>
                            <div class="col-6 text-start">
                                <h1 class=" text-primary"><?= $item->soal_id; ?></h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <h3>penyelesaian</h3>
                        <div class="row">
                            <div class="col-6 text-end text-warning">
                                <ion-icon name="star-outline" size="large"></ion-icon>
                            </div>
                            <div class="col-6 text-start">
                                <?php if ($penyelesaian == '100') { ?>
                                    <h2 class=" text-warning mt-1"><?= $penyelesaian; ?>%</h2>
                                    <?php } else { ?>
                                    <h1 class=" text-warning"><?= $penyelesaian; ?>%</h2>
                                    <?php } ?>
                            </div>
                        </div>

                    </div>
                    <div class="col-6">
                        <h3>Benar</h3>
                        <div class="row">
                            <div class="col-6 text-end text-success">
                                <ion-icon name="checkmark-outline" size="large"></ion-icon>
                            </div>
                            <div class="col-6 text-start">
                                <h1 class="text-success"><?= $soalbenar; ?></h1>
                            </div>
                        </div>

                    </div>
                    <div class="col-6">
                        <h3>Salah</h3>
                        <div class="row">
                            <div class="col-6 text-end text-danger">
                                <ion-icon name="close-outline" size="large"></ion-icon>
                            </div>
                            <div class="col-6 text-start">
                                <h1 class="text-danger"><?= $soalsalah; ?></h1>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5>Skor</h5>
                        <h1 class="text-primary"><?= $skor; ?></h1>
                    </div>
                </div>

                <div class=" transparent mt-3 mb-2">
                    <form action="<?php echo base_url('/proses_soal_end&temapelajaran=' . $tema . '&subtema=' . $urlkunci . '&bagan=' . $url) ?>" method="post">
                        <input type="hidden" name="jumlah_soal" value="<?= $item->soal_id; ?>">
                        <input type="hidden" name="penyelesaian" value="<?= $penyelesaian; ?>">
                        <input type="hidden" name="benar" value="<?= $soalbenar; ?>">
                        <input type="hidden" name="salah" value="<?= $soalsalah; ?>">
                        <input type="hidden" name="skor" value="<?= $skor; ?>">

                        <button type="submit" class="btn btn-primary btn-block btn-lg">Kembali</button>
                    </form>
                </div>



            </div>
        </div>

        <!-- <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-10 text-center">
                    <h4>Hasil Soal</h4>
                    <h2>Selamat.. !!</h2>
                    <img src="" alt="">

                    <p>Hasil - <?= $kunci ?> - <?= $url; ?></p>

                    <h5>Jumlah Soal</h5>
                    <h3><?= $item->soal_id; ?></h3>

                    <h5>penyelesaian</h5>
                    <h3><?= $penyelesaian; ?>%</h3>

                    <h5>Benar</h5>
                    <h3><?= $soalbenar; ?></h3>

                    <h5>Salah</h5>
                    <h3><?= $soalsalah; ?></h3>

                    <h5>Skor</h5>
                    <h3><?= $skor; ?></h3>


                    <form action="<?php echo base_url('/proses_soal_end&temapelajaran=' . $tema . '&subtema=' . $urlkunci . '&bagan=' . $url) ?>" method="post">
                        <input type="hidden" name="jumlah_soal" value="<?= $item->soal_id; ?>">
                        <input type="hidden" name="penyelesaian" value="<?= $penyelesaian; ?>">
                        <input type="hidden" name="benar" value="<?= $soalbenar; ?>">
                        <input type="hidden" name="salah" value="<?= $soalsalah; ?>">
                        <input type="hidden" name="skor" value="<?= $skor; ?>">

                        <button type="submit" class="btn btn-primary">Kembali</button>
                    </form>

                </div>
            </div>
        </div> -->
        <script>
            localStorage.removeItem("countdown");
        </script>

    <?php } else { ?>
        <p>User tidak Ditemukan</p>
    <?php } ?>