<?php
session_start();
require_once __DIR__ . '/../app/controllers/UserController.php';

$controller = new UserController();
$controller->actualizarPassword($_POST);

