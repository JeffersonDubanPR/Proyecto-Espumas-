<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inventario TI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <span class="navbar-brand">Inventario TI</span>

        <div class="d-flex">
            <span class="navbar-text text-white me-3">
                <?= $_SESSION['usuario_nombre'] ?>
            </span>

            <a href="logout.php" class="btn btn-danger btn-sm d-flex align-items-center gap-1">

              <i class="bi bi-box-arrow-right"></i> Salir
            </a>

        </div>
    </div>
</nav>

<style>

input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}


input[type=number] {
    -moz-appearance: textfield;
}
</style>
