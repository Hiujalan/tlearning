<?php if ($role == '1' || $role == '2' || $role == '3') { ?>

    <div class="section mb-3 mt-2">
        <form class="search-form">
            <div class="form-group searchbox">
                <input type="text" name="search_query" placeholder="Cari..." class="form-control" id="cari" />
                <i class="input-icon">
                    <ion-icon name="search-outline"></ion-icon>
                </i>
            </div>
        </form>
    </div>


    <div class="section full mb-3 m-2">

        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="3500">
                    <img src="<?php echo base_url('assets/img/illustration/icon-3.jpg') ?>" class="card-img-top" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="3500">
                    <img src="<?php echo base_url('assets/img/illustration/icon-1.jpg') ?>" class="card-img-top" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="3500">
                    <img src="<?php echo base_url('assets/img/illustration/icon-2.jpg') ?>" class="card-img-top" alt="...">
                </div>
            </div>
        </div>

    </div>

    <div class="section tab-content mt-2">
        <h4 class="fw-bold">Tema</h4>

        <div class="tab-pane fade show active" id="waiting" role="tabpanel">
            <div class="row">
                <?php foreach ($tema as $data) { ?>
                    <div class="col-6 my-2 ">
                        <a href="<?php echo base_url('/tema=' . $data['url']) ?>">
                            <div class="bill-box" style="height: 180px;">
                                <div class="img-wrapper">
                                    <img src="<?php echo base_url('/uploads/icons/' . $data['logo']) ?>" alt="img" class="imaged w48">
                                </div>
                                <h4 class="fw-bolder"><?= $data['tema']; ?></h4>
                            </div>
                        </a>
                    </div>
                <?php } ?>

                <div class="col-6 mb-2">
                    <div id="result_data"></div>
                </div>
            </div>
        </div>

        <!-- <?php if ($role == '1') : ?>
            <div class="position-fixed" style="bottom: 55px; right:15px;">
                <div class="row mb-2">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahtema"><ion-icon name="add-outline"></ion-icon></button>
                </div>
                <div class="row mb-2">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edittema"><ion-icon name="pencil-outline"></ion-icon></button>
                </div>
            </div>


        <?php endif; ?> -->

    </div>

    <!-- <div class="modal fade action-sheet" id="tambahtema" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Tema</h5>
                </div>
                <div class="modal-body">
                    <div class="action-sheet-content">
                        <form action="<?php echo base_url('/proses_tambah_tema') ?>" method="POST" enctype="multipart/form-data">
                            <div class="form-group basic">
                                <label class="label">Tema Pembelajaran</label>
                                <div class="input-group">
                                    <label for="" class="form-label ">Tema</label>
                                    <input type="text" name="tema" id="tema" class="form-control" required>
                                </div>
                                <div class="input-info">Masukkan Tema Pembelajaran yang ingin kamu tambahkan</div>
                            </div>

                            <div class="form-group basic">
                                <label class="label">logo</label>
                                <div class="input-group">
                                    <input type="file" name="logo" id="logo" class="form-control">
                                </div>
                                <div class="input-info">Masukkan Tema Pembelajaran yang ingin kamu tambahkan</div>
                            </div>

                            <div class="form-group basic">
                                <button type="submit" class="btn btn-primary btn-block btn-lg">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <!-- <div class="modal fade action-sheet" id="edittema" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Sub Tema</h5>
                </div>
                <div class="modal-body">
                    <div class="action-sheet-content">
                        <table class="table table-striped">
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($tema as $data) { ?>
                                    <tr>
                                        <td><?php echo $i++ ?></td>
                                        <td><?= $data['tema']; ?></td>
                                        <td>
                                            <a href="<?php echo base_url('/edit_tema&id=' . $data['id']) ?>">
                                                <button type="button" class="btn btn-warning"><ion-icon name="pencil-outline"></ion-icon></button>
                                            </a>

                                            <a href="<?php echo base_url('/hapus_tema&id=' . $data['id']) ?>">
                                                <button type="button" class="btn btn-danger"><ion-icon name="trash-outline"></ion-icon></button>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                        <div class="form-group basic">
                            <button type="button" class="btn btn-primary btn-block btn-lg" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->



    <!-- <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 mt-5">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 mb-3">
                        <div class="input-group">
                            <input type="text" name="search_query" placeholder="Cari..." class="form-control" id="cari" />
                            <button type="submit" class="btn btn-outline-primary"><ion-icon name="search-outline"></ion-icon></button>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12">
                        <div id="carouselExampleIndicators" class="carousel slide ">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="<?php echo base_url('assets/img/blank.jpg') ?>" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="<?php echo base_url('assets/img/blank.jpg') ?>" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="<?php echo base_url('assets/img/blank.jpg') ?>" class="d-block w-100" alt="...">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <div class="col-xs-12 col-sm-6 ">
                <h5 class="fw-bold mt-5">Tema</h5>
                <div class="row">
                    <?php foreach ($tema as $data) { ?>
                        <a href="<?php echo base_url('/tema=' . $data['url']) ?>" class="col-xs-6 col-sm-6 text-decoration-none mt-3">
                            <div class="card text-center">
                                <div class="card-body">

                                </div>
                                <div class="card-footer text-body-secondary">
                                    <h4 class="fw-bolder"><?= $data['tema']; ?></h4>
                                </div>
                            </div>
                        </a>
                    <?php } ?>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div id="result_data"></div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <?php if ($role == '1') : ?>
                    <button type="button" class="btn btn-primary col-sm-2" data-bs-toggle="modal" data-bs-target="#tambahtema"><i class="fa fa-plus"></i></button>

                    <button type="button" class="btn btn-primary col-sm-2" data-bs-toggle="modal" data-bs-target="#edittema"><i class="fa fa-pencil"></i></button>
                <?php endif; ?>
            </div>
        </div>
    </div> -->

    <!-- <div class="modal fade" id="tambahtema" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Tema</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?php echo base_url('/proses_tambah_tema') ?>" method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <label for="" class="form-label col-xs-2">Tema</label>
                            <input type="text" name="tema" id="tema" class="form-control col-xs-12">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div> -->

    <!-- <div class="modal fade" tabindex="-1" id="edittema">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Sub Tema</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped">
                        <tbody>
                            <?php foreach ($tema as $data) { ?>
                                <tr>
                                    <td><?= $data['tema']; ?></td>
                                    <td>
                                        <a href="<?php echo base_url('/edit_tema&id=' . $data['id']) ?>">
                                            <button type="button" class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                                        </a>
                                        <a href="<?php echo base_url('/hapus_tema&id=' . $data['id']) ?>">
                                            <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div> -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script type="text/javascript">
        jQuery(function($) {
            $("#cari").keyup(function() {
                if ($("#cari").val().length > 4) {
                    var cari = $("#cari").val();
                    $.ajax({
                        url: "<?php echo base_url('/ajax_cari'); ?>",
                        type: 'GET',
                        data: {
                            'id': cari,
                        },
                        beforeSend: function(s) {
                            $('#result_data').html('<p class="text-center">Harap tunggu...</p>');
                        },
                        success: function(data) {
                            $('#result_data').html(data);
                        },
                        failed: function(data) {
                            alert('Gagal mendapatkan data');
                        }
                    });
                } else {
                    $('#result_data').html('<p class="text-center">Data tidak ditemukan</p>');
                }
            });
        });
    </script>
<?php } else { ?>
    <p>user tidak ditemukan</p>
<?php } ?>