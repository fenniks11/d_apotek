 <!-- Pre-loader start -->
 <div class="theme-loader">
     <div class="ball-scale">
         <div class='contain'>
             <div class="ring">
                 <div class="frame"></div>
             </div>
             <div class="ring">
                 <div class="frame"></div>
             </div>
             <div class="ring">
                 <div class="frame"></div>
             </div>
             <div class="ring">
                 <div class="frame"></div>
             </div>
             <div class="ring">
                 <div class="frame"></div>
             </div>
             <div class="ring">
                 <div class="frame"></div>
             </div>
             <div class="ring">
                 <div class="frame"></div>
             </div>
             <div class="ring">
                 <div class="frame"></div>
             </div>
             <div class="ring">
                 <div class="frame"></div>
             </div>
             <div class="ring">
                 <div class="frame"></div>
             </div>
         </div>
     </div>
 </div>
 <!-- Pre-loader end -->
 <div id="pcoded" class="pcoded">
     <div class="pcoded-overlay-box"></div>
     <div class="pcoded-container navbar-wrapper">

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
                         <img class="img-fluid" src="<?= base_url() ?>assets/images/logoimg.png" alt="Theme-Logo" />
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
                         <li class="user-profile header-notification">
                             <img class="img-40 img-radius" src="<?= base_url('assets/images/profile/') . $user['gambar']; ?>" alt="User-Profile-Image">
                             <span><?= $user['nama']; ?></span>
                             <i class="ti-angle-down"></i>
                             <ul class="show-notification profile-notification">
                                 <li>
                                     <a href="<?= base_url('profil/edit') ?>">
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
                             </ul>
                         </li>
                     </ul>

                 </div>
             </div>
         </nav>

         <div class="pcoded-main-container">
             <div class="pcoded-wrapper">
                 <nav class="pcoded-navbar">
                     <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                     <div class="pcoded-inner-navbar main-menu">
                         <div class="">
                             <div class="main-menu-header">
                                 <img class="img-40 img-radius" src="<?= base_url('assets/images/profile/') . $user['gambar']; ?>" alt="User-Profile-Image">
                                 <div class="user-details">
                                     <span><?= $user['nama']; ?></span>
                                     <span id="more-details"><?= $user['nama_role']; ?><i class="ti-angle-down"></i></span>
                                 </div>
                             </div>

                             <div class="main-menu-content">
                                 <ul>
                                     <li class="more-details">
                                         <a href="<?= base_url('profil') ?>"><i class="ti-user"></i>Lihat Profil Profile</a>
                                         <a href="<?= base_url('profil/edit') ?>"><i class="ti-settings"></i>Settings</a>
                                         <a href="<?= base_url('auth/logout') ?>"><i class="ti-layout-sidebar-left"></i>Logout</a>
                                     </li>
                                 </ul>
                             </div>
                         </div>
                         <?php
                            $role_id = $this->session->userdata('role_id');
                            $queryMenu = "SELECT * from `user_menu` join `user_access_menu` 
                                    on `user_menu`.`id` = `user_access_menu`.`menu_id` 
                                    where `user_access_menu`.`role_id` = $role_id and `is_active` = 1 order by `user_access_menu`.`menu_id` asc
                                   ";

                            $menu = $this->db->query($queryMenu)->result_array();
                            ?>
                         <ul class="pcoded-item pcoded-left-item">
                             <?php foreach ($menu as $m) :  ?>
                                 <li class="pcoded-hasmenu">
                                     <a href="javascript:void(0)">
                                         <span class="pcoded-micon"><i class="<?= $m['icon']; ?>"></i></span>
                                         <span class="pcoded-mtext" data-i18n="nav.basic-components.main"><?= $m['menu']; ?></span>
                                         <span class="pcoded-mcaret"></span>
                                     </a>
                                     <?php
                                        $menu_id = $m['menu_id'];
                                        $querySubMenu = "select * from `user_sub_menu` where `menu_id` = $menu_id and `is_active` = 1";
                                        $submenu = $this->db->query($querySubMenu)->result_array();
                                        ?>
                                     <?php foreach ($submenu as $sm) : ?>
                                         <ul class="pcoded-submenu">
                                             <li class=" ">
                                                 <a href="<?= base_url($sm['url']) ?>">
                                                     <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                     <span class="pcoded-mtext" data-i18n="nav.basic-components.alert"><?= $sm['judul']; ?></span>
                                                     <span class="pcoded-mcaret"></span>
                                                 </a>
                                             </li>

                                         </ul>
                                     <?php endforeach; ?>
                                 </li>
                             <?php endforeach ?>

                         </ul>
                     </div>
                 </nav>
                 <div class="pcoded-content">
                     <div class="pcoded-inner-content">

                         <div class="main-body">
                             <div class="page-wrapper">
                                 <!-- Page-header start -->
                                 <div class="page-header card">
                                     <div class="row align-items-end">
                                         <div class="col-lg-8">
                                             <div class="page-header-title">
                                                 <i class="icofont icofont icofont icofont-file-document bg-c-pink"></i>
                                                 <div class="d-inline">
                                                     <h4><?= $judul; ?></h4>
                                                     <span>Halaman yang berisi data diri pengguna.</span>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <!-- Page-header end -->

                                 <div class="page-body">
                                     <?= $this->session->flashdata('message'); ?>
                                     <div class="row">
                                         <div class="col-sm-12">
                                             <div class="card">
                                                 <div class="card-block">
                                                     <div class="row">
                                                         <div class="col-sm-2">
                                                             <img src="<?= base_url('assets/images/profile/') . $user['gambar']; ?>" alt="User-Profile-Image" width="100%">
                                                         </div>
                                                         <div class="col"></div>
                                                         <div class="col-sm-9">
                                                             <div class="btn-text-right mr-3">
                                                                 <button type="button" class="btn btn-outline-warning waves-effect" data-toggle="tooltip" data-placement="top" title="Edit Profil <?= $user['nama']; ?> ?">
                                                                     <a href="<?= base_url('profil/edit/' . $user['user_id']) ?>">
                                                                         <i class="fa fa-pencil-alt"> Edit Profil</i>
                                                                     </a>
                                                                 </button>
                                                             </div>
                                                             <h4 class="card-title"><?= $user['nama']; ?></h4>
                                                             <span><?= $user['nama_role']; ?></span>
                                                             <div class="mb-3"></div>
                                                             <!-- Nav tabs -->
                                                             <ul class="nav nav-tabs md-tabs nav-justified " role="tablist">
                                                                 <li class="nav-item">
                                                                     <a class="nav-link active" data-toggle="tab" href="#home7" role="tab"><i class="icofont icofont-home"></i>Tentang <?= $user['nama']; ?></a>
                                                                     <div class="slide"></div>
                                                                 </li>
                                                                 <li class="nav-item">
                                                                     <a class="nav-link" data-toggle="tab" href="#profile7" role="tab"><i class="icofont icofont-ui-user "></i>Timeline <?= $user['nama']; ?></a>
                                                                     <div class="slide"></div>
                                                                 </li>
                                                             </ul>
                                                             <!-- Tab panes -->
                                                             <div class="tab-content card-block">
                                                                 <div class="tab-pane active" id="home7" role="tabpanel">
                                                                     <div class="row">
                                                                         <div class="col-sm-3">
                                                                             <th class="card-text"><b>Nama</b></th><br>
                                                                             <th class="m-0"><b>Email</b></th><br>
                                                                             <th class="m-0"><b>Nomor Telepon</b></th><br>
                                                                         </div>
                                                                         <div class="col-sm-2"></div>
                                                                         <div class="col-sm-7">
                                                                             <td class="m-0"><?= $user['nama']; ?></td><br>
                                                                             <td class="m-0"><?= $user['email']; ?></td><br>
                                                                             <td class="m-0"><?= $user['telp']; ?></td><br>
                                                                         </div>
                                                                     </div>

                                                                 </div>
                                                                 <div class="tab-pane" id="profile7" role="tabpanel">
                                                                     <div class="row">
                                                                         <div class="col-sm-3">
                                                                             <th class="card-text"><b>Nama Role</b></th><br>
                                                                             <th class="m-0"><b>Tanggal Bergabung</b></th><br>
                                                                         </div>
                                                                         <div class="col-sm-2"></div>
                                                                         <div class="col-sm-7">
                                                                             <td class="m-0"><?= $user['nama_role']; ?></td><br>
                                                                             <td class="m-0"><?= $user['created_at']; ?></td><br>
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                         </div>

                                                     </div>
                                                 </div>

                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="page-body">
                                     <div class="row">
                                         <div class="col-sm-12">
                                             <div class="card mb-3">
                                                 <div class="btn-text-right mr-3 mt-3">
                                                     <button type="button" class="btn btn-outline-warning waves-effect" data-toggle="tooltip" data-placement="top" title="Edit Alamat <?= $user['nama']; ?> ?">
                                                         <a href="<?= base_url('profil/edit_alamat/' . $user['user_id']) ?>">
                                                             <i class="fa fa-pencil-alt"> Edit Alamat</i>
                                                         </a>
                                                     </button>
                                                 </div>
                                                 <br><br>
                                                 <h5 class="ml-4"><strong>Alamat</strong> </h5>
                                                 <div class="card-block">
                                                     <div class="row">

                                                         <div class="col-sm-3">
                                                             <th class="card-text"><b>Provinsi</b></th><br>
                                                             <th class="m-0"><b>Kabupaten/Kota</b></th><br>
                                                             <th class="m-0"><b>Kecamatan</b></th><br>
                                                             <th class="m-0"><b>Kelurahan</b></th><br>
                                                             <th class="m-0"><b>Alamat Lengkap</b></th><br>
                                                         </div>
                                                         <div class="col-sm-2"></div>
                                                         <div class="col-sm-7">
                                                             <td class="m-0"><?= $user['nama_provinsi']; ?></td><br>
                                                             <td class="m-0"><?= $user['nama_kabupaten']; ?></td><br>
                                                             <td class="m-0"><?= $user['nama_kecamatan']; ?></td><br>
                                                             <td class="m-0"><?= $user['nama_kelurahan']; ?></td><br>
                                                             <td class="m-0"><?= $user['alamat']; ?></td><br>
                                                         </div>
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
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>