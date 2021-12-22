<?php

require_once '../koneksi.php';

$response = array("error" => FALSE);

if (isset($_GET['user_id'])) {  
    $id = $_GET['user_id'];

    $query = "SELECT * FROM transaksi WHERE id_user = '$id' ORDER BY status,id_transaksi DESC";
    $result = mysqli_query($koneksi, $query);

    if(mysqli_num_rows($result) > 0){
        $data = array();
        $index = 0;
        while ($row = $result->fetch_object()) {
            array_push($data, $row);

            $idTransaksi = $row->id_transaksi;
            $query = "SELECT b.varian, b.ukuran, p.qty, p.subharga FROM pesanan AS p
                        JOIN barang AS b ON b.id_barang = p.id_barang
                        WHERE p.id_transaksi = '$idTransaksi'";
            $listItem = mysqli_query($koneksi, $query);

            $dataitem = array();
            while($rows = $listItem->fetch_object()) {
                array_push($dataitem, $rows);
            }
            $data[$index]->item = $dataitem;
            $index++;
        }
        $response["error"] = FALSE;
        $response["data"] = $data;

        echo json_encode($response);
    }else{
        $response["error"] = TRUE;
        $response["error_msg"] = "Transaksi tidak ditemukan";
        echo json_encode($response);
    }
}

?>