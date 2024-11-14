<?php
session_start();
include 'koneksi.php'; // Pastikan koneksi.php berisi konfigurasi koneksi yang benar
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
            <!-- <th>Aksi</th> -->
        </tr>
        <?php
        $no = 1;
        // Pastikan koneksi ke database berhasil
        if ($conn) {
            // Query untuk mengambil data siswa
            $result = $conn->query("SELECT * FROM siswa");

            if ($result) {
                // Menampilkan data dari query
                while ($d = $result->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo htmlspecialchars($d['nisn']); ?></td>
            <td><?php echo htmlspecialchars($d['nama']); ?></td>
            <td><?php echo htmlspecialchars($d['alamat']); ?></td>
            <!-- <td>
                <a href="edit.php?id=<?php echo htmlspecialchars($d['id']); ?>">Edit</a> |
                <a href="hapus.php?id=<?php echo htmlspecialchars($d['id']); ?>">Hapus</a>
            </td> -->
        </tr>
        <?php
                }
            } else {
                echo "<tr><td colspan='5'>Data tidak ditemukan atau query gagal.</td></tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Koneksi ke database gagal.</td></tr>";
        }
        ?>
    </table>
    <a href="login.php">Log Out</a>
</body>
</html>
