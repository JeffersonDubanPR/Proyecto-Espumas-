<?php include 'header.php'; ?>

<div class="container mt-4">
    <h3>Registrar Nuevo Equipo</h3>

    <form method="POST" action="../equipos_guardar.php">

        <div class="row">
            <div class="col-md-6">
                <label>Nombre del equipo</label>
                <input type="text" name="nombre_equipo" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label>Nomenclatura</label>
                <input type="text" name="nomenclatura" class="form-control">
            </div>
        </div>

        <!-- Más campos aquí (ya te los envié en la versión completa) -->

        <button class="btn btn-primary mt-3">Guardar equipo</button>
        <a href="equipos.php" class="btn btn-secondary mt-3">Volver</a>
    </form>
</div>
