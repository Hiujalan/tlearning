<?php if (isset($user['telp'])) { ?>

    <!-- BEGIN Page Content -->
    <div class="content">
        <div class="container-fluid g-5">
            <div class="row">
                <div class="col-12">
                    <!-- BEGIN Portlet -->
                    <div class="portlet">
                        <!-- BEGIN Widget -->
                        <div class="widget10 widget10-vertical-md">
                            <?php if ($user['role'] == '1') { ?>
                                <div class="widget10-item">
                                    <div class="widget10-content">
                                        <h2 class="widget10-title"><?= $totalguru; ?></h2>
                                        <span class="widget10-subtitle">Total Guru</span>
                                    </div>
                                    <div class="widget10-addon">
                                        <!-- BEGIN Avatar -->
                                        <div class="avatar avatar-label-info avatar-circle widget10-avatar">
                                            <div class="avatar-display">
                                                <i class="fa-solid fa-user"></i>
                                            </div>
                                        </div>
                                        <!-- END Avatar -->
                                    </div>
                                </div>
                                <div class="widget10-item">
                                    <div class="widget10-content">
                                        <h2 class="widget10-title"><?= $totaluser; ?></h2>
                                        <span class="widget10-subtitle">Total Murid</span>
                                    </div>
                                    <div class="widget10-addon">
                                        <!-- BEGIN Avatar -->
                                        <div class="avatar avatar-label-primary avatar-circle widget10-avatar">
                                            <div class="avatar-display">
                                                <i class="fa-solid fa-users"></i>
                                            </div>
                                        </div>
                                        <!-- END Avatar -->
                                    </div>
                                </div>
                            <?php } elseif ($user['role'] == '2') { ?>
                                <div class="widget10-item">
                                    <div class="widget10-content">
                                        <h2 class="widget10-title"><?= $jumlahtema; ?></h2>
                                        <span class="widget10-subtitle">Jumlah Tema</span>
                                    </div>
                                    <div class="widget10-addon">
                                        <!-- BEGIN Avatar -->
                                        <div class="avatar avatar-label-success avatar-circle widget10-avatar">
                                            <div class="avatar-display">
                                                <i class="fa-solid fa-file"></i>
                                            </div>
                                        </div>
                                        <!-- END Avatar -->
                                    </div>
                                </div>
                                <div class="widget10-item">
                                    <div class="widget10-content">
                                        <h2 class="widget10-title"><?= $jumlahsubtema; ?></h2>
                                        <span class="widget10-subtitle">Jumlah Subtema</span>
                                    </div>
                                    <div class="widget10-addon">
                                        <!-- BEGIN Avatar -->
                                        <div class="avatar avatar-label-danger avatar-circle widget10-avatar">
                                            <div class="avatar-display">
                                                <i class="fa-solid fa-chalkboard"></i>
                                            </div>
                                        </div>
                                        <!-- END Avatar -->
                                    </div>
                                </div>
                                <div class="widget10-item">
                                    <div class="widget10-content">
                                        <h2 class="widget10-title"><?= $jumlahpembelajaran; ?></h2>
                                        <span class="widget10-subtitle">Jumlah Pembelajaran</span>
                                    </div>
                                    <div class="widget10-addon">
                                        <!-- BEGIN Avatar -->
                                        <div class="avatar avatar-label-danger avatar-circle widget10-avatar">
                                            <div class="avatar-display">
                                                <i class="fa-solid fa-book"></i>
                                            </div>
                                        </div>
                                        <!-- END Avatar -->
                                    </div>
                                </div>
                            <?php } else { ?>
                                <p class="text-center">Data Tidak ditemukan</p>
                            <?php } ?>

                        </div>
                        <!-- END Widget -->
                    </div>
                    <!-- END Portlet -->
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->

<?php } else { ?>
    <p>Admin tidak Ditemukan</p>
<?php } ?>