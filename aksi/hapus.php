<?php
session_start();
include 'koneksi.php';

// Cek apakah id siswa ada di URL
if (isset($_GET['nisn'])) {
    $nisn = $_GET['nisn'];

    // Query untuk menghapus data siswa berdasarkan id
    $delete_query = "DELETE FROM siswa WHERE nisn = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $nisn);

    // Jika berhasil menghapus, arahkan kembali ke index.php
    if ($stmt->execute()) {
        header("Location: ../page/index.php"); // Kembali ke halaman utama setelah menghapus
        exit;
    } else {
        echo "Gagal menghapus data.";
    }
} else {
    echo "NISN tidak ditemukan.";
}
?>
