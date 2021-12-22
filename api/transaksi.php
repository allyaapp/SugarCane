<?php

require_once '../koneksi.php';

$response = array("error" => FALSE);

// Mengambil json request
$json = file_get_contents('php://input');

// Konvert menjadi objek PHP
$request = json_decode($json);

if (isset($request) || $request != null) {  
    $user_id = $request->user_id;
    $total_harga = $request->total_harga;
    $ongkir = $request->ongkir;
    $items = $request->items;

    /* Simpan Transaksi */
    $now = date('Y-m-d');
    $query = "INSERT INTO transaksi(id_user, tgltransaksi, ongkir, totalharga) VALUES('$user_id', '$now', '$ongkir', '$total_harga')";
    if($koneksi->query($query) === TRUE) {
        $id_transaksi = $koneksi->insert_id;
        
        foreach ($items as $value) {
            /* Store pesanan */
            $query = "INSERT INTO pesanan(id_transaksi, id_barang, qty, subharga) VALUES('$id_transaksi', '$value->id_barang', '$value->qty', '$value->subharga')";

            mysqli_query($koneksi, $query);
            /* END */

            /* Kurangi stok */
            $query = "UPDATE barang SET stok = stok - $value->qty WHERE id_barang = $value->id_barang";
            mysqli_query($koneksi, $query);
            /* END */
        }

        $response["error"] = FALSE;
    }
    else {
        $response["error"] = TRUE;
        $response["error_msg"] = "Terjadi kesalahan.";
    }
    echo json_encode($response);
    /* END */
}

?>