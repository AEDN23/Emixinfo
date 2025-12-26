<?php
// memulai session
session_start();

// memanggil file koneksi
require_once("dist/config/koneksi.php");
require_once("dist/config/library.php");

// mengarahkan ke halaman login.php apabila session belum terdaftar
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    $_SESSION['error'] = "Silakan login terlebih dahulu!";
    header("Location: login.php");
    exit();
}

// Cek waktu timeout (8 jam = 28800 detik)
$timeout_duration = 28800;
if (isset($_SESSION['login_time'])) {
    $current_time = time();
    if (($current_time - $_SESSION['login_time']) > $timeout_duration) {
        // Session expired
        session_unset();
        session_destroy();
        $_SESSION['error'] = "Session telah berakhir, silakan login kembali!";
        header("Location: login.php");
        exit();
    }
}

// Fungsi untuk mendapatkan data user dari session
function get_user_data() {
    if (isset($_SESSION['user_id'])) {
        return [
            'id' => $_SESSION['user_id'],
            'username' => $_SESSION['username'],
            'nama' => $_SESSION['nama'],
            'role' => $_SESSION['role'],
            'departemen' => $_SESSION['departemen']
        ];
    }
    return null;
}

// Fungsi untuk mengecek role (opsional, jika perlu akses terbatas)
function check_role($allowed_roles = ['admin', 'user']) {
    if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], $allowed_roles)) {
        $_SESSION['error'] = "Anda tidak memiliki akses!";
        header("Location: index.php");
        exit();
    }
}
?>