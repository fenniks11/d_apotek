<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <?= $this->session->flashdata('message'); ?>
                <!-- Page-header start -->
                <div class="page-header card">
                    <div class="row align-items-end">
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <i class="icofont icofont icofont icofont-file-document bg-c-pink"></i>
                                <div class="d-inline">
                                    <h4><?= $judul; ?></h4>
                                    <span><?= $user['nama']; ?>, halaman ini memuat data resep yang kamu unggah</span>
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
                                    <li class="breadcrumb-item"><a href="<?= base_url('resep/unggah_resep') ?>">Unggah Resep</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="<?= base_url('resep/user_resep') ?>"><?= $judul; ?></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-header end -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <?php $target = 1;
                            $control = 1;
                            $label = 1;
                            $collapeid = 1;
                            foreach ($resep as $key) { ?>
                                <div id="accordion">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?= $target++; ?>" aria-expanded="true" aria-controls="collapse<?= $control++; ?>">
                                                <?= $key['waktu']; ?>
                                            </button>
                                            <?php if ($key['status'] == 1) { ?>
                                                <p>Silahkan cekout dalam waktu 1x24 jam. Tambahkan pada catatan pada saat pembayaran "<b class="text-warning">RESEP D'APOTEK, 'email_anda'. </b>"

                                                </p>
                                                <p class="text-muted"> Bila tidak segera melakukan cekout, maka resep akan dihapus.</p>
                                            <?php } ?>
                                        </h5>
                                    </div>

                                    <div id="collapse<?= $collapeid++; ?>" class="collapse show" aria-labelledby="heading<?= $label++; ?>" data-parent="#accordion">
                                        <div class="card-body text-center">
                                            <?php $no = 1; ?>
                                            <div class="card-block table-border-style">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-light table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th>Gambar</th>
                                                                <th>Status</th>
                                                                <th>Keterangan</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>

                                                                <th> <a href="<?= base_url('assets/gambar_resep/' . $key['gambar']); ?>">
                                                                        <img class="img-resep" src="<?= base_url('assets/gambar_resep/' . $key['gambar']); ?>" alt="" width=""><br>
                                                                    </a></th>
                                                                <?php if ($key['status'] == 1) { ?>
                                                                    <td><button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal">Cekout</button></td>
                                                                    <!-- Modal -->
                                                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="exampleModalLabel">Hallo, <?= $user['nama'] ?></h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <p class="modal-subtitle text-info" id="exampleModalLabel">Lakukan pembayaran ke nomor rekening BNI - 1234567890 a.n D'Apotek. Lalu, upload bukti pembayaran di form ini.</p>
                                                                                    <?php
                                                                                    if (isset($error_upload)) {
                                                                                        echo '<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . $error_upload . '</div>';
                                                                                    }

                                                                                    echo form_open_multipart('resep/cekout_resep/' . $key['id_resep']); ?>

                                                                                    <div class="form-group row">
                                                                                        <input type="hidden" name="id_resep" value="<?= $key['id_resep']; ?>">
                                                                                        <input type="hidden" name="member_id" value="<?= $user['user_id']; ?>">
                                                                                        <label class="col-sm-2 col-form-label"><small>Upload Bukti Pembayaran</small></label>
                                                                                        <div class="col-sm-10">
                                                                                            <input type="file" class="form-control" name="gambar">
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                                                </div>
                                                                                <?= form_close(); ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php } else if ($key['status'] == 2) { ?>
                                                                    <td><button type="button" class="btn btn-sm btn-warning" disabled>Diproses</button></td>
                                                                <?php } else if ($key['status'] == 3) { ?>
                                                                    <td><button type="button" class="btn btn-sm btn-primary" disabled>Sudah Dibayar</button></td>
                                                                <?php } else { ?>
                                                                    <td><button type="button" class="btn btn-sm btn-danger" disabled>Ditolak</button></td>
                                                                <?php } ?>
                                                                <?php if ($key['keterangan'] == "") { ?>
                                                                    <td>
                                                                        <p class="text-info">Belum ada keterangan apapun. Harap Menunggu.</p>
                                                                    </td>
                                                                <?php } else { ?>
                                                                    <td><?= $key['keterangan'] ?></td>
                                                                <?php } ?>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                </div>

                                            </div>
                                        </div>
                                    </div><br>

                                </div>
                                <?php if ($key['id_resep'] == " ") { ?>
                                    <span class="text-info">Belum mengunggah resep apapun. <a href="<?= base_url('resep/unggah_resep') ?>">Unggah Sekarang.</a></span>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>