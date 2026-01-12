<?php
session_start();
require_once __DIR__ . '/../app/config/config.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - <?php echo APP_NAME; ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body, html {
            height: 100%;
            margin: 0;
        }

        
        body {
            background: url('img/img1.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        <body style="
          background: url('img/img1.jpg') no-repeat center center fixed;
          background-size: 110%; 
        ">


        

        .overlay-dark {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.45);
            z-index: 0;
        }

    
        .login-card {
            z-index: 2;
            backdrop-filter: blur(6px);
            background: rgba(255, 255, 255, 0.18);
            border-radius: 12px;
            padding: 25px;
        }

        label, .text-white {
            text-shadow: 0 1px 2px rgba(0,0,0,0.5);
        }
    </style>
</head>

<body>

<!-- OSCURECER FONDO -->
<div class="overlay-dark"></div>

<!-- FORMULARIO LOGIN -->
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="col-md-4">

        <div class="login-card shadow-lg border-0 text-white">

            <div class="text-center mb-3">
                <h3 class="fw-bold">Inventario TI</h3>
                <small>Grupo Espumas Santa Fe</small>
            </div>

            <?php if (isset($_SESSION['error_login'])): ?>
                <div class="alert alert-danger">
                    <?= $_SESSION['error_login']; unset($_SESSION['error_login']); ?>
                </div>
            <?php endif; ?>

            <form action="procesar_login.php" method="POST">

                <div class="mb-3">
                    <label class="form-label">Usuario</label>
                    <input type="text" name="usuario" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Contraseña</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button class="btn btn-primary w-100 py-2">Ingresar</button>
            </form>

            <div class="text-center mt-3">
                <small>Área TI - Uso interno</small>
            </div>

        </div>
    </div>
</div>

</body>
</html>
