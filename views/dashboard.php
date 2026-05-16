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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | NILAVIA</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrapper">
        <aside>
    <h2>NILAVIA</h2>
    <a href="#organisasi">Data Organisasi</a>
    <a href="index.php?action=form">Daftar Organisasi</a>
    <a href="index.php?action=profil">Profil Saya</a>
    <a href="index.php?action=logout" class="logout">Logout</a>
</aside>

        <main>
            <section id="organisasi" class="section">
    <h2>Organisasi Tersedia</h2>

    <table>
        <tr>
            <th>Organisasi</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        <?php
        require_once __DIR__ . '/../models/Organisasi.php';
        $organisasiList = Organisasi::getAll();
        foreach ($organisasiList as $org) {
            $statusClass = $org['status'] == 'buka' ? 'status-open' : 'status-close';
            $statusText = $org['status'] == 'buka' ? 'Masih Dibuka' : 'Sudah Tutup';
            $buttonClass = $org['status'] == 'buka' ? 'btn-open' : 'btn-close';
            $buttonText = $org['status'] == 'buka' ? 'Daftar' : 'Ditutup';
            $disabled = $org['status'] == 'buka' ? '' : 'disabled';
            echo "<tr>
                <td>{$org['nama']}</td>
                <td><span class='$statusClass'>$statusText</span></td>
                <td><a href='index.php?action=form&org={$org['id']}' class='$buttonClass' $disabled>$buttonText</a></td>
            </tr>";
        }
        ?>
    </table>
</section>

            <section id="detail" class="section active-section">
                <h2>Detail Organisasi</h2>
                <?php
                foreach ($organisasiList as $org) {
                    echo "<div class='card'>
                        <h3>{$org['nama']}</h3>
                        <p>{$org['deskripsi']}</p>
                    </div>";
                }
                ?>
            </section>

        </main>
    </div>
</body>
</html>