<?php
session_start();

// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "furniture_db");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk mengambil data pengguna
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    // Cek query
    if (!$result) {
        die("Query error: " . mysqli_error($conn));
    }

    $user = mysqli_fetch_assoc($result);

    // Cek pengguna
    if ($user) {
        // Cek apakah passwordnya cocok
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username; // Simpan username di sesi

            // Redirect ke halaman Home
            header("Location: home.php");
            exit(); // Untuk menghentikan eksekusi setelah redirect
        } else {
            echo "Password salah!";
        }
    } else {
        echo "Username tidak ditemukan";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="POST" action="">
        <label for="username">Username:</label><br>
        <input type="text" name="username" required><br>
        <label for="password">Password:</label><br>
        <input type="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
    <p>Belum punya akun? <a href="register.php">Daftar dulu</a></p>
</body>
</html>