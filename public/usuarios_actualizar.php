<?php
session_start();
require_once __DIR__ . '/../app/controllers/UserController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new UserController();
    $controller->actualizar($_POST);
} else {
    header('Location: usuarios.php');
    exit;
}


