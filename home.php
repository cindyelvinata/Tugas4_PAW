<?php
session_start();

// Cek apakah pengguna sudah login atau belum
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Arahkan ke login jika belum login
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>
    <h1>Selamat Datang, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <p><a href="list.php">Lihat List Barang</a></p>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>