<?php include 'header.php'; ?>

<div class="container mt-4">
    <h3>Inventario valorizado</h3>

    <table class="table table-striped">
        <thead class="table-dark">
            <tr><th>Empresa</th><th>Sede</th><th>Equipos</th><th>Valor total</th></tr>
        </thead>
        <tbody>
            <?php foreach ($datos as $d): ?>
                <tr>
                    <td><?= htmlspecialchars($d['empresa'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($d['sede'] ?? 'N/A') ?></td>
                    <td><?= $d['total_equipos'] ?></td>
                    <td>$<?= number_format($d['valor_total'], 2) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="reportes.php" class="btn btn-secondary">← Volver</a>
</div>

<?php include 'footer.php'; ?>


