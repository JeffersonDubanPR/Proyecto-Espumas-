<?php include 'header.php'; ?>

<div class="container mt-4">
    <h3>Importar inventario desde Excel</h3>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-body">
            <p class="text-muted">
                Sube tu archivo <strong>.xlsx</strong>, <strong>.xls</strong> o <strong>.csv (separador ;)</strong>.
                El archivo debe respetar el orden de las <strong>43 columnas</strong> del formato original.
                Las celdas vacías o con "N/A", "NA", "-", etc., se guardarán como <strong>"N/A"</strong>.
            </p>

            <form method="POST" action="importar_equipos.php?action=procesar" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Archivo</label>
                    <input type="file" name="archivo" class="form-control" accept=".xlsx,.xls,.csv" required>
                </div>
                <button class="btn btn-success">Importar inventario</button>
                <a href="equipos.php" class="btn btn-secondary">← Volver</a>
            </form>

            <hr>
            <h5>¿No tienes el formato?</h5>
            <a href="importar_equipos.php?action=plantilla" class="btn btn-outline-primary btn-sm">
                ⬇ Descargar plantilla CSV
            </a>
        </div>
    </div>

    <?php if (!empty($_SESSION['errores_import'])): ?>
        <div class="alert alert-warning mt-3">
            <strong>Filas con errores:</strong>
            <ul>
                <?php foreach ($_SESSION['errores_import'] as $err): ?>
                    <li><?= htmlspecialchars($err) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php unset($_SESSION['errores_import']); ?>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>


