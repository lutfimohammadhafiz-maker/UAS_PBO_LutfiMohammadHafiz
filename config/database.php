<?php
// config/database.php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'db_uas_pbo_trpl1a_lutfimohammadhafiz';

$koneksi = mysqli_connect($host, $user, $password, $database);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

mysqli_set_charset($koneksi, "utf8");
?>