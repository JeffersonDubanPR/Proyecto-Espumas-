<?php include 'header.php'; ?>

<div class="container mt-4">
    <h3>Nuevo Equipo</h3>

    <form method="POST" action="equipos.php?action=guardar">
        <div class="row">
            <!-- Datos básicos -->
            <div class="col-md-6 mb-3">
                <label>Nombre del equipo</label>
                <input type="text" name="nombre_equipo" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Nomenclatura</label>
                <input type="text" name="nomenclatura" class="form-control" required>
            </div>

            <div class="col-md-4 mb-3"><label>Tipo</label><input type="text" name="tipo_equipo" class="form-control"></div>
            <div class="col-md-4 mb-3"><label>Marca</label><input type="text" name="marca" class="form-control"></div>
            <div class="col-md-4 mb-3"><label>Modelo</label><input type="text" name="modelo" class="form-control"></div>

            <div class="col-md-4 mb-3"><label>Serial</label><input type="text" name="serial" class="form-control"></div>
            <div class="col-md-4 mb-3"><label>Procesador</label><input type="text" name="procesador" class="form-control"></div>
            <div class="col-md-4 mb-3"><label>Memoria</label><input type="text" name="memoria" class="form-control" placeholder="Ej: 16 GB"></div>

            <div class="col-md-4 mb-3"><label>Tipo disco</label><input type="text" name="tipo_disco" class="form-control"></div>
            <div class="col-md-4 mb-3"><label>Capacidad disco</label><input type="text" name="capacidad_disco" class="form-control"></div>
            <div class="col-md-4 mb-3"><label>SO</label><input type="text" name="os" class="form-control"></div>

            <div class="col-md-4 mb-3"><label>Activo fijo</label><input type="text" name="activo_fijo" class="form-control"></div>
            <div class="col-md-4 mb-3"><label>N° inventario</label><input type="text" name="numero_inventario" class="form-control"></div>
            <div class="col-md-4 mb-3">
                <label>Leasing</label>
                <select name="leasing" class="form-select">
                    <option value="N/A">N/A</option>
                    <option value="SI">Sí</option>
                    <option value="NO">No</option>
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label>Antivirus</label>
                <select name="antivirus" class="form-select">
                    <option value="N/A">N/A</option>
                    <option value="SI">Sí</option>
                    <option value="NO">No</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label>Estado ciclo</label>
                <select name="estado_ciclo" class="form-select">
                    <option value="Registrado">Registrado</option>
                    <option value="En Uso">En Uso</option>
                    <option value="En Mantenimiento">En Mantenimiento</option>
                    <option value="De Baja">De Baja</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label>Estado operativo</label>
                <select name="estado" class="form-select">
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select>
            </div>

            <!-- ITAM -->
            <div class="col-md-4 mb-3"><label>Valor de compra</label><input type="number" step="0.01" name="valor_compra" class="form-control"></div>
            <div class="col-md-4 mb-3"><label>Fecha de adquisición</label><input type="date" name="fecha_adquisicion" class="form-control"></div>
            <div class="col-md-4 mb-3"><label>Fin de garantía</label><input type="date" name="fecha_fin_garantia" class="form-control"></div>

            <div class="col-md-12 mb-3"><label>Observación</label><textarea name="observacion" class="form-control" rows="2"></textarea></div>

            <h4 class="mt-3">Responsable</h4>
            <div class="col-md-4 mb-3"><label>Usuario dominio</label><input type="text" name="usuario_dominio" class="form-control"></div>
            <div class="col-md-4 mb-3"><label>Responsable</label><input type="text" name="responsable" class="form-control"></div>
            <div class="col-md-4 mb-3"><label>Cédula</label><input type="text" name="cedula_responsable" class="form-control"></div>
            <div class="col-md-4 mb-3"><label>Cargo</label><input type="text" name="cargo" class="form-control"></div>
            <div class="col-md-4 mb-3"><label>Área</label><input type="text" name="area" class="form-control"></div>
            <div class="col-md-4 mb-3"><label>CECO</label><input type="text" name="ceco" class="form-control"></div>

            <div class="col-md-6 mb-3">
                <label>Empresa</label>
                <select name="id_empresa" class="form-select" required>
                    <option value="">Seleccione</option>
                    <?php foreach ($empresas as $e): ?>
                        <option value="<?= $e['id_empresa'] ?>"><?= $e['nombre'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label>Sede</label>
                <select name="id_sede" class="form-select" required>
                    <option value="">Seleccione</option>
                    <?php foreach ($sedes as $s): ?>
                        <option value="<?= $s['id_sede'] ?>"><?= $s['nombre_sede'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <button class="btn btn-primary">Guardar</button>
        <a href="equipos.php" class="btn btn-secondary">← Volver</a>
    </form>
</div>

<?php include 'footer.php'; ?>




