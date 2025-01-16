<?php
session_start();
include 'koneksi.php';

if (isset($_GET['nisn'])) {
    $nisn = $_GET['nisn'];

    $delete_query = "DELETE FROM siswa WHERE nisn = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $nisn);

    if ($stmt->execute()) {
        header("Location: ../page/index.php"); 
        exit;
    } else {
        echo "Gagal menghapus data.";
    }
} else {
    echo "NISN tidak ditemukan.";
}
?>
