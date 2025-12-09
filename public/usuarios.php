<?php
session_start();
require_once __DIR__ . '/../app/controllers/UserController.php';

$control = new UserController();
$control->index();

