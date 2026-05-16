<!DOCTYPE html>
<?php

if (!defined('MVC_ACCESS')) {
    header("Location: ../index.php");
    exit();
}
?>
<html>
<head>
    <title>Login | NILAVIA</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="background: #00796b;">
    <div class="container">
        <div class="card">
            <h2>Login</h2>
            <?php if (isset($error)): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>
            <form method="POST" action="index.php?action=login">
                <input type="text" name="nama" placeholder="Nama" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" class="btn" style="width:100%">Masuk</button>
            </form>
            <p style="font-size: 12px; margin-top: 15px;">Belum punya akun? <a href="index.php?action=register">Daftar</a></p>
            <hr style="margin:20px 0;">

<div style="text-align:center;">

    <h4>Hubungi Admin</h4>

    <p style="font-size:13px; color:#555;">
        Jika mengalami kendala login atau membutuhkan bantuan,
        silakan hubungi admin.
    </p>

    <a 
        href="mailto:admin@nilavia.com"
        class="btn"
        style="background:#009688;"
    >
        Contact Me
    </a>

</div>
        </div>
    </div>
</body>
</html>