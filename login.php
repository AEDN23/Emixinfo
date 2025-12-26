<?php
session_start(); // HARUS ada di baris pertama
require_once 'dist/config/koneksi.php';

$pagedesc = "Login";

// LOGIN AUTH - HARUS SEBELUM HTML
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username'])) {
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$password = $_POST['password']; // Jangan escape karena akan diverifikasi dengan hash

	// Query untuk memeriksa user
	$query = "SELECT * FROM user WHERE username = '$username'";
	$result = mysqli_query($conn, $query);

	if (mysqli_num_rows($result) == 1) {
		$user = mysqli_fetch_assoc($result);

		// Verifikasi password dengan password_verify() karena sudah dihash
		if (password_verify($password, $user['password'])) {
			// Set session
			$_SESSION['user_id'] = $user['id'];
			$_SESSION['username'] = $user['username'];
			$_SESSION['nama'] = $user['nama'];
			$_SESSION['role'] = $user['role'];
			$_SESSION['departemen'] = $user['departemen'];
			$_SESSION['login_time'] = time();
			$_SESSION['login'] = true;

			// Redirect ke halaman utama
			header("Location: index");
			exit();
		} else {
			$_SESSION['error'] = "Password salah!";
			header("Location: login");
			exit();
		}
	} else {
		$_SESSION['error'] = "Username tidak ditemukan!";
		header("Location: login");
		exit();
	}
}
?>
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

		.btn-primary {
			background-color: #007bff;
			border-color: #007bff;
			height: 45px;
			font-size: 16px;
			font-weight: 600;
			transition: all 0.3s;
		}

		.btn-primary:hover {
			background-color: #0056b3;
			border-color: #0056b3;
			transform: translateY(-2px);
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
						<?php
						// Tampilkan pesan error jika ada
						if (isset($_SESSION['error'])) {
							echo '<div class="alert alert-danger alert-dismissible fade in" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    ' . $_SESSION['error'] . '
                                  </div>';
							unset($_SESSION['error']);
						}

						// Tampilkan pesan success jika ada
						if (isset($_SESSION['success'])) {
							echo '<div class="alert alert-success alert-dismissible fade in" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    ' . $_SESSION['success'] . '
                                  </div>';
							unset($_SESSION['success']);
						}
						?>
					</div>

					<!-- Login box -->
					<div class="login-box">
						<div class="logo-container">
							<img src="libs/images/1.png" alt="Grade Chart Data Logo">
							<h2>GRADE CHART DATA</h2>
						</div>

						<div class="panel panel-default" style="border: none; box-shadow: none;">
							<div class="panel-body" style="padding: 0;">
								<form action="" method="post">
									<div class="form-group">
										<label for="" style="color: black;">Username:</label>
										<input type="text" class="form-control" name="username" value="user" required autofocus>
									</div>
									<div class="form-group">
										<label for="" style="color: black;">Password</label>
										<input type="password" class="form-control" name="password" value="p@ssw0rd" required>
									</div>
									<div class="form-group">
										<label for="" style="color: black;">Masuk lansung jika login sebagai user</label>

										<button type="submit" class="btn btn-success btn-block" name="login">Masuk</button>
									</div>
								</form>
								<div class="form-group">
									<a href="register"><button type="button" class="btn btn-primary btn-block">Register</button></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
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