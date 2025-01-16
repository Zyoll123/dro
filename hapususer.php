<?php
session_start();
include 'koneksi.php';

if (isset($_GET['id_user'])) {
    $id_user = $_GET['id_user'];

    $delete_query = "DELETE FROM user WHERE id_user = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $id_user);

    if ($stmt->execute()) {
        header("Location: ../page/tabeluser.php"); 
        exit;
    } else {
        echo "Gagal menghapus data.";
    }
} else {
    echo "ID tidak ditemukan.";
}
?>
