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
                                    <h4>Detail Obat</h4>
                                    <span>Menampilkan informasi data obat per - item.</span>
                                    <div class="card-header-right"> <i class="icofont icofont-spinner-alt-5"></i>
                                        <button type="button" class="btn btn-warning waves-effect" data-toggle="tooltip" data-placement="top" title="Edit Obat <?= $detailObat_id->nama_obat ?>">
                                            <a href="<?= base_url('obat/edit_obat/' . $detailObat_id->id_obat) ?>"><i class="fas fa-pencil-alt"> Edit</i></a>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <h4 class="sub-title"></h4>
                                    <div class="row">
                                        <div class="col-sm-12 col-xl-6">
                                            <h1><strong><?= $detailObat_id->nama_obat; ?></strong></h1>
                                            <a href="<?= base_url('assets/gambar_obat/' . $detailObat_id->gambar); ?>">
                                                <img class="img-obat" src="<?= base_url('assets/gambar_obat/' . $detailObat_id->gambar); ?>" alt="" width=""><br>
                                            </a>
                                            <h5>Harga Beli <span>Rp.<?= number_format($detailObat_id->harga_beli, 0, ',', '.') ?>,-</span></h5>
                                            <h5>Harga Jual <span>Rp.<?= number_format($detailObat_id->harga_default, 0, ',', '.') ?>,-</span></h5>
                                            <h5>Berat: <span><?= $detailObat_id->berat ?></span></h5>
                                            <h5>Stok Obat: <span><?= $detailObat_id->stok ?></span></h5>
                                            <span class="text-dark">
                                                Kategori: <a href="<?= base_url('kategori_dan_jenis/daftar') ?>" class="text-info"><?= $detailObat_id->nama_kategori; ?></a>
                                            </span> &
                                            <span>
                                                Jenis: <?= $detailObat_id->jenis; ?>
                                            </span>

                                        </div>
                                        <div class="col-sm-12 col-xl-6">
                                            <h3 class="lead mt-3"><strong> Deskripsi Obat</strong>

                                            </h3>
                                            <p>
                                                <?= $detailObat_id->deskripsi; ?>
                                            </p>

                                            <p>
                                                Suplier: <span><?= $detailObat_id->nama_sup; ?></span>
                                            </p>
                                            <?php
                                            $persediaan = $detailObat_id->persediaan;
                                            if ($persediaan == 'Y') {
                                            ?>
                                                <p>
                                                    Persediaan: <span class="text-success">Tersedia</span>
                                                </p>
                                                <p class="text-danger">
                                                    Expired Date: <span><?= $detailObat_id->tgl_expired; ?></span>
                                                </p>
                                            <?php
                                            } else { ?>
                                                <p>
                                                    Persediaan: <span class="text-danger">Tidak Tersedia</span>
                                                </p>
                                            <?php } ?>

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