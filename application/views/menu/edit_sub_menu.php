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
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Tooltips on textbox card start -->
                            <div class="card">
                                <div class="card-header">
                                    <h5>Form Edit Sub Menu</h5>
                                    <div class="card-header-right">
                                        <i class="icofont icofont-spinner-alt-5"></i>
                                    </div>
                                </div>
                                <form action="<?= base_url('menu/edit_submenu/'  . $sub_menu['id']) ?>" method="POST">
                                    <input type="hidden" name="id" value="<?= $sub_menu['id']; ?>" readonly>
                                    <div class="card-block tooltip-icon button-list">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Judul Sub Menu</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control form-control-round" name="judul" value="<?= $sub_menu['judul']; ?>">
                                            </div>
                                            <?= form_error('judul') ?>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">URL Sub Menu</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control form-control-round" name="url" value="<?= $sub_menu['url']; ?>">
                                            </div>
                                            <?= form_error('url') ?>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Aktif</label>
                                            <div class="col-sm-10">
                                                <select name="is_active" class="form-control">
                                                    <?php if ($sub_menu['is_active'] == 1) { ?>
                                                        <option value="<?= $sub_menu['is_active']; ?>" selected>Aktif</option>
                                                        <option value="0">Tidak Aktif</option>
                                                    <?php } else { ?>
                                                        <option value="<?= $sub_menu['is_active']; ?>" selected>Tidak Aktif</option>
                                                        <option value="1">Aktif</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <?= form_error('is_active') ?>
                                        </div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light m-r-20" data-toggle="tooltip" data-placement="right" title="submit">Submit
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>