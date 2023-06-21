<?php if ($role == '1' || $role == '2' || $role == '3') { ?>

    <div class="section mt-3 text-center">

        <div class="avatar-section ">
            <?php if (strpos($foto, 'https') !== false) { ?>
                <img src="<?= $item['foto']; ?>" alt="" class="imaged w100 rounded">
            <?php } else { ?>
                <img src="<?php echo base_url('/uploads/profile/' . $item['foto']) ?>" alt="" class="imaged w100 rounded">
            <?php } ?>
            <span class="button" data-bs-target="#updateprofile" data-bs-toggle="modal">
                <ion-icon name="camera-outline"></ion-icon>
            </span>
        </div>


        <div class="mt-3"></div>

        <h3><?= $item['nama']; ?></h3>
        <h3><?= $item['telp']; ?></h3>

        <div class="listview-title mt-1 text-start">Tema</div>
        <ul class="listview image-listview text inset">
            <li>
                <div class="item">
                    <div class="in">
                        <div>
                            Mode Gelap
                        </div>
                        <div class="form-check form-switch  ms-2">
                            <input class="form-check-input dark-mode-switch" type="checkbox" id="darkmodeSwitch">
                            <label class="form-check-label" for="darkmodeSwitch"></label>
                        </div>
                    </div>
                </div>
            </li>
        </ul>

        <div class="listview-title mt-1 text-start">Settings</div>
        <ul class="listview image-listview text inset">
            <li>
                <div class="item">
                    <div class="in">
                        <div>
                            Role
                        </div>
                        <?php if ($role == '1') { ?>
                            <label class="form-check-label">Admin</label>
                        <?php } elseif ($role == '2') { ?>
                            <label class="form-check-label">Murid</label>
                        <?php } elseif ($role == '3') { ?>
                            <label class="form-check-label">Guru</label>
                        <?php } ?>
                    </div>
                </div>
            </li>
            <?php if ($role == '1') { ?>
                <li>
                    <a href="<?php echo base_url('/upgrade_user') ?>" class="item">
                        <div class="in">
                            <div>User</div>
                        </div>
                    </a>
                </li>
            <?php } ?>
        </ul>

        <div class="listview-title mt-1 text-start">Profile</div>
        <form action="<?php echo base_url('/update_user&id=' . $item['id']) ?>" method="post" enctype="multipart/form-data">
            <div class="card inset">
                <div class="card-body">
                    <div class="item">
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Kamu" value="<?= $item['nama']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email Kamu" value="<?= $item['email']; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="form-group basic">
                            <div class="input-wrapper">
                                <input type="number" class="form-control " id="telp" name="telp" placeholder="Masukkan Nomor Telepon" value="<?= $item['telp']; ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="transparent mt-3 mb-2 mx-3">
                    <button type="submit" class="btn btn-primary btn-block btn-lg">Perbarui</button>
                </div>
            </div>

    </div>

    <div class="modal fade action-sheet" id="updateprofile" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Perbarui Foto Profile</h5>
                </div>
                <div class="modal-body">
                    <div class="action-sheet-content">

                        <div class="custom-file-upload" id="fileUpload1">
                            <input type="file" id="fileuploadInput" accept=".png, .jpg, .jpeg" name="foto">
                            <label for="fileuploadInput">
                                <span>
                                    <strong>
                                        <ion-icon name="arrow-up-circle-outline"></ion-icon>
                                        <i>Uploud Foto Profile</i>
                                    </strong>
                                </span>
                            </label>
                        </div>

                        <div class="form-group basic">
                            <button type="submit" class="btn btn-primary btn-block btn-lg">Perbarui</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-xs-12 col-sm-10 mt-5">
                <h2 class="text-center">Profile</h2>
                <a href="<?php echo base_url('/logout') ?>">
                    <button type="submit" class="btn btn-outline-primary">Logout</button>
                </a>
                <div class="text-center">
                    <?php if (isset($item['id_google'])) { ?>
                        <img src="<?= $item['foto']; ?>" alt="" class="img-thumbnail rounded" width="200px">
                    <?php } else { ?>
                        <img src="<?php echo base_url('/uploads/profile/' . $item['foto']) ?>" alt="" class="img-thumbnail rounded" width="200px">
                    <?php } ?>

                    <button type="button" class="btn btn-primary" data-bs-target="#updateprofile" data-bs-toggle="modal"><i class="fa fa-pencil"></i></button>
                </div>

                <h4 class="text-center"><?= $item['nama']; ?></h4>
                <h4 class="text-center"><?= $item['telp']; ?></h4>

                <form action="<?php echo base_url('/update_user&id=' . $item['id']) ?>" method="post" enctype="multipart/form-data">
                    <div class="my-4">
                        <div class="mb-3">
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Kamu" value="<?= $item['nama']; ?>">
                        </div>

                        <div class="mb-3">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email Kamu" value="<?= $item['email']; ?>">
                        </div>

                        <div class="mb-3">
                            <input type="number" class="form-control " id="telp" name="telp" placeholder="Masukkan Nomor Telepon" value="<?= $item['telp']; ?>">
                        </div>

                        <button type="submit" class="btn btn-primary">Perbarui</button>
                    </div>

            </div>
        </div>
    </div> -->

    <!-- <div class="modal fade" id="updateprofile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Perbarui Foto Profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="" class="form-label">Uploud Foto Profile</label>
                        <input type="file" name="foto" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Perbarui</button>
                </div>
                </form>

            </div>
        </div>
    </div> -->

    <!-- <script>
        const uploadButton = document.getElementById('upload-button');
        const fileInput = document.createElement('input');
        fileInput.setAttribute('type', 'file');
        fileInput.style.display = 'none';

        uploadButton.addEventListener('click', function() {
            fileInput.click();
        });

        fileInput.addEventListener('change', function(e) {
            e.preventDefault();

            const formData = new FormData();
            formData.append('file', fileInput.files[0]);

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '/update_user&id=65');
            xhr.send(formData);

        });
    </script> -->
<?php } else { ?>
    <p>User tidak Ditemukan</p>
<?php } ?>