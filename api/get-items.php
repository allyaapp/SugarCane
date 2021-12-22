<?php

require_once '../koneksi.php';

$response = array("error" => FALSE);

if (isset($_GET['q']) || $_GET['q'] == "") {  
    $q = $_GET['q'];

    $query = "SELECT barang.*, u.varianukuran, u.harga FROM barang JOIN detailukuran AS u ON barang.id_detailukuran = u.id_detailukuran  WHERE barang.varian LIKE('%".$q."%') OR barang.ukuran LIKE('%".$q."%') ";

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
}
else {
    $query = "SELECT barang.*, u.varianukuran, u.harga FROM barang JOIN detailukuran AS u ON barang.id_detailukuran = u.id_detailukuran";

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
}

?>