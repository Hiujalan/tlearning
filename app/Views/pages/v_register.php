<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">

    <title>Register | T-Learning</title>

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
        <div class="pageTitle"></div>

    </div>

    <!-- App Capsule -->
    <div id="appCapsule">

        <div class="section mt-2 text-center">
            <h1>Register</h1>
            <h4 class="text-primary">T-Learning</h4>
        </div>
        <div class="section mb-5 p-2">

            <form action="<?php echo base_url('proses_register'); ?>" method="post">
                <div class="card">
                    <div class="card-body pb-1">
                        <div class="text-center mb-2">
                            <img src="<?php echo base_url('assets/img/illustration/register.png') ?>" alt="" class="imaged w-75">
                        </div>
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="password1">Nama</label>
                                <input type="text" class="form-control <?= isset($errors['nama']) && is_null(old('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" placeholder="Nama Kamu" value="<?= old('nama'); ?>">
                                <?php if (isset($errors['nama']) && is_null(old('nama'))) : ?>
                                    <div class="invalid-feedback">
                                        <?= $errors['nama']; ?>
                                    </div>
                                <?php endif; ?>
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>

                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="password1">Email</label>
                                <input type="email" class="form-control <?= isset($errors['email']) && is_null(old('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" placeholder="Email Kamu" value="<?= old('email'); ?>">
                                <?php if (isset($errors['email']) && is_null(old('email'))) : ?>
                                    <div class="invalid-feedback">
                                        <?= $errors['email']; ?>
                                    </div>
                                <?php endif; ?>
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>

                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="label" for="password1">Nomor Telephone</label>
                                <input type="number" class="form-control <?= isset($errors['telp']) && is_null(old('telp')) ? 'is-invalid' : ''; ?>" id="telp" name="telp" placeholder="Masukkan Nomor Telepon" value="<?= old('telp'); ?>">
                                <?php if (isset($errors['telp']) && is_null(old('telp'))) : ?>
                                    <div class="invalid-feedback">
                                        <?= $errors['telp']; ?>
                                    </div>
                                <?php endif; ?>
                                <i class="clear-input">
                                    <ion-icon name="close-circle"></ion-icon>
                                </i>
                            </div>
                        </div>

                        <div class=" transparent mt-3">
                            <button type="submit" class="btn btn-primary btn-block btn-lg">Selanjutnya</button>
                        </div>

                        <div class="mt-2">
                            <h5>Sudah punya akun? <a href="<?php echo base_url('/') ?>">Login</a> </h5>
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

                        <div class="row justify-content-center">
                            <div class="col-xs-10 col-sm-10">
                                <h3 class="fw-bold text-primary mt-5">Register</h3>
                            </div>
                        </div>

                        <form action="<?php echo base_url('proses_register'); ?>" method="post">
                            <div class="row justify-content-center">
                                <div class="col-xs-1 col-sm-1">
                                    <i class="fa fa-phone my-4"></i>
                                </div>
                                <div class="col-xs-9 col-sm-9">
                                    <div class="my-4">
                                        <div class="mb-3">
                                            <input type="text" class="form-control <?= isset($errors['nama']) && is_null(old('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" placeholder="Nama Kamu" value="<?= old('nama'); ?>">
                                            <?php if (isset($errors['nama']) && is_null(old('nama'))) : ?>
                                                <div class="invalid-feedback">
                                                    <?= $errors['nama']; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="mb-3">
                                            <input type="email" class="form-control <?= isset($errors['email']) && is_null(old('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" placeholder="Email Kamu" value="<?= old('email'); ?>">
                                            <?php if (isset($errors['email']) && is_null(old('email'))) : ?>
                                                <div class="invalid-feedback">
                                                    <?= $errors['email']; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="mb-3">
                                            <input type="number" class="form-control <?= isset($errors['telp']) && is_null(old('telp')) ? 'is-invalid' : ''; ?>" id="telp" name="telp" placeholder="Masukkan Nomor Telepon" value="<?= old('telp'); ?>">
                                            <?php if (isset($errors['telp']) && is_null(old('telp'))) : ?>
                                                <div class="invalid-feedback">
                                                    <?= $errors['telp']; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-xs-10 col-sm-10">
                                    <button type="submit" class="btn btn-primary col-sm-12 col-xs-12 btn-lg fw-bold">Selanjutnya</button>
                                </div>

                                <div class="col-xs-10 col-sm-10 mt-3">
                                    <div class="position-relative">
                                        <hr class="text-primary ">
                                        <h5 class="position-absolute top-0 start-50 translate-middle bg-white text-primary">Atau</h5>
                                    </div>
                                </div>

                                <div class="col-xs-10 col-sm-10 mt-3">
                                    <button type="button" class="btn btn-outline-primary col-sm-12 col-xs-12 btn-lg fw-bold">
                                        <i class="fa fa-google-plus" aria-hidden="true"></i>
                                        Masuk dengan Google
                                    </button>
                                </div>

                                <div class="col-xs-10 col-sm-10 mt-4">
                                    <div class="text-center">
                                        <h5>Sudah punya akun? <a href="<?php echo base_url('/') ?>" class="fw-bold text-decoration-none">Login</a> </h5>
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