<?php

require_once '../koneksi.php';

$response = array("error" => FALSE);

// Lat/Long Alun Alun Bondowoso
$shop_lat = "-7.9131382";
$shop_long = "113.8203945";

if(isset($_GET['user_id'])) {
    $id = $_GET['user_id'];
    $query = "SELECT latitude, longitude FROM user WHERE id_user = '$id'";
    $user = mysqli_query($koneksi, $query);

    $latitude;
    $longitude;

    if(mysqli_num_rows($user) > 0){
        $user = mysqli_fetch_object($user);
        if($user->latitude != 0 && $user->longitude != 0) {
            $latitude = $user->latitude;
            $longitude = $user->longitude;

            /* Proses mengambil ID city/kota */
            $resCityShop = getCityId($shop_lat, $shop_long);

            $jsonCityShop = json_decode($resCityShop);

            $shopId = $jsonCityShop->data[0]->wikiDataId; // Id city dari alamat toko

            sleep(1);

            $resCityDestination = getCityId($latitude, $longitude);

            $jsonCityDestination = json_decode($resCityDestination);
            // var_dump($resCityDestination);
            $destinationId = $jsonCityDestination->data[0]->wikiDataId; // Id city dari alamat tujuan
            /* END */
            
            sleep(1);

            $shopdes = $shopId.'/'.$destinationId;

            /* Proses menghitung jarak dari lokasi toko sampai tujuan */
            $resDistance = getDistance($shopId, $destinationId);

            $jsonDistance = json_decode($resDistance);

            $ongkir = $jsonDistance->data * 3000;
            /* END */

            $response["error"] = FALSE;
            $response["ongkir"] = $ongkir;
            echo json_encode($response);
        }
        else {
            $response["error"] = TRUE;
            $response["error_msg"] = "Lokasi user tidak ditemukan";
            echo json_encode($response);
        }
    }
    else {
        $response["error"] = TRUE;
        $response["error_msg"] = "Lokasi user tidak ditemukan";
        echo json_encode($response);
    }
}

function getCityId($latitude, $longitude)
{
    if($latitude > 0)// bilangan positif
        $latitude = "%2B".$latitude;

    if($longitude > 0)// bilangan positif
        $longitude = "%2B".$longitude;

    $latlong = $latitude.$longitude;

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://wft-geo-db.p.rapidapi.com/v1/geo/cities?location=$latlong&limit=1",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "x-rapidapi-host: wft-geo-db.p.rapidapi.com",
            "x-rapidapi-key: e8c94a0c71msh58414a8b8068668p1662ebjsn6e98a4aef1e2"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return "cURL Error #:" . $err;
    } else {
        return $response;
    }
}

function getDistance($fromId, $toId) {
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://wft-geo-db.p.rapidapi.com/v1/geo/cities/$fromId/distance?fromCityId=$fromId&distanceUnit=KM&toCityId=$toId",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "x-rapidapi-host: wft-geo-db.p.rapidapi.com",
            "x-rapidapi-key: e8c94a0c71msh58414a8b8068668p1662ebjsn6e98a4aef1e2"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        // echo "cURL Error #:" . $err;
        return "cURL Error #:" . $err;
    } else {
        // echo $response;
        return $response;
    }

}

?>