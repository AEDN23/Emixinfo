<?php
	include("sess_check.php");

// FUNGSI GENERATE NOMOR COA OTOMATIS

// --- LOGIKA AUTO NUMBER COA (VERSI AMAN DIGIT BERAPAPUN) ---

// 1. Ambil id_coa terakhir
$sql_last = "SELECT id_coa FROM coa ORDER BY id_coa DESC LIMIT 1";
$res_last = mysqli_query($conn, $sql_last);

if (mysqli_num_rows($res_last) > 0) {
	$row_last = mysqli_fetch_assoc($res_last);
	$last_id = $row_last['id_coa'];  

	$parts = explode("-", $last_id);
	$number = (int) end($parts);

	$new_number = $number + 1;


	$new_id = "COA-" . sprintf("%03d", $new_number);
} else {
	// Jika database kosong
	$new_id = "COA-001";
}
// --- AKHIR LOGIKA ---

	
	// deskripsi halaman
	$pagedesc = "COA Tambah";
	$menuparent = "master";
	include("layout_top.php");
?>
<!-- <script type="text/javascript">
	function checkPrdAvailability() {
	$("#loaderIcon").show();
	jQuery.ajax({
		url: "check_prdavailability.php",
		data:'id_dokumen='+$("#id_dokumen").val(),
		type: "POST",
		success:function(data){
			$("#prd-availability-status").html(data);
			$("#loaderIcon").hide();
		},
		error:function (){}
	});
	}
</script> -->
<!-- top of file -->
		<!-- Page Content -->
		<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Input Data Certificate of Analysis (COA)</h1>
                    </div><!-- /.col-lg-12 -->
                </div><!-- /.row -->

				<div class="row">
					<div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
				</div>
				
				<div class="row">
					<div class="col-lg-12">
						<form class="form-horizontal" action="coainsert.php" method="POST" enctype="multipart/form-data">
							<div class="panel panel-default">
								<div class="panel-heading"><h3>Tambah Data</h3></div>
								<div class="panel-body">
									<div class="form-group">
										<label class="control-label col-sm-3">Nomor Dokumen</label>
										<div class="col-sm-4">
											<input type="text" name="id_coa" class="form-control" value="<?php echo $new_id; ?>" readonly>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Nama Dokumen</label>
										<div class="col-sm-4">
											<input type="text" name="nama_coa" class="form-control" placeholder="Nama Dokumen" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Departemen</label>
										<div class="col-sm-3">
											<select name="departemen" id="departemen" class="form-control" required>
												<option value="" selected>--- Pilih Departemen ---</option>
												<option value="Production">Production</option>
												<option value="Quality & Planning">Quality & Planning</option>
												<option value="Purchasing Logistic">Purchasing Logistic</option>
												<option value="Sales">Sales</option>
												<option value="Maintenance">Maintenance</option>
												<option value="PGA IT">PGA IT</option>
												<option value="HSE">HSE</option>
												<option value="Akunting">Akunting</option>
											</select>
										</div>
									</div> 
									<div class="form-group">
										<label class="control-label col-sm-3">Tahun Dokumen</label>
										<div class="col-sm-4">
											<input type="text" name="status" class="form-control" placeholder="Tahun Dokumen" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Keterangan</label>
										<div class="col-sm-4">
											<input type="text" name="keterangan" class="form-control" placeholder="Keterangan Dokumen" required>
										</div>
									</div>
									<!-- <div class="form-group">
										<label class="control-label col-sm-3">Checked & Approved</label>
										<div class="col-sm-3">
											<select name="approved" id="approved" class="form-control" required>
												<option value="" selected>--- Pilih ---</option>
												<option value="Approved">Approved</option>
												<option value="Not Approved">Not Approved</option>
											</select>
										</div>
									</div> -->
									<div class="form-group">
										<label class="control-label col-sm-3">Upload PDF</label>
										<div class="col-sm-3">
											<input type="file" name="pdf" class="form-control" accept="application/pdf">
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Upload Video</label>
										<div class="col-sm-3">
											<input type="file" name="video" class="form-control" accept="application/mp4O">
											<!-- <input type="file" name="video" class="form-control-file"/> -->
										</div>
									</div>
								</div>
								<div class="panel-footer">
									<button type="submit" name="simpan" class="btn btn-success">Simpan</button>
								</div>
							</div><!-- /.panel -->
						</form>
					</div><!-- /.col-lg-12 -->
				</div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div><!-- /#page-wrapper -->
<!-- bottom of file -->
<?php
	include("layout_bottom.php");
?>