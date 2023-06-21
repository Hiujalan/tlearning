<?php if (isset($user['telp'])) { ?>

    <!-- BEGIN Page Content -->
    <div class="content">
        <div class="container-fluid g-5">
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN Portlet -->
                    <div class="portlet">
                        <div class="portlet-header portlet-header-bordered">
                            <h3 class="portlet-title">Tambah Soal</h3>
                        </div>
                        <form action="<?php echo base_url('/be_proses_create_soal&id=' . $id) ?>" method="post">
                            <div class="portlet-body">
                                <!-- BEGIN Grid -->
                                <div class="d-grid gap-3">
                                    <div>
                                        <label for="" class="form-label">Waktu Pengerjaan per Soal</label>
                                    </div>
                                    <div>
                                        <div class="row">
                                            <div class="col-3 me-1">
                                                <div class="form-group boxed">
                                                    <div class="input-wrapper">
                                                        <label for="" class="form-label">Jam:</label>
                                                        <input type="text" name="jam" class="form-control">
                                                    </div>

                                                    <i class="clear-input">
                                                        <ion-icon name="close-circle"></ion-icon>
                                                    </i>
                                                </div>
                                            </div>
                                            <div class="col-3">

                                                <div class="form-group boxed">
                                                    <div class="input-wrapper">
                                                        <label for="" class="form-label">Menit:</label>
                                                        <input type="text" name="menit" class="form-control">
                                                    </div>

                                                    <i class="clear-input">
                                                        <ion-icon name="close-circle"></ion-icon>
                                                    </i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <label for="" class="form-label">Soal</label>
                                        <input type="text" name="soal" class="form-control">
                                    </div>

                                    <div>
                                        <label for="" class="form-label">Jawaban</label>
                                        <input type="text" name="jawaban" aria-label="jawaban" class="form-control">
                                    </div>

                                    <div>
                                        <label for="" class="form-label">Opsi 1</label>
                                        <input type="text" name="opsi1" class="form-control">
                                    </div>

                                    <div>
                                        <label for="" class="form-label">Opsi 2</label>
                                        <input type="text" name="opsi2" class="form-control">
                                    </div>

                                    <div>
                                        <label for="" class="form-label">Opsi 3</label>
                                        <input type="text" name="opsi3" class="form-control">
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


        <script>
            localStorage.removeItem("countdown");
        </script>
    <?php } else { ?>
        <p>Admin tidak Ditemukan</p>
    <?php } ?>