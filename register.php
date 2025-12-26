<?php
session_start();
require_once 'dist/config/koneksi.php';

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password']; // Jangan escape password karena akan dihash
    $confirm_password = $_POST['confirm_password'];
    $departemen = mysqli_real_escape_string($conn, $_POST['departemen']);

    // Validasi
    $errors = [];

    // Cek apakah password cocok
    if ($password !== $confirm_password) {
        $errors[] = "Password tidak cocok!";
    }

    // Cek apakah username sudah ada
    $check_query = "SELECT * FROM user WHERE username = '$username'";
    $check_result = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($check_result) > 0) {
        $errors[] = "Username sudah digunakan!";
    }

    // Jika tidak ada error, simpan ke database
    if (empty($errors)) {
        // Hash password menggunakan Argon2id
        $hashed_password = password_hash($password, PASSWORD_ARGON2ID);

        // Default role adalah 'user'
        $role = 'user';

        // Gunakan prepared statement untuk keamanan
        $stmt = $conn->prepare("INSERT INTO user (nama, username, password, role, departemen) 
                               VALUES (?, ?, ?, ?, ?)");

        if ($stmt) {
            $stmt->bind_param("sssss", $nama, $username, $hashed_password, $role, $departemen);

            if ($stmt->execute()) {
                $_SESSION['success'] = "Registrasi berhasil! Silakan login.";
                header("Location: login.php");
                exit();
            } else {
                $errors[] = "Terjadi kesalahan saat registrasi: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $errors[] = "Terjadi kesalahan dalam persiapan query: " . $conn->error;
        }
    }

    // Simpan error di session jika ada
    if (!empty($errors)) {
        $_SESSION['error'] = implode("<br>", $errors);
    }
}

$pagedesc = "Register";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Register Page - Grade Chart Data">
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
            /* overflow: hidden; */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        body {
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

        /* Register box styling - lebih kecil */
        .register-box {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 100%;
            max-width: 380px;
            margin: 0 auto;
        }

        /* Logo styling */
        .logo-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo-container img {
            width: 100px;
            height: auto;
            margin-bottom: 10px;
        }

        .logo-container h2 {
            color: #333;
            font-weight: 600;
            font-size: 20px;
            margin-top: 0;
            margin-bottom: 5px;
        }

        .logo-container p {
            color: #666;
            font-size: 13px;
            margin-bottom: 20px;
        }

        /* Form styling */
        .form-group {
            margin-bottom: 15px;
        }

        .form-control {
            height: 40px;
            border-radius: 4px;
            border: 1px solid #ddd;
            padding-left: 12px;
            font-size: 14px;
            transition: all 0.2s;
        }

        .form-control:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 0 0.2rem rgba(76, 175, 80, 0.15);
        }

        .btn-primary {
            background-color: #4CAF50;
            border-color: #4CAF50;
            height: 40px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s;
            margin-top: 5px;
        }

        .btn-primary:hover {
            background-color: #3d8b40;
            border-color: #3d8b40;
            transform: translateY(-1px);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            height: 40px;
            font-size: 14px;
            font-weight: 500;
            margin-top: 5px;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #5a6268;
        }

        /* Simple password match indicator */
        .password-match {
            margin-top: 5px;
            font-size: 12px;
            min-height: 16px;
        }

        .match-ok {
            color: #28a745;
        }

        .match-error {
            color: #dc3545;
        }

        /* Alert styling */
        .alert-container {
            max-width: 380px;
            margin: 0 auto 15px;
        }

        /* Responsive adjustments */
        @media (max-height: 700px) {
            .register-box {
                padding: 25px;
            }

            .logo-container img {
                width: 80px;
            }

            .logo-container h2 {
                font-size: 18px;
            }
        }

        @media (max-width: 480px) {
            .main-container {
                padding: 10px;
            }

            .register-box {
                padding: 20px 15px;
                box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
            }

            .form-control {
                height: 38px;
                font-size: 13px;
            }

            .btn-primary,
            .btn-secondary {
                height: 38px;
                font-size: 13px;
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

                    <!-- Register box -->
                    <div class="register-box">
                        <div class="logo-container">
                            <img src="libs/images/1.png" alt="Grade Chart Data Logo">
                            <h2>REGISTRASI AKUN BARU</h2>
                            <p>Silakan isi form dibawah ini untuk membuat akun</p>
                        </div>

                        <form action="register.php" method="post" id="registerForm">
                            <div class="form-group">
                                <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" required autofocus>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="username" placeholder="Username" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="confirmPassword" name="confirm_password" placeholder="Konfirmasi Password" required>
                                <div class="password-match" id="passwordMatch"></div>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="departemen" required>
                                    <option value="">Pilih Departemen</option>
                                    <option value="Quality & Planning">Quality & Planning</option>
                                    <option value="Warehouse">Warehouse</option>
                                    <option value="PGA IT">PGA & IT</option>
                                    <option value="Production">Production</option>
                                    <option value="Purchasing Logistic">Purchasing Logistic</option>
                                    <option value="HSE">HSE</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                            </div>
                            <div class="form-group">
                                <a href="login.php" class="btn btn-secondary btn-block">Kembali ke Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Core JavaScript -->
    <script src="libs/bootstrap/dist/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            // Add animation to form elements on focus
            $('.form-control').focus(function() {
                $(this).parent().addClass('focused');
            }).blur(function() {
                $(this).parent().removeClass('focused');
            });

            // Simple password match checker
            function checkPasswordMatch() {
                var password = $('#password').val();
                var confirmPassword = $('#confirmPassword').val();

                if (confirmPassword.length === 0) {
                    $('#passwordMatch').html('');
                    return true;
                } else if (password !== confirmPassword) {
                    $('#passwordMatch').html('✗ Password tidak cocok').addClass('match-error').removeClass('match-ok');
                    return false;
                } else {
                    $('#passwordMatch').html('✓ Password cocok').addClass('match-ok').removeClass('match-error');
                    return true;
                }
            }

            // Check password match on keyup
            $('#confirmPassword').on('keyup', checkPasswordMatch);
            $('#password').on('keyup', checkPasswordMatch);

            // Form submission validation
            $('#registerForm').on('submit', function(e) {
                var password = $('#password').val();
                var confirmPassword = $('#confirmPassword').val();

                // Cek apakah password cocok
                if (password !== confirmPassword) {
                    e.preventDefault();
                    alert('Password tidak cocok!');
                    return false;
                }

                return true;
            });
        });
    </script>
</body>

</html>