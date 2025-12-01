<?php 
require_once("dist/config/koneksi.php");
// code user username availablity
if(!empty($_POST["id_dokumen"])) {
	$id_dokumen= $_POST["id_dokumen"];
	$sql = "SELECT * FROM wi WHERE id_dokumen='$id_dokumen'";
	$sql = "SELECT * FROM sop WHERE id_dokumen='$id_dokumen'";
	$query = mysqli_query($conn,$sql);
	if(mysqli_num_rows($query)>0){
		echo "<span style='color:red'> ID Dokumen sudah terdaftar.</span>";
		echo "<script>$('#submit').prop('disabled',true);</script>";
	}else{
		echo "<span style='color:green'> ID Dokumen bisa digunakan.</span>";
		echo "<script>$('#submit').prop('disabled',false);</script>";
	}
}

?>
