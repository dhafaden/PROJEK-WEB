<!DOCTYPE html>
<?php

if (!defined('MVC_ACCESS')) {
    header("Location: ../index.php");
    exit();
}
?>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil | NILAVIA</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="wrapper">
    <aside>
        <h2>NILAVIA</h2>
        <a href="index.php?action=dashboard#organisasi">Cari Organisasi</a>
        <a href="index.php?action=form">Daftar Organisasi</a>
        <a href="index.php?action=profil">Profil Saya</a>
        <a href="index.php?action=logout" class="logout">Logout</a>
    </aside>

    <main>
        <section class="section">
            <h2>Profil Mahasiswa</h2>

            <div class="card">
                <?php
                require_once __DIR__ . '/../models/User.php';
                $user = User::getById($_SESSION['user_id']);
                ?>
                <p><b>Nama:</b> <?php echo $user['nama']; ?></p>
                <p><b>NPM:</b> <?php echo $user['npm'] ?: '2417051062'; ?></p>
                <p><b>Status:</b> Mahasiswa Aktif</p>
                <p><b>Fakultas:</b> <?php echo $user['fakultas'] ?: 'MIPA'; ?></p>
                <p><b>Role:</b> <?php echo $_SESSION['role']; ?></p>
            </div>
        </section>
    </main>
</div>
</body>
</html>