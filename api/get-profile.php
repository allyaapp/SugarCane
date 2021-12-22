<?php

require_once '../koneksi.php';

$response = array("error" => FALSE);

if (isset($_GET['user_id'])) {  
    $id = $_GET['user_id'];

    $query = "SELECT * FROM user WHERE id_user = '$id'";
    $result = mysqli_query($koneksi, $query);

    if(mysqli_num_rows($result) > 0){
        $data = mysqli_fetch_assoc($result);

        $query = "SELECT COUNT(id_transaksi) AS total_pesanan FROM transaksi WHERE id_user = '$id'";
        $result = mysqli_query($koneksi, $query);
        
        $response["error"] = FALSE;
        $response["data"] = $data;
        $response["jumlah_pesanan"] = mysqli_fetch_assoc($result)['total_pesanan'];

        echo json_encode($response);
    }else{
        $response["error"] = TRUE;
        $response["error_msg"] = "User tidak ditemukan";
        echo json_encode($response);
    }
}

?>