<?php
session_start();
include '../aksi/koneksi.php';

if (isset($_GET['id_admin'])) {
    $id_admin = $_GET['id_admin'];

    $query_admin = "SELECT * FROM admin WHERE id_admin = '$id_admin'";
    $result_admin = mysqli_query($conn, $query_admin);

    if ($result_admin && mysqli_num_rows($result_admin) > 0) {
        $d = mysqli_fetch_assoc($result_admin);
    } else {
        echo "<p>Data admin tidak ditemukan.</p>";
        exit;
    }
} else {
    echo "<p>ID admin tidak disediakan.</p>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_admin = $_POST['id_admin'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($id_admin) && !empty($username) && !empty($password)) {
        $update_query = "UPDATE admin SET username = ?, password = ? WHERE id_admin = ?";
        $update_stmt = $conn->prepare($update_query);

        if ($update_stmt) {
            $update_stmt->bind_param("ssi", $username, $password, $id_admin);

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
        <input type="hidden" name="id_admin" value="<?php echo htmlspecialchars($d['id_admin']); ?>" required><br>

        <label for="username">Nama:</label>
        <input type="text" name="username" value="<?php echo htmlspecialchars($d['username']); ?>" required><br>

        <label for="password">Password:</label>
        <input type="text" name="password" value="<?php echo htmlspecialchars($d['password']); ?>" required><br>

        <button type="submit">Simpan Perubahan</button>
    </form>

    <br>
    <a href='../aksi/pindahuser.php?id_admin=<?php echo $d['id_admin']; ?>' onclick="return confirm('Apakah anda yakin menjadikannya sebagai user?')">Jadikan Sebagai User</a>
    <br>
    <a href="tabeluser.php">Kembali</a>
</body>
</html>
