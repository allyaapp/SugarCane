<?php

require_once '../koneksi.php';

$response = array("error" => FALSE);

if (isset($_POST['username']) && isset($_POST['password'])) {  
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($koneksi, $query);

    if(mysqli_num_rows($result) > 0){
        $data = mysqli_fetch_assoc($result);
        
        if($data['password'] == $password) {
            $response["error"] = FALSE;
            $response["data"] = $data;
        }
        else {
            $response["error"] = TRUE;
            $response["error_msg"] = "Password tidak sesuai";            
        }

        echo json_encode($response);
    }else{
        $response["error"] = TRUE;
        $response["error_msg"] = "User tidak ditemukan";
        echo json_encode($response);
    }
}

?>