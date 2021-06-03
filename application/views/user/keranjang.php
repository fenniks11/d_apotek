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
                                    <span>Detail keranjang belanjaan anda </span>
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
                                <li><i class="icofont icofont-error close-card"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <div class="card-block">
                                    <div class="card-header-right">
                                        <h5>Barang di Keranjang kamu.</h5>
                                    </div>
                                </div>
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Obat</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (empty($this->cart->contents())) :
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
                                    foreach ($this->cart->contents() as $p) : ?>
                                        <tr>
                                            <th scope="row"><?= $no++; ?></th>
                                            <td><?= $p['name']; ?></td>
                                            <td><?= $p['qty'] ?></td>
                                            <td>Rp. <?= number_format($p['price'], 0, ',', '.'); ?>,-</td>
                                            <td>Rp. <?= number_format($p['subtotal'], 0, ',', '.'); ?>,-</td>
                                        </tr>

                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4" class="text-center"><b>Grand Total</b></td>
                                        <td>
                                            <b>Rp. <?= number_format($this->cart->total(), 0, ',', '.') ?>,-</b>
                                        </td>
                                    </tr>
                                </tfoot>

                            </table>
                            <div class="card-block text-right">
                                <a href="<?= base_url('dashboard/cekout') ?>" class="btn btn-primary">Cekout</a>
                                <a href="<?= base_url('dasboard') ?>" class="btn btn-default">Lanjut Belanja</a>
                                <a href="<?= base_url('dashboard/hapus_keranjang') ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')"><i class="fas fa-trash"></i> Keranjang</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>