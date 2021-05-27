<?php
require_once('connection.php');
function get_user($conn, $term)
{
    $query = "SELECT * FROM obat WHERE nama_obat LIKE '%" . $term . "%' ORDER BY nama_obat ASC";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $data;
}

if (isset($_GET['term'])) {
    $getObat = get_user($conn, $_GET['term']);
    $obatList = array();
    foreach ($getObat as $obat) {
        $obatList[] = $obat['nama_obat'];
    }
    echo json_encode($obatList);
}
