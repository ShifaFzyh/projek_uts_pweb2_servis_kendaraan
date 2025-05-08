<?php
    //1) Definisikan variable untuk koneksi ke database
    $host = "localhost";
    $db = "service_kendaraan";
    $user = "root";
    $pass = "";
    $charset = "utf8mb4";

    // 2) Buat DSN (Data Source Name) dan Opsi koneksi database
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    // 3) Buat koneksi ke database
    $bdh = new PDO($dsn, $user, $pass, $opt);




?>