<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <nav class="pcoded-navbar">
            <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
            <div class="pcoded-inner-navbar main-menu">

                <!-- Tampilkan text 'Hallo, selamat datang..!' -->
                <?php if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {
                    //jika user tidak kosong, maka beri button logout
                ?>
                    <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation"><?= $user['nama_role']; ?> - <?= $user['nama']; ?></div>
                    <?php if (isset($user) && $user['role_id'] == 2) { ?>
                        <ul class="pcoded-item pcoded-left-item">
                            <li class="pcoded-hasmenu mt-4">
                                <div class="dropdown-divider"></div>
                                <a href="javascript:void(0)">
                                    <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Kategori Obat</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                                <ul class="pcoded-submenu">

                                    <li class=" ">
                                        <a href="<?= base_url('dashboard/obat_bebas') ?>">
                                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                            <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Obat Bebas</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="<?= base_url('dashboard/obat_bebas_terbatas') ?>">
                                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Obat Bebas Terbatas</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="<?= base_url('dashboard/obat_keras') ?>">
                                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                            <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Obat Keras</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                        <?php } ?>

                        <!-- QUERY MENU -->
                        <?php
                        $role_id = $this->session->userdata('role_id');
                        $queryMenu = "SELECT * from `user_menu` join `user_access_menu` 
                                    on `user_menu`.`id` = `user_access_menu`.`menu_id` 
                                    where `user_access_menu`.`role_id` = $role_id and `is_active` = 1 order by `user_access_menu`.`menu_id` asc
                                   ";

                        $menu = $this->db->query($queryMenu)->result_array();
                        ?>

                        <!-- LOOPING MENU -->
                        <?php foreach ($menu as $m) :  ?>
                            <li class="pcoded-hasmenu">
                                <a href="javascript:void(0)">
                                    <span class="pcoded-micon"><i class="<?= $m['icon']; ?>"></i></span>
                                    <span class="pcoded-mtext"><?= $m['menu']; ?></span>
                                </a>
                                <?php
                                $menu_id = $m['menu_id'];
                                $querySubMenu = "select * from `user_sub_menu` where `menu_id` = $menu_id and `is_active` = 1";
                                $submenu = $this->db->query($querySubMenu)->result_array();
                                ?>
                                <?php foreach ($submenu as $sm) : ?>

                                    <ul class="pcoded-submenu">
                                        <li class=" ">
                                            <a href="<?= base_url($sm['url'])  ?>">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs"><?= $sm['judul']; ?></span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    </ul>

                                <?php endforeach ?>

                            </li>
                            <br>
                        <?php endforeach; ?>
                        </ul>
                    <?php } else { ?>
                        <p class="card-body text-primary">Hallo, Selamat datang!
                            <a class="text-secondary" href="<?= base_url('auth/login') ?>">Klik untuk melanjutkan..
                                <i class="ti-hand-point-up"></i>
                            </a>
                        </p>
                        <ul class="pcoded-item pcoded-left-item">
                            <li class="active">
                                <a href="<?= base_url('dashboard') ?>">
                                    <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Daftar Semua Obat</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li class="pcoded-hasmenu mt-4">
                                <div class="dropdown-divider"></div>
                                <a href="javascript:void(0)">
                                    <span class="pcoded-micon"><i class="ti-layout-grid2-alt"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.basic-components.main">Kategori Obat</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                                <ul class="pcoded-submenu">

                                    <li class=" ">
                                        <a href="<?= base_url('dashboard/obat_bebas') ?>">
                                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                            <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Obat Bebas</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="<?= base_url('dashboard/obat_bebas_terbatas') ?>">
                                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                            <span class="pcoded-mtext" data-i18n="nav.basic-components.alert">Obat Bebas Terbatas</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>
                                    <li class=" ">
                                        <a href="<?= base_url('dashboard/obat_keras') ?>">
                                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                            <span class="pcoded-mtext" data-i18n="nav.basic-components.breadcrumbs">Obat Keras</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                        </ul>
                    <?php } ?>


            </div>
        </nav>

        <script src="<?= base_url() ?>assets/js/jquery/jquery-2.1.1.js"></script>

        <?php if (isset($obat)) { ?>
            <script>
                console.log(<?= json_encode($obat) ?>);
                console.log($("#daftar_obat").html());
            </script>

        <?php } ?>