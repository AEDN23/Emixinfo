<?php 
require_once("dist/config/koneksi.php");
// code user username availablity
if(!empty($_POST["id_dokumen"])) {
	$id_grade= $_POST["id_grade"];
	$sql = "SELECT * FROM grade WHERE id_grade='$id_grade'";
	$query = mysqli_query($conn,$sql);
	if(mysqli_num_rows($query)>0){
		echo "<span style='color:red'> ID Grade sudah terdaftar.</span>";
		echo "<script>$('#submit').prop('disabled',true);</script>";
	}else{
		echo "<span style='color:green'> ID Grade bisa digunakan.</span>";
		echo "<script>$('#submit').prop('disabled',false);</script>";
	}
}

?>
