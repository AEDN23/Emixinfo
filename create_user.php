<?php
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

// Cek role admin
if ($_SESSION['role'] !== 'admin') {
    $_SESSION['alert'] = "Akses ditolak! Hanya admin yang bisa mengakses.";
    $_SESSION['alert_type'] = "danger";
    header("Location: index.php");
    exit;
}

include "dist/config/koneksi.php";

// Departments available
$departments = ['IT', 'Produksi', 'Marketing', 'Finance', 'HRD', 'Manajemen', 'Quality Control', 'Logistik', 'Purchasing', 'Maintenance'];

// Roles available
$roles = [
    'admin' => 'Administrator',
    'manager' => 'Manager',
    'supervisor' => 'Supervisor',
    'user' => 'User/Staff'
];

// Status options
$status_options = ['aktif' => 'Aktif', 'nonaktif' => 'Nonaktif'];

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $nama_lengkap = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
    $nip = mysqli_real_escape_string($conn, $_POST['nip']);
    $role = $_POST['role'];
    $dept = $_POST['dept'];
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $no_hp = mysqli_real_escape_string($conn, $_POST['no_hp']);
    $status = $_POST['status'];

    // Validasi
    $errors = [];

    // Validasi required fields
    if (empty($username)) $errors[] = "Username harus diisi";
    if (empty($password)) $errors[] = "Password harus diisi";
    if ($password !== $confirm_password) $errors[] = "Password tidak cocok";
    if (strlen($password) < 6) $errors[] = "Password minimal 6 karakter";
    if (empty($nama_lengkap)) $errors[] = "Nama lengkap harus diisi";
    if (empty($role)) $errors[] = "Role harus dipilih";
    if (empty($dept)) $errors[] = "Department harus dipilih";

    // Cek username sudah ada
    $check = mysqli_query($conn, "SELECT id FROM users WHERE username = '$username'");
    if (mysqli_num_rows($check) > 0) {
        $errors[] = "Username '$username' sudah digunakan";
    }

    // Cek NIP sudah ada (jika diisi)
    if (!empty($nip)) {
        $check_nip = mysqli_query($conn, "SELECT id FROM users WHERE nip = '$nip' AND nip != ''");
        if (mysqli_num_rows($check_nip) > 0) {
            $errors[] = "NIP '$nip' sudah digunakan";
        }
    }

    // Cek email sudah ada (jika diisi)
    if (!empty($email)) {
        $check_email = mysqli_query($conn, "SELECT id FROM users WHERE email = '$email' AND email != ''");
        if (mysqli_num_rows($check_email) > 0) {
            $errors[] = "Email '$email' sudah digunakan";
        }

        // Validasi format email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Format email tidak valid";
        }
    }

    if (empty($errors)) {
        // Hash password
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Insert ke database
        $sql = "INSERT INTO users (username, password, nama_lengkap, nip, role, dept, email, no_hp, status) 
                VALUES ('$username', '$password_hash', '$nama_lengkap', '$nip', '$role', '$dept', '$email', '$no_hp', '$status')";

        if (mysqli_query($conn, $sql)) {
            $_SESSION['alert'] = "User <strong>$username</strong> berhasil ditambahkan!";
            $_SESSION['alert_type'] = "success";
            header("Location: users_list.php");
            exit;
        } else {
            $errors[] = "Gagal menyimpan data: " . mysqli_error($conn);
        }
    }

    if (!empty($errors)) {
        $error_message = implode("<br>", $errors);
        $_SESSION['alert'] = $error_message;
        $_SESSION['alert_type'] = "danger";
    }
}

// Jika ada GET parameter untuk edit
$edit_mode = false;
$edit_data = [];
if (isset($_GET['edit'])) {
    $edit_id = mysqli_real_escape_string($conn, $_GET['edit']);
    $query = mysqli_query($conn, "SELECT * FROM users WHERE id = '$edit_id'");
    if (mysqli_num_rows($query) > 0) {
        $edit_mode = true;
        $edit_data = mysqli_fetch_assoc($query);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $edit_mode ? 'Edit User' : 'Tambah User'; ?> - Grade Chart Data</title>

    <!-- Bootstrap Core CSS -->
    <link href="libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="libs/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border: none;
            margin-bottom: 30px;
        }

        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 10px 10px 0 0 !important;
            padding: 20px;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 10px 15px;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 8px;
            padding: 10px 25px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-secondary {
            border-radius: 8px;
            padding: 10px 25px;
        }

        .input-group-text {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-right: none;
        }

        .input-group .form-control:first-child {
            border-left: none;
        }

        .alert {
            border-radius: 8px;
            border: none;
        }

        .page-title {
            color: #333;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .required::after {
            content: " *";
            color: #dc3545;
        }

        .form-label {
            font-weight: 500;
            color: #555;
            margin-bottom: 8px;
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-static-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand text-white" href="index.php">
                    <i class="fa fa-home"></i> Dashboard
                </a>
            </div>
            <div class="navbar-right">
                <span class="navbar-text text-white">
                    <i class="fa fa-user"></i> <?php echo $_SESSION['nama_lengkap']; ?> (<?php echo $_SESSION['role']; ?>)
                </span>
            </div>
        </div>
    </nav>

    <div class="container-fluid" style="padding-top: 20px;">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <!-- Breadcrumb -->
                <ol class="breadcrumb" style="background: white; border-radius: 8px; padding: 15px;">
                    <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                    <li><a href="users_list.php"><i class="fa fa-users"></i> Manajemen User</a></li>
                    <li class="active"><i class="fa fa-user-plus"></i> <?php echo $edit_mode ? 'Edit User' : 'Tambah User Baru'; ?></li>
                </ol>

                <!-- Alert Messages -->
                <?php if (isset($_SESSION['alert'])): ?>
                    <div class="alert alert-<?php echo $_SESSION['alert_type']; ?> alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <i class="fa fa-<?php echo $_SESSION['alert_type'] == 'success' ? 'check-circle' : 'exclamation-triangle'; ?>"></i>
                        <?php echo $_SESSION['alert']; ?>
                    </div>
                    <?php
                    unset($_SESSION['alert']);
                    unset($_SESSION['alert_type']);
                    ?>
                <?php endif; ?>

                <!-- Main Card -->
                <div class="card">
                    <div class="card-header">
                        <h3><i class="fa <?php echo $edit_mode ? 'fa-user-edit' : 'fa-user-plus'; ?>"></i>
                            <?php echo $edit_mode ? 'Edit Data User' : 'Tambah User Baru'; ?>
                        </h3>
                        <p class="mb-0" style="opacity: 0.9;">
                            <?php echo $edit_mode ? 'Perbarui data user yang sudah ada' : 'Isi form di bawah untuk menambahkan user baru'; ?>
                        </p>
                    </div>
                    <div class="card-body" style="padding: 30px;">
                        <form method="POST" action="" id="userForm">
                            <div class="row">
                                <!-- Left Column -->
                                <div class="col-md-6">
                                    <!-- Username -->
                                    <div class="form-group">
                                        <label class="form-label required">Username</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </span>
                                            <input type="text" name="username" class="form-control"
                                                placeholder="Masukkan username"
                                                value="<?php echo $edit_mode ? htmlspecialchars($edit_data['username']) : ''; ?>"
                                                required <?php echo $edit_mode ? 'readonly' : ''; ?>>
                                        </div>
                                        <small class="text-muted">Username untuk login (tidak bisa diubah)</small>
                                    </div>

                                    <!-- Password -->
                                    <div class="form-group">
                                        <label class="form-label <?php echo !$edit_mode ? 'required' : ''; ?>">Password</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-lock"></i>
                                            </span>
                                            <input type="password" name="password" class="form-control"
                                                placeholder="<?php echo $edit_mode ? 'Kosongkan jika tidak ingin mengubah' : 'Masukkan password'; ?>"
                                                <?php echo !$edit_mode ? 'required' : ''; ?>>
                                        </div>
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="form-group">
                                        <label class="form-label <?php echo !$edit_mode ? 'required' : ''; ?>">Konfirmasi Password</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-lock"></i>
                                            </span>
                                            <input type="password" name="confirm_password" class="form-control"
                                                placeholder="<?php echo $edit_mode ? 'Kosongkan jika tidak ingin mengubah' : 'Ulangi password'; ?>"
                                                <?php echo !$edit_mode ? 'required' : ''; ?>>
                                        </div>
                                    </div>

                                    <!-- Nama Lengkap -->
                                    <div class="form-group">
                                        <label class="form-label required">Nama Lengkap</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-id-card"></i>
                                            </span>
                                            <input type="text" name="nama_lengkap" class="form-control"
                                                placeholder="Masukkan nama lengkap"
                                                value="<?php echo $edit_mode ? htmlspecialchars($edit_data['nama_lengkap']) : ''; ?>"
                                                required>
                                        </div>
                                    </div>

                                    <!-- NIP -->
                                    <div class="form-group">
                                        <label class="form-label">NIP</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-id-badge"></i>
                                            </span>
                                            <input type="text" name="nip" class="form-control"
                                                placeholder="Masukkan NIP (opsional)"
                                                value="<?php echo $edit_mode ? htmlspecialchars($edit_data['nip']) : ''; ?>">
                                        </div>
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="col-md-6">
                                    <!-- Role -->
                                    <div class="form-group">
                                        <label class="form-label required">Role</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-user-tag"></i>
                                            </span>
                                            <select name="role" class="form-control" required>
                                                <option value="">Pilih Role</option>
                                                <?php foreach ($roles as $key => $value): ?>
                                                    <option value="<?php echo $key; ?>"
                                                        <?php echo ($edit_mode && $edit_data['role'] == $key) ? 'selected' : ''; ?>>
                                                        <?php echo $value; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Department -->
                                    <div class="form-group">
                                        <label class="form-label required">Department</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-building"></i>
                                            </span>
                                            <select name="dept" class="form-control" required>
                                                <option value="">Pilih Department</option>
                                                <?php foreach ($departments as $dept): ?>
                                                    <option value="<?php echo $dept; ?>"
                                                        <?php echo ($edit_mode && $edit_data['dept'] == $dept) ? 'selected' : ''; ?>>
                                                        <?php echo $dept; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="form-group">
                                        <label class="form-label">Email</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-envelope"></i>
                                            </span>
                                            <input type="email" name="email" class="form-control"
                                                placeholder="Masukkan email (opsional)"
                                                value="<?php echo $edit_mode ? htmlspecialchars($edit_data['email']) : ''; ?>">
                                        </div>
                                    </div>

                                    <!-- No. HP -->
                                    <div class="form-group">
                                        <label class="form-label">No. Handphone</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-phone"></i>
                                            </span>
                                            <input type="text" name="no_hp" class="form-control"
                                                placeholder="Masukkan nomor handphone (opsional)"
                                                value="<?php echo $edit_mode ? htmlspecialchars($edit_data['no_hp']) : ''; ?>">
                                        </div>
                                    </div>

                                    <!-- Status -->
                                    <div class="form-group">
                                        <label class="form-label required">Status</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-circle"></i>
                                            </span>
                                            <select name="status" class="form-control" required>
                                                <?php foreach ($status_options as $key => $value): ?>
                                                    <option value="<?php echo $key; ?>"
                                                        <?php echo ($edit_mode && $edit_data['status'] == $key) ? 'selected' : ''; ?>>
                                                        <?php echo $value; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                    <div class="form-group text-center">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            <i class="fa fa-save"></i>
                                            <?php echo $edit_mode ? 'UPDATE USER' : 'SIMPAN USER'; ?>
                                        </button>
                                        <a href="users_list.php" class="btn btn-secondary btn-lg">
                                            <i class="fa fa-arrow-left"></i> KEMBALI
                                        </a>
                                        <?php if ($edit_mode): ?>
                                            <a href="create_user.php" class="btn btn-success btn-lg">
                                                <i class="fa fa-user-plus"></i> TAMBAH BARU
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <?php if ($edit_mode): ?>
                                <input type="hidden" name="edit_id" value="<?php echo $edit_data['id']; ?>">
                            <?php endif; ?>
                        </form>
                    </div>
                </div>

                <!-- Help Card -->
                <div class="card">
                    <div class="card-header" style="background: #f8f9fa; color: #333;">
                        <h4><i class="fa fa-info-circle"></i> Informasi</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <h5><i class="fa fa-key text-primary"></i> Hak Akses Role:</h5>
                                <ul class="list-unstyled">
                                    <li><strong>Admin:</strong> Akses penuh ke semua fitur</li>
                                    <li><strong>Manager:</strong> Akses laporan dan monitoring</li>
                                    <li><strong>Supervisor:</strong> Akses tim dan tugas</li>
                                    <li><strong>User:</strong> Akses terbatas sesuai departemen</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h5><i class="fa fa-shield text-success"></i> Keamanan:</h5>
                                <ul class="list-unstyled">
                                    <li>Password minimal 6 karakter</li>
                                    <li>Password di-hash dengan algoritma aman</li>
                                    <li>Username harus unik</li>
                                    <li>Email dan NIP harus unik jika diisi</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h5><i class="fa fa-lightbulb text-warning"></i> Tips:</h5>
                                <ul class="list-unstyled">
                                    <li>Gunakan username yang mudah diingat</li>
                                    <li>Password default bisa diubah nanti</li>
                                    <li>Status nonaktif untuk menonaktifkan user</li>
                                    <li>Pastikan email valid untuk reset password</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer" style="background: #333; color: white; padding: 20px 0; margin-top: 30px;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p>&copy; <?php echo date('Y'); ?> Grade Chart Data System</p>
                </div>
                <div class="col-md-6 text-right">
                    <p>Version 1.0.0 | User Management Module</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="libs/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="libs/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Custom Script -->
    <script>
        $(document).ready(function() {
            // Password confirmation validation
            $('#userForm').submit(function(e) {
                var password = $('input[name="password"]').val();
                var confirm_password = $('input[name="confirm_password"]').val();

                if (password !== '' && password !== confirm_password) {
                    e.preventDefault();
                    alert('Password dan konfirmasi password tidak cocok!');
                    return false;
                }

                // Show loading
                $('button[type="submit"]').html('<i class="fa fa-spinner fa-spin"></i> Processing...');
                $('button[type="submit"]').prop('disabled', true);
            });

            // Auto-hide alert after 5 seconds
            setTimeout(function() {
                $('.alert').alert('close');
            }, 5000);

            // Character counter for username
            $('input[name="username"]').on('input', function() {
                var username = $(this).val();
                if (username.length < 3) {
                    $(this).css('border-color', '#ffc107');
                } else {
                    $(this).css('border-color', '#28a745');
                }
            });

            // Password strength indicator
            $('input[name="password"]').on('input', function() {
                var password = $(this).val();
                var strength = 0;

                if (password.length >= 6) strength++;
                if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
                if (password.match(/\d/)) strength++;
                if (password.match(/[^a-zA-Z\d]/)) strength++;

                var colors = ['#dc3545', '#ffc107', '#28a745', '#28a745'];
                $(this).css('border-color', colors[strength]);
            });
        });
    </script>
</body>

</html>