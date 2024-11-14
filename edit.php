<?php
session_start();
include 'koneksi.php';

// Cek apakah id siswa ada di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data siswa berdasarkan id
    $query = "SELECT * FROM siswa WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan.";
        exit;
    }
}

// Proses update data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nisn = $_POST['nisn'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];

    // Update data siswa
    $update_query = "UPDATE siswa SET nisn = ?, nama = ?, alamat = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("sssi", $nisn, $nama, $alamat, $id);
    
    if ($update_stmt->execute()) {
        header("Location: index.php"); // Setelah berhasil, kembali ke halaman utama
        exit;
    } else {
        echo "Gagal memperbarui data.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Siswa</title>
</head>
<body>
    <h2>Edit Data Siswa</h2>
    <form method="POST">
        <label for="nisn">NISN:</label>
        <input type="number" name="nisn" value="<?php echo htmlspecialchars($data['nisn']); ?>" required><br>

        <label for="nama">Nama:</label>
        <input type="text" name="nama" value="<?php echo htmlspecialchars($data['nama']); ?>" required><br>

        <label for="alamat">Alamat:</label>
        <input type="text" name="alamat" value="<?php echo htmlspecialchars($data['alamat']); ?>" required><br>

        <button type="submit">Simpan Perubahan</button>
    </form>
    <a href="index.php">Kembali</a>
</body>
</html>
