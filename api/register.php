<?php

require_once '../koneksi.php';

$response = array("error" => FALSE);

if (isset($_POST['fullname']) && isset($_POST['no_hp']) && isset($_POST['username']) && isset($_POST['password'])) {  
    $fullname = $_POST['fullname'];
    $no_hp = $_POST['no_hp'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($koneksi, $query);

    if(mysqli_num_rows($result) > 0){
        // jika username telah digunakan
        $response["error"] = TRUE;
        $response["error_msg"] = "Username telah digunakan";
        echo json_encode($response);
    }else{
        $q = "INSERT INTO user(fullname,no_hp,username,password) VALUES('$fullname', '$no_hp', '$username', '$password')";
        $new_user = mysqli_query($koneksi, $q);

        if($new_user){
            $r = mysqli_query($koneksi, "SELECT * FROM user WHERE username ='$username'");
            $data = mysqli_fetch_assoc($r);
            
            $response["error"] = FALSE;
            $response["data"] = $data;

            echo json_encode($response);
        }else{
            $response["error"] = TRUE;
            $response["error_msg"] = "User tidak ditemukan";
            echo json_encode($response);
        }
    }
}

?>