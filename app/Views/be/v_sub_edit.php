<?php if (isset($user['telp'])) { ?>

    <!-- BEGIN Page Content -->
    <div class="content">
        <div class="container-fluid g-5">
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN Portlet -->
                    <div class="portlet">
                        <div class="portlet-header portlet-header-bordered">
                            <h3 class="portlet-title">Edit Subtema</h3>
                        </div>
                        <form action="<?php echo base_url('/be_proses_edit_sub&tema=' . $url . '&id=' . $id) ?>" method="POST">
                            <div class="portlet-body">
                                <!-- BEGIN Grid -->
                                <div class="d-grid gap-3">
                                    <div>
                                        <label for="" class="form-label">Subtema</label>
                                        <input type="text" name="judul" class="form-control" value="<?= $item['subtema']; ?>">
                                    </div>
                                    <div>
                                        <label class="label" for="select4">Tema</label>
                                        <select class="form-control custom-select" name="kunci" id="select2-2">
                                            <option value="<?= $item['kunci']; ?>"><?= $namatema; ?></option>
                                            <?php foreach ($row as $data) { ?>
                                                <option value="<?= $data['url']; ?>"><?= $data['tema']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-block btn-lg my-2">Simpan</button>
                                </div>
                                <!-- END Grid -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->

    <!-- <div class="section mb-5 p-2">

        <form action="<?php echo base_url('/be_proses_edit_sub&tema=' . $url . '&id=' . $id) ?>" method="POST">
            <div class="card">
                <div class="card-body pb-1">
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label for="" class="form-label">Subtema</label>
                            <input type="text" name="judul" class="form-control" value="<?= $item['subtema']; ?>">
                        </div>

                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>

                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="select4">Tema</label>
                            <select class="form-control custom-select" name="kunci" id="select4">
                                <option value="<?= $item['kunci']; ?>"><?= $namatema; ?></option>
                                <?php foreach ($row as $data) { ?>
                                    <option value="<?= $data['url']; ?>"><?= $data['tema']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class=" transparent mt-3 mb-2">
                        <button type="submit" class="btn btn-primary btn-block btn-lg">Simpan</button>
                    </div>


                </div>
            </div>
        </form> -->



    <?php } else { ?>
        <p>Admin tidak Ditemukan</p>
    <?php } ?>