<?php
session_start();
require_once __DIR__ . '/../app/controllers/EquipoController.php';

$controller = new EquipoController();

$action = $_GET['action'] ?? 'index';

switch ($action) {

    case 'nuevo':
        $controller->nuevo();
        break;

    case 'guardar':
        $controller->guardar($_POST);
        break;

    case 'ver':
        $controller->ver($_GET['id'] ?? null);
        break;

    case 'editar':
        $controller->editar($_GET['id'] ?? null);
        break;

    default:
        $controller->index();
        break;
}



