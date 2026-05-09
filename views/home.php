<!DOCTYPE html>
<?php

if (!defined('MVC_ACCESS')) {
    header("Location: index.php");
    exit();
}
?>
<html>
<head>
    <title>NILAVIA | Unila</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav><strong>NILAVIA - Universitas Lampung</strong></nav>
    <div class="container">
        <h1>Selamat Datang di NILAVIA</h1>
        <p>Sistem Pendaftaran Organisasi Mahasiswa Terpusat</p>
        <a href="index.php?action=login" class="btn">Cari Organisasi-mu</a>
    </div>
</body>
</html>