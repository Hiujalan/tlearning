<?php
if (!empty($dt_hasil)) {
    foreach ($dt_hasil as $data) { ?>
        <a href="<?php echo base_url('/tema=' . $data->url) ?>">
            <div class="bill-box" style="height: 180px;">
                <div class="img-wrapper">
                <img src="<?php echo base_url('/uploads/icons/' . $data->logo) ?>" alt="img" class="imaged w48">
                </div>
                <h4 class="fw-bolder"><?= $data->tema; ?></h4>
            </div>
        </a>
    <?php }
} else { ?>
    <div class="section text-center mt-3 mb-3">Data tidak ditemukan</div>
<?php } ?>