<?php
session_start();
require_once __DIR__ . '/../app/controllers/EmpresaController.php';

$controller = new EmpresaController();


$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'nuevo':
        $controller->nuevo();
        break;

    case 'guardar':
        $controller->guardar($_POST);
        break;

    case 'editar':
        $controller->editar($_GET['id']);
        break;

    case 'actualizar':
        $controller->actualizar($_POST);
        break;

    case 'eliminar':
        $controller->eliminar($_GET['id']);
        break;

    default:
        $controller->index();
        break;
}
