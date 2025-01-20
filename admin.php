<?php
// koneksi.php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'lpsi';

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Membuat folder /upload jika belum ada
$uploadDir = __DIR__ . '/upload';
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}
?>

<!-- admin.php -->
<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengunggah teks ke tabel informasi
    if (isset($_POST['upload_teks'])) {
        $teks = mysqli_real_escape_string($conn, $_POST['teks']);
        $query = "INSERT INTO informasi (teks) VALUES ('$teks')";
        mysqli_query($conn, $query);
    }

    // Mengunggah gambar ke tabel flayer
    if (isset($_POST['upload_gambar']) && isset($_FILES['gambar'])) {
        $gambar = $_FILES['gambar'];
        $namaFile = $gambar['name'];
        $tmpFile = $gambar['tmp_name'];
        $path = 'upload/' . basename($namaFile);

        $ekstensiValid = ['jpg', 'png', 'jfif'];
        $ekstensi = pathinfo($namaFile, PATHINFO_EXTENSION);

        if (in_array(strtolower($ekstensi), $ekstensiValid)) {
            if (move_uploaded_file($tmpFile, $path)) {
                $query = "INSERT INTO flayer (gambar) VALUES ('$namaFile')";
                mysqli_query($conn, $query);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
</head>
<body>
    <h1>Halaman Admin</h1>

    <form method="POST" enctype="multipart/form-data">
        <textarea name="teks" placeholder="Masukkan teks..."></textarea>
        <button type="submit" name="upload_teks">Upload Teks</button>
    </form>

    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="gambar" accept="image/jpg, image/png, image/jfif">
        <button type="submit" name="upload_gambar">Upload Gambar</button>
    </form>
</body>
</html>