</div>

<!-- App Bottom Menu -->
<div class="appBottomMenu" style="position: fixed; z-index: 1; padding-bottom: 0;">
    <a href="<?php echo base_url('/cari') ?>" class="item">
        <div class="col">
            <ion-icon name="search-outline"></ion-icon>
        </div>
    </a>
    <a href="<?php echo base_url('/home') ?>" class="item">
        <div class="col">
            <div class="action-button large">
                <ion-icon name="home-outline"></ion-icon>
            </div>
        </div>
    </a>
    <a href="<?php echo base_url('/user&id=' . $iduser) ?>" class="item">
        <div class="col">
            <ion-icon name="person-outline"></ion-icon> `
        </div>
    </a>
</div>
<!-- * App Bottom Menu -->

<!-- <footer class="container-fluid position-fixed bottom-0">
    <div class="row justify-content-center text-center">
        <a href="<?php echo base_url('/cari') ?>" class="col-xs-2 col-sm-2 p-4">
            <i class="fa fa-search fa-lg"></i>
        </a>
        <a href="<?php echo base_url('') ?>" class="col-xs-2 col-sm-2 p-4">
            <i class="fa fa-trash fa-lg"></i>
        </a>
        <a href="<?php echo base_url('/home') ?>" class="col-xs-2 col-sm-2 p-4">
            <i class="fa fa-home fa-lg"></i>
        </a>
        <a href="<?php echo base_url('') ?>" class="col-xs-2 col-sm-2 p-4">
            <i class="fa fa-trash fa-lg"></i>
        </a>
        <a href="<?php echo base_url('/user&id=' . $iduser) ?>" class="col-xs-2 col-sm-2 p-4">
            <i class="fa fa-user fa-lg"></i>
        </a>

    </div>
</footer> -->

<!-- ========= JS Files =========  -->
<!-- Bootstrap -->
<script src="<?php echo base_url('assets/js/lib/bootstrap.bundle.min.js') ?>"></script>
<!-- Ionicons -->
<script type="module" src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.js"></script>
<!-- Splide -->
<script src="<?php echo base_url('assets/js/plugins/splide/splide.min.js') ?>"></script>
<!-- Base Js File -->
<script src="<?php echo base_url('assets/js/base.js') ?>"></script>

</body>

</html>