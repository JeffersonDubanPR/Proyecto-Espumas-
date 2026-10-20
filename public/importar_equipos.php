<?php
session_start();
require_once __DIR__ . '/../app/controllers/ImportController.php';

$c = new ImportController();
$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'procesar':   $c->procesar(); break;
    case 'plantilla':  $c->descargarPlantilla(); break;
    default:           $c->index(); break;
}

