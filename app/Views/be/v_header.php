<!DOCTYPE html>
<html lang="en" dir="ltr" data-theme="light">

<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&amp;family=Roboto+Mono&amp;display=swap" rel="stylesheet">
    <link href="<?php echo base_url('assets/be/build/styles/ltr-core.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/be/build/styles/ltr-vendor.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/be/images/favicon.ico') ?>" rel="shortcut icon" type="image/x-icon">
    <title><?= $title; ?></title>
</head>

<body class="preload-active aside-active aside-mobile-minimized aside-desktop-maximized">
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
        <!-- BEGIN Aside -->
        <div class="aside">
            <div class="aside-header">
                <h3 class="aside-title">Upmin</h3>
                <div class="aside-addon">
                    <button class="btn btn-label-primary btn-icon btn-lg" data-toggle="aside">
                        <i class="fa fa-times aside-icon-minimize"></i>
                        <i class="fa fa-thumbtack aside-icon-maximize"></i>
                    </button>
                </div>
            </div>
            <div class="aside-body" data-simplebar data-simplebar-direction="ltr">
                <!-- BEGIN Menu -->
                <div class="menu">
                    <div class="menu-item">
                        <a href="<?php echo base_url('/home_be') ?>" data-menu-path="<?php echo base_url('/home_be') ?>" class="menu-item-link">
                            <div class="menu-item-icon">
                                <i class="fa fa-desktop"></i>
                            </div>
                            <span class="menu-item-text">Dashboard</span>
                        </a>
                    </div>
                    <!-- BEGIN Menu Section -->
                    <div class="menu-section">
                        <div class="menu-section-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </div>
                        <h2 class="menu-section-text">Menu</h2>
                    </div>
                    <!-- END Menu Section -->
                    <div class="menu-item">
                        <a href="<?php echo base_url('/be_tema') ?>" data-menu-path="<?php echo base_url('/be_tema') ?>" class="menu-item-link menu-item-toggle">
                            <div class="menu-item-icon">
                                <i class="fa-solid fa-file"></i>
                            </div>
                            <span class="menu-item-text">Tema</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="<?php echo base_url('/be_subtema') ?>" data-menu-path="<?php echo base_url('/be_subtema') ?>" class="menu-item-link menu-item-toggle">
                            <div class="menu-item-icon">
                                <i class="fa-solid fa-chalkboard"></i>
                            </div>
                            <span class="menu-item-text">Sub Tema</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="<?php echo base_url('/be_pembelajaran') ?>" data-menu-path="<?php echo base_url('/be_pembelajaran') ?>" class="menu-item-link menu-item-toggle">
                            <div class="menu-item-icon">
                                <i class="fa-solid fa-book"></i>
                            </div>
                            <span class="menu-item-text">Pembelajaran</span>
                        </a>
                    </div>


                    <!-- BEGIN Menu Section -->
                    <div class="menu-section">
                        <div class="menu-section-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </div>
                        <h2 class="menu-section-text">Nilai</h2>
                    </div>
                    <!-- END Menu Section -->
                    <div class="menu-item">
                        <a href="<?php echo base_url('/nilai_soal') ?>" data-menu-path="<?php echo base_url('/nilai_soal') ?>" class="menu-item-link">
                            <div class="menu-item-icon">
                                <i class="fa-solid fa-chart-simple"></i>
                            </div>
                            <span class="menu-item-text">Nilai Soal</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="<?php echo base_url('/nilai_quiz') ?>" data-menu-path="<?php echo base_url('/nilai_quiz') ?>" class="menu-item-link">
                            <div class="menu-item-icon">
                                <i class="fa-solid fa-square-poll-vertical"></i>
                            </div>
                            <span class="menu-item-text">Nilai Quiz</span>
                        </a>
                    </div>

                    <?php if ($user['role'] == '1') { ?>
                        <div class="menu-section">
                            <div class="menu-section-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </div>
                            <h2 class="menu-section-text">User</h2>
                        </div>
                        <!-- END Menu Section -->
                        <div class="menu-item">
                            <a href="<?php echo base_url('/guru') ?>" data-menu-path="<?php echo base_url('/guru') ?>" class="menu-item-link">
                                <div class="menu-item-icon">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                                <span class="menu-item-text">Guru</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a href="<?php echo base_url('/murid') ?>" data-menu-path="<?php echo base_url('/murid') ?>" class="menu-item-link">
                                <div class="menu-item-icon">
                                    <i class="fa-solid fa-users"></i>
                                </div>
                                <span class="menu-item-text">Murid</span>
                            </a>
                        </div>

                        <div class="menu-section">
                            <div class="menu-section-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </div>
                            <h2 class="menu-section-text">Pengaturan</h2>
                        </div>
                        <!-- END Menu Section -->
                        <div class="menu-item">
                            <a href="<?php echo base_url('/email') ?>" data-menu-path="<?php echo base_url('/guru') ?>" class="menu-item-link">
                                <div class="menu-item-icon">
                                    <i class="fa-solid fa-envelope"></i>
                                </div>
                                <span class="menu-item-text">Email</span>
                            </a>
                        </div>
                    <?php } ?>

                </div>
                <!-- END Menu -->
            </div>
        </div>
        <!-- END Aside -->
        <!-- BEGIN Page Wrapper -->
        <div class="wrapper ">
            <!-- BEGIN Header -->
            <div class="header">
                <!-- BEGIN Desktop Sticky Header -->
                <div class="sticky-header" id="sticky-header-desktop">
                    <!-- BEGIN Header Holder -->
                    <div class="header-holder header-holder-desktop">
                        <div class="header-container container-fluid g-5">
                            <div class="header-wrap header-wrap-block justify-content-start">

                            </div>
                            <div class="header-wrap hstack gap-2">

                                <div class="dropdown">
                                    <button class="btn btn-flat-primary widget13" data-bs-toggle="dropdown">
                                        <div class="widget13-text"> Hi <strong><?= $user['nama']; ?></strong>
                                        </div>
                                        <!-- BEGIN Avatar -->
                                        <div class="avatar avatar-info widget13-avatar">
                                            <div class="avatar-display">
                                                <i class="fa fa-user-alt"></i>
                                            </div>
                                        </div>
                                        <!-- END Avatar -->
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-wide dropdown-menu-end dropdown-menu-animated overflow-hidden py-0">
                                        <!-- BEGIN Portlet -->
                                        <div class="portlet border-0">
                                            <div class="portlet-header bg-primary rounded-0">
                                                <!-- BEGIN Rich List Item -->
                                                <div class="rich-list-item w-100 p-0">
                                                    <div class="rich-list-prepend">
                                                        <!-- BEGIN Avatar -->
                                                        <div class="avatar avatar-label-light avatar-circle">
                                                            <div class="avatar-display">
                                                                <i class="fa fa-user-alt"></i>
                                                            </div>
                                                        </div>
                                                        <!-- END Avatar -->
                                                    </div>
                                                    <div class="rich-list-content">
                                                        <h3 class="rich-list-title text-white"><?= $user['nama']; ?></h3>
                                                        <span class="rich-list-subtitle text-white"><?= $user['telp']; ?></span>
                                                    </div>
                                                </div>
                                                <!-- END Rich List Item -->
                                            </div>
                                            <div class="portlet-body p-0">
                                                <!-- BEGIN Grid Nav -->
                                                <div class="grid-nav grid-nav-flush grid-nav-action grid-nav-no-rounded">
                                                    <div class="grid-nav-row">
                                                        <a href="<?php echo base_url('/be_tema') ?>" class="grid-nav-item">
                                                            <div class="grid-nav-icon">
                                                                <i class="fa-solid fa-file"></i>
                                                            </div>
                                                            <span class="grid-nav-content">Tema</span>
                                                        </a>
                                                        <a href="<?php echo base_url('/be_subtema') ?>" class="grid-nav-item">
                                                            <div class="grid-nav-icon">
                                                                <i class="fa-solid fa-chalkboard"></i>
                                                            </div>
                                                            <span class="grid-nav-content">Sub Tema</span>
                                                        </a>
                                                        <a href="<?php echo base_url('/be_pembelajaran') ?>" class="grid-nav-item">
                                                            <div class="grid-nav-icon">
                                                                <i class="fa-solid fa-book"></i>
                                                            </div>
                                                            <span class="grid-nav-content">Pembelajaran</span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <!-- END Grid Nav -->
                                            </div>
                                            <div class="portlet-footer portlet-footer-bordered rounded-0">
                                                <a href="<?php echo base_url('/logout_be') ?>">
                                                    <button class="btn btn-label-danger">Log out</button>
                                                </a>
                                            </div>
                                        </div>
                                        <!-- END Portlet -->
                                    </div>
                                </div>
                                <!-- END Dropdown -->
                            </div>
                        </div>
                    </div>
                    <!-- END Header Holder -->
                </div>
                <!-- END Desktop Sticky Header -->
                <!-- BEGIN Header Holder -->
                <div class="header-holder header-holder-desktop">
                    <div class="header-container container-fluid g-5">
                        <h4 class="header-title"><?= $active; ?></h4>
                        <i class="header-divider"></i>
                        <div class="header-wrap header-wrap-block justify-content-start">
                            <!-- BEGIN Breadcrumb -->
                            <div class="breadcrumb breadcrumb-transparent mb-0">
                                <a href="<?php echo base_url('/home_be') ?>" class="breadcrumb-item">
                                    <div class="breadcrumb-icon">
                                        <i data-feather="home"></i>
                                    </div>
                                    <span class="breadcrumb-text">Dashboard</span>
                                </a>
                            </div>
                            <!-- END Breadcrumb -->
                        </div>
                        <div class="header-wrap">
                            <!-- END Button Group -->
                            <button class="btn btn-label-info btn-icon" id="fullscreen-trigger" data-bs-toggle="tooltip" title="Toggle fullscreen" data-bs-placement="left">
                                <i class="fa fa-expand fullscreen-icon-expand"></i>
                                <i class="fa fa-compress fullscreen-icon-compress"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- END Header Holder -->
                <!-- BEGIN Mobile Sticky Header -->
                <div class="sticky-header" id="sticky-header-mobile">
                    <!-- BEGIN Header Holder -->
                    <div class="header-holder header-holder-mobile">
                        <div class="header-container container-fluid g-5">
                            <div class="header-wrap">
                                <button class="btn btn-flat-primary btn-icon" data-toggle="aside">
                                    <i class="fa fa-bars"></i>
                                </button>
                            </div>
                            <div class="header-wrap header-wrap-block justify-content-start px-3">
                                <h4 class="header-brand">Upmin</h4>
                            </div>
                            <div class="header-wrap hstack gap-2">
                                <!-- BEGIN Dropdown -->
                                <div class="dropdown">
                                    <button class="btn btn-flat-primary widget13" data-bs-toggle="dropdown">
                                        <div class="widget13-text"> Hi <strong><?= $user['nama']; ?></strong>
                                        </div>
                                        <!-- BEGIN Avatar -->
                                        <div class="avatar avatar-info widget13-avatar">
                                            <div class="avatar-display">
                                                <i class="fa fa-user-alt"></i>
                                            </div>
                                        </div>
                                        <!-- END Avatar -->
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-wide dropdown-menu-end dropdown-menu-animated overflow-hidden py-0">
                                        <!-- BEGIN Portlet -->
                                        <div class="portlet border-0">
                                            <div class="portlet-header bg-primary rounded-0">
                                                <!-- BEGIN Rich List Item -->
                                                <div class="rich-list-item w-100 p-0">
                                                    <div class="rich-list-prepend">
                                                        <!-- BEGIN Avatar -->
                                                        <div class="avatar avatar-label-light avatar-circle">
                                                            <div class="avatar-display">
                                                                <i class="fa fa-user-alt"></i>
                                                            </div>
                                                        </div>
                                                        <!-- END Avatar -->
                                                    </div>
                                                    <div class="rich-list-content">
                                                        <h3 class="rich-list-title text-white"><?= $user['nama']; ?></h3>
                                                        <span class="rich-list-subtitle text-white"><?= $user['telp']; ?></span>
                                                    </div>
                                                </div>
                                                <!-- END Rich List Item -->
                                            </div>
                                            <div class="portlet-body p-0">
                                                <!-- BEGIN Grid Nav -->
                                                <div class="grid-nav grid-nav-flush grid-nav-action grid-nav-no-rounded">
                                                    <div class="grid-nav-row">
                                                        <a href="<?php echo base_url('/be_tema') ?>" class="grid-nav-item">
                                                            <div class="grid-nav-icon">
                                                                <i class="fa-solid fa-file"></i>
                                                            </div>
                                                            <span class="grid-nav-content">Tema</span>
                                                        </a>
                                                        <a href="<?php echo base_url('/be_subtema') ?>" class="grid-nav-item">
                                                            <div class="grid-nav-icon">
                                                                <i class="fa-solid fa-chalkboard"></i>
                                                            </div>
                                                            <span class="grid-nav-content">Sub Tema</span>
                                                        </a>
                                                        <a href="<?php echo base_url('/be_pembelajaran') ?>" class="grid-nav-item">
                                                            <div class="grid-nav-icon">
                                                                <i class="fa-solid fa-book"></i>
                                                            </div>
                                                            <span class="grid-nav-content">Pembelajaran</span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <!-- END Grid Nav -->
                                            </div>
                                            <div class="portlet-footer portlet-footer-bordered rounded-0">
                                                <a href="<?php echo base_url('/logout_be') ?>">
                                                    <button class="btn btn-label-danger">Log out</button>
                                                </a>
                                            </div>
                                        </div>
                                        <!-- END Portlet -->
                                    </div>
                                </div>
                                <!-- END Dropdown -->
                            </div>
                        </div>
                    </div>
                    <!-- END Header Holder -->
                </div>
                <!-- END Mobile Sticky Header -->
                <!-- BEGIN Header Holder -->
                <div class="header-holder header-holder-mobile">
                    <div class="header-container container-fluid g-5">
                        <div class="header-wrap header-wrap-block justify-content-start w-100">
                            <!-- BEGIN Breadcrumb -->
                            <div class="breadcrumb breadcrumb-transparent mb-0">
                                <a href="index.html" class="breadcrumb-item">
                                    <div class="breadcrumb-icon">
                                        <i data-feather="home"></i>
                                    </div>
                                    <span class="breadcrumb-text">Dashboard</span>
                                </a>
                            </div>
                            <!-- END Breadcrumb -->
                        </div>
                    </div>
                </div>
                <!-- END Header Holder -->
            </div>
            <!-- END Header -->