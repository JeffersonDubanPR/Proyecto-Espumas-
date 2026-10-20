<?php
session_start();
require_once __DIR__ . '/../app/controllers/ReporteController.php';

$c = new ReporteController();
$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'valorizado':  $c->inventarioValorizado(); break;
    case 'estado':      $c->activosPorEstado(); break;
    case 'garantias':   $c->garantiasPorVencer(); break;
    default:            $c->index(); break;
}

