<?php if (isset($user['telp'])) { ?>

    <div class="content">
        <div class="container-fluid g-5">
            <div class="row">
                <div class="col-12">
                    <div class="text-end my-3">

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
                                            <th>ID</th>
                                            <th scope="col">Pembelajaran ID</th>
                                            <th scope="col">Pembelajaran</th>
                                            <th scope="col">Quiz</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php foreach ($item as $data) { ?>
                                            <tr>
                                                <th scope="row"><?php echo $i++ ?></th>
                                                <td><?= $data['url']; ?></td>
                                                <td><?= $data['pembelajaran']; ?></td>
                                                <td>Quiz ke <?= $data['soal_id']; ?></td>
                                                <td class="text-end text-primary">
                                                    <a href="<?php echo base_url('/be_nilai_quiz_data&id=' . $data['url']) ?>">
                                                        <button type="button" class="btn btn-primary">
                                                            <i class="fa fa-arrow-right"></i>
                                                        </button>
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
                                <h3 class="card-title">Nilai Quiz Masih belum Ada</h3>
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
                Data Quiz
            </div>
            <div class="col-6 text-end">

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
                                <th scope="col">Quiz</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($item as $data) { ?>
                                <tr>
                                    <th scope="row"><?php echo $i++ ?></th>
                                    <td><?= $data['url']; ?></td>
                                    <td><?= $data['pembelajaran']; ?></td>
                                    <td>Quiz ke <?= $data['soal_id']; ?></td>
                                    <td class="text-end text-primary">

                                        <a href="<?php echo base_url('/be_nilai_quiz_data&id=' . $data['url']) ?>">
                                            <button type="button" class="btn btn-primary"><ion-icon name="arrow-forward-outline"></ion-icon></button>
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
                            <h3 class="card-title">Nilai Quiz Masih belum Ada</h3>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div> -->

<?php } else { ?>
    <p>Admin tidak Ditemukan</p>
<?php } ?>