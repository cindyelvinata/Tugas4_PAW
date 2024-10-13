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

$query = "SELECT * FROM furniture";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Barang</title>
</head>
<body>
    <h1>Produk Furniture</h1>
    <ul>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <li>
            <strong>ID:</strong> <?php echo htmlspecialchars($row['id']); ?><br>
            <strong>Nama Barang:</strong> <?php echo htmlspecialchars($row['nama_barang']); ?><br>
            <a href="detail.php?id=<?php echo $row['id']; ?>">Lihat Detail</a>
        </li>
        <?php endwhile; ?>
    </ul>
    <br>
    <a href="home.php">Kembali ke Home</a>
    <br>
</body>
</html>

<?php
mysqli_close($conn);
?>