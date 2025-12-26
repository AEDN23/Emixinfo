<?php
session_start();
$pagedesc = "Login";

// HAPUS debug session yang mengganggu tampilan
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>grade chart data - <?php echo $pagedesc ?></title>

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
				$(this).css('opacity', '0').delay(i * 200).animate({
					opacity: 1
				}, 600);
			});

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

			// Debug: Tampilkan form data saat submit (untuk testing)
			$('#loginForm').on('submit', function() {
				console.log('Form submitted with:', {
					username: $('#username').val(),
					password: $('#password').val()
				});
			});
		});
	</script>
</body>

</html>