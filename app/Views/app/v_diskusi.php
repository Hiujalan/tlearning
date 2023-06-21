<?php if ($role == '1' || $role == '2' || $role == '3') { ?>

    <h4 class="text-center mt-2">Diskusi tentang '<span class="text-primary"><?= $diskusi; ?></span>'</h4>

    <?php foreach ($item as $data) { ?>
        <div class="message-item <?= ($data['telp'] == $telpuser) ? 'user' : ''; ?>">
            <?php if ($data['telp'] !== $telpuser) { ?>
                <img src="<?= (strpos($data['foto'], 'https') !== false) ? $data['foto'] : base_url('uploads/profile/' . $data['foto']); ?>" class="avatar">
            <?php } ?>
            <div class="content">
                <?php if ($data['telp'] !== $telpuser) { ?>
                    <div class="title"><?= $data['nama']; ?></div>
                <?php } ?>
                <div class="bubble">
                    <?= $data['pesan']; ?>
                </div>
                <div class="footer"><?= date('H:i', strtotime($data['created_at'])); ?></div>
            </div>
        </div>
    <?php } ?>

    <!-- chat footer -->
    <div class="chatFooter">
        <form action="<?php echo base_url('/proses_diskusi&subtema=' . $kunci . '&bagan=' . $url . '&diskusi=' . $diskusi) ?>" method="post">
            <div class="form-group basic">
                <div class="input-wrapper">
                    <input type="text" class="form-control" name="pesan" placeholder="Kirim Pesan">
                    <i class="clear-input">
                        <ion-icon name="close-circle"></ion-icon>
                    </i>
                </div>
            </div>
            <button type="submit" class="btn btn-icon btn-primary rounded">
                <ion-icon name="arrow-forward-outline"></ion-icon>
            </button>
        </form>
    </div>
    <!-- * chat footer -->


    <!-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-xs-12 col-sm-10 mt-5">
                <h4 class="text-center">Diskusi tentang '<?= $diskusi; ?>'</h4>

                <?php foreach ($item as $data) { ?>
                    <div class="card col-sm-4 mt-3">
                        <div class="card-body">
                            <img src="<?= $data['foto']; ?>" alt="" width="70px">
                            <img src="<?php echo base_url('/uploads/profile/' . $data['foto']) ?>" alt="" width="70px">
                            <h5><?= $data['nama']; ?></h5>
                            <p><?= $data['pesan']; ?></p>
                        </div>
                    </div>
                <?php } ?>

                <a href="<?php echo base_url('/pembelajaran&temapelajaran=' . $tema . '&subtema=' . $kunci . '&bagan=' . $url) ?>">
                    <button type="submit" class="btn btn-outline-primary">Kembali</button>
                </a>
            </div>
            <div class="col-xs-12 col-sm-10 mt-5">
                <form action="<?php echo base_url('/proses_diskusi&subtema=' . $kunci . '&bagan=' . $url . '&diskusi=' . $diskusi) ?>" method="post">
                    <div class="input-group">
                        <input type="text" class="form-control" name="pesan" placeholder="Kirim Pesan">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fa "></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div> -->

    <!-- ========= JS Files =========  -->
    <!-- Bootstrap -->
    <script src="<?php echo base_url('assets/js/lib/bootstrap.bundle.min.js') ?>"></script>
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.js"></script>
    <!-- Splide -->
    <script src="<?php echo base_url('assets/js/plugins/splide/splide.min.js') ?>"></script>
    <!-- Base Js File -->
    <script src="<?php echo base_url('assets/js/base.js') ?>"></script>
<?php } else { ?>
    <p>User tidak Ditemukan</p>
<?php } ?>