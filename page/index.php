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
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>
    <div class="container">
        <?php include 'sidebar.php'; ?>
        <div class="content">
            <h2>CRUD DATA SISWA</h2>
            <p>Selamat datang,
                <?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Tamu'; ?>!
            </p>

            <!-- Tabel data siswa -->
            <table border="1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NISN</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $result = $conn->query("SELECT * FROM siswa");

                    while ($d = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $d['nisn']; ?></td>
                            <td><?php echo $d['nama']; ?></td>
                            <td><?php echo $d['alamat']; ?></td>
                            <td>
                                <a href='edit.php?nisn=<?php echo $d['nisn']; ?>'>Edit</a>
                                <a href='../aksi/hapus.php?nisn=<?php echo $d['nisn']; ?>'
                                    onclick="return confirm('Apakah anda yakin menghapus data siswa ini!')">Hapus</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <br>
            <a href="tambah.html">Tambah Siswa</a>
        </div>
    </div>
</body>

</html>