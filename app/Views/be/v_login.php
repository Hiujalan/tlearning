<!doctype html>
<html lang="en" dir="ltr" data-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&amp;family=Roboto+Mono&amp;display=swap" rel="stylesheet">
    <link href="<?php echo base_url('assets/be/build/styles/ltr-core.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/be/build/styles/ltr-vendor.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/be/images/favicon.ico') ?>" rel="shortcut icon" type="image/x-icon">

    <title>Login | T-Learning</title>
</head>

<body class="preload-active">

    <!-- BEGIN Preload -->
    <div class="preload">
        <div class="preload-dialog">
            <!-- BEGIN Spinner -->
            <div class="spinner-border text-primary preload-spinner"></div>
            <!-- END Spinner -->
        </div>
    </div>
    <!-- END Preload -->
    <!-- BEGIN Page Holder -->
    <div class="holder">
        <!-- BEGIN Page Wrapper -->
        <div class="wrapper ">
            <!-- BEGIN Page Content -->
            <div class="content">
                <div class="container-fluid g-5">
                    <div class="row g-0 align-items-center justify-content-center h-100">
                        <div class="col-sm-8 col-md-6 col-lg-4 col-xl-3">
                            <!-- BEGIN Portlet -->
                            <div class="portlet">
                                <div class="portlet-body">
                                    <div class="text-center mt-4 mb-5">
                                        <h1>Log in</h1>
                                        <h4 class="text-primary mb-4">T-Learning</h4>
                                        <!-- BEGIN Avatar -->
                                        <div class="avatar avatar-label-primary avatar-circle widget12">
                                            <div class="avatar-display">
                                                <i class="fa fa-user-alt"></i>
                                            </div>
                                        </div>
                                        <!-- END Avatar -->
                                    </div>
                                    <!-- BEGIN Form -->
                                    <form action="<?php echo base_url('proses_login_be'); ?>" method="post" class="d-grid gap-3" id="login-form" >
                                        <!-- BEGIN Validation Container -->
                                        <div class="validation-container">
                                            <!-- BEGIN Form Floating -->
                                            <div class="form-floating">
                                                <input type="text" class="form-control form-control-lg <?= isset($errors['telp']) && is_null(old('telp')) ? 'is-invalid' : ''; ?>" id="telp" name="telp" placeholder="Masukkan Nomor Telepon" value="<?= old('telp'); ?>">
                                                <?php if (isset($errors['telp']) && is_null(old('telp'))) : ?>
                                                    <div class="invalid-feedback">
                                                        <?= $errors['telp']; ?>
                                                    </div>
                                                <?php endif; ?>
                                                <label for="telp">Nomor Telepon</label>
                                            </div>
                                            <!-- END Form Floating -->
                                        </div>
                                        <!-- END Validation Container -->
                                        <!-- BEGIN Validation Container -->
                                        <div class="validation-container">
                                            <!-- BEGIN Form Floating -->
                                            <div class="form-floating">
                                                <input type="password" class="form-control form-control-lg <?= isset($errors['password']) && is_null(old('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="Masukkan password" value="<?= old('password'); ?>">
                                                <?php if (isset($errors['password']) && is_null(old('password'))) : ?>
                                                    <div class="invalid-feedback">
                                                        <?= $errors['password']; ?>
                                                    </div>
                                                <?php endif; ?>
                                                <label class="form-label" for="password">Password</label>
                                            </div>
                                            <!-- END Form Floating -->
                                        </div>
                                        <!-- END Validation Container -->

                                        <!-- BEGIN Flex -->
                                        <div class="d-flex">
                                            <button type="submit" class="btn btn-label-primary btn-lg col-12">Login</button>
                                        </div>
                                        <!-- END Flex -->
                                    </form>
                                    <!-- END Form -->
                                </div>
                            </div>
                            <!-- END Portlet -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Page Content -->
        </div>
        <!-- END Page Wrapper -->
    </div>
    <!-- END Page Holder -->

    <!-- <div id="appCapsule">

        <div class="section mt-2 text-center">
            <h1>Log in</h1>
            <h4 class="text-primary">T-Learning</h4>
        </div>
        <div class="section mb-5 p-2">

            <form action="<?php echo base_url('proses_login_be'); ?>" method="post">
                <div class="card">
                    <div class="card-body pb-1">
                        <div class="text-center">
                            <img src="<?php echo base_url('assets/img/illustration/login.jpg') ?>" alt="" class="imaged w-75">
                        </div>
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="form-label">Nomor Telepon</label>
                                <input type="text" class="form-control <?= isset($errors['telp']) && is_null(old('telp')) ? 'is-invalid' : ''; ?>" id="telp" name="telp" placeholder="Masukkan Nomor Telepon" value="<?= old('telp'); ?>">
                                <?php if (isset($errors['telp']) && is_null(old('telp'))) : ?>
                                    <div class="invalid-feedback">
                                        <?= $errors['telp']; ?>
                                    </div>
                                <?php endif; ?>

                            </div>


                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control <?= isset($errors['password']) && is_null(old('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="Masukkan password" value="<?= old('password'); ?>">
                                <?php if (isset($errors['password']) && is_null(old('password'))) : ?>
                                    <div class="invalid-feedback">
                                        <?= $errors['password']; ?>
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

                    </div>
                </div>
            </form>
        </div>

    </div> -->

    <script type="text/javascript" src="<?php echo base_url('assets/be/build/scripts/mandatory.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/be/build/scripts/core.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/be/build/scripts/vendor.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/be/app/utilities/sticky-header.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/be/app/utilities/copyright-year.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/be/app/utilities/theme-switcher.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/be/app/utilities/tooltip-popover.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/be/app/utilities/dropdown-scrollbar.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/be/app/utilities/fullscreen-trigger.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/be/app/pages/pages/login.js') ?>"></script>
</body>

</html>