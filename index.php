<?php
session_start();
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
</head>
<body>
    <h2>CRUD DATA SISWA</h2>
    <p>Selamat datang, <?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Tamu'; ?>!</p>

    <!-- Tabel data siswa -->
    <table border="1">
        <tr>
            <th>No</th>
            <th>NISN</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
        <?php
        $no = 1;
        // Query untuk mengambil data siswa
        $result = $conn->query("SELECT * FROM siswa");

        // Menampilkan data dari query
        while ($d = $result->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $d['nisn']; ?></td>
            <td><?php echo $d['nama']; ?></td>
            <td><?php echo $d['alamat']; ?></td>
            <td>
                <!-- Tautan untuk edit dan hapus, menggunakan ID sebagai parameter -->
                <a href='edit.php?id=<?php echo $d['id']; ?>'>Edit</a> |
                <a href='hapus.php?id=<?php echo $d['id']; ?>'>Hapus</a>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
    <br>
    <a href="tambah.php">tambah Siswa</a>
    <br>
    <a href="tambahuser.php">tambah user</a>
    <br>
    <a href="login.php">Log Out</a>
</body>
</html>
