<?php
session_start();
include '../aksi/koneksi.php';

if (!isset($_SESSION['id'])) {
    header("Location: ../login/login.html");
    exit;
}
?>

<div class="sidebar">
    <div class="sidebar-item">
        <h1><?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Tamu'; ?></h1>
    </div>
    <div class="sidebar-item">
        <a href="index.php"><i class="fa-solid fa-house"></i> Home Page</a>
    </div>
    <div class="sidebar-item">
        <a href="setting.php"><i class="fa-solid fa-gear"></i> Settings</a>
    </div>
    <div class="log-out">
        <a href="../login/login.html">Log Out</a>
    </div>
</div>