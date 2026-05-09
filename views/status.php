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
    <title>Status Pendaftaran - NILAVIA</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav>
    <a href="index.php?action=dashboard">Dashboard</a>
    <a href="index.php?action=form">Daftar</a>
    <a href="index.php?action=status">Status</a>
</nav>

<div class="container">
    <div class="card status-card">
        <h2>Status Pendaftaran</h2>
        <?php if (!empty($_SESSION['success'])): ?>
            <p style="color: green; margin-bottom: 12px;"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></p>
        <?php endif; ?>
        <table>
            <tr>
                <th>Nama</th>
                <th>NIM</th>
                <th>Organisasi</th>
                <th>Status</th>
            </tr>
            <?php
            require_once __DIR__ . '/../models/Pendaftaran.php';
            require_once __DIR__ . '/../models/User.php';
            $user = User::getById($_SESSION['user_id']);
            $pendaftaranList = Pendaftaran::getByUser($_SESSION['user_id']);
            if (empty($pendaftaranList)) {
                echo "<tr><td colspan='4'>Belum ada pendaftaran</td></tr>";
            } else {
                foreach ($pendaftaranList as $pendaftaran) {
                    $statusClass = $pendaftaran['status'] == 'diterima' ? 'status-open' : 'status-close';
                    echo "<tr>
                        <td>{$user['nama']}</td>
                        <td>{$user['npm']}</td>
                        <td>{$pendaftaran['organisasi_nama']}</td>
                        <td class='$statusClass'>{$pendaftaran['status']}</td>
                    </tr>";
                }
            }
            ?>
        </table>
    </div>
</div>

</body>
</html>