<<<<<<< HEAD
<?php
session_start();
$pagedesc = "Login";

// HAPUS debug session yang mengganggu tampilan
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
?>
=======
<?php $pagedesc = "Login"; ?>
>>>>>>> temp-branch
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

<<<<<<< HEAD
	<!-- Animate CSS -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="dist/css/offline-font.css" rel="stylesheet">
	<link href="dist/css/custom.css" rel="stylesheet">

	<!-- Custom Login CSS -->
	<style>
		body {
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			min-height: 100vh;
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
			padding-top: 60px;
		}

		.login-wrapper {
			display: flex;
			justify-content: center;
			align-items: center;
			min-height: calc(100vh - 120px);
		}

		.login-container {
			animation: fadeInDown 0.8s;
			max-width: 400px;
			width: 100%;
		}

		.login-card {
			background: rgba(255, 255, 255, 0.95);
			border-radius: 15px;
			box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
			padding: 40px 30px;
			border: none;
			transition: transform 0.3s;
		}

		.login-card:hover {
			transform: translateY(-5px);
		}

		.logo-container {
			text-align: center;
			margin-bottom: 30px;
		}

		.logo-container img {
			transition: transform 0.5s;
			animation: pulse 2s infinite;
		}

		@keyframes pulse {
			0% {
				transform: scale(1);
			}

			50% {
				transform: scale(1.05);
			}

			100% {
				transform: scale(1);
			}
		}

		.form-control {
			border-radius: 25px;
			padding: 12px 20px;
			border: 2px solid #e1e5eb;
			transition: all 0.3s;
		}

		.form-control:focus {
			border-color: #667eea;
			box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
		}

		.btn-login {
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			border: none;
			border-radius: 25px;
			padding: 12px;
			color: white;
			font-weight: 600;
			letter-spacing: 1px;
			transition: all 0.3s;
			width: 100%;
			margin-top: 10px;
		}

		.btn-login:hover {
			transform: translateY(-2px);
			box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
		}

		.btn-login:active {
			transform: translateY(0);
		}

		.alert {
			border-radius: 10px;
			animation: fadeIn 0.5s;
			margin-bottom: 20px;
		}

		.alert-dismissible .close {
			padding: 0.75rem 1.25rem;
		}

		.footer-bottom {
			position: fixed;
			bottom: 0;
			width: 100%;
			background: rgba(0, 0, 0, 0.2);
			border-top: 1px solid rgba(255, 255, 255, 0.1);
		}

		.footer-bottom p {
			margin: 10px 0;
			color: rgba(255, 255, 255, 0.8) !important;
		}

		@keyframes fadeInDown {
			from {
				opacity: 0;
				transform: translateY(-30px);
			}

			to {
				opacity: 1;
				transform: translateY(0);
			}
		}

		@keyframes fadeIn {
			from {
				opacity: 0;
			}

			to {
				opacity: 1;
			}
		}
	</style>

=======
>>>>>>> temp-branch
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
<<<<<<< HEAD
	<div class="login-wrapper">
		<div class="login-container">
			<!-- Alert Container di atas form -->
			<div id="alert-container">
				<?php
				// Tampilkan alert jika ada dari session
				if (isset($_SESSION['alert'])) {
					$alert_type = isset($_SESSION['alert_type']) ? $_SESSION['alert_type'] : 'warning';

					echo '<div class="alert alert-' . $alert_type . ' alert-dismissible fade in" role="alert">';
					echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
					echo '<span aria-hidden="true">&times;</span>';
					echo '</button>';

					// Icon berdasarkan tipe alert
					if ($alert_type == 'success') {
						echo '<i class="fa fa-check-circle"></i> ';
					} elseif ($alert_type == 'danger') {
						echo '<i class="fa fa-exclamation-triangle"></i> ';
					} elseif ($alert_type == 'warning') {
						echo '<i class="fa fa-exclamation-circle"></i> ';
					} else {
						echo '<i class="fa fa-info-circle"></i> ';
					}

					echo $_SESSION['alert'];
					echo '</div>';

					// Hapus session alert setelah ditampilkan
					unset($_SESSION['alert']);
					unset($_SESSION['alert_type']);
				}

				// Tampilkan pesan expired session
				if (isset($_GET['expired'])) {
					echo '<div class="alert alert-info alert-dismissible fade in" role="alert">';
					echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
					echo '<span aria-hidden="true">&times;</span>';
					echo '</button>';
					echo '<i class="fa fa-info-circle"></i> Sesi telah berakhir. Silakan login kembali.';
					echo '</div>';
				}
				?>
			</div>

			<div class="login-card">
				<div class="logo-container">
					<img src="libs/images/1.png" width="160" height="120">
					<h2 class="text-center" style="margin-top: 20px; color: #333;">
						<b>GRADE CHART DATA</b>
					</h2>
					<p class="text-muted text-center">Silakan login untuk melanjutkan</p>
				</div>

				<form action="login_auth.php" method="post"  id="loginForm">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon" style="border-radius: 25px 0 0 25px; border: 2px solid #e1e5eb; border-right: none; background: #f8f9fa; padding: 0 15px;">
								<i class="fa fa-user" style="line-height: 38px;"></i>
							</span>
							<input type="text" class="form-control" name="username"
								value="user" required autofocus style="border-radius: 0 25px 25px 0;">
						</div>
					</div>

					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon" style="border-radius: 25px 0 0 25px; border: 2px solid #e1e5eb; border-right: none; background: #f8f9fa; padding: 0 15px;">
								<i class="fa fa-lock" style="line-height: 38px;"></i>
							</span>
							<input type="password" class="form-control" name="password"  
								value="password" required style="border-radius: 0 25px 25px 0;">
						</div>
					</div>

					<div class="form-group">
						<button type="submit" class="btn btn-login" name="login" id="loginBtn">
							<i class="fa fa-sign-in"></i> MASUK
						</button>
					</div>

					<!-- Info login untuk testing -->
					<div class="text-center mt-3">
						<small class="text-muted">
							<button type="button" class="btn btn-xs btn-link" id="showTestCredential">
								<i class="fa fa-key"></i> Lihat credential testing
							</button>
						</small>
						<div id="testCredential" style="display: none; margin-top: 10px; padding: 10px; background: #f8f9fa; border-radius: 5px;">
							<small>
								<strong>Username:</strong> admin, manager, supervisor, user1<br>
								<strong>Password:</strong> password (untuk semua user)
							</small>
						</div>
					</div>
				</form>
			</div>

			<div class="text-center mt-3">
				<small style="color: rgba(255, 255, 255, 0.8);">
					&copy; <?php echo date('Y'); ?> Grade Chart Data
				</small>
=======
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
>>>>>>> temp-branch
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

<<<<<<< HEAD
			// Toggle test credential
			$('#showTestCredential').click(function() {
				$('#testCredential').slideToggle();
			});

			// Validasi form sebelum submit
			$('#loginForm').submit(function(e) {
				var username = $('#username').val().trim();
				var password = $('#password').val().trim();

				if (username === '' || password === '') {
					e.preventDefault();

					// Tampilkan alert
					var alertHtml = '<div class="alert alert-warning alert-dismissible fade in" role="alert">' +
						'<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
						'<span aria-hidden="true">&times;</span>' +
						'</button>' +
						'<i class="fa fa-exclamation-circle"></i> Username dan password harus diisi!' +
						'</div>';

					$('#alert-container').html(alertHtml);

					// Animasi shake pada input kosong
					if (username === '') {
						$('#username').addClass('animate__animated animate__shakeX');
						setTimeout(function() {
							$('#username').removeClass('animate__animated animate__shakeX');
						}, 1000);
					}

					if (password === '') {
						$('#password').addClass('animate__animated animate__shakeX');
						setTimeout(function() {
							$('#password').removeClass('animate__animated animate__shakeX');
						}, 1000);
					}

=======
			// Prevent form submission with Enter key on dropdown
			$('select[name="akses"]').keypress(function(e) {
				if (e.which === 13) {
					e.preventDefault();
>>>>>>> temp-branch
					return false;
				}
			});

<<<<<<< HEAD
			// Auto dismiss alert setelah 5 detik
			setTimeout(function() {
				$('.alert').alert('close');
			}, 5000);

			// Debug: Tampilkan form data saat submit (untuk testing)
			$('#loginForm').on('submit', function() {
				console.log('Form submitted with:', {
					username: $('#username').val(),
					password: $('#password').val()
				});
			});
=======
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
>>>>>>> temp-branch
		});
	</script>
</body>

</html>