<?php include 'header.php'; ?>

<div class="container mt-4">
    <h3>Activos por estado del ciclo de vida</h3>

    <table class="table table-striped">
        <thead class="table-dark"><tr><th>Estado</th><th>Cantidad</th></tr></thead>
        <tbody>
            <?php foreach ($datos as $d): ?>
                <tr>
                    <td><?= htmlspecialchars($d['estado_ciclo']) ?></td>
                    <td><?= $d['cantidad'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="reportes.php" class="btn btn-secondary">← Volver</a>
</div>

<?php include 'footer.php'; ?>

