<?php include 'header.php'; ?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Nueva Sede</h3>
        <a href="sedes.php" class="btn btn-secondary">← Volver</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="sedes.php?action=guardar" method="POST">

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Empresa</label>
                        <select name="id_empresa" required class="form-select">
                            <option value="">Seleccione</option>
                            <?php foreach ($empresas as $e): ?>
                                <option value="<?= $e['id_empresa'] ?>">
                                    <?= $e['nombre'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nombre de la sede</label>
                        <input type="text" name="nombre_sede" required class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Ciudad</label>
                        <input type="text" name="ciudad" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Dirección</label>
                        <input type="text" name="direccion" class="form-control">
                    </div>

                </div>

                <div class="mt-3">
                    <button class="btn btn-primary">Guardar sede</button>
                    <a href="sedes.php" class="btn btn-outline-secondary ms-2">Cancelar</a>
                </div>

            </form>

        </div>
    </div>

</div>

