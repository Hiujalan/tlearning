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

    <!-- App Capsule -->
    <div id="appCapsule">

        <div class="section mt-2 text-center">
            <h1>Log in</h1>
            <h4 class="text-primary">T-Learning</h4>
        </div>
        <div class="section mb-5 p-2">

            <form action="<?php echo base_url('proses_login'); ?>" method="post">
                <div class="card">
                    <div class="card-body pb-1">
                        <div class="text-center">
                            <img src="<?php echo base_url('assets/img/illustration/login.jpg') ?>" alt="" class="imaged w-75">
                        </div>
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="form-label">Nomor Telepon</label>
                                <input type="text" class="form-control <?= !empty($errors) ? 'is-invalid' : ''; ?>" id="telp" name="telp" placeholder="Masukkan Nomor Telepon" value="<?= old('telp'); ?>">
                                <?php if (!empty($errors) || isset($errors)) : ?>
                                    <div class="invalid-feedback">
                                        <?= isset($errors) ? $errors : $errors['telp']; ?>
                                    </div>
                                <?php endif; ?>

                            </div>


                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>



                        <div class=" transparent mt-3">
                            <button type="submit" class="btn btn-primary btn-block btn-lg">Log in</button>
                        </div>

                        <div class="mt-1"></div>

                        <div class="position-relative">
                            <hr class="text-primary ">
                            <h5 class="position-absolute top-0 start-50 translate-middle bg-white text-primary">Atau</h5>
                        </div>

                        <div class="mt-1"></div>

                        <div class=" transparent">
                            <a href="<?= $link; ?>" class="btn btn-outline-primary btn-block btn-lg ">
                                <ion-icon name="logo-google"></ion-icon>
                                Login dengan Google
                            </a>
                        </div>

                        <div class="form-links mt-2">
                            <div>
                                <h5>Belum punya akun? <a href="<?php echo base_url('/register') ?>">Registrasi Sekarang</a> </h5>
                            </div>
                            <!-- <div>
                        <a href="app-forgot-password.html" class="text-muted">Forgot Password?</a>
                    </div> -->
                        </div>

                    </div>
                </div>
            </form>
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
                                <h3 class="fw-bold text-primary mt-5">Login</h3>
                            </div>
                        </div>

                        <form action="<?php echo base_url('proses_login'); ?>" method="post">
                            <div class="row justify-content-center">
                                <div class="col-xs-1 col-sm-1">
                                    <i class="fa fa-phone my-4"></i>
                                </div>
                                <div class="col-xs-9 col-sm-9">
                                    <div class="my-4">
                                        <input type="number" class="form-control <?= isset($errors['telp']) && is_null(old('telp')) ? 'is-invalid' : ''; ?>" id="telp" name="telp" placeholder="Masukkan Nomor Telepon" value="<?= old('telp'); ?>">
                                        <?php if (isset($errors['telp']) && is_null(old('telp'))) : ?>
                                            <div class="invalid-feedback">
                                                <?= $errors['telp']; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-xs-10 col-sm-10">
                                    <button type="submit" class="btn btn-primary col-sm-12 col-xs-12 btn-lg fw-bold">Login</button>
                                </div>

                                <div class="col-xs-10 col-sm-10 mt-3">
                                    <div class="position-relative">
                                        <hr class="text-primary ">
                                        <h5 class="position-absolute top-0 start-50 translate-middle bg-white text-primary">Atau</h5>
                                    </div>
                                </div>

                                <div class="col-xs-10 col-sm-10 mt-3">
                                    <a href="<?= $link; ?>" class="btn btn-outline-primary col-sm-12 col-xs-12 btn-lg fw-bold">
                                        <i class="fa fa-google-plus" aria-hidden="true"></i>
                                        Login dengan Google
                                    </a>
                                </div>

                                <div class="col-xs-10 col-sm-10 mt-4">
                                    <div class="text-center">
                                        <h5>Belum punya akun? <a href="<?php echo base_url('/register') ?>" class="fw-bold text-decoration-none">Register</a> </h5>
                                    </div>
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