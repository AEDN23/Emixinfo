<?php
// memulai session
session_start();
// memanggil file koneksi
include("dist/config/koneksi.php");

<<<<<<< HEAD
// Debug: Log POST data
error_log("Login attempt: " . print_r($_POST, true));

if (isset($_POST['login'])) {
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$password = $_POST['password'];

	// Debug: Log input
	error_log("Username: $username, Password length: " . strlen($password));

	// Validasi input kosong
	if (empty($username) || empty($password)) {
		$_SESSION['alert_type'] = "warning";
		$_SESSION['alert'] = "Username dan password harus diisi!";
		header("Location: login.php");
		exit;
=======
// mengecek apakah tombol login sudah di tekan atau belum
if(isset($_POST['login'])) {
	// mengecek apakah username dan password sudah di isi atau belum
	if(empty($_POST['username']) || empty($_POST['password'])) {
		// mengarahkan ke halaman login.php
		header("location: login.php?err=empty");
>>>>>>> temp-branch
	}
	else {
		// membaca nilai variabel username dan password
		$username = $_POST['username'];
		$password = $_POST['password'];
		$akses = $_POST['akses'];
		// mencegah sql injection
		$username = htmlentities(trim(strip_tags($username)));
		$password = htmlentities(trim(strip_tags($password)));
			// memeriksa username di tabel admin

<<<<<<< HEAD
	// Ambil user berdasarkan username
	$query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

	// Debug: Log query result
	error_log("Query executed. Rows: " . mysqli_num_rows($query));

	if (!$query) {
		// Error query
		$_SESSION['alert_type'] = "danger";
		$_SESSION['alert'] = "Terjadi kesalahan sistem! " . mysqli_error($conn);
		header("Location: login.php");
		exit;
	}

	// Cek apakah user ditemukan
	if (mysqli_num_rows($query) == 0) {
		$_SESSION['alert_type'] = "danger";
		$_SESSION['alert'] = "Username '$username' tidak ditemukan!";
		header("Location: login.php");
		exit;
	}

	$user = mysqli_fetch_assoc($query);

	// Debug: Log user data (HATI-HATI di production, hapus ini!)
	error_log("User found: " . print_r($user, true));
	error_log("Password from DB: " . $user['password']);
	error_log("Password provided length: " . strlen($password));

	// Cek status akun
	if ($user['status'] !== 'aktif') {
		$_SESSION['alert_type'] = "danger";
		$_SESSION['alert'] = "Akun Anda tidak aktif!";
		header("Location: login.php");
		exit;
	}

	// Verifikasi password
	if (password_verify($password, $user['password'])) {
		// Debug: Log success
		error_log("Password verified successfully for user: $username");

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

		// Debug: Log session data
		error_log("Session created: " . print_r($_SESSION, true));

		header("Location: index.php");
		exit;
	} else {
		// Debug: Log password failure
		error_log("Password verification FAILED for user: $username");
		error_log("Hash from DB: " . $user['password']);
		error_log("Trying to verify: " . $password);

		// Test password hash untuk debugging
		$test_hash = password_hash('password', PASSWORD_DEFAULT);
		error_log("Test hash for 'password': " . $test_hash);
		error_log("Test verify result: " . (password_verify('password', $test_hash) ? 'TRUE' : 'FALSE'));
		error_log("Verify with DB hash: " . (password_verify('password', $user['password']) ? 'TRUE' : 'FALSE'));

		$_SESSION['alert_type'] = "danger";
		$_SESSION['alert'] = "Password salah!";
		header("Location: login.php");
		exit;
	}
} else {
	// Jika akses langsung tanpa submit form
	header("Location: login.php");
	exit;
=======
			if($akses=="Admin"){			
				$sql = "SELECT * FROM admin WHERE user_adm='". $username ."' AND pass_adm='". $password ."'";
				$ress = mysqli_query($conn, $sql);
				$rows = mysqli_num_rows($ress);
				$dataku = mysqli_fetch_array($ress);
				// mendaftarkan session jika username di temukan
				if($rows == 1) {
					// membuat variabel session
					$_SESSION['admin'] = strtolower($dataku['id_adm']);
					// mengarahkan ke halaman indeks.php
					header("location: index.php?login=success");
				}else{
					header("location: login.php?err=not_found");
				}
			}else if($akses=="Lead"){
				$aks = "Leader";
				$sql = "SELECT * FROM employee WHERE hak_akses='".$aks."' AND npp='". $username ."' AND password='". $password ."'";
				$ress = mysqli_query($conn, $sql);
				$rows = mysqli_num_rows($ress);
				$dataku = mysqli_fetch_array($ress);
				// mendaftarkan session jika username di temukan
				if($rows == 1) {
					// membuat variabel session
					$_SESSION['leader'] = strtolower($dataku['npp']);
					// mengarahkan ke halaman indeks.php
					header("location: leader/index.php?login=success");
				}else{
					header("location: login.php?err=not_found");
				}
			}else if($akses=="Mng"){			
				$aks = "Manager";
				$sql = "SELECT * FROM employee WHERE hak_akses='".$aks."' AND npp='". $username ."' AND password='". $password ."'";
				$ress = mysqli_query($conn, $sql);
				$rows = mysqli_num_rows($ress);
				$dataku = mysqli_fetch_array($ress);
				// mendaftarkan session jika username di temukan
				if($rows == 1) {
					// membuat variabel session
					$_SESSION['manager'] = strtolower($dataku['npp']);
					// mengarahkan ke halaman indeks.php
					header("location: manager/index.php?login=success");
				}else{
					header("location: login.php?err=not_found");
				}
			}else if($akses=="Pgw"){		
				$aks = "Pegawai";
				$sql = "SELECT * FROM employee WHERE hak_akses='".$aks."' AND npp='". $username ."' AND password='". $password ."'";
				$ress = mysqli_query($conn, $sql);
				$rows = mysqli_num_rows($ress);
				$dataku = mysqli_fetch_array($ress);
				// mendaftarkan session jika username di temukan
				if($rows == 1) {
					// membuat variabel session
					$_SESSION['pegawai'] = strtolower($dataku['npp']);
					// mengarahkan ke halaman indeks.php
					header("location: pegawai/index.php?login=success");
				}else{
					header("location: login.php?err=not_found");
				}
			}else{			
				$aks = "Supervisor";
				$sql = "SELECT * FROM employee WHERE hak_akses='".$aks."' AND npp='". $username ."' AND password='". $password ."'";
				$ress = mysqli_query($conn, $sql);
				$rows = mysqli_num_rows($ress);
				$dataku = mysqli_fetch_array($ress);
				// mendaftarkan session jika username di temukan
				if($rows == 1) {
					// membuat variabel session
					$_SESSION['supervisor'] = strtolower($dataku['npp']);
					// mengarahkan ke halaman indeks.php
					header("location: supervisor/index.php?login=success");
				}else{
					header("location: login.php?err=not_found");
				}
			}
	}
>>>>>>> temp-branch
}
?>