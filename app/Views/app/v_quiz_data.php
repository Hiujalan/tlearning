<?php if ($role == '1' || $role == '2' || $role == '3') { ?>

    <div class="section mb-5 p-2">

        <form action="<?php echo base_url('/quiz_selanjutnya&temapelajaran=' . $tema . '&subtema=' . $kunci . '&bagan=' . $url . '&id=' . $idsoal) ?>" method="post">
            <div class="card">
                <div class="card-body pb-1">
                    <div class="row">
                        <div class="col-9">
                            <h5 class="card-title"><?= $soal['soal']; ?></h5>
                        </div>
                        <div class="col-3">
                            <div id="timer" class="text-end"><?= $waktu; ?></div>
                        </div>
                    </div>
                    <h6 class="card-subtitle mb-2 text-body-secondary">Quiz ke <?= $soal['soal_id']; ?> </h6>
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <div class="input-group mb-3">
                                <input type="text" name="jawaban1" id="jawaban1" aria-label="jawaban1" class="form-control" value="<?= isset($jawaban['jawaban1']) ? $jawaban['jawaban1'] : '' ?>" readonly>
                                <input type="text" name="jawaban2" id="jawaban2" aria-label="jawaban2" class="form-control" value="<?= isset($jawaban['jawaban2']) ? $jawaban['jawaban2'] : '' ?>" readonly>
                                <button type="button" id="hapusjawaban" class="btn btn-danger" title="Hapus Jawaban" style="height: 42px;">
                                    <ion-icon name="close-outline"></ion-icon>
                                </button>
                            </div>
                        </div>

                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <button type="button" name="opsi1" id="opsi1" value="<?= $soal['opsi1']; ?>" class="btn btn-outline-primary btn-block"><?= $soal['opsi1']; ?></button>
                        </div>

                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <button type="button" name="opsi2" id="opsi2" value="<?= $soal['opsi2']; ?>" class="btn btn-outline-primary btn-block"><?= $soal['opsi2']; ?></button>
                        </div>

                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <button type="button" name="opsi3" id="opsi3" value="<?= $soal['opsi3']; ?>" class="btn btn-outline-primary btn-block"><?= $soal['opsi3']; ?></button>
                        </div>

                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <button type="button" name="opsi4" id="opsi4" value="<?= $soal['opsi4']; ?>" class="btn btn-outline-primary btn-block"><?= $soal['opsi4']; ?></button>
                        </div>

                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>


                    <div class=" transparent mt-3 mb-2">
                        <button type="submit" class="btn btn-primary btn-block btn-lg">Simpan</button>
                    </div>



                </div>
            </div>
        </form>

        <!-- <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= $soal['soal']; ?></h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary">Quiz ke <?= $soal['soal_id']; ?> </h6>

                            <form action="<?php echo base_url('/quiz_selanjutnya&temapelajaran=' . $tema . '&subtema=' . $kunci . '&bagan=' . $url . '&id=' . $idsoal) ?>" method="post">
                                <div class="input-group mb-3">
                                    <input type="text" name="jawaban1" id="jawaban1" aria-label="jawaban1" class="form-control" value="<?= isset($jawaban['jawaban1']) ? $jawaban['jawaban1'] : '' ?>">
                                    <input type="text" name="jawaban2" id="jawaban2" aria-label="jawaban2" class="form-control" value="<?= isset($jawaban['jawaban2']) ? $jawaban['jawaban2'] : '' ?>">
                                    <button type="button" id="hapusjawaban" class="btn btn-danger" title="Hapus Jawaban">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>

                                <div class="row">
                                    <div class="col-xs-6 col-sm-6">
                                        <div class="row mb-3">
                                            <button type="button" name="opsi1" id="opsi1" value="<?= $soal['opsi1']; ?>" class="btn btn-outline-primary"><?= $soal['opsi1']; ?></button>
                                        </div>
                                        <div class="row mb-3">
                                            <button type="button" name="opsi2" id="opsi2" value="<?= $soal['opsi2']; ?>" class="btn btn-outline-primary"><?= $soal['opsi2']; ?></button>
                                        </div>
                                        <div class="row mb-3">
                                            <button type="button" name="opsi3" id="opsi3" value="<?= $soal['opsi3']; ?>" class="btn btn-outline-primary"><?= $soal['opsi3']; ?></button>
                                        </div>
                                        <div class="row mb-3">
                                            <button type="button" name="opsi4" id="opsi4" value="<?= $soal['opsi4']; ?>" class="btn btn-outline-primary"><?= $soal['opsi4']; ?></button>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary" id="soal-selanjutnya">Selanjutnya</button>
                            </form>



                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6">
                    <div id="timer"><?= $waktu; ?></div>
                </div>
            </div>
        </div> -->

        <script>
            var timerElement = document.getElementById("timer");
            var secondsLeft = localStorage.getItem("countdown") || <?= $detik ?>;

            setInterval(function() {
                secondsLeft--;
                localStorage.setItem("countdown", secondsLeft);
                timerElement.textContent = convertToTime(secondsLeft);

                if (secondsLeft <= 0) {
                    localStorage.removeItem("countdown");
                    window.location.href = "<?php echo base_url('/pembelajaran&temapelajaran=' . $tema . '&subtema=' . $kunci . '&bagan=' . $url) ?>";
                }
            }, 1000);

            function convertToTime(seconds) {
                var hour = Math.floor(seconds / 3600);
                var minute = Math.floor((seconds - hour * 3600) / 60);
                var second = seconds - hour * 3600 - minute * 60;

                hour = (hour < 10) ? "0" + hour : hour;
                minute = (minute < 10) ? "0" + minute : minute;
                second = (second < 10) ? "0" + second : second;

                return hour + ":" + minute + ":" + second;
            }


            document.getElementById("opsi1").addEventListener("click", function() {
                if (document.getElementById("jawaban1").value == '') {
                    document.getElementById("jawaban1").value = "<?= $soal['opsi1']; ?>";
                } else {
                    document.getElementById("jawaban2").value = "<?= $soal['opsi1']; ?>";
                }
            });

            document.getElementById("opsi2").addEventListener("click", function() {
                if (document.getElementById("jawaban1").value == '') {
                    document.getElementById("jawaban1").value = "<?= $soal['opsi2']; ?>";
                } else {
                    document.getElementById("jawaban2").value = "<?= $soal['opsi2']; ?>";
                }
            });

            document.getElementById("opsi3").addEventListener("click", function() {
                if (document.getElementById("jawaban1").value == '') {
                    document.getElementById("jawaban1").value = "<?= $soal['opsi3']; ?>";
                } else {
                    document.getElementById("jawaban2").value = "<?= $soal['opsi3']; ?>";
                }
            });

            document.getElementById("opsi4").addEventListener("click", function() {
                if (document.getElementById("jawaban1").value == '') {
                    document.getElementById("jawaban1").value = "<?= $soal['opsi4']; ?>";
                } else {
                    document.getElementById("jawaban2").value = "<?= $soal['opsi4']; ?>";
                }
            });

            document.getElementById("hapusjawaban").addEventListener("click", function() {
                document.getElementById("jawaban1").value = "";
                document.getElementById("jawaban2").value = "";
            });
        </script>
    <?php } else { ?>
        <p>User tidak Ditemukan</p>
    <?php } ?>