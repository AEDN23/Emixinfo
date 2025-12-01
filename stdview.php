<?php
include("sess_check.php");
include("dist/function/format_tanggal.php");
if($_GET) {
	$id_ = $_GET['id_dokumen'];
	$sql = "SELECT * FROM std WHERE id_dokumen='". $_GET['id_dokumen'] ."'";
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
<b> DETAIL STANDARD DOKUMEN</b>
<hr>
<?php
$id = mysqli_real_escape_string($conn,$_GET['id_dokumen']);
$sql= "SELECT * FROM std WHERE id_dokumen='$id' ";
$query = mysqli_query($conn,$sql);
$data  = mysqli_fetch_array($query);
?>
    <tr>
        <td width="120">NAMA DOKUMEN</td>
        <td>: <?php echo $data['nama'];?></td>
    </tr>
<br>
<br>
<a href="std.php">Close</a>
<hr>
<embed type="application/pdf" src="/emixinfo/pdf/std/<?php echo $data['file'];?>" width="100%" height="1200"></embed>

</body>
</html>