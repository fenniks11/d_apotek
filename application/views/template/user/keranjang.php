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
                                    <span>Detail keranjang belanjaan anda </span>
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
                            </ul>
                        </div>
                    </div>
                    <div class="card-block table-border-style">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <div class="card-block">
                                    <?php
                                    if (empty($this->cart->contents())) {
                                    ?>
                                        <div class="card-header-right">
                                            <h5 class="text-center "><a href="<?= base_url('dashboard') ?>" class="text-danger">Keranjang kamu kosong. Silahkan belanja terlebih dulu!</a></h5>
                                        </div>
                                    <?php } else { ?>
                                        <div class="card-header-right">
                                            <h5>Barang di Keranjang kamu.</h5>
                                        </div>
                                </div>
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Obat</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                        foreach ($this->cart->contents() as $p) : ?>
                                        <tr>
                                            <th scope="row"><?= $no++; ?></th>
                                            <td><?= $p['name']; ?></td>
                                            <td><?= $p['qty'] ?></td>
                                            <td>Rp. <?= number_format($p['price'], 0, ',', '.'); ?>,-</td>
                                            <td>Rp. <?= number_format($p['subtotal'], 0, ',', '.'); ?>,-</td>
                                        </tr>

                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4" class="text-center"><b>Grand Total</b></td>
                                        <td>
                                            <b>Rp. <?= number_format($this->cart->total(), 0, ',', '.') ?>,-</b>
                                        </td>
                                    </tr>
                                </tfoot>

                            </table>
                            <div class="card-block text-right">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Cekout
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog  modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Hallo, <?= $user['nama']; ?></h5>
                                                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                                            </div>
                                            <div class="modal-body">
                                                <h5 class="text-left card-subtitle text-info">Jumlah belanjaan kamu Rp. <?= number_format($this->cart->total(), 0, ',', '.') ?>,-</h5>
                                                <form action="<?= base_url('user/cekout') ?>" method="POST">
                                                    <?php foreach ($this->cart->contents() as $p) : ?>
                                                        <input type="hidden" class="form-control form-control-round" value="<?= $p['name']; ?>" name="nama_obat[]" readonly>
                                                        <input type="hidden" class="form-control form-control-round" value="<?= $p['price'] ?>" name="harga_jual[]" readonly>
                                                        <input type="hidden" class="form-control form-control-round" value="<?= $p['qty'] ?>" name="banyak[]" readonly>
                                                        <input type="hidden" class="form-control form-control-round" value="<?= $p['subtotal']; ?>" name="subtotal[]" readonly>
                                                        <input type="hidden" class="form-control form-control-round" value="<?= $user['email']; ?>" name="member_email" readonly>
                                                        <input type="hidden" class="form-control form-control-round" value="<?= $this->cart->total() ?>" name="grandtotal" readonly>
                                                    <?php endforeach; ?>
                                                    <div class="card-block mb-2">
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Email</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control form-control-round" value="<?= $user['email']; ?>" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Telp</label>
                                                            <div class="col-sm-10">
                                                                <input type="number" class="form-control form-control-round" value="<?= $user['telp'] ?>" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Alamat</label>
                                                            <div class="col-sm-10">
                                                                <?php foreach ($get_user as $gu) { ?>
                                                                    <textarea rows="5" cols="5" class="form-control" readonly><?= $gu->alamat; ?>, <?= $gu->nama_kelurahan; ?>, <?= $gu->nama_kecamatan; ?>, <?= $gu->nama_kabupaten; ?>, <?= $gu->nama_provinsi; ?></textarea>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Jasa Kirim</label>
                                                            <div class="col-sm-10">
                                                                <select name="select" class="form-control">
                                                                    <option value="opt5">Jemput di D'Apotek</option>
                                                                    <option value="opt1">Gojek</option>
                                                                    <option value="opt2">Grab</option>
                                                                    <option value="opt3">JNE</option>
                                                                    <option value="opt4">JNT</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label">Pilih Bank</label>
                                                            <div class="col-sm-10">
                                                                <select name="select" class="form-control">
                                                                    <option value="opt1">Cash di D'Apotek</option>
                                                                    <option value="opt2">Dana - <p class="text-muted">XXXXXXXX</p>
                                                                    </option>
                                                                    <option value="opt3">OVO - <p class="text-muted">XXXXXXXX</p>
                                                                    </option>
                                                                    <option value="opt4">Gopay - <p class="text-muted">XXXXXXXX</p>
                                                                    </option>
                                                                    <option value="opt5">BNI - <p class="text-muted">XXXXXXXX</p>
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-sm-2 col-form-label"><small>Upload Bukti Pembayaran</small></label>
                                                            <div class="col-sm-10">
                                                                <input type="file" class="form-control">
                                                            </div>
                                                        </div>
                                                        <small class="text-center">Pastikan data di atas sudah benar ya.. <sup class="text-danger">*</sup></small><br>
                                                        <small class="text-center text-muted">Jika ada perubahan data, <a href="<?= base_url('user/ubah_profil') . $user['user_id'] ?>">klik di sini</a></small>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary">Bayar</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <a href="<?= base_url('dasboard') ?>" class="btn btn-default">Lanjut Belanja</a>
                                <a href="<?= base_url('dashboard/hapus_keranjang') ?>" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?')"><i class="fas fa-trash"></i> Keranjang</a>
                            </div>
                        </div>
                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>