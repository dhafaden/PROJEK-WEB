<?php

require_once dirname(__DIR__) . '/config.php';

class User {
    public static function authenticate($nama, $password) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM users WHERE nama = ?");
        $stmt->execute([$nama]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public static function existsByNama($nama) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE nama = ?");
        $stmt->execute([$nama]);
        return $stmt->fetchColumn() > 0;
    }

    public static function existsByEmail($email) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetchColumn() > 0;
    }

    public static function register($nama, $email, $password, $npm, $fakultas, $role = ROLE_MAHASISWA) {
        global $pdo;
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (nama, email, password, role, npm, fakultas) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt->execute([$nama, $email, $hash, $role, $npm, $fakultas])) {
            return $pdo->lastInsertId();
        }
        return false;
    }

    public static function getAllUsers() {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM users ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }

    public static function setRole($id, $role) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE users SET role = ? WHERE id = ?");
        return $stmt->execute([$role, $id]);
    }

    public static function delete($id) {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public static function getById($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
?>