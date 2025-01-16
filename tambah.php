<?php
include 'koneksi.php';

if (isset($_POST['tambah'])) {
    $nisn = $_POST['nisn'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];

    $stmt = $conn->prepare("INSERT INTO siswa (nisn, nama, alamat) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nisn, $nama, $alamat);
    $stmt->execute();
    $stmt->close();

    header("Location: ../page/index.php");
    exit();
}
?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="">
        <input type="number" name="nisn" placeholder="NISN" required>
        <input type="text" name="nama" placeholder="Nama" required>
        <input type="text" name="alamat" placeholder="Alamat" required>
        <button type="submit" name="tambah">Tambah</button>
    </form>
</body>
</html> -->