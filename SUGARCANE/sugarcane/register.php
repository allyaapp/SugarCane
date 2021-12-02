<?php

include 'koneksi.php';

if ($_POST) {

    //POST DATA
    $id_user = filter_input(INPUT_POST, 'id_user', FILTER_SANITIZE_STRING);
    $fullname = filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_STRING);
    $alamat = filter_input(INPUT_POST, 'alamat', FILTER_SANITIZE_STRING);
    $no_hp = filter_input(INPUT_POST, 'no_hp', FILTER_SANITIZE_STRING);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $response = [];

    //Cek username didalam database
    $userQuery = $connection->prepare("SELECT * FROM user where username = ?");
    $userQuery->execute(array($username));

    // Cek username apakah ada tau tidak
    if ($userQuery->rowCount() != 0) {
        // Beri Response
        $response['status'] = false;
        $response['message'] = 'Akun sudah digunakan';
    } else {
        $insertAccount = 'INSERT INTO user (id_user, fullname, alamat, no_hp, username, password) values (:id_user, :fullname, :alamat, :no_hp, :username, :password)';
        $statement = $connection->prepare($insertAccount);

        try {
            //Eksekusi statement db
            $statement->execute([
                ':id_user' => $id_user,
                ':fullname' => $fullname,
                ':alamat' => $alamat,
                ':no_hp' => $no_hp,
                ':username' => $username,
                ':password' => $password
            ]);

            //Beri response
            $response['status'] = true;
            $response['message'] = 'Akun berhasil didaftarkan';
            $response['data'] = [
                ':id_user' => $id_user,
                ':fullname' => $fullname,
                ':alamat' => $alamat,
                ':no_hp' => $no_hp,
                ':username' => $username,
                ':password' => $password
            ];
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    //Jadikan data JSON
    $json = json_encode($response, JSON_PRETTY_PRINT);

    //Print JSON
    echo $json;
}