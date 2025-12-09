<?php
session_start();
require_once __DIR__ . '/../app/controllers/SedeController.php';

$controller = new SedeController();

// Acción enviada por URL
$action = $_GET['action'] ?? 'index';

switch ($action) {

    case 'nuevo':
        $controller->nuevo();
        break;

    case 'guardar':
        $controller->guardar();
        break;

    case 'editar':
        if (isset($_GET['id'])) {
            $controller->editar($_GET['id']);
        }
        break;

    case 'actualizar':
        $controller->actualizar();
        break;

    case 'eliminar':
        if (isset($_GET['id'])) {
            $controller->eliminar($_GET['id']);
        }
        break;

    default:
        $controller->index();
        break;
}
