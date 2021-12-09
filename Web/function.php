<?php

require "koneksi.php";

function verifikasi ($data)
{
    global $koneksi;
    $email = $data['email'];
    var_dump($email);
    $result = mysqli_query($koneksi, "SELECT * FROM admindetail WHERE username = '$email'");
    $row = mysqli_fetch_assoc($result);

    if(isset($row['email'])){
        echo "
        <script>
            location = 'forgot-password.php'
        </script>";
        return false;
        return;
    }else {
        return false;
    }
}

?>