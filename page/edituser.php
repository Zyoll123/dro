<?php
session_start();
include '../aksi/koneksi.php';

if (isset($_GET['id_user'])) {
    $id_user = $_GET['id_user'];

    $query_user = "SELECT * FROM user WHERE id_user = '$id_user'";
    $result_user = mysqli_query($conn, $query_user);

    if ($result_user && mysqli_num_rows($result_user) > 0) {
        $d = mysqli_fetch_assoc($result_user);
    } else {
        echo "<p>Data user tidak ditemukan.</p>";
        exit;
    }
} else {
    echo "<p>ID user tidak disediakan.</p>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_user = $_POST['id_user'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($id_user) && !empty($username) && !empty($password)) {
        $update_query = "UPDATE user SET username = ?, password = ? WHERE id_user = ?";
        $update_stmt = $conn->prepare($update_query);

        if ($update_stmt) {
            $update_stmt->bind_param("ssi", $username, $password, $id_user);

            if ($update_stmt->execute()) {
                header("Location: tabeluser.php");
                exit;
            } else {
                echo "Gagal memperbarui data: " . $update_stmt->error;
            }
        } else {
            echo "Gagal mempersiapkan query: " . $conn->error;
        }
    } else {
        echo "Semua field harus diisi!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Data User</title>
</head>
<body>
    <h2>Edit Data User</h2>
    <form method="POST">
        <input type="hidden" name="id_user" value="<?php echo htmlspecialchars($d['id_user']); ?>" required><br>

        <label for="username">Nama:</label>
        <input type="text" name="username" value="<?php echo htmlspecialchars($d['username']); ?>" required><br>

        <label for="password">Password:</label>
        <input type="text" name="password" value="<?php echo htmlspecialchars($d['password']); ?>" required><br>

        <button type="submit">Simpan Perubahan</button>
    </form>

    <br>
    <a href='../aksi/pindahadmin.php?id_user=<?php echo $d['id_user']; ?>' onclick="return confirm('Apakah anda yakin menjadikannya sebagai admin?')">Jadikan Sebagai Admin</a>
    <br>
    <a href="tabeluser.php">Kembali</a>
</body>
</html>
