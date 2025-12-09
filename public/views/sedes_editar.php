<?php include __DIR__ . '/header.php'; ?>

<h3>Editar Sede</h3>

<form action="sedes.php?action=actualizar" method="POST">

    <input type="hidden" name="id_sede" value="<?= $dato['id_sede'] ?>">

    <div class="mb-3">
        <label>Empresa</label>
        <select name="id_empresa" class="form-control" required>
            <?php foreach ($empresas as $e): ?>
                <option value="<?= $e['id_empresa'] ?>"
                    <?= $e['id_empresa'] == $dato['id_empresa'] ? 'selected' : '' ?>>
                    <?= $e['nombre'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label>Nombre de la sede</label>
        <input type="text" 
               name="nombre_sede" 
               class="form-control"
               value="<?= $dato['nombre_sede'] ?>" required>
    </div>

    <div class="mb-3">
        <label>Ciudad</label>
        <input type="text" 
               name="ciudad" 
               class="form-control"
               value="<?= $dato['ciudad'] ?>">
    </div>

    <div class="mb-3">
        <label>Dirección</label>
        <input type="text" 
               name="direccion" 
               class="form-control"
               value="<?= $dato['direccion'] ?>">
    </div>

    <button class="btn btn-warning">Actualizar</button>
                

    

</form>

<?php include __DIR__ . '/footer.php'; ?>
