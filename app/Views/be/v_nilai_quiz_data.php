<?php if (isset($user['telp'])) { ?>

    <div class="content">
        <div class="container-fluid g-5">
            <div class="row">
                <div class="col-12">
                    <div class="text-end my-3">
                        <a href="<?php echo base_url('/be_ekspor_excel_nilai_quiz&id=' . $url) ?>">
                            <button type="button" class="btn btn-success ">
                                <i class="fa fa-file"></i> Ekspor Excel
                            </button>
                        </a>

                        <a href="<?php echo base_url('/be_ekspor_pdf_nilaiquiz&id=' . $url) ?>">
                            <button type="button" class="btn btn-danger ">
                                <i class="fa fa-file"></i> Ekspor PDF
                            </button>
                        </a>
                    </div>
                    <!-- BEGIN Portlet -->
                    <div class="portlet">
                        <?php if (!empty($item)) { ?>
                            <div class="portlet-header portlet-header-bordered">
                                <h3 class="portlet-title">Data Nilai Quiz</h3>
                            </div>
                            <div class="portlet-body">
                                <!-- BEGIN Datatable -->
                                <table id="table-1" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Jawaban 1</th>
                                            <th scope="col">Jawaban 2</th>
                                            <th scope="col">Jawaban</th>
                                            <th scope="col">Pembelajaran</th>
                                            <th scope="col">Pembelajaran ID</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($item as $data) { ?>
                                            <tr>
                                                <th scope="row"><?php echo $i++ ?></th>
                                                <td><?= $data['nama']; ?></td>
                                                <td><?= $data['jawaban1']; ?></td>
                                                <td><?= $data['jawaban2']; ?></td>
                                                <td><?= $data['jawaban']; ?></td>
                                                <td><?= $data['pembelajaran']; ?></td>
                                                <td><?= $data['url']; ?></td>
                                            </tr>
                                        <?php } ?>

                                    </tbody>
                                </table>
                                <!-- END Datatable -->
                            </div>
                        <?php } else { ?>
                            <div class="my-5 text-center">
                                <img src="<?php echo base_url('assets/img/illustration/error.jpg') ?>" alt="image" class="imaged w-75">
                                <h3 class="card-title">Nilai Quiz Masih belum Ada</h3>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- END Portlet -->
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="<?php echo base_url('assets/be/app/pages/datatable/basic/base.js') ?>"></script>


<?php } else { ?>
    <p>Admin tidak Ditemukan</p>
<?php } ?>