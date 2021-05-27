<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <nav class="pcoded-navbar">
            <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
            <div class="pcoded-inner-navbar main-menu">
                <div class="pcoded-search">
                    <span class="searchbar-toggle"> </span>
                    <div class="pcoded-search-box ">
                        <!-- <div id="prefetch"> -->
                        <input type="text" placeholder="Search" class="form-control custom-search" name="category_search_name" id="category_search_name">
                        <span class="search-icon"><i class="ti-search" aria-hidden="true"></i></span>
                        <!-- </div> -->
                    </div>
                </div>
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
                                // $querySubMenu = "SELECT * FROM `user_sub_menu`.`menu_id` = `user_menu`.`id`
                                //                     ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
                                //                     WHERE `user_sub_menu`.`menu_id` = $menu_id
                                //                     and `user_sub_menu`.`is_active` = 1 ";
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
                    <!-- Jika user belum daftar atau belum login maka, beri button login dan register -->
                    <p class="card-body text-primary">Hallo, Selamat datang!
                        <a class="text-secondary" href="<?= base_url('auth/login') ?>">Klik untuk melanjutkan..
                            <i class="ti-hand-point-up"></i>
                        </a>
                    </p>

                <?php } ?>
            </div>
        </nav>

        <!-- <script type="text/javascript">
            $(document).ready(function() {
                var sample_data = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    prefetch: '<?php echo base_url(); ?>cari/fetch',
                    remote: {
                        url: '<?php echo base_url(); ?>cari/fetch/%QUERY',
                        wildcard: '%QUERY'
                    }
                });


                $('#prefetch .typeahead').typeahead(null, {
                    name: 'sample_data',
                    display: 'name_obat',
                    source: sample_data,
                    limit: 10,
                    templates: {
                        suggestion: Handlebars.compile('<div class="row"><div class="col-md-2" style="padding-right:5px; padding-left:5px;"><img src="student_image/{{image}}" class="img-thumbnail" width="48" /></div><div class="col-md-10" style="padding-right:5px; padding-left:5px;">{{name}}</div></div>')
                    }
                });
            });
        </script> -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
            function addText(Textval) {
                $('#category_search_name').val(Textval);
                $('#more_result').empty();
            }

            $(document).ready(function() {
                // this focus event while you are focusing on an input element.If you enter some text on this input ,its will be passing data in the category-search-name URL.
                $('#category_search_name').on('keyup', function() {
                    // Get value from the search box
                    var search_text = $('#category_search_name').val();
                    // check value is exist or not
                    if (search_text == "") {
                        $('#more_result').empty();
                    } else {
                        $.ajax({
                            type: "POST", // data pass by POST method.
                            url: "category-search-name", // This is the URL link where you sent the data.
                            data: {
                                search_name: search_text
                            }, // search_text value store in the search_name variable and pass variable data by POST method.
                            success: function(html) {
                                console.log(html); // you can check result in the browser console.
                                $("#more_result").html(html).show(); // when data get display a list "more_result" is the "UL" tag id name.
                            }
                        });
                    }
                });
            });
        </script>