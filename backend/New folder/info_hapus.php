<?php
	include("sess_check.php");
		$id = $_GET['id_grade'];	
		$sql = "DELETE FROM grade WHERE id_grade='". $id ."'";
		$ress = mysqli_query($conn, $sql);
		header("location: grade.php?act=delete&msg=success");
?>