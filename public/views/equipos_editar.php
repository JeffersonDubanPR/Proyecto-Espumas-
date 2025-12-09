<?php include 'header.php'; ?>

<div class="container mt-4">
    <h3>Editar Equipo</h3>

    <form method="POST" action="equipos_actualizar.php">

        <input type="hidden" name="id_equipo" value="<?= $dato['id_equipo'] ?>">

        <div class="row">

            <div class="col-md-6 mb-3">
                <label>Nombre del equipo</label>
                <input type="text" name="nombre_equipo" value="<?= $dato['nombre_equipo'] ?>" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Nomenclatura</label>
                <input type="text" name="nomenclatura" value="<?= $dato['nomenclatura'] ?>" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>Tipo de equipo</label>
                <input type="text" name="tipo_equipo" value="<?= $dato['tipo_equipo'] ?>" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>Marca</label>
                <input type="text" name="marca" value="<?= $dato['marca'] ?>" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>Modelo</label>
                <input type="text" name="modelo" value="<?= $dato['modelo'] ?>" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Serial</label>
                <input type="text" name="serial" value="<?= $dato['serial'] ?>" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Procesador</label>
                <input type="text" name="procesador" value="<?= $dato['procesador'] ?>" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>Memoria (GB)</label>
                <input type="text" name="memoria" value="<?= $dato['memoria'] ?>" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>Tipo disco</label>
                <input type="text" name="tipo_disco" value="<?= $dato['tipo_disco'] ?>" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>Capacidad disco (GB)</label>
                <input type="number" name="capacidad_disco" value="<?= $dato['capacidad_disco'] ?>" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Sistema operativo</label>
                <input type="text" name="os" value="<?= $dato['os'] ?>" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Activo fijo</label>
                <input type="text" name="activo_fijo" value="<?= $dato['activo_fijo'] ?>" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Número inventario</label>
                <input type="text" name="numero_inventario" value="<?= $dato['numero_inventario'] ?>" class="form-control">
            </div>

            <div class="col-md-3 mb-3">
                <label>Leasing</label>
                <select name="leasing" class="form-select">
                    <option value="1" <?= $dato['leasing'] ? 'selected' : '' ?>>Sí</option>
                    <option value="0" <?= !$dato['leasing'] ? 'selected' : '' ?>>No</option>
                </select>
            </div>

            <div class="col-md-3 mb-3">
                <label>Antivirus</label>
                <select name="antivirus" class="form-select">
                    <option value="1" <?= $dato['antivirus'] ? 'selected' : '' ?>>Sí</option>
                    <option value="0" <?= !$dato['antivirus'] ? 'selected' : '' ?>>No</option>
                </select>
            </div>

            <div class="col-md-3 mb-3">
                <label>Estado</label>
                <select name="estado" class="form-select">
                    <option value="1" <?= $dato['estado'] ? 'selected' : '' ?>>Operativo</option>
                    <option value="0" <?= !$dato['estado'] ? 'selected' : '' ?>>Inactivo</option>
                </select>
            </div>

            <div class="col-md-12 mb-3">
                <label>Observación</label>
                <textarea name="observacion" class="form-control" rows="2"><?= $dato['observacion'] ?></textarea>
            </div>

            <div class="col-md-6 mb-3">
                <label>Empresa</label>
                <select name="id_empresa" class="form-select">
                    <?php foreach ($empresas as $e): ?>
                        <option value="<?= $e['id_empresa'] ?>" 
                            <?= $dato['id_empresa'] == $e['id_empresa'] ? 'selected' : '' ?>>
                            <?= $e['nombre'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Sede</label>
                <select name="id_sede" class="form-select">
                    <?php foreach ($sedes as $s): ?>
                        <option value="<?= $s['id_sede'] ?>" 
                            <?= $dato['id_sede'] == $s['id_sede'] ? 'selected' : '' ?>>
                            <?= $s['nombre_sede'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

        </div>

        <button class="btn btn-primary">Guardar cambios</button>
        <a href="equipos.php" class="btn btn-secondary">← Volver</a>

    </form>
</div>
