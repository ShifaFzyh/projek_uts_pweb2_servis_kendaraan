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
} elseif ($file === 'montir') {
    require_once 'views/montir.php';
    exit();
} elseif ($file === 'login') {
    require_once 'login.php';
    exit();
} elseif ($file === 'landing') {
    require_once 'landing.php';
    exit();
}

$title = strtoupper($file);
$home = new Page("$title", "$file");
$home->call();

