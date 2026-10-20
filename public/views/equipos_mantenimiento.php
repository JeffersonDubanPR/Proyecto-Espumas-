<?php include 'header.php'; ?>

<div class="container mt-4">
    <h3>Registrar mantenimiento: <?= htmlspecialchars($dato['nombre_equipo']) ?></h3>

    <form method="POST" action="equipos_accion.php?action=mantenimiento">
        <input type="hidden" name="id_equipo" value="<?= $dato['id_equipo'] ?>">

        <div class="mb-3">
            <label>Tipo</label>
            <select name="tipo" class="form-select" required>
                <option value="Preventivo">Preventivo</option>
                <option value="Correctivo">Correctivo</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="descripcion" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label>Fecha programada</label>
            <input type="date" name="fecha_programada" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Fecha ejecución (opcional)</label>
            <input type="date" name="fecha_ejecucion" class="form-control">
        </div>

        <div class="mb-3">
            <label>Costo</label>
            <input type="number" step="0.01" name="costo" class="form-control">
        </div>

        <div class="mb-3">
            <label>Técnico responsable</label>
            <select name="id_tecnico" class="form-select">
                <option value="">-- Seleccione --</option>
                <?php foreach ($usuarios as $u): ?>
                    <option value="<?= $u['id'] ?>"><?= htmlspecialchars($u['nombre_completo']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button class="btn btn-warning">Programar mantenimiento</button>
        <a href="equipos_ver.php?id=<?= $dato['id_equipo'] ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php include 'footer.php'; ?>


