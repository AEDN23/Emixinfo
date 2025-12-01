<!-- Printing -->
	<link rel="stylesheet" href="css/printing.css">
		
	<?php
include("sess_check.php");
include("dist/function/format_tanggal.php");
if($_GET) {
	$id_grade = $_GET['code'];
	$sql = "SELECT * FROM grade WHERE id_grade='". $_GET['code'] ."'";
	$query = mysqli_query($conn,$sql);
	$data = mysqli_fetch_array($query);
}
else {
	echo "ID Tidak Terbaca";
	exit;
}
?>
<html>
<head>
</head>
<body>
<div id="section-to-print">
<div id="only-on-print">
</div>
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span></button>
	<h4 class="modal-title" id="myModalLabel">Detail Grade</h4>
</div>
<div><br/>
<table width="100%">
	<tr>
		<td width="20%"><b>ID Grade</b></td>
		<td width="2%"><b>:</b></td>
		<td width="78%"><?php echo $data['id_grade'];?></td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td width="20%"><b>Nama Grade</b></td>
		<td width="2%"><b>:</b></td>
		<td width="78%"><?php echo $data['nama'];?></td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td width="20%"><b>Line</b></td>
		<td width="2%"><b>:</b></td>
		<td width="78%"><?php echo $data['line'];?></td>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
	<tr>
		<td width="20%"><b>Chart View</b></td>
		<td width="2%"><b>:</b></td>
		<?php
			$id_grade = mysqli_real_escape_string($conn,$_GET['code']);
			$sql= "SELECT * FROM grade WHERE id_grade='$id_grade' ";
			$query = mysqli_query($conn,$sql);
			$data  = mysqli_fetch_array($query);
		?>
		<embed type="application/pdf" src="pdf/<?php echo $data['file'];?>" width="70%" height="300"></embed>
	</tr>
	<tr>
		<td colspan="3">&nbsp;</td>
	</tr>
</table>
</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
</div>

</body>
</html>