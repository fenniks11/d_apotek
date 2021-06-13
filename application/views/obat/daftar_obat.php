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
                    <?= $this->session->flashdata('message'); ?>
                    <div class="card">
                        <div class="card-header">
                            <h5>Nama-nama obat terdaftar</h5>
                            <span>Tabel nama-nama <code>obat</code> dari semua kategori</span>
                            <div class="card-header-right">
                                <form action="<?= base_url('obat') ?>" method="POST">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="keyword" placeholder="Cari Obat" aria-label="Username" aria-describedby="basic-addon1" autofocus autocomplete="on">
                                        <div class="input-group-append">
                                            <input class="btn btn-primary" type="submit" name="submit" id="basic-addon1">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-block table-border-style">
                            <div class="row mt-3 mb-3 ml-3">
                                <div class="col-md-6">
                                    <a class="btn btn-default waves-effect" href="<?= base_url('obat/export_csv') ?>" data-toggle="tooltip" data-placement="top" title="Export to CSV">CSV
                                    </a>
                                    <button type="button" class="btn btn-default waves-effect " data-toggle="tooltip" data-placement="top" title="Export to Excel">Excel
                                    </button>
                                    <button type="button" class="btn btn-danger waves-effect btn-out-dotted" data-toggle="tooltip" data-placement="top" title="Cetak"><i class="ti-printer"></i>
                                    </button>
                                    <button type="button" class="btn btn-default waves-effect" data-toggle="tooltip" data-placement="top" title="Salin pada keyboard">Salin
                                    </button>

                                </div>
                                <div class="col-md-6">
                                    <div class="btn-text-right mr-3">
                                        <button type="button" class="btn btn-outline-primary waves-effect" data-toggle="tooltip" data-placement="top" title="Tambah Obat">
                                            <a href="<?= base_url('obat/tambah') ?>">
                                                <i class="ti-plus"></i>
                                            </a>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- <div id="hasil"></div> -->
                            <div class="table-responsive">

                                <h5 class="title ml-4 text-muted"> Hasil: <?= $total_rows ?></h5>
                                <table class="table mx-auto" style="width: 95%;">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Obat</th>
                                            <th>Harga Default</th>
                                            <th>Stok</th>
                                            <th>Tanggal Exp</th>
                                            <th colspan="3" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
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
                                        <?php
                                        foreach ($obat as $key) { ?>
                                            <tr>
                                                <th scope="row"><?= ++$start; ?></th>
                                                <td><?= $key['nama_obat'] ?></td>
                                                <td>Rp.<?= number_format($key['harga_default'], 0, ',', '.') ?>,-</td>
                                                <?php if ($key['stok'] > 0) { ?>
                                                    <td><?= $key['stok']; ?></td>
                                                <?php } else { ?>
                                                    <td class="text-danger"><?= $key['stok']; ?></td>
                                                <?php } ?>
                                                <?php
                                                if ($key['tgl_expired'] < date('Y-m-d')) { ?>
                                                    <td class="text-danger"><?= $key['tgl_expired'] ?></td>
                                                <?php } else { ?>
                                                    <td class="text-primary"><?= $key['tgl_expired'] ?></td>
                                                <?php } ?>
                                                <td>
                                                    <a href="<?= base_url('obat/detail_obat/' . $key['id_obat']) ?>" class="btn btn-info btn-round">detail</a> </button>
                                                </td>
                                                <td><button type="button" class="btn btn-warning waves-effect" data-toggle="tooltip" data-placement="top" title="Edit Obat"><a href="<?= base_url('obat/edit_obat/'  . $key['id_obat']) ?>"><i class="fas fa-pencil-alt"></i></a>
                                                    </button>
                                                </td>
                                                <td><button type="button" class="btn btn-danger waves-effect" data-toggle="tooltip" data-placement="top" title="Hapus Obat"><a href="<?= base_url('obat/hapus_obat/'  . $key['id_obat']) ?>  " onclick="return confirm('Apakah data ingin dihapus?')"><i class=" fas fa-fw fa-trash"></i></a>
                                                    </button>
                                                </td>
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