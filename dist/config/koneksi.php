<?php

//error_reporting(0);
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "!Emix#2025";
$dbname = "db_informasi";

$koneksi = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$koneksi) {
    die("Tidak dapat terhubung ke database: " . mysqli_connect_error());
}

// Set charset
mysqli_set_charset($koneksi, "utf8");
?>