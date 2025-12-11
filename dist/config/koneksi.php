<?php

//error_reporting(0);
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "!Emix#2025";
$dbname = "db_informasi";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$conn) {
    die("Tidak dapat terhubung ke database: " . mysqli_connect_error());
}
    
// Set charset
mysqli_set_charset($conn, "utf8");
