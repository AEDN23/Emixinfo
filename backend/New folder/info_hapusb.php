<?php
	include("sess_check.php");
		$id = $_GET['id_grade'];	
		$sql = "DELETE FROM grade_b WHERE id_grade='". $id ."'";
		$ress = mysqli_query($conn, $sql);
		header("location: gradeb.php?act=delete&msg=success");
?>