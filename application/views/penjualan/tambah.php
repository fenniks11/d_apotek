<!-- CKEDITOR -->
<!-- <script src="<?= base_url() ?>ckeditor/ckeditor.js"></script>
<script src="<?= base_url() ?>ckeditor/js/sample.js"></script> -->
<div class="pcoded-content">
    <div class="pcoded-inner-content">

        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-header card">
                    <div class="row align-items-end">
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <i class="icofont icofont-file-code bg-c-blue"></i>
                                <div class="d-inline">
                                    <h4><?= $judul; ?></h4>
                                    <span>Formulir Penjualan Obat</span>
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
                                    <li class="breadcrumb-item"><a href="<?= base_url('penjualan/daftar') ?>">Daftar Penjualan Obat</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="<?= base_url('penjualan/form_tambah') ?>"><?= $judul; ?></a>
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
                                    <h3 class="text-center">Formulir Penjualan Obat-Obatan D'Apotek</h3>
                                    <span class="text-center text-muted">Admin wajib mengisi semua form <sup class="text-danger">*</sup></span>
                                </div>
                                <div class="card-block">
                                    <h4 class="sub-title"></h4>
                                    <form action="<?= base_url('penjualan/add_invoice') ?>" method="POST">
                                        <div class="form-group row">
                                            <!-- QUERY Kategori -->
                                            <label class="col-sm-2 col-form-label">Email User <sup class="text-danger">*</sup></label>
                                            <div class="col-sm-10">
                                                <input type="hidden" name="user_id" id="" value="<?= $user['user_id']; ?>" readonly>
                                                <input type="text" class="form-control lg" id="cari-nama" placeholder="Ketik nama user" name="member_email">
                                                <?= form_error('member_email') ?>
                                            </div>
                                        </div>
                                        <?php
                                        $tz = 'Asia/Jakarta';
                                        $dt = new DateTime("now", new DateTimeZone($tz));
                                        $timestamp = $dt->format('Y-m-d G:i:s');
                                        ?>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Tanggal Transaksi<sup class="text-danger">*</sup></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" placeholder="Tanggal Transaksi" name="tgl_beli" value="<?= $timestamp ?>" readonly>
                                            </div>
                                        </div>

                                        <!-- Hover table card start -->
                                        <div class="card" id="frame_table_obat">
                                            <div class="card-block table-border-style">
                                                <div class="table-responsive">
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Obat yg Dibeli</th>
                                                                <th>Stok</th>
                                                                <th>Jenis Obat</th>
                                                                <th>Harga Obat</th>
                                                                <th>Banyak</th>
                                                                <th class="text-center">Subtotal</th>
                                                                <th>Aksi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="dataTable">
                                                            <tr id="row_obat_1" class="row_obat">
                                                                <td>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control lg in_nama_obat" placeholder="Ketik nama obat" name="nama_obat[]" oninput="tampilStok(this)">
                                                                        <input type="text" class="in_id_obat" hidden>
                                                                        <?= form_error('nama_obat') ?>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="stok[]" class="form-control input-sm in_stok_obat" value="0" readonly />
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="jenis_obat[]" class="form-control input-sm in_jenis_obat" readonly />
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="harga_jual[]" class="form-control input-sm in_harga_obat" readonly />
                                                                </td>
                                                                <td><input type="number" class="form-control in_banyak_beli" onchange="valid_q(this); hitungHarga(this);" value="1" min="1" name="banyak[]"></td>
                                                                <td class="text-center"><input type="text" name="subtotal[]" class="form-control in_sub_total" class="form-control" readonly /></td>
                                                                <td><button type="button" onClick="_deleteRow('dataTable', this)" class="btn btn-danger"><i class="fas fa-trash fa-fw"></i></button></td>
                                                            </tr>
                                                        </tbody>

                                                        <tfoot>
                                                            <tr>
                                                                <td style="text-align:right; vertical-align: middle" colspan="5" id="grandtotal"><b>Grandtotal</b></td>
                                                                <td>
                                                                    <input id="grandtotal" name="grandtotal" type="text" class="form-control grandtotal" readonly>
                                                                </td>
                                                                <td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-block text-center">
                                            <button type="button" onclick="_addRow('dataTable')" class="btn btn-primary waves-effect btn-round" data-toggle="tooltip" data-placement="top" title="Tambah Form">
                                                <i class="ti-plus"></i>
                                                </a>
                                            </button>
                                            <button class="btn btn-success btn-round" type="submit">Simpan</button>
                                            <button class="btn btn-danger btn-round" type="reset">Batal</button>
                                        </div>
                                    </form>
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

    <script src="<?= base_url() ?>assets/js/jquery/jquery-2.1.1.js"></script>

    <script>
        var rn = 1,
            current_max_row = 1,
            list_obat = [],
            list_detail = {}; // index row id

        Array.prototype.remove = function() {
            var what, a = arguments,
                L = a.length,
                ax;
            while (L && this.length) {
                what = a[--L];
                while ((ax = this.indexOf(what)) !== -1) {
                    this.splice(ax, 1);
                }
            }
            return this;
        };

        (async () => { // run once
            $.ajax({
                url: "<?= base_url() ?>penjualan/obat_search",
                success: function(resp) {
                    r = JSON.parse(resp);
                    for (const x in r) {
                        list_obat.push(x);
                        list_detail[x.toUpperCase()] = r[x];
                    }
                    current_max_row = list_obat.length;
                },
                dataType: "html"
            })
        })()

        $(() => {
            $("#cari-nama").autocomplete({
                source: '<?= base_url('penjualan/user_search') ?>',
            });
        })

        function id_change(el) {
            var ggp_id = this.parentNode.parentNode.parentNode.id,
                name = $(`#${ggp} .in_nama_obat`).val();
        }

        var reassign = () => $(function() {
            $(".in_nama_obat").autocomplete({
                source: list_obat,
            }).on("autocompleteselect", function(event, ui) {
                var ggp_id = this.parentNode.parentNode.parentNode.id,
                    name = ui.item.value,
                    id = list_detail[ui.item.value.toUpperCase()].id_obat;
                $(`#${ggp_id} .in_id_obat`).val(id)
                tampilStok(this, name);
            })
        })
        reassign()

        function tampilStok(el, name = null) {
            var ggp = el ? el.parentNode.parentNode.parentNode.id : "row_obat_1",
                nama_obat = name ? name : $(`#${ggp} .in_nama_obat`).val();
            nama_obat = nama_obat.toUpperCase();
            if (!!list_detail[nama_obat.toUpperCase()]) {
                $(`#${ggp} .in_stok_obat`).val(list_detail[nama_obat].stok)
                $(`#${ggp} .in_jenis_obat`).val(list_detail[nama_obat].jenis)
                $(`#${ggp} .in_harga_obat`).val(list_detail[nama_obat].harga_default)
            }
            return false;
        }

        function valid_q(el) {
            var ggp = el ? el.parentNode.parentNode.parentNode.id : "row_obat_1",
                max = parseInt($(`#${ ggp } .in_stok_obat`).val()),
                crn = $(`#${ ggp } .in_banyak_beli`).val();
            if (crn > max) $(`#${ ggp } .in_banyak_beli`).val(max);
            else if (crn < 1) $(`#${ ggp } .in_banyak_beli`).val(1);
        }

        function hitungHarga(el, id) {
            var ggp = el ? el.parentNode.parentNode.parentNode.id : "row_obat_1",
                subtotal = parseInt($(`#${!id ? ggp : id} .in_harga_obat`).val()) * parseInt($(`#${!id ? ggp : id} .in_banyak_beli`).val());
            $(`#${!id ? ggp : id} .in_sub_total`).val(subtotal)
            hitungGtot();
        }

        function hitungGtot() {
            var gtotal = 0;
            $(".in_sub_total").each(function() {
                gtotal += parseInt($(this).val())
            })
            if (!isNaN(gtotal)) $(".grandtotal").val(gtotal)
        }

        function tampiljenisObat() {
            id_jenis = document.getElementById("id_jenis").value;
            $.ajax({
                url: "<?php echo  base_url(); ?>pembelian/get_jenisObat/" + id_jenis + "",
                success: function(response) {
                    $("#kelurahan_id").html(response);
                },
                dataType: "html"
            });
            return false;
        }

        function _addRow(tableID) {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;
            if (rowCount < current_max_row) { // limit the user from creating fields more than your limits
                var row = table.insertRow(rowCount);
                row.id = `row_obat_${++rn}`;
                row.classList.add("row_obat")
                var colCount = table.rows[0].cells.length;
                for (var i = 0; i < colCount; i++) {
                    var newcell = row.insertCell(i);
                    newcell.innerHTML = table.rows[0].cells[i].innerHTML;
                }
                reassign()
            } else {
                alert(`Item maks. (${current_max_row}) telah tercapai ( Semua obat sudah masuk kedalam list row ).`);
            }
        }

        function _deleteRow(tableID, el) {
            var ggp = el.parentNode.parentNode.id;
            var table = document.getElementById(tableID);
            var s_nama = $(`#${ggp} .in_nama_obat`).val();
            var rowCount = table.rows.length;
            if (rowCount <= 1) alert("Tidak dapat menghapus row pembelian terakhir.");
            else $(`#${ggp}`).remove();
            hitungGtot();
        }

        function deleteAllRow(tableID /* 'dataTable' */ ) {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;
            if (rowCount > 1) {
                for (let i = rowCount - 1; i > 0; i--) {
                    if (rowCount > 1) table.deleteRow(i);
                    --rowCount;
                }
            }
        }
    </script>