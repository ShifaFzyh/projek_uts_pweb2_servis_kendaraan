<?php

/**
 * File ini akan digunakan untuk memanggil database
 */
$host = "localhost";
$dbname = "servis_kendaraan";
$username = "root";
$password = ""; 

try {
    $pdo = new PDO('mysql:host=localhost;dbname=servis_kendaraan', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}
?>
