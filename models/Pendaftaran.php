<?php

require_once dirname(__DIR__) . '/config.php';

class Pendaftaran {
    public static function create($user_id, $organisasi_id, $motivasi, $cv_path = null) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO pendaftaran (user_id, organisasi_id, motivasi, cv_path) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$user_id, $organisasi_id, $motivasi, $cv_path]);
    }

    public static function getByUser($user_id) {
        global $pdo;
        $stmt = $pdo->prepare("
            SELECT p.*, o.nama as organisasi_nama
            FROM pendaftaran p
            JOIN organisasi o ON p.organisasi_id = o.id
            WHERE p.user_id = ?
            ORDER BY p.created_at DESC
        ");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll();
    }

    public static function getAll() {
        global $pdo;
        $stmt = $pdo->query("
            SELECT p.*, u.nama as user_nama, u.npm, o.nama as organisasi_nama
            FROM pendaftaran p
            JOIN users u ON p.user_id = u.id
            JOIN organisasi o ON p.organisasi_id = o.id
            ORDER BY p.created_at DESC
        ");
        return $stmt->fetchAll();
    }

    public static function updateStatus($id, $status) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE pendaftaran SET status = ? WHERE id = ?");
        return $stmt->execute([$status, $id]);
    }
}
?>