<?php

require_once dirname(__DIR__) . '/models/User.php';

class AuthController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = trim($_POST['nama'] ?? '');
            $password = $_POST['password'] ?? '';

            if (empty($nama) || empty($password)) {
                $error = 'Nama dan password harus diisi!';
            } else {
                $user = User::authenticate($nama, $password);
                if ($user) {
                    $_SESSION['nama'] = $user['nama'];
                    $_SESSION['role'] = $user['role'];
                    $_SESSION['user_id'] = $user['id'];

                    switch ($user['role']) {
                        case ROLE_ADMIN:
                            header("Location: index.php?action=admin");
                            break;
                        case ROLE_PANITIA:
                            header("Location: index.php?action=panitia");
                            break;
                        case ROLE_MAHASISWA:
                            header("Location: index.php?action=dashboard");
                            break;
                        default:
                            $error = 'Role tidak valid!';
                    }
                    exit();
                } else {
                    $error = 'Nama atau password salah!';
                }
            }
        }

        if (!defined('MVC_ACCESS')) define('MVC_ACCESS', true);
        include dirname(__DIR__) . '/views/login.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = trim($_POST['nama'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $confirm = $_POST['confirm_password'] ?? '';
            $npm = trim($_POST['npm'] ?? '');
            $fakultas = trim($_POST['fakultas'] ?? '');

            if (empty($nama) || empty($email) || empty($password) || empty($confirm)) {
                $error = 'Semua field wajib diisi.';
            } elseif ($password !== $confirm) {
                $error = 'Password dan konfirmasi tidak cocok.';
            } elseif (User::existsByNama($nama)) {
                $error = 'Nama sudah digunakan.';
            } elseif (User::existsByEmail($email)) {
                $error = 'Email sudah digunakan.';
            } else {
                $newUserId = User::register($nama, $email, $password, $npm, $fakultas);
                if ($newUserId) {
                    $_SESSION['nama'] = $nama;
                    $_SESSION['role'] = ROLE_MAHASISWA;
                    $_SESSION['user_id'] = $newUserId;
                    header("Location: index.php?action=dashboard");
                    exit();
                }
                $error = 'Gagal membuat akun. Coba lagi nanti.';
            }
        }

        if (!defined('MVC_ACCESS')) define('MVC_ACCESS', true);
        include dirname(__DIR__) . '/views/register.php';
    }

    public function logout() {
        session_destroy();
        header("Location: index.php?action=login");
        exit();
    }
}
?>