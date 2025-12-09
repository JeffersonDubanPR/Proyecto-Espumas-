<?php
session_start();
require_once __DIR__ . '/../app/controllers/EquipoController.php';

$controller = new EquipoController();
$controller->ver($_GET['id']);
