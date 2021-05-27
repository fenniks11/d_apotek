<div class="pcoded-content">
    <div class="pcoded-inner-content">

        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-header card">
                    <div class="row align-items-end">
                        <div class="col-lg-6">
                            <div class="page-header-title">
                                <i class="fas fa-user-friends bg-c-blue"></i>
                                <div class="d-inline">
                                    <h4>Tambah Suplier Obat</h4>
                                    <span>Formulir penambahan data suplier obat D'Apotek.</span>
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
                                    <li class="breadcrumb-item"><a href="<?= base_url('suplier/daftar') ?>">Daftar Suplier Obat</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="<?= base_url('suplier/tambah_sup') ?>"><?= $judul; ?></a>
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
                                    <h3 class="text-center">Formulir Penambahan SUplier Obat D'Apotek</h3>
                                    <span class="text-center text-muted">Admin wajib mengisi semua form <sup class="text-danger">*</sup></span>
                                    <div class="card-header-right"><i class="icofont icofont-spinner-alt-5"></i></div>

                                    <div class="card-header-right">
                                        <i class="icofont icofont-spinner-alt-5"></i>
                                    </div>

                                </div>
                                <div class="card-block">
                                    <h4 class="sub-title"></h4>
                                    <form action="<?= base_url('suplier/tambah') ?>" method="post">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Nama Suplier <sup class="text-danger">*</sup></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="nama_sup" value="<?= set_value('nama_sup') ?>">
                                                <?= form_error('nama_sup', '<small class="text-danger">', '</small>') ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Alamat Suplier <sup class="text-danger">*</sup></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="alamat" value="<?= set_value('alamat') ?>">
                                                <?= form_error('alamat', '<small class="text-danger">', '</small>') ?>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Nomor Telepon <sup class="text-danger">*</sup></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="telp" value="<?= set_value('telp') ?>">
                                                <?= form_error('telp', '<small class="text-danger">', '</small>') ?>
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