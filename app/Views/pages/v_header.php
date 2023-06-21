<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title><?= $title; ?></title>
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

    <!-- App Header -->
    <div class="appHeader">
        <div class="left">

        </div>
        <div class="pageTitle">
            <?= $active; ?>
        </div>
        <?php if (strpos($active, 'User') !== false) { ?>
            <div class="right">
                <a href="#DialogLogout" class="headerButton" data-bs-toggle="modal">
                    <ion-icon name="log-out-outline"></ion-icon>
                </a>
            </div>
        <?php } ?>
        <?php if (strpos($active, 'Quiz') !== false) { ?>
            <div class="right">
                <a href="#Dialogrules" class="headerButton" data-bs-toggle="modal">
                    <ion-icon name="information-circle-outline"></ion-icon>
                </a>
            </div>
        <?php } ?>

    </div>

    <div class="modal fade dialogbox" id="DialogLogout" data-bs-backdrop="static" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Log Out</h5>
                </div>
                <div class="modal-body">
                    Apakah Kamu Yakin?
                </div>
                <div class="modal-footer">
                    <div class="btn-inline">
                        <a href="#" class="btn btn-text-secondary" data-bs-dismiss="modal">CANCEL</a>
                        <a href="<?php echo base_url('/logout') ?>" class="btn btn-text-primary">
                            IYA
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade action-sheet" id="Dialogrules" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tata Cara</h5>
                </div>
                <div class="modal-body">
                    <ul class="list-unstyled m-3">
                        <ul>
                            <li>Berdoa Dulu Sebelum Mengejakan Quiz</li>
                            <li>Pahami soal Quiz lalu jawablah Quiz tersebut, Jawablah dengan Dua jawaban yang berhubungan</li>
                        </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- * App Header -->
    <div id="appCapsule" class="full-height">