<div class="pcoded-content">
    <div class="pcoded-inner-content">

        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <?= $this->session->flashdata('message'); ?>
                <!-- Page-header start -->
                <div class="page-header card">
                    <div class="row align-items-end">
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <i class="ti-folder bg-c-orenge"></i>
                                <div class="d-inline">
                                    <h4><?= $judul; ?></h4>
                                    <span>Admin dapat melakukan manajemen menu-menu user pada halaman ini.</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="<?= base_url('admin') ?>">
                                            <i class="ti-home"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="<?= base_url('menu') ?>"><?= $judul; ?></a>
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
                            <!-- Direction arrow start -->
                            <div class="card">
                                <div class="card-header">
                                    <h5>Pengelolaan Menu</h5>
                                    <div class="btn-text-right mr-3">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                            <i class="fa fa-plus"> Tambah Menu</i>
                                        </button>
                                    </div>
                                    <br><br><br>
                                    <form action="<?= base_url('menu') ?>" method="POST">
                                        <div class="row">
                                            <div class="col-2"></div>
                                            <div class="col-8">
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name="keyword" placeholder="Cari Obat" aria-label="Username" aria-describedby="basic-addon1" autofocus autocomplete="on">
                                                    <div class="input-group-append">
                                                        <input class="btn btn-primary" type="submit" name="submit" id="basic-addon1">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2"></div>
                                        </div>
                                    </form>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="icofont icofont-simple-left "></i></li>
                                            <li><i class="icofont icofont-maximize full-card"></i></li>
                                            <li><i class="icofont icofont-minus minimize-card"></i></li>
                                            <li><i class="icofont icofont-refresh reload-card"></i></li>
                                            <li><i class="icofont icofont-error close-card"></i></li>
                                        </ul>
                                    </div>

                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Form Tambah Menu Baru</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?= base_url('menu/tambah') ?>" method="POST">
                                                    <div class="form-group row">
                                                        <div class="col-sm">
                                                            <input type="text" class="form-control form-control-round" name="menu" placeholder="Masukkan judul menu..">
                                                        </div>
                                                        <?= form_error('menu') ?>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm">
                                                            <input type="text" class="form-control form-control-round" name="icon" placeholder="Masukkan Icon">
                                                        </div>
                                                        <?= form_error('icon') ?>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Select Box</label>
                                                        <div class="col-sm-10">
                                                            <select name="role_id" class="form-control">
                                                                <option value="1">Admin</option>
                                                                <option value="2">Member</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary">Tambah</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-block table-border-style">
                                    <div class="table-responsive">
                                        <h5 class="title ml-4 text-muted"> Hasil: <?= $total_rows ?></h5>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Menu</th>
                                                    <th>User Akses</th>
                                                    <th colspan="2" class="text-center">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (empty($menu)) :
                                                ?>
                                                    <tr>
                                                        <td colspan="5">
                                                            <div class="alert alert-danger" role="alert">
                                                                Data dengan kata <b>"<?= $keyword; ?>"</b> Tidak Ditemukan!
                                                            </div>

                                                        </td>
                                                    </tr>
                                                <?php endif ?>
                                                <?php
                                                foreach ($menu as $m) { ?>
                                                    <tr>
                                                        <th scope="row"><?= ++$start ?></th>
                                                        <td><?= $m['menu'] ?></td>
                                                        <td><?= $m['nama_role'] ?></td>
                                                        <td class="text-center">
                                                            <button type="button" class="btn btn-warning waves-effect" data-toggle="tooltip" data-placement="top" title="Edit Menu"><a href="<?= base_url('menu/edit_menu/' . $m['id']) ?>"><i class="fas fa-pencil-alt"></i></a>
                                                            </button>
                                                        </td>

                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <?= $this->pagination->create_links(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>