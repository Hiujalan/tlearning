<?php if (isset($user['telp'])) { ?>

    <!-- BEGIN Page Content -->
    <div class="content">
        <div class="container-fluid g-5">
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN Portlet -->
                    <div class="portlet">
                        <div class="portlet-header portlet-header-bordered">
                            <h3 class="portlet-title">Edit Tema</h3>
                        </div>
                        <form action="<?php echo base_url('/be_proses_edit_tema&id=' . $id) ?>" method="POST">
                            <div class="portlet-body">
                                <!-- BEGIN Grid -->
                                <div class="d-grid gap-3">
                                    <div>
                                        <label for="" class="form-label">Tema</label>
                                        <input type="text" name="tema" class="form-control" value="<?= $item['tema']; ?>">
                                    </div>
                                    <div>
                                        <label class="label">logo</label>
                                        <input type="file" name="logo" id="logo" class="form-control">
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

        <form action="<?php echo base_url('/be_proses_edit_tema&id=' . $id) ?>" method="POST">
            <div class="card">
                <div class="card-body pb-1">
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label for="" class="form-label">Tema</label>
                            <input type="text" name="tema" class="form-control" value="<?= $item['tema']; ?>">
                        </div>

                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>

                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label">logo</label>
                            <input type="file" name="logo" id="logo" class="form-control">
                        </div>
                    </div>


                    <div class=" transparent mt-3 mb-2">
                        <button type="submit" class="btn btn-primary btn-block btn-lg">Simpan</button>
                    </div>

                </div>


            </div>
        </form> -->


        <!-- <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-10">
                    <form action="<?php echo base_url('/proses_edit_tema&id=' . $id) ?>" method="POST">
                        <div class="row">
                            <label for="" class="form-label">Subtema</label>
                            <input type="text" name="tema" class="form-control" value="<?= $item['tema']; ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div> -->
    <?php } else { ?>
        <p>Admin tidak Ditemukan</p>
    <?php } ?>