<?php
require_once('connection.php');
function get_obat($conn, $term)
{
    $query = "SELECT * FROM obat join detail_obat on obat.id_obat = detail_obat.id_obat join jenis_obat on detail_obat.id_jenis = jenis_obat.id_jenis  WHERE nama_obat LIKE '%" . $term . "%' ORDER BY nama_obat ASC";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $data;
}

if (isset($_GET['term'])) {
    $getObat = get_obat($conn, $_GET['term']);
    $obatList = array();
    foreach ($getObat as $obat) {
        $obatList[] = $obat['nama_obat'];
        $obatList[] = $obat['stok'];
        $obatList[] = $obat['jenis'];
        $obatList[] = $obat['harga_default'];
    }
    echo json_encode($obatList);
}
