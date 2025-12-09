<?php include 'header.php'; ?>

<div class="container mt-4">
    <h3>Editar Usuario</h3>

    <form method="POST" action="usuarios_actualizar.php">

        <input type="hidden" name="id" value="<?= $dato['id'] ?>">

        <div class="mb-3">
            <label class="form-label">Nombre completo</label>
            <input type="text" name="nombre_completo" class="form-control"
                   value="<?= $dato['nombre_completo'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Usuario</label>
            <input type="text" name="usuario" class="form-control"
                   value="<?= $dato['usuario'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Estado</label>
            <select name="estado" class="form-select">
                <option value="1" <?= $dato['estado'] ? 'selected' : '' ?>>Activo</option>
                <option value="0" <?= !$dato['estado'] ? 'selected' : '' ?>>Inactivo</option>
            </select>
        </div>

        <button class="btn btn-primary">Guardar cambios</button>
        <a href="usuarios.php" class="btn btn-secondary">← Volver</a>

    </form>

    <hr>

    <h4>Cambiar contraseña</h4>

    <form method="POST" action="usuarios_actualizar_password.php">
        <input type="hidden" name="id" value="<?= $dato['id'] ?>">

        <div class="mb-3">
            <label class="form-label">Nueva contraseña</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button class="btn btn-warning">Actualizar contraseña</button>
    </form>
</div>
