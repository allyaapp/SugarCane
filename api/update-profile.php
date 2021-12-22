<?php

require_once '../koneksi.php';

$response = array("error" => FALSE);

if (isset($_POST['user_id'])) {  
    $id = $_POST['user_id'];
    $fullname = $_POST['fullname'];
    $no_hp = $_POST['no_hp'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($koneksi, $query);
    $d = mysqli_fetch_assoc($result);

    if(mysqli_num_rows($result) > 0 && ($username != null && $username != $d['username'])){
        // jika username berubah dan telah digunakan
        $response["error"] = TRUE;
        $response["error_msg"] = "Username telah digunakan";
        echo json_encode($response);
    }else{
        if(isset($_POST['longitude']) && isset($_POST['latitude'])) {
            $longitude = $_POST['longitude'];
            $latitude = $_POST['latitude'];
            $q = "UPDATE user SET longitude = '$longitude', latitude = '$latitude' WHERE id_user = '$id'";

            mysqli_query($koneksi, $q);
        }

        if(isset($_POST['alamat'])) {
            $alamat = $_POST['alamat'];
            $q = "UPDATE user SET alamat = '$alamat' WHERE id_user = '$id'";

            mysqli_query($koneksi, $q);
        }

        $q = "UPDATE user SET fullname = '$fullname', password = '$password', username = '$username', no_hp = '$no_hp' WHERE id_user = '$id'";
        
        $update_user = mysqli_query($koneksi, $q);

        if($update_user){
            $r = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user ='$id'");
            $data = mysqli_fetch_assoc($r);

            if(isset($_POST['foto'])) {
                // jika user juga mengupload foto
                // $foto = $_FILES['foto']['name'];
                // $tmp = $_FILES['foto']['tmp_name'];
                $foto = $_POST['foto'];
                $tmp = $_POST['tmp_name'];

                if($data['foto'] != null) {
                    if(file_exists("../images/user/".$data['foto'])) {
                        if(unlink("../images/user/".$data['foto'])) {
                            uploadFoto($id, $foto, $tmp, $koneksi);
                        }
                    }
                    else {
                        uploadFoto($id, $foto, $tmp, $koneksi);
                    }
                }
            }

            $r = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user ='$id'");
            $data = mysqli_fetch_assoc($r);

            $response["error"] = FALSE;
            $response["data"] = $data;

            echo json_encode($response);
        }else{
            $response["error"] = TRUE;
            $response["error_msg"] = "Terjadi kesalahan pada query";
            echo json_encode($response);
        }
    }
}
else{
    $response["error"] = TRUE;
    $response["error_msg"] = "ID user tidak ditemukan";
    echo json_encode($response);
}

function uploadFoto($id, $foto, $tmp, $koneksi) {
    try {
        $folder = "../images/user";
        $filename = $folder.'/'.$foto;
        $img = base64_decode($tmp);
        $upload = file_put_contents($filename, $img);
        
        if($upload) {
            chmod('../images/user/'.$foto, 0666);
            mysqli_query($koneksi, "UPDATE user SET foto = '$foto' WHERE id_user = '$id'");
        }
        else {
            $response["error"] = TRUE;
            $response["error_msg"] = "Gagal mengupload foto";

            echo json_encode($response);
        }
    } catch (Exception $e) {
        $response["error"] = TRUE;
        $response["error_msg"] = $e;

        echo json_encode($response);
    }
}
?>