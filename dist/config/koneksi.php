<?php
// error_reporting(0);


$dbhost = "localhost";
$dbuser = "root";
$dbpass = "!Emix#2025";
$dbname = "db_informasi";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (!$conn) {
    die("Tidak dapat terhubung ke database: " . mysqli_connect_error());
}
define("CONF_DIR_PROJECT", "emixinfo");

function site_url($slash = false)
{
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        ? 'https'
        : 'http';

    $host = $_SERVER['HTTP_HOST'];
    $base = $protocol . '://' . $host . '/' . CONF_DIR_PROJECT;

    return $slash ? $base . '/' : $base;
}
