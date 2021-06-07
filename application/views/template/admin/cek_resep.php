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
                                        <a href="<?= base_url('user') ?>">
                                            <i class="icofont icofont-home"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="<?= base_url('user/unggah_resep') ?>">Unggah Resep</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="<?= base_url('user/user_resep') ?>"><?= $judul; ?></a>
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
                            $no = 1;
                            foreach ($resep as $key) { ?>
                                <?php if ($key['status'] == 4) { ?>
                                    <ul>
                                        <li>
                                            <p>
                                                <button class="btn btn-sm btn-outline-success" type="button" data-toggle="collapse" data-target="#collapse<?= $target++; ?>" aria-expanded="false" aria-controls="collapse<?= $control++; ?>">
                                                    <?= $key['waktu']; ?> - Sudah Dibayar
                                                </button>
                                            </p>
                                            <div class="collapse" id="collapse<?= $collapeid++; ?>">
                                                <div class="card-body text-center" style="width: 100%;">
                                                    <div class="card-block table-border-style">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered table-light table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Pengirim</th>
                                                                        <th>Email Pengirim</th>
                                                                        <th>Id Admin</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <?php
                                                                        $id_resep = $key['id_resep'];
                                                                        $query = ("select bukti_tf.waktu as waktu_pembayaran from bukti_tf join resep on resep.id_resep = bukti_tf.id_resep join user on resep.member_id = user.user_id where bukti_tf.id_resep = $id_resep");
                                                                        $q = $this->db->query($query)->result_array();
                                                                        ?>
                                                                        <td rowspan="2">
                                                                            <button class="btn btn-primary btn-out-dotted" type="button" data-toggle="collapse" data-target="#collapseExample<?= ++$no; ?>" aria-expanded="false" aria-controls="collapseExample">
                                                                                <i class="ti-eye"> Lihat</i>
                                                                            </button>
                                                                            <br><br>
                                                                            <div class="collapse" id="collapseExample<?= $no++; ?>">
                                                                                <span>
                                                                                    <a href="<?= base_url('assets/gambar_resep/' . $key['gambar_resep']); ?>">
                                                                                        <img class="img-resep" src="<?= base_url('assets/gambar_resep/' . $key['gambar_resep']); ?>" alt="" width=""><br>
                                                                                    </a>
                                                                                </span><br>

                                                                                <?php foreach ($q as $t) : ?>
                                                                                    <h5>Waktu Pembayaran: <?= $t['waktu_pembayaran']; ?></h5>
                                                                                <?php endforeach ?>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <?= $key['nama_pengirim']; ?>
                                                                        </td>
                                                                        <td>
                                                                            <?= $key['email']; ?>
                                                                        </td>
                                                                        <?php
                                                                        $id_admin = $key['id_admin'];
                                                                        $query = ("select user.email as email_admin from user join resep on user.user_id = resep.user_id where resep.user_id = $id_admin");
                                                                        $q = $this->db->query($query)->result_array();
                                                                        ?>

                                                                        <td>
                                                                            <?= $key['id_admin']; ?> - <?php foreach ($q as $t) : ?>
                                                                                <?= $t['email_admin']; ?>
                                                                            <?php endforeach ?>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <form action="<?= base_url('admin/proses_pesanan/') . $key['id_resep'] ?>">
                                                        <button type="submit" class="form-control btn btn-sm btn-round btn-primary">Submit</button>
                                                    </form>
                                                </div>
                                            </div><br>
                                        </li>
                                    </ul>
                                <?php } else if ($key['status'] == 3) { ?>
                                    <p>
                                        <button class="btn btn-sm btn-outline-success" type="button" data-toggle="collapse" data-target="#collapse<?= $target++; ?>" aria-expanded="false" aria-controls="collapse<?= $control++; ?>">
                                            <?= $key['waktu']; ?> - Sudah Dibayar
                                        </button>
                                    </p>
                                    <div class="collapse" id="collapse<?= $collapeid++; ?>">
                                        <div class="card-body text-center">
                                            <div class="card-block table-border-style">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered table-light table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th>Gambar</th>
                                                                <th>Pengirim</th>
                                                                <th>Email</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td> <a href="<?= base_url('assets/gambar_resep/' . $key['gambar_resep']); ?>">
                                                                        <img class="img-resep" src="<?= base_url('assets/gambar_resep/' . $key['gambar_resep']); ?>" alt="" width=""><br>
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <?= $key['nama_pengirim']; ?>
                                                                </td>
                                                                <td>
                                                                    <?= $key['email']; ?>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <form action="<?= base_url('admin/proses_pesanan/') . $key['id_resep'] ?>">
                                                    <button type="submit" class="form-control btn btn-sm btn-round btn-primary">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div><br>
                                <?php } else { ?>
                                    <div id="accordion">

                                        <div class="card-header" id="headingOne">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <h5 class="mb-0">
                                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?= $target++; ?>" aria-expanded="false" aria-controls="collapse<?= $control++; ?>">
                                                            <?= $key['waktu']; ?>
                                                        </button>
                                                    </h5>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="btn-text-right mr-3">
                                                        <?php if ($key['status'] == 2) { ?>
                                                            <button type="button" class="btn btn-warning" disabled>Belum diproses</button>
                                                        <?php } else if ($key['status'] == 1) { ?>
                                                            <button type="button" class="btn btn-success" disabled>Diterima</button>
                                                        <?php } else { ?>
                                                            <button type="button" class="btn btn-danger" disabled>Ditolak</button>
                                                        <?php } ?>
                                                        <button type="button" class="btn btn-info waves-effect" data-toggle="modal" data-target="#exampleModal" data-toggle="tooltip" data-placement="top" title="Cek Resep">
                                                            <i class="ti-check"></i>
                                                        </button>
                                                    </div>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Hallo, <?= $user['nama']; ?>, lakukan konfirmasi terhadap resep di bawah.</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="<?= base_url('admin/cek_resep') ?>" method="POST">
                                                                        <div class="card-block">
                                                                            <div class="form-group row">
                                                                                <label for="">
                                                                                    <h5>Aksi</h5>
                                                                                </label>
                                                                                <select class="custom-select custom-select-lg" name="status">
                                                                                    <option selected disabled>Pilih Salah Satu</option>
                                                                                    <option value="1">Terima</option>
                                                                                    <option value=" ">Tolak</option>
                                                                                </select>
                                                                                </td>
                                                                                <?= form_error('status'); ?>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label for="">
                                                                                    <h5>Keterangan</h5>
                                                                                </label>
                                                                                <textarea name="keterangan" id="" cols="30" rows="5" class="form-control"></textarea>
                                                                                <?= form_error('keterangan'); ?>
                                                                            </div>
                                                                            <input type="hidden" value="<?= $user['user_id']; ?>" readonly name="admin">
                                                                            <button type="submit" class="form-control btn btn-sm btn-round btn-primary">Submit</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="collapse<?= $collapeid++; ?>" class="collapse show" aria-labelledby="heading<?= $label++; ?>" data-parent="#accordion">
                                            <div class="card-body text-center">
                                                <div class="card-block table-border-style">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-light table-sm">
                                                            <thead>
                                                                <tr>
                                                                    <th>Gambar</th>
                                                                    <th>Pengirim</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td> <a href="<?= base_url('assets/gambar_resep/' . $key['gambar_resep']); ?>">
                                                                            <img class="img-resep" src="<?= base_url('assets/gambar_resep/' . $key['gambar_resep']); ?>" alt="" width=""><br>
                                                                        </a>
                                                                    </td>
                                                                    <td>
                                                                        <?= $key['nama_pengirim']; ?>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>
                                            </div>
                                        </div><br>

                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>