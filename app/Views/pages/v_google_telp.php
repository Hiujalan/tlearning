<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">

    <title>Login | T-Learning</title>

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
            <a href="<?php echo base_url('/') ?>" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
    </div>

    <!-- App Capsule -->
    <div id="appCapsule">

        <div class="section mt-2 text-center">
            <h1>Masukkan Nomor Telepon</h1>
            <h4 class="text-primary">T-Learning</h4>
        </div>

        <div class="section mb-5 p-2">
            <div class="card">
                <div class="card-body pb-1">
                    <form action="<?php echo base_url('login/proses_google_telp'); ?>" method="post">

                        <div class="form-group basic">
                            <input type="number" class="form-control" id="telp" name="telp" placeholder="Masukkan Nomor Telepon">
                        </div>

                        <div class=" transparent mt-3 mb-2">
                            <button type="submit" class="btn btn-primary btn-block btn-lg">Selanjutnya</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- * App Capsule -->

    <!-- <div class="container">
        <div class="row justify-content-center ">
            <div class="col-xs-12 col-sm-6 my-5">
                <div class="card">
                    <h3 class="fw-bold text-primary text-center my-3">T-Learning</h3>
                    <img src="" class="card-img-top img-responsive" alt="...">
                    <div class="card-body">
                        <h4 class="fw-bold text-primary text-center">Halo.. Selamat datang di</h4>
                        <h3 class="fw-bold text-primary text-center">T-Learning</h3>

                        <div class="row justify-content-center">
                            <div class="col-xs-10 col-sm-10">
                                <h3 class="fw-bold text-primary mt-5">Masukkan Nomor Telepon</h3>
                            </div>
                        </div>

                        <form action="<?php echo base_url('login/proses_google_telp'); ?>" method="post">
                            <div class="row justify-content-center">
                                <div class="col-xs-1 col-sm-1">
                                    <i class="fa fa-phone my-4"></i>
                                </div>
                                <div class="col-xs-9 col-sm-9">
                                    <div class="my-4">
                                        <input type="number" class="form-control" id="telp" name="telp" placeholder="Masukkan Nomor Telepon">
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-xs-10 col-sm-10">
                                    <button type="submit" class="btn btn-primary col-sm-12 col-xs-12 btn-lg fw-bold">Selanjutnya</button>
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