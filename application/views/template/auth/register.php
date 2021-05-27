<!-- general form elements disabled -->

<div class="container-fluid">
    <div class="container">
        <div class="text-center">
            <img src="<?= base_url() ?>assets/images/logoimg.png">
        </div>
        <div class="row">

            <div class="card card-primary mx-auto mt-5" style="width: 50rem;">
                <div class="card-header">
                    <h2 class=" text-center">Halaman Register</h2>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form method="POST" action="<?= base_url('auth/register') ?>">
                        <div class="row">
                            <div class="col-sm">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" class="form-control" placeholder="Masukkan ..." name="nama" value="<?= set_value('nama') ?>">
                                    <?= form_error('nama', '<small class="text-danger">', '</small>') ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" placeholder="Masukkan ..." name="email">
                                    <?= form_error('email', '<small class="text-danger">', '</small>') ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Nomor Telepon</label>
                                    <input type="tel" class="form-control" pattern="(\+62 ((\d{3}([ -]\d{3,})([- ]\d{4,})?)|(\d+)))|(\(\d+\) \d+)|\d{3}( \d+)+|(\d+[ -]\d+)|\d+" placeholder="Masukkan ..." name="telp">
                                    <?= form_error('telp', '<small class="text-danger">', '</small>') ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jk" class="control-label col-sm-3">Provinsi</label>
                            <div class="col-lg">
                                <?php
                                $style_provinsi = 'class="form-control" id="provinsi_id"  onChange="tampilKabupaten()" name = "provinsi"';
                                echo form_dropdown('provinsi_id', $provinsi, '', $style_provinsi);
                                ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="jk" class="control-label col-sm-3">Kabupaten</label>
                            <div class="col-lg">
                                <?php
                                $style_kabupaten = 'class="form-control input-sm" id="kabupaten_id" onChange="tampilKecamatan()" name="kabkot"';
                                echo form_dropdown("kabupaten_id", array('Pilih Kabupaten' => '- Pilih Kabupaten -'), '', $style_kabupaten);
                                ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="jk" class="control-label col-sm-3">Kecamatan</label>
                            <div class="col-lg">
                                <?php
                                $style_kecamatan = 'class="form-control input-sm" id="kecamatan_id" onChange="tampilKelurahan()" name = "kecamatan"';
                                echo form_dropdown("kecamatan_id", array('Pilih Kecamatan' => '- Pilih Kecamatan -'), '', $style_kecamatan);
                                ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="kelurahan" class="control-label col-sm-3">Kelurahan</label>
                            <div class="col-lg">
                                <?php
                                $style_kelurahan = 'class="form-control input-sm" id="kelurahan_id" name="kelurahan"';
                                echo form_dropdown("kelurahan_id", array('Pilih Kelurahan' => '- Pilih Kelurahan -'), '', $style_kelurahan);
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="alamat" class="control-label col-sm-3">Alamat </label>
                            <div class="col-lg">
                                <?php
                                $setting_alamat_lengkap = array('type' => 'text', 'name' => 'alamat', 'class' => 'form-control input-lg', 'placeholder' => 'RT RW Jalan Kampung dll');
                                echo form_input($setting_alamat_lengkap);
                                ?>
                            </div>
                            <div class="col-sm-1">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" id="password1" name="password1" class="form-control" placeholder="Masukkan ..." name="email">
                                    <?= form_error('password1', '<small class="text-danger">', '</small>') ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Ketik Ulang Password</label>
                                    <input type="password" id="password2" name="password2" class="form-control" placeholder="Masukkan ..." name="email">
                                    <?= form_error('password1', '<small class="text-danger">', '</small>') ?>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success btn-user btn-block">Simpan
                        </button>
                        <hr>
                    </form>
                    <div class="text-center">
                        <a class="small" href="<?= base_url('auth/login') ?>">
                            <h5> Sudah punya akun? Silakan Login!</h5>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
</div>

<script src="<?= base_url() ?>assets/js/jquery/jquery-2.1.1.js"></script>
<script>
    function tampilKabupaten() {
        kdprop = document.getElementById("provinsi_id").value;
        $.ajax({
            url: "<?php echo base_url(); ?>auth/pilih_kabupaten/" + kdprop + "",
            success: function(response) {
                $("#kabupaten_id").html(response);
            },
            dataType: "html"
        });
        return false;
    }

    function tampilKecamatan() {
        kdkab = document.getElementById("kabupaten_id").value;
        $.ajax({
            url: "<?php echo  base_url(); ?>auth/pilih_kecamatan/" + kdkab + "",
            success: function(response) {
                $("#kecamatan_id").html(response);
            },
            dataType: "html"
        });
        return false;
    }

    function tampilKelurahan() {
        kdkec = document.getElementById("kecamatan_id").value;
        $.ajax({
            url: "<?php echo  base_url(); ?>auth/pilih_kelurahan/" + kdkec + "",
            success: function(response) {
                $("#kelurahan_id").html(response);
            },
            dataType: "html"
        });
        return false;
    }
</script>