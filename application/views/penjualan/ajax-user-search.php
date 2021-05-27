<?php
require_once('connection.php');
function get_user($conn, $term)
{
    $query = "SELECT * FROM user WHERE nama LIKE '%" . $term . "%' ORDER BY nama ASC";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $data;
}

if (isset($_GET['term'])) {
    $getUser = get_user($conn, $_GET['term']);
    $userList = array();
    foreach ($getUser as $user) {
        $userList[] = $user['email'];
    }
    echo json_encode($userList);
}
