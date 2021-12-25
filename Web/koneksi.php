<?php
$server = "localhost";
$username = "u1694897_b_reg_5";
$password = "jtipolije";
$db = "u1694897_b_reg_5_db";
$koneksi = mysqli_connect($server, $username, $password, $db);

if (mysqli_connect_errno()) {
    echo "koneksi gagal : ".mysqli_connect_error();
}
?>