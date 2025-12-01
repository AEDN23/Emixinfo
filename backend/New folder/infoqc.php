<?php
	include("sess_check.php");

	$sql_a = "SELECT id_grade FROM grade WHERE line='Line A'";
	$ress_a = mysqli_query($conn, $sql_a);
	$a = mysqli_num_rows($ress_a);

	$sql_b = "SELECT id_grade FROM grade_b WHERE line='Line B'";
	$ress_b = mysqli_query($conn, $sql_b);
	$b = mysqli_num_rows($ress_b);
	
	// deskripsi halaman
	$pagedesc = "Beranda";
	include("layout_top.php");
?>
<!-- top of file -->
		<!-- Page Content -->
		<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">MEDIA INFORMASI PT. ELASTOMIX INDOESIA</h1>
                    </div><!-- /.col-lg-12 -->
                </div><!-- /.row -->
				<div class="row">
					<div class="col-lg-6 col-md-6">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-check-circle fa-3x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge"><?php echo $a; ?></div>
										<div><h4>WI - WORK INSTRUCTIONS</h4></div>
									</div>
								</div>
							</div>
							<a href="wiqc.php">
								<div class="panel-footer">
									<span class="pull-left">Lihat Data</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div><!-- /.panel-green -->

				<div class="row">
					<div class="col-lg-6 col-md-6">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-check-circle fa-3x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge"><?php echo $a; ?></div>
										<div><h4>SOP - STANDAR OPERASIONAL PROSEDUR</h4></div>
									</div>
								</div>
							</div>
							<a href="sopqc.php">
								<div class="panel-footer">
									<span class="pull-left">Lihat Data</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div><!-- /.panel-green -->
					
					<!--<div class="col-lg-6 col-md-6">
						<div class="panel panel-yellow">
							<div class="panel-heading">
								<div class="row">
									<div class="col-xs-3">
										<i class="fa fa-plus-circle fa-3x"></i>
									</div>
									<div class="col-xs-9 text-right">
										<div class="huge"><?php echo $b; ?></div>
										<div><h4>SOP - STANDAR OPERASIONAL PROSEDUR</h4></div>
									</div>
								</div>
							</div>
							<a href="gradeb.php">
							
								<div class="panel-footer">
									<span class="pull-left">Lihat Data</span>
									<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
									<div class="clearfix"></div>
								</div>
							</a>
						</div>
					</div><!-- /.panel-green -->
				</div><!-- /.row -->		
				
				
				
            </div><!-- /.container-fluid -->
        </div><!-- /#page-wrapper -->
<!-- bottom of file -->
<?php
	include("layout_bottom.php");
?>