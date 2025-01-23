<?php
session_start();
include 'koneksi.php';

if (isset($_GET['id_admin'])) {
    $id_admin = $_GET['id_admin'];

    $query_admin = "SELECT * FROM admin WHERE id_admin = ?";
    $stmt_admin = $conn->prepare($query_admin);
    $stmt_admin->bind_param("i", $id_admin);
    $stmt_admin->execute();
    $result_admin = $stmt_admin->get_result();

    if ($result_admin && $result_admin->num_rows > 0) {
        $data_admin = $result_admin->fetch_assoc();

        $conn->begin_transaction();

        try {
            $query_admin = "INSERT INTO user (username, password) VALUES (?, ?)";
            $stmt_admin = $conn->prepare($query_admin);
            $stmt_admin->bind_param("ss", $data_admin['username'], $data_admin['password']);
            $stmt_admin->execute();

            $query_delete_admin = "DELETE FROM admin WHERE id_admin = ?";
            $stmt_delete_admin = $conn->prepare($query_delete_admin); 
            $stmt_delete_admin->bind_param("i", $id_admin);
            $stmt_delete_admin->execute();

            $conn->commit();
            echo "Data berhasil dipindahkan ke tabel user.";
        } catch (Exception $e) {
            $conn->rollback();
            echo "Terjadi kesalahan: " . $e->getMessage();
        }
    } else {
        echo "Data admin tidak ditemukan.";
    }
} else {
    echo "ID admin tidak disediakan.";
}
?>
