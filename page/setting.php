<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="setting.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>
    <div class="container">
        <?php include 'sidebar.php'; ?>
        <div class="content">
            <div class="content-item">
                <a href="tabeluser.php"><i class="fa-solid fa-users"></i> User</a>
            </div>
            <div class="content-item">
                <a href="tabeladmin.php"><i class="fa-solid fa-user-shield"></i> Admin</a>
            </div>
        </div>
    </div>
</body>

</html>
