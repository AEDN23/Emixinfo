<?php
	include("sess_check.php");
	
	// deskripsi halaman
	$pagedesc = "Grade Tambah";
	$menuparent = "master";
	include("layout_top.php");
?>
<script type="text/javascript">
	function checkGradeAvailability() {
	$("#loaderIcon").show();
	jQuery.ajax({
		url: "check_gradeavailability.php",
		data:'id_grade='+$("#id_grade").val(),
		type: "POST",
		success:function(data){
			$("#grade-availability-status").html(data);
			$("#loaderIcon").hide();
		},
		error:function (){}
	});
	}
</script>
<!-- top of file -->
		<!-- Page Content -->
		<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Data Grade</h1>
                    </div><!-- /.col-lg-12 -->
                </div><!-- /.row -->

				<div class="row">
					<div class="col-lg-12"><?php include("layout_alert.php"); ?></div>
				</div>
				
				<div class="row">
					<div class="col-lg-12">
						<form class="form-horizontal" action="grade_insertb.php" method="POST" enctype="multipart/form-data">
							<div class="panel panel-default">
								<div class="panel-heading"><h3>Tambah Data</h3></div>
								<div class="panel-body">
									<div class="form-group">
										<label class="control-label col-sm-3">ID Grade</label>
										<div class="col-sm-4">
											<input type="text" name="id_grade" onBlur="checkGradeAvailability()" class="form-control" placeholder="id_grade" required>
											<span id="grade-availability-status" style="font-size:12px;"></span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Nama Grade</label>
										<div class="col-sm-4">
											<input type="text" name="nama" class="form-control" placeholder="nama" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Line</label>
										<div class="col-sm-3">
											<select name="line" id="line" class="form-control" required>
												<option value="" selected>--- Pilih Line ---</option>
												<option value="Line A">Line A</option>
												<option value="Line B">Line B</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Lot No</label>
										<div class="col-sm-4">
											<input type="text" name="lot" class="form-control" placeholder="lot" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Checked & Approved</label>
										<div class="col-sm-3">
											<select name="approved" id="approved" class="form-control" required>
												<option value="" selected>--- Pilih ---</option>
												<option value="Approved">Approved</option>
												<option value="Not Approved">Not Approved</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-3">Upload Chart</label>
										<div class="col-sm-3">
											<input type="file" name="pdf" class="form-control" accept="application/pdf" required>
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