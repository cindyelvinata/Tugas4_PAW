<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "furniture_db");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Mengambil ID dari query string
$id = intval($_GET['id']);
$query = "SELECT * FROM furniture WHERE id = $id";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}

$item = mysqli_fetch_assoc($result); // Mengambil data barang
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Barang</title>
</head>
<body>
    <h1>Detail Furniture</h1>
    <?php if ($item): ?>
        <h2><?php echo htmlspecialchars($item['nama_barang']); ?></h2>
        <p><strong>Harga:</strong> <?php echo htmlspecialchars($item['harga']); ?></p>
        <p><strong>Deskripsi:</strong> <?php echo htmlspecialchars($item['deskripsi']); ?></p>
    <?php else: ?>
        <p>Barang tidak ditemukan.</p>
    <?php endif; ?>
    <a href="list.php">Kembali ke List Barang</a>
    <br>
    <a href="logout.php">Logout</a>
</body>
</html>

<?php
mysqli_close($conn);
?>