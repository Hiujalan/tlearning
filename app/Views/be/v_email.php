<?php if (isset($user['telp'])) { ?>

    <!-- BEGIN Page Content -->
    <div class="content">
        <div class="container-fluid g-5">
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN Portlet -->
                    <div class="portlet">
                        <div class="portlet-header portlet-header-bordered">
                            <h3 class="portlet-title">Edit Email</h3>
                        </div>
                        <form action="<?php echo base_url('/email') ?>" method="POST">
                            <div class="portlet-body">
                                <!-- BEGIN Grid -->
                                <div class="d-grid gap-3">
                                    <div>
                                        <label for="" class="form-label">Alamat Server</label>
                                        <input type="text" name="server" class="form-control" value="<?= (!empty($item)) ? $item->server : ''; ?>">
                                        <div class="input-info">Masukkan Server yang ingin di gunakan</div>
                                    </div>
                                    <div>
                                        <label for="" class="form-label">Email</label>
                                        <input type="text" name="email" class="form-control" value="<?= (!empty($item)) ? $item->email : ''; ?>">
                                    </div>
                                    <div>
                                        <label for="" class="form-label">APP Password</label>
                                        <input type="password" name="password" class="form-control" value="<?= (!empty($item)) ? $item->password : ''; ?>">
                                        <div class="input-info">Masukkan App Password Akun Gmail yang ingin di gunakan</div>
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

        <form action="<?php echo base_url('/email') ?>" method="POST">
            <div class="card">
                <div class="card-body pb-1">
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label for="" class="form-label">Alamat Server</label>
                            <input type="text" name="server" class="form-control" value="<?= (!empty($item)) ? $item->server : ''; ?>">
                        </div>

                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>

                        <div class="input-info">Masukkan Server yang ingin di gunakan</div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label for="" class="form-label">Email</label>
                            <input type="text" name="email" class="form-control" value="<?= (!empty($item)) ? $item->email : ''; ?>">
                        </div>

                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label for="" class="form-label">APP Password</label>
                            <input type="password" name="password" class="form-control" value="<?= (!empty($item)) ? $item->password : ''; ?>">
                        </div>

                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>

                        <div class="input-info">Masukkan App Password Akun Gmail yang ingin di gunakan</div>
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