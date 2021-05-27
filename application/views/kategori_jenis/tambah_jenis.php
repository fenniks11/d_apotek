<div class="pcoded-content">
    <div class="pcoded-inner-content">

        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-header card">
                    <div class="row align-items-end">
                        <div class="col-lg-6">
                            <div class="page-header-title">
                                <i class="icofont icofont-file-code bg-c-blue"></i>
                                <div class="d-inline">
                                    <h4>Tambah Kategori Obat</h4>
                                    <span>Formulir penambahan data kategori obat D'Apotek.</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="<?= base_url('dashboard') ?>">
                                            <i class="icofont icofont-home"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="<?= base_url('kategori_dan_jenis/daftar') ?>">Daftar Jenis Obat</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="<?= base_url('kategori_dan_jenis/tambah_jenis') ?>"><?= $judul; ?></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-header end -->

                <!-- Page body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Basic Form Inputs card start -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="text-center">Formulir Penambahan Data Obat-Obatan D'Apotek</h3>
                                    <span class="text-center text-muted">Admin wajib mengisi semua form <sup class="text-danger">*</sup></span>
                                    <div class="card-header-right"><i class="icofont icofont-spinner-alt-5"></i></div>

                                    <div class="card-header-right">
                                        <i class="icofont icofont-spinner-alt-5"></i>
                                    </div>

                                </div>
                                <div class="card-block">
                                    <h4 class="sub-title"></h4>
                                    <form action="<?= base_url('kategori_dan_jenis/tambah_jenis') ?>" method="post">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Nama Jenis Obat <sup class="text-danger">*</sup></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="jenis" value="<?= set_value('jenis') ?>">
                                                <?= form_error('jenis', '<small class="text-danger">', '</small>') ?>
                                            </div>
                                        </div>
                                        <div class="btn-text-right">
                                            <button type="submit" class="btn btn-primary ">Simpan</button>
                                            <button type="reset" class="btn btn-secondary">Reset</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="styleSelector">

    </div>