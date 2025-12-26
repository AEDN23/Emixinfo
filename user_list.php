<?php
// session_start();
include "check_session.php";


// Cek role admin
if ($_SESSION['role'] !== 'admin') {
    $_SESSION['alert'] = "Akses ditolak! Hanya admin yang bisa mengakses.";
    $_SESSION['alert_type'] = "danger";
    header("Location: index.php");
    exit;
}

include "dist/config/koneksi.php";

// Delete user
if (isset($_GET['delete'])) {
    $delete_id = mysqli_real_escape_string($conn, $_GET['delete']);

    // Prevent deleting yourself
    if ($delete_id == $_SESSION['user_id']) {
        $_SESSION['alert'] = "Tidak bisa menghapus akun sendiri!";
        $_SESSION['alert_type'] = "danger";
        header("Location: users_list.php");
        exit;
    }

    $delete_query = mysqli_query($conn, "DELETE FROM users WHERE id = '$delete_id'");
    if ($delete_query) {
        $_SESSION['alert'] = "User berhasil dihapus!";
        $_SESSION['alert_type'] = "success";
    } else {
        $_SESSION['alert'] = "Gagal menghapus user: " . mysqli_error($conn);
        $_SESSION['alert_type'] = "danger";
    }
    header("Location: users_list.php");
    exit;
}

// Fetch all users
$query = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen User - Grade Chart Data</title>

    <!-- Bootstrap Core CSS -->
    <link href="libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="libs/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap.min.css" rel="stylesheet">

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

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 8px;
            padding: 8px 20px;
            font-weight: 600;
        }

        .btn-success {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            border: none;
            border-radius: 8px;
            padding: 8px 20px;
            font-weight: 600;
        }

        .btn-warning {
            background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
            border: none;
            border-radius: 8px;
            padding: 8px 20px;
            font-weight: 600;
        }

        .btn-danger {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            border: none;
            border-radius: 8px;
            padding: 8px 20px;
            font-weight: 600;
        }

        .badge-success {
            background-color: #28a745;
        }

        .badge-danger {
            background-color: #dc3545;
        }

        .badge-primary {
            background-color: #007bff;
        }

        .badge-warning {
            background-color: #ffc107;
            color: #212529;
        }

        .badge-info {
            background-color: #17a2b8;
        }

        table.dataTable {
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #dee2e6;
        }

        table.dataTable thead th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
            color: #495057;
        }

        .dataTables_wrapper .dataTables_filter input {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 5px 10px;
        }

        .page-title {
            color: #333;
            font-weight: 600;
            margin-bottom: 20px;
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
            <div class="col-md-12">
                <!-- Breadcrumb -->
                <ol class="breadcrumb" style="background: white; border-radius: 8px; padding: 15px;">
                    <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                    <li class="active"><i class="fa fa-users"></i> Manajemen User</li>
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
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h3><i class="fa fa-users"></i> Daftar User</h3>
                            <p class="mb-0" style="opacity: 0.9;">Kelola semua user dalam sistem</p>
                        </div>
                        <div>
                            <a href="create_user.php" class="btn btn-success">
                                <i class="fa fa-user-plus"></i> TAMBAH USER
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="usersTable" class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Nama Lengkap</th>
                                        <th>Role</th>
                                        <th>Department</th>
                                        <th>Status</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    while ($row = mysqli_fetch_assoc($query)):
                                        // Determine badge class for role
                                        $role_badge = '';
                                        switch ($row['role']) {
                                            case 'admin':
                                                $role_badge = 'badge-danger';
                                                break;
                                            case 'manager':
                                                $role_badge = 'badge-primary';
                                                break;
                                            case 'supervisor':
                                                $role_badge = 'badge-warning';
                                                break;
                                            case 'user':
                                                $role_badge = 'badge-info';
                                                break;
                                            default:
                                                $role_badge = 'badge-secondary';
                                        }

                                        // Status badge
                                        $status_badge = $row['status'] == 'aktif' ? 'badge-success' : 'badge-danger';
                                        $status_text = $row['status'] == 'aktif' ? 'Aktif' : 'Nonaktif';
                                    ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><strong><?php echo htmlspecialchars($row['username']); ?></strong></td>
                                            <td><?php echo htmlspecialchars($row['nama_lengkap']); ?></td>
                                            <td>
                                                <span class="badge <?php echo $role_badge; ?>">
                                                    <?php echo strtoupper($row['role']); ?>
                                                </span>
                                            </td>
                                            <td><?php echo htmlspecialchars($row['dept']); ?></td>
                                            <td>
                                                <span class="badge <?php echo $status_badge; ?>">
                                                    <?php echo $status_text; ?>
                                                </span>
                                            </td>
                                            <td><?php echo date('d/m/Y', strtotime($row['created_at'])); ?></td>
                                            <td>
                                                <a href="create_user.php?edit=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                                <?php if ($row['id'] != $_SESSION['user_id']): ?>
                                                    <a href="users_list.php?delete=<?php echo $row['id']; ?>"
                                                        class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Yakin ingin menghapus user <?php echo $row['username']; ?>?')">
                                                        <i class="fa fa-trash"></i> Hapus
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Stats Card -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="card text-white bg-primary">
                            <div class="card-body">
                                <h1 class="text-center">
                                    <?php
                                    $total_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM users");
                                    $total = mysqli_fetch_assoc($total_query);
                                    echo $total['total'];
                                    ?>
                                </h1>
                                <p class="text-center mb-0">Total User</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-success">
                            <div class="card-body">
                                <h1 class="text-center">
                                    <?php
                                    $active_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM users WHERE status='aktif'");
                                    $active = mysqli_fetch_assoc($active_query);
                                    echo $active['total'];
                                    ?>
                                </h1>
                                <p class="text-center mb-0">User Aktif</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-warning">
                            <div class="card-body">
                                <h1 class="text-center">
                                    <?php
                                    $admin_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM users WHERE role='admin'");
                                    $admin = mysqli_fetch_assoc($admin_query);
                                    echo $admin['total'];
                                    ?>
                                </h1>
                                <p class="text-center mb-0">Admin</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-info">
                            <div class="card-body">
                                <h1 class="text-center">
                                    <?php
                                    $today_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM users WHERE DATE(created_at) = CURDATE()");
                                    $today = mysqli_fetch_assoc($today_query);
                                    echo $today['total'];
                                    ?>
                                </h1>
                                <p class="text-center mb-0">User Hari Ini</p>
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

    <!-- DataTables JavaScript -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap.min.js"></script>

    <!-- Custom Script -->
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#usersTable').DataTable({
                "language": {
                    "lengthMenu": "Tampilkan _MENU_ user per halaman",
                    "zeroRecords": "Tidak ada data ditemukan",
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                    "infoEmpty": "Tidak ada data tersedia",
                    "infoFiltered": "(disaring dari _MAX_ total user)",
                    "search": "Cari:",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Berikutnya",
                        "previous": "Sebelumnya"
                    }
                },
                "pageLength": 10,
                "order": [
                    [0, "asc"]
                ]
            });

            // Auto-hide alert after 5 seconds
            setTimeout(function() {
                $('.alert').alert('close');
            }, 5000);
        });
    </script>
</body>

</html>