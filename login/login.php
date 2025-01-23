<?php
session_start();
include '../aksi/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $admin = $result->fetch_assoc();
        $_SESSION['id'] = $admin['id_admin'];
        $_SESSION['username'] = $admin['username'];
        header("Location: ../page/index.php");
        exit();
    }

    $stmt->close();

    $stmt = $conn->prepare("SELECT * FROM user WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $_SESSION['id'] = $user['id_kasir'];
        $_SESSION['username'] = $user['username'];
        header("Location: ../page/user.php");
        exit();
    } else {
        echo "Username atau password salah.";
    }

    $stmt->close();
}

$conn->close();
?>