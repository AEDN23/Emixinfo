<?php
include("sess_check.php");

echo "<pre>";
print_r($_SESSION);
echo "</pre>";
$sql_wi = "SELECT id_dokumen FROM wi WHERE active='Aktif'";
$ress_wi = mysqli_query($conn, $sql_wi);
$wi = mysqli_num_rows($ress_wi);

$sql_std = "SELECT id_dokumen FROM std WHERE active='Aktif'";
$ress_std = mysqli_query($conn, $sql_std);
$std = mysqli_num_rows($ress_std);

$sql_msds = "SELECT id_msds FROM msds WHERE active='Aktif'";
$ress_msds = mysqli_query($conn, $sql_msds);
$msds = mysqli_num_rows($ress_msds);

$sql_coa = "SELECT id_coa FROM coa WHERE active='Aktif'";
$ress_coa = mysqli_query($conn, $sql_coa);
$coa = mysqli_num_rows($ress_coa);

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
				<h1 class="page-header">PT. ELASTOMIX INDOESIA - INFORMASI DOKUMEN</h1>
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
								<div class="huge"><?php echo $wi; ?></div>
								<div>
									<h4>WORK INSTRUCTIONS</h4>
								</div>
							</div>
						</div>
					</div>
					<a href="wi.php">
						<div class="panel-footer">
							<span class="pull-left">Lihat Data</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div><!-- /.panel-green -->

			<div class="col-lg-6 col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-check-circle fa-3x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge"><?php echo $std; ?></div>
								<div>
									<h4>SUPPORT DOCUMENT</h4>
								</div>
							</div>
						</div>
					</div>
					<a href="std.php">
						<div class="panel-footer">
							<span class="pull-left">Lihat Data</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div><!-- /.panel-green -->

			<div class="col-lg-6 col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-check-circle fa-3x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge"><?php echo $msds; ?></div>
								<div>
									<h4>MSDS</h4>
								</div>
							</div>
						</div>
					</div>
					<a href="msds.php">
						<div class="panel-footer">
							<span class="pull-left">Lihat Data</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div><!-- /.panel-green -->

			<div class="col-lg-6 col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-check-circle fa-3x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge"><?php echo $coa ?></div>
								<div>
									<h4>Certificate of Analysis (COA)</h4>
								</div>
							</div>
						</div>
					</div>
					<a href="coa.php">
						<div class="panel-footer">
							<span class="pull-left">Lihat Data</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>


		</div><!-- /.row -->

	</div><!-- /.container-fluid -->
</div><!-- /#page-wrapper -->
<!-- bottom of file -->
<?php
include("layout_bottom.php");
?>