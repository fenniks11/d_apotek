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
                                    <span>Riwayat Penjualan Obat Kepada Pembeli. </span>
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
                                <li><i class="icofont icofont-error close-card"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <div class="row mt-3 mb-3 ml-3">
                                <div class="col-md-6">
                                    <button type="button" id="csv" class="btn btn-default waves-effect" data-toggle="tooltip" data-placement="top" title="Export to CSV">CSV
                                    </button>
                                    <button type="button" id="excel" class="btn btn-default waves-effect " data-toggle="tooltip" data-placement="top" title="Export to Excel">Excel
                                    </button>
                                    <button type="button" id="print" class="btn btn-danger waves-effect btn-out-dotted" data-toggle="tooltip" data-placement="top" title="Cetak"><i class="ti-printer"></i>
                                    </button>
                                    <button type="button" id="copy" class="btn btn-default waves-effect" data-toggle="tooltip" data-placement="top" title="Salin pada keyboard">Salin
                                    </button>

                                </div>
                                <div class="col-md-6">
                                    <div class="btn-text-right mr-3">
                                        <button type="button" class="btn btn-outline-primary waves-effect" data-toggle="tooltip" data-placement="top" title="Tambah Penjualan Obat">

                                            <a href="<?= base_url('penjualan/form_tambah') ?>"> <i class="fas fa-plus"> </i></a>

                                        </button>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-hover">
                                <div class="card-block">
                                    <div class="card-header-right">
                                        <form action="<?= base_url('penjualan/daftar') ?>" method="POST">
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="keyword" placeholder="Cari Obat" aria-label="Username" aria-describedby="basic-addon1" autofocus autocomplete="on">
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
                                        <th class="text-center">#</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>No. Referensi</th>
                                        <th>Email Pembeli</th>
                                        <th>Banyak Beli</th>
                                        <th>Admin</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (empty($penjualan)) :
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
                                    foreach ($penjualan as $p) : ?>
                                        <tr>
                                            <th scope="row"><?= ++$start; ?></th>
                                            <td> <button class="btn btn-primary btn-out-dotted btn-round " type="button" data-toggle="collapse" data-target="#collapseExample<?= ++$no; ?>" aria-expanded="false" aria-controls="collapseExample">
                                                    <i class="fas fa-plus circle"></i>
                                                </button>
                                                <br><br>
                                                <div class="collapse" id="collapseExample<?= $no++; ?>">
                                                    <span>
                                                        <button type="button" class="btn btn-warning waves-effect" data-toggle="tooltip" data-placement="top" title="Cetak <?= $p['no_ref']; ?>"><a href="<?= base_url('penjualan/invoice_page/'  . $p['no_ref']) ?>"><i class="fas fa-print text-white"></i></a>
                                                        </button>
                                                        <button type="button" class="btn btn-danger waves-effect" data-toggle="tooltip" data-placement="top" title="Hapus <?= $p['no_ref']; ?>"><a href="<?= base_url('penjualan/hapus/'  . $p['no_ref']) ?>  " onclick="return confirm('Apakah data ingin dihapus?')"><i class=" fas fa-fw fa-trash"></i></a>
                                                        </button>
                                                    </span>
                                                </div>
                                            </td>
                                            <td><?= tanggal($p['tgl_beli']); ?></td>
                                            <td><?= $p['no_ref'] ?></td>
                                            <td><?= $p['member_email']; ?></td>
                                            <td><?= $p['banyak']; ?></td>
                                            <td><?= $p['nama']; ?></td>
                                            <td>Rp. <?= number_format($p['grandtotal'], 0, ',', '.'); ?>,-</td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <?= $this->pagination->create_links(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script> -->