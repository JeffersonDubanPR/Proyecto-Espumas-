<?php include 'header.php'; ?>

<div class="container mt-4">
    <h3>Editar Equipo</h3>

    <form method="POST" action="equipos_actualizar.php">
        <input type="hidden" name="id_equipo" value="<?= $dato['id_equipo'] ?>">

        <div class="row">
            <div class="col-md-6 mb-3"><label>Nombre</label><input type="text" name="nombre_equipo" value="<?= htmlspecialchars($dato['nombre_equipo']) ?>" class="form-control" required></div>
            <div class="col-md-6 mb-3"><label>Nomenclatura</label><input type="text" name="nomenclatura" value="<?= htmlspecialchars($dato['nomenclatura']) ?>" class="form-control"></div>

            <div class="col-md-4 mb-3"><label>Tipo</label><input type="text" name="tipo_equipo" value="<?= htmlspecialchars($dato['tipo_equipo']) ?>" class="form-control"></div>
            <div class="col-md-4 mb-3"><label>Marca</label><input type="text" name="marca" value="<?= htmlspecialchars($dato['marca']) ?>" class="form-control"></div>
            <div class="col-md-4 mb-3"><label>Modelo</label><input type="text" name="modelo" value="<?= htmlspecialchars($dato['modelo']) ?>" class="form-control"></div>

            <div class="col-md-4 mb-3"><label>Serial</label><input type="text" name="serial" value="<?= htmlspecialchars($dato['serial']) ?>" class="form-control"></div>
            <div class="col-md-4 mb-3"><label>Procesador</label><input type="text" name="procesador" value="<?= htmlspecialchars($dato['procesador']) ?>" class="form-control"></div>
            <div class="col-md-4 mb-3"><label>Memoria</label><input type="text" name="memoria" value="<?= htmlspecialchars($dato['memoria']) ?>" class="form-control"></div>

            <div class="col-md-4 mb-3"><label>Tipo disco</label><input type="text" name="tipo_disco" value="<?= htmlspecialchars($dato['tipo_disco']) ?>" class="form-control"></div>
            <div class="col-md-4 mb-3"><label>Capacidad disco</label><input type="text" name="capacidad_disco" value="<?= htmlspecialchars($dato['capacidad_disco']) ?>" class="form-control"></div>
            <div class="col-md-4 mb-3"><label>SO</label><input type="text" name="os" value="<?= htmlspecialchars($dato['os']) ?>" class="form-control"></div>

            <div class="col-md-4 mb-3"><label>Activo fijo</label><input type="text" name="activo_fijo" value="<?= htmlspecialchars($dato['activo_fijo']) ?>" class="form-control"></div>
            <div class="col-md-4 mb-3"><label>N° inventario</label><input type="text" name="numero_inventario" value="<?= htmlspecialchars($dato['numero_inventario']) ?>" class="form-control"></div>

            <div class="col-md-4 mb-3">
                <label>Leasing</label>
                <select name="leasing" class="form-select">
                    <?php foreach (['N/A','SI','NO'] as $opt): ?>
                        <option value="<?= $opt ?>" <?= $dato['leasing'] === $opt ? 'selected' : '' ?>><?= $opt ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label>Antivirus</label>
                <select name="antivirus" class="form-select">
                    <?php foreach (['N/A','SI','NO'] as $opt): ?>
                        <option value="<?= $opt ?>" <?= $dato['antivirus'] === $opt ? 'selected' : '' ?>><?= $opt ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label>Estado ciclo</label>
                <select name="estado_ciclo" class="form-select">
                    <?php foreach (['Registrado','En Uso','En Mantenimiento','De Baja'] as $opt): ?>
                        <option value="<?= $opt ?>" <?= $dato['estado_ciclo'] === $opt ? 'selected' : '' ?>><?= $opt ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label>Estado operativo</label>
                <select name="estado" class="form-select">
                    <option value="1" <?= $dato['estado'] ? 'selected' : '' ?>>Activo</option>
                    <option value="0" <?= !$dato['estado'] ? 'selected' : '' ?>>Inactivo</option>
                </select>
            </div>

            <div class="col-md-4 mb-3"><label>Valor compra</label><input type="number" step="0.01" name="valor_compra" value="<?= $dato['valor_compra'] ?>" class="form-control"></div>
            <div class="col-md-4 mb-3"><label>Fecha adquisición</label><input type="date" name="fecha_adquisicion" value="<?= $dato['fecha_adquisicion'] ?>" class="form-control"></div>
            <div class="col-md-4 mb-3"><label>Fin garantía</label><input type="date" name="fecha_fin_garantia" value="<?= $dato['fecha_fin_garantia'] ?>" class="form-control"></div>

            <div class="col-md-12 mb-3"><label>Observación</label><textarea name="observacion" class="form-control" rows="2"><?= htmlspecialchars($dato['observacion']) ?></textarea></div>

            <h4 class="mt-3">Responsable</h4>
            <div class="col-md-4 mb-3"><label>Usuario dominio</label><input type="text" name="usuario_dominio" value="<?= htmlspecialchars($dato['usuario_dominio']) ?>" class="form-control"></div>
            <div class="col-md-4 mb-3"><label>Responsable</label><input type="text" name="responsable" value="<?= htmlspecialchars($dato['responsable']) ?>" class="form-control"></div>
            <div class="col-md-4 mb-3"><label>Cédula</label><input type="text" name="cedula_responsable" value="<?= htmlspecialchars($dato['cedula_responsable']) ?>" class="form-control"></div>
            <div class="col-md-4 mb-3"><label>Cargo</label><input type="text" name="cargo" value="<?= htmlspecialchars($dato['cargo']) ?>" class="form-control"></div>
            <div class="col-md-4 mb-3"><label>Área</label><input type="text" name="area" value="<?= htmlspecialchars($dato['area']) ?>" class="form-control"></div>
            <div class="col-md-4 mb-3"><label>CECO</label><input type="text" name="ceco" value="<?= htmlspecialchars($dato['ceco']) ?>" class="form-control"></div>

            <div class="col-md-6 mb-3">
                <label>Empresa</label>
                <select name="id_empresa" class="form-select">
                    <?php foreach ($empresas as $e): ?>
                        <option value="<?= $e['id_empresa'] ?>" <?= $dato['id_empresa'] == $e['id_empresa'] ? 'selected' : '' ?>><?= $e['nombre'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label>Sede</label>
                <select name="id_sede" class="form-select">
                    <?php foreach ($sedes as $s): ?>
                        <option value="<?= $s['id_sede'] ?>" <?= $dato['id_sede'] == $s['id_sede'] ? 'selected' : '' ?>><?= $s['nombre_sede'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <button class="btn btn-primary">Guardar cambios</button>
        <a href="equipos_ver.php?id=<?= $dato['id_equipo'] ?>" class="btn btn-secondary">← Volver</a>
    </form>
</div>

<?php include 'footer.php'; ?>


