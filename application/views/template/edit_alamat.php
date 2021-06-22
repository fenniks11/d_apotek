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
                                     <div class="row">
                                         <div class="col-sm-12">
                                             <div class="card">
                                                 <div class="card-header">
                                                     <h5>Form Edit Alamat</h5>
                                                     <div class="card-header-right"><i class="icofont icofont-spinner-alt-5"></i></div>
                                                     <div class="card-header-right">
                                                         <i class="icofont icofont-spinner-alt-5"></i>
                                                     </div>

                                                 </div>
                                                 <div class="card-block">
                                                     <form action="<?= base_url('profil/edit_alamat/' . $user['user_id']) ?>" method="POST">
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
                                                         <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                     </form>
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