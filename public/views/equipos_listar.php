<?php include 'header.php'; ?>

<div class="container mt-4">

    <div class="d-flex justify-content-between mb-3">
        <h3>Equipos registrados</h3>
        <a href="views/equipos_nuevo.php" class="btn btn-primary">Nuevo equipo</a>
    </div>

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Equipo</th>
                <th>Nomenclatura</th>
                <th>Tipo</th>
                <th>Marca</th>
                <th>Empresa</th>
                <th>Sede</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($datos as $eq): ?>
                <tr>
                    <td><?= $eq['id_equipo'] ?></td>
                    <td><?= $eq['nombre_equipo'] ?></td>
                    <td><?= $eq['nomenclatura'] ?></td>
                    <td><?= $eq['tipo_equipo'] ?></td>
                    <td><?= $eq['marca'] ?></td>
                    <td><?= $eq['empresa'] ?></td>
                    <td><?= $eq['sede'] ?></td>

                    <td>
                        <?php if ($eq['estado'] == 1): ?>
                            <span class="badge bg-success">Operativo</span>
                        <?php else: ?>
                            <span class="badge bg-danger">Inactivo</span>
                        <?php endif; ?>
                    </td>

                    <td>
                        <a href="equipos_ver.php?id=<?= $eq['id_equipo'] ?>" 
                           class="btn btn-info btn-sm">Ver</a>

                        <a href="equipos_editar.php?id=<?= $eq['id_equipo'] ?>" 
                           class="btn btn-warning btn-sm">Editar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="dashboard.php" class="btn btn-secondary">← Volver</a>
</div>
