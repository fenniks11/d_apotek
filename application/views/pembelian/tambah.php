<!-- CKEDITOR -->
<script src="<?= base_url() ?>ckeditor/ckeditor.js"></script>
<script src="<?= base_url() ?>ckeditor/js/sample.js"></script>
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
                                    <span>Formulir Pembelian Obat</span>
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
                                    <li class="breadcrumb-item"><a href="<?= base_url('pembelian/daftar') ?>">Daftar Pembelian Obat</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="<?= base_url('pembelian/tambah') ?>"><?= $judul; ?></a>
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
                                    <h3 class="text-center">Formulir Penambahan Obat-Obatan D'Apotek</h3>
                                    <span class="text-center text-muted">Admin wajib mengisi semua form <sup class="text-danger">*</sup></span>
                                </div>
                                <div class="card-block">
                                    <h4 class="sub-title"></h4>
                                    <form action="<?= base_url('pembelian/add_purchase') ?>" method="POST">

                                        <input type="hidden" name="user_id" id="" value="<?= $user['user_id']; ?>" readonly>
                                        <div class="form-group row">
                                            <!-- QUERY Kategori -->
                                            <label class="col-sm-2 col-form-label">Nama Suplier <sup class="text-danger">*</sup></label>
                                            <div class="col-sm-10">
                                                <?php
                                                $style_suplier = 'class="form-control" id="id_suplier"  onChange="tampilObat()"';
                                                echo form_dropdown('id_suplier', $get_sup, '', $style_suplier);
                                                ?>
                                                <?= form_error('id_sup') ?>
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

                                                <?= form_error('tgl_beli') ?>
                                            </div>
                                        </div>

                                        <!-- Hover table card start -->
                                        <div class="card" id="frame_table_obat" hidden>
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
                                                                    <?php
                                                                    $style_obat = 'class="form-control input-sm id_obat" onclick="tampilStok(this)"';
                                                                    echo form_dropdown("id_obat[]", array('Pilih Obat' => '- Pilih Obat -'), '', $style_obat);
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="stok[]" class="form-control input-sm in_stok_obat" value="0" readonly />
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="jenis_obat[]" class="form-control input-sm in_jenis_obat" readonly />
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="harga_beli[]" class="form-control input-sm in_harga_obat" readonly />
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

    <script type="text/javascript">
        ambilData();

        function ambilData() {
            $.ajax({
                type: 'POST',
                url: '<?= base_url() . "pembelian/ambilData" ?>',
                dataType: 'json',
                success: function(data) {
                    var baris = '';
                    // for (var i = 0; i < data.length; i++) {
                    //     baris += '<tr>' +
                    //         '<td> </td>' +
                    // }
                }

            });
        }
    </script>

    <script src="<?= base_url() ?>assets/js/jquery/jquery-2.1.1.js"></script>
    <script>
        var rn = 1,
            current_max_row = 1; // index row id

        function m_format(n) {
            return n;
            // return parseInt(n).toLocaleString('en')
        };

        function n_format(n) {
            // return parseInt(`${n}`.replace(/[, ]+/g, ""))
            return `${n}`.replace(/[, ]+/g, "");
        };

        function tampilObat() {
            id_suplier = document.getElementById("id_suplier").value;
            if (id_suplier != '-') {
                $.ajax({
                    url: "<?php echo  base_url(); ?>pembelian/pilih_obat/" + id_suplier + "",
                    success: function(response) {
                        deleteAllRow('dataTable');
                        current_max_row = $($.parseHTML(response)[0]).children().length
                        $(`.id_obat`).html(response);
                        tampilStok();
                        $("#frame_table_obat").attr("hidden", false);
                    },
                    dataType: "html"
                });
                return false;
            } else { // if Nama Supplier == - Pilih Supplier -
                deleteAllRow('dataTable');
                $("#frame_table_obat").attr("hidden", true);
            }
        }

        function tampilStok(el, id) {
            var grandparent_id = el ? el.parentNode.parentNode.id : "row_obat_1";
            id_obat = $(`#${!id ? grandparent_id : id} .id_obat`).val();
            $.ajax({
                url: "<?php echo  base_url(); ?>pembelian/get_stok/" + id_obat + "",
                success: function(response) {
                    var resp = JSON.parse(response),
                        detail;
                    for (const key in resp) detail = resp[key];
                    $(`#${!id ? grandparent_id : id} .in_stok_obat`).val(detail[1])
                    $(`#${!id ? grandparent_id : id} .in_jenis_obat`).val(detail[2])
                    $(`#${!id ? grandparent_id : id} .in_harga_obat`).val(m_format(detail[0]))
                    hitungHarga(el ? el : null, id ? id : null);
                },
                dataType: "html"
            });
            return false;
        }

        function valid_q(el) {
            var grandparent_id = el ? el.parentNode.parentNode.id : "row_obat_1";
            var max = parseInt($(`#${ grandparent_id } .in_stok_obat`).val());
            var crn = $(`#${ grandparent_id } .in_banyak_beli`).val()
            if (crn > max) $(`#${ grandparent_id } .in_banyak_beli`).val(max);
            else if (crn < 1) $(`#${ grandparent_id } .in_banyak_beli`).val(1);
        }

        function hitungHarga(el, id) {
            var grandparent_id = el ? el.parentNode.parentNode.id : "row_obat_1";
            var subtotal = (parseInt($(`#${!id ? grandparent_id : id} .in_harga_obat`).val())) * parseInt($(`#${!id ? grandparent_id : id} .in_banyak_beli`).val());
            $(`#${!id ? grandparent_id : id} .in_sub_total`).val(m_format(subtotal))
            hitungGtot();
        }

        function hitungGtot() {
            var gtotal = 0;
            $(".in_sub_total").each(function() {
                gtotal += parseInt(n_format($(this).val()))
            })
            if (!isNaN(gtotal)) $(".grandtotal").val(m_format(gtotal))
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
                tampilStok(null, row.id)
            } else {
                alert(`Supplier hanya memiliki ${current_max_row} item saja.`);
            }
        }

        function _deleteRow(tableID, el) {
            var grandparent_id = el.parentNode.parentNode.id;
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;
            if (rowCount <= 1) alert("Tidak dapat menghapus row pembelian terakhir.");
            else $(`#${grandparent_id}`).remove()
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