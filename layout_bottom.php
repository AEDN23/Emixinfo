<!-- layout_alert.php -->
<?php
session_start();
$pagedesc = "Login";
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Grade Chart Data - <?php echo $pagedesc ?></title>

	<link href="libs/images/icon.ico" rel="icon" type="images/x-icon">

	<!-- Bootstrap Core CSS -->
	<link href="libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

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
			display: flex;
			align-items: center;
			justify-content: center;
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
			animation: bounceIn 1s;
		}

		.logo-container img {
			transition: transform 0.5s;
		}

		.logo-container img:hover {
			transform: scale(1.1);
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

		.input-group-addon {
			border-radius: 25px 0 0 25px;
			border: 2px solid #e1e5eb;
			border-right: none;
			background: #f8f9fa;
		}

		.input-group .form-control:first-child {
			border-radius: 0 25px 25px 0;
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

		@keyframes bounceIn {
			0% {
				opacity: 0;
				transform: scale(0.3);
			}

			50% {
				opacity: 1;
				transform: scale(1.05);
			}

			70% {
				transform: scale(0.9);
			}

			100% {
				transform: scale(1);
			}
		}
	</style>

	<!-- Custom Fonts -->
	<link href="libs/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<!-- jQuery -->
	<script src="libs/jquery/dist/jquery.min.js"></script>

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
	<div class="container">
		<div class="login-container">
			<?php
			// Tampilkan alert jika ada
			if (isset($_SESSION['alert'])):
				include("layout_alert.php");
			endif;

			// Tampilkan pesan expired session
			if (isset($_GET['expired'])): ?>
				<div class="row">
					<div class="col-lg-12">
						<div class="alert alert-info alert-dismissible fade in" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<i class="fa fa-info-circle"></i> Sesi telah berakhir. Silakan login kembali.
						</div>
					</div>
				</div>
			<?php endif; ?>

			<div class="login-card">
				<div class="logo-container">
					<img src="libs/images/1.png" width="160" height="120" class="animate__animated animate__pulse">
					<h2 class="text-center" style="margin-top: 20px; color: #333;">
						<b>GRADE CHART DATA</b>
					</h2>
					<p class="text-muted text-center">Silakan login untuk melanjutkan</p>
				</div>

				<form action="login_auth.php" method="post" id="loginForm">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-user"></i>
							</span>
							<input type="text" class="form-control" name="username" id="username"
								placeholder="Username" required autofocus>
						</div>
						<small id="usernameHelp" class="form-text text-muted" style="display: none;">
							<i class="fa fa-info-circle"></i> Gunakan username yang terdaftar
						</small>
					</div>

					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-lock"></i>
							</span>
							<input type="password" class="form-control" name="password" id="password"
								placeholder="Password" required>
						</div>
						<small id="passwordHelp" class="form-text text-muted" style="display: none;">
							<i class="fa fa-info-circle"></i> Password minimal 6 karakter
						</small>
					</div>

					<div class="form-group">
						<button type="submit" class="btn btn-login" name="login" id="loginBtn">
							<i class="fa fa-sign-in"></i> MASUK
						</button>
					</div>

					<div class="text-center">
						<small class="text-muted">
							<i class="fa fa-shield"></i> Sistem terjamin keamanannya
						</small>
					</div>
				</form>
			</div>

			<div class="text-center mt-3">
				<small style="color: rgba(255, 255, 255, 0.8);">
					&copy; <?php echo date('Y'); ?> Grade Chart Data. All rights reserved.
				</small>
			</div>
		</div>
	</div>

	<!-- footer-bottom -->
	<div class="navbar navbar-inverse navbar-fixed-bottom footer-bottom">
		<div class="container text-center">
			<p class="text-center" style="color: #D1C4E9; margin: 0 0 5px; padding: 0">
				<small>Version 1.0.0</small>
			</p>
		</div>
	</div><!-- /.footer-bottom -->

	<!-- Bootstrap Core JavaScript -->
	<script src="libs/bootstrap/dist/js/bootstrap.min.js"></script>

	<!-- Custom Login Script -->
	<script>
		$(document).ready(function() {
			// Animasi form saat halaman dimuat
			$('.form-control').each(function(i) {
				$(this).delay(i * 200).animate({
					opacity: 1
				}, 600);
			});

			// Tampilkan tooltip pada focus
			$('#username').focus(function() {
				$('#usernameHelp').fadeIn(300);
			}).blur(function() {
				if ($(this).val() === '') {
					$('#usernameHelp').fadeOut(300);
				}
			});

			$('#password').focus(function() {
				$('#passwordHelp').fadeIn(300);
			}).blur(function() {
				if ($(this).val() === '') {
					$('#passwordHelp').fadeOut(300);
				}
			});

			// Validasi form sebelum submit
			$('#loginForm').submit(function(e) {
				var username = $('#username').val().trim();
				var password = $('#password').val().trim();

				if (username === '' || password === '') {
					e.preventDefault();

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

					return false;
				}

				// Tampilkan loading pada tombol
				$('#loginBtn').html('<i class="fa fa-spinner fa-spin"></i> MEMUAT...');
				$('#loginBtn').prop('disabled', true);

				return true;
			});

			// Auto dismiss alert setelah 5 detik
			setTimeout(function() {
				$('.alert').alert('close');
			}, 5000);
		});
	</script>
</body>

</html>