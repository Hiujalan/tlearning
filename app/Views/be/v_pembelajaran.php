<?php if (isset($user['telp'])) { ?>

    <div class="content">
        <div class="container-fluid g-5">
            <div class="row">
                <div class="col-12">
                    <div class="text-end my-3">
                        <a href="<?php echo base_url('/be_tambah_pembelajaran') ?>">
                            <button type="button" class="btn btn-primary ">
                                <i class="fa fa-plus"></i> Tambah Data
                            </button>
                        </a>
                    </div>
                    <!-- BEGIN Portlet -->
                    <div class="portlet">
                        <?php if (!empty($item)) { ?>
                            <div class="portlet-header portlet-header-bordered">
                                <h3 class="portlet-title">Data Pembelajaran</h3>
                            </div>
                            <div class="portlet-body">
                                <!-- BEGIN Datatable -->
                                <table id="table-1" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th scope="col">Pembelajaran ID</th>
                                            <th scope="col">Pembelajaran</th>
                                            <th scope="col" class="text-end">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($item as $data) { ?>
                                            <tr>
                                                <th scope="row"><?php echo $i++ ?></th>
                                                <td><?= $data['url']; ?></td>
                                                <td><?= $data['pembelajaran']; ?></td>
                                                <td class="text-end text-primary">
                                                    <a href="<?php echo "#infoDialog" . $data['id'] ?>" data-bs-toggle="modal" class="btn btn-success">
                                                        <i class="fa fa-info"></i>
                                                    </a>

                                                    <a href="<?php echo base_url('be_quiz&id=' . $data['url']) ?>">
                                                        <button type="button" class="btn btn-info">
                                                            <i class="fa-solid fa-feather"></i>
                                                        </button>
                                                    </a>

                                                    <a href="<?php echo base_url('be_soal&id=' . $data['url']) ?>">
                                                        <button type="button" class="btn btn-primary">
                                                            <i class="fa-solid fa-question"></i>
                                                        </button>
                                                    </a>

                                                    <a href="<?php echo base_url('be_edit_pembelajaran&subtema=' . $data['kunci'] . '&bagan=' . $data['url']) ?>">
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
                                <h3 class="card-title">Pembelajaran Masih belum Ada</h3>
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
                Data Pembelajaran
            </div>
            <div class="col-6 text-end">
                <a href="<?php echo base_url('/be_tambah_pembelajaran') ?>">
                    <button type="button" class="btn btn-primary "><ion-icon name="add-outline"></ion-icon></button>
                </a>
            </div>
        </div>
        <?php if (!empty($item)) { ?>
            <div class="card">

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Pembelajaran ID</th>
                                <th scope="col">Pembelajaran</th>
                                <th scope="col">Judul Video</th>
                                <th scope="col">Nama Video</th>
                                <th scope="col">Judul Materi</th>
                                <th scope="col">Nama Materi</th>
                                <th scope="col">Diskusi</th>
                                <th scope="col" class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($item as $data) { ?>
                                <tr>
                                    <th scope="row"><?php echo $i++ ?></th>
                                    <td><?= $data['url']; ?></td>
                                    <td><?= $data['pembelajaran']; ?></td>
                                    <td><?= $data['judul_video']; ?></td>
                                    <td><?= $data['nama_video']; ?></td>
                                    <td><?= $data['judul_materi']; ?></td>
                                    <td><?= $data['nama_materi']; ?></td>
                                    <td><?= $data['diskusi']; ?></td>
                                    <td class="text-end text-primary">
                                        <a href="<?php echo base_url('be_edit_pembelajaran&subtema=' . $data['kunci'] . '&bagan=' . $data['url']) ?>">
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
                            <h3 class="card-title">Pembelajaran Masih belum Ada</h3>
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
                            <a href="<?php echo base_url('/be_hapus_pembelajaran_data&id=' . $data['id']) ?>" class="btn btn-text-primary">
                                IYA
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <?php foreach ($item as $data) { ?>
        <div class="modal fade dialogbox" id="<?php echo "infoDialog" . $data['id'] ?>" data-bs-backdrop="static" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Data</h5>
                    </div>
                    <div class="modal-body">
                        <div class="d-grid gap-3">
                            <div>
                                <label for="" class="form-label">Pembelajaran</label>
                                <input type="text" name="pembelajaran" id="pembelajaran" class="form-control col-xs-12" value="<?= $data['pembelajaran']; ?>" readonly>
                            </div>
                            <div>
                                <label for="" class="form-label">Judul Video</label>
                                <input type="text" name="judulvideo" id="judulvideo" class="form-control col-xs-12" value="<?= $data['judul_video']; ?>" readonly>
                            </div>
                            <div>
                                <label for="" class="form-label">File Video</label>
                                <div class="input-group">
                                    <input type="text" name="video" class="form-control col-xs-12" value="<?= $data['video']; ?>" readonly>
                                    <label class="input-group-text" for="inputGroupFile02"></label>
                                </div>
                            </div>
                            <div>
                                <div class="input-wrapper">
                                    <label for="" class="form-label">Judul Materi</label>
                                    <input type="text" name="judulmateri" id="judulmateri" class="form-control col-xs-12" value="<?= $data['judul_materi']; ?>" readonly>
                                </div>
                            </div>
                            <div>
                                <label for="" class="form-label">File Materi</label>
                                <div class="input-group">
                                    <input type="text" name="materi" class="form-control col-xs-12" value="<?= $data['materi']; ?>" readonly>
                                    <label class="input-group-text" for="inputGroupFile02"></label>
                                </div>
                            </div>
                            <div>
                                <label for="" class="form-label">Diskusi</label>
                                <input type="text" name="diskusi" id="diskusi" class="form-control col-xs-12" value="<?= $data['diskusi']; ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="btn-inline">
                            <a href="#" class="btn btn-text-secondary" data-bs-dismiss="modal">Close</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <!-- * Dialog Basic -->


<?php } else { ?>
    <p>Admin tidak Ditemukan</p>
<?php } ?>