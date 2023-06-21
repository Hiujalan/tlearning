<?php if ($role == '1' || $role == '2' || $role == '3') { ?>


    <div class="section mt-2">
        <?php if (!empty($pembelajaran)) { ?>
            <div class="section-title">Sub Tema <?= $subtema; ?></div>
            <?php $i = 1; ?>
            <?php $n = 1; ?>
            <?php foreach ($pembelajaran as $data) { ?>
                <div class="transactions mt-2">
                    <a href="<?php echo base_url('/pembelajaran&temapelajaran=' . $kunci . '&subtema=' . $url . '&bagan=' . $data['url']) ?>" class="item">
                        <div class="detail">
                            <h1 class="text-primary"><?= $n++; ?></h1>
                            <div class="ms-2">
                                <h5>Pembelajaran <?= $i++; ?></h5>
                            </div>
                        </div>
                        <div class="right">
                            <ion-icon name="chevron-forward-outline"></ion-icon>
                        </div>
                    </a>
                    <!-- * item -->
                </div>
            <?php } ?>
        <?php } else { ?>
            <div class="section mt-2 mb-2 text-center">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-1">
                            <img src="<?php echo base_url('assets/img/illustration/error.jpg') ?>" alt="image" class="imaged w-75">
                            <h3 class="card-title">Pembelajaran Masih belum Ada</h3>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php if ($role == '1') : ?>
            <div class="position-fixed" style="bottom: 55px; right:15px;">
                <div class="row mb-2">
                    <!-- <a href="<?php echo base_url('/tambah_pembelajaran&temapelajaran=' . $kunci . '&subtema=' . $url) ?>">
                <button type="button" class="btn btn-primary "><ion-icon name="add-outline"></ion-icon></button>
            </a> -->
                </div>
                <div class="row mb-2">
                    <a href="<?php echo base_url('/edit_pembelajaran&temapelajaran=' . $kunci . '&subtema=' . $url) ?>">
                        <button type="button" class="btn btn-primary mt-3"><ion-icon name="pencil-outline"></ion-icon></button>
                    </a>
                </div>
            </div>

        <?php endif; ?>
    </div>


    <!-- <div class="container-fluid">
        <div class="row">

            <div class="col-xs-12 col-sm-12">
                <div class="container">
                    <h5 class="fw-bold mt-4 text-primary">Sub Tema <?= $subtema; ?></h5>
                    <div class="row">
                        <?php $i = 1; ?>
                        <?php foreach ($pembelajaran as $data) { ?>
                            <a href="<?php echo base_url('/pembelajaran&temapelajaran=' . $kunci . '&subtema=' . $url . '&bagan=' . $data['url']) ?>" class="col-xs-6 col-sm-6 text-decoration-none mt-3">
                                <div class="card text-center">
                                    <div class="card-body">

                                    </div>
                                    <div class="card-footer text-body-secondary">
                                        <h5>Pembelajaran <?= $i++; ?></h5>
                                    </div>
                                </div>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6">
                <div class="container">
                    <a href="<?php echo base_url('/tema=' . $kunci) ?>">
                        <button type="submit" class="btn btn-outline-primary">Kembali</button>
                    </a>

                    <?php if ($role == '1') : ?>
                        <a href="<?php echo base_url('/tambah_pembelajaran&temapelajaran=' . $kunci . '&subtema=' . $url) ?>">
                            <button type="button" class="btn btn-primary col-sm-2"><i class="fa fa-plus"></i></button>
                        </a>
                        <a href="<?php echo base_url('/edit_pembelajaran&temapelajaran=' . $kunci . '&subtema=' . $url) ?>">
                            <button type="button" class="btn btn-primary col-sm-2"><i class="fa fa-pencil"></i></button>
                        </a>

                    <?php endif; ?>
                </div>
            </div>


        </div>
    </div> -->
<?php } else { ?>
    <p>User tidak Ditemukan</p>
<?php } ?>