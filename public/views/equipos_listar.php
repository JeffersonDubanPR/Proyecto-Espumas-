<?php include 'header.php'; ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
        <h3>Equipos registrados</h3>
        <div class="d-flex gap-2">
            <a href="equipos.php?action=nuevo" class="btn btn-primary">+ Nuevo equipo</a>
            <a href="importar_equipos.php" class="btn btn-success">⬆ Importar Excel</a>
            <a href="exportar.php" class="btn btn-outline-secondary">⬇ Exportar</a>
        </div>
    </div>

    <?php if (isset($_SESSION['mensaje'])): ?>
        <div class="alert alert-success"><?= $_SESSION['mensaje']; unset($_SESSION['mensaje']); ?></div>
    <?php endif; ?>

    <!-- 🔍 FORMULARIO DE BÚSQUEDA -->
    <form method="GET" action="equipos.php" class="mb-3 d-flex">
        <input type="text" name="buscar" class="form-control me-2" 
               placeholder="Buscar por nombre, cédula, serial, placa, etc..." 
               value="<?= htmlspecialchars($_GET['buscar'] ?? '') ?>">
        <button type="submit" class="btn btn-outline-primary">Buscar</button>
        <?php if (!empty($_GET['buscar'])): ?>
            <a href="equipos.php" class="btn btn-outline-secondary ms-2">Limpiar</a>
        <?php endif; ?>
    </form>

    <table class="table table-striped table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Equipo</th>
                <th>Serial</th>
                <th>Responsable</th>
                <th>Empresa</th>
                <th>Sede</th>
                <th>Ciclo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($datos)): ?>
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">
                        No se encontraron equipos que coincidan con la búsqueda.
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach ($datos as $eq): ?>
                    <?php
                        $ciclo = $eq['estado_ciclo'] ?? 'Registrado';
                        $badgeClass = [
                            'Registrado'      => 'secondary',
                            'En Uso'          => 'success',
                            'En Mantenimiento'=> 'warning',
                            'De Baja'         => 'danger',
                        ][$ciclo] ?? 'secondary';
                    ?>
                    <tr>
                        <td><?= $eq['id_equipo'] ?></td>
                        <td><?= htmlspecialchars($eq['nombre_equipo']) ?></td>
                        <td><?= htmlspecialchars($eq['serial']) ?></td>
                        <td><?= htmlspecialchars($eq['responsable']) ?></td>
                        <td><?= htmlspecialchars($eq['empresa'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($eq['sede'] ?? '-') ?></td>
                        <td><span class="badge bg-<?= $badgeClass ?>"><?= $ciclo ?></span></td>
                        <td>
                            <a href="equipos_ver.php?id=<?= $eq['id_equipo'] ?>" class="btn btn-info btn-sm">Ver</a>
                            <a href="equipos_editar.php?id=<?= $eq['id_equipo'] ?>" class="btn btn-warning btn-sm">Editar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <a href="dashboard.php" class="btn btn-secondary">← Volver</a>
</div>

<?php include 'footer.php'; ?>