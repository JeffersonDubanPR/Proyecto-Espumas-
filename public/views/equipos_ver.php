<?php include 'header.php'; ?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Detalle del equipo</h3>
        <div class="d-flex gap-2">
            <a href="equipos_accion.php?action=form_asignar&id=<?= $dato['id_equipo'] ?>" class="btn btn-success btn-sm">Asignar</a>
            <a href="equipos_accion.php?action=form_mantenimiento&id=<?= $dato['id_equipo'] ?>" class="btn btn-warning btn-sm">Enviar a Mantenimiento</a>
            <a href="equipos_accion.php?action=form_baja&id=<?= $dato['id_equipo'] ?>" class="btn btn-danger btn-sm">Dar de Baja</a>
        </div>
    </div>

    <div class="card shadow p-4 mb-4">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Nombre:</strong> <?= htmlspecialchars($dato['nombre_equipo']) ?></p>
                <p><strong>Nomenclatura:</strong> <?= htmlspecialchars($dato['nomenclatura']) ?></p>
                <p><strong>Tipo:</strong> <?= htmlspecialchars($dato['tipo_equipo']) ?></p>
                <p><strong>Marca / Modelo:</strong> <?= htmlspecialchars($dato['marca']) ?> / <?= htmlspecialchars($dato['modelo']) ?></p>
                <p><strong>Serial:</strong> <?= htmlspecialchars($dato['serial']) ?></p>
                <p><strong>Procesador:</strong> <?= htmlspecialchars($dato['procesador']) ?></p>
                <p><strong>Memoria:</strong> <?= htmlspecialchars($dato['memoria']) ?></p>
                <p><strong>Disco:</strong> <?= htmlspecialchars($dato['tipo_disco']) ?> (<?= htmlspecialchars($dato['capacidad_disco']) ?>)</p>
                <p><strong>SO:</strong> <?= htmlspecialchars($dato['os']) ?></p>
            </div>
            <div class="col-md-6">
                <p><strong>Empresa:</strong> <?= htmlspecialchars($dato['empresa'] ?? 'N/A') ?></p>
                <p><strong>Sede:</strong> <?= htmlspecialchars($dato['sede'] ?? 'N/A') ?></p>
                <p><strong>Responsable:</strong> <?= htmlspecialchars($dato['responsable']) ?></p>
                <p><strong>Cédula:</strong> <?= htmlspecialchars($dato['cedula_responsable']) ?></p>
                <p><strong>Cargo:</strong> <?= htmlspecialchars($dato['cargo']) ?></p>
                <p><strong>Área:</strong> <?= htmlspecialchars($dato['area']) ?></p>
                <p><strong>CECO:</strong> <?= htmlspecialchars($dato['ceco']) ?></p>
                <p><strong>Estado ciclo:</strong> <span class="badge bg-info"><?= $dato['estado_ciclo'] ?></span></p>
                <p><strong>Valor compra:</strong> <?= $dato['valor_compra'] ? '$' . number_format($dato['valor_compra'], 2) : 'N/A' ?></p>
                <p><strong>Adquisición:</strong> <?= $dato['fecha_adquisicion'] ?: 'N/A' ?></p>
                <p><strong>Fin garantía:</strong> <?= $dato['fecha_fin_garantia'] ?: 'N/A' ?></p>
            </div>
        </div>
        <hr>
        <p><strong>Observación:</strong> <?= nl2br(htmlspecialchars($dato['observacion'])) ?></p>
    </div>

    <h4>Historial de movimientos</h4>
    <table class="table table-sm table-bordered">
        <thead class="table-light"><tr><th>Fecha</th><th>Tipo</th><th>Origen</th><th>Destino</th><th>Observaciones</th></tr></thead>
        <tbody>
            <?php if (empty($movimientos)): ?>
                <tr><td colspan="5" class="text-center text-muted">Sin movimientos</td></tr>
            <?php else: foreach ($movimientos as $m): ?>
                <tr>
                    <td><?= $m['fecha_movimiento'] ?></td>
                    <td><?= $m['tipo_movimiento'] ?></td>
                    <td><?= htmlspecialchars($m['usuario_origen'] ?? $m['sede_origen'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($m['usuario_destino'] ?? $m['sede_destino'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($m['observaciones']) ?></td>
                </tr>
            <?php endforeach; endif; ?>
        </tbody>
    </table>

    <h4>Mantenimientos</h4>
    <table class="table table-sm table-bordered">
        <thead class="table-light"><tr><th>Tipo</th><th>Descripción</th><th>Programado</th><th>Ejecutado</th><th>Costo</th><th>Estado</th></tr></thead>
        <tbody>
            <?php if (empty($mantenimientos)): ?>
                <tr><td colspan="6" class="text-center text-muted">Sin mantenimientos</td></tr>
            <?php else: foreach ($mantenimientos as $m): ?>
                <tr>
                    <td><?= $m['tipo'] ?></td>
                    <td><?= htmlspecialchars($m['descripcion']) ?></td>
                    <td><?= $m['fecha_programada'] ?></td>
                    <td><?= $m['fecha_ejecucion'] ?: '-' ?></td>
                    <td><?= $m['costo'] ?></td>
                    <td><?= $m['estado'] ?></td>
                </tr>
            <?php endforeach; endif; ?>
        </tbody>
    </table>

    <?php if (!empty($bajaInfo)): ?>
        <h4>Baja</h4>
        <div class="alert alert-danger">
            <strong>Fecha:</strong> <?= $bajaInfo['fecha_baja'] ?> |
            <strong>Motivo:</strong> <?= htmlspecialchars($bajaInfo['motivo']) ?> |
            <strong>Valor residual:</strong> $<?= number_format($bajaInfo['valor_residual'], 2) ?>
        </div>
    <?php endif; ?>

    <a href="equipos.php" class="btn btn-secondary mt-3">← Volver</a>
</div>

<?php include 'footer.php'; ?>

