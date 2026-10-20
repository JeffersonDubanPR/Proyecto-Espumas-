<?php
session_start();
require_once __DIR__ . '/../app/controllers/EquipoController.php';

$c = new EquipoController();
$action = $_GET['action'] ?? '';
$id     = $_GET['id'] ?? null;

switch ($action) {
    case 'form_asignar':       $c->formAsignar($id); break;
    case 'asignar':            $c->asignar($_POST); break;
    case 'form_mantenimiento': $c->formMantenimiento($id); break;
    case 'mantenimiento':      $c->enviarMantenimiento($_POST); break;
    case 'form_baja':          $c->formBaja($id); break;
    case 'baja':               $c->darBaja($_POST); break;
    default:
        header("Location: equipos.php");
        exit;
}

