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
    <title>Pendaftaran - NILAVIA</title>
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
            <h2>Pendaftaran Organisasi</h2>
<nav>
    <a href="index.php?action=form">Daftar</a>
    <a href="index.php?action=status">Status</a>
</nav>

<div class="container">
    <div class="card" style="width: 400px;">
        <h2>Pendaftaran Organisasi</h2>

        <form action="index.php?action=form" method="POST">

            <input type="text" placeholder="Nama Lengkap" required>
            <input type="text" placeholder="NIM" required>
            <input type="email" placeholder="Email" required>
            <input type="text" placeholder="No. HP" required>
            <input type="text" placeholder="Fakultas" required>
            <input type="text" placeholder="Program Studi" required>

            <select name="organisasi_id" required>
                <option value="">Pilih Organisasi</option>
                <?php
                require_once __DIR__ . '/../models/Organisasi.php';
                $organisasiList = Organisasi::getOpen();
                foreach ($organisasiList as $org) {
                    echo "<option value='{$org['id']}'>{$org['nama']}</option>";
                }
                ?>
            </select>

            <?php if (isset($error)): ?>
                <p style="color: red; margin-bottom: 12px;"><?php echo $error; ?></p>
            <?php endif; ?>
            <?php if (!empty($_SESSION['success'])): ?>
                <p style="color: green; margin-bottom: 12px;"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></p>
            <?php endif; ?>
            <textarea name="motivasi" placeholder="Motivasi" rows="4" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:5px;"></textarea>
            <p><b>Masukkan Berkas CV sebagai Persyaratan Pendaftaran (pdf, doc, docx)</b></p>
            <input type="file" disabled>
            <button class="btn" type="submit">Daftar</button>

        </form>
    </div>
</div>

</body>
</html>