<?php include 'header.php'; ?>

<div class="container mt-4">
    <h3>Garantías por vencer (próximos 90 días)</h3>

    <?php if (empty($datos)): ?>
        <div class="alert alert-info">No hay equipos con garantías próximas a vencer.</div>
    <?php else: ?>
        <table class="table table-striped">
            <thead class="table-dark">
                <tr><th>ID</th><th>Equipo</th><th>Serial</th><th>Marca/Modelo</th><th>Fin garantía</th><th>Días restantes</th></tr>
            </thead>
            <tbody>
                <?php foreach ($datos as $d): ?>
                    <tr class="<?= $d['dias_restantes'] <= 30 ? 'table-warning' : '' ?>">
                        <td><?= $d['id_equipo'] ?></td>
                        <td><?= htmlspecialchars($d['nombre_equipo']) ?></td>
                        <td><?= htmlspecialchars($d['serial']) ?></td>
                        <td><?= htmlspecialchars($d['marca'] . ' / ' . $d['modelo']) ?></td>
                        <td><?= $d['fecha_fin_garantia'] ?></td>
                        <td><?= $d['dias_restantes'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <a href="reportes.php" class="btn btn-secondary">← Volver</a>
</div>

<?php include 'footer.php'; ?>

