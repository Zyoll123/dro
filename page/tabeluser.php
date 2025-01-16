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
    <title>Admin Dashboard</title>
</head>

<body>
    <div class="container">
        <nav class="navigation">
            <a href="index.php">SISWA</a>
            <a href="#">USER</a>
        </nav>
        <h2>CRUD DATA USER</h2>
        <p>Selamat datang,
            <?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Tamu'; ?>!
        </p>

        <!-- Tabel data siswa -->
        <table border="1">
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Password</th>
                <th>Aksi</th>
            </tr>
            <?php
            $no = 1;
            // Query untuk mengambil data siswa
            $result = $conn->query("SELECT * FROM user");

            // Menampilkan data dari query
            while ($d = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $d['username']; ?></td>
                    <td><?php echo $d['password']; ?></td>
                    <td>
                        <!-- Tautan untuk edit dan hapus, menggunakan ID sebagai parameter -->
                        <a href='edituser.php?id_user=<?php echo $d['id_user']; ?>'>Edit</a>
                        <a href='../aksi/hapususer.php?id_user=<?php echo $d['id_user']; ?>' onclick="return confirm('Apakah anda yakin menghapus user ini?')">Hapus</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <br>
        <a href="tambahuser.html">tambah user</a>
        <br>
        <a href="../login/login.html">Log Out</a>
    </div>
</body>

</html>