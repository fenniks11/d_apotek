<section class="login p-fixed d-flex text-center bg-light">
    <!-- Container-fluid starts -->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <!-- Authentication card start -->
                <div class="login-card card-block auth-body mr-auto ml-auto">
                    <form class="md-float-material" method="post" action="<?= base_url('auth/login') ?>">
                        <div class="text-center">
                            <img src="<?= base_url() ?>assets/images/logoimg.png">
                        </div>
                        <div class="auth-box">
                            <div class="row m-b-20">
                                <div class="col-md-12">
                                    <h3 class="text-center txt-primary">Halaman Login</h3>
                                </div>
                            </div>
                            <?= $this->session->flashdata('message'); ?>
                            <hr />
                            <div class="input-group">
                                <span class="input-group-addon" id="name"><i class="fas fa-at"></i></span>
                                <input type="text" class="form-control" placeholder="Your Email Address" title="Masukkan email anda" data-toggle="tooltip" name="email" value="<?= set_value('email') ?>" autofocus>
                                <span class="md-line"></span>
                            </div>
                            <?= form_error('email', '<small class="text-danger">', '</small>') ?>
                            <div class="input-group">
                                <span class="input-group-addon" id="password"><i class="fas fa-key"></i></span>
                                <input type="password" class="form-control" title="Masukkan password anda" data-toggle="tooltip" placeholder="Password" id="password" name="password">
                                <span class="md-line"></span>
                            </div>
                            <?= form_error('password', '<small class="text-danger">', '</small>') ?>
                            <div class="row m-t-30">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Sign in</button>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="col-lg">
                                    <p class="text-inverse text-center m-b-0">Belum memiliki akun?</p>
                                    <p class="text-inverse text-center"><b> <a href="<?= base_url('auth/register') ?>">Silahkan daftar di sini</a></b></p>
                                </div>
                            </div>

                        </div>
                    </form>
                    <!-- end of form -->
                </div>
                <!-- Authentication card end -->
            </div>
            <!-- end of col-sm-12 -->
        </div>
        <!-- end of row -->
    </div>
    <!-- end of container-fluid -->
</section>