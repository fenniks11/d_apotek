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
                                            <div class="col-lg-4 col-xl-3 col-sm-12">
                                                <div class="badge-box">
                                                    <a href="<?= base_url('obat/detail_obat/') . $key['id_obat'] ?>">
                                                        <div class="sub-title"><a href="<?= base_url('obat/detail_obat/') . $key['id_obat'] ?>"><?= $key['nama_obat'] ?>

                                                        </div>
                                                        <a href="<?= base_url('assets/gambar_obat/' . $key['gambar']); ?>">
                                                            <img class="card-img" src="<?= base_url('assets/gambar_obat/' . $key['gambar']); ?>" style="width:100%;">
                                                        </a>
                                                        <div>
                                                            <label class="badge badge-info col-lg">
                                                                <span>Rp.<?= number_format($key['harga_default'], 0, ',', '.') ?>,-</span>
                                                            </label>
                                                        </div>
                                                    </a>
                                                    <?php echo anchor('dashboard/tambah_keranjang/' . $key['id_obat'], '<div class="btn btn-sm btn-primary">Tambahkan ke Keranjang</div>')  ?>
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
                <div id="styleSelector">

                </div>
            </div>
        </div>
        <!-- end content -->
    </div>
</div>
</div>
</div>