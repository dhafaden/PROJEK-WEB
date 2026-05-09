<?php

if (!defined('MVC_ACCESS')) {
    header("Location: ../index.php");
    exit();
}

if (!isset($stats)) {
    $stats = [
        'total_users' => 0,
        'total_organisasi' => 0,
        'total_pendaftar' => 0
    ];
}
?>
<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<title>Dashboard Admin | NILAVIA</title>

<link rel="stylesheet" href="style.css">

</head>
<body>

<div class="wrapper">


<aside>
    <h2>NILAVIA</h2>
    <a href="#dashboard">Dashboard</a>
    <a href="#user">Kelola User</a>
    <a href="#organisasi">Organisasi</a>
    <a href="index.php?action=logout" class="logout">Logout</a>
</aside>

<main>


<section id="dashboard" class="section page">
    <h2>Dashboard Admin</h2>

    <div class="cards">

        <div class="card">
            <h3><?php echo $stats['total_users']; ?></h3>
            <p>Total User</p>
        </div>

        <div class="card">
            <h3><?php echo $stats['total_organisasi']; ?></h3>
            <p>Organisasi</p>
        </div>

        <div class="card">
            <h3><?php echo $stats['total_pendaftar']; ?></h3>
            <p>Pendaftar</p>
        </div>

    </div>

    <br>


    <div class="card">
        <h3>Aktivitas Terakhir</h3>

        <p>Berikut aktivitas terbaru di sistem:</p>

        <ul>
            <li>Admin menambahkan user baru: Panitia BEM</li>
            <li>Organisasi HIMAKOM ditutup pendaftarannya</li>
            <li>3 user baru mendaftar hari ini</li>
            <li>Data organisasi DPM diperbarui</li>
            <li>Admin menghapus user tidak aktif</li>
        </ul>
    </div>

</section>


<section id="user" class="section page">
    <h2>Kelola User</h2>

    <input type="text" placeholder="Cari user...">

    <table>
        <tr>
            <th>Nama</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>
        <?php
        require_once __DIR__ . '/../models/User.php';
        $users = User::getAllUsers();
        foreach ($users as $user) {
            $roleAction = $user['role'] === ROLE_PANITIA ? 'set_mahasiswa' : 'set_panitia';
            $roleLabel = $user['role'] === ROLE_PANITIA ? 'Jadikan Mahasiswa' : 'Jadikan Panitia';
            echo "<tr>
                <td>{$user['nama']}</td>
                <td>{$user['role']}</td>
                <td>
                    <form action='index.php?action=userAction' method='POST' style='display:inline-block;'>
                        <input type='hidden' name='id' value='{$user['id']}'>
                        <input type='hidden' name='action_type' value='delete'>
                        <button type='submit' class='btn-close'>Hapus</button>
                    </form>
                    <form action='index.php?action=userAction' method='POST' style='display:inline-block; margin-left:6px;'>
                        <input type='hidden' name='id' value='{$user['id']}'>
                        <input type='hidden' name='action_type' value='{$roleAction}'>
                        <button type='submit' class='btn-open'>{$roleLabel}</button>
                    </form>
                </td>
            </tr>";
        }
        ?>
    </table>

    <br>
    <a class="btn" href="#">+ Tambah User</a>
</section>

<section id="organisasi" class="section page">
    <h2>Organisasi</h2>
    <?php if (!empty($_SESSION['success'])): ?>
        <p style="color: green; margin-bottom: 12px;"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></p>
    <?php endif; ?>

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
            $actionStatus = $org['status'] == 'buka' ? 'tutup' : 'buka';
            $actionLabel = $org['status'] == 'buka' ? 'Tutup' : 'Buka';
            echo "<tr>
                <td>{$org['nama']}</td>
                <td class='$statusClass'>$statusText</td>
                <td>
                    <form action='index.php?action=toggleOrganisasiStatus' method='POST' style='display:inline-block;'>
                        <input type='hidden' name='id' value='{$org['id']}'>
                        <input type='hidden' name='status' value='$actionStatus'>
                        <button type='submit' class='btn-open'>$actionLabel</button>
                    </form>
                    <form action='index.php?action=deleteOrganisasi' method='POST' style='display:inline-block; margin-left:6px;'>
                        <input type='hidden' name='id' value='{$org['id']}'>
                        <button type='submit' class='btn-close'>Hapus</button>
                    </form>
                </td>
            </tr>";
        }
        ?>
    </table>

    <br>
    <form action="index.php?action=addOrganisasi" method="POST">
        <h3>Tambah Organisasi</h3>
        <input type="text" name="nama" placeholder="Nama Organisasi" required style="width:100%; margin-bottom:8px; padding:10px;">
        <textarea name="deskripsi" placeholder="Deskripsi Organisasi" rows="3" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:5px; margin-bottom:8px;" required></textarea>
        <select name="status" required style="width:100%; padding:10px; margin-bottom:12px;">
            <option value="buka">Buka</option>
            <option value="tutup">Tutup</option>
        </select>
        <button type="submit" class="btn">Tambah Organisasi</button>
    </form>
</section>

</main>
</div>
</body>
</html>