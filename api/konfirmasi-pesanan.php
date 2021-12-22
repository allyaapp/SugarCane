<?php

require_once '../koneksi.php';

$response = array("error" => FALSE);

if (isset($_GET['id_transaksi'])) {  
    $id_transaksi = $_GET['id_transaksi'];

    $query = "UPDATE transaksi SET status = 'diterima' WHERE id_transaksi = '$id_transaksi'";
    $result = mysqli_query($koneksi, $query);

    if($result){
        $response["error"] = FALSE;
        echo json_encode($response);
    }else{
        $response["error"] = TRUE;
        $response["error_msg"] = "Gagal konfirmasi pesanan";
        echo json_encode($response);
    }
}

?>