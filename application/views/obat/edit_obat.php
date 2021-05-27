<!-- CKEDITOR -->
<script src="<?= base_url() ?>ckeditor/ckeditor.js"></script>
<script src="<?= base_url() ?>ckeditor/js/sample.js"></script>
<div class="pcoded-content">
    <div class="pcoded-inner-content">

        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-header card">
                    <div class="row align-items-end">
                        <div class="col-lg-6">
                            <div class="page-header-title">
                                <i class="icofont icofont-file-code bg-c-blue"></i>
                                <div class="d-inline">
                                    <h4>Ubah Data Obat</h4>
                                    <span>Formulir pengubahan data<code>obat</code>semua jenis</span>
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
                                    <li class="breadcrumb-item"><a href="<?= base_url('obat') ?>">Daftar Obat</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="<?= base_url('obat/detail_obat/' . $detailObat_id->id_obat) ?>"><?= $judul; ?></a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="<?= base_url('obat/edit_obat/' . $detailObat_id->id_obat) ?>"><?= $judul; ?></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-header end -->

                <!-- Page body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Basic Form Inputs card start -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="text-center">Formulir Penambahan Data Obat-Obatan D'Apotek</h3>
                                    <span class="text-center text-muted">Admin wajib mengisi semua form <sup class="text-danger">*</sup></span>
                                    <div class="card-header-right"><i class="icofont icofont-spinner-alt-5"></i></div>

                                    <div class="card-header-right">
                                        <i class="icofont icofont-spinner-alt-5"></i>
                                    </div>

                                </div>
                                <div class="card-block">
                                    <h4 class="sub-title"></h4>
                                    <?php
                                    if (isset($error_upload)) {
                                        echo '<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . $error_upload . '</div>';
                                    }

                                    echo form_open_multipart('obat/edit_obat/' . $detailObat_id->id_obat); ?>
                                    <input type="hidden" value="<?= $detailObat_id->id_obat ?>" name="id_obat">

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Nama Obat <sup class="text-danger">*</sup></label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="nama_obat" placeholder="Masukkan Nama Obat" value="<?= $detailObat_id->nama_obat ?>">
                                            <?= form_error('nama_obat') ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Persediaan <sup class="text-danger">*</sup></label>
                                        <div class="col-sm-10">
                                            <select name="persediaan" class="form-control">
                                                <?php
                                                $persediaan = $detailObat_id->persediaan
                                                ?>
                                                <?php if ($persediaan == 'Y') { ?>
                                                    <option value="<?= $persediaan ?>" selected>Tersedia</option>
                                                    <option value=" ">Tidak Tersedia</option>
                                                <?php } else { ?>
                                                    <option value=" ">Tidak Tersedia</option>
                                                    <option value="<?= $persediaan ?>">Tersedia</option>
                                                <?php } ?>
                                            </select>

                                            <?= form_error('nama_obat') ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <!-- QUERY Kategori -->
                                        <?php
                                        $querySuplier = "SELECT * from `suplier`  order by `id_suplier` asc";

                                        $suplier = $this->db->query($querySuplier)->result_array();

                                        $id_sup = $detailObat_id->id_suplier;
                                        $namaSuplier = $detailObat_id->nama_sup;
                                        ?>
                                        <label class="col-sm-2 col-form-label">Suplier <sup class="text-danger">*</sup></label>
                                        <div class="col-sm-10">
                                            <select name="suplier" id="id_suplier" class="form-control" value="<?= $detailObat_id->suplier ?>">
                                                <?php if ($id_sup) { ?>
                                                    <option value="<?= $id_sup ?>" selected><?= $namaSuplier ?></option>
                                                <?php } ?>
                                                <?php foreach ($suplier as $s) :  ?>
                                                    <option value="<?= $s['id_suplier'] ?>"><?= $s['nama_sup']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <?= form_error('suplier') ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Harga Beli <sup class="text-danger">*</sup></label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" placeholder="Harga Pembelian" name="harga_beli" value="<?= $detailObat_id->harga_beli ?>">
                                            <?= form_error('harga_beli') ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Harga Default <sup class="text-danger">*</sup></label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" placeholder="Harga Jual Eceran" name="harga_default" value="<?= $detailObat_id->harga_default ?>">
                                            <?= form_error('harga_default') ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Stok <sup class="text-danger">*</sup></label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" placeholder="Jumlah Stok Obat" name="stok" value="<?= $detailObat_id->stok ?>">
                                            <?= form_error('stok') ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <!-- QUERY Kategori -->
                                        <?php
                                        $queryKategori = "SELECT * from `kategori`  order by `id_kategori` asc";

                                        $kategori = $this->db->query($queryKategori)->result_array();

                                        $id_katLama = $detailObat_id->id_kategori;
                                        $namaKatLama = $detailObat_id->nama_kategori;
                                        ?>
                                        <label class="col-sm-2 col-form-label">Kategori <sup class="text-danger">*</sup></label>
                                        <div class="col-sm-10">
                                            <select name="kategori" id="kategori" class="form-control">
                                                <?php if ($id_katLama) { ?>
                                                    <option value="<?= $id_katLama ?>" selected><?= $namaKatLama ?></option>
                                                <?php } ?>
                                                <?php foreach ($kategori as $k) :  ?>
                                                    <option value="<?= $k['id_kategori'] ?>"><?= $k['nama_kategori']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <?= form_error('kategori') ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Berat </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" placeholder="Berat Obat" name="berat" value="<?= $detailObat_id->berat ?>">
                                            <?= form_error('berat') ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <!-- QUERY Kategori -->
                                        <?php
                                        $queryJenis = "SELECT * from `jenis_obat`  order by `id_jenis` asc";

                                        $jenis = $this->db->query($queryJenis)->result_array();

                                        $id_jenisLama = $detailObat_id->id_jenis;
                                        $namaJenisLama = $detailObat_id->jenis;
                                        ?>
                                        <label class="col-sm-2 col-form-label">Jenis Obat <sup class="text-danger">*</sup></label>
                                        <div class="col-sm-10">
                                            <select name="jenis" id="jenis" class="form-control">
                                                <?php if ($id_jenisLama) { ?>
                                                    <option value="<?= $id_jenisLama ?>" selected><?= $namaJenisLama ?></option>
                                                <?php } ?>
                                                <?php foreach ($jenis as $j) :  ?>
                                                    <option value="<?= $j['id_jenis'] ?>"><?= $j['jenis']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <?= form_error('jenis') ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Gambar Obat</label>
                                        <img src="<?= base_url('assets/gambar_obat/') . $detailObat_id->gambar ?>" width="30%" height="50%" />
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Ubah Gambar Obat</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" id="image-source" onchange="previewImage();" name="gambar">
                                            <img id="image-preview" alt="image preview" />
                                            <?= form_error('gambar') ?>
                                        </div>
                                    </div>
                                    <script>
                                        function previewImage() {
                                            document.getElementById("image-preview").style.display = "block";
                                            var oFReader = new FileReader();
                                            oFReader.readAsDataURL(document.getElementById("image-source").files[0]);

                                            oFReader.onload = function(oFREvent) {
                                                document.getElementById("image-preview").src = oFREvent.target.result;
                                            };
                                        };
                                    </script>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Tanggal Kadaluarsa <sup class="text-danger">*</sup></label>
                                        <div class="col-sm-10">
                                            <input type="date" class="form-control" name="tgl_expired" value="<?= $detailObat_id->tgl_expired ?>">
                                            <?= form_error('tgl_expired', '<small class="text-danger">', '</small>') ?>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Deskripsi Obat <sup class="text-danger">*</sup></label>
                                        <div class="col-sm-10">
                                            <textarea rows="5" cols="5" class="form-control" name="deskripsi"><?= $detailObat_id->deskripsi ?></textarea>
                                        </div>
                                        <?= form_error('deskripsi') ?>
                                    </div>
                                    <div class="btn-text-right">
                                        <button type="submit" class="btn btn-primary ">Simpan</button>
                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                    </div>
                                    <?= form_close() ?>
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
    <script>
        CKEDITOR.replace('deskripsi');
    </script>