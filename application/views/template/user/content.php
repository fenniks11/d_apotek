<div class="pcoded-content">
    <div class="pcoded-inner-content">

        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <?= $this->session->flashdata('message'); ?>
                <!-- Page-header start -->
                <div class="page-header card">
                    <div class="row align-items-end">
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <i class="icofont icofont-layout bg-c-blue"></i>
                                <div class="d-inline">
                                    <h2><?= $judul; ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="<?= base_url('dahsboard') ?>">
                                            <i class="icofont icofont-home"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="<?= base_url('user') ?>"><?= $judul; ?></a>
                                    </li>

                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-header end -->

                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- List Tag card start -->
                            <div class="card">
                                <div class="card-header">
                                    <?php if (empty($invoice && $get_user)) { ?>
                                        <h3 class="text-center">Belum ada riwayat pembelian. <span class="badge badge-warning col-lg text-black text-center"><a href="<?= base_url('dashboard') ?>">Silahkan berbelanja</a></span> </h3>
                                    <?php } else { ?>
                                        <h6><?= $invoice[0]->tgl_beli; ?> - <?= $invoice[0]->no_ref; ?> </h6>
                                        <div class="card-header-right">
                                            <ul class="list-unstyled card-option">
                                                <li><i class="icofont icofont-minus minimize-card"></i></li>
                                            </ul>
                                            <i class="icofont icofont-spinner-alt-5"></i>
                                        </div>
                                </div>
                                <div class="card-block list-tag">
                                    <div class="text-center">
                                        <img class="img-fluid" src="<?= base_url() ?>assets/images/logoimg.png" width="25%">
                                        <ul>
                                            <address>
                                                <strong>D'APOTEK</strong>
                                                <br>Jl. Bunga Asoka NO.49D, Medan, Sumatera Utara
                                                <br>Medan 20133
                                                <br>Telp: 0274 564707

                                            </address>
                                        </ul>
                                    </div>
                                    <?php foreach ($invoice as $i) { ?>
                                        <div class="card-block table-border-style">
                                            <span class="card-title text-muted">No. Refrensi Pesanan: <?= $i->no_ref; ?></span>
                                            <p class="card-title text-muted">Tanggal Pemesanan: <?= $i->tgl_beli; ?></p>
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama Obat</th>
                                                            <th>Harga Satuan</th>
                                                            <th>Banyak</th>
                                                            <th>Subtotal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $no = 1;
                                                        foreach ($show_invoice as $si) { ?>
                                                            <tr>
                                                                <th scope="row"><?= $no++; ?></th>
                                                                <td><?= $si->nama_obat; ?></td>
                                                                <td><?= $si->harga_jual; ?></td>
                                                                <td><?= $si->banyak; ?></td>
                                                                <td><?= number_format($si->subtotal, 0, ',', '.')  ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <?php foreach ($invoice as $i) { ?>
                                                            <tr>
                                                                <td colspan="4" class="text-right"><b>Total Biaya</b></td>
                                                                <td>
                                                                    <b>Rp. <?= number_format($i->grandtotal, 0, ',', '.') ?>,-</b>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    <?php } ?>

                                    <div class="row text-center">
                                        <div class="col-sm-12 text-left">
                                            <h4 class="sub-title">Dikirim ke: </h4>
                                            <address>
                                                <h6><b>Nama : </b> <?= $get_user['nama']; ?></h6>

                                                <h6>
                                                    <b>Alamat :</b> <?= $get_user['alamat']; ?>, <?= $get_user['nama_kelurahan']; ?>, <?= $get_user['nama_kecamatan']; ?>, <?= $get_user['nama_kabupaten']; ?>, <?= $get_user['nama_provinsi']; ?>
                                                </h6>
                                            </address>
                                        </div>
                                    </div>
                                    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                        Terima kasih sudah mempercayakan kami sebagai mitra pelayanan Anda.
                                    </p>

                                    <div class="row no-print">
                                        <div class="col-xs-12 ml-3">
                                            <button class="btn btn-success" onclick="window.print();"><i class="fa fa-print"></i> Cetak</button>
                                        </div>
                                    </div>

                                <?php } ?>
                                </div>
                            </div>
                            <!-- List Tag card end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>