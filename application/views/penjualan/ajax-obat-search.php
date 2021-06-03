<?php
require_once('connection.php');
function get_obat($conn)
{
    $query = "SELECT * FROM obat join detail_obat on obat.id_obat = detail_obat.id_obat join jenis_obat on detail_obat.id_jenis = jenis_obat.id_jenis where detail_obat.stok > 0 and tgl_expired NOT BETWEEN DATE_SUB(NOW(), INTERVAL 40 YEAR) and now()"/*  WHERE nama_obat LIKE '%" . $term . "%' ORDER BY nama_obat ASC"*/;
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $data;
}

$getObat = get_obat($conn);
$oL = array();
foreach ($getObat as $oB) {

    $oL[$oB['nama_obat']] = array();
    $oL[$oB['nama_obat']]["id_obat"] = $oB['id_obat'];
    $oL[$oB['nama_obat']]["stok"] = $oB['stok'];
    $oL[$oB['nama_obat']]["jenis"] = $oB['jenis'];
    $oL[$oB['nama_obat']]["harga_default"] = $oB['harga_default'];
}
echo json_encode($oL);

// 