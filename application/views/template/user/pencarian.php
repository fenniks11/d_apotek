<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-header start -->
                <div class="page-header card">
                    <div class="row align-items-end">
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <i class="icofont icofont-layout bg-c-blue"></i>
                                <div class="d-inline">
                                    <h1>Hasil Pencarian..</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-header end -->

                <!-- Page body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Badges card start -->
                            <div class="card">
                                <div class="card-header">
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
                                                <a href="<?= base_url('obat/detail_obat/') . $key['id_obat'] ?>">
                                                    <div class="badge-box">
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
                                                    </div>
                                                </a>
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
                <!-- Page body end -->
            </div>
        </div>
        <!-- Main-body end -->
    </div>
</div>