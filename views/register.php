<!DOCTYPE html>
<?php

if (!defined('MVC_ACCESS')) {
    header("Location: ../index.php");
    exit();
}
?>
<html>
<head>
    <title>Daftar | NILAVIA</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="background: #26a69a;">
    <div class="container">
        <div class="card" style="width: 350px;">
            <h2>Daftar Akun</h2>
            <?php if (isset($error)): ?>
                <p style="color: red; margin-bottom: 12px;"><?php echo $error; ?></p>
            <?php endif; ?>
            <form action="index.php?action=register" method="POST">
                <input type="text" name="nama" placeholder="Nama Lengkap" required>
                <input type="text" name="npm" placeholder="NPM" required>
                <input type="email" name="email" placeholder="Email" required>
                <select name="fakultas" required>
                    <option value="">Pilih Fakultas</option>
                    <option>FMIPA</option>
                    <option>Teknik</option>
                </select>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="confirm_password" placeholder="Konfirmasi Password" required>
                <button type="submit" class="btn" style="width:100%">Daftar Sekarang</button>
            </form>
            <p style="font-size: 12px; margin-top: 15px;">Sudah punya akun? <a href="index.php?action=login">Masuk</a></p>
        </div>
    </div>
</body>
</html>