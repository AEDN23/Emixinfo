<?php
include("sess_check.php");
include("dist/function/format_tanggal.php");
if($_GET) {
	$id_grade = $_GET['code'];
	$sql = "SELECT * FROM grade_b WHERE id_grade='". $_GET['code'] ."'";
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
    <title>Grade Chart Detail</title>
    <style type="text/css">
        body {
                font-family: verdana;
                position: center;
                font-size:12px;
            }
    </style>
</head>
<body>
<hr>
        <?php
			$id_grade = mysqli_real_escape_string($conn,$_GET['code']);
			$sql= "SELECT * FROM grade_b WHERE id_grade='$id_grade' ";
			$query = mysqli_query($conn,$sql);
			$data  = mysqli_fetch_array($query);
		?>
<table width="100%" border="0">
    <tr>
        <td width="120">Nama Grade</td>
        <td>: <?php echo $data['nama'];?></td>
    </tr>
    <tr>
        <td width="120">Lot No</td>
        <td>: <?php echo $data['lot'];?></td>
    </tr>
    <td>
        <tr>
            <td width="120"><a href="gradeb.php">CLOSE</a></td>
        </tr>
        </td>
</table>
<embed type="application/pdf" src="pdf/<?php echo $data['file'];?>" width="100%" height="500"></embed>
<hr> 

<hr>
</body>
</html>