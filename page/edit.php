<?php
session_start();
include '../aksi/koneksi.php';

if (isset($_GET['nisn'])) {
    $nisn = intval($_GET['nisn']); // Konversi ke integer

    if ($nisn <= 0) {
        echo "NISN tidak valid.";
        exit;
    }

    // Ambil data siswa berdasarkan NISN
    $query = "SELECT * FROM siswa WHERE nisn = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $nisn); 
    if (!$stmt->execute()) {
        echo "Error pada query: " . $stmt->error;
        exit;
    }
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan.";
        exit;
    }
} else {
    echo "Parameter NISN tidak ada.";
    exit;
}

// Proses update data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nisn = intval($_POST['nisn']); // Konversi ke integer
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];

    if ($nisn > 0 && !empty($nama) && !empty($alamat)) {
        // Update data siswa
        $update_query = "UPDATE siswa SET nama = ?, alamat = ? WHERE nisn = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param("ssi", $nama, $alamat, $nisn);

        if ($update_stmt->execute()) {
            header("Location: index.php"); 
            exit;
        } else {
            echo "Gagal memperbarui data.";
        }
    } else {
        echo "Semua field harus diisi.";
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
        <input type="hidden" name="nisn" value="<?php echo htmlspecialchars($data['nisn']); ?>" required><br>

        <label for="nama">Nama:</label>
        <input type="text" name="nama" value="<?php echo htmlspecialchars($data['nama']); ?>" required><br>

        <label for="alamat">Alamat:</label>
        <input type="text" name="alamat" value="<?php echo htmlspecialchars($data['alamat']); ?>" required><br>

        <button type="submit">Simpan Perubahan</button>
    </form>

    <a href="index.php">Kembali</a>
</body>
</html>
