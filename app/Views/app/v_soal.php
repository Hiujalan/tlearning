<?php if ($role == '1' || $role == '2' || $role == '3') { ?>

    <div class="section mb-5 mt-2">

        <div class="card">
            <div class="card-body pb-1">
                <form action="<?php echo base_url('/save_soal&temapelajaran=' . $tema . '&subtema=' . $kunci . '&bagan=' . $url . '&id=' . $idsoal) ?>" method="post">
                    <div class="row">
                        <div class="col-9">
                            <h5 class="card-title"><?= $soal['soal_id']; ?>. <?= $soal['soal']; ?></h5>
                        </div>
                        <div class="col-3">
                            <div id="timer" class="text-end"><?= $waktu; ?></div>
                        </div>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="opsi" id="flexRadioDefault1" value="<?= $soal['opsi1']; ?>" <?= isset($jawabsoal['jawaban']) && $jawabsoal['jawaban'] == $soal['opsi1']  ? 'checked' : '' ?>>
                        <label class="form-check-label" for="flexRadioDefault1">
                            <?= $soal['opsi1']; ?>
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="opsi" value="<?= $soal['opsi2']; ?>" <?= isset($jawabsoal['jawaban']) && $jawabsoal['jawaban'] == $soal['opsi2']  ? 'checked' : '' ?> id="flexRadioDefault2">
                        <label class="form-check-label" for="flexRadioDefault2">
                            <?= $soal['opsi2']; ?>
                        </label>
                    </div>

                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="opsi" value="<?= $soal['opsi3']; ?>" <?= isset($jawabsoal['jawaban']) && $jawabsoal['jawaban'] == $soal['opsi3']  ? 'checked' : '' ?> id="flexRadioDefault3">
                        <label class="form-check-label" for="flexRadioDefault3">
                            <?= $soal['opsi3']; ?>
                        </label>
                    </div>
                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="opsi" value="<?= $soal['opsi4']; ?>" <?= isset($jawabsoal['jawaban']) && $jawabsoal['jawaban'] == $soal['opsi4']  ? 'checked' : '' ?> id="flexRadioDefault4">
                        <label class="form-check-label" for="flexRadioDefault4">
                            <?= $soal['opsi4']; ?>
                        </label>
                    </div>


                    <div class=" mt-3 mb-1">
                        <button type="submit" class="btn btn-primary btn-block btn-lg mb-2" id="soal-selanjutnya">Selanjutnya</button>
                    </div>


                </form>
                <?php if (isset($idsoal) && $idsoal > '1') { ?>
                    <?php $idback = $idsoal - 1; ?>
                    <a href="<?php echo base_url('/soal&temapelajaran=' . $tema . '&subtema=' . $kunci . '&bagan=' . $url . '&id=' . $idback) ?>">
                        <button type="submit" class="btn btn-outline-primary btn-block btn-lg mb-1">Kembali</button>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <?php $i = 1; ?>
                <div class="card">
                    <div class="card-body">
                        <form action="<?php echo base_url('/save_soal&temapelajaran=' . $tema . '&subtema=' . $kunci . '&bagan=' . $url . '&id=' . $idsoal) ?>" method="post">
                            <h5 class="card-title"><?= $soal['soal_id']; ?>. <?= $soal['soal']; ?></h5>

                            <div class="row">
                                <div class="col-xs-6 col-sm-6">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="opsi" id="flexRadioDefault1 " value="<?= $soal['opsi1']; ?>" <?= isset($jawabsoal['jawaban']) && $jawabsoal['jawaban'] == $soal['opsi1']  ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            <?= $soal['opsi1']; ?>
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="opsi" id="flexRadioDefault1 " value="<?= $soal['opsi2']; ?>" <?= isset($jawabsoal['jawaban']) && $jawabsoal['jawaban'] == $soal['opsi2']  ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            <?= $soal['opsi2']; ?>
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="opsi" id="flexRadioDefault1 " value="<?= $soal['opsi3']; ?>" <?= isset($jawabsoal['jawaban']) && $jawabsoal['jawaban'] == $soal['opsi3']  ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            <?= $soal['opsi3']; ?>
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="radio" name="opsi" id="flexRadioDefault1 " value="<?= $soal['opsi4']; ?>" <?= isset($jawabsoal['jawaban']) && $jawabsoal['jawaban'] == $soal['opsi4']  ? 'checked' : '' ?>>
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            <?= $soal['opsi4']; ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" id="soal-selanjutnya">Selanjutnya</button>
                </form>

                <?php if (isset($idsoal) && $idsoal > '1') { ?>
                    <?php $idback = $idsoal - 1; ?>
                    <a href="<?php echo base_url('/soal&temapelajaran=' . $tema . '&subtema=' . $kunci . '&bagan=' . $url . '&id=' . $idback) ?>">
                        <button type="submit" class="btn btn-outline-primary">Kembali</button>
                    </a>
                <?php } ?>
            </div>

            <div class="col-xs-12 col-sm-6">
                <div id="timer"><?= $waktu; ?></div>
            </div>
        </div>
    </div> -->

    <script>
        // window.onbeforeunload = function() {
        //     return "Apakah kamu yakin ingin meninggalkan halaman ini?";
        // }

        var timerElement = document.getElementById("timer");
        var secondsLeft = localStorage.getItem("countdown") || <?= $detik ?>;

        setInterval(function() {
            secondsLeft--;
            localStorage.setItem("countdown", secondsLeft);
            timerElement.textContent = convertToTime(secondsLeft);
            if (secondsLeft <= 0) {
                localStorage.removeItem("countdown");
                window.location.href = "<?php echo base_url('/pembelajaran&subtema=' . $kunci . '&bagan=' . $url) ?>";
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
    </script>
<?php } else { ?>
    <p>User tidak Ditemukan</p>
<?php } ?>