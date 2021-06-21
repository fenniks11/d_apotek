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
                    <!-- Basic table card start -->
                    <div class="card">
                        <div class="card-header">
                            <h5>Riwayat Pembelian Obat</h5>
                            <span>Hai, <?= $user['nama'] ?>. Halaman ini berisi obat-obatan yang pernah kamu beli di D'Apotek.</span>
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
                            <div class="row">
                                <div class="col-2"></div>
                                <div class="col-8">
                                    <form action="<?= base_url('resep') ?>" method="POST">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="keyword" placeholder="Cari Nomor Referensi" aria-label="Username" aria-describedby="basic-addon1" autofocus autocomplete="on">
                                            <div class="input-group-append">
                                                <input class="btn btn-primary" type="submit" name="submit" id="basic-addon1">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-2"></div>
                            </div>
                            <div class="card-block">
                                <div class="table-responsive">
                                    <h5 class="title ml-4 text-muted"> Hasil: <?= $total_rows ?></h5>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Aksi</th>
                                                <th>Nomor Referensi</th>
                                                <th>Tanggal Pembelian</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (empty($show_invoice)) { ?>
                                                <h1>Tidak ada data. Anda belum pernah melakukan transaksi.</h1>
                                            <?php } else
                                            if ($keyword && empty($show_invoice)) {
                                            ?>
                                                <tr>
                                                    <td colspan="8">
                                                        <div class="alert alert-danger" role="alert">
                                                            Data dengan kata <?= $keyword; ?> Tidak Ditemukan!
                                                        </div>

                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            <?php $no = 1;
                                            foreach ($show_invoice as $i) { ?>
                                                <tr>
                                                    <th scope="row"><?= ++$start; ?></th>
                                                    <td>
                                                        <button class="btn btn-primary btn-out-dotted btn-round " type="button" data-toggle="collapse" data-target="#collapseExample<?= ++$no; ?>" aria-expanded="false" aria-controls="collapseExample">
                                                            <i class="fas fa-plus circle"></i>
                                                        </button>
                                                        <br><br>
                                                        <div class="collapse" id="collapseExample<?= $no++; ?>">
                                                            <span>
                                                                <button type="button" class="btn btn-warning waves-effect" data-toggle="tooltip" data-placement="top" title="Cetak <?= $i['no_ref']; ?>"><a href="<?= base_url('resep/invoice_page/'  . $i['no_ref']) ?>"><i class="fas fa-print text-white"></i></a>
                                                                </button>
                                                                <button type="button" class="btn btn-danger waves-effect" data-toggle="tooltip" data-placement="top" title="Hapus <?= $i['no_ref']; ?>"><a href="<?= base_url('resep/hapus/'  . $i['no_ref']) ?>  " onclick="return confirm('Apakah data ingin dihapus?')"><i class=" fas fa-fw fa-trash"></i></a>
                                                                </button>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td><b><?= $i['no_ref']; ?></b></td>
                                                    <td><?= $i['tgl_beli']; ?></td>
                                                    <td><?= $i['grandtotal']; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <?= $this->pagination->create_links(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
<div id="styleSelector">

</div>