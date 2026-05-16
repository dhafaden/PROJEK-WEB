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
    <title>Dashboard Panitia - NILAVIA</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="wrapper">

    <aside>
        <h2>NILAVIA</h2>
        <a href="#data">Data Pendaftar</a>
        <a href="index.php?action=logout" class="logout">Logout</a>
    </aside>

    <main>

        <div class="section page" id="data">
            <h2>Data Pendaftar</h2>

            <?php if (!empty($_SESSION['success'])): ?>
                <p style="color: green; margin-bottom: 12px;"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></p>
            <?php endif; ?>

            <table>
                <tr>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Organisasi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
                <?php
                require_once __DIR__ . '/../models/Pendaftaran.php';
                $pendaftaranList = Pendaftaran::getAll();
                if (empty($pendaftaranList)) {
                    echo "<tr><td colspan='5'>Tidak ada pendaftar saat ini.</td></tr>";
                } else {
                    foreach ($pendaftaranList as $pendaftaran) {
                        $statusClass = $pendaftaran['status'] == 'diterima' ? 'status-open' : ($pendaftaran['status'] == 'ditolak' ? 'status-close' : 'status-open');
                        echo "<tr>
                            <td>{$pendaftaran['user_nama']}</td>
                            <td>{$pendaftaran['npm']}</td>
                            <td>{$pendaftaran['organisasi_nama']}</td>
                            <td class='$statusClass'>{$pendaftaran['status']}</td>
                            <td>
                                <form action='index.php?action=pendaftaranAction' method='POST' style='display:inline-block;'>
                                    <input type='hidden' name='pendaftaran_id' value='{$pendaftaran['id']}'>
                                    <button type='submit' name='status' value='diterima' class='btn-open'>Terima</button>
                                </form>
                                <form action='index.php?action=pendaftaranAction' method='POST' style='display:inline-block; margin-left:6px;'>
                                    <input type='hidden' name='pendaftaran_id' value='{$pendaftaran['id']}'>
                                    <button type='submit' name='status' value='ditolak' class='btn-close'>Tolak</button>
                                </form>
                            </td>
                        </tr>";
                    }
                }
                ?>
            </table>
        </div>

    </main>

</div>

</body>
</html>