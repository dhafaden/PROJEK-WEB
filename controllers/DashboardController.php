<?php

require_once dirname(__DIR__) . '/config.php';
require_once dirname(__DIR__) . '/models/Organisasi.php';
require_once dirname(__DIR__) . '/models/Pendaftaran.php';
require_once dirname(__DIR__) . '/models/User.php';

class DashboardController {
    public function index() {
        requireLogin();
        if (!defined('MVC_ACCESS')) define('MVC_ACCESS', true);
        include dirname(__DIR__) . '/views/dashboard.php';
    }

    public function admin() {
        requireAdmin();
        global $pdo;
        $stats = [
            'total_users' => $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn(),
            'total_organisasi' => $pdo->query("SELECT COUNT(*) FROM organisasi")->fetchColumn(),
            'total_pendaftar' => $pdo->query("SELECT COUNT(*) FROM pendaftaran")->fetchColumn()
        ];
        if (!defined('MVC_ACCESS')) define('MVC_ACCESS', true);
        include dirname(__DIR__) . '/views/admin.php';
    }

    public function panitia() {
        requireLogin();
        if (!hasRole(ROLE_PANITIA)) {
            header("Location: index.php?action=dashboard");
            exit();
        }
        if (!defined('MVC_ACCESS')) define('MVC_ACCESS', true);
        include dirname(__DIR__) . '/views/panitia.php';
    }

    public function form() {
        requireLogin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $organisasi_id = $_POST['organisasi_id'] ?? '';
            $motivasi = trim($_POST['motivasi'] ?? '');

            if (empty($organisasi_id) || empty($motivasi)) {
                $error = 'Organisasi dan motivasi wajib diisi.';
            } else {
                Pendaftaran::create($_SESSION['user_id'], $organisasi_id, $motivasi);
                $_SESSION['success'] = 'Pendaftaran berhasil dikirim. Cek status di halaman Status.';
                header('Location: index.php?action=status');
                exit();
            }
        }

        if (!defined('MVC_ACCESS')) define('MVC_ACCESS', true);
        include dirname(__DIR__) . '/views/form.php';
    }

    public function status() {
        requireLogin();
        if (!defined('MVC_ACCESS')) define('MVC_ACCESS', true);
        include dirname(__DIR__) . '/views/status.php';
    }

    public function profil() {
        requireLogin();
        if (!defined('MVC_ACCESS')) define('MVC_ACCESS', true);
        include dirname(__DIR__) . '/views/profil.php';
    }

    public function addOrganisasi() {
        requireAdmin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = trim($_POST['nama'] ?? '');
            $deskripsi = trim($_POST['deskripsi'] ?? '');
            $status = $_POST['status'] ?? 'buka';

            if (!empty($nama) && !empty($deskripsi)) {
                Organisasi::create($nama, $deskripsi, $status);
                $_SESSION['success'] = 'Organisasi berhasil ditambahkan.';
            }
        }
        header('Location: index.php?action=admin');
        exit();
    }

    public function deleteOrganisasi() {
        requireAdmin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if ($id) {
                Organisasi::delete($id);
                $_SESSION['success'] = 'Organisasi berhasil dihapus.';
            }
        }
        header('Location: index.php?action=admin');
        exit();
    }

    public function toggleOrganisasiStatus() {
        requireAdmin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $status = $_POST['status'] ?? null;
            if ($id && in_array($status, ['buka', 'tutup'])) {
                Organisasi::setStatus($id, $status);
                $label = $status === 'buka' ? 'dibuka' : 'ditutup';
                $_SESSION['success'] = "Organisasi berhasil $label.";
            }
        }
        header('Location: index.php?action=admin');
        exit();
    }

    public function userAction() {
        requireAdmin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $action = $_POST['action_type'] ?? null;
            if ($id && $action) {
                if ($action === 'delete') {
                    User::delete($id);
                    $_SESSION['success'] = 'User berhasil dihapus.';
                } elseif ($action === 'set_panitia') {
                    User::setRole($id, ROLE_PANITIA);
                    $_SESSION['success'] = 'User diubah menjadi panitia.';
                } elseif ($action === 'set_mahasiswa') {
                    User::setRole($id, ROLE_MAHASISWA);
                    $_SESSION['success'] = 'User diubah menjadi mahasiswa.';
                }
            }
        }
        header('Location: index.php?action=admin');
        exit();
    }

    public function pendaftaranAction() {
        requireLogin();
        if (!hasRole(ROLE_PANITIA)) {
            header('Location: index.php?action=dashboard');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['pendaftaran_id'] ?? null;
            $status = $_POST['status'] ?? null;
            if ($id && in_array($status, ['diterima', 'ditolak'])) {
                Pendaftaran::updateStatus($id, $status);
            }
        }

        header('Location: index.php?action=panitia');
        exit();
    }
}
?>