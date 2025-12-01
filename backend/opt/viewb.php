<?php
include("sess_check.php");
include("dist/function/format_tanggal.php");
if($_GET) {
	$id = $_GET['id_grade'];
	$sql = "SELECT * FROM grade_b WHERE id_grade='". $_GET['id_grade'] ."'";
	$query = mysqli_query($conn,$sql);
	$data = mysqli_fetch_array($query);
}
else {
	echo "ID Tidak Terbaca";
	exit;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <style type="text/css">
        body {
                font-family: verdana;
                position: center;
                font-size:12px;
            }
    </style>
</head>
<body>
<b> Chart View</b>
<hr>
<?php
$id = mysqli_real_escape_string($conn,$_GET['id_grade']);
$sql= "SELECT * FROM grade_b WHERE id_grade='$id' ";
$query = mysqli_query($conn,$sql);
$data  = mysqli_fetch_array($query);
?>
    <tr>
        <td width="120">Grade</td>
        <td>: <?php echo $data['nama'];?></td>
    </tr>
<br>
<br>
<a href="gradeb.php">Close</a>
<hr>
<embed type="application/pdf" src="/emixchart/pdf/<?php echo $data['file'];?>" width="100%" height="600"></embed>

</body>
</html>