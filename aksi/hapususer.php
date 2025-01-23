<?php
session_start();
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $check_user_query = "SELECT * FROM user WHERE id_user = ?";
    $stmt_user = $conn->prepare($check_user_query);
    $stmt_user->bind_param("i", $id);
    $stmt_user->execute();
    $result_user = $stmt_user->get_result();

    if ($result_user->num_rows > 0) {
        $delete_query = "DELETE FROM user WHERE id_user = ?";
        $stmt_delete = $conn->prepare($delete_query);
        $stmt_delete->bind_param("i", $id);

        if ($stmt_delete->execute()) {
            header("Location: ../page/tabeluser.php");
            exit;
        } else {
            echo "Gagal menghapus data dari tabel user.";
        }
    } else {
        $check_admin_query = "SELECT * FROM admin WHERE id_admin = ?";
        $stmt_admin = $conn->prepare($check_admin_query);
        $stmt_admin->bind_param("i", $id);
        $stmt_admin->execute();
        $result_admin = $stmt_admin->get_result();

        if ($result_admin->num_rows > 0) {
            $delete_query = "DELETE FROM admin WHERE id_admin = ?";
            $stmt_delete = $conn->prepare($delete_query);
            $stmt_delete->bind_param("i", $id);

            if ($stmt_delete->execute()) {
                header("Location: ../page/tabeladmin.php");
                exit;
            } else {
                echo "Gagal menghapus data dari tabel admin.";
            }
        } else {
            echo "Data tidak ditemukan di tabel user maupun admin.";
        }
    }
} else {
    echo "ID tidak ditemukan.";
}
?>
