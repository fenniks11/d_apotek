<div class="pcoded-content">
    <div class="pcoded-inner-content">

        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-header start -->
                <div class="page-header card">
                    <div class="row align-items-end">
                        <div class="col-lg-6">
                            <div class="page-header-title">
                                <i class="icofont icofont icofont icofont-file-document bg-c-pink"></i>
                                <div class="d-inline">
                                    <h4>Daftar Obat</h4>
                                    <span>Semua daftar nama-nama obat yang tersedia.</span>
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
                                    <li class="breadcrumb-item"><a href="<?= base_url('obat') ?>"><?= $judul; ?></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Page-body start -->
                <div class="page-body">
                    <!-- Basic table card start -->
                    <div class="card">
                        <?= $this->session->flashdata('message'); ?>
                        <div class="card-header">
                            <h5><?= $judul; ?></h5>
                            <span>Daftar obat yang tersedia dan tanggal kadaluarsanya belum jatuh tempo.</span>
                        </div>
                        <div class="card-block table-border-style">
                            <div class="btn-text-right mr-3">
                                <button type="button" class="btn btn-outline-primary waves-effect" data-toggle="tooltip" data-placement="top" title="Tambah Obat">
                                    <a href="<?= base_url('obat/tambah') ?>">
                                        <i class="ti-plus"> Obat</i>
                                    </a>
                                </button>
                            </div>

                        </div>

                        <!-- <div id="hasil"></div> -->
                        <div class="table-responsive">

                            <h5 class="title ml-4 text-muted"> Hasil: <?= $total_rows ?></h5>
                            <table class="table mx-auto" style="width: 95%;">
                                <thead>
                                    <div class="card-block">
                                        <div class="card-header-right">
                                            <form action="<?= base_url('obat/obat_tersedia') ?>" method="POST">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name="keyword" placeholder="Cari nama obat" aria-label="Username" aria-describedby="basic-addon1" autofocus autocomplete="on">
                                                    <div class="input-group-append">
                                                        <input class="btn btn-primary" type="submit" name="submit" id="basic-addon1">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Obat</th>
                                        <th>Harga Default</th>
                                        <th>Stok</th>
                                        <th>Tanggal Exp</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    foreach ($obat as $key) { ?>
                                        <tr>
                                            <th scope="row"><?= ++$start; ?></th>
                                            <td><?= $key['nama_obat'] ?></td>
                                            <td>Rp.<?= number_format($key['harga_jual'], 0, ',', '.') ?>,-</td>
                                            <td><?= $key['stok_obat']; ?></td>
                                            <td class="text-primary"><?= $key['tgl_expired'] ?></td>
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
        <div id="styleSelector">

        </div>


    </div>
</div>
</div>