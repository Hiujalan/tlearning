<?php if ($role == '1' || $role == '2' || $role == '3') { ?>

    <!-- Transactions -->
    <div class="section mt-2">
        <div class="card">
            <div class="card-body">
                <img src="<?php echo base_url('assets/img/illustration/icon-1.jpg') ?>" alt="" class="imaged w76 mb-1 border-bottom border-primary">
                <h1 class="text-center text-primary"><?= $tema; ?></h1>
                <div class="text-end">
                    <img src="<?php echo base_url('assets/img/illustration/icon-2.jpg') ?>" alt="" class="imaged w76 mt-1 border-bottom border-primary">
                </div>
            </div>
        </div>

        <?php if (!empty($item)) { ?>
            <div class="section-title mt-2">Sub Tema</div>
            <?php $i = 1; ?>
            <?php foreach ($item as $data) { ?>
                <div class="transactions mt-2">
                    <!-- item -->
                    <a href="<?php echo base_url('/temapelajaran=' . $url . '&subtema=' . $data['url']) ?>" class="item">
                        <div class="detail">
                            <h1 class="text-primary"><?= $i++; ?></h1>
                            <div class="ms-2">
                                <h4><?= $data['subtema']; ?></h4>
                            </div>
                        </div>
                        <div class="right">
                            <ion-icon name="chevron-forward-outline"></ion-icon>
                        </div>
                    </a>
                    <!-- * item -->
                </div>
            <?php } ?>

        <?php } else { ?>
            <div class="section mt-2 mb-2 text-center">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-1">
                            <img src="<?php echo base_url('assets/img/illustration/error.jpg') ?>" alt="image" class="imaged w-75">
                            <h3 class="card-title">Sub Tema Masih belum Ada</h3>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>


        <!-- <?php if ($role == '1') : ?>
            <div class="position-fixed" style="bottom: 55px; right:15px;">
                <div class="row mb-2">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahsub"><ion-icon name="add-outline"></ion-icon></button>
                </div>
                <div class="row mb-2">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editsub"><ion-icon name="pencil-outline"></ion-icon></button>
                </div>
            </div>

        <?php endif; ?> -->
    </div>
    <!-- * Transactions -->


    <!-- <div class="modal fade action-sheet" id="tambahsub" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Sub Tema</h5>
                </div>
                <div class="modal-body">
                    <div class="action-sheet-content">
                        <form action="<?php echo base_url('/proses_tambah_sub&tema=' . $url) ?>" method="POST">
                            <div class="form-group basic">
                                <label for="" class="form-label col-xs-2">Subtema</label>
                                <input type="text" name="subtema" id="subtema" class="form-control" required>
                                <div class="input-info">Masukkan Subtema Pembelajaran yang ingin kamu tambahkan</div>
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

    <!-- <div class="modal fade action-sheet" id="editsub" tabindex="-1" role="dialog">
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
                                <?php foreach ($item as $data) { ?>
                                    <tr>
                                        <td><?php echo $i++ ?></td>
                                        <td><?= $data['subtema']; ?></td>
                                        <td>
                                            <a href="<?php echo base_url('/edit_sub&tema=' . $url . '&id=' . $data['id']) ?>">
                                                <button type="button" class="btn btn-warning"><ion-icon name="pencil-outline"></ion-icon></button>
                                            </a>

                                            <a href="<?php echo base_url('/hapus_sub&id=' . $data['id']) ?>">
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

    <!-- <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-12 mt-5">
                <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <h1 class="display-4"><?= $tema; ?></h1>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12">
                <div class="container">
                    <h5 class="fw-bold mt-4">Sub Tema</h5>
                    <div class="row">

                        <?php foreach ($item as $data) { ?>
                            <a href="<?php echo base_url('/temapelajaran=' . $url . '&subtema=' . $data['url']) ?>" class="col-xs-6 col-sm-6 text-decoration-none mt-3">
                                <div class="card text-center">
                                    <div class="card-body">

                                    </div>
                                    <div class="card-footer text-body-secondary">
                                        <h4 class="fw-bolder"><?= $data['subtema']; ?></h4>
                                    </div>
                                </div>
                            </a>
                        <?php } ?>

                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6">
                <div class="container">
                    <a href="<?php echo base_url('/home') ?>">
                        <button type="submit" class="btn btn-outline-primary">Kembali</button>
                    </a>
                    <?php if ($role == '1') : ?>
                        <button type="button" class="btn btn-primary col-sm-2" data-bs-toggle="modal" data-bs-target="#menusetting"><i class="fa fa-pencil"></i></button>
                    <?php endif; ?>
                </div>
            </div>


        </div>
    </div> -->


    <!-- <div class="modal fade" tabindex="-1" id="menusetting">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Halaman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahsub"><i class="fa fa-pencil"></i> Tambah Sub Tema </button>

                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editsub"><i class="fa fa-pencil"></i> Edit Sub Tema </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div> -->

    <!-- <div class="modal fade" tabindex="-1" id="tambahsub">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Sub Tema</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?php echo base_url('/proses_tambah_sub&tema=' . $url) ?>" method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <label for="" class="form-label col-xs-2">Subtema</label>
                            <input type="text" name="subtema" id="subtema" class="form-control col-xs-12">
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

    <!-- <div class="modal fade" tabindex="-1" id="editsub">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Sub Tema</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped">
                        <tbody>
                            <?php foreach ($item as $data) { ?>
                                <tr>
                                    <td><?= $data['subtema']; ?></td>
                                    <td>
                                        <a href="<?php echo base_url('/edit_sub&tema=' . $url . '&id=' . $data['id']) ?>">
                                            <button type="button" class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                                        </a>
                                        <a href="<?php echo base_url('/hapus_sub&id=' . $data['id']) ?>">
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

    <!-- <div class="modal fade" tabindex="-1" id="editsubdata">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Sub Tema</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?php echo base_url('/proses_edit_sub&tema=' . $url) ?>" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <label for="" class="form-label">Subtema</label>
                        <input type="text" name="judul" class="form-control" value="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div> -->
<?php } else { ?>
    <p>User tidak Ditemukan</p>
<?php } ?>