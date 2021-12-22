<?php

    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sugarcane";

    //Connect
    $database = "mysql:dbname=$dbname;host=$host";
    $connection = new PDO($database, $username, $password);
    $con = mysqli_connect($host,$username,$password,$dbname);

    header('Content-Type: application/json');

    ?>