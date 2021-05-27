<html>

<head>
    <title>Riwayat Pembelian Obat Kepada Suplier</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>

<body>
    <div class="container box">
        <h3 align="center">Riwayat Pembelian Obat Kepada Suplier</h3>
        <br />

        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="panel-title text-center"><b>D 'A P O T E K</b></h3>
                        <span></span>
                    </div>
                    <div class="col-md-6" align="right">
                        <input type="submit" name="export" class="btn btn-success btn-xs" value="Export to CSV" />
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>No</th>
                            <th>Tanggal Transaksi</th>
                            <th>No. Referensi</th>
                            <th>Nama Pemasok</th>
                            <th>Total</th>
                        </tr>
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
                    </table>
                </div>
                <div class="card">
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <form method="post" action="<?php echo base_url(); ?>pembelian/file_csv">
                                <table class="table table-hover">
                                    <h1 class="panel-title text-center"><b>D 'A P O T E K</b></h1>
                                    <h3 class="panel-title text-center">No. SIA: 0173/0211/3.3/2001/11/2018</h3>
                                    <h3 class="panel-title text-center">Jl. Bunga Asoka No.49D Medan</h3>
                                    <p class="panel-title text-center">Nama Apoteker: Riwandi Yusuf H S.Farm.,Apt</p>
                                    <p class="panel-title text-center">no. SIPA: 3219/3233/3.1/2001/09/2018</p>
                                    <hr class="divided">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal Transaksi</th>
                                            <th>No. Referensi</th>
                                            <th>Nama Pemasok</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($purchase->result_array() as $p) { ?>
                                            <tr>
                                                <th scope="row"><?= $no++ ?></th>
                                                <td><?= date('j F Y', strtotime($p->tgl_beli)); ?></td>
                                                <td><?= $p->no_ref ?></td>
                                                <td><?= $p->nama_sup; ?></td>
                                                <td><?= $p->grandtotal; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <input type="submit" name="export" class="btn btn-success btn-xs" value="Export to CSV" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
</body>

</html>