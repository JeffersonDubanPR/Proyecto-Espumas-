<?php include 'header.php'; ?>

<div class="container mt-4">
    <h3>Nuevo Usuario</h3>

    <!-- FORMULARIO CORREGIDO -->
    <form method="POST" action="../usuarios_guardar.php">



        <div class="mb-3">
            <label class="form-label">Nombre completo</label>
            <input type="text" name="nombre_completo" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Usuario</label>
            <input type="text" name="usuario" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Contraseña</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Estado</label>
            <select class="form-select" name="estado">
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
        </div>

        <button class="btn btn-primary">Guardar</button>
        <a href="../usuarios.php" class="btn btn-secondary">← Volver</a>

    </form>
</div>
