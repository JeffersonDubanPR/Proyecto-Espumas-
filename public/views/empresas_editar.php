<?php include __DIR__ . '/header.php'; ?>

<h3>Editar Empresa</h3>

<form action="empresas.php?action=actualizar" method="POST">

    <input type="hidden" name="id_empresa" value="<?= $dato['id_empresa'] ?>">

    <div class="mb-3">
        <label>Nombre</label>
        <input type="text" name="nombre" class="form-control" value="<?= $dato['nombre'] ?>" required>
    </div>

    <div class="mb-3">
        <label>Estado</label>
        <select name="estado" class="form-control">
            <option value="1" <?= $dato['estado'] == 1 ? 'selected' : '' ?>>Activo</option>
            <option value="0" <?= $dato['estado'] == 0 ? 'selected' : '' ?>>Inactivo</option>
        </select>
    </div>

    <button class="btn btn-warning">Actualizar</button>
    <a href="empresas.php" class="btn btn-secondary">Cancelar</a>

</form>

<?php include __DIR__ . '/footer.php'; ?>
