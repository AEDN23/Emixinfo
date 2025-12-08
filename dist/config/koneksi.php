<?php
//error_reporting(0);

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "!Emix#2025";
$dbname = "db_informasi";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die("Tidak dapat terhubung ke database: " . mysqli_error());
