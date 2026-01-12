<?php
session_start();
require_once __DIR__ . '/../app/controllers/UserController.php';

$controller = new UserController();

$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'nuevo':
        $controller->nuevo();
        break;

    case 'editar':
        $controller->editar($_GET['id']);
        break;

    default:
        $controller->index();
        break;
}
