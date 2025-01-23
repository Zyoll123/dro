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
            <h2>CRUD DATA USER</h2>
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
                $result = $conn->query("SELECT * FROM user");

                while ($d = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $d['username']; ?></td>
                        <td><?php echo $d['password']; ?></td>
                        <td>
                            <a href='edituser.php?id_user=<?php echo $d['id_user']; ?>'>Edit</a>
                            <a href='../aksi/hapususer.php?id=<?php echo $d['id_user']; ?>'
                                onclick="return confirm('Apakah anda yakin menghapus user ini?')">Hapus</a>
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
