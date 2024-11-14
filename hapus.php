<?php
session_start();
include 'koneksi.php';

// Cek apakah id siswa ada di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data siswa berdasarkan id
    $delete_query = "DELETE FROM siswa WHERE id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $id);

    // Jika berhasil menghapus, arahkan kembali ke index.php
    if ($stmt->execute()) {
        header("Location: index.php"); // Kembali ke halaman utama setelah menghapus
        exit;
    } else {
        echo "Gagal menghapus data.";
    }
} else {
    echo "ID tidak ditemukan.";
}
?>
