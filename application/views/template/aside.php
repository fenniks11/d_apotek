<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <nav class="pcoded-navbar">
            <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
            <div class="pcoded-inner-navbar main-menu">
                <form action="<?= base_url('cari') ?>" method="POST">
                    <div class="pcoded-search">
                        <span class="searchbar-toggle"> </span>
                        <div class="pcoded-search-box" id="prefetch">
                            <input type="text" placeholder="Search" name="keyword" autocomplete="on" autofocus>
                            <button type="submit" name="submit" class="search-icon"><i class="ti-search" aria-hidden="true"></i></button>
                        </div>
                    </div>
                </form>
                <!-- Tampilkan text 'Hallo, selamat datang..!' -->
                <?php if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {
                    //jika user tidak kosong, maka beri button logout
                ?>
                    <div class="pcoded-navigatio-lavel" data-i18n="nav.category.navigation"><?= $user['nama_role']; ?> - <?= $user['nama']; ?></div>

                    <ul class="pcoded-item pcoded-left-item">
                        <!-- QUERY MENU -->
                        <?php
                        $role_id = $this->session->userdata('role_id');
                        $queryMenu = "SELECT * from `user_menu` join `user_access_menu` 
                                    on `user_menu`.`id` = `user_access_menu`.`menu_id` 
                                    where `user_access_menu`.`role_id` = $role_id order by `user_access_menu`.`menu_id` asc
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
                                $menu_id = $m['id'];
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

                    <?php } else { ?>
                        <!-- Jika user belum daftar atau belum login maka, beri button login dan register -->
                        <p class="card-body text-primary">Hallo, Selamat datang!
                            <a class="text-secondary" href="<?= base_url('auth/login') ?>">Klik untuk belanja..
                                <i class="ti-hand-point-up"></i>
                            </a>
                        </p>
                    </ul>
                <?php } ?>
            </div>
        </nav>