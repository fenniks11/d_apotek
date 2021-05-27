<!-- content -->
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
                                    <h4>SISTEM INFORMASI D'APOTEK</h4>
                                    <span>Halaman Utama Admin</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="<?= base_url('dashboard') ?>">
                                            <i class="icofont icofont-home"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>"><?= $judul; ?></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-header end -->

                <div class="page-body">
                    <div class="page-body">
                        <div class="row">
                            <!-- card1 start -->

                            <div class="col-md-6 col-xl-4">
                                <a href="<?= base_url('obat/tambah') ?>">
                                    <div class="card widget-card-1">
                                        <div class="card-block-small">
                                            <i class="fas fa-tablets bg-c-blue card1-icon"></i>
                                            <span class="text-c-blue f-w-600">Jumlah Obat</span>
                                            <h4><?= $stockobat; ?></h4>
                                            <div>
                                                <span class="f-left m-t-10 text-muted">
                                                    <i class="text-c-blue f-16 fas fa-plus-square m-r-10"></i>Tambahkan Data Obat
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- card1 end -->
                            <!-- card1 start -->
                            <div class="col-md-6 col-xl-4">
                                <a href="<?= base_url('kategori_dan_jenis/tambah_kat') ?>">
                                    <div class="card widget-card-1">
                                        <div class="card-block-small">
                                            <i class="fas fa-pills bg-c-pink card1-icon"></i>
                                            <span class="text-c-pink f-w-600">Total Kategori</span>
                                            <h4><?= $tot_kat; ?></h4>
                                            <div>
                                                <span class="f-left m-t-10 text-muted">
                                                    <i class="text-c-pink f-16 fas fa-plus-square m-r-10"></i>Tambahkan Kategori Obat
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- card1 end -->
                            <!-- card1 start -->
                            <div class="col-md-6 col-xl-4">
                                <a href="<?= base_url('suplier/tambah') ?>">
                                    <div class="card widget-card-1">
                                        <div class="card-block-small">
                                            <i class="fas fa-users bg-c-green card1-icon"></i>
                                            <span class="text-c-green f-w-600">Total Suplier</span>
                                            <h4><?= $tot_sup; ?></h4>
                                            <div>
                                                <span class="f-left m-t-10 text-muted">
                                                    <i class="text-c-green f-16 fas fa-plus-square m-r-10"></i>Tambahkan Suplier Baru.
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <a href="<?= base_url('kategori_dan_jenis/tambah_jenis') ?>">
                                    <div class="card widget-card-1">
                                        <div class="card-block-small">
                                            <i class="fas fa-capsules bg-c-green card1-icon"></i>
                                            <span class="text-c-green f-w-600">Total Jenis Obat</span>
                                            <h4><?= $jenis; ?></h4>
                                            <div>
                                                <span class="f-left m-t-10 text-muted">
                                                    <i class="text-c-green f-16 icofont icofont-tag m-r-10"></i>Tracked via microsoft
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6 col-xl-4">
                                <div class="card widget-card-1">
                                    <div class="card-block-small">
                                        <i class="fas fa-users bg-c-green card1-icon"></i>
                                        <span class="text-c-green f-w-600">Total Suplier</span>
                                        <h4><?= $tot_sup; ?></h4>
                                        <div>
                                            <span class="f-left m-t-10 text-muted">
                                                <i class="text-c-green f-16 icofont icofont-tag m-r-10"></i>Tracked via microsoft
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- card1 end -->
                            <!-- card1 start -->
                            <div class="col-md-6 col-xl-4">
                                <div class="card widget-card-1">
                                    <div class="card-block-small">
                                        <i class="icofont icofont-social-twitter bg-c-yellow card1-icon"></i>
                                        <span class="text-c-yellow f-w-600">Followers</span>
                                        <h4>+562</h4>
                                        <div>
                                            <span class="f-left m-t-10 text-muted">
                                                <i class="text-c-yellow f-16 icofont icofont-refresh m-r-10"></i>Just update
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- card1 end -->
                        </div>
                    </div>
                </div>
                <div id="styleSelector">

                </div>
            </div>
        </div>
        <!-- end content -->
    </div>
</div>
</div>
</div>