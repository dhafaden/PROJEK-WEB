<!DOCTYPE html>
<?php

if (!defined('MVC_ACCESS')) {
    header("Location: ../index.php");
    exit();
}
?>
<html>
<head>
    <title>404 - Page Not Found</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>404 - Page Not Found</h1>
        <p>Halaman yang Anda cari tidak ditemukan.</p>
        <a href="index.php" class="btn">Kembali ke Home</a>
    </div>
</body>
</html>