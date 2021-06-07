<!-- content -->
<div class="pcoded-content">
    <div class="pcoded-inner-content">

        <div class="main-body">
            <div class="page-wrapper">
                <div class="card">
                    <img class="card-img" src="<?= base_url() ?>assets/images/apotek.jpg" alt="logo" width="100%" height="300" alt="Card image">
                    <div class="card-img-overlay text-center mt-5 mb-5">
                        <h1 class="card-title"><b>D'Apotek</b></h1>
                        <h5 class="text-muted text-center">Menjual Berbagai Jenis Obat dan Menerima Resep Dokter</h5>
                    </div>
                </div>

                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Badges card start -->
                            <div class="card">
                                <div class="card-header">
                                    <div class="page-header-title">
                                        <i class="icofont icofont icofont icofont-file-document bg-c-pink"></i>
                                        <div class="d-inline">
                                            <h1>Daftar Semua Obat</h1>
                                        </div>
                                    </div>
                                    <?php
                                    if (empty($obat)) :
                                    ?>
                                        <tr>
                                            <td colspan="5">
                                                <div class="alert alert-danger" role="alert">
                                                    Data Tidak Ditemukan!
                                                </div>

                                            </td>
                                        </tr>
                                    <?php endif ?>
                                </div>
                                <div class="card-block">
                                    <div class="row">
                                        <?php
                                        foreach ($obat as $key) { ?>
                                            <div class="col-lg-4">
                                                <div class="badge-box">
                                                    <div class="text-right">
                                                        <?php echo anchor('dashboard/tambah_keranjang/' . $key['id_obat'], '<div class="btn btn-sm btn-primary waves-effect " data-toggle="tooltip" data-placement="top" title="Tambah ke keranjang"><i class="ti-shopping-cart"> Tambah</i></div>')  ?>
                                                    </div>
                                                    <a href="<?= base_url('obat/detail_obat/') . $key['id_obat'] ?>">

                                                        <div class="sub-title mb-2"><a href="<?= base_url('obat/detail_obat/') . $key['id_obat'] ?>">
                                                                <h5><?= $key['nama_obat'] ?></h5>
                                                                <p>
                                                                    <small class="text-info">Exp: <?= date($key['tgl_expired']) ?></small>
                                                                </p>
                                                        </div>
                                                        <a href="<?= base_url('assets/gambar_obat/' . $key['gambar']); ?>">
                                                            <img class="card-img" src="<?= base_url('assets/gambar_obat/' . $key['gambar']); ?>" style="width:100%; height: 200px">
                                                        </a>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <label class="badge badge-info col-lg">
                                                                    <span>Rp.<?= number_format($key['harga_default'], 0, ',', '.') ?>,-</span>
                                                                </label>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label class="badge badge-info col-lg">
                                                                    <span>Stok: <?= $key['stok'] ?></span>
                                                                </label>
                                                            </div>
                                                        </div>

                                                    </a>

                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?= $this->pagination->create_links(); ?>
                            </div>
                            <!-- Badges card end -->
                        </div>
                    </div>
                </div>

            </div>
            <!-- end content -->
        </div>
    </div>
</div>
</div>