<?php
include("sess_check.php");

$id_grade=$_POST['id_grade'];
$nama=$_POST['nama'];
$line=$_POST['line'];
$lot=$_POST['lot'];
$approved=$_POST['approved'];
$pdf=substr($_FILES["pdf"]["name"],-5);
$newpdf = "pdf".$id_grade.$pdf;
$aktif = "Aktif";

$sqlcek = "SELECT * FROM grade_b WHERE id_grade='$id_grade'";
$resscek = mysqli_query($conn, $sqlcek);
$rowscek = mysqli_num_rows($resscek);
if($rowscek<1){
	$sql="INSERT INTO grade_b(id_grade,nama,line,lot,approved,file,active)
		  VALUES('$id_grade','$nama','$line','$lot','$approved','$newpdf','$aktif')";
	$ress = mysqli_query($conn, $sql);
	if($ress){
		move_uploaded_file($_FILES["pdf"]["tmp_name"],"pdf/".$newpdf);
		echo "<script>alert('Tambah Data Berhasil!');</script>";
		echo "<script type='text/javascript'> document.location = 'gradeb.php'; </script>";
	}else{
		echo("Error description: " . mysqli_error($conn));
		echo "<script>alert('Ops, terjadi kesalahan. Silahkan coba lagi.');</script>";
		echo "<script type='text/javascript'> document.location = 'grade_tambahb.php'; </script>";
	}
}else{
	header("location: grade_tambahb.php?act=add&msg=double");	
}
?>