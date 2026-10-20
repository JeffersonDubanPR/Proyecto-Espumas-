<?php include 'header.php'; ?>

<div class="container mt-4">
    <h3>Asignar equipo: <?= htmlspecialchars($dato['nombre_equipo']) ?></h3>

    <form method="POST" action="equipos_accion.php?action=asignar">
        <input type="hidden" name="id_equipo" value="<?= $dato['id_equipo'] ?>">

        <div class="mb-3">
            <label>Usuario destino</label>
            <select name="id_usuario_destino" class="form-select">
                <option value="">-- Seleccione --</option>
                <?php foreach ($usuarios as $u): ?>
                    <option value="<?= $u['id'] ?>"><?= htmlspecialchars($u['nombre_completo']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Sede destino</label>
            <select name="id_sede_destino" class="form-select">
                <option value="">-- Seleccione --</option>
                <?php foreach ($sedes as $s): ?>
                    <option value="<?= $s['id_sede'] ?>"><?= htmlspecialchars($s['nombre_sede']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Observaciones</label>
            <textarea name="observaciones" class="form-control" rows="2"></textarea>
        </div>

        <button class="btn btn-success">Registrar asignación</button>
        <a href="equipos_ver.php?id=<?= $dato['id_equipo'] ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php include 'footer.php'; ?>


