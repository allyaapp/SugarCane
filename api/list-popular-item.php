<?php

require_once '../koneksi.php';

$response = array("error" => FALSE);

$query = "SELECT b.*, u.varianukuran, u.harga, SUM(p.qty) AS terjual FROM `barang` AS b JOIN pesanan AS p ON b.id_barang = p.id_barang JOIN detailukuran AS u ON b.id_detailukuran = u.id_detailukuran GROUP BY p.id_barang ORDER BY terjual DESC";

$result = mysqli_query($koneksi, $query);

if(mysqli_num_rows($result) > 0){
    $data = array();
    while($row = $result->fetch_object()) {
        array_push($data, $row);
    }
    $response["error"] = FALSE;
    $response["data"] = $data;

    echo json_encode($response);
}else{
    $response["error"] = TRUE;
    $response["error_msg"] = "Barang tidak ditemukan";
    echo json_encode($response);
}

?>