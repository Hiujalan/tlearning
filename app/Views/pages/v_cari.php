<?php if ($role == '1' || $role == '2' || $role == '3') { ?>
    <!-- Extra Header -->
    <div class="extraHeader">
        <form class="search-form">
            <div class="form-group searchbox">
                <input type="text" name="search_query" placeholder="Cari..." class="form-control" id="cari" />
                <i class="input-icon">
                    <ion-icon name="search-outline"></ion-icon>
                </i>
            </div>
        </form>
    </div>
    <!-- * Extra Header -->

    <div class="section pt-3">
        <div class="card mt-5">
            <ul class="listview image-listview media transparent flush">
                <div id="result_data"></div>
            </ul>
        </div>
    </div>


    <!-- <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 mb-3">
                <div class="input-group">
                    <input type="text" name="search_query" placeholder="Cari..." class="form-control" id="cari" />
                    <button type="submit" class="btn btn-outline-primary"><i class="fa fa-search"></i></button>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12">
                <div id="result_data"></div>
            </div>
        </div>
    </div> -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script type="text/javascript">
        jQuery(function($) {
            $("#cari").keyup(function() {
                if ($("#cari").val().length > 4) {
                    var cari = $("#cari").val();
                    $.ajax({
                        url: "<?php echo base_url('/ajax_cari'); ?>",
                        type: 'GET',
                        data: {
                            'id': cari,
                        },
                        beforeSend: function(s) {
                            $('#result_data').html('<p class="text-center py-5">Harap tunggu...</p>');
                        },
                        success: function(data) {
                            $('#result_data').html(data);
                        },
                        failed: function(data) {
                            alert('Gagal mendapatkan data');
                        }
                    });
                } else {
                    $('#result_data').html('<p class="text-center py-5">Data tidak ditemukan</p>');
                }
            });
        });
    </script>
<?php } else { ?>
    <p>User tidak Ditemukan</p>
<?php } ?>