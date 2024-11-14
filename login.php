<?php
session_start();
include 'koneksi.php'; // Koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $login_as = $_POST['login_as'];

    // Cek apakah login sebagai admin atau user
    if ($login_as === 'admin') {
        $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
    } else {
        $stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Verifikasi password tanpa hash (langsung dibandingkan dengan database)
        if ($password === $user['password']) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // Arahkan ke halaman sesuai peran
            if ($login_as === 'admin') {
                header("Location: index.php");
            } else {
                header("Location: user.php");
            }
            exit();
        } else {
            echo "Password salah.";
        }
    } else {
        echo "Username tidak ditemukan.";
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Omah Putih</title>
</head>
<body>
    <h1>Login</h1>
    <form action="" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <select name="login_as" required>
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select>
        <button type="submit">Login</button>
    </form>    
</body>
</html>