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
                                <li><i class="icofont icofont-error close-card"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <div class="row mt-3 mb-3 ml-3">
                                <div class="col-md-6">
                                    <a href="<?= base_url('pembelian/export_csv') ?>" type="button" id="csv" class="btn btn-success waves-effect" data-toggle="tooltip" data-placement="top" title="Export to CSV">CSV</a>
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
                                        <button type="button" class="btn btn-outline-primary waves-effect" data-toggle="tooltip" data-placement="top" title="Tambah Suplier Obat">
                                            <a href="<?= base_url('pembelian/tambah') ?>">
                                                <i class="ti-plus"></i>
                                            </a>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>No. Referensi</th>
                                        <th>Nama Pemasok</th>
                                        <th>Total</th>
                                        <th colspan="2">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($purchase as $p) { ?>
                                        <tr>
                                            <th scope="row"><?= $no++ ?></th>
                                            <td><?= date('j F Y', strtotime($p->tgl_beli)); ?></td>
                                            <td><?= $p->no_ref ?></td>
                                            <td><?= $p->nama_sup; ?></td>
                                            <td><?= $p->grandtotal; ?></td>
                                            <td><button type="button" class="btn btn-warning waves-effect" data-toggle="tooltip" data-placement="top" title="Edit <?= $p->no_ref; ?>"><a href="<?= base_url('pembelian/edit/'  . $p->no_ref) ?>"><i class="fas fa-pencil-alt"></i></a>
                                                </button>
                                            </td>
                                            <td><button type="button" class="btn btn-danger waves-effect" data-toggle="tooltip" data-placement="top" title="Hapus <?= $p->no_ref; ?>"><a href="<?= base_url('pembelian/hapus/'  . $p->no_ref) ?>  " onclick="return confirm('Apakah data ingin dihapus?')"><i class=" fas fa-fw fa-trash"></i></a>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Hover table card end -->
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>