<?php if (isset($user['telp'])) { ?>

    <div class="content">
        <div class="container-fluid g-5">
            <div class="row">
                <div class="col-12">
                    <div class="text-end my-3">
                        <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#tambahguru"><i class="fa fa-plus"></i> Tambah Data</button>
                    </div>
                    <!-- BEGIN Portlet -->
                    <div class="portlet">
                        <?php if (!empty($item)) { ?>
                            <div class="portlet-header portlet-header-bordered">
                                <h3 class="portlet-title">Data Guru</h3>
                            </div>
                            <div class="portlet-body">
                                <!-- BEGIN Datatable -->
                                <table id="table-1" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Telepon</th>
                                            <th scope="col" class="text-end">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($item as $data) { ?>
                                            <tr>
                                                <th scope="row"><?php echo $i++ ?></th>
                                                <td><?= $data['nama']; ?></td>
                                                <td><?= $data['telp']; ?></td>
                                                <td class="text-end text-primary">
                                                    <a href="<?php echo base_url('/be_edit_guru&id=' . $data['id']) ?>">
                                                        <button type="button" class="btn btn-warning">
                                                            <i class="fa fa-pencil"></i>
                                                        </button>
                                                    </a>

                                                    <a href="<?php echo "#DialogBasic" . $data['id'] ?>" data-bs-toggle="modal" class="btn btn-danger">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>

                                        <?php } ?>

                                    </tbody>
                                </table>
                                <!-- END Datatable -->
                            </div>
                        <?php } else { ?>
                            <div class="my-5 text-center">
                                <img src="<?php echo base_url('assets/img/illustration/error.jpg') ?>" alt="image" class="imaged w-75">
                                <h3 class="card-title">Data Quiz Masih belum Ada</h3>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- END Portlet -->
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="section mt-2">
        <div class="section-title row mb-2">
            <div class="col-6 text-start">
                Data Guru
            </div>
            <div class="col-6 text-end">
                <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#tambahguru"><ion-icon name="add-outline"></ion-icon></button>
            </div>
        </div>
        <?php if (!empty($item)) { ?>
            <div class="card">

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Telepon</th>
                                <th scope="col" class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($item as $data) { ?>
                                <tr>
                                    <th scope="row"><?php echo $i++ ?></th>
                                    <td><?= $data['nama']; ?></td>
                                    <td><?= $data['telp']; ?></td>
                                    <td class="text-end text-primary">
                                        <a href="<?php echo base_url('/be_edit_guru&id=' . $data['id']) ?>">
                                            <button type="button" class="btn btn-warning"><ion-icon name="pencil-outline"></ion-icon></button>
                                        </a>

                                        <a href="<?php echo "#DialogBasic" . $data['id'] ?>" data-bs-toggle="modal" class="btn btn-danger">
                                            <ion-icon name="trash-outline"></ion-icon>
                                        </a>
                                    </td>
                                </tr>

                            <?php } ?>

                        </tbody>
                    </table>
                </div>

            </div>
        <?php } else { ?>
            <div class="section mt-2 mb-2 text-center">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-1">
                            <img src="<?php echo base_url('assets/img/illustration/error.jpg') ?>" alt="image" class="imaged w-75">
                            <h3 class="card-title">Data Guru Masih belum Ada</h3>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div> -->

    <!-- Dialog Basic -->
    <?php foreach ($item as $data) { ?>
        <div class="modal fade dialogbox" id="<?php echo "DialogBasic" . $data['id'] ?>" data-bs-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus</h5>
                    </div>
                    <div class="modal-body text-center">
                        Apakah Kamu Yakin?
                    </div>
                    <div class="modal-footer">
                        <div class="btn-inline">
                            <a href="#" class="btn btn-text-secondary" data-bs-dismiss="modal">CANCEL</a>
                            <a href="<?php echo base_url('/be_hapus_guru&id=' . $data['id']) ?>" class="btn btn-text-primary">
                                IYA
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <!-- * Dialog Basic -->

    <div class="modal fade" id="tambahguru">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Guru</h5>
                    <button type="button" class="btn btn-label-danger btn-icon" data-bs-dismiss="modal">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <form action="<?php echo base_url('/be_proses_guru') ?>" method="POST">
                    <div class="modal-body">
                        <div class="d-grid gap-3">
                            <div>
                                <label for="" class="form-label">Nama</label>
                                <input type="text" name="nama" class="form-control" required>
                            </div>
                            <div>
                                <label for="" class="form-label">Telepon</label>
                                <input type="text" name="telp" class="form-control" required>
                            </div>
                            <div>
                                <label class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" data-bs-dismiss="modal" class="btn btn-outline-danger">Tidak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- <div class="modal fade action-sheet" id="tambahguru" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Guru</h5>
                </div>
                <div class="modal-body">
                    <div class="action-sheet-content">
                        <form action="<?php echo base_url('/be_proses_guru') ?>" method="POST">
                            <div class="card">
                                <div class="card-body pb-1">
                                    <div class="form-group basic">
                                        <div class="input-wrapper">
                                            <label for="" class="form-label">Nama</label>
                                            <input type="text" name="nama" class="form-control" required>
                                        </div>

                                        <i class="clear-input">
                                            <ion-icon name="close-circle"></ion-icon>
                                        </i>
                                    </div>

                                    <div class="form-group basic">
                                        <div class="input-wrapper">
                                            <label for="" class="form-label">Telepon</label>
                                            <input type="text" name="telp" class="form-control" required>
                                        </div>

                                        <i class="clear-input">
                                            <ion-icon name="close-circle"></ion-icon>
                                        </i>
                                    </div>

                                    <div class="form-group basic">
                                        <div class="input-wrapper">
                                            <label class="form-label">Password</label>
                                            <input type="password" name="password" id="password" class="form-control" required>
                                        </div>
                                    </div>


                                    <div class=" transparent mt-3 mb-2">
                                        <button type="submit" class="btn btn-primary btn-block btn-lg">Simpan</button>
                                    </div>

                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

<?php } else { ?>
    <p>Admin tidak Ditemukan</p>
<?php } ?>