<div class="pcoded-content">
    <div class="pcoded-inner-content">

        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-header start -->
                <div class="page-header card">
                    <div class="row align-items-end">
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <i class="icofont icofont icofont icofont-file-document bg-c-pink"></i>
                                <div class="d-inline">
                                    <h4><?= $judul; ?></h4>
                                    <span>D'Apotek menerima resep dokter. Upload gambar resep dokter, D'Apotek akan memproses pesanan anda.</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="<?= base_url('user') ?>">
                                            <i class="icofont icofont-home"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="<?= base_url('user/unggah_resep') ?>"><?= $judul; ?></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-header end -->

                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5><?= $judul; ?></h5>
                                    <span>Hai, <?= $user['nama']; ?>. Kamu bisa memesan obat dengan mengunggah resep dokter. Silakan upload resep agar diproses oleh D'Apotek.</span>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option" style="width: 35px;">
                                            <li class=""><i class="icofont icofont-simple-left"></i></li>
                                            <li><i class="icofont icofont-maximize full-card"></i></li>
                                            <li><i class="icofont icofont-minus minimize-card"></i></li>
                                            <li><i class="icofont icofont-refresh reload-card"></i></li>
                                            <li><i class="icofont icofont-error close-card"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <?php
                                    if (isset($error_upload)) {
                                        echo '<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . $error_upload . '</div>';
                                    }

                                    echo form_open_multipart('user/proses_resep'); ?>
                                    <div class="form-group row">
                                        <input type="hidden" value="<?= $user['user_id']; ?>" name="id">
                                        <label class="col-sm-2 col-form-label">Gambar Resep</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" id="image-source" onchange="previewImage();" name="gambar" value="<?= set_value('gambar') ?>">
                                            <img id="image-preview" class="mt-3" alt="image preview" />
                                            <?= form_error('gambar') ?>
                                        </div>
                                    </div>
                                    <script>
                                        function previewImage() {
                                            document.getElementById("image-preview").style.display = "block";
                                            var oFReader = new FileReader();
                                            oFReader.readAsDataURL(document.getElementById("image-source").files[0]);

                                            oFReader.onload = function(oFREvent) {
                                                document.getElementById("image-preview").src = oFREvent.target.result;
                                            };
                                        };
                                    </script>
                                    <button class="btn btn-sm btn-info btn-round btn-block mt-3" type="submit">Upload</button>
                                    <?= form_close(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="styleSelector">

        </div>
    </div>
</div>