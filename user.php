<!-- user.php -->
<?php
include 'koneksi.php';

// Mengambil data dari tabel informasi
$queryInformasi = "SELECT * FROM informasi";
$resultInformasi = mysqli_query($conn, $queryInformasi);

// Mengambil data dari tabel flayer
$queryFlayer = "SELECT * FROM flayer";
$resultFlayer = mysqli_query($conn, $queryFlayer);
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Page</title>
</head>
<body>
    <h1>Halaman User</h1>

    <h2>Informasi</h2>
    <?php while ($row = mysqli_fetch_assoc($resultInformasi)): ?>
        <p><?php echo htmlspecialchars($row['teks']); ?></p>
    <?php endwhile; ?>

    <h2>Flayer</h2>
    <?php while ($row = mysqli_fetch_assoc($resultFlayer)): ?>
        <img src="upload/<?php echo htmlspecialchars($row['gambar']); ?>" alt="Gambar" style="max-width: 200px; margin: 10px;">
    <?php endwhile; ?>
</body>
</html>
