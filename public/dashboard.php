<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Inventario TI</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background: #f5f6fa; }
        .card-dashboard { transition: 0.3s; cursor: pointer; }
        .card-dashboard:hover { transform: translateY(-5px); }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <span class="navbar-brand">Inventario TI - Grupo Espumas Santa Fe</span>

        <div class="d-flex">
            <span class="navbar-text me-3 text-white">
                <?= $_SESSION['usuario_nombre'] ?>
            </span>
            <a href="logout.php" class="btn btn-outline-light btn-sm">Cerrar sesión</a>
            <a href="dashboard.php" class="btn btn-secondary mb-3">← Volver</a>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <h3 class="mb-4">Panel Principal</h3>

    <div class="row">

        <div class="col-md-4 mb-3">
            <a href="empresas.php" class="text-decoration-none">
                <div class="card card-dashboard shadow-sm p-4 text-center">
                    <h4>Empresas</h4>
                    <p class="text-muted">Administrar empresas del grupo</p>
                </div>
            </a>
        </div>

        <div class="col-md-4 mb-3">
            <a href="sedes.php" class="text-decoration-none">
                <div class="card card-dashboard shadow-sm p-4 text-center">
                    <h4> Sedes</h4>
                    <p class="text-muted">Gestionar sedes por empresa</p>
                </div>
            </a>
        </div>


        <div class="col-md-4 mb-3">
         <a href="usuarios.php" class="text-decoration-none">
        <div class="card card-dashboard shadow-sm p-4 text-center">
            <h4>Usuarios</h4>
            <p class="text-muted">Gestión de personal</p>
        </div>
    </a>
</div>


        <a href="equipos.php" class="text-decoration-none">
          <div class="card card-dashboard shadow-sm p-4 text-center">
            <h4> Equipos</h4>
              <p class="text-muted">Inventario tecnológico general</p>
           </div>
        </a>


        <div class="col-md-4 mb-3">
            <a href="#" class="text-decoration-none">
                <div class="card card-dashboard shadow-sm p-4 text-center">
                    <h4> Importar Datos </h4>
                    <p class="text-muted">Cargar información masiva</p>
                </div>
            </a>
        </div>



    </div>
</div>

</body>
</html>



