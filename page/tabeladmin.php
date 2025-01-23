<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="tabeluser.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>
    <div class="container">
        <?php include 'sidebar.php'; ?>
        <div class="content">
            <h2>CRUD DATA ADMIN</h2>
            <p>Selamat datang,
                <?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Tamu'; ?>!
            </p>

            <table border="1">
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Aksi</th>
                </tr>
                <?php
                $no = 1;
                $result = $conn->query("SELECT * FROM admin");

                while ($d = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $d['username']; ?></td>
                        <td><?php echo $d['password']; ?></td>
                        <td>
                            <a href='editadmin.php?id_admin=<?php echo $d['id_admin']; ?>'>Edit</a>
                            <a href='../aksi/hapususer.php?id=<?php echo $d['id_admin']; ?>'
                                onclick="return confirm('Apakah anda yakin menghapus admin ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <br>
            <a href="tambahuser.html">tambah user</a>
        </div>
    </div>
</body>

</html>
