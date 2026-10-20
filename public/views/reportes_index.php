<?php include 'header.php'; ?>

<div class="container mt-4">
    <h3>Reportes</h3>
    <p class="text-muted">Indicadores para la toma de decisiones del área de TI.</p>

    <div class="row">
        <div class="col-md-4 mb-3">
            <a href="reportes.php?action=valorizado" class="text-decoration-none">
                <div class="card shadow-sm p-4 text-center h-100">
                    <h5>Inventario valorizado</h5>
                    <p class="text-muted small mb-0">Total de equipos y valor por sede y empresa</p>
                </div>
            </a>
        </div>
        <div class="col-md-4 mb-3">
            <a href="reportes.php?action=estado" class="text-decoration-none">
                <div class="card shadow-sm p-4 text-center h-100">
                    <h5>Activos por estado</h5>
                    <p class="text-muted small mb-0">Distribución del ciclo de vida</p>
                </div>
            </a>
        </div>
        <div class="col-md-4 mb-3">
            <a href="reportes.php?action=garantias" class="text-decoration-none">
                <div class="card shadow-sm p-4 text-center h-100">
                    <h5>Garantías por vencer</h5>
                    <p class="text-muted small mb-0">Próximos 90 días</p>
                </div>
            </a>
        </div>
    </div>

    <a href="dashboard.php" class="btn btn-secondary">← Volver</a>
</div>

<?php include 'footer.php'; ?>

