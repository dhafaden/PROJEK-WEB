<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


session_start();

require_once 'db.php';


define('ROLE_ADMIN', 'admin');
define('ROLE_PANITIA', 'panitia');
define('ROLE_MAHASISWA', 'mahasiswa');


function isLoggedIn() {
    return isset($_SESSION['nama']) && isset($_SESSION['role']);
}


function hasRole($role) {
    return isLoggedIn() && $_SESSION['role'] === $role;
}


function requireLogin() {
    if (!isLoggedIn()) {
        header("Location: index.php?action=login");
        exit();
    }
}

function requireAdmin() {
    requireLogin();
    if (!hasRole(ROLE_ADMIN)) {
        header("Location: index.php?action=dashboard");
        exit();
    }
}
?>