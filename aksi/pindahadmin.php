<?php
session_start();
include 'koneksi.php';

if (isset($_GET['id_user'])) {
    $id_user = $_GET['id_user'];

    $query_user = "SELECT * FROM user WHERE id_user = ?";
    $stmt_user = $conn->prepare($query_user);
    $stmt_user->bind_param("i", $id_user);
    $stmt_user->execute();
    $result_user = $stmt_user->get_result();

    if ($result_user && $result_user->num_rows > 0) {
        $data_user = $result_user->fetch_assoc();

        $conn->begin_transaction();

        try {
            $query_admin = "INSERT INTO admin (username, password) VALUES (?, ?)";
            $stmt_admin = $conn->prepare($query_admin);
            $stmt_admin->bind_param("ss", $data_user['username'], $data_user['password']);
            $stmt_admin->execute();

            $query_delete_user = "DELETE FROM user WHERE id_user = ?";
            $stmt_delete_user = $conn->prepare($query_delete_user); 
            $stmt_delete_user->bind_param("i", $id_user);
            $stmt_delete_user->execute();

            $conn->commit();
            echo "Data berhasil dipindahkan ke tabel admin.";
        } catch (Exception $e) {
            $conn->rollback();
            echo "Terjadi kesalahan: " . $e->getMessage();
        }
    } else {
        echo "Data user tidak ditemukan.";
    }
} else {
    echo "ID user tidak disediakan.";
}
?>
