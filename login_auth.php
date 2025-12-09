<?php
session_start();

// memanggil file koneksi
include("dist/config/koneksi.php");

if (isset($_POST['login'])) {
	$username = mysqli_real_escape_string($koneksi, $_POST['username']);
	$password = $_POST['password'];

	// Validasi input kosong
	if (empty($username) || empty($password)) {
		$_SESSION['alert_type'] = "warning";
		$_SESSION['alert'] = "Username dan password harus diisi!";
		header("Location: login.php");
		exit;
	}

	// Ambil user aktif berdasarkan username
	$query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");

	if (!$query) {
		// Error query
		$_SESSION['alert_type'] = "danger";
		$_SESSION['alert'] = "Terjadi kesalahan sistem!";
		header("Location: login.php");
		exit;
	}

	// Cek apakah user ditemukan
	if (mysqli_num_rows($query) == 0) {
		$_SESSION['alert_type'] = "danger";
		$_SESSION['alert'] = "Username tidak ditemukan!";
		header("Location: login.php");
		exit;
	}

	$user = mysqli_fetch_assoc($query);

	// Cek status akun
	if ($user['status'] !== 'aktif') {
		$_SESSION['alert_type'] = "danger";
		$_SESSION['alert'] = "Akun Anda tidak aktif!";
		header("Location: login.php");
		exit;
	}

	// Verifikasi password
	if (password_verify($password, $user['password'])) {
		// Keamanan: regenerate session ID
		session_regenerate_id(true);

		// SIMPAN SESSION
		$_SESSION['login']  = true;
		$_SESSION['user_id'] = $user['id'];
		$_SESSION['username'] = $user['username'];
		$_SESSION['nama_lengkap'] = $user['nama_lengkap'];
		$_SESSION['role']   = $user['role'];
		$_SESSION['dept']   = $user['dept'];
		$_SESSION['status'] = $user['status'];

		// Untuk auto logout
		$_SESSION['last_activity'] = time();

		header("Location: index.php");
		exit;
	} else {
		$_SESSION['alert_type'] = "danger";
		$_SESSION['alert'] = "Password salah!";
		header("Location: login.php");
		exit;
	}
} else {
	// Jika akses langsung tanpa submit form
	header("Location: login.php");
	exit;
}
