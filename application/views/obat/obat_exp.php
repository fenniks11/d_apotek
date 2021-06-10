<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-header start -->
                <div class="page-header card">
                    <div class="row align-items-end">
                        <div class="col-lg-6">
                            <div class="page-header-title">
                                <i class="icofont icofont-table bg-c-blue"></i>
                                <div class="d-inline">
                                    <h4><?= $judul; ?></h4>
                                    <span>Data seluruh obat yang sudah dan hampir kadaluarsa.</span>
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
                                    <li class="breadcrumb-item"><a href="<?= base_url('obat') ?>">Daftar Obat</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="<?= base_url('obat/daftar_obat_exp') ?>"><?= $judul; ?></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-header end -->

                <!-- Page-body start -->
                <div class="page-body">
                    <!-- Basic table card start -->
                    <div class="card">
                        <div class="card-header">
                            <h5>Table Data Obat Kadaluarsa</h5>
                            <div class="card-header-right">
                                <ul class="list-unstyled card-option">
                                    <li><i class="icofont icofont-simple-left "></i></li>
                                    <li><i class="icofont icofont-maximize full-card"></i></li>
                                    <li><i class="icofont icofont-minus minimize-card"></i></li>
                                    <li><i class="icofont icofont-refresh reload-card"></i></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-block table-border-style">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Obat</th>
                                            <th>Kategori & Jenis</th>
                                            <th>Stok</th>
                                            <th>Kadaluarsa</th>
                                            <th>Harga Beli</th>
                                            <th>Suplier</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (count($obat_exp) == 0) { ?>
                                            <tr>
                                                <td colspan="8" class="text-center text-info">
                                                    <h3>Belum ada obat yang kadaluarsa.</h3>
                                                </td>
                                            </tr>

                                        <?php } else { ?>
                                            <?php $no = 1;
                                            foreach ($obat_exp as $exp) { ?>
                                                <tr>
                                                    <th scope="row"><?= $no++; ?></th>
                                                    <td><?= $exp->nama_obat ?></td>
                                                    <td><?= $exp->nama_kategori ?> - <?= $exp->jenis ?></td>
                                                    <td><?= $exp->stok ?></td>
                                                    <td class="text-danger"><?= $exp->tgl_expired ?></td>
                                                    <td>Rp.<?= number_format($exp->harga_beli, 0, ',', '.') ?>,-</td>
                                                    <td><?= $exp->nama_sup ?></td>
                                                </tr>

                                            <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Basic table card end -->
                </div>
                <!-- Page-body start -->
                <div class="page-body">
                    <!-- Basic table card start -->
                    <div class="card">
                        <div class="card-header">
                            <h5>Table Data Obat yang akan Kadaluarsa Kurang dari 60 hari</h5>
                            <div class="card-header-right">
                                <ul class="list-unstyled card-option">
                                    <li><i class="icofont icofont-simple-left "></i></li>
                                    <li><i class="icofont icofont-maximize full-card"></i></li>
                                    <li><i class="icofont icofont-minus minimize-card"></i></li>
                                    <li><i class="icofont icofont-refresh reload-card"></i></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-block table-border-style">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Obat</th>
                                            <th>Kategori & Jenis</th>
                                            <th>Stok</th>
                                            <th>Kadaluarsa</th>
                                            <th>Harga Beli</th>
                                            <th>Suplier</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (count($hampir_exp) == 0) { ?>
                                            <tr>
                                                <td colspan="8" class="text-center text-info">
                                                    <h3>Belum ada obat yang hampir kadaluarsa</h3>
                                                </td>
                                            </tr>

                                        <?php } else { ?>
                                            <?php $no = 1;
                                            foreach ($hampir_exp as $hExp) { ?>
                                                <tr>
                                                    <th scope="row"><?= $no++; ?></th>
                                                    <td><?= $hExp->nama_obat ?></td>
                                                    <td><?= $hExp->nama_kategori ?> - <?= $hExp->jenis ?></td>
                                                    <td><?= $hExp->stok ?></td>
                                                    <td class="text-danger"><?= $hExp->tgl_expired ?></td>
                                                    <td>Rp.<?= number_format($exp->harga_beli, 0, ',', '.') ?>,-</td>
                                                    <td><?= $hExp->nama_sup ?></td>
                                                </tr>

                                            <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Basic table card end -->
                </div>
            </div>
        </div>
    </div>
</div>