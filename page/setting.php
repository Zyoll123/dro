<?php
session_start();
include '../aksi/koneksi.php';

if (!isset($_SESSION['id'])) {
    header("Location: ../login/login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="setting.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>
    <div class="container">
        <?php include 'sidebar.php'; ?>
        <div class="content">
            <div class="content-item">
                <a href="tabeluser.php">user</a>
            </div>
            <div class="content-item">
                <a href="tabeladmin.php">admin</a>
            </div>
        </div>
    </div>
</body>

</html>