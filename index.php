<?php

require_once 'config.php';

$action = $_GET['action'] ?? 'home';

switch ($action) {
    case 'home':
        if (!defined('MVC_ACCESS')) define('MVC_ACCESS', true);
        include 'views/home.php';
        break;
    case 'login':
        require_once 'controllers/AuthController.php';
        $controller = new AuthController();
        $controller->login();
        break;
    case 'logout':
        require_once 'controllers/AuthController.php';
        $controller = new AuthController();
        $controller->logout();
        break;
    case 'dashboard':
        require_once 'controllers/DashboardController.php';
        $controller = new DashboardController();
        $controller->index();
        break;
    case 'admin':
        require_once 'controllers/DashboardController.php';
        $controller = new DashboardController();
        $controller->admin();
        break;
    case 'panitia':
        require_once 'controllers/DashboardController.php';
        $controller = new DashboardController();
        $controller->panitia();
        break;
    case 'form':
        require_once 'controllers/DashboardController.php';
        $controller = new DashboardController();
        $controller->form();
        break;
    case 'profil':
        require_once 'controllers/DashboardController.php';
        $controller = new DashboardController();
        $controller->profil();
        break;
    case 'register':
        require_once 'controllers/AuthController.php';
        $controller = new AuthController();
        $controller->register();
        break;
    case 'status':
        require_once 'controllers/DashboardController.php';
        $controller = new DashboardController();
        $controller->status();
        break;
    case 'addOrganisasi':
        require_once 'controllers/DashboardController.php';
        $controller = new DashboardController();
        $controller->addOrganisasi();
        break;
    case 'deleteOrganisasi':
        require_once 'controllers/DashboardController.php';
        $controller = new DashboardController();
        $controller->deleteOrganisasi();
        break;
    case 'toggleOrganisasiStatus':
        require_once 'controllers/DashboardController.php';
        $controller = new DashboardController();
        $controller->toggleOrganisasiStatus();
        break;
    case 'userAction':
        require_once 'controllers/DashboardController.php';
        $controller = new DashboardController();
        $controller->userAction();
        break;
    case 'pendaftaranAction':
        require_once 'controllers/DashboardController.php';
        $controller = new DashboardController();
        $controller->pendaftaranAction();
        break;
    default:
        if (!defined('MVC_ACCESS')) define('MVC_ACCESS', true);
        include 'views/404.php';
        break;
}
?>