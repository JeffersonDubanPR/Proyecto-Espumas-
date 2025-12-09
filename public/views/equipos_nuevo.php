<?php include 'header.php'; ?>

<div class="container mt-4">
    <h3>Nuevo Equipo</h3>
 

    <form method="POST" action="../equipos_guardar.php">

        <div class="row">

            <div class="col-md-6 mb-3">
                <label>Nombre del equipo</label>
                <input type="text" name="nombre_equipo" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Nomenclatura</label>
                <input type="text" name="nomenclatura" class="form-control" required>
            </div>

            <div class="col-md-4 mb-3">
                <label>Tipo equipo</label>
                <input type="text" name="tipo_equipo" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>Marca</label>
                <input type="text" name="marca" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>Modelo</label>
                <input type="text" name="modelo" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>Serial</label>
                <input type="text" name="serial" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>Procesador</label>
                <input type="text" name="procesador" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>Memoria RAM (GB)</label>
                <input type="number" name="memoria" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>Tipo disco</label>
                <input type="text" name="tipo_disco" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>Capacidad disco (GB)</label>
                <input type="number" name="capacidad_disco" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>Sistema operativo</label>
                <input type="text" name="os" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>Activo fijo</label>
                <input type="text" name="activo_fijo" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>N° Inventario</label>
                <input type="text" name="numero_inventario" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>Leasing</label>
                <input type="text" name="leasing" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>Antivirus</label>
                <input type="text" name="antivirus" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>Estado</label>
                <select name="estado" class="form-select">
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select>
            </div>

            <div class="col-md-12 mb-3">
                <label>Observación</label>
                <textarea name="observacion" class="form-control"></textarea>
            </div>

            <h4 class="mt-3">Información del responsable</h4>

            <div class="col-md-4 mb-3">
                <label>Usuario dominio</label>
                <input type="text" name="usuario_dominio" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>Responsable</label>
                <input type="text" name="responsable" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>Cédula responsable</label>
                <input type="text" name="cedula_responsable" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>Cargo</label>
                <input type="text" name="cargo" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>Área</label>
                <input type="text" name="area" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>CECO</label>
                <input type="text" name="ceco" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Empresa</label>
                <select name="id_empresa" class="form-select" required>
                    <option value="">Seleccione</option>
                    <?php foreach ($empresas as $emp): ?>
                        <option value="<?= $emp['id_empresa'] ?>"><?= $emp['nombre'] ?></option>
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
        <a href="../equipos.php" class="btn btn-secondary">← Volver</a>
    </form>
</div>

