<?php

    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sugarcane";

    //Connect
    $database = "mysql:dbname=$dbname;host=$host";
    $connection = new PDO($database, $username, $password);

    ?>