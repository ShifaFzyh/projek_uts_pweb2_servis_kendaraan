<?php
require_once('Controllers/Page.php');

if (!isset($_GET['url'])) {
    header("Location: ?url=layanan"); // Ubah default ke layanan
    exit();
}

$file = $_GET['url'];

if ($file === 'layanan') {
    require_once 'views/layanan.php';
    exit();
}

$title = strtoupper($file);
$home = new Page("$title", "$file");
$home->call();

