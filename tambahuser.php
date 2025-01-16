<?php
session_start();
include 'koneksi.php';

// Proses tambah user
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk memasukkan user baru
    $insert_query = "INSERT INTO user (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        // Jika berhasil, arahkan ke halaman admin
        header("Location: ../page/tabeluser.php");
        exit;
    } else {
        echo "Gagal menambahkan user.";
    }
}
?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah User</title>
</head>
<body>
    <h2>Tambah User Baru</h2>
    <form method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <button type="submit">Tambah User</button>
    </form>
    <a href="index.php">Kembali</a>
</body>
</html> -->
