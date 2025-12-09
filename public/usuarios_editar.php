<?php
session_start();
require_once __DIR__ . '/../app/controllers/UserController.php';

$control = new UserController();

if (!isset($_GET['id'])) {
    die("ID inválido");
}

$control->editar($_GET['id']);
