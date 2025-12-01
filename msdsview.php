<?php
include("sess_check.php");
include("dist/function/format_tanggal.php");
if($_GET) {
	$id_msds = $_GET['id_msds'];
	$sql = "SELECT * FROM msds WHERE id_msds='". $_GET['id_msds'] ."'";
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
<b> DETAIL MSDS</b>
<hr>
<?php
$id_msds = mysqli_real_escape_string($conn,$_GET['id_msds']);
$sql= "SELECT * FROM msds WHERE id_msds='$id_msds' ";
$query = mysqli_query($conn,$sql);
$data  = mysqli_fetch_array($query);
?>
    <tr>
        <td width="120">NAMA MSDS</td>
        <td>: <?php echo $data['nama_msds'];?></td>
    </tr>
<br>
<br>
<a href="msds.php">Close</a>
<hr>
<embed type="application/pdf" src="/emixinfo/pdf/msds/<?php echo $data['file'];?>" width="100%" height="1200"></embed>

</body>
</html>