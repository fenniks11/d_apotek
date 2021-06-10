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
                                    <h4>Detail Obat</h4>
                                    <span>Menampilkan informasi data obat per - item.</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="<?= base_url('admin'); ?>">
                                            <i class="icofont icofont-home"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="<?= base_url('obat') ?>">Obat</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="<?= base_url('obat/detail_obat') . $detailObat_id->id_obat ?>"><?= $detailObat_id->nama_obat ?></a>
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
                            <!-- Text elements start -->
                            <div class="card">
                                <div class="card-header">
                                    <h4><?= $detailObat_id->nama_obat; ?></h4>
                                    <span>Detail Obat, <?= $detailObat_id->nama_obat; ?></span>
                                    <div class="card-header-right">
                                        <i class="icofont icofont-spinner-alt-5"></i>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <h4 class="sub-title"></h4>
                                    <div class="row">
                                        <div class="col-sm-12 col-xl-6">
                                            <ul>
                                                <li>
                                                    <a href="<?= base_url('assets/gambar_obat/' . $detailObat_id->gambar); ?>">
                                                        <img class="img-obat" src="<?= base_url('assets/gambar_obat/' . $detailObat_id->gambar); ?>" class="rounded mx-auto d-block"><br>
                                                    </a>
                                                </li>
                                                <li>
                                                    <h4><span class="badge badge-light col-lg">Stok Obat: <?= $detailObat_id->stok ?></span></h4>
                                                </li>
                                                <div class="row mt-2">
                                                    <div class="col-6">
                                                        <li>
                                                            <h4><span class="badge badge-info col-lg">Rp.<?= number_format($detailObat_id->harga_default, 0, ',', '.') ?>,-</span></h4>
                                                        </li>
                                                    </div>
                                                    <div class="col-6">
                                                        <li>
                                                            <h4><span class="badge badge-primary col-lg">Berat: <?= $detailObat_id->berat ?></span></h4>
                                                        </li>
                                                    </div>
                                                </div>
                                            </ul>

                                            <?php echo anchor('dashboard/tambah_keranjang/' . $detailObat_id->id_obat, '<div class="btn col-lg btn-outline-primary waves-effect " data-toggle="tooltip" data-placement="top" title="Tambah ke keranjang"><i class="ti-shopping-cart"> Tambah</i></div>')  ?>

                                        </div>
                                        <div class="col-sm-12 col-xl-6">
                                            <h4 class="card-title"> Deskripsi Obat</h4>
                                            <p class="card-subtitle">
                                                <?= $detailObat_id->deskripsi; ?>
                                            </p>

                                            <div class="align-content-end flex-wrap">
                                                <?php
                                                $persediaan = $detailObat_id->persediaan;
                                                if ($persediaan == 'Y') {
                                                ?>
                                                    <ul>
                                                        <li>

                                                            <h5><span class="badge badge-success col-lg">Persediaan: Tersedia</span></h5>
                                                        </li>
                                                        <li>
                                                            <h5><span class="badge badge-warning col-lg">Expired Date: <?= $detailObat_id->tgl_expired; ?></span></h5>

                                                        </li>
                                                    </ul>
                                                <?php
                                                } else { ?>

                                                    <h5><span class="badge badge-danger col-lg">
                                                            Persediaan: Tidak Tersedia
                                                        </span>
                                                    </h5>
                                                <?php } ?>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Text elements end -->
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div id="styleSelector">

        </div>

    </div>

</div>