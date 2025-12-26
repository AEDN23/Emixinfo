<?php $pagedesc = "Login"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Login Page - Grade Chart Data">
	<meta name="author" content="">

	<title>Grade Chart Data - <?php echo $pagedesc ?></title>

	<link href="libs/images/icon.ico" rel="icon" type="images/x-icon">

	<!-- Bootstrap Core CSS -->
	<link href="libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="libs/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<!-- jQuery -->
	<script src="libs/jquery/dist/jquery.min.js"></script>

	<style>
		/* Reset body and html for full page */
		html,
		body {
			height: 100%;
			margin: 0;
			padding: 0;
			overflow: hidden;
			/* Prevent scrolling */
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
		}

		body {
			background-color: #f1f4f7;
			display: flex;
			flex-direction: column;
		}

		/* Main content container */
		.main-container {
			display: flex;
			flex: 1;
			align-items: center;
			justify-content: center;
			padding: 20px;
		}

		/* Login box styling */
		.login-box {
			background-color: #ffffff;
			border-radius: 8px;
			box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
			padding: 40px;
			width: 100%;
			max-width: 400px;
			margin: 0 auto;
		}

		/* Logo styling */
		.logo-container {
			text-align: center;
			margin-bottom: 25px;
		}

		.logo-container img {
			width: 140px;
			height: auto;
			margin-bottom: 15px;
		}

		.logo-container h2 {
			color: #333;
			font-weight: 700;
			font-size: 24px;
			margin-top: 0;
		}

		/* Form styling */
		.form-group {
			margin-bottom: 20px;
		}

		.form-control {
			height: 45px;
			border-radius: 4px;
			border: 1px solid #ddd;
			padding-left: 15px;
			font-size: 15px;
			transition: all 0.3s;
		}

		.form-control:focus {
			border-color: #4CAF50;
			box-shadow: 0 0 0 0.2rem rgba(76, 175, 80, 0.25);
		}

		.btn-success {
			background-color: #4CAF50;
			border-color: #4CAF50;
			height: 45px;
			font-size: 16px;
			font-weight: 600;
			transition: all 0.3s;
		}

		.btn-success:hover {
			background-color: #3d8b40;
			border-color: #3d8b40;
			transform: translateY(-2px);
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
		}

		/* Footer styling */
		.footer-bottom {
			background-color: #333;
			color: #D1C4E9;
			padding: 15px 0;
			text-align: center;
			width: 100%;
		}

		/* Alert styling */
		.alert-container {
			max-width: 400px;
			margin: 0 auto 20px;
		}

		/* Responsive adjustments */
		@media (max-height: 700px) {
			.login-box {
				padding: 25px;
			}

			.logo-container img {
				width: 100px;
			}

			.logo-container h2 {
				font-size: 20px;
			}
		}

		@media (max-width: 480px) {
			.main-container {
				padding: 10px;
			}

			.login-box {
				padding: 25px 20px;
				box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
			}
		}
	</style>
</head>

<body>
	<!-- Main content area -->
	<div class="main-container">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
					<!-- Alert messages (if any) -->
					<div class="alert-container">
						<?php include("layout_alert.php"); ?>
					</div>

					<!-- Login box -->
					<div class="login-box">
						<div class="logo-container">
							<img src="libs/images/1.png" alt="Grade Chart Data Logo">
							<h2>GRADE CHART DATA</h2>
						</div>

						<div class="panel panel-default" style="border: none; box-shadow: none;">
							<div class="panel-body" style="padding: 0;">
								<form action="login_auth.php" method="post">
									<div class="form-group">
										<input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
									</div>
									<div class="form-group">
										<input type="password" class="form-control" name="password" placeholder="Password" required>
									</div>
									<div class="form-group">
										<input type="submit" class="btn btn-success btn-block" name="login" value="Masuk">
									</div>
								</form>
								<div class="form-group">
									<a href="register"><button class="btn btn-primary btn-block">register</button></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Footer -->
	<div class="footer-bottom">
		<div class="container">
			<p style="margin: 0; padding: 0;"><small>© <?php echo date("Y"); ?> Grade Chart Data</small></p>
		</div>
	</div>

	<!-- Bootstrap Core JavaScript -->
	<script src="libs/bootstrap/dist/js/bootstrap.min.js"></script>

	<!-- Custom JavaScript for better UX -->
	<script>
		$(document).ready(function() {
			// Add animation to form elements on focus
			$('.form-control').focus(function() {
				$(this).parent().addClass('focused');
			}).blur(function() {
				$(this).parent().removeClass('focused');
			});

			// Prevent form submission with Enter key on dropdown
			$('select[name="akses"]').keypress(function(e) {
				if (e.which === 13) {
					e.preventDefault();
					return false;
				}
			});

			// Ensure the page doesn't scroll on small screens
			function checkHeight() {
				var windowHeight = $(window).height();
				var bodyHeight = $('body').height();

				if (bodyHeight > windowHeight) {
					$('body').css('overflow-y', 'auto');
				} else {
					$('body').css('overflow-y', 'hidden');
				}
			}

			// Check height on load and resize
			checkHeight();
			$(window).resize(checkHeight);
		});
	</script>
</body>

</html>