<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
</head>
<body>
    <h2>DATA SISWA</h2>
    <p>Selamat datang, <?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Tamu'; ?>!</p>

    <table border="1">
        <tr>
            <th>No</th>
            <th>NISN</th>
            <th>Nama</th>
            <th>Alamat</th>
        </tr>
        <?php
        include '../aksi/koneksi.php';
        $no = 1;
        if ($conn) {
            $result = $conn->query("SELECT * FROM siswa");

            if ($result) {
                while ($d = $result->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo htmlspecialchars($d['nisn']); ?></td>
            <td><?php echo htmlspecialchars($d['nama']); ?></td>
            <td><?php echo htmlspecialchars($d['alamat']); ?></td>
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
    <a href="../login/login.html">Log Out</a>
</body>
</html>
