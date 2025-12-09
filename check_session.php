<!-- check_session.php -->
<?php
session_start();

$timeout = 600; // 10 menit

// Cek login
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: login.php");
    exit;
}

// Cek status akun (jika ada di session)
if (isset($_SESSION['status']) && $_SESSION['status'] !== 'aktif') {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}

// Cek timeout (auto logout)
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout) {
    session_unset();
    session_destroy();
    header("Location: login.php?expired=1");
    exit;
}

// Update waktu aktivitas
$_SESSION['last_activity'] = time();
?>