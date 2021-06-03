<nav class="navbar header-navbar pcoded-header">
    <div class="navbar-wrapper">

        <div class="navbar-logo">
            <a class="mobile-menu" id="mobile-collapse" href="#!">
                <i class="ti-menu"></i>
            </a>
            <a class="mobile-search morphsearch-search" href="#">
                <i class="ti-search"></i>
            </a>
            <a href="<?= base_url('dashboard') ?>">
                <img class="img-fluid" src="<?= base_url() ?>assets/images/logoimg.png">
            </a>
            <a class="mobile-options">
                <i class="ti-more"></i>
            </a>
        </div>

        <div class="navbar-container container-fluid">
            <ul class="nav-left">
                <li>
                    <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                </li>

                <li>
                    <a href="#!" onclick="javascript:toggleFullScreen()">
                        <i class="ti-fullscreen"></i>
                    </a>
                </li>

            </ul>
            <ul class="nav-right">
                <li class="header-notification">
                    <a href="#!">
                        <i class="ti-bell"></i>
                        <span class="badge bg-c-pink"></span>
                    </a>
                    <ul class="show-notification">
                        <li>
                            <h6>Notifications</h6>
                            <label class="label label-danger"><?php $nulltol = $exp + $nullstock;
                                                                if ($nulltol > 0) echo $nulltol ?></label>
                        </li>
                        <?php if ($exp > 0) : ?>
                            <li>
                                <a href="<?= base_url('obat/tambah') ?>">
                                    <div class="media">
                                        <div class="media-body">
                                            <h5 class="notification-user"><?= $user['nama']; ?></h5>
                                            <p class="notification-msg">Obat Sudah Kadaluarsa, harap menambahkan obat baru.</p>
                                            <span class="notification-time"><?php echo $exp ?> Obat</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if ($nullstock > 0) : ?>
                            <li>
                                <a href="<?= base_url('obat/tambah') ?>">
                                    <div class="media">
                                        <div class="media-body">
                                            <h5 class="notification-user"><?= $user['nama']; ?></h5>
                                            <p class="notification-msg">Obat Sudah Habis, harap menambahkan obat baru.</p>
                                            <span class="notification-time"><?php echo $nullstock ?> Obat</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <li class="user-profile header-notification">
                    <!-- Aktifasi button -->
                    <?php if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {
                        //jika user tidak kosong, maka beri button logout
                    ?>
                        <a href="#!">
                            <img src="<?= base_url('assets/images/profile/') . $user['gambar']; ?>" class="img-radius" alt="User-Profile-Image">
                            <span><?= $user['nama']; ?></span>
                            <i class="ti-angle-down"></i>
                        </a>
                        <ul class="show-notification profile-notification">
                            <li>
                                <a href="#!">
                                    <i class="ti-settings"></i> Settings
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="ti-user"></i> Profile
                                </a>
                            </li>
                            <li>
                                <a href="<?= base_url('auth/logout') ?>">
                                    <i class="ti-layout-sidebar-left"></i> Logout
                                </a>
                            </li>
                        <?php } else { ?>
                            <!-- Jika user belum daftar atau belum login maka, beri button login dan register -->
                            <button class=" btn btn-primary btn-round">
                                <a href="<?= base_url('auth/login') ?>">
                                    <i class="fa fa-sign-in-alt"></i> Login
                                </a>

                            </button>

                            <button class="btn btn-secondary btn-round">
                                <a href="<?= base_url('auth/register') ?>">
                                    <i class="fa fa-user-plus"></i>Register
                                </a>
                            </button>
                        <?php } ?>
                        </ul>
                </li>
            </ul>

        </div>
    </div>
</nav>