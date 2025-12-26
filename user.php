<?php
ob_start();
$pagedesc = "Data Pengguna";
include("layout_top.php");


// hanya admin yang bisa mengakses halaman ini
if ($_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit();
}

// deskripsi halaman


// Pagination
$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Search
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$search_condition = '';
if (!empty($search)) {
    $search_condition = "WHERE (nama LIKE '%$search%' OR username LIKE '%$search%' OR departemen LIKE '%$search%' OR role LIKE '%$search%')";
}

// Query untuk mengambil data user dengan pagination
$sql = "SELECT * FROM user $search_condition ORDER BY id DESC LIMIT $limit OFFSET $offset";
$ress = mysqli_query($conn, $sql);

// Query untuk menghitung total data
$sql_count = "SELECT COUNT(*) as total FROM user $search_condition";
$ress_count = mysqli_query($conn, $sql_count);
$row_count = mysqli_fetch_assoc($ress_count);
$total = $row_count['total'];
$total_pages = ceil($total / $limit);

// Handle delete user
if (isset($_GET['act']) && $_GET['act'] == 'delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    // Cek apakah user yang dihapus bukan diri sendiri
    if ($id != $_SESSION['user_id']) {
        $delete_sql = "DELETE FROM user WHERE id = $id";
        if (mysqli_query($conn, $delete_sql)) {
            $_SESSION['success'] = "Data pengguna berhasil dihapus!";
        } else {
            $_SESSION['error'] = "Gagal menghapus data pengguna!";
        }
    } else {
        $_SESSION['error'] = "Tidak dapat menghapus akun sendiri!";
    }
    header("Location: user.php");
    exit();
}

// Handle edit user
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit'])) {
    $id = (int)$_POST['id'];
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $departemen = mysqli_real_escape_string($conn, $_POST['departemen']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    // Cek jika username berubah dan sudah ada
    $check_sql = "SELECT id FROM user WHERE username = '$username' AND id != $id";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        $_SESSION['error'] = "Username sudah digunakan oleh pengguna lain!";
    } else {
        $update_sql = "UPDATE user SET nama='$nama', username='$username', departemen='$departemen', role='$role' WHERE id = $id";
        if (mysqli_query($conn, $update_sql)) {
            $_SESSION['success'] = "Data pengguna berhasil diperbarui!";
        } else {
            $_SESSION['error'] = "Gagal memperbarui data pengguna!";
        }
    }
    header("Location: user.php");
    exit();
}

// Handle change password
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change_password'])) {
    $id = (int)$_POST['id'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        $_SESSION['error'] = "Password baru tidak cocok!";
    } else {
        $hashed_password = password_hash($new_password, PASSWORD_ARGON2ID);
        $update_sql = "UPDATE user SET password='$hashed_password' WHERE id = $id";
        if (mysqli_query($conn, $update_sql)) {
            $_SESSION['success'] = "Password berhasil diubah!";
        } else {
            $_SESSION['error'] = "Gagal mengubah password!";
        }
    }
    header("Location: user.php");
    exit();
}
?>

<!-- top of file -->
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?php echo $pagedesc; ?></h1>
            </div><!-- /.col-lg-12 -->
        </div><!-- /.row -->

        <!-- Pesan Alert -->
        <div class="row">
            <div class="col-lg-12">
                <?php
                if (isset($_SESSION['error'])) {
                    echo '<div class="alert alert-danger alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            ' . $_SESSION['error'] . '
                          </div>';
                    unset($_SESSION['error']);
                }

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
        </div>

        <!-- Search Form -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-search"></i> Pencarian Pengguna</h3>
                    </div>
                    <div class="panel-body">
                        <form method="GET" action="user.php" class="form-inline">
                            <div class="form-group">
                                <input type="text" name="search" class="form-control" placeholder="Cari nama, username, departemen..."
                                    value="<?php echo htmlspecialchars($search); ?>" style="width: 300px;">
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-search"></i> Cari
                            </button>

                            <?php if (!empty($search)): ?>
                                <a href="user.php" class="btn btn-default">Reset</a>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Table -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <h3 class="panel-title pull-left" style="margin-top: 8px;">
                            <i class="fa fa-users"></i> Daftar Pengguna
                        </h3>
                        <a href="register.php" class="btn btn-primary pull-right">
                            <i class="fa fa-plus"></i> TAMBAH AKUN
                        </a>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Departemen</th>
                                        <th>Role</th>
                                        <th width="25%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = $offset + 1;
                                    if (mysqli_num_rows($ress) > 0) {
                                        while ($data = mysqli_fetch_array($ress)) {
                                            $id = $data['id'];
                                            $nama = htmlspecialchars($data['nama']);
                                            $username = htmlspecialchars($data['username']);
                                            $departemen = htmlspecialchars($data['departemen']);
                                            $role = htmlspecialchars($data['role']);

                                            // Tentukan badge warna berdasarkan role
                                            $role_badge = ($role == 'admin') ? 'danger' : 'primary';
                                    ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo $nama; ?></td>
                                                <td><?php echo $username; ?></td>
                                                <td><?php echo $departemen; ?></td>
                                                <td>
                                                    <span class="label label-<?php echo $role_badge; ?>">
                                                        <?php echo strtoupper($role); ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal<?php echo $id; ?>">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </button>

                                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#passwordModal<?php echo $id; ?>">
                                                        <i class="fa fa-key"></i> Password
                                                    </button>

                                                    <?php if ($id != $_SESSION['user_id']): ?>
                                                        <a href="user.php?act=delete&id=<?php echo $id; ?>"
                                                            class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                                                            <i class="fa fa-trash"></i> Hapus
                                                        </a>
                                                    <?php else: ?>
                                                        <button class="btn btn-danger btn-sm" disabled title="Tidak dapat menghapus akun sendiri">
                                                            <i class="fa fa-trash"></i> Hapus
                                                        </button>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="editModal<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form method="POST" action="user.php">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                <h4 class="modal-title" id="editModalLabel">Edit Pengguna: <?php echo $nama; ?></h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                                <input type="hidden" name="edit" value="1">

                                                                <div class="form-group">
                                                                    <label>Nama Lengkap</label>
                                                                    <input type="text" name="nama" class="form-control" value="<?php echo $nama; ?>" required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Username</label>
                                                                    <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Departemen</label>
                                                                    <select name="departemen" class="form-control" required>
                                                                        <option value="Quality & Planning" <?php echo ($departemen == 'Quality & Planning') ? 'selected' : ''; ?>>Quality & Planning</option>
                                                                        <option value="PGA IT" <?php echo ($departemen == 'PGA IT') ? 'selected' : ''; ?>>PGA IT</option>
                                                                        <option value="Production" <?php echo ($departemen == 'Production') ? 'selected' : ''; ?>>Production</option>
                                                                        <option value="Purchasing Logistic" <?php echo ($departemen == 'Purchasing Logistic') ? 'selected' : ''; ?>>Purchasing Logistic</option>
                                                                        <option value="HSE" <?php echo ($departemen == 'HSE') ? 'selected' : ''; ?>>HSE</option>
                                                                        <option value="Lainnya" <?php echo ($departemen == 'Lainnya') ? 'selected' : ''; ?>>Lainnya</option>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Role</label>
                                                                    <select name="role" class="form-control" required>
                                                                        <option value="admin" <?php echo ($role == 'admin') ? 'selected' : ''; ?>>Admin</option>
                                                                        <option value="user" <?php echo ($role == 'user') ? 'selected' : ''; ?>>User</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Change Password Modal -->
                                            <div class="modal fade" id="passwordModal<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form method="POST" action="user.php">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                <h4 class="modal-title" id="passwordModalLabel">Ubah Password: <?php echo $nama; ?></h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                                                <input type="hidden" name="change_password" value="1">

                                                                <div class="form-group">
                                                                    <label>Password Baru</label>
                                                                    <input type="password" name="new_password" class="form-control" required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Konfirmasi Password Baru</label>
                                                                    <input type="password" name="confirm_password" class="form-control" required>
                                                                </div>

                                                                <div class="alert alert-info">
                                                                    <i class="fa fa-info-circle"></i> Password akan dienkripsi menggunakan Argon2id
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-primary">Ubah Password</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php
                                            $no++;
                                        }
                                    } else {
                                        echo '<tr><td colspan="6" class="text-center">Tidak ada data pengguna</td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>





                        <!-- Pagination -->
                        <?php if ($total_pages > 1): ?>
                            <div class="text-center">
                                <ul class="pagination">
                                    <?php if ($page > 1): ?>
                                        <li><a href="user.php?page=<?php echo ($page - 1); ?>&search=<?php echo urlencode($search); ?>">&laquo;</a></li>
                                    <?php endif; ?>

                                    <?php
                                    $start_page = max(1, $page - 2);
                                    $end_page = min($total_pages, $page + 2);

                                    for ($i = $start_page; $i <= $end_page; $i++):
                                    ?>
                                        <li <?php echo ($i == $page) ? 'class="active"' : ''; ?>>
                                            <a href="user.php?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>">
                                                <?php echo $i; ?>
                                            </a>
                                        </li>
                                    <?php endfor; ?>

                                    <?php if ($page < $total_pages): ?>
                                        <li><a href="user.php?page=<?php echo ($page + 1); ?>&search=<?php echo urlencode($search); ?>">&raquo;</a></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <!-- Info Pagination -->
                        <div class="text-muted">
                            Menampilkan <?php echo min($limit, mysqli_num_rows($ress)); ?> dari <?php echo $total; ?> pengguna
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-users fa-3x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?php echo $total; ?></div>
                                <div>Total Pengguna</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            // Hitung jumlah admin
            $sql_admin = "SELECT COUNT(*) as total_admin FROM user WHERE role = 'admin'";
            $ress_admin = mysqli_query($conn, $sql_admin);
            $row_admin = mysqli_fetch_assoc($ress_admin);
            $total_admin = $row_admin['total_admin'];

            // Hitung jumlah user
            $sql_user = "SELECT COUNT(*) as total_user FROM user WHERE role = 'user'";
            $ress_user = mysqli_query($conn, $sql_user);
            $row_user = mysqli_fetch_assoc($ress_user);
            $total_user = $row_user['total_user'];
            ?>

            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user fa-3x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?php echo $total_user; ?></div>
                                <div>Pengguna Biasa</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user-secret fa-3x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?php echo $total_admin; ?></div>
                                <div>Administrator</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-calendar fa-3x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?php echo date('d/m/Y'); ?></div>
                                <div>Tanggal Hari Ini</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div><!-- /.container-fluid -->
</div><!-- /#page-wrapper -->

<!-- bottom of file -->
<?php
include("layout_bottom.php");
?>