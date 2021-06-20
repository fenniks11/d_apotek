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
                                    <h5>Pengelolaan Sub Menu</h5>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="icofont icofont-simple-left "></i></li>
                                            <li><i class="icofont icofont-maximize full-card"></i></li>
                                            <li><i class="icofont icofont-minus minimize-card"></i></li>
                                            <li><i class="icofont icofont-refresh reload-card"></i></li>
                                            <li><i class="icofont icofont-error close-card"></i></li>
                                        </ul>
                                    </div>
                                    <div class="btn-text-right mr-3">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                            <i class="fa fa-plus"> Tambah Sub Menu</i>
                                        </button>
                                    </div>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Form Tambah Menu Baru</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?= base_url('menu/tambah_subMenu') ?>" method="POST">
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Pilih menu</label>
                                                        <div class="col-sm-10">
                                                            <select name="select" class="form-control form-control-round" name="menu_id">
                                                                <option value=" ">Pilih Salah Satu</option>
                                                                <?php foreach ($menu as $m) { ?>
                                                                    <option value="<?= $m['id'] ?>"><?= $m['menu']; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Judul Sub Menu</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control form-control-round" name="judul" placeholder="Masukkan judul sub menu">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Url Sub Menu</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control form-control-round" name="url" placeholder="Masukkan url">
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
                                        <table class="table text-center">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Judul Sub Menu</th>
                                                    <th>Judul Menu</th>
                                                    <th>Url</th>
                                                    <th>Nama Role</th>
                                                    <th colspan="2" class="text-center">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($sub_menu as $sm) { ?>
                                                    <tr>
                                                        <th scope="row"><?= ++$start; ?></th>
                                                        <td><?= $sm['judul'] ?></td>
                                                        <td><?= $sm['menu'] ?></td>
                                                        <td><?= $sm['url'] ?></td>
                                                        <td><?= $sm['nama_role'] ?></td>
                                                        <td class="text-center">
                                                            <button type="button" class="btn btn-outline-warning waves-effect" data-toggle="tooltip" data-placement="top" title="Edit Sub Menu"><a href="<?= base_url('menu/edit_menu/'  . $sm['menu_id']) ?>"><i class="fas fa-pencil-alt"> Edit Sub Menu</i></a>
                                                            </button>
                                                        </td>
                                                        <td class="text-center">
                                                            <button type="button" class="btn btn-danger btn-lg waves-effect" data-toggle="tooltip" data-placement="top" title="Hapus Sub Menu"><a href="<?= base_url('menu/hapus_menu/'  . $sm['menu_id']) ?>  " onclick="return confirm('Apakah anda yakin menu ini dihapus?')"><i class=" fas fa-fw fa-trash"></i></a>
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