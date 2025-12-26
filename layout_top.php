<?php
// setting tanggal
include("sess_check.php");


$haries = array("Sunday" => "Minggu", "Monday" => "Senin", "Tuesday" => "Selasa", "Wednesday" => "Rabu", "Thursday" => "Kamis", "Friday" => "Jum'at", "Saturday" => "Sabtu");
$bulans = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
$bulans_count = count($bulans);
// tanggal bulan dan tahun hari ini
$hari_ini = $haries[date("l")];
$bulan_ini = $bulans[date("n")];
$tanggal = date("d");
$bulan = date("m");
$tahun = date("Y");
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Elastomix Media Info - <?php echo $pagedesc ?></title>

	<link href="libs/images/icon.png" rel="icon" type="images/x-icon">

	<!-- Bootstrap Core CSS -->
	<link href="libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- MetisMenu CSS -->
	<link href="libs/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

	<!-- DataTables CSS -->
	<link href="libs/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

	<!-- DataTables Responsive CSS -->
	<link href="libs/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="dist/css/offline-font.css" rel="stylesheet">
	<link href="dist/css/custom.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="libs/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<!-- jQuery -->
	<script src="libs/jquery/dist/jquery.min.js"></script>

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->




	<style>
		/* tombol profile di navbar */
		.profile-btn-dark {
			width: 38px;
			height: 38px;
			background: #1f2937;
			/* dark */
			color: #e5e7eb;
			display: flex;
			align-items: center;
			justify-content: center;
			border-radius: 6px;
			/* kotak lembut */
			border: 1px solid #374151;
			transition: all 0.2s ease;
		}

		.profile-btn-dark:hover,
		.profile-btn-dark:focus {
			background: #111827;
			color: #cd0a0aff;
			text-decoration: none;
		}

		/* dropdown container */
		.profile-dropdown-dark {
			min-width: 240px;
			background: #111827;
			border-radius: 8px;
			border: 1px solid #1f2937;
			padding: 8px 0;
		}

		/* info user (tanpa foto) */
		.profile-info-dark {
			padding: 12px 16px;
		}

		.profile-name-dark {
			color: #f9fafb;
			font-weight: 600;
			font-size: 14px;
		}

		.profile-role-dark {
			font-size: 12px;
			color: #9ca3af;
		}

		/* item menu */
		.dropdown-item-dark {
			color: #e5e7eb;
			padding: 10px 16px;
			font-size: 14px;
		}

		.dropdown-item-dark:hover {
			background: #1f2937;
			color: #cb0d0dff;
		}

		/* divider */
		.profile-dropdown-dark .dropdown-divider {
			border-color: #1f2937;
		}
	</style>




</head>

<body>

	<div id="wrapper">

		<!-- Navigation -->
		<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand hidden-xs" href="index.php">
					<img src="libs/images/1.png" alt="brand" width="45" class="float-left image-brand">
					<div class="float-right">&nbsp;<strong>PT. Elastomix Indonesia</strong></div>
					<div class="clear-both"></div>
				</a>
				<a class="navbar-brand visible-xs" href="index.php">
					<img src="libs/images/1.png" alt="brand" width="60" class="float-left image-brand">
					<div class="float-right">&nbsp;<strong>PT. Elastomix Indonesia</strong></div>
					<div class="clear-both"></div>
				</a>
			</div><!-- /.navbar-header -->






			<ul class="nav navbar-top-links navbar-right">
				<li class="dropdown">
					<a class="nav-link dropdown-toggle profile-btn-dark"
						data-toggle="dropdown"
						href="#"
						aria-expanded="false">
						<i class="fa fa-user"></i>
					</a>

					<ul class="dropdown-menu dropdown-menu-right profile-dropdown-dark shadow">
						<!-- Info User -->
						<li class="profile-info-dark">
							<div class="profile-name-dark">
								<?php echo $_SESSION['nama'] ?? 'User'; ?>
							</div>
							<div class="profile-role-dark">
								<?php echo $_SESSION['role'] ?? 'Role'; ?>
							</div>
						</li>

						<li class="dropdown-divider"></li>

						<li>
							<?php if ($_SESSION['role'] == 'admin'): ?>
								<a class="dropdown-item dropdown-item-dark" style="color: white;" href="user.php">
									<i class="fa fa-gear mr-2"></i> Pengaturan Akun
								</a>
							<?php endif; ?>
						</li>

						<li>
							<a class="dropdown-item dropdown-item-dark text-danger" style="color: whitesmoke" href="dist/config/logout.php">
								<i class="fa fa-sign-out mr-2"></i> Keluar
							</a>
						</li>
					</ul>
				</li>
			</ul>











			<div class="navbar-default sidebar" role="navigation">
				<div class="sidebar-nav navbar-collapse">
					<ul class="nav" id="side-menu">
						<li class="sidebar-search">
							<h4><br> <b>Data</b></h4>
							<h5 class="text-muted"><i class="fa fa-calendar fa-fw"></i>&nbsp;<?php echo $hari_ini . ", " . $tanggal . " " . $bulan_ini . " " . $tahun ?></h5>
						</li>
						<?php
						if ($pagedesc == "Beranda") {
							echo '<li><a href="index.php" class="active"><i class="fa fa-home fa-fw"></i>&nbsp;Beranda</a></li>';
						} else {
							echo '<li><a href="index.php"><i class="fa fa-home fa-fw"></i>&nbsp;Beranda</a></li>';
						}
						if (isset($menuparent) && $menuparent == "master") {
							echo '<li class="active">';
						} else {
							echo '<li>';
						}
						?>

						<?php
						if (isset($menuparent) && $menuparent == "index") {
							echo '<li class="active">';
						} else {
							echo '<li>';
						}
						?>
						<!-- open <li> tag generated with php, see line 155-160 -->
						<!-- /.nav-second-level -->

						<a href="#"><i class="fa fa-download fa-fw"></i>&nbsp;MENU TREE<span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							<?php
							if ($pagedesc == "Work Instruction") {
								echo '<li><a href="wi.php" class="active">Work Instruction</a></li>';
							} else {
								echo '<li><a href="wi.php">📋 Work Instruction</a></li>';
							}
							if ($pagedesc == "Support Document") {
								echo '<li><a href="std.php" class="active">📎 Support Document</a></li>';
							} else {
								echo '<li><a href="std.php">📎 Support Document</a></li>';
							}
							if ($pagedesc == "MSDS") {
								echo '<li><a href="msds.php" class="active">⚠️ MSDS</a></li>';
							} else {
								echo '<li><a href="msds.php">⚠️ MSDS</a></li>';
							}
							if ($pagedesc == "COA") {
								echo '<li><a href="COA.php" class="active">📜 COA</a></li>';
							} else {
								echo '<li><a href="COA.php">📜 COA</a></li>';
							}

							?>
						</ul><!-- /.nav-second-level -->

						<!-- open <li> tag generated with php, see line 155-160 -->



				</div>
				<!-- /.sidebar-collapse -->
			</div>
			<!-- /.navbar-static-side -->
		</nav>