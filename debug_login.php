<?php
// debug_login.php
session_start();
include("dist/config/koneksi.php");

echo "<h1>DEBUG LOGIN SYSTEM</h1>";

// 1. Cek conn database
echo "<h2>1. Database Connection:</h2>";
if ($conn) {
    echo "✓ Database connected successfully<br>";

    // Test query
    $test_query = mysqli_query($conn, "SELECT COUNT(*) as total FROM users");
    if ($test_query) {
        $row = mysqli_fetch_assoc($test_query);
        echo "✓ Users table exists with " . $row['total'] . " records<br>";
    } else {
        echo "✗ Error: " . mysqli_error($conn) . "<br>";
    }
} else {
    echo "✗ Database connection failed<br>";
}

// 2. Cek users dengan role manager
echo "<h2>2. Check Manager Users:</h2>";
$query = mysqli_query($conn, "SELECT * FROM users WHERE role='manager'");
if (mysqli_num_rows($query) > 0) {
    echo "✓ Found " . mysqli_num_rows($query) . " manager(s):<br>";
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>ID</th><th>Username</th><th>Password Hash</th><th>Status</th></tr>";
    while ($user = mysqli_fetch_assoc($query)) {
        echo "<tr>";
        echo "<td>" . $user['id'] . "</td>";
        echo "<td>" . $user['username'] . "</td>";
        echo "<td style='font-size: 10px;'>" . substr($user['password'], 0, 30) . "...</td>";
        echo "<td>" . $user['status'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "✗ No manager found in database<br>";
}

// 3. Test password verification
echo "<h2>3. Password Verification Test:</h2>";
$test_users = ['admin', 'manager', 'supervisor', 'user1'];
foreach ($test_users as $test_user) {
    $query = mysqli_query($conn, "SELECT password FROM users WHERE username='$test_user'");
    if (mysqli_num_rows($query) > 0) {
        $user = mysqli_fetch_assoc($query);
        $hash = $user['password'];
        $verify = password_verify('password', $hash);

        echo "User: <strong>$test_user</strong><br>";
        echo "Hash: " . substr($hash, 0, 30) . "...<br>";
        echo "Verify 'password': " . ($verify ? '✓ SUCCESS' : '✗ FAILED') . "<br>";
        echo "<hr>";
    } else {
        echo "User <strong>$test_user</strong> not found<br><hr>";
    }
}

// 4. Create test manager if not exists
echo "<h2>4. Create Test Manager if Needed:</h2>";
$check_manager = mysqli_query($conn, "SELECT id FROM users WHERE username='manager'");
if (mysqli_num_rows($check_manager) == 0) {
    $password_hash = password_hash('password', PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, password, nama_lengkap, role, dept, status) 
            VALUES ('manager', '$password_hash', 'Test Manager', 'manager', 'IT', 'aktif')";

    if (mysqli_query($conn, $sql)) {
        echo "✓ Test manager created successfully<br>";
        echo "Username: <strong>manager</strong><br>";
        echo "Password: <strong>password</strong><br>";
    } else {
        echo "✗ Failed to create manager: " . mysqli_error($conn) . "<br>";
    }
} else {
    echo "✓ Manager already exists in database<br>";
}

echo "<h2>5. Quick Login Form for Testing:</h2>";
?>
<form action="login_auth.php" method="post" style="background: #f0f0f0; padding: 20px; border-radius: 10px;">
    <h3>Test Login Here:</h3>
    <div>
        <label>Username:</label>
        <input type="text" name="username" value="manager" required>
    </div>
    <div>
        <label>Password:</label>
        <input type="password" name="password" value="password" required>
    </div>
    <div>
        <button type="submit" name="login">Test Login</button>
    </div>
</form>

<div style="margin-top: 30px; padding: 20px; background: #e8f4f8; border-radius: 10px;">
    <h3>Troubleshooting Steps:</h3>
    <ol>
        <li>Pastikan database 'db_informasi' ada</li>
        <li>Pastikan tabel 'users' ada dengan struktur yang benar</li>
        <li>Pastikan ada user dengan username 'manager'</li>
        <li>Password harus di-hash dengan password_hash()</li>
        <li>Cek error log di server (biasanya di /var/log/apache2/error.log atau cPanel)</li>
        <li>Cek session.save_path di php.ini</li>
    </ol>

    <h4>Quick Fix - Create Manager User:</h4>
    <pre>
INSERT INTO users (username, password, nama_lengkap, role, dept, status) 
VALUES ('manager', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Test Manager', 'manager', 'IT', 'aktif');
    </pre>

    <p><strong>Note:</strong> Password hash di atas adalah untuk password: <strong>password</strong></p>
</div>