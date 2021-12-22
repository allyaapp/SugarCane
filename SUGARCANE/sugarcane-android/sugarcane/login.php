<?php

include 'koneksi.php';

if ($_POST) {

    //Data
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $response = []; //Data Response

    //Cek username didalam database
    $userQuery = $connection->prepare("SELECT * FROM user where username = ?");
    $userQuery->execute(array($username));
    $query = $userQuery->fetch();

    if ($userQuery->rowCount() == 0) {
        $response['status'] = false;
        $response['message'] = "Username Tidak Terdaftar";
    } else {
        // Ambil password di db
        $passwordDB = $query['password'];

        if (strcmp(($password), $passwordDB) === 0) {
            $response['status'] = true;
            $response['message'] = "Login Berhasil";
            $response['data'] = [
                'id_user' => $query['id_user'],
                'fullname' => $query['fullname'],
                'alamat' => $query['alamat'],
                'no_hp' => $query['no_hp'],
                'username' => $query['username'],
                'password' => $query['password']
            ];
        } else {
            $response['status'] = false;
            $response['message'] = "Username atau password anda salah";
        }
    }

    //Jadikan data JSON
    $json = json_encode($response, JSON_PRETTY_PRINT);

    //Print
    echo $json;
}
