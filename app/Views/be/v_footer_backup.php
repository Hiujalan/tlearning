</div>

<!-- App Sidebar -->
<div class="modal fade panelbox panelbox-left" id="sidebarPanel" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <!-- profile box -->
                <div class="profileBox pt-2 pb-2">
                    <div class="image-wrapper">
                        <img src="<?php echo base_url('/uploads/profile/' . $user['foto']) ?>" alt="image" class="imaged  w36">
                    </div>
                    <div class="in">
                        <strong><?= $user['nama']; ?></strong>
                        <div class="text-muted"><?= $user['telp']; ?></div>
                    </div>
                    <a href="#" class="btn btn-link btn-icon sidebar-close" data-bs-dismiss="modal">
                        <ion-icon name="close-outline"></ion-icon>
                    </a>
                </div>
                <!-- * profile box -->

                <!-- menu -->
                <div class="listview-title mt-1">Dashboard</div>
                <ul class="listview flush transparent no-line image-listview">
                    <li>
                        <a href="<?php echo base_url('/home_be') ?>" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="pie-chart-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Dashboard
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- * menu -->

                <!-- menu -->
                <div class="listview-title mt-1">Menu</div>
                <ul class="listview flush transparent no-line image-listview">
                    <li>
                        <a href="<?php echo base_url('/be_tema') ?>" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="browsers-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Tema
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('/be_subtema') ?>" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="browsers-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Sub Tema
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('/be_pembelajaran') ?>" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="book-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Pembelajaran
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('/be_quiz') ?>" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="calendar-clear-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Quiz
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('/be_soal') ?>" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="card-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Soal
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- * menu -->

                <!-- menu -->
                <div class="listview-title mt-1">Nilai</div>
                <ul class="listview flush transparent no-line image-listview">
                    <li>
                        <a href="<?php echo base_url('/nilai_soal') ?>" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="pie-chart-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Nilai Soal
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('/nilai_quiz') ?>" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="pie-chart-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Nilai Quiz
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- * menu -->

                <!-- menu -->
                <?php if ($user['role'] == '1') { ?>
                    <div class="listview-title mt-1">User</div>
                    <ul class="listview flush transparent no-line image-listview">
                        <li>
                            <a href="<?php echo base_url('/admin') ?>" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="person-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Admin
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('/guru') ?>" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="person-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Guru
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('/murid') ?>" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="people-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Murid
                                </div>
                            </a>
                        </li>
                    </ul>

                    <div class="listview-title mt-1">Pengaturan</div>
                    <ul class="listview flush transparent no-line image-listview">
                        <li>
                            <a href="<?php echo base_url('/email') ?>" class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="mail-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    Email
                                </div>
                            </a>
                        </li>
                    </ul>
                <?php } ?>
                <!-- * menu -->

            </div>
        </div>
    </div>
</div>
<!-- * App Sidebar -->


<!-- ========= JS Files =========  -->
<!-- Bootstrap -->
<script src="<?php echo base_url('assets/js/lib/bootstrap.bundle.min.js') ?>"></script>
<!-- Ionicons -->
<script type="module" src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.js"></script>
<!-- Splide -->
<script src="<?php echo base_url('assets/js/plugins/splide/splide.min.js') ?>"></script>
<!-- Base Js File -->
<script src="<?php echo base_url('assets/js/base.js') ?>"></script>

</body>

</html>