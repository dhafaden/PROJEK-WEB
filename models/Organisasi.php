<?php

require_once dirname(__DIR__) . '/config.php';

class Organisasi {
    public static function getAll() {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM organisasi ORDER BY nama");
        return $stmt->fetchAll();
    }

    public static function getById($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM organisasi WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public static function getOpen() {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM organisasi WHERE status = 'buka' ORDER BY nama");
        return $stmt->fetchAll();
    }

    public static function create($nama, $deskripsi, $status = 'buka') {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO organisasi (nama, deskripsi, status) VALUES (?, ?, ?)");
        return $stmt->execute([$nama, $deskripsi, $status]);
    }

    public static function setStatus($id, $status) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE organisasi SET status = ? WHERE id = ?");
        return $stmt->execute([$status, $id]);
    }

    public static function delete($id) {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM organisasi WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>