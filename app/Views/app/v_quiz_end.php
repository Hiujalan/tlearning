<?php if ($role == '1' || $role == '2' || $role == '3') { ?>

    <div class="section mt-2">
        <!-- card block -->
        <div class="card-block" style="height: 600px;">
            <div class="card-body">
                <div class="text-end">
                    <a href="<?php echo base_url('/quiz&temapelajaran=' . $tema . '&subtema=' . $kunci . '&bagan=' . $url) ?>">
                        <button type="submit" class="btn text-white"><ion-icon name="close-outline"></ion-icon></button>
                    </a>
                </div>

                <div class="text-center text-white">
                    <?php if ($item['jawaban'] == 'BENAR') { ?>
                        <h1 class="text-white">SELAMAT</h1>
                    <?php } else { ?>
                        <h1 class="text-white">Yah Maaf</h1>
                    <?php } ?>
                </div>

                <div class="text-center">
                    <?php if ($item['jawaban'] == 'BENAR') { ?>
                        <img src="<?php echo base_url('assets/img/illustration/congrats.jpg') ?>" alt="" class="imaged w-75">
                    <?php } else { ?>
                        <img src="<?php echo base_url('assets/img/illustration/retry.jpg') ?>" alt="" class="imaged w-75">
                    <?php } ?>

                </div>

                <h3 class="text-center text-white mt-2">"<?= $namauser; ?>"</h3>

                <p class="text-center">Jawaban Kamu</p>

                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center text-primary"><?= $item['jawaban']; ?></h2>
                    </div>
                </div>

                <p class="text-center mt-2">Bagikan Prestasimu Kepada teman-temanmu</p>

                <button id="take-screenshot" class="btn btn-warning mb-5 btn-block"><ion-icon name="share-social-outline"></ion-icon>Bagikan</button>

            </div>
        </div>
        <!-- * card block -->
    </div>

    <!-- <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-10">
                <h4 class="text-center">Hasil Quiz</h4>
                <a href="<?php echo base_url('/quiz&temapelajaran=' . $tema . '&subtema=' . $kunci . '&bagan=' . $url) ?>">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-times"></i></button>
                </a>

                <?php if ($item['jawaban'] == 'BENAR') { ?>
                    <h2 class="text-center">SELAMAT</h2>
                <?php } else { ?>
                    <h2 class="text-center">Yah Maaf</h2>
                <?php } ?>

                <h5 class="text-center">"<?= $namauser; ?>"</h5>

                <p class="text-center">Jawaban Kamu</p>

                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center"><?= $item['jawaban']; ?></h2>
                    </div>
                </div>

                <p class="text-center">Bagikan Prestasimu Kepada teman-temanmu</p>

                <button id="take-screenshot" class="btn btn-primary">Bagikan</button>

            </div>
        </div>
    </div> -->

    <div class="modal fade" id="takescreenshot">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Bagikan Prestasimu Kepada teman-temanmu</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="<?php echo base_url('/uploads/screenshots/' . $item['screenshot']) ?>" alt="" width="1040px">
                </div>
                <div class="modal-footer">
                    <a href="<?php echo base_url('/quiz_end&temapelajaran=' . $tema . '&subtema=' . $kunci . '&bagan=' . $url . '&id=' . $item['soal_id'] . '&action=download_image')?>">
                        <button type="button" class="btn btn-primary">Simpan di Galeri</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        localStorage.removeItem("countdown");
    </script>

    <script src="<?php echo base_url('assets/js/lib/html2canvas.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/lib/FileSaver.min.js'); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

    <!-- <script>
        function loginWithFacebook() {
            FB.login(function(response) {
                if (response.authResponse) {
                    getUserInfo();
                } else {
                    console.log('Login dengan Facebook dibatalkan.');
                }
            }, {
                scope: 'email'
            });
        }

        function getUserInfo() {
            FB.api('/me', {
                fields: 'name,email'
            }, function(response) {
                var accessToken = FB.getAuthResponse()['accessToken'];
                sendDataToController(response, accessToken);
            });
        }

        function sendDataToController(userData, accessToken) {
            var data = {
                userData: userData,
                accessToken: accessToken
            };

            $.ajax({
                url: '<?php echo base_url('/quiz_end&temapelajaran=' . $tema . '&subtema=' . $kunci . '&bagan=' . $url . '&id=' . $item['soal_id'] . '&action=facebookLogin') ?>',
                method: 'POST',
                data: data,
                success: function(response) {
                    console.log('Data berhasil dikirim ke controller.');
                },
                error: function(xhr, status, error) {
                    console.error('Terjadi kesalahan saat mengirim data ke controller:', error);
                }
            });
        }
    </script>

    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId: '1190896534836353',
                xfbml: true,
                version: 'v16.0'
            });
            FB.AppEvents.logPageView();
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s);
            js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script> -->

    <script>
        $(document).ready(function() {
            document.getElementById('take-screenshot').addEventListener('click', function() {
                html2canvas(document.body).then(function(canvas) {
                    var imgData = canvas.toDataURL();

                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('/quiz_end&temapelajaran=' . $tema . '&subtema=' . $kunci . '&bagan=' . $url . '&id=' . $item['soal_id'] . '&action=screenshot') ?>',
                        data: {
                            image: imgData
                        },
                        success: function(response) {
                            console.log(response);
                        }
                    });
                });

                setTimeout(function() {
                    $('#takescreenshot').modal('show');
                }, 1000);
            });
        });
    </script>

<?php } else { ?>
    <p>User tidak Ditemukan</p>
<?php } ?>