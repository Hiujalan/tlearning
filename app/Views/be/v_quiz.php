<?php if (isset($user['telp'])) { ?>

    <div class="content">
        <div class="container-fluid g-5">
            <div class="row">
                <div class="col-12">
                    <div class=" text-end my-3">
                        <button type="button" class="btn btn-warning " data-bs-toggle="modal" data-bs-target="#imporexcel">
                            <i class="fa fa-file"></i> Impor Excel
                        </button>

                        <a href="<?php echo base_url('/be_ekspor_excel_quiz&id=' . $idpembelajaran) ?>">
                            <button type="button" class="btn btn-success ">
                                <i class="fa fa-file"></i> Ekspor Excel
                            </button>
                        </a>

                        <a href="<?php echo base_url('/be_ekspor_pdf_quiz&id=' . $idpembelajaran) ?>">
                            <button type="button" class="btn btn-danger ">
                                <i class="fa fa-file"></i> Ekspor PDF
                            </button>
                        </a>

                        <a href="<?php echo base_url('/be_create_quiz&id=' . $idpembelajaran) ?>">
                            <button type="button" class="btn btn-primary ">
                                <i class="fa fa-plus"></i> Tambah Data
                            </button>
                        </a>

                    </div>

                    <!-- BEGIN Portlet -->
                    <div class="portlet">
                        <?php if (!empty($item)) { ?>
                            <div class="portlet-header portlet-header-bordered">
                                <h3 class="portlet-title">Data Quiz</h3>
                            </div>
                            <div class="portlet-body">
                                <!-- BEGIN Datatable -->
                                <table id="table-1" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th scope="col">Soal</th>
                                            <th scope="col">Jawaban 1</th>
                                            <th scope="col">Jawaban 2</th>
                                            <th scope="col">opsi 1</th>
                                            <th scope="col">opsi 2</th>
                                            <th scope="col">opsi 3</th>
                                            <th scope="col">opsi 4</th>
                                            <th scope="col">Pembelajaran</th>
                                            <th scope="col" class="text-end">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($item as $data) { ?>
                                            <tr>
                                                <th scope="row"><?php echo $i++ ?></th>
                                                <td><?= $data['soal']; ?></td>
                                                <td><?= $data['jawaban1']; ?></td>
                                                <td><?= $data['jawaban2']; ?></td>
                                                <td><?= $data['opsi1']; ?></td>
                                                <td><?= $data['opsi2']; ?></td>
                                                <td><?= $data['opsi3']; ?></td>
                                                <td><?= $data['opsi4']; ?></td>
                                                <td><?= $data['pembelajaran']; ?></td>
                                                <td class="text-end text-primary">
                                                    <a href="<?php echo base_url('/be_edit_quiz&id=' . $data['id']) ?>">
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
                                <h3 class="card-title">Quiz Masih belum Ada</h3>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- END Portlet -->
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade dialogbox" id="imporexcel" data-bs-backdrop="static" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Impor Data Quiz</h5>
                </div>
                <form method="post" action="<?php echo base_url('importQuiz&id=' . $idpembelajaran) ?>" enctype="multipart/form-data">
                    <div class="modal-body text-center">
                        <input type="file" name="file" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <div class="btn-inline">
                            <a href="#" class="btn btn-text-secondary" data-bs-dismiss="modal">CANCEL</a>
                            <button type="submit" class="btn btn-text-primary">
                                Import
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
                            <a href="<?php echo base_url('/be_hapus_quiz&id=' . $data['id']) ?>" class="btn btn-text-primary">
                                IYA
                            </a>
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