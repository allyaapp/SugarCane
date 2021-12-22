<?php

require_once '../koneksi.php';

$response = array("error" => FALSE);

if(isset($_GET['user_id'])) {
    $id = $_GET['user_id'];

    $query = "SELECT b.*, u.varianukuran, u.harga, SUM(p.qty) AS terjual FROM `barang` AS b JOIN pesanan AS p ON b.id_barang = p.id_barang JOIN detailukuran AS u ON b.id_detailukuran = u.id_detailukuran JOIN transaksi ON p.id_transaksi = transaksi.id_transaksi WHERE transaksi.id_user = '$id' GROUP BY p.id_barang ORDER BY terjual DESC";
    
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
        $response["error_msg"] = "Belum pernah memesan";
        echo json_encode($response);
    }
}


?>