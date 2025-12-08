<?php
include("sess_check.php");
include("dist/function/format_tanggal.php");
if($_GET) {
	$id_coa = $_GET['id_coa'];
	$sql = "SELECT * FROM coa WHERE id_coa='". $_GET['id_coa'] ."'";
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
<b> DETAIL CERTIFICATE OF ANALYSIS</b>
<hr>
<?php
$id_coa = mysqli_real_escape_string($conn,$_GET['id_coa']);
$sql= "SELECT * FROM coa WHERE id_coa='$id_coa' ";
$query = mysqli_query($conn,$sql);
$data  = mysqli_fetch_array($query);
?>
    <tr>
        <td width="120">NAMA DOKUMEN</td>
        <td>: <?php echo $data['nama_coa'];?></td>
    </tr>
<br>
<br>
<a href="coa.php">Close</a>
<hr>
<embed type="application/pdf" src="/emixinfo/pdf/coa/<?php echo $data['file'];?>" width="100%" height="1200"></embed>

</body>
</html>