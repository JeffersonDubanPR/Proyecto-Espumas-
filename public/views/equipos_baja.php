<?php include 'header.php'; ?>

<div class="container mt-4">
    <h3>Dar de baja: <?= htmlspecialchars($dato['nombre_equipo']) ?></h3>

    <div class="alert alert-warning">
        Una vez dada de baja, el activo quedará en estado <strong>De Baja</strong> y no podrá volver a asignarse.
    </div>

    <form method="POST" action="equipos_accion.php?action=baja">
        <input type="hidden" name="id_equipo" value="<?= $dato['id_equipo'] ?>">

        <div class="mb-3">
            <label>Fecha de baja</label>
            <input type="date" name="fecha_baja" class="form-control" value="<?= date('Y-m-d') ?>" required>
        </div>

        <div class="mb-3">
            <label>Motivo</label>
            <textarea name="motivo" class="form-control" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label>Valor residual</label>
            <input type="number" step="0.01" name="valor_residual" class="form-control" value="0">
        </div>

        <button class="btn btn-danger" onclick="return confirm('¿Confirmar baja del activo?')">Confirmar baja</button>
        <a href="equipos_ver.php?id=<?= $dato['id_equipo'] ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php include 'footer.php'; ?>


