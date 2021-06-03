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
                                    <h2><?= $judul; ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="index.html">
                                            <i class="icofont icofont-home"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="<?= base_url('pembelian/daftar') ?>">Daftar Pembelian Obat</a>
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
                    <div class="card">
                        <div class="card-header text-center">
                            <ul>
                                <address>
                                    <h3><strong>D'APOTEK</strong></h3>
                                    <b>No. SIA: 0173/0211/3.3/2001/11/2018</b>
                                    <br><strong>
                                        Jl. Bunga Asoka no.49D Medan
                                    </strong>
                                    <br>
                                    <h5><b>Nama Apoteker: Riwandi Yusuf H S.Farm.,Apt</b></h5>
                                    <br>
                                    <h5><b>No. SIPA: 3219/3233/3.1/2001/09/2018</b></h5>
                                </address>
                            </ul>
                            <hr>
                            <div class="card-header-right"> <i class="icofont icofont-spinner-alt-5"></i> </div>
                        </div>
                        <div class="card-block list-tag">
                            <?php foreach ($purchase as $p) { ?>
                                <div class="row">
                                    <div class="col-sm-12 col-xl-4">
                                        <p class="title"><b>Kepada Yth</b> <br>
                                            <?= $p->nama_sup; ?>
                                        </p>
                                        <br>
                                        <p class="title"><b>di-</b> <br>
                                            Medan
                                        </p>
                                    </div>
                                    <div class="col-sm-12 col-xl-4">

                                    </div>
                                    <div class="col-sm-12 col-xl-4">
                                        <p class="card-title text-right"><b>
                                                <?= $p->tgl_beli ?>
                                            </b>
                                        </p>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="row">
                                <div class="col-sm-12 col-xl-4">

                                </div>
                                <div class="col-sm-12 col-xl-4">
                                    <h5 class="title text-center">Surat Pesanan Obat <br>
                                        <span><?= $p->no_ref; ?></span>
                                    </h5>

                                </div>
                                <div class="col-sm-12 col-xl-4">

                                </div>
                            </div>
                            <div class=" table-border-style">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>No. </th>
                                                <th>Nama Obat</th>
                                                <th>Jumlah</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;
                                            foreach ($show_purchase as $p) { ?>
                                                <tr>
                                                    <th scope="row"><?= $no++ ?></th>
                                                    <td><?= $p->nama_obat ?></td>
                                                    <td><?= $p->banyak; ?></td>
                                                    <td>Rp. <?= number_format($p->subtotal, 0, ',', '.')  ?>,-</td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <?php foreach ($purchase as $i) { ?>
                                                <tr>
                                                    <td style="text-align:center; vertical-align: middle" colspan="3"><b>Grand Total</b></td>
                                                    <td>
                                                        <b>Rp <?= number_format($i->grandtotal, 0, ',', '.') ?>,-</b>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="row no-print">
                                <div class="col-xs-12 ml-3">
                                    <button class="btn btn-success" onclick="window.print();"><i class="fa fa-print"></i> Cetak</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Other card end -->
                </div>
            </div>
        </div>