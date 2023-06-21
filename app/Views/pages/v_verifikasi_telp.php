<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">

    <title>Verifikasi | T-Learning</title>

    <meta name="description" content="Tlearning">
    <meta name="keywords" content="bootstrap, wallet, banking, fintech mobile template, cordova, phonegap, mobile, html, responsive" />
    <link rel="icon" type="image/png" href="assets/img/favicon.png" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/icon/192x192.png">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css') ?>">
    <link rel="manifest" href="__manifest.json">
</head>

<body>

    <!-- loader -->
    <div id="loader">
        <img src="<?php echo base_url('assets/img/logo-icon.png') ?>" alt="icon" class="loading-icon">
    </div>
    <!-- loader -->

    <div class="appHeader no-border transparent position-absolute">
        <div class="left">
            <a href="<?php echo base_url('/register') ?>" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
    </div>

    <!-- App Capsule -->
    <div id="appCapsule">

        <div class="section mt-2 text-center">
            <h1>Verifikasi Email</h1>
            <h4 class="text-primary">T-Learning</h4>
            <h3>Kode dikirmkan ke <?= $email; ?></h3>
        </div>
        <div class="section mb-5 p-2">

            <form action="<?php echo base_url('proses_verifikasi') ?>" method="post">

                <div class="form-group basic">
                    <input type="text" class="form-control verification-input" id="smscode" name="kodeverif" placeholder="••••" maxlength="4">
                </div>

                <div class="section text-center mt-2">
                    <h3>Belum menerima kode ? <a href="<?php echo base_url('/verifikasi') ?>" class="text-decoration-none fw-bold">Kirim Lagi..</a></h3>
                </div>

                <div class=" transparent mt-3">
                    <button type="submit" class="btn btn-primary btn-block btn-lg">Verifikasi</button>
                </div>

                <div class="section text-center mt-2">
                    <h5>Cek Dibagian Spam jika Belum juga menerima kode</h5>
                </div>

            </form>
        </div>

    </div>
    <!-- * App Capsule -->

    <!-- <div class="container">
        <div class="row justify-content-center ">
            <div class="col-xs-12 col-sm-6 my-5">
                <div class="card">
                    <h3 class="fw-bold text-primary text-center mt-5">Verifikasi Email</h3>
                    <div class="card-body">

                        <form action="<?php echo base_url('proses_verifikasi') ?>" method="post">
                            <div class="row justify-content-center">
                                <div class="col-xs-10 col-sm-10">
                                    <h4 class="text-primary mt-5 text-center">Kode dikirmkan ke <?= $email; ?></h4>
                                </div>
                                <div class="col-xs-10 col-sm-10 mt-3">
                                    <div class="row justify-content-center">
                                        <div class="col-xs-2 col-sm-2">
                                            <div class="input-group input-group-lg">
                                                <input type="text" class="form-control" name="kode1" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-xs-2 col-sm-2">
                                            <div class="input-group input-group-lg">
                                                <input type="text" class="form-control" name="kode2" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-xs-2 col-sm-2">
                                            <div class="input-group input-group-lg">
                                                <input type="text" class="form-control" name="kode3" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-xs-2 col-sm-2">
                                            <div class="input-group input-group-lg">
                                                <input type="text" class="form-control" name="kode4" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-10 col-sm-10">
                                    <h4 class="text-primary mt-5 text-center">Belum menerima kode ? <a href="<?php echo base_url('/verifikasi') ?>" class="text-decoration-none fw-bold">Kirim Lagi..</a></h4>
                                </div>

                                <div class="col-xs-10 col-sm-10 my-3">
                                    <button type="submit" class="btn btn-primary col-sm-12 col-xs-12 btn-lg fw-bold">Verifikasi</button>
                                </div>

                                <div class="col-xs-10 col-sm-10">
                                    <h5 class="text-primary  text-center">Cek Dibagian Spam jika Belum juga menerima kode</h5>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>
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
</body>

</html>