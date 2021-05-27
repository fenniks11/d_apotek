<?php
require_once('connection.php');
function get_obat($conn/*, $term*/)
{
    $query = "SELECT * FROM obat join detail_obat on obat.id_obat = detail_obat.id_obat join jenis_obat on detail_obat.id_jenis = jenis_obat.id_jenis"/*  WHERE nama_obat LIKE '%" . $term . "%' ORDER BY nama_obat ASC"*/;
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $data;
}

// if (isset($_GET['term'])) {
$getObat = get_obat($conn/*, $_GET['term']*/);
    $oL = array();
    foreach ($getObat as $oB) {
        // $oL[] = $oB['nama_obat'];
        // $oL[] = $oB['id_obat'];
        // $oL[] = $oB['stok'];
        // $oL[] = $oB['jenis'];
        // $oL[] = $oB['harga_default'];
        $oL[$oB['nama_obat']] = array();
        $oL[$oB['nama_obat']]["id_obat"] = $oB['id_obat'];
        $oL[$oB['nama_obat']]["stok"] = $oB['stok'];
        $oL[$oB['nama_obat']]["jenis"] = $oB['jenis'];
        $oL[$oB['nama_obat']]["harga_default"] = $oB['harga_default'];
    }
    echo json_encode($oL);
// }
