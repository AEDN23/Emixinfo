<?php
	// memulai session
	session_start();
	
	// memanggil file koneksi
	include("dist/config/koneksi.php");
	include("dist/config/library.php");
	
	// mengarahkan ke halaman login.php apabila session belum terdaftar
	if(! isset($chk_sess)) 
?>