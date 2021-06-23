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
                                <i class="icofont icofont-table bg-c-blue"></i>
                                <div class="d-inline">
                                    <h4><?= $judul; ?></h4>
                                    <span>Riwayat Pembelian Obat Kepada Suplier. </span>
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
                                    <li class="breadcrumb-item"><a href="<?= base_url('kategori_dan_jenis/daftar') ?>">Kategori dan Jenis</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-header end -->

                <?= $this->session->flashdata('message'); ?>
                <!-- Hover table card start -->
                <div class="card">
                    <div class="card-header">
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
                            <div class="row mt-3 mb-3 ml-3">
                                <div class="btn-text-right mr-3">
                                    <button type="button" class="btn btn-outline-primary waves-effect" data-toggle="tooltip" data-placement="top" title="Tambah Suplier Obat">
                                        <a href="<?= base_url('pembelian/tambah') ?>">
                                            <i class="ti-plus"> Pembelian</i>
                                        </a>
                                    </button>
                                </div>

                            </div>
                            <table class="table table-hover">
                                <div class="card-block">
                                    <div class="card-header-right">
                                        <form action="<?= base_url('pembelian/daftar') ?>" method="POST">
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="keyword" placeholder="Cari nama suplier atau nomor referensi" aria-label="Username" aria-describedby="basic-addon1" autofocus autocomplete="on">
                                                <div class="input-group-append">
                                                    <input class="btn btn-primary" type="submit" name="submit" id="basic-addon1">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th class="text-center" colspan="">#</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>No. Referensi</th>
                                        <th>Nama Pemasok</th>
                                        <th>Banyak</th>
                                        <th>Total</th>
                                        <th>Admin</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (empty($purchase)) :
                                    ?>
                                        <tr>
                                            <td colspan="8">
                                                <div class="alert alert-danger" role="alert">
                                                    Data Tidak Ditemukan!
                                                </div>

                                            </td>
                                        </tr>
                                    <?php endif ?>
                                    <?php $no = 1;
                                    foreach ($purchase as $p) { ?>
                                        <tr>
                                            <th scope="row"><?= ++$start; ?></th>
                                            <td> <button class="btn btn-primary btn-out-dotted btn-round " type="button" data-toggle="collapse" data-target="#collapseExample<?= ++$no; ?>" aria-expanded="false" aria-controls="collapseExample">
                                                    <i class="fas fa-plus circle"></i>
                                                </button>
                                                <br><br>
                                                <div class="collapse" id="collapseExample<?= $no++; ?>">
                                                    <span>
                                                        <button type="button" class="btn btn-warning waves-effect" data-toggle="tooltip" data-placement="top" title="Cetak <?= $p['no_ref']; ?>"><a href="<?= base_url('pembelian/purchase_page/'  . $p['no_ref']) ?>"><i class="fas fa-print text-white"></i></a>
                                                        </button>
                                                        <button type="button" class="btn btn-danger waves-effect" data-toggle="tooltip" data-placement="top" title="Hapus <?= $p['no_ref']; ?>"><a href="<?= base_url('pembelian/hapus/'  . $p['no_ref']) ?>  " onclick="return confirm('Apakah data ingin dihapus?')"><i class=" fas fa-fw fa-trash"></i></a>
                                                        </button>
                                                    </span>
                                                </div>
                                            </td>
                                            <td><?= $p['tgl_beli']; ?></td>
                                            <td><?= $p['no_ref'] ?></td>
                                            <td><?= $p['nama_sup']; ?></td>
                                            <td><?= $p['banyak']; ?></td>
                                            <td>Rp. <?= number_format($p['grandtotal'], 0, ',', '.'); ?>,-</td>
                                            <td><?= $p['nama_admin']; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <?= $this->pagination->create_links(); ?>
                        </div>
                    </div>
                </div>
                <!-- Hover table card end -->
            </div>
        </div>
    </div>
</div>