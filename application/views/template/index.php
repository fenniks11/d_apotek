<!-- content -->


<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="card">
                    <img class="card-img" src="<?= base_url() ?>assets/images/apotek.jpg" alt="logo" width="100%" height="300" alt="Card image">
                    <div class="card-img-overlay text-center mt-5 mb-5">
                        <h1 class="card-title"><b>D'Apotek</b></h1>
                        <h5 class="text-muted text-center">Menjual Berbagai Jenis Obat dan Menerima Resep Dokter</h5>
                    </div>
                </div>
                <!-- Page-header start -->
                <div class="page-header card">
                    <div class="row text-center">
                        <div class="col-lg">
                            <div class="page-header-title">
                                <i class="icofont icofont icofont icofont-file-document bg-c-pink"></i>
                                <div class="d-inline text-center">
                                    <h3><?= $judul; ?></h3>
                                    <span>Daftar Semua Obat Tersedia di D'APOTEK</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Page-header end -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Simple Breadcrumb card start -->
                            <div class="card">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-lg-2"></div>
                                        <div class="col-lg-8">
                                            <div class="pcoded-search">
                                                <span class="searchbar-toggle"> </span>
                                                <div class="pcoded-search-box ">
                                                    <input type="text" onkeyup="live_search()" id="in_live_search" value="" placeholder="Cari obat..." autofocus>
                                                    <span class="search-icon"><i class="ti-search" aria-hidden="true"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- Badges card start -->
                            <div class="card">
                                <?php
                                if (empty($obat)) :
                                ?>
                                    <tr>
                                        <td colspan="5">
                                            <div class="alert alert-danger" role="alert">
                                                Data Tidak Ditemukan!
                                            </div>

                                        </td>
                                    </tr>
                                <?php endif ?>
                                <div class="card-block">
                                    <div id="daftar_obat" class="row">
                                        <!-- <?php
                                                foreach ($obat as $key) { ?>
                                            <div class="col-lg-4">
                                                <div class="badge-box">
                                                    <div class="text-right">
                                                        <?php echo anchor('dashboard/tambah_keranjang/' . $key['id_obat'], '<div class="btn btn-sm btn-primary waves-effect " data-toggle="tooltip" data-placement="top" title="Tambah ke keranjang"><i class="ti-shopping-cart"> Tambah</i></div>')  ?>
                                                    </div>
                                                    <a href="<?= base_url('dashboard/detail_obat/') . $key['id_obat'] ?>">
                                                        <div class="sub-title mt-3 text-center"><a href="<?= base_url('dashboard/detail_obat/') . $key['id_obat'] ?>">
                                                                <h5 class="text-dark"><b><?= $key['nama_obat'] ?></b></h5>
                                                        </div>
                                                        <a href="<?= base_url('assets/gambar_obat/' . $key['gambar']); ?>">
                                                            <img class="card-img" src="<?= base_url('assets/gambar_obat/' . $key['gambar']); ?>" style="width:100%; height: 200px">
                                                        </a>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <label class="badge badge-info col-lg">
                                                                    <span>Rp.<?= number_format($key['harga_default'], 0, ',', '.') ?>,-</span>
                                                                </label>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <label class="badge badge-info col-lg">
                                                                    <span>Stok: <?= $key['stok'] ?></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg">
                                                            <h5>
                                                                <span class="badge badge-warning col-lg">Exp: <?= date($key['tgl_expired']) ?></span>
                                                            </h5>
                                                        </div>

                                                    </a>

                                                </div>
                                            </div>
                                        <?php } ?> -->
                                    </div>
                                </div>
                                <?= $this->pagination->create_links(); ?>
                            </div>
                            <!-- Badges card end -->
                        </div>
                    </div>
                </div>
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card text-center">
                                <div class="card-block caption-breadcrumb  info-breadcrumb">
                                    <div class="breadcrumb-header">
                                        <h5>About Us</h5>
                                        <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <div class="text-center">
                                        <img class="img-fluid" src="<?= base_url() ?>assets/images/logoimg.png" width="75%" height="300px">
                                        <ul>
                                            <address>
                                                <br>
                                                <h3> Alamat: Jl. Bunga Asoka NO.49D, Medan, Sumatera Utara</h3>
                                                <h4>Medan 20133</h4>
                                                <h6>Menjual Berbagai Obat dan Menerima Resep Dokter</h6>
                                                <br>Telp: 0274 564707
                                            </address>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card text-center">
                                <div class="card-block caption-breadcrumb  warning-breadcrumb">
                                    <div class="breadcrumb-header">
                                        <h5>Contact Us</h5>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <a href="https://web.facebook.com/d'apotek">
                                                <div class="card fb-card">
                                                    <div class="card-header">
                                                        <i class="icofont icofont-social-facebook"></i>
                                                        <div class="d-inline-block">
                                                            <h5>facebook</h5>
                                                            <span>blog page timeline</span>
                                                        </div>
                                                    </div>
                                                    <div class="card-block text-center">
                                                        <div class="row">
                                                            Kunjungi laman kami.
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="card dribble-card">
                                                <div class="card-header">
                                                    <i class="fas fa-whatsapp-square"></i>
                                                    <div class="d-inline-block">
                                                        <h5>dribble</h5>
                                                        <span>Product page analysis</span>
                                                    </div>
                                                </div>
                                                <div class="card-block text-center">
                                                    <div class="row">
                                                        <div class="col-6 b-r-default">
                                                            <h2>23</h2>
                                                            <p class="text-muted">Live</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <h2>23</h2>
                                                            <p class="text-muted">Message</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="card twitter-card">
                                                <div class="card-header">
                                                    <i class="icofont icofont-social-twitter"></i>
                                                    <div class="d-inline-block">
                                                        <h5>twitter</h5>
                                                        <span>current new timeline</span>
                                                    </div>
                                                </div>
                                                <div class="card-block text-center">
                                                    <div class="row">
                                                        <div class="col-6 b-r-default">
                                                            <h2>25</h2>
                                                            <p class="text-muted">new tweet</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <h2>450+</h2>
                                                            <p class="text-muted">Follower</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <ul>
                                        <address>
                                            <br>
                                            <h3> Alamat: Jl. Bunga Asoka NO.49D, Medan, Sumatera Utara</h3>
                                            <h4>Medan 20133</h4>
                                            <h6>Menjual Berbagai Obat dan Menerima Resep Dokter</h6>
                                            <br>Telp: 0274 564707
                                        </address>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end content -->
        </div>
    </div>
</div>
</div>

<script src="<?= base_url() ?>assets/js/jquery/jquery-2.1.1.js"></script>
<script>
    var obat = <?= json_encode(($obat)) ?>, // array
        list = [],
        tambah_keranjang = `<?= base_url('dashboard/tambah_keranjang') ?> `,
        detail_obat = `<?= base_url('dashboard/detail_obat') ?>`,
        gambar_obat = `<?= base_url('assets/gambar_obat/') ?>`;

    console.log(`<?= base_url('dashboard/tambah_keranjang') ?> `);

    function to_m(x) {
        return x.toString().replace(/\B(?<!.\d*)(?=(\d{3})+(?!\d))/g, ",");
    }

    const template = (id, id_obat, nama, gambar, harga, stok, expired) => {
        return `
        <div id="obat_${id}" class="col-lg-4 obat-obat">
    <div class="badge-box">
        <div class="text-right">
            <a href="${tambah_keranjang}/${id_obat}">
                <div class="btn btn-sm btn-primary waves-effect " data-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Tambah ke keranjang"><i class="ti-shopping-cart"> Tambah</i></div>
            </a>
        </div>
        <a href="${detail_obat}/${id_obat}">
        </a>
        <div class="sub-title mt-3 text-center"><a href="${detail_obat}/${id_obat}"></a><a href="${detail_obat}/${id_obat}">
                <h5 class="text-dark"><b>${nama}</b></h5>
            </a></div><a href="${detail_obat}/${id_obat}">
        </a><a href="${gambar_obat}/${gambar}">
            <img class="card-img" src="${gambar_obat}/${gambar}" style="width:100%; height: 200px">
        </a>
        <div class="row">
            <div class="col-sm-6">
                <label class="badge badge-info col-lg">
                    <span>Rp.${to_m(harga)},-</span>
                </label>
            </div>
            <div class="col-sm-6">
                <label class="badge badge-info col-lg">
                    <span>Stok: ${stok}</span>
                </label>
            </div>
        </div>  
        <div class="col-lg">
            <h5>
                <span class="badge badge-warning col-lg">Exp: ${expired}</span>
            </h5>
        </div>
    </div>
</div>
        `;
    };

    for (let i = 0; i < obat.length; i++) {
        var b = obat[i],
            o = {
                nama: b.nama_obat.toUpperCase(),
                dom: template(i, b.id_obat, b.nama_obat, b.gambar, b.harga_default, b.stok, b.tgl_expired)
            };
        list.push(o);
    };

    function live_search() {
        var query = $("#in_live_search").val().toUpperCase(),
            toShow = "";
        if (!query.length) {
            for (let i = 0; i < list.length; i++) toShow += list[i].dom;
            $("#daftar_obat").html(toShow);
            return;
        }

        for (let i = 0; i < list.length; i++) {
            if (list[i].nama.indexOf(query) > -1) toShow += list[i].dom;
        }
        $("#daftar_obat").html(toShow);
    };
    live_search();
</script>