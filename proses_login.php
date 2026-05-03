<?php

session_start();

$users = [
    ['nama' => 'admin', 'password' => '123', 'role' => 'admin'],
    ['nama' => 'panitia', 'password' => '123', 'role' => 'panitia'],
    ['nama' => 'mahasiswa', 'password' => '123', 'role' => 'mahasiswa'],
];

$nama = $_POST['nama'] ?? '';
$password = $_POST['password'] ?? '';


if (empty($nama) || empty($password)) {
    echo "<script>alert('Nama dan password harus diisi!'); window.location='login.html';</script>";
    exit();
}

$login_success = false;
$user_data = null;

foreach ($users as $user) {
    if ($user['nama'] === $nama && $user['password'] === $password) {
        $login_success = true;
        $user_data = $user;
        break;
    }
}

if ($login_success) {
    $_SESSION['nama'] = $user_data['nama'];
    $_SESSION['role'] = $user_data['role'];

    
    $role = $user_data['role'];
    if ($role == 'admin') {
        header("Location: admin.html");
    } elseif ($role == 'panitia') {
        header("Location: panitia.html");
    } elseif ($role == 'mahasiswa') {
        header("Location: dashboard.html");
    } else {
        echo "<script>alert('Role tidak valid!'); window.location='login.html';</script>";
    }
} else {
    
    echo "<script>alert('Nama atau password salah!'); window.location='login.html';</script>";
}
?>